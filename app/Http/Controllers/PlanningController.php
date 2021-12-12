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

class PlanningController extends Controller
{
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

    // planningビューへの基本メソッド
    public function planning()
    {
        // 共通で使用するフィールドを取得 ※変数を再定義するなど一度配列変数に戻す必要がある場合
        $array = $this->setCommonArray();
        $user = $array['user'];
        $activeBookNull = $array['activeBookNull'];

        if($activeBookNull){
            return view('planning.planning', [
            // 共通private array
            'user' => $array['user'],
            'activeBookNull' =>  $array['activeBookNull']
            ]);        
        }else{
            // 表示月を取得 ※追加機能以下のフィールドは削除する
            $date =  User::findOrFail($array['userId'])->date_selecter;
            // 表示月がNullの場合今月を表示する
            $today = Carbon::today();
            if($date == null){
                $date = $today;
                $user->date_selecter = $date;
                $user->save();
            }
            // プルダウン用変数 直近10年
            $years = [];
            for($i=0; $i<=10; $i++){
                    //  Carbonはmutable参照型なのでcopyを使用しTodayの値の上書きを防ぐ ※クロノスはimmutable値参照型
                $y = $today->copy()->subYears($i)->year;
                $years[$y] = $y;
            }
            // プルダウン用変数 直近12カ月
            $months = [];
            for($i=0; $i<=11; $i++){
                $m = $today->copy()->subMonths($i)->month;
                $months[$m] = $m;
            }
            // 予算合計の取得(費目&月&家計簿の全一致のみ)
            // 引数設定
            $activeBook = $array['activeBook'];
            $foreignKey ='planning_item_id';
            // HomeControllerでも共用するので配列で取得に変更
            $montlyPlanningsArray = $this->monthlyPlanningsToArray($foreignKey, $date, $activeBook->id);
            
            return view('planning.planning', [
                // 共通private array
                'array' => $array,
                 // 日付関連
                'date' => $date,
                'years' => $years,
                'months' => $months,
                // 予算合計関連
                'montlyPlanningsArray' => $montlyPlanningsArray,
            ]);
        }
    }

    // 表示予算入力の年月の指定（変更）
    public function dateSelecter(Request $request, int $id)
    {
        // ロールバックの整合性を保ため一連の処理とする
        DB::planning(function () use($request, $id) {
            $user = User::findOrFail($id);

            // date_Selecterをyymmdd型で更新する ※ddはダミーで11日を入れている
            $user->date_selecter = Carbon::parse("{$request->year}-{$request->month}-11");
            // $user->date_selecter = $request->year*10000 + $request->month*100 + 11;    

            $user->save();
        });
            return back();
    }

    // 予算を家計簿に登録
    public function store(Request $request, int $id)
    {
        // ロールバックの整合性を保ため一連の処理とする
        DB::planning(function () use($request, $id) {
            // レコード追加に必要な変数を定義する
            $user = \Auth::user();            
            Planning::create([
                'editor_id' => $user->id,
                'book_id' => $id,
                'price' => $request->price,
                'planning_item_id' => $request->item_id +1,  
                'date' => $request->date,
                'note' => $request->note,
            ]);
        });
        return back();
    }
}