@extends('layouts.app')

@section('content')

@include('users.statustabs')

@if ($unapprovedCounts > 0)
{{-- 認証済みユーザーの家計簿をそれぞれmyBookへ --}}
@foreach ($unapprovedBooks as $unapprovedBook)
{{-- それぞれの未承認書籍をそれぞれの被共有依頼中ユーザー毎に表示 --}}
@foreach ($unapprovedBook->sharings as $unapprovedBookSharing)
<li class="media mb-3">
    <div class="media-body">
        {{-- 家計簿一覧 --}}
        <div class="border-bottom">
            <div class="py-2">
                <div>
                    家計簿名：<b>{{$unapprovedBook->name}}</b> &nbsp;
                    <div class=" custom-control-inline">
                        &nbsp;
                        {{-- 帳簿承認ボタンのフォーム --}}
                        {!! Form::open(['url' => route('users\unapproved.store', ['id' => $unapprovedBookSharing->id]),
                        'method'
                        => 'post']) !!}
                        {!! Form::submit('家計簿共有の承認', ['class' => 'btn btn-primary btn-sm']) !!}
                        {!! Form::close() !!}
                        &nbsp;
                        {{-- 帳簿削除ボタンのフォーム --}}
                        {{-- 主キー以外も渡せる --}}
                        {!! Form::open(['url' => route('users\unapproved.destroy', ['id' =>
                        $unapprovedBookSharing->id]),
                        'method'=> 'delete']) !!}
                        {!! Form::submit('家計簿共有の却下', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div>
                        <span class="text-muted">依頼者：{{$unapprovedBookSharing->sharingUser->name}} &nbsp; 依頼日時：
                            {{ $unapprovedBookSharing->created_at }}</span>
                    </div>

                </div>
            </div>
        </div>
</li>
@endforeach
@endforeach
@else
<div class="py-5">
    <div class="px-3">
        <p>現在未承認の共有依頼はありません。</P>
    </div>
</div>
@endif
@endsection