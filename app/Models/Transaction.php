<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

     // ホワイトリストにuser_idを指定
    protected $fillable = ['editor_id', 'book_id', 'price', 'transaction_item_id', 'date', 'note'];
    // モデルに対応するテーブルを指定（命名測に合っているいるため本来は記述不要）
    protected $table = 'transactions';
    
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

    public static function dailySum($date){
     // 日用費
        // 月別の日用品の合計を取得
        $daily = Transaction::with(['transaction_item' => function ($builder){
            $builder->where('id', 5);
        }])->whereYear('date', $date->year)
        ->whereMonth('date', $date->month)
        ->get();

        // 月別の合計額を計算,ヌルぽの回避
        if($daily->isNotEmpty()){
            $dailySum = $daily
        ->sum("price");

            return $dailySum;

        }else{

            $dailySum = 0;

            return $dailySum;
        }
    }






}
