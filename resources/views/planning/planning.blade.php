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
{{-- planning.main --}}
<div class="border-bottom" style="padding:0px;">
    <h5 class="font-weight-bold">
        <font color="brown">
            <i class="fas fa-file-invoice-dollar"></i>
            予算を追加する
        </font>
    </h5>
</div>
{{-- 表示編集月の選択 --}}
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
    月
    {!! Form::submit('編集年月を変更', ['class'=> 'btn btn-success btn-sm']) !!}
    {{ Form::close() }}
</div>

{{--予算の登録のフォーム --}}
<div class="custom-control-inline py-2">
    {!! Form::open(['url' => route('planning.store', ['id' => $array['activeBook']->id]), 'method'
    => 'post']) !!}
    {{ Form::text('price', '', ['placeholder' => '金額を入力','style' => 'width:33%;'])}}
    {{ Form::select('item'
    , array(1=>'食材費', 2=>'外食費', 3=>'個別A', 4=>'個別B',5=>'日用費',
    6=>'交際費', 7=>'養育費', 8=>'贅沢費', 9=>'特別費', 10=>'家賃', 11=>'他固定費',
    12=>'小遣いA', 13=>'小遣いB', 14=>'普通預金', 15=>'中期預金', 16=>'長期預金', 17=>'養育預金', 18=>'国債', 19=>'株')
    , ''
    , ['placeholder' => '費目の選択','style' => 'width:33%;']
    ) }}

    {!! Form::submit('予算を登録', ['class'=> 'btn btn-success btn-sm w-25']) !!}
    {{ Form::close() }}
</div>

{{-- Output --}}
<br>
<br>
<div class="border-bottom" style="padding:0px;">
    <div>
        <h5 class="font-weight-bold">
            <font color="006400">
                <i class="fas fa-tv"></i>
                {{$dateProcessingsArray['dateSelector']->year}}年{{$dateProcessingsArray['dateSelector']->month}}月の予算一覧
                家計簿名『{{$array['activeBook']->name}}』
            </font>
        </h5>
    </div>
</div>
<br>
{{-- 出力画面 --}}
<h6 class="font-weight-bold">
    <font color="k03400">予算総額：￥<p style="display:inline">{{number_format($montlyPlanningsArray['totalPlanningSum'])}}
        </p>
    </font>
</h6>
<br>
<h6 class="font-weight-bold"><i class="fas fa-money-check-alt"></i>　流動費</h6>
<table class="table table-sm table-bordered">
    <thead>
        <tr class="table-info">
            <th style=" width: 16.66%" class="text-center">食費計</th>
            <th style="width: 16.66%" class="text-center">食材費</th>
            <th style="width: 16.66%" class="text-center">外食費</th>
            <th style="width: 16.66%" class="text-center">個別A</th>
            <th style="width: 16.66%" class="text-center">個別B</th>
            <th style="width: 16.66%" class="text-center">日当り</th>
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
                        {{number_format($montlyPlanningsArray['ingredientsPlanningSum'])}}</p>
                </div>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['eatoutPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['eachAPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['eachBPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['foodForEachDayPlanning'])}}</p>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-sm table-bordered">
    <thead>
        <tr class="table-info">
            <th style="width: 16.66%" class="text-center">変動費計</th>
            <th style=" width: 16.66%" class="text-center">日用費</th>
            <th style="width: 16.66%" class="text-center">交際費</th>
            <th style="width: 16.66%" class="text-center">養育費</th>
            <th style="width: 16.66%" class="text-center">贅沢費</th>
            <th style="width: 16.66%" class="text-center">特別費</th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-primary">
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['variablePlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['dailyPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['entertainmentPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['childrenPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['luxuryPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['specialPlanningSum'])}}</p>
                </div>
            </td>
        </tr>
    </tbody>
</table>

<h6 class="font-weight-bold"><i class="fas fa-money-check-alt"></i>　固定費</h6>
<table class="table table-sm table-bordered">
    <thead>
        <tr class="table-info">
            <th style="width: 16.66%" class="text-center">固定費計</th>
            <th style="width: 16.66%" class="text-center">家賃</th>
            <th style="width: 16.66%" class="text-center">他固定費</th>
            <th style="width: 16.66%" class="text-center">小遣いA</th>
            <th style="width: 16.66%" class="text-center">小遣いB</th>
            <th style="width: 16.66%" class="text-center">小遣い計</th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-primary">
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['fixedTotalPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['rentPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['fixedPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['pocketAPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['pocketBPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['pocketPlanningSum'])}}</p>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<h6 class="font-weight-bold"><i class="fas fa-money-check-alt"></i>　貯蓄</h6>
<table class="table table-sm table-bordered">
    <thead>
        <tr class="table-info">
            <th style=" width: 16.66%" class="text-center">貯蓄計</th>
            <th style="width: 16.66%" class="text-center">普通預金</th>
            <th style="width: 16.66%" class="text-center">中期預金</th>
            <th style="width: 16.66%" class="text-center">長期預金</th>
            <th style="width: 16.66%" class="text-center">養育貯金</th>
            <th style="width: 16.66%" class="text-center">株・国債</th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-primary">
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['depositTotalPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['normalDepositPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['middleDepositPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['longDepositPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['childrenDepositPlanningSum'])}}</p>
                </div>
            </td>
            <td>
                <div class="text-right">&yen;<p style="display:inline">
                        {{number_format($montlyPlanningsArray['investimentTotalPlanningSum'])}}</p>
                </div>
            </td>
        </tr>
    </tbody>
</table>
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