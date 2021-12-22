@extends('layouts.app')
@section('content')
{{-- ログイン済みの場合 --}}
@if (Auth::check())
{{-- 家計簿が選択されていない場合 --}}
@if ($array['activeBookNull'])
<br>
<div class="alert alert-danger" role="alert">
    <div class="text-center">
        <b>！attention！<br>ユーザー管理ページで使用する家計簿を選択して下さい。</b>
    </div>
</div>
<a class="btn btn-primary w-100" href={{route('users.show')}} role="button">ユーザー管理ページへ
</a>
<br>
<br>
{{-- 家計簿が選択されている場合 --}}
@else
<br>
{{-- transaction.main --}}
<div class="border-bottom" style="padding:0px;">
    <div>
        <h5 class="font-weight-bold">
            <font color="1e90ff">
                <i class="fas fa-pencil-alt"></i>
                家計簿をつける
            </font>
        </h5>
    </div>
</div>

{{--費目登録のフォーム --}}
<div class="custom-control-inline py-2">
    {!! Form::open(['url' => route('home.store', ['id' => $array['activeBook']->id]), 'method'
    => 'post']) !!}
    {{ Form::text('price', '', ['placeholder' => '金額を入力','style' => 'width:24%;'])}}
    {{ Form::date('date', '', ['placeholder' => '日付を入力','style' => 'width:24%;'])}}
    {{ Form::text('note', '', ['placeholder' => '任意の備考','style' => 'width:24%;'])}}
    {{-- 当初enumで実装した場合は第二引数をarray型にしarray('食材費'=>'食材費', '個別A'=>...)とvalueで直接文字列をpostした。 --}}
    {{-- 配列の場合0によりidがずれるため結局arrayを使用した --}}
    {{ Form::select('item'
    , array(1=>'食材費', 2 =>'外食費', 3=>'個別A', 4=>'個別B',5=>'日用費',
    6=>'交際費', 7=>'養育費', 8=>'贅沢費', 9=>'特別費', 10=>'雑益', 11=>'雑損',
    12=>'立替A', 13=>'立替B')
    , ''
    , ['placeholder' => '費目の選択','style' => 'width:25%;']
    ) }}
</div>
<br>
{!! Form::submit('家計簿に登録', ['class'=> 'btn btn-info btn-sm w-100']) !!}
{{ Form::close() }}
<br>
{{-- Output --}}
<br>
<br>
<div class="border-bottom" style="padding:0px;">
    <div>
        <h5 class="font-weight-bold">
            <font color="006400">
                <i class="fas fa-tv"></i>
                {{$dateProcessingsArray['dateSelector']->year}}年{{$dateProcessingsArray['dateSelector']->month}}月の家計簿『{{$array['activeBook']->name}}』
            </font>
        </h5>
    </div>
</div>
{{-- 表示月の選択 --}}
<div class="custom-control-inline py-2">
    {!! Form::open(['url' => route('home.dateSelector', ['id' => $array['userId']]), 'method'
    => 'get']) !!}
    {{ Form::select('year' , $dateProcessingsArray['yearsIndex']
    , $dateProcessingsArray['dateSelector']->year
    , ['style' => '#']
    ) }}
    年
    {{ Form::select('month' , $dateProcessingsArray['monthsIndex']
    , $dateProcessingsArray['dateSelector']->month
    , ['style' => '#']
    ) }}
    月に
    {!! Form::submit('表示年月を変更', ['class'=> 'btn btn-success btn-sm']) !!}
    {{ Form::close() }}
</div>
<br>
{{-- 出力画面 --}}
<h8 class="font-weight-bold">
    <font color="008b8b"><i class="fas fa-money-check-alt"></i>
        　全体収支</font>
</h8>
<table class="table table-sm table-bordered">
    <thead>
        <tr class="table-info">
            <th style=" width: 16.66%" class="text-center">
                <font color="191970">予算総額</font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">利用総額</font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">損益</font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">変動費</font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">固定費</font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">貯蓄総額</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-primary">
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['totalPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['totalPlanningSum']-$montlyTransactionsArray['totalTransactionsSum'])}}
                    </p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['variablePlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['fixedTotalPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['depositTotalPlanningSum'])}}</p>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<h6 class="font-weight-bold">
    <font color="008b8b"><i class="fas fa-utensils"></i>　食費</font>
