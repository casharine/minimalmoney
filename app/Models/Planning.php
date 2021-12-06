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

    // 各予算の合計計算メソット
    // 共通：予算及び年月別のレコードを取得するScope
    public static function scopeMonthlyItems($date, $id){
        return Planning::with(['Planning_item' => function ($query) use ($id) {
            $query->where('id', $id);
        }])->whereYear('date', $date->year)
        ->whereMonth('date', $date->month);

        // スコープの中で変数を宣言できないのか？
        //         if($get->isNotEmpty()){
        //     $return = $get
        // ->sum("price");
        //     return $return;
        // }else{
        //     $return = 0;
        //     return $return;
    }
    // 共通：予算及び年月別の合計額を計算
    public static function monthlyItemsSum($monthlyItems){
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
    public static function ingredients($date){
        $id = 1;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 外食費
    public static function eatoutSum($date){
        $id = 2;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 個別A
    public static function eachASum($date){
        $id = 3;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 個別B
    public static function eachBSum($date){
        $id = 4;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 日用費
    public static function dailySum($date){
        $id = 5;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 交際費
    public static function entertainmentSum($date){
        $id = 6;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 養育費
    public static function childrenSum($date){
        $id = 7;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 特別費
    public static function luxurySum($date){
        $id = 8;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 特別費
    public static function specialSum($date){
        $id = 9;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function rentSum($date){
        $id = 10;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function fixedSum($date){
        $id = 10;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function pocketASum($date){
        $id = 12;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function pocketBSum($date){
        $id = 13;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function normalDepositSum($date){
        $id = 14;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function middleDepositSum($date){
        $id = 15;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function longDepositSum($date){
        $id = 16;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function childrenDepositSum($date){
        $id = 17;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function govermentBondsSum($date){
        $id = 18;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function stockSum($date){
        $id = 19;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
    // 
    public static function monthlyBudgetSum($date){
        $id = 20;
        $monthlyItems = Planning::scopeMonthlyItems($date, $id)->get();
        return Planning::monthlyItemsSum($monthlyItems);
    }
}
