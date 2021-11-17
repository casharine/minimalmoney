@extends('layouts.app')

<li>
    <h5><i class="fas fa-pencil-alt"></i> Main Input</h5>
</li>
{{-- フォームグループ開始 --}}
<form action="#.php" method="POST">
    <div class="row">
        <aside class="col-6">
            <input type="text" name="target_name" required placeholder="金額を入力">
        </aside>
        <aside class="col-6">
            <div class="row">
                <div class="container mt-4">
                    <div class='btn-toolbar' role="toolbar">
                        <div class="btn-group" role="group">
                            <div>
                                <button type="button"><i class="fas fa-carrot"></i></button>
                                <input type="submit" value="送信">
                            </div>
                            <button type="button" class="btn btn-primary">B</button>
                            <button type="button" class="btn btn-primary">C</button>
                        </div>
                    </div>
        </aside>
    </div>
    <div class="row">
        <div class="row">
            <aside class="col-6">
                <input type="text" name="target_name" required placeholder="日付を入力">
            </aside>
            <aside class="col-6">
                <div class="row">
                    <div class="container mt-4">
                        <div class='btn-toolbar' role="toolbar">
                            <div class="btn-group" role="group">
                                <div>
                                    <button type="button"><i class="fas fa-carrot"></i></button>
                                    <input type="submit" value="送信">
                                </div>
                                <button type="button" class="btn btn-primary">B</button>
                                <button type="button" class="btn btn-primary">C</button>
                            </div>
                        </div>
            </aside>
        </div>
</form>

@section('content')
<div class="row">
    <aside class="col-3">
        <div>
            <h4> {{ $user->name }}</h4>
        </div>
    </aside>
    <div class="col-9">
        <ul class="nav nav-tabs nav-justified mb-3">
            {{-- ユーザ詳細タブ --}}
            <li class="nav-item"><a href="#" class="nav-link">{{ $user->name }}　さんのシート一覧</a></li>
            {{-- フォロワー一覧タブ --}}
            <li class="nav-item"><a href="#" class="nav-link">シート共有者</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-6">
            {!! Form::model($transaction, ['route' => ['transactions.create', $transaction->id], 'method' => 'post'])
            !!}

            <div class="form-group">
                {!! Form::label('', '') !!}
                {!! Form::text('content', null, ['class' => 'form-control']) !!}
            </div>

            ['type', 'item', 'user_id', 'price', 'date', 'rate', 'note'];

            {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

    @endsection
    <div>

    </div>
</div>
@endsection