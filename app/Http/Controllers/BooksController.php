<?php

namespace App\Http\Controllers;

use Dotenv\Loader\Loader;
use Illuminate\Http\Request;
use App\Book;
use App\User;
use App\Sharing;

use function Symfony\Component\Translation\t;

class BooksController extends Controller
{
    //ユーザーの帳簿の取得
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの帳簿の一覧を作成日時の降順で取得
            $books = $user->books;
            
            // 定義できていない
                // $userId = $user->id;

                
            $data = [
                'user' => $user,
                'books' => $books,
                // 定義できていない                
                // 'userId' => $userId,
            ];
            
            return view('welcome', $data);
        }else{
            return view('welcome');
        }
    }

    //ユーザーの帳簿を登録
    public function store(Request $request)
    {
        // インスタンスを取得
        $user = $request->user();
        // ユーザーのbooksのリレーション数をロードした結果1以上の場合はtrueを返す
        $hasBook = $user->loadCount('books')->books_count >= 1;
        
        if($hasBook){
            $active_flag = false;
        } else{
            $active_flag = true;
        }
        // ユーザーのフォームリクエストとしてbooks_tableにレコードを追加
        $request->user()->books()->create([
            'user_id' => $user->id,
            'name' => $request->name,
            'active_flag' => $active_flag,
            'authorizer_id' => $user->id,
        ]);
        // 前のURLへリダイレクトさせる
        return back();
    }

    public function activeSwitch(Request $request, int $id)
    {
        // ユーザーの取得
        $userId = \Auth::user()->id;
        // ユーザーの家計簿一覧を取得
        // $books =  $user->books;
        
        
        // ユーザーのアクティブフラグを削除
        Book::with(['users'])
            ->where('active_flag', "t")
            ->whereHas('users', function($builder){
                $builder->where('user_id', \Auth::id());
                })->update([
                    'active_flag' => 'f',
        ]);

        Book::with(['users'])
            ->where('id', $id)
            ->whereHas('users', function($builder){
                $builder->where('user_id', \Auth::id());
                })->update([
                    'active_flag' => 't',
        ]);

        return back();

        // $books->where('active_flag', 't')


        // Book::$user->books()->where('active_flag', 't')->update([
        // 'active_flag' => 'f',
        // ]);

        // // myBookidのアクティブフラグを変更 ※クエリ発行する
        // Book::$user->books()->where('active_flag', $id)->update([
        // 'active_flag' => 't',

    }




    public function destroy($id)
    {
        // idの値でブックを検索して取得
        $book = \App\Book::findOrFail($id);
        // 認証済みユーザ（閲覧者）がその帳簿の作成者である場合は、削除
        if (\Auth::id() === $book->authorizer_id) {
            $book->delete();
        }
        // 前のURLへリダイレクトさせる
        return back();
    }

}