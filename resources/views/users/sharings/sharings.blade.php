@extends('layouts.app')

@section('content')

@include('users.statustabs')

@if ($sharingCounts > 0)

{{-- 認証済みユーザーの家計簿をそれぞれmyBookへ --}}
@foreach ($sharingBooks as $sharingBook)

<li class="media mb-3">
    <div class="media-body">
        <div class="border-bottom">
            <div class="py-2">
                {{-- 家計簿一覧 --}}
                家計簿名：<b>{{$sharingBook->name}}</b> &nbsp;
                <div class="custom-control-inline">
                    {{-- 帳簿削除ボタンのフォーム --}}
                    {{-- bookインスタンスの->id == sharings->books_id --}}
                    {!! Form::open(['url' => route('users\sharings.destroy', ['id' => $sharingBook->sharings[0]->id]),
                    'method'
                    => 'delete']) !!}
                    {!! Form::submit('共有依頼の取消', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                    &nbsp;
                </div>
                <div>
                    <span class="text-muted">承認者：{{$sharingBook->authorizeUser->name}} &nbsp; 依頼日時：
                        {{ $sharingBook->sharings[0]->created_at }}</span>
                </div>
            </div>
        </div>
    </div>
</li>
@endforeach
@else
<div class="py-5">
    <div class="px-3">
        <P>現在共有依頼申請中の家計簿はありません。</P>
    </div>
</div>
@endif
@endsection


<template></template>

<script>
    export default {};
</script>

<style></style>