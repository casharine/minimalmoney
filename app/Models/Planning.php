<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\MonthlyItemSumTrait;


class Planning extends Model
{
    use MonthlyItemSumTrait;

     // ホワイトリストにuser_idを指定
    protected $fillable = ['editor_id', 'book_id', 'price', 'planning_item_id', 'date', 'note'];
    // モデルに対応するテーブルを指定（命名測に合っているいるため本来は記述不要）
    protected $table = 'plannings';
    // データべースアクセス時に型変換
    protected $casts = [
        'date_selecter' => 'date'
    ];
    
    // このsharings_idの書籍は一冊のみしかないため単数形belongsTo
    public function book(){
        return $this->belongsTo(Book::class);
                // return $this->belongsTo(Book::class,'name', 'authorizer_id');
    }

    // sharings user_idとusers idの関係性を定義 
    public function user()
    {
        return $this->belongsTo(User::class, 'editor_id', 'id');
    }

    public function Planning_item()
    {
        return $this->belongsTo(PlanningItem::class, 'planning_item_id', 'id');
    }

    // 各費目の合計計算メソット
    // メンバ変数、メソッドをカプセル化し共通化
    // private function getMonthlyItemSum($tableItemId, $date, $id, $active_book_id){
    //     // select影響なしもinsertやupdateの場合のfor文などに備え、メソッド内部でインスタンスを作り直しておく
    //     $monthlyItems = $this->newInstance()->monthlyItems($tableItemId, $date, $id, $active_book_id)->get();
    //     return $this->monthlyItemsSum($monthlyItems);
    // }

    // 費目を家計簿及び年月別に取得するスコープ
    // public  function scopeMonthlyItems($query,$tableItemId, $date, $id, $active_book_id){
    //     return $query->where($tableItemId, $id)
    //     ->where('book_id', $active_book_id)
    //     ->whereYear('date', $date->year)
    //     ->whereMonth('date', $date->month);
    // }
    // // スコープの合計計算部
    // public function monthlyItemsSum($monthlyItems){
    //     if($monthlyItems->isNotEmpty()){
    //         $monthlyItemsSum = $monthlyItems
    //         ->sum("price");
    //         return $monthlyItemsSum;
    //     }else{
    //         $monthlyItemsSum = 0;
    //         return $monthlyItemsSum;
    //     }
    // }

    // 予算ごとにメソッドを呼び出し
    // 食材費
    public function ingredients($tableItemId, $date, $active_book_id){
        $id = 1;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 外食費
    public function eatoutSum($tableItemId, $date, $active_book_id){
        $id = 2;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 個別A
    public function eachASum($tableItemId, $date, $active_book_id){
        $id = 3;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 個別B
    public function eachBSum($tableItemId, $date, $active_book_id){
        $id = 4;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 日用費
    public function dailySum($tableItemId, $date, $active_book_id){
        $id = 5;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 交際費
    public function entertainmentSum($tableItemId, $date, $active_book_id){
        $id = 6;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 養育費
    public function childrenSum($tableItemId, $date, $active_book_id){
        $id = 7;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 特別費
    public function luxurySum($tableItemId, $date, $active_book_id){
        $id = 8;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 特別費
    public function specialSum($tableItemId, $date, $active_book_id){
        $id = 9;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function rentSum($tableItemId, $date, $active_book_id){
        $id = 10;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function fixedSum($tableItemId, $date, $active_book_id){
        $id = 10;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function pocketASum($tableItemId, $date, $active_book_id){
        $id = 12;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function pocketBSum($tableItemId, $date, $active_book_id){
        $id = 13;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function normalDepositSum($tableItemId, $date, $active_book_id){
        $id = 14;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function middleDepositSum($tableItemId, $date, $active_book_id){
        $id = 15;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function longDepositSum($tableItemId, $date, $active_book_id){
        $id = 16;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function childrenDepositSum($tableItemId, $date, $active_book_id){
        $id = 17;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function govermentBondsSum($tableItemId, $date, $active_book_id){
        $id = 18;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function stockSum($tableItemId, $date, $active_book_id){
        $id = 19;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
    // 
    public function monthlyBudgetSum($tableItemId, $date, $active_book_id){
        $id = 20;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $active_book_id);
    }
}
