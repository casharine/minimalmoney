<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Minimal Money</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<header>
    {{-- <div class="container">
        {{--<div class="float-right">--}}
            {{-- <div class="row">
                <div class="col-12 clearfix">
                    <nav class="navbar navbar-fixed-bottom px-0 py-0"> --}}
                        {{-- トップページへのリンク --}}
                        {{-- <div class=" custom-control-inline ">
                            <a class="navbar-brand" href="/"><img class="d-block img-fluid w-50 rounded float-right"
                                    src="images/logo_rectangle_minimalmoney.jpg"></a> --}}
                            {{-- ユーザー関連ページへのリンク --}}
                            {{-- <button type="button" class="navbar-toggler bg-light" data-toggle="collapse"
                                data-toggle="tooltip" title="ユーザーアカウント" data-target="#nav-bar">
                                <i class="fas fa-user-circle"></i>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse " id="nav-bar">
                            <ul class="navbar-nav mx-auto">
                                @if (Auth::check()) --}}
                                {{-- ユーザ管理ページへのリンク --}}
                                {{-- <li class="nav-item"><a herf="{{route('users.show', ['user'=> Auth::id()])}}"
                                        class="nav-link">ユーザー管理ページ</a>
                                </li>
                            </ul>
                            @else --}}
                            {{-- ユーザ登録ページへのリンク --}}
                            {{-- <li class="nav-item"><a href="{{route('signup.get')}}" class="nav-link">Signup</a>
                            </li> --}}
                            {{-- ログインページへのリンク --}}
                            {{-- <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a>
                            </li>
                            @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}
</header>

<body>
    <div class="container">
        {{-- エラーメッセージ --}}
        @include('commons.error_messages')

        @yield('content')
    </div>
    {{-- ナビゲーションバー --}}
    @include('commons.navbar')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>

</html>