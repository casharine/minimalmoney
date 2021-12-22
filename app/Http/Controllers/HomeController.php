<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Transaction;
use App\Models\Planning;
use App\Traits\DateProcessingsTrait;
use App\Traits\MonthlyItemsSumTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    // 日付関連の処理
    use DateProcessingsTrait;
    // 月次費目毎の取得・計算
    use MonthlyItemsSumTrait;

    // クラスのプライベートメソッドでメソッド内部のフィールドを配列化し各メソッドに共有
    private function setCommonArray()
    {
        // Userインスタンスを取得
        $user = \Auth::user();
        
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
        // 初期処理
        // クラス共通配列の受取
        $array = $this->setCommonArray();
        $user = $array['user'];
        $activeBookNull = $array['activeBookNull'];
        $activeBook = $array['activeBook'];

        // 家計簿選択されていない場合選択を依頼  
        if($activeBookNull){
            return view('home.home', [
                'array' => $array,            
            ]);        
        }else{
            // 日付関連処理を受取
            $dateProcessingsArray = $this->dateProcessingsToArrayTrait($user);
            $dateSelector  = $dateProcessingsArray['dateSelector'];

            // 各費目利用額を受取
            $transaction = new Transaction;
            $foreignKey = 'transaction_item_id';
            $montlyTransactionsArray = $transaction->monthlyTransactionsToArrayTrait($foreignKey, $dateSelector , $activeBook->id);

            // 各費目予算を配列で受け取り
            $planning = new Planning;
            $tableItemId = 'planning_item_id';
            $montlyPlanningsArray = $planning->monthlyPlanningsToArrayTrait($tableItemId, $dateSelector , $activeBook->id);

            return view('home.home', [
                // クラス共通
                'array' => $array,
                // 日付関連
                'dateProcessingsArray' => $dateProcessingsArray,
                // 予算合計計算関連
                'montlyPlanningsArray' => $montlyPlanningsArray,
                // 費用合計関連
                'montlyTransactionsArray' => $montlyTransactionsArray,
            ]);
        }
    }

    // 表示家計簿の年月の指定（変更）
    public function dateSelector(Request $request, int $id)
    {
        // ロールバックの整合性を保ため一連の処理とする
        DB::transaction(function () use($request, $id) {
            $user = User::findOrFail($id);

            // date_Selecterをyymmdd型で更新する ※ダミーで11日を挿入
            $user->date_selecter = Carbon::parse("{$request->year}-{$request->month}-11");
            // $user->date_selecter = $request->year*10000 + $request->month*100 + 11;    

            $user->save();
        });
            return back();
    }

    // 費目を家計簿に登録
    public function store(Request $request, int $id)
    {
                // バリデーション
        $request->validate([
            'price' => 'required|max:7',
            'item' => 'required',
            'note' => 'nullable|max50',
            'date' => 'required|date', 
        ]);
        // ロールバックの整合性を保ため一連の処理とする
        DB::transaction(function () use($request, $id) {
            // レコード追加に必要な変数を定義する
            $user = \Auth::user();
            Transaction::create(
                [
                'editor_id' => $user->id,
                'book_id' => $id,
                'price' => $request->price,
                'transaction_item_id' => $request->item,  
                'date' => $request->date, //カレンダー入力
                'note' => $request->note,
            ]);
        });
        return back();
    }
}