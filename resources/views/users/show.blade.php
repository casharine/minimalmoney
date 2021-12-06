@extends('layouts.app')

@section('content')

{{-- ヘッドとタブ --}}
@include('users.statustabs')

{{-- 家計簿一覧 --}}
@include('users.books.books')
@if ($bookNull)
<div class="py-4">
    <div class="px-5">
        <font color="red">
            <b>！attention！<br>家計簿がありません。新規作成また共有依頼を行ってください。</b>
        </font>
        <br>
    </div>
</div>
@else
@endif
@if (Auth::id() == $user->id)
<div class="col-sm-12">
    <div class="row">
        <aside class="col-6">
            {{-- 新規作成フォーム --}}
            @include('users.books.form')
        </aside>
        <aside class="col-6">
            {{-- ユーザー検索フォーム --}}
            @include('users.serch.form')
        </aside>
    </div>
</div>
@endif
</div>
</div>
@endsection