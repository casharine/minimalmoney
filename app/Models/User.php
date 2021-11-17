<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

public $activeBookId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // MtoM このユーザーが保有している帳簿
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_user', 'user_id', 'book_id')->withTimestamps();
        // return $this->belongsToMany('App\Book');
    }

    // sharings user_idとusers idの関係性を定義
    public function userSharings()
    {
        return $this->belongsToMany(Sharing::class, 'id', 'user_id');
    }
    
    // インスタンス(User Model)の帳簿数(booksのリレーション数)をカウント
    public function loadBookCounts()
    {
        $this->loadCount('books');
    }

    // Userインスタンスbooksのリレーション内に$bookIdが存在するか
    public function isYourBook($bookId)
    {
        $user = \Auth::user();
        return $user->books()->where('book_id', $bookId)->exists();
    }

    // 新規bookの場合trueを返す
    public function isNewBook(){
        $counts = $this->loadBookCounts();
        if($counts === null || 0){
            echo true;
        }
    }
}
