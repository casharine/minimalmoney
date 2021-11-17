<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{   
    // 全て取得
    public function index() {
        $transactions = Transaction::all();
        return view('transaction.index', compact('transactions'));
    }
    
    // 詳細（個別）取得 
    public function detail($id) {
        $taransactions = Transaction::find($id);
        return view('transaction.detail', compact('transaction'));
    }

    // 編集表示
    public function edit(Request $request) {
        // このユーザーのアクティブシートのトランズアクションとして
        $request->user()->active_sheet()->transactions()->edit([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'item' => $request->item,
            'price' => $request->price,
            'date' => $request->date,
            'rate' => $request->rate,
            'note' => $request->note]);
        return view('transaction.edit', compact('user_id', 'type', 'item', 'price', 'date', 'rate', 'note'));
    }

    // 作成
    // TransactionRequestは下記のformRequestでバリデーションを参照。
    public function create(TransactionRequest $request) {
        // アクティブシートのトランズアクションとして
        $request->user()->active_sheet()->transactions()->create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'item' => $request->item,
            'price' => $request->price,
            'date' => $request->date,
            'rate' => $request->rate,
            'note' => $request->note]);
        Transaction::create(compact ('user_id', 'type', 'item', 'price', 'date', 'rate', 'note'));
        set_message('追加しました。');
        return redirect(route('transaction.index'));
    }
    //更新
    public function update(TransactionRequest $request, int $id) {
        $transaction = Transaction::findOrFail($id);
            $transaction->fill(['user_id' => $request->input('user_id')]);
            $transaction->fill(['type' => $request->input('type')]);
            $transaction->fill(['item' => $request->input('item')]);
            $transaction->fill(['price' => $request->input('price')]);
            $transaction->fill(['date' => $request->input('date')]);
            $transaction->fill(['rate' => $request->input('rate')]);
            $transaction->fill(['note' => $request->input('note')]);
            $transaction->save();
        set_message('修正しました。');
        return redirect(route('transaction.detail', ['id' => $id]));
    }
     //削除
    public function destroy($id) {
        $transaction = Transaction::findOrFail($id);
            $transaction->delete();
        set_message('削除しました。');
        return redirect(route('transaction.detail', ['id' => $id]));
    }
}
