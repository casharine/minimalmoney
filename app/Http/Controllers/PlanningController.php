<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanningController extends Controller
{

// クラスのプライベートメソッドでメソッド内部のフィールドを配列化し各メソッドに共有
private function setCommonArray()
{
    // Userインスタンスを取得
    $user = \Auth::user();
    
    // アクティブBookの取得＝使用する家計簿の取得
    $activeBook = $user->books()->where('active_flag', 't')->first();
    
    // アクティブ家計簿のNullチェック 
    $activeBookNull = $user->books()->where('active_flag', 't')->get()->isEmpty();

    return array(
        'user' => $user,
        'userId' => $user->id,
        'activeBook' => $activeBook,
        'activeBookNull' => $activeBookNull
    );
}

// メイン画面
public function home()
{
    // 共通で使用するフィールドを取得 ※変数を再定義するなど一度配列変数に戻す必要がある場合
    $array = $this->setCommonArray();
    $user = $array['user'];

    // 表示月を取得 ※追加機能以下のフィールドは削除する
    $date =  User::findOrFail($array['userId'])->date_selecter;
    // 表示月がNullの場合今月を表示する
    $today = Carbon::today();
    if($date == null){
        $date = $today;
        $user->date_selecter = $date;
        $user->save();
    }

    // プルダウン用変数 直近10年
    $years = [];
    for($i=0; $i<=10; $i++){
            //  Carbonはmutable参照型なのでcopyを使用しTodayの値の上書きを防ぐ ※クロノスはimmutable値参照型
        $y = $today->copy()->subYears($i)->year;
        $years[$y] = $y;
    }
    // プルダウン用変数 直近12カ月
    $months = [];
    for($i=0; $i<=11; $i++){
        $m = $today->copy()->subMonths($i)->month;
        $months[$m] = $m;
    }
            
    // 各費目の受取
    $ingredientsSum = Transaction::ingredients($date);
    $eatoutSum = Transaction::eatoutSum($date);
    $eachASum = Transaction::eachASum($date);
    $eachBSum = Transaction::eachBSum($date);
    $dailySum = Transaction::dailySum($date);
    $entertainmentSum = Transaction::entertainmentSum($date);
    $childrenSum = Transaction::childrenSum($date);
    $luxurySum = Transaction::luxurySum($date);
    $specialSum = Transaction::specialSum($date);
    $profitsSum = Transaction::profitsSum($date);
    $lossSum = Transaction::lossSum($date);
    $advanceASum = Transaction::advanceASum($date);
    $advanceBum = Transaction::advanceBSum($date);

    // 全体収支
    // 予算総額
    $totalSum = $ingredientsSum+$eatoutSum+$eachASum+$eachBSum+$dailySum+$entertainmentSum+$childrenSum+$luxurySum+$specialSum+$profitsSum+$lossSum+$advanceASum+$advanceBum;

    return view('home.home', [
        // 共通private array
        'user' => $array['user'],
        'userId' => $array['userId'],
        'activeBook' => $array['activeBook'],
        'activeBookNull' =>  $array['activeBookNull'],
        // 日付関連
        'date' => $date,
        'years' => $years,
        'months' => $months,
        // 合計額
        'totalSum' => $totalSum,
        'ingredientsSum' => $ingredientsSum,
        'eatoutSum' => $eatoutSum,
        'eachASum' => $eachASum,
        'eachBSum' => $eachBSum,
        'dailySum' => $dailySum,
        'entertainmentSum' => $entertainmentSum,
        'childrenSum' => $childrenSum,
        'luxurySum' => $luxurySum,
        'specialSum' => $specialSum,
        'profitsSum' => $profitsSum,
        'lossSum' => $lossSum,
        'advanceASum' => $advanceASum,
        'advanceBSum' => $advanceBum,
    ]);
}

// 表示家計簿の年月の指定（変更）
public function dateSelecter(Request $request, int $id)
{
    // ロールバックの整合性を保ため一連の処理とする
    DB::transaction(function () use($request, $id) {
        $user = User::findOrFail($id);

        // date_Selecterをyymmdd型で更新する ※ddはダミーで11日を入れている
        $user->date_selecter = Carbon::parse("{$request->year}-{$request->month}-11");
        // $user->date_selecter = $request->year*10000 + $request->month*100 + 11;    

        $user->save();
    });
        return back();
}

// 予算を家計簿に登録
public function store(Request $request, int $id)
{
    // ロールバックの整合性を保ため一連の処理とする
    DB::transaction(function () use($request, $id) {
        // レコード追加に必要な変数を定義する
        $user = \Auth::user();            
        Transaction::create([
            'editor_id' => $user->id,
            'book_id' => $id,
            'price' => $request->price,
            'transaction_item_id' => $request->item_id +1,  
            'date' => $request->date,
            'note' => $request->note,
        ]);
    });
    return back();
}
}