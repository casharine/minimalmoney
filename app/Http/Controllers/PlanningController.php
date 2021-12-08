<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PlanningItem;

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
public function planning()
{
    // 共通で使用するフィールドを取得 ※変数を再定義するなど一度配列変数に戻す必要がある場合
    $array = $this->setCommonArray();
    $user = $array['user'];
     $activeBookNull = $array['activeBookNull'];

    if($activeBookNull){
        return view('planning.planning', [
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
        $ingredientsSum = Planning::ingredients($date);
        $eatoutSum = Planning::eatoutSum($date);
        $eachASum = Planning::eachASum($date);
        $eachBSum = Planning::eachBSum($date);
        $dailySum = Planning::dailySum($date);
        $entertainmentSum = Planning::entertainmentSum($date);
        $childrenSum = Planning::childrenSum($date);
        $luxurySum = Planning::luxurySum($date);
        $specialSum = Planning::specialSum($date);
        $rentSum = Planning::rentSum($date);
        $fixedSum = Planning::fixedSum($date);
        $pocketASum = Planning::pocketASum($date);
        $pocketBSum = Planning::pocketBSum($date);
        $normalDepositSum = Planning::normalDepositSum($date);
        $middleDepositSum = Planning::middleDepositSum($date);
        $longDepositSum = Planning::longDepositSum($date);
        $childrenDeoisitSum = Planning::childrenDepositSum($date);
        $govermentBondsSum = Planning::govermentBondsSum($date);
        $stockSum = Planning::stockSum($date);
        $monthlyBudgetSum = Planning::monthlyBudgetSum($date);

        // 全体収支
        // 予算総額
        $totalSum = $ingredientsSum+$eatoutSum+$eachASum+$eachBSum+$dailySum+$entertainmentSum+$childrenSum+$luxurySum
        +$rentSum+$fixedSum+$pocketASum+$pocketBSum+$normalDepositSum+$middleDepositSum+$longDepositSum+$childrenDeoisitSum
        +$govermentBondsSum+$stockSum+$monthlyBudgetSum;

        return view('planning.planning', [
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
            'rentSum'=> $rentSum,
            'fixedSum' => $fixedSum,
            'pocketASum' => $pocketASum,
            'pocketBSum' => $pocketBSum,
            'normalDepositSum' => $normalDepositSum,
            'middleDepositSum' => $middleDepositSum,
            'longDepositSum' => $longDepositSum,
            'childrenDepositSum' => $childrenDeoisitSum,
            'govermentBondsSum' => $govermentBondsSum,
            'stockSum' => $stockSum,
            'monthlyBudgetSum' => $monthlyBudgetSum,
        ]);
    }
}

// 表示予算入力の年月の指定（変更）
public function dateSelecter(Request $request, int $id)
{
    // ロールバックの整合性を保ため一連の処理とする
    DB::planning(function () use($request, $id) {
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
    DB::planning(function () use($request, $id) {
        // レコード追加に必要な変数を定義する
        $user = \Auth::user();            
        Planning::create([
            'editor_id' => $user->id,
            'book_id' => $id,
            'price' => $request->price,
            'planning_item_id' => $request->item_id +1,  
            'date' => $request->date,
            'note' => $request->note,
        ]);
    });
    return back();
}
}