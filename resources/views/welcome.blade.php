@extends('layouts.app')
@section('content')


{{-- transaction.main --}}
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
</div>

{{-- Output --}}
<div>
  <br>
  <div class="border-bottom" style="padding:0px;">
    <h5 class="font-weight-bold"><i class="fas fa-tv"></i> Output</h5>
  </div>
  <br>
  <h8 class="font-weight-bold"><i class="fas fa-money-check-alt"></i>　全体収支</h8>
  <table class="table table-sm table-bordered">
    <thead>
      <tr class="table-secondary">
        <th style=" width: 16.66%" class="text-center">予算総額</th>
        <th style="width: 16.66%" class="text-center">利用総額</th>
        <th style="width: 16.66%" class="text-center">損益</th>
        <th style="width: 16.66%" class="text-center">変動費</th>
        <th style="width: 16.66%" class="text-center">固定費</th>
        <th style="width: 16.66%" class="text-center">貯蓄総額</th>
      </tr>
    </thead>
    <tbody>
      <tr class="trow-dark">
        <td>
          <div class="text-right">01</div>
        </td>
        <td>
          <div class="text-right">01</div>
        </td>
        <td>
          <div class="text-right">01</div>
        </td>
        <td>
          <div class="text-right">01</div>
        </td>
        <td>
          <div class="text-right">01</div>
        </td>
        <td>
          <div class="text-right">01</div>
        </td>
      </tr>
    </tbody>
  </table>
  <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　食費</h8>
  <table class="table table-sm table-bordered">
    <thead>
      <tr class="table-secondary">
        <th style="width: 16.66%" class="text-center">予算額</th>
        <th style="width: 16.66%" class="text-center">利用額</th>
        <th style="width: 16.66%" class="text-center">残額</th>
        <th style="width: 16.66%" class="text-center">残日数</th>
        <th style="width: 16.66%" class="text-center">平均残高</th>
        <th style="width: 16.66%" class="text-center">損益見込</th>
      </tr>
    </thead>
    <tbody>
      <tr class="#">
        <td>
          <div class="text-right">01</div>
        </td>
        <td>
          <div class="text-right">02</div>
        </td>
        <td>
          <div class="text-right">03</div>
        </td>
        <td>
          <div class="text-right">04</div>
        </td>
        <td>
          <div class="text-right">05</div>
        </td>
        <td>
          <div class="text-right">06</div>
        </td>
      </tr>
      {{-- 内訳を三行目で表示する場合 --}}
      {{-- <tr class="table-secondary">
        <td class="#">
          <div class="text-center">
            <b>食材費</b>
          </div>
        </td>
        <td class="bg-white">
          <div class="text-right">02</div>
        </td>
        <td class="bg-white">
          <div class="text-right">03</div>
        </td>
        <td>
          <div class="text-center">
            <b>外食費</b>
          </div>
        </td>
        <td class="bg-white">
          <div class="text-right">05</div>
        </td>
        <td class="bg-white">
          <div class="text-right">06</div>
        </td>
      </tr>
    </tbody>
  </table> --}}
  {{-- 一行独立テーブル --}}
  <table class="table table-sm table-bordered">
    <thead>
      <tr>
        <th style="width: 16.66%" class="table-secondary">
          <div Class="text-center">食材費</div>
        </th>
        <th style="width: 16.66%" class="#">
          <div class="font-weight-normal">
            <div class="bg-white"></div>
            <div Class="text-right">1</div>
          </div>
        </th>
        <th style="width: 16.66%" class="#">
          <div class="font-weight-normal">
            <div Class="text-right">回</div>
          </div>
        </th>
        <th style="width: 16.66%" class="table-secondary">
          <div Class="text-center">外食費</div>
        </th>
        <th style="width: 16.66%" class="bg-white">
          <div class="font-weight-normal">
            <div Class="text-right">1</div>
          </div>
        </th>
        <th style="width: 16.66%" class="bg-white">
          <div class="font-weight-normal">
            <div Class="text-right">回</div>
          </div>
        </th>
      </tr>
    </thead>
  </table>
  {{-- 2テーブルaside --}}
  <div class="row">
    <aside class="col-2">
      <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　日用費</h8>
      <table class="table table-sm table-bordered">
        <thead>
          <tr class="table-info">
            <th style="width: 16.66%" class="text-center">予算額</th>
            <th style="width: 16.66%" class="text-center">利用額</th>
            <th style="width: 16.66%" class="text-center">残高</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-primary">
            <td>
              <div class="text-right">01</div>
            </td>
            <td>
              <div class="text-right">02</div>
            </td>
            <td>
              <div class="text-right">03</div>
            </td>
          </tr>
        </tbody>
      </table>
    </aside>
    <aside class="col-4">
      <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　交際費</h8>
      <div class="row">
        <table class="table table-sm table-bordered">
          <thead>
            <tr class="table-info">
              <th style="width: 16.66%" class="text-center">予算額</th>
              <th style="width: 16.66%" class="text-center">利用額</th>
              <th style="width: 16.66%" class="text-center">残高</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table-primary">
              <td>
                <div class="text-right">01</div>
              </td>
              <td>
                <div class="text-right">02</div>
              </td>
              <td>
                <div class="text-right">03</div>
              </td>
            </tr>
          </tbody>
        </table>
    </aside>
  </div>
  {{-- 2テーブルaside --}}
  <div class="row">
    <aside class="col-6">
      <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　養育費</h8>
      <table class="table table-sm table-bordered">
        <thead>
          <tr class="table-info">
            <th style="width: 16.66%" class="text-center">予算額</th>
            <th style="width: 16.66%" class="text-center">利用額</th>
            <th style="width: 16.66%" class="text-center">残高</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-primary">
            <td>
              <div class="text-right">01</div>
            </td>
            <td>
              <div class="text-right">02</div>
            </td>
            <td>
              <div class="text-right">03</div>
            </td>
          </tr>
        </tbody>
      </table>
    </aside>
    <aside class="col-6">
      <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　贅沢費</h8>
      <div class="row">
        <table class="table table-sm table-bordered">
          <thead>
            <tr class="table-info">
              <th style="width: 16.66%" class="text-center">予算額</th>
              <th style="width: 16.66%" class="text-center">利用額</th>
              <th style="width: 16.66%" class="text-center">残高</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table-primary">
              <td>
                <div class="text-right">01</div>
              </td>
              <td>
                <div class="text-right">02</div>
              </td>
              <td>
                <div class="text-right">03</div>
              </td>
            </tr>
          </tbody>
        </table>
    </aside>
  </div>
  {{-- 2テーブルaside --}}
  <div class="row">
    <aside class="col-6">
      <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　特別費</h8>
      <table class="table table-sm table-bordered">
        <thead>
          <tr class="table-info">
            <th style="width: 16.66%" class="text-center">予算額</th>
            <th style="width: 16.66%" class="text-center">利用額</th>
            <th style="width: 16.66%" class="text-center">残高</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-primary">
            <td>
              <div class="text-right">01</div>
            </td>
            <td>
              <div class="text-right">02</div>
            </td>
            <td>
              <div class="text-right">03</div>
            </td>
          </tr>
        </tbody>
      </table>
    </aside>
    <aside class="col-6">
      <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　雑費</h8>
      <div class="row">
        <table class="table table-sm table-bordered">
          <thead>
            <tr class="table-info">
              <th style="width: 16.66%" class="text-center">雑益</th>
              <th style="width: 16.66%" class="text-center">雑損</th>
              <th style="width: 16.66%" class="text-center">雑損益</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table-primary">
              <td>
                <div class="text-right">01</div>
              </td>
              <td>
                <div class="text-right">02</div>
              </td>
              <td>
                <div class="text-right">03</div>
              </td>
            </tr>
          </tbody>
        </table>
    </aside>
  </div>
  {{-- 2テーブルaside --}}
  <div class="row">
    <aside class="col-6">
      <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　家族通貨</h8>
      <table class="table table-sm table-bordered">
        <thead>
          <tr class="table-info">
            <th style="width: 16.66%" class="text-center">総計</th>
            <th style="width: 16.66%" class="text-center">$user1</th>
            <th style="width: 16.66%" class="text-center">$user2</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-primary">
            <td>
              <div class="text-right">01</div>
            </td>
            <td>
              <div class="text-right">02</div>
            </td>
            <td>
              <div class="text-right">03</div>
            </td>
          </tr>
        </tbody>
      </table>
    </aside>
    <aside class="col-6">
      <h8 class="font-weight-bold"><i class="fas fa-utensils"></i>　次月入金額</h8>
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
                <div class="text-right">01</div>
              </td>
              <td>
                <div class="text-right">02</div>
              </td>
              <td>
                <div class="text-right">03</div>
              </td>
            </tr>
          </tbody>
        </table>
    </aside>
  </div>





  @endsection