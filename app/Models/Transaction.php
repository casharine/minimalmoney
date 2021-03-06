<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\MonthlyItemsSumTrait;

class Transaction extends Model
{
    use MonthlyItemsSumTrait;

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
   
    // 元々クラス内でカプセル化で共通化していたが、他Modelからも使用するためTraitに変更
    // メンバ変数、メソッドをカプセル化し共通化
    // private function getMonthlyItemSum($tableItemId, $date, $id, $activeBookId){
    //     ...以下略 
}
