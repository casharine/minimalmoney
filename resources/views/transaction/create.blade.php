@extends('layouts.app')

@section('content')

    <h1>メッセージ新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($message, ['route' => 'transactions.store']) !!}

                <div class="form-group">
                    {!! Form::label('type', 'タイプ') !!}
                    {!! Form::text('type', null, ['class' => 'form-control']) !!
                    {!! Form::label('item', 'アイテム') !!}
                    {!! Form::text('item', null, ['class' => 'form-control']) !!
                    {!! Form::label('use_id', 'ユーザーid') !!}
                    {!! Form::text('user_id', null, ['class' => 'form-control']) !!
                    {!! Form::label('price', '金額') !!}
                    {!! Form::text('price', null, ['class' => 'form-control']) !!
                    {!! Form::label('date', '日時') !!}
                    {!! Form::text('date', null, ['class' => 'form-control']) !!
                    {!! Form::label('rate', '割合') !!}
                    {!! Form::text('rate', null, ['class' => 'form-control']) !!
                    {!! Form::label('note', 'ノート') !!}
                    {!! Form::text('note', null, ['class' => 'form-control']) !!
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection