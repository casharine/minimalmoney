@if ($bookNull)
@else
@if($activeBookNull)
<ul class="list-unstyled">
    {{-- 認証済みユーザーの家計簿をそれぞれmyBookへ --}}
    @foreach ($user->books as $myBook)
    <li class="media mb-3">
        <div class="media-body">
            {{-- 家計簿一覧 --}}
            <div class="border-bottom">
                <div class="py-2">
                    家計簿名：<b>{{$myBook->name}}</b> &nbsp;
                    {{-- リファクタリング
                    authorize_idでUserインスタンスを取得 == myBookの作成者
                    $authorizer = \App\User::findOrFail($myBook->authorizer_id);
                    $authorizerName = $authorizer->name;
                    --}}
                    <div class=" custom-control-inline">
                        {{-- 非アクティブの場合アクティブに変更ボタン --}}
                        @if ($activeBookNull)
                        &nbsp;
                        {!! Form::open(['url' => route('users\books.activeSwitch', ['id' => $myBook->id]), 'method'
                        =>
                        'post'])
                        !!}
                        {!! Form::submit('この家計簿を使用する', ['class' => 'btn btn-info btn-sm']) !!}
                        {!! Form::close() !!}
                        &nbsp;
                        @endif
                        {{-- 作成者の場合削除 --}}
                        @if (Auth::id() == $myBook->authorizer_id)
                        {{-- 帳簿削除ボタンのフォーム --}}
                        &nbsp;
                        {!! Form::open(['url' => route('users\books.destroy', ['id' => $myBook->id]), 'method' =>
                        'delete'])
                        !!}
                        {!! Form::submit('この家計簿を削除する', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                        @endif
                    </div>
                    <br>
                    <div>
                        <span class=" text-muted">作成者：{{$myBook->authorizeUser->name}} &nbsp; 作成日時：
                            {{ $myBook->created_at }}</span>
                    </div>
                </div>
            </div>
            {{-- 未承認一覧 --}}
            {{-- 未承認一覧
            {{ $unapprovedBook = $myBook->unapprovedBook($userId)}}
            {{dd($unapprovedBook) }} --}}
        </div>
    </li>
    @endforeach
    @else
    <ul class="list-unstyled">
        {{-- 認証済みユーザーの家計簿をそれぞれmyBookへ --}}
        @foreach ($user->books as $myBook)
        <li class="media mb-3">
            <div class="media-body">
                {{-- 家計簿一覧 --}}
                <div class="border-bottom">
                    <div class="py-2">
                        家計簿名：<b>{{$myBook->name}}</b> &nbsp;
                        {{-- リファクタリング
                        authorize_idでUserインスタンスを取得 == myBookの作成者
                        $authorizer = \App\User::findOrFail($myBook->authorizer_id);
                        $authorizerName = $authorizer->name;
                        --}}
                        <div class=" custom-control-inline">
                            {{-- 非アクティブの場合アクティブに変更ボタン --}}
                            @if ($activeBook->id != $myBook->id)
                            &nbsp;
                            {!! Form::open(['url' => route('users\books.activeSwitch', ['id' => $myBook->id]),
                            'method'
                            =>
                            'post'])
                            !!}
                            {!! Form::submit('この家計簿を使用する', ['class' => 'btn btn-info btn-sm']) !!}
                            {!! Form::close() !!}
                            &nbsp;
                            @endif
                            {{-- 作成者の場合削除 --}}
                            @if (Auth::id() == $myBook->authorizer_id)
                            {{-- 帳簿削除ボタンのフォーム --}}
                            &nbsp;
                            {!! Form::open(['url' => route('users\books.destroy', ['id' => $myBook->id]), 'method'
                            =>
                            'delete'])
                            !!}
                            {!! Form::submit('この家計簿を削除する', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                            @endif
                        </div>
                        <br>
                        <div>
                            <span class=" text-muted">作成者：{{$myBook->authorizeUser->name}} &nbsp; 作成日時：
                                {{ $myBook->created_at }}</span>
                        </div>
                    </div>
                </div>
                {{-- 未承認一覧 --}}
                {{-- 未承認一覧
                {{ $unapprovedBook = $myBook->unapprovedBook($userId)}}
                {{dd($unapprovedBook) }} --}}
            </div>
        </li>
        @endforeach

    </ul>
    @endif
    @endif