</h6>
<table class="table table-sm table-bordered">
    <thead>
        <tr class="table-info">
            <th style="width: 16.66%" class="text-center">
                <font color="191970">
                    <font color="191970">予算額</font>
                </font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">利用額</font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">残高</font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">残日数</font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">平均残高</font>
            </th>
            <th style="width: 16.66%" class="text-center">
                <font color="191970">損益見込</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-primary">
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['foodPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyTransactionsArray['foodTransactionsSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['foodPlanningSum']-$montlyTransactionsArray['foodTransactionsSum'])}}
                    </p>
                </div>
            </td>
            <td>
                <div class="text-right">
                    <p style="display:inline">
                        {{$dateProcessingsArray['restOfDays']}}日</p>
                </div>
            </td>
            <td>
                {{-- 残日数によるゼロ除算 --}}
                <div class="text-right">
                    @if($dateProcessingsArray['restOfDays']==0)
                    <p style="display:inline">{{number_format(0)}}日</p>
                    @else
                    <p style="display:inline">&yen;
                        {{number_format(($montlyPlanningsArray['foodPlanningSum']-$montlyTransactionsArray['foodTransactionsSum'])/($dateProcessingsArray['restOfDays']))}}
                    </p>
                    @endif
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format(($montlyPlanningsArray['foodPlanningSum']-$montlyTransactionsArray['foodTransactionsSum'])-$montlyPlanningsArray['foodForEachDayPlanning']*$dateProcessingsArray['restOfDays'])}}
                    </p>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<h6 class="font-weight-bold">
    <font color="008b8b"><i class="fas fa-utensils"></i>　食費内訳 &nbsp;
        <button onclick="$('#example-5').collapse('show')">&nbsp;表示&nbsp;</button>
        <button onclick="$('#example-5').collapse('hide')">&nbsp;非表示&nbsp;</button>
    </font>
