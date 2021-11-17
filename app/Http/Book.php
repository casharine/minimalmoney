<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

        // フィールド ホワイトリストで保存カラムの指定
    protected $fillable = ['name', 'active_flag', 'authorizer_id'];
    protected $table = 'books';
    
    // MtoM この帳簿を保有するユーザー
    public function users()
    {
        return $this->belongsToMany(User::class, 'book_user', 'book_id', 'user_id')->withTimestamps();
        // return $this->belongsToMany('App\User');
    }

    // Authorized_idとuserの関係性定義 ※これだけでも動くがeagar loadingする
    public function authorizeUser()
    {
        return $this->belongsTo(User::class, 'authorizer_id');
    }

    // hasOneThrough間に介する。両方のは？
    // 被承認依頼中のBookインスタンスのsharings->user_idのusers->name
    public function sharingUser()
    {
        return $this->hasOneThrough('App\Sharing', 'App\User');
    }

    // このbookインスタンスに共有依頼は複数ありうるため、複数形hasMany
    public function sharings()
    {
        return $this->hasMany(Sharing::class);
    }
    
    // 全取得
    public function index() 
    {
        $books = Book::all();
    }

    // // 個別取得 ※idを指定して取得
    // public function show($id) {
    //     $books = Book::find($id);
    //     return view('book.detail', compact('book'));
    // }


    // アクティブBookインスタンス取得 ※active_fragが1かつBookのusersメソッドを呼び出しユーザーidが一致するbooksのレコードを取得
    public function activeBook($userId)
    {
        $activeBook = Book::where('active_flag', 1) 
            ->whereHas('users', function($query) use ($userId) {
                $query->where('id', $userId);   
            })->get();
    }

    // 自身の共有依頼中取得 ※sharing_idがnullでないかつ、Bookモデルのusersメソッドを呼び出しユーザーidが一致するbooksレコードを検索する
    public function sharingBook($userId)
    {
        $sharingBooks = Book::where('sharing_id != null') 
            ->whereHas('users', function($query) use ($userId) {
                $query->where('id', $userId);   
            })->get();
    }


    // 自身が要承認（＝被共有依頼中）の家計簿取得 ※sharing_idが非nullかつauthorize_idが非nullのauthorizer_idと$userId(認証済みユーザー)が一致する場合、被共有依頼のbookインスタンスを返す
    public function unapprovedBook($userId)
    {
        $unapprovedBook = Book::where('sharing_id != null')
        ->where('authorizer_id != null')
        ->get(); 

        if($unapprovedBook->id == $userId){
            return $unapprovedBook;
        } 
    }

      public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }



    
}
