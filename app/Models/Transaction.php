<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

     // ホワイトリストにuser_idを指定
    protected $fillable = ['editor_id', 'book_id', 'price', 'transaction_item_id', 'date', 'note'];
    // モデルに対応するテーブルを指定（命名測に合っているいるため本来は記述不要）
    protected $table = 'transactions';
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

    public function transaction_item()
    {
        return $this->belongsTo(TransactionItem::class, 'transaction_item_id', 'id');
    }

    // 各費目の合計計算メソット
    // 共通：費目及び年月別のレコードを取得するScope
    public  function scopeMonthlyItems($query, $date, $id, $active_book_id){
        return $query->where('transaction_item_id', $id)
        ->where('book_id', $active_book_id)
        ->whereYear('date', $date->year)
        ->whereMonth('date', $date->month);
    }
    // 共通：費目及び年月別の合計額を計算
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

    private function getMonthlyItemSum($date, $id, $active_book_id){
        $monthlyItems = $this->newInstance()->monthlyItems($date, $id, $active_book_id)->get();
        return $this->monthlyItemsSum($monthlyItems);
    }

    // 費目ごとにメソッドを呼び出し
    // 食材費
    public function ingredients($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 1, $active_book_id);
    }
    // 外食費
    public function eatoutSum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 2, $active_book_id);
    }
    // 個別A
    public function eachASum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 3, $active_book_id);
    }
    // 個別B
    public function eachBSum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 4, $active_book_id);
    }
    // 日用費
    public function dailySum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 5, $active_book_id);
    }
    // 交際費
    public function entertainmentSum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 6, $active_book_id);
    }
    // 養育費
    public function childrenSum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 7, $active_book_id);
    }
    // 特別費
    public function luxurySum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 8, $active_book_id);
    }
    // 特別費
    public function specialSum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 9, $active_book_id);
    }
    // 雑益
    public function profitsSum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 10, $active_book_id);
    }
    // 雑損
    public function lossSum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 11, $active_book_id);
    }
    // 立替A
    public function advanceASum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 12, $active_book_id);
    }
    // 立替B
    public function advanceBSum($date, $active_book_id){
        return $this->getMonthlyItemSum($date, 13, $active_book_id);
    }

}
