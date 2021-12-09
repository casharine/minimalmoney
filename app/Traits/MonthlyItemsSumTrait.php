<?php

namespace App\Traits;
use App\Models\Transaction;
use App\Models\Planning;

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
        $eachAPlanningSum = $plannig->eachASum($foreignKey, $date, 3, $activeBookId);
        $eachBPlanningSum = $plannig->eachBSum($foreignKey, $date, 4, $activeBookId);
        $dailyPlanningSum = $plannig->dailySum($foreignKey, $date, 5, $activeBookId);
        $entertainmentPlanningSum = $plannig->entertainmentSum($foreignKey, $date, 6, $activeBookId);
        $childrenPlanningSum = $plannig->childrenSum($foreignKey, $date, 7, $activeBookId);
        $luxuryPlanningSum = $plannig->luxurySum($foreignKey, $date, 8, $activeBookId);
        $specialPlanningSum = $plannig->specialSum($foreignKey, $date, 9, $activeBookId);
        $rentPlanningSum = $plannig->rentSum($foreignKey, $date, 10, $activeBookId);
        $fixedPlanningSum = $plannig->fixedSum($foreignKey, $date, 11, $activeBookId);
        $pocketAPlanningSum = $plannig->pocketASum($foreignKey, $date, 12, $activeBookId);
        $pocketBPlanningSum = $plannig->pocketBSum($foreignKey, $date, 13, $activeBookId);
        $normalDepositPlanningSum = $plannig->normalDepositSum($foreignKey, $date, 14, $activeBookId);
        $middleDepositPlanningSum = $plannig->middleDepositSum($foreignKey, $date, 15, $activeBookId);
        $longDepositPlanningSum = $plannig->longDepositSum($foreignKey, $date, 16, $activeBookId);
        $childrenDepositPlanningSum = $plannig->childrenDepositSum($foreignKey, $date, 17, $activeBookId);
        $govermentBondsPlanningSum = $plannig->govermentBondsSum($foreignKey, $date, 18, $activeBookId);
        $stockPlanningSum = $plannig->stockSum($foreignKey, $date, 19, $activeBookId);
        $monthlyBudgetPlanningSum = $plannig->monthlyBudgetSum($foreignKey, $date, 20, $activeBookId);

        // 全体収支
        // 予算総額
        $totalPlanningSum = $ingredientsPlanningSum+$eatoutPlanningSum+$eachAPlanningSum+$eachBPlanningSum+$dailyPlanningSum+$entertainmentPlanningSum+$childrenPlanningSum+$luxuryPlanningSum;
        +$rentPlanningSum+$fixedPlanningSum+$pocketAPlanningSum+$pocketBPlanningSum+$normalDepositPlanningSum+$middleDepositPlanningSum+$longDepositPlanningSum+$childrenDepositPlanningSum
        +$govermentBondsPlanningSum+$stockPlanningSum+$monthlyBudgetPlanningSum;

        return array(
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
            'childrenDepositPlanningSum' => $childrenDepositPlanningSum,
            'govermentBondsPlanningSum' => $govermentBondsPlanningSum,
            'stockPlanningSum' => $stockPlanningSum,
            'monthlyBudgetPlanningSum' => $monthlyBudgetPlanningSum,
        );
    }

    //    // 全体収支
    //     // 予算総額
    //     $totalPlanningSum = $ingredientsPlanningSum+$eatoutPlanningSum+$eachAPlanningSum+$eachBPlanningSum+$dailyPlanningSum+$entertainmentPlanningSum+$childrenPlanningSum+$luxuryPlanningSum;
    //     +$rentPlanningSum+$fixedPlanningSum+$pocketAPlanningSum+$pocketBPlanningSum+$normalDepositPlanningSum+$middleDepositPlanningSum+$longDepositPlanningSum+$childrenDepositPlanningSum
    //     +$govermentBondsPlanningSum+$stockPlanningSum+$monthlyBudgetPlanningSum;

    //     return array(
    //         'totalPlanningSum' => $totalPlanningSum,
    //         'ingredientsPlanningSum' => $ingredientsPlanningSum,
    //         'eatoutPlanningSum' => $eatoutPlanningSum,
    //         'eachAPlanningSum' => $eachAPlanningSum,
    //         'eachBPlanningSum' => $eachBPlanningSum,
    //         'dailyPlanningSum' => $dailyPlanningSum,
    //         'entertainmentPlanningSum' => $entertainmentPlanningSum,
    //         'childrenPlanningSum' => $childrenPlanningSum,
    //         'luxuryPlanningSum' => $luxuryPlanningSum,
    //         'specialPlanningSum' => $specialPlanningSum,
    //         'rentPlanningSum'=> $rentPlanningSum,
    //         'fixedPlanningSum' => $fixedPlanningSum,
    //         'pocketAPlanningSum' => $pocketAPlanningSum,
    //         'pocketBPlanningSum' => $pocketBPlanningSum,
    //         'normalDepositPlanningSum' => $normalDepositPlanningSum,
    //         'middleDepositPlanningSum' => $middleDepositPlanningSum,
    //         'longDepositPlanningSum' => $longDepositPlanningSum,
    //         'childrenDepositPlanningSum' => $childrenDepositPlanningSum,
    //         'govermentBondsPlanningSum' => $govermentBondsPlanningSum,
    //         'stockPlanningSum' => $stockPlanningSum,
    //         'monthlyBudgetPlanningSum' => $monthlyBudgetPlanningSum,
    //     );
    // }
}