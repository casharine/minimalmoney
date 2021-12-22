<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use Illuminate\Http\Request;
use App\Traits\MonthlyItemsSumTrait;
use App\Models\Planning;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PlanningItem;
use App\Traits\DateProcessingsTrait;

class PlanningController extends Controller
{
    use MonthlyItemsSumTrait;
    use DateProcessingsTrait;

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

    // planningビューへの基本メソッド
    public function planning()
    {
        // 初期処理
        // クラス共通配列の受取
        $array = $this->setCommonArray();
        $user = $array['user'];
        $activeBookNull = $array['activeBookNull'];
        $activeBook = $array['activeBook'];

        if($activeBookNull){
            return view('home.home', [
                'array' => $array,            
            ]);       
        }else{
             // 日付関連処理を受取
            $dateProcessingsArray = $this->dateProcessingsToArrayTrait($user);
            $dateSelector = $dateProcessingsArray['dateSelector'];
            
            // 予算合計の取得(費目&月&家計簿の全一致のみ)
            // 引数設定
            $activeBook = $array['activeBook'];
            $foreignKey ='planning_item_id';
            // HomeControllerでも共用するので配列で取得に変更
            $montlyPlanningsArray = $this->monthlyPlanningsToArrayTrait($foreignKey, $dateSelector, $activeBook->id);
            
            return view('planning.planning', [
                // 共通private array
                'array' => $array,
                 // 日付関連
                'dateProcessingsArray' => $dateProcessingsArray,
                // 予算合計関連
                'montlyPlanningsArray' => $montlyPlanningsArray,
            ]);
        }
    }

    // 予算を家計簿に登録
    public function store(Request $request, int $id)
    {
        // ロールバックの整合性を保ため一連の処理とする
        DB::transaction(function () use($request, $id) {
            // レコード追加に必要な変数を定義する
            $user = \Auth::user();        
            Planning::create([
                'editor_id' => $user->id,
                'book_id' => $id,
                'price' => $request->price,
                'planning_item_id' => $request->item,  
                'date' => $user->date_selecter, 
                'note' => $request->note,
            ]);
        });
        return back();
    }
}