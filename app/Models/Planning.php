<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\MonthlyItemsSumTrait;


class Planning extends Model
{
    use MonthlyItemsSumTrait;

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

    // 予算ごとにメソッドを呼び出し
    // 食材費
    public function ingredients($tableItemId, $date, $activeBookId){
        $id = 1;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 外食費
    public function eatoutSum($tableItemId, $date, $activeBookId){
        $id = 2;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // // 個別A
    // public function eachASum($tableItemId, $date, $activeBookId){
    //     $id = 3;
    //     return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    // }
    // 個別B
    public function eachBSum($tableItemId, $date, $activeBookId){
        $id = 4;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 日用費
    public function dailySum($tableItemId, $date, $activeBookId){
        $id = 5;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 交際費
    public function entertainmentSum($tableItemId, $date, $activeBookId){
        $id = 6;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 養育費
    public function childrenSum($tableItemId, $date, $activeBookId){
        $id = 7;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 特別費
    public function luxurySum($tableItemId, $date, $activeBookId){
        $id = 8;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 特別費
    public function specialSum($tableItemId, $date, $activeBookId){
        $id = 9;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function rentSum($tableItemId, $date, $activeBookId){
        $id = 10;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function fixedSum($tableItemId, $date, $activeBookId){
        $id = 10;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function pocketASum($tableItemId, $date, $activeBookId){
        $id = 12;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function pocketBSum($tableItemId, $date, $activeBookId){
        $id = 13;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function normalDepositSum($tableItemId, $date, $activeBookId){
        $id = 14;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function middleDepositSum($tableItemId, $date, $activeBookId){
        $id = 15;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function longDepositSum($tableItemId, $date, $activeBookId){
        $id = 16;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function childrenDepositSum($tableItemId, $date, $activeBookId){
        $id = 17;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function govermentBondsSum($tableItemId, $date, $activeBookId){
        $id = 18;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function stockSum($tableItemId, $date, $activeBookId){
        $id = 19;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
    // 
    public function monthlyBudgetSum($tableItemId, $date, $activeBookId){
        $id = 20;
        return $this->getMonthlyItemSum($tableItemId, $date, $id, $activeBookId);
    }
}
