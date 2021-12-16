<?php

namespace App\Traits;
use App\Models\User;
use Carbon\Carbon;

trait DateProcessingsTrait
{
    public function dateProcessingsToArrayTrait($user){
        // 表示月を取得 ※追加機能以下のフィールドは削除する
        $date =  User::findOrFail($user->id)->date_selecter;

        // 表示月がNullの場合今月を表示する
        $today = Carbon::today();
        if($date == null){
            $date = $today;
            $user->date_selecter = $date;
            $user->save();
        }

        // 当月残日数の計算
        $restOfDays = $date->daysInMonth-$today->day;

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

        return array(
            'date' => $date,
            'restOfDays' => $restOfDays,
            'years' => $years,
            'months' => $months,
        );
    }
}