</h6>
<div class="collapse" id="example-5">
    <div class="card card-body">

        {{-- 食費内訳 --}}
        <div class="px-4">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th style="width: 16.66%" class="table-info">
                            <div Class="text-center">
                                <font color="191970">食材費</font>
                            </div>
                        </th>
                        <th style="width: 16.66%" class="table-primary">
                            <div class="font-weight-normal">
                                <div class="text-right">&yen;<p style="display:inline">
                                        {{number_format($montlyTransactionsArray['ingredientsTransactionsSum'])}}</p>
                                </div>
                            </div>
                        </th>
                        <th style="width: 16.66%" class="table-primary">
                            <div class="font-weight-normal">
                                <div class="text-right">
                                    {{-- 食材費率のゼロ除算の回避 --}}
                                    @if($montlyTransactionsArray['ingredientsTransactionsSum']==0 and
                                    $montlyTransactionsArray['eatoutTransactionsSum']==0)
                                    <p style="display:inline">{{number_format(0)}}%</p>
                                    @else
                                    <p style="display:inline">
                                        {{number_format($montlyTransactionsArray['eatoutTransactionsSum'])/($montlyTransactionsArray['ingredientsTransactionsSum']+$montlyTransactionsArray['eatoutTransactionsSum'])*100}}
                                    </p>&#037;
                                    @endif
                                </div>
                            </div>
                        </th>
                        <th style="width: 16.66%" class="table-info">
                            <div Class="text-center">
                                <font color="191970">外食費</font>
                            </div>
                        </th>
                        <th style="width: 16.66%" class="table-primary">
                            <div class="font-weight-normal">
                                <div class="text-right">&yen;<p style="display:inline">
                                        {{number_format($montlyTransactionsArray['eatoutTransactionsSum'])}}</p>
                                </div>
                            </div>
                        </th>
                        <th style="width: 16.66%" class="table-primary">
                            <div class="font-weight-normal">
                                <div class="text-right">
                                    {{-- 食材費率のゼロ除算の回避 --}}
                                    @if($montlyTransactionsArray['ingredientsTransactionsSum']==0 and
                                    $montlyTransactionsArray['eatoutTransactionsSum']==0)
                                    <p style="display:inline">{{number_format(0)}}%</p>
                                    @else
                                    <p style="display:inline">
                                        {{number_format($montlyTransactionsArray['eatoutTransactionsSum'])/($montlyTransactionsArray['ingredientsTransactionsSum']+$montlyTransactionsArray['eatoutTransactionsSum'])*100}}
                                    </p>&#037;
                                    @endif
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
            <h8 class="font-weight-bold">
                <font color="008b8b"><i class="fas fa-utensils"></i>　個別A
                </font>
            </h8>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="table-info">
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">予算額</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">利用額</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">残高</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">残日数</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">平均残高</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">損益見込</font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-primary">
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyPlanningsArray['eachAPlanningSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['eachATransactionsSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyPlanningsArray['eachAPlanningSum']-$montlyTransactionsArray['eachATransactionsSum'])}}
                                </p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">
                                <p style="display:inline">
                                    {{$dateProcessingsArray['restOfDays']}}日</p>
                            </div>
                        </td>
                        <td>
                            {{-- 残日数によるゼロ除算 --}}
                            <div class="text-right">
                                @if($dateProcessingsArray['restOfDays']==0)
                                <p style="display:inline">{{number_format(0)}}日</p>
                                @else
                                <p style="display:inline">&yen;
                                    {{number_format(($montlyPlanningsArray['eachAPlanningSum']-$montlyTransactionsArray['eachATransactionsSum'])/($dateProcessingsArray['restOfDays']))}}
                                </p>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format(($montlyPlanningsArray['eachAPlanningSum']-$montlyTransactionsArray['eachATransactionsSum'])-$montlyPlanningsArray['foodForEachDayPlanning']*$dateProcessingsArray['restOfDays'])}}
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h6 class="font-weight-bold">
                <font color="008b8b"><i class="fas fa-utensils"></i>　個別B</font>
            </h6>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="table-info">
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">予算額</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">利用額</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">残高</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">残日数</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">平均残高</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">損益見込</font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-primary">
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyPlanningsArray['eachBPlanningSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['eachBTransactionsSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyPlanningsArray['eachBPlanningSum']-$montlyTransactionsArray['eachBTransactionsSum'])}}
                                </p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">
                                <p style="display:inline">
                                    {{$dateProcessingsArray['restOfDays']}}日</p>
                            </div>
                        </td>
                        <td>
                            {{-- 残日数によるゼロ除算 --}}
                            <div class="text-right">
                                @if($dateProcessingsArray['restOfDays']==0)
                                <p style="display:inline">{{number_format(0)}}日</p>
                                @else
                                <p style="display:inline">&yen;
                                    {{number_format(($montlyPlanningsArray['eachBPlanningSum']-$montlyTransactionsArray['eachBTransactionsSum'])/($dateProcessingsArray['restOfDays']))}}
                                </p>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format(($montlyPlanningsArray['eachBPlanningSum']-$montlyTransactionsArray['eachBTransactionsSum'])-$montlyPlanningsArray['foodForEachDayPlanning']*$dateProcessingsArray['restOfDays'])}}
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
        </div>
    </div>
    </table>
</div>
</div>
</div>
<br>
{{-- 2テーブルaside --}}
<div class="row">
    <aside class="col-6">
        <h8 class="font-weight-bold">
            <font color="008b8b"><i class="fas fa-utensils"></i>　日用費</font>
        </h8>
        <table class="table table-sm table-bordered">
            <thead>
                <tr class="table-info">
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">予算額</font>
                    </th>
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">利用額</font>
                    </th>
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">残高</font>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-primary">
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['dailyTransactionsSum'])}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </aside>
    <aside class="col-6">
        <h8 class="font-weight-bold">
            <font color="008b8b"><i class="fas fa-utensils"></i>　交際費</font>
        </h8>
        <div class="row">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="table-info">
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">予算額</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">利用額</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">残高</font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-primary">
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['entertainmentTransactionsSum'])}}
                                </p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </aside>
