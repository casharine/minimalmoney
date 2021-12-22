<?php

namespace App\Traits;
use App\Models\User;
use Carbon\Carbon;

trait DateProcessingsTrait
{
    public function dateProcessingsToArrayTrait($user){
        // 表示月を取得 ※追加機能以下のフィールドは削除する
        $dateSelector =  User::findOrFail($user->id)->date_selecter;

        // 表示月がNullの場合今月を表示する
        $today = Carbon::today();
        if($dateSelector == null){
            $dateSelector = $today;
            $user->date_selecter = $dateSelector;
            $user->save();
        }

        // 当月残日数の計算
        // $dateSelectoが今年の当月の場合は計算
        if($dateSelector->year==$today->year && $dateSelector->month==$today->month){
            $restOfDays = $dateSelector->daysInMonth-$today->day;
        }else{
        // それ以外の年月は残日数は0とする
        $restOfDays = 0;
        }        

        // プルダウン用変数 直近10年
        $yearsIndex = [];
        for($i=0; $i<=10; $i++){
        //  Carbonはmutable参照型なのでcopyを使用しTodayの値の上書きを防ぐ ※クロノスはimmutable値参照型
            $y = $today->copy()->subYears($i)->year;
            $yearsIndex[$y] = $y;
        }
        // プルダウン用変数 直近12カ月
        $monthsIndex = [];
        for($i=0; $i<=11; $i++){
            $m = $today->copy()->subMonths($i)->month;
            $monthsIndex[$m] = $m;
        }

        return array(
            'dateSelector' => $dateSelector,
            'restOfDays' => $restOfDays,
            'yearsIndex' => $yearsIndex,
            'monthsIndex' => $monthsIndex,
            'today' => $today,
        );
    }
}