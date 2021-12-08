<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Planning extends Model
{
    use HasFactory;
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
    public function getMonthlyItem($date, $id, $active_book_id){
        $monthlyItems = $this->newInstance()->monthlyItems($date, $id, $active_book_id);
        return $this->montlyItemSum($monthlyItems);
    }
    // 各予算の合計計算メソット
    // 共通：予算及び年月別のレコードを取得するScope
    public function scopeMonthlyItems($query, $date, $id, $active_book_id){
        return $query->where('planning_item_id', $id)
        ->where('book_id', $active_book_id)
        ->whereYear('date', $date->year)
        ->whereMonth('date', $date->month);
    }
    // 共通：予算及び年月別の合計額を計算
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
    // 予算ごとにメソッドを呼び出し
    // 食材費
    public function ingredients($date){
        $id = 1;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 外食費
    public function eatoutSum($date){
        $id = 2;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 個別A
    public function eachASum($date){
        $id = 3;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 個別B
    public function eachBSum($date){
        $id = 4;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 日用費
    public function dailySum($date){
        $id = 5;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 交際費
    public function entertainmentSum($date){
        $id = 6;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 養育費
    public function childrenSum($date){
        $id = 7;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 特別費
    public function luxurySum($date){
        $id = 8;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 特別費
    public function specialSum($date){
        $id = 9;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function rentSum($date){
        $id = 10;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function fixedSum($date){
        $id = 10;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function pocketASum($date){
        $id = 12;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function pocketBSum($date){
        $id = 13;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function normalDepositSum($date){
        $id = 14;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function middleDepositSum($date){
        $id = 15;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function longDepositSum($date){
        $id = 16;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function childrenDepositSum($date){
        $id = 17;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function govermentBondsSum($date){
        $id = 18;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function stockSum($date){
        $id = 19;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public function monthlyBudgetSum($date){
        $id = 20;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
}
