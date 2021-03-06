<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MonthlyItemsSumTrait;


class Planning extends Model
{
    use MonthlyItemsSumTrait;

     // ホワイトリストにuser_idを指定
    protected $fillable = ['editor_id', 'book_id', 'price', 'planning_item_id', 'date', 'note'];
    // モデルに対応するテーブルを指定（命名測に合っているいるため本来は記述不要）
    protected $table = 'plannings';

    
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
}
