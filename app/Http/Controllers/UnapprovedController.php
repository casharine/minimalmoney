<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Sharing;

class UnapprovedController extends Controller
{
    
    //承認した帳簿を登録 
    public function store(Request $request, int $id)
    {
        // ロールバックの整合性を保ため一連の処理とする
        DB::transaction(function () use($id) {

            // sharingsをeagar loadし$idを基にsharingインスタンスを取得する
            $sharing = Sharing::with(['sharingUser'])->find($id);

            // リレーションからuserインスタンスとbook_idを取得する
            $user = $sharing->sharingUser;
            $bookId = $sharing->book_id;
            
            // 取得したユーザにattachで中間テーブルのレコードを追加する
            $user->books()->attach($bookId);

            // Sharingsのレコードを削除する
            $sharing->delete();
        });

        return back();
    }


    // 却下
    public function destroy($id)
    {
        // idの値でブックを検索して取得
        $sharing = \App\Sharing::findOrFail($id);
        // 認証済みユーザ（閲覧者）がその帳簿の作成者である場合は、削除
            $sharing->delete();
        // 前のURLへリダイレクトさせる
        return back();
    }
}
