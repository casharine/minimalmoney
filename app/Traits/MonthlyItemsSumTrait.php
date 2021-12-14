<?php

namespace App\Traits;
use App\Models\Transaction;
use App\Models\Planning;
use Carbon\Carbon;

trait MonthlyItemsSumTrait
{
    // 各費目の合計計算メソット
    // 一連のメソッドをカプセル化したものを移管しtrait
    public function getMonthlyItemSum($foreignKey, $date, $itemId, $activeBookId){
        $monthlyItems = $this->monthlyItems($foreignKey, $date, $itemId, $activeBookId)->get();
        return $this->monthlyItemsSum($monthlyItems);
    }

    // 費目を家計簿及び年月別に取得するスコープ
    public  function scopeMonthlyItems($query, $foreignKey, $date, $itemId, $activeBookId){
        return $query->where($foreignKey, $itemId)
        ->where('book_id', $activeBookId)
        ->whereYear('date', $date->year)
        ->whereMonth('date', $date->month);
    }

    // スコープから取得後の合計計算部
    public function monthlyItemsSum($monthlyItems){
        if($monthlyItems->isNotEmpty()){
            $monthlyItemsSum = $monthlyItems
            ->sum("price");
            return $monthlyItemsSum;
        }else{
            $monthlyItemsSum = 0;
            return $monthlyItemsSum;
        }
    }

