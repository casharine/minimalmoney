<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Book;
use App\Models\Sharing;
use App\Models\Transaction;
use App\Enums\TransactionItemType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
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
    $activeBookNull = $array['activeBookNull'];

    if($activeBookNull){
        return view('home.home', [
        // 共通private array
        'user' => $array['user'],
        'activeBookNull' =>  $array['activeBookNull']
        ]);        
    }else{
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
        // インスタンス化
        $transaction = new Transaction;
        // メソットに引き渡す変数を定義
        $activeBook = $array['activeBook'];
        $tableItemId = 'transaction_item_id';
        $tableName = 'transactions';

        // 各費目毎にメソットを呼び出し
        $ingredientsSum = $transaction->ingredients( $tableItemId, $date, $activeBook->id);
        $eatoutSum = $transaction->eatoutSum( $tableItemId, $date, $activeBook->id);
        $eachASum = $transaction->eachASum( $tableItemId, $date, $activeBook->id);
        $eachBSum = $transaction->eachBSum( $tableItemId, $date, $activeBook->id);
        $dailySum = $transaction->dailySum( $tableItemId, $date, $activeBook->id);
        $entertainmentSum = $transaction->entertainmentSum( $tableItemId, $date, $activeBook->id);
        $childrenSum = $transaction->childrenSum( $tableItemId, $date, $activeBook->id);
        $luxurySum = $transaction->luxurySum( $tableItemId, $date, $activeBook->id);
        $specialSum = $transaction->specialSum( $tableItemId, $date, $activeBook->id);
        $profitsSum = $transaction->profitsSum( $tableItemId, $date, $activeBook->id);
        $lossSum = $transaction->lossSum( $tableItemId, $date, $activeBook->id);
        $advanceASum = $transaction->advanceASum( $tableItemId, $date, $activeBook->id);
        $advanceBum = $transaction->advanceBSum( $tableItemId, $date, $activeBook->id);

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

// 費目を家計簿に登録
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