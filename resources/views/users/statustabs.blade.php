<br>
<div class="row">
    <aside class="col-3">
        <div>
            <h5 class="font-weight-bold">
                <font color="orange">
                    <i class="fas fa-user"></i>
                    ユーザー管理
                </font>
            </h5>
            <br>
            <h5> ユーザー名 </h5>
            <div class="alert alert-secondary" role="alert">
                <h4> {{ $user->name }}</h4>
            </div>
            @if($activeBookNull == true)
            <div class="alert alert-warning" role="alert">使用する家計簿を選択してください。</div>
            @else
            <h5> ご使用中の家計簿名 </h5>
            <div class="alert alert-warning" role="alert">
                <h4> {{$activeBook->name}} </h4>
            </div>
            <br>
            <ul class="list-unstyled">
                {{-- ログアウトページへのリンク --}}
                <a class="btn btn-primary w-100" href={{route('logout.get')}} role="button">Logout
                </a>
            </ul>
            @endif
        </div>
    </aside>
    <div class="col-9">
        <ul class="nav nav-tabs nav-justified">
            {{-- ユーザ詳細タブ アクティブタブの場合は強調表示（三項演算子） --}}
            <div class="col-4">
                {{-- 家計簿一覧のタブ --}}
                <li><a href="{{ route('users.show') }}"
                        class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
                        My家計簿
                        <span class="badge badge-secondary">{{ $user->books_count }}</span></a>
                </li>
            </div>
            <div class="col-4">
                {{-- 共有依頼一覧タブ --}}
                <li><a href="{{ route('users.sharings') }}"
                        class="nav-link {{ Request::routeIs('users.sharings') ? 'active' : '' }}">
                        共有依頼中
                        <span class="badge badge-secondary">{{ $sharingCounts }}</span></a>
                </li>
            </div>
            <div class="col-4">
                {{-- 未承認一覧タブ --}}
                <li><a href="{{route('users.unapproved') }}"
                        class="nav-link {{ Request::routeIs('users.unapproved') ? 'active' : '' }}">
                        未承認

                        <span class="badge badge-secondary">{{ $unapprovedCounts }}</span>
                    </a>
                </li>
            </div>
        </ul>