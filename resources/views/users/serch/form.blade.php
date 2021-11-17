{!! Form::open(['route' => 'users.index']) !!}
<div class="form-group">
    {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'ユーザー名を入力']) !!}
    {!! Form::submit('家計簿の共有を依頼', ['class' => 'btn btn-primary btn-block']) !!}
</div>
{!! Form::close() !!}