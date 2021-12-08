<?php

namespace App\Traits;

trait MonthlyItemSumTrait
{
    // 各費目の合計計算メソット
    // 一連のメソッドをカプセル化したものを移管しtrait
    private function getMonthlyItemSum($tableItemId, $date, $id, $activeBookId){
        $monthlyItems = $this->monthlyItems($tableItemId, $date, $id, $activeBookId)->get();
        return $this->monthlyItemsSum($monthlyItems);
    }
    // 費目を家計簿及び年月別に取得するスコープ
    public  function scopeMonthlyItems($query, $tableItemId, $date, $id, $activeBookId){
        return $query->where($tableItemId, $id)
        ->where('book_id', $activeBookId)
        ->whereYear('date', $date->year)
        ->whereMonth('date', $date->month);
    }
    // スコープの合計計算部
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
}