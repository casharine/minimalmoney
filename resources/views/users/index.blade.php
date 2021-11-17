@extends('layouts.app')

@section('content')

@if($users->count())
<div style="margin-top:50px;">
    <div class="col-sm-12">
        <div class="row">
            <aside class="col-8">
                <h5 class="font-weight-bold">検索結果</h5>
            </aside>
            <aside class="col-3">
                <button type="button" onClick="history.back()"><i
                        class="fas fa-arrow-alt-circle-left"></i>&nbsp;一覧へ戻る</button>
            </aside>
        </div>
        <div style="margin-top:25px;">
            <table class="table">
                <tr>
                    <th>ユーザー名</th>
                    <th>家計簿名</th>
                    <th>アクション</th>
                </tr>
                @foreach($users as $serchedUser)
                @foreach($serchedUser->books as $serchedBook)
                @if ($serchedUser->isYourBook($serchedBook->id))
                {{-- すでに自身の家計簿の場合はこのユーザーの保有する家計簿を表示 --}}
                <p>>>>除外（保有）：{{$serchedBook->name}}</p>
                {{-- 保有していない家計簿の場合 --}}
                @else
                <tr>
                    <td>{{$serchedUser->name}}</td>
                    <td>{{$serchedBook->name}}</td>
                    <td>
                        {{-- 共有申請ボタンのフォーム --}}
                        {!! Form::open(['url' => route('users\sharings.store', ['id' => $serchedBook->id]),
                        'method'
                        => 'post']) !!}
                        {!! Form::submit('家計簿共有を依頼する', ['class' => 'btn btn-primary btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endif
                @endforeach
                @endforeach
            </table>
            @else
            <p>該当するユーザー名はありません。</p>
            @endif
            @endsection