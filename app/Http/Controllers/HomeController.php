<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Book;
use App\Models\Sharing;
use App\Models\Transaction;



class HomeController extends Controller
{
    // クラスのプライベートメソッドでメソッド内部のフィールドを配列化し各メソッドに共有
    private function setCommonArray()
    {
        // Userインスタンスを取得
        $user = \Auth::user();
        
        // 関係するモデルの件数をロード ※これを先にチェックした方がDBアクセスが減る？
        // $user->loadBookCounts();
        
        // アクティブBookの取得＝使用する家計簿の取得
        $activeBook = $user->books()->where('active_flag', 't')->first();
        
        // アクティブ家計簿のNullチェック 
        $activeBookNull = $user->books()->where('active_flag', 't')->get()->isEmpty();

        return array(
            'user' => $user,
            'userId' => $user->id,
            'activeBook' => $activeBook,
            'activeBookNull' => $activeBookNull
        );
    }

    // メイン画面
    public function home()
    {
         // 共通で使用するフィールドを取得 ※変数を再定義するなど一度配列変数に戻す必要がある場合
        $array = $this->setCommonArray();

        $transactions = Transaction::all();

        return view('home.home', [
            'user' => $array['user'],
            'userID' => $array['userId'],
            'activeBook' => $array['activeBook'],
            'activeBookNull' =>  $array['activeBookNull'],
            'transactions' => $transactions,
            
        ]);
    }

    // 費目を家計簿に登録
    public function store(Request $request, int $id)
    {
        // ロールバックの整合性を保ため一連の処理とする
        DB::transaction(function () use($id) {

            // レコード追加に必要な変数を定義する
            $user = \Auth::user();
            $userId = $user->id;
            
        // nameの値があるとき
        if (Request::has('name')) {
            $name = Request::input('name');
        } else {
            $name = '名無し';
        }
        $age = Request::input('age');
        $gender = Request::input('gender');
        $favorite = Request::input('favorite');
        $body = Request::input('body');
        // job自体がないときは第2引数が返される
        $job = Request::input('job', '学生');
        return view('contact.confirm', compact('name', 'age', 'gender', 'favorite', 'body', 'job'));
    }

        });

        return back();
    }
}