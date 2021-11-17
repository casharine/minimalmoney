@extends('layouts.app')

@section('content')
    <div class="col-6">
        {!! Form::model($transaction, ['route' => ['transactions.create', $transaction->id], 'method' => 'post']) !!}

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

            {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
    </div>