    //  予算合計の取得(費目&月&家計簿の全一致)を取得しArrayを返す
    public function monthlyPlanningsToArray($foreignKey, $date, $activeBookId){
        $plannig = new Planning;    
        // 各予算費目ごとに受け取り
        $ingredientsPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 1, $activeBookId);
        $eatoutPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 2, $activeBookId);
        $eachAPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 3, $activeBookId);
        $eachBPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 4, $activeBookId);
        $dailyPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 5, $activeBookId);
        $entertainmentPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 6, $activeBookId);
        $childrenPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 7, $activeBookId);
        $luxuryPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 8, $activeBookId);
        $specialPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 9, $activeBookId);
        $rentPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 10, $activeBookId);
        $fixedPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 11, $activeBookId);
        $pocketAPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 12, $activeBookId);
        $pocketBPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 13, $activeBookId);
        $normalDepositPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 14, $activeBookId);
        $middleDepositPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 15, $activeBookId);
        $longDepositPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 16, $activeBookId);
        $childrenDepositPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 17, $activeBookId);
        $govermentBondsPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 18, $activeBookId);
        $stockPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 19, $activeBookId);
        $monthlyBudgetPlanningSum = $plannig->getMonthlyItemSum($foreignKey, $date, 20, $activeBookId);

        // 合計計算
        // 予算総額
        $totalPlanningSum = $ingredientsPlanningSum+$eatoutPlanningSum+$eachAPlanningSum+$eachBPlanningSum+$dailyPlanningSum+$entertainmentPlanningSum+$childrenPlanningSum+$luxuryPlanningSum
            +$rentPlanningSum+$fixedPlanningSum+$pocketAPlanningSum+$pocketBPlanningSum+$normalDepositPlanningSum+$middleDepositPlanningSum+$longDepositPlanningSum+$childrenDepositPlanningSum
            +$govermentBondsPlanningSum+$stockPlanningSum+$monthlyBudgetPlanningSum;
        // 食費関連
        $foodPlanningSum = $ingredientsPlanningSum+$eatoutPlanningSum+$eachAPlanningSum+$eachBPlanningSum;
        $foodPlanningFamilySum = $foodPlanningSum-$eachAPlanningSum+$eachBPlanningSum; 
        $foodForEachDay = $foodPlanningFamilySum/$date->daysInMonth; //$dateはモデルでCarbon型にCastしている
        // 他
        $variablePlanningSum = $dailyPlanningSum+$entertainmentPlanningSum+$childrenPlanningSum+$luxuryPlanningSum;
        $fixedTotalPlanningSum =  $rentPlanningSum+$fixedPlanningSum+$pocketAPlanningSum+$pocketBPlanningSum;
        $pocketPlanningSum = $pocketAPlanningSum+$pocketBPlanningSum;
        $depositTotalPlanningSum = $normalDepositPlanningSum+$middleDepositPlanningSum+$longDepositPlanningSum+$childrenDepositPlanningSum+$govermentBondsPlanningSum+$stockPlanningSum+$monthlyBudgetPlanningSum;

        return array(
            // 総計
            'totalPlanningSum' => $totalPlanningSum, // 総計
            'foodPlanningSum' => $foodPlanningSum, // 食費総計
            'foodForEachDayPlanning' => $foodForEachDay, // 一日あたりの食費
            'variablePlanningSum' => $variablePlanningSum, //変動費
            'fixedTotalPlanningSum' => $fixedTotalPlanningSum, // 固定費全体(他固定費と区別)
            'pocketPlanningSum' => $pocketPlanningSum, // 小遣い合計
            'depositTotalPlanningSum' => $depositTotalPlanningSum, // 貯蓄関連

            // 小計（各費目毎）
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
            'childrenDepositPlanningSum' => $childrenDepositPlanningSum,
            'govermentBondsPlanningSum' => $govermentBondsPlanningSum,
            'stockPlanningSum' => $stockPlanningSum,
            'monthlyBudgetPlanningSum' => $monthlyBudgetPlanningSum,
        );
    }

    //  費用合計の取得(費目&月&家計簿の全一致)を取得しArrayを返す
    public function monthlyTransactionsToArray($foreignKey, $date, $activeBookId){

       // 全体収支
       $transaction = new Transaction;    
        // 各費目ごとに受け取り
        $ingredientsTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 1, $activeBookId);
        $eatoutTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 2, $activeBookId);
        $eachATransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 3, $activeBookId);
        $eachBTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 4, $activeBookId);
        $dailyTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 5, $activeBookId);
        $entertainmentTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 6, $activeBookId);
        $childrenTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 7, $activeBookId);
        $luxuryTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 8, $activeBookId);
        $specialTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 9, $activeBookId);
        $profitsTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 10, $activeBookId);
        $lossTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 11, $activeBookId);
        $advanceATransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 12, $activeBookId);
        $advanceBTransactionsSum = $transaction->getMonthlyItemSum( $foreignKey, $date, 13, $activeBookId);

        // 支出総額
            $totalTransactionsSum = $ingredientsTransactionsSum+$eatoutTransactionsSum+$eachATransactionsSum+$eachBTransactionsSum+$dailyTransactionsSum+$entertainmentTransactionsSum+$childrenTransactionsSum+$luxuryTransactionsSum+$specialTransactionsSum+$profitsTransactionsSum+$lossTransactionsSum+$advanceATransactionsSum+$advanceBTransactionsSum;

        return array(
            'totalTransactionsSum' => $totalTransactionsSum,
            'ingredientsTransactionsSum' => $ingredientsTransactionsSum,
            'eatoutTransactionsSum' => $eatoutTransactionsSum,
            'eachATransactionsSum' => $eachATransactionsSum,
            'eachBTransactionsSum' => $eachBTransactionsSum,
            'dailyTransactionsSum' => $dailyTransactionsSum,
            'entertainmentTransactionsSum' => $entertainmentTransactionsSum,
            'childrenTransactionsSum' => $childrenTransactionsSum,
            'luxuryTransactionsSum' => $luxuryTransactionsSum,
            'specialTransactionsSum' => $specialTransactionsSum,
            'profitsTransactionsSum' => $profitsTransactionsSum,
            'lossTransactionsSum' => $lossTransactionsSum,
            'advanceATransactionsSum' => $advanceATransactionsSum,
            'advanceBTransactionsSum' => $advanceBTransactionsSum,
        );
    }
}