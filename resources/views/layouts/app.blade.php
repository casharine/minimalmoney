<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Minimal Money</title>

    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    {{--
    <meta name="viewport" content="witdh=1200"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<header>
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