</div>
{{-- 2テーブルaside --}}
<div class="row">
    <aside class="col-6">
        <h8 class="font-weight-bold">
            <font color="008b8b"><i class="fas fa-utensils"></i>　養育費</font>
        </h8>
        <table class="table table-sm table-bordered">
            <thead>
                <tr class="table-info">
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">予算額</font>
                    </th>
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">利用額</font>
                    </th>
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">残高</font>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-primary">
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['childrenTransactionsSum'])}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </aside>
    <aside class="col-6">
        <h8 class="font-weight-bold">
            <font color="008b8b"><i class="fas fa-utensils"></i>
                贅沢費</font>
        </h8>
        <div class="row">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="table-info">
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">予算額</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">利用額</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">残高</font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-primary">
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['luxuryTransactionsSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </aside>
</div>
{{-- 2テーブルaside --}}
<div class="row">
    <aside class="col-6">
        <h8 class="font-weight-bold">
            <font color="008b8b"><i class="fas fa-utensils"></i>　特別費</font>
        </h8>
        <table class="table table-sm table-bordered">
            <thead>
                <tr class="table-info">
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">予算額</font>
                    </th>
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">利用額</font>
                    </th>
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">残高</font>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-primary">
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['specialTransactionsSum'])}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </aside>
    <aside class="col-6">
        <h8 class="font-weight-bold">
            <font color="008b8b"><i class="fas fa-utensils"></i>　雑費</font>
        </h8>
        <div class="row">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="table-info">
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">雑益</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">雑損</font>
                        </th>
                        <th style="width: 16.66%" class="text-center">
                            <font color="191970">雑損益</font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-primary">
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['profitsTransactionsSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['lossTransactionsSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['profitsTransactionsSum'] -
                                    $montlyTransactionsArray['lossTransactionsSum'])}}</p>
                            </div>
                        </td>
                </tbody>
            </table>
        </div>
    </aside>
</div>
{{-- 2テーブルaside --}}
<div class="row">
    <aside class="col-6">
        <h8 class="font-weight-bold">
            <font color="008b8b"><i class="fas fa-utensils">
                </i>　家族通貨</font>
        </h8>
        <table class="table table-sm table-bordered">
            <thead>
                <tr class="table-info">
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">総計</font>
                    </th>
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">立替A</font>
                    </th>
                    <th style="width: 16.66%" class="text-center">
                        <font color="191970">立替B</font>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-primary">
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['advanceATransactionsSum']+$montlyTransactionsArray['advanceBTransactionsSum'])}}
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['advanceATransactionsSum'])}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="text-right">&yen;<p style="display:inline">
                                {{number_format($montlyTransactionsArray['advanceBTransactionsSum'])}}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </aside>
    <aside class="col-6">
        {{-- 初版では実装しない --}}
        {{-- <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　次月入金額</h8>
        <div class="row">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="table-info">
                        <th style="width: 16.66%" class="text-center">総入金額</th>
                        <th style="width: 16.66%" class="text-center">$user1</th>
                        <th style="width: 16.66%" class="text-center">$user2</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-primary">
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>02
                            </div>
                        </td>
                        <td>
                            <div class="text-right">&yen;<p style="display:inline">
                                    {{number_format($montlyTransactionsArray['totalTransactionsSum'])}}</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
    </aside>
</div>
<br>
<br>

</div>
@endif
{{-- ログインしていない場合 --}}
@else
<div class="center jumbotron">
    <div class="text-center">
        {{-- ユーザ登録ページへのリンク --}}
        <img class="d-block img-fluid w-50 mx-auto rounded" src="images/logo_minimalmoney.jpg">
        <br>
        <a class="btn btn-primary" href={{route('signup.get')}} role="button">Sign up
        </a>
        <a class="btn btn-primary" href={{route('login')}} role="button">&nbsp;&nbsp;Login&nbsp;&nbsp;
        </a>
    </div>
</div>

@endif
@endsection