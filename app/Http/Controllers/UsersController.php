<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User; 
use App\Models\Book;

class UsersController extends Controller
{  
    // クラスのプライベートメソッドでメソッド内部のフィールドを配列化し各タブのメソッドに共有
    private function setCommonArray()
    {
         // ユーザ一覧をidの降順で取得
        // $users = User::orderBy('id', 'desc')->paginate(10);
        
        // Userインスタンスを取得
        $user = \Auth::user();
        
        // 関係するモデルの件数をロード
        $user->loadBookCounts();
        
        // ユーザの家計簿一覧を作成日時の降順で取得
        $books = $user->books()->orderBy('created_at', 'desc')->get();

         // 共有依頼のnullチェック
        $bookNull = $books->isEmpty();

        // アクティブBookの取得＝使用する家計簿の取得
        $activeBook = $user->books()->where('active_flag', 't')->first();
        
        // アクティブ家計簿のNullチェック
        $activeBookNull = $user->books()->where('active_flag', 't')->get()->isEmpty();

        // eagar loadingでBookに記述されたsharings,authorizeUserのリレーションを取得し
        // そのsharingsリレーションからuser_idが一致するbooksインスタンスを取得する
        // eagar loading内$builderで第三者のBookインスタンス取得を未然に防止
        $sharingBooks = Book::with(['sharings' => function ($builder) {
            $builder->where('user_id', \Auth::id());
        }, 'authorizeUser'])
        ->whereHas('sharings', function($builder){
            $builder->where('user_id', \Auth::id());
        })->get();
        // eagarLodingの有無で下記のDDでリレーションの取得有無を確認した。
        // dd($sharingBooks);
        // dd($sharingBooks[0]->sharings);

        // 共有依頼のnullチェック
        $sharingNull = $sharingBooks->isEmpty();

        // sharingsのカウント
        if($sharingNull !=true){
            $sharingCounts = Book::with(['sharings' => function ($builder) {
                $builder->where('user_id', \Auth::id());
            }, 'authorizeUser'])
            ->whereHas('sharings', function($builder){
                $builder->where('user_id', \Auth::id());
            })->count();
        }else{
            $sharingCounts = 0;
        }

        // 未承認家計簿を取得 ※sharingsのbook_idがbooksテーブル内にあり、authorizer_idがAuth::idと合致するBookインスタンスを取得
        $unapprovedBooks = Book::with(['sharings' , 'authorizeUser'])
            ->where('authorizer_id', \Auth::id())
            ->has('sharings')->get();

        // 未承認書籍のnullチェック
        $unapprovedNull = $unapprovedBooks->isEmpty();

        // 未承認数を取得 ※$unapprovedBookで取得したBook[0]のリレーションsharingsの数を取得
        if($unapprovedNull != 'true'){
            $unapprovedCounts = Book::with(['sharings' , 'authorizeUser'])
                ->where('authorizer_id', \Auth::id())
                ->has('sharings')->first()->sharings->count();
        }else{
            $unapprovedCounts = 0;
        }

        return array(
            // 'users' => $users,
            'user' => $user,
            'userId' => $user->id,
            'books' => $books,
            'bookNull' => $bookNull,
            'activeBook' => $activeBook,
            'activeBookNull' => $activeBookNull,
            'sharingBooks' => $sharingBooks,
            'sharingCounts' => $sharingCounts,
            'unapprovedBooks' => $unapprovedBooks,
            'unapprovedCounts' => $unapprovedCounts,
        );
    } 

    // 自分の家計簿タブ用
    public function show()
    {
        // 共通で使用するフィールドを取得 ※変数を再定義するなど一度配列変数に戻す必要がある場合
        // $array = $this->setCommonArray();

        // return view('users.index', [
        //     'user' => $array['user'],
        //     'users' => $array['users'],
        //     'books' => $array['books'],
        //     'sharingBooks' =>  $array['sharingBooks'],
        //     'sharingCounts' => $array['sharingCounts'],

        // 共通フィールドを用いて表示 ※これだけで動作確認

        return view('users.show', $this->setCommonArray());
    }

    // 共有依頼申請タブ用
    public function sharings()
    {
        return view('users\sharings.sharings', $this->setCommonArray());
    }

    // 共有を承認タブ用
    public function unapproved()
    {
        return view('users\unapproved.unapproved', $this->setCommonArray());
    }

    // 家計簿の新規作成
    public function store(Request $request)
    {
                // バリデーション
        $request->validate([
            'name' => 'required|max:25', 
        ]);
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

    // 家計簿の共有依頼時の検索・結果表示用
    public function index(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25', 
        ]);
        // // 共通で使用するフィールドを取得 ※変数を再定義するなど一度配列変数に戻す必要がある場合
        $array = $this->setCommonArray();

        $name = $request->input("name");

        $query = User::query();

        // 名前で検索  ※whenメソッド：第一引数（条件節）がtrueの場合、第２引数でクエリを発行（コールバック）
        $query->when($name, function($query, $name) { 
            return $query->where('name', "LIKE", "%$name%"); 
        });

        $users = $query->get();

        return view('users.index', [
            'users' => $users,
            'name' => $name,
            'user' => $array['user'],
            'books' => $array['books'],
            'sharingBooks' =>  $array['sharingBooks'],
            'sharingCounts' => $array['sharingCounts'],
            'unapprovedBooks' =>  $array['unapprovedBooks'],
            'unapprovedCounts' => $array['unapprovedCounts'],
        ]);
    }

}