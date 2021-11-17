{!! Form::open(['route' => 'users\books.store']) !!}
<div class="form-group">
    {!! Form::text('name', null, ['class' => 'form-control','placeholder' => '家計簿名を入力']) !!}
    {!! Form::submit('新しい家計簿の作成', ['class' => 'btn btn-primary btn-block']) !!}
</div>
{!! Form::close() !!}