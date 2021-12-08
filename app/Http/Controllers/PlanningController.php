<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\Transaction;
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

        // 予算合計の取得(費目&月&家計簿の全一致のみ)
        $plannig = new Planning;
        // 引数設定
        $activeBook = $array['activeBook'];
        $tableItemId ='planning_item_id';
        // 各予算費目ごとに受け取り
        $ingredientsPlanningSum = $plannig->ingredients($tableItemId, $date, $activeBook->id);
        $eatoutPlanningSum = $plannig->eatoutSum($tableItemId, $date, $activeBook->id);
        $eachAPlanningSum = $plannig->eachASum($tableItemId, $date, $activeBook->id);
        $eachBPlanningSum = $plannig->eachBSum($tableItemId, $date, $activeBook->id);
        $dailyPlanningSum = $plannig->dailySum($tableItemId, $date, $activeBook->id);
        $entertainmentPlanningSum = $plannig->entertainmentSum($tableItemId, $date, $activeBook->id);
        $childrenPlanningSum = $plannig->childrenSum($tableItemId, $date, $activeBook->id);
        $luxuryPlanningSum = $plannig->luxurySum($tableItemId, $date, $activeBook->id);
        $specialPlanningSum = $plannig->specialSum($tableItemId, $date, $activeBook->id);
        $eatoutPlanningSum = $plannig->eatoutSum($tableItemId, $date, $activeBook->id);
        $rentPlanningSum = $plannig->rentSum($tableItemId, $date, $activeBook->id);
        $fixedPlanningSum = $plannig->fixedSum($tableItemId, $date, $activeBook->id);
        $pocketAPlanningSum = $plannig->pocketASum($tableItemId, $date, $activeBook->id);
        $pocketBPlanningSum = $plannig->pocketBSum($tableItemId, $date, $activeBook->id);
        $normalDepositPlanningSum = $plannig->normalDepositSum($tableItemId, $date, $activeBook->id);
        $middleDepositPlanningSum = $plannig->middleDepositSum($tableItemId, $date, $activeBook->id);
        $longDepositPlanningSum = $plannig->longDepositSum($tableItemId, $date, $activeBook->id);
        $childrenDeoisitPlanningSum = $plannig->childrenDepositSum($tableItemId, $date, $activeBook->id);
        $govermentBondsPlanningSum = $plannig->govermentBondsSum($tableItemId, $date, $activeBook->id);
        $stockPlanningSum = $plannig->stockSum($tableItemId, $date, $activeBook->id);
        $monthlyBudgetPlanningSum = $plannig->monthlyBudgetSum($tableItemId, $date, $activeBook->id);

        // 全体収支
        // 予算総額
        $totalPlanningSum = $ingredientsPlanningSum+$eatoutPlanningSum+$eachAPlanningSum+$eachBPlanningSum+$dailyPlanningSum+$entertainmentPlanningSum+$childrenPlanningSum+$luxuryPlanningSum;
        +$rentPlanningSum+$fixedPlanningSum+$pocketAPlanningSum+$pocketBPlanningSum+$normalDepositPlanningSum+$middleDepositPlanningSum+$longDepositPlanningSum+$childrenDeoisitPlanningSum
        +$govermentBondsPlanningSum+$stockPlanningSum+$monthlyBudgetPlanningSum;

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
            // 予算合計関連
            'totalPlanningSum' => $totalPlanningSum,
            'ingredientsPlanningSum' => $ingredientsPlanningSum,
            'eatoutPlanningSum' => $eatoutPlanningSum,
            'eachAPlanningSum' => $eachAPlanningSum,
            'eachBPlanningSum' => $eachBPlanningSum,
            'dailyPlanningSum' => $dailyPlanningSum,
            'entertainmentPlanningSum' => $entertainmentPlanningSum,
            'childrenPlanningSum' => $childrenPlanningSum,
            'luxuryPlanningSum' => $luxuryPlanningSum,
            'specialPlanningSum' => $specialPlanningSum,
            'rentPlanningSum'=> $rentPlanningSum,
            'fixedPlanningSum' => $fixedPlanningSum,
            'pocketAPlanningSum' => $pocketAPlanningSum,
            'pocketBPlanningSum' => $pocketBPlanningSum,
            'normalDepositPlanningSum' => $normalDepositPlanningSum,
            'middleDepositPlanningSum' => $middleDepositPlanningSum,
            'longDepositPlanningSum' => $longDepositPlanningSum,
            'childrenDepositPlanningSum' => $childrenDeoisitPlanningSum,
            'govermentBondsPlanningSum' => $govermentBondsPlanningSum,
            'stockPlanningSum' => $stockPlanningSum,
            'monthlyBudgetPlanningSum' => $monthlyBudgetPlanningSum,
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