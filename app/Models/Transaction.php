<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\MonthlyItemSumTrait;

class Transaction extends Model
{
    use MonthlyItemSumTrait;

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

    // 費目ごとのメソッドを呼び出し
    // 食材費
    public function ingredients($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 1, $active_book_id);
    }
    // 外食費
    public function eatoutSum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 2, $active_book_id);
    }
    // 個別A
    public function eachASum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 3, $active_book_id);
    }
    // 個別B
    public function eachBSum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 4, $active_book_id);
    }
    // 日用費
    public function dailySum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 5, $active_book_id);
    }
    // 交際費
    public function entertainmentSum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 6, $active_book_id);
    }
    // 養育費
    public function childrenSum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 7, $active_book_id);
    }
    // 特別費
    public function luxurySum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 8, $active_book_id);
    }
    // 特別費
    public function specialSum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 9, $active_book_id);
    }
    // 雑益
    public function profitsSum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 10, $active_book_id);
    }
    // 雑損
    public function lossSum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 11, $active_book_id);
    }
    // 立替A
    public function advanceASum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 12, $active_book_id);
    }
    // 立替B
    public function advanceBSum($tableItemId, $date, $active_book_id){
        return $this->getMonthlyItemSum($tableItemId, $date, 13, $active_book_id);
    }
    // 元々クラス内でカプセル化で共通化していたが、他Modelからも使用するためTraitに変更
    // メンバ変数、メソッドをカプセル化し共通化
    // private function getMonthlyItemSum($tableItemId, $date, $id, $active_book_id){
    //     ...以下略 
}
