<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    protected $fillable = ['editor_id', 'book_id', 'price', 'transaction_item_id', 'date', 'note'];
    protected $table;

    public function __construct(String $tableName) { 
        $this->table = $tableName;
    }

    // 各費目の合計計算メソット
    // メンバ変数、メソッドをカプセル化し共通化
    public function getMonthlyItemSum($tableItemId, $date, $id, $active_book_id){
        $monthlyItems = $this->monthlyItems($tableItemId, $date, $id, $active_book_id)->get();
        return $this->monthlyItemsSum($monthlyItems);
    }
    // 費目を家計簿及び年月別に取得するスコープ
    public  function scopeMonthlyItems($query, $tableItemId, $date, $id, $active_book_id){
        return $query->where($tableItemId, $id)
        ->where('book_id', $active_book_id)
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
