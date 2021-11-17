<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
use App\Sharing;


class SharingsController extends Controller
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
            // $sharings = Sharing::with('book')->get();
            
            // 定義できていない
                // $userId = $user->id;

                
            $data = [
                'user' => $user,
                'books' => $books,
                // 'sharings' => $sharings,
                // 定義できていない                
                // 'userId' => $userId,
            ];
            
            return view('sharings', $data);
        }else{
            return view('welcome');
        }
    }

    //ユーザーの帳簿を登録
    public function store(Request $request, int $id)
    {
        // インスタンスを取得
        $user = $request->user();
 
        // ユーザーのフォームリクエストとしてsharings_tableにレコードを追加
        Sharing::create([
            'user_id' => $user->id,
            'book_id' => $id,
        ]);
        
        // 前のURLへリダイレクトさせる
        return back();
    }

    public function destroy($id)
    {
        // idの値でブックを検索して取得
        $sharing = \App\Sharing::findOrFail($id);
        // 認証済みユーザ（閲覧者）がその帳簿の作成者である場合は、削除
        if (\Auth::id() === $sharing->user_id) {
            $sharing->delete();
 
        // 前のURLへリダイレクトさせる
        return back()->with('flash_message', '共有依頼を取り消しました。');

        }
    }




}

