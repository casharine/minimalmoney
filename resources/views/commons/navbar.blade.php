@if (Auth::check())
<div class="container">
  {{--<div class="float-right">--}}
    <div class="row">
      <nav class="navbar fixed-bottom navbar-dark bg-dark py-0 px-2">
        {{-- userページへのリンク --}}
        <a class="navbar-brand" 　data-toggle="tooltip" title="User管理" href="{{route('users.show')}}"><i
            class="fas fa-user-circle"></i>&nbsp;User</a>
        {{-- homeページへのリンク --}}
        <a class="navbar-brand" 　data-toggle="tooltip" title="Home" href="/"><i class="fas fa-home"></i>&nbsp;Home</a>
        {{-- sheetページへのリンク --}}
        {{-- <a class="navbar-brand" data-toggle="tooltip" title="Sheets" href="#"><i class="fas fa-table"></i></a> --}}
        {{-- planningページへのリンク --}}
        <a class="navbar-brand" data-toggle="tooltip" title="Plannings" href="{{route('planning.planning')}}"><i
            class="fas fa-file-invoice-dollar"></i>&nbsp;Planning</a>
        {{-- graphぺージへのリンク--}}
        {{-- <a class="navbar-brand" 　data-toggle="tooltip" title="Graph" href="#"><i class="fas fa-chart-pie"></i></a>
        --}}
        {{-- carry forwardボタン
        <a class="navbar-brand" href="#"><i class="fas fa-sync"></i></a> --}}
        {{-- undoボタン --}}
        <a class="navbar-brand" data-toggle="tooltip" title="Undo" href="#"><i
            class="fas fa-arrow-alt-circle-left"></i>&nbsp;Undo</a>
        {{-- redoボタン --}}
        <a class="navbar-brand" data-toggle="tooltip" title="Redo" href="#"><i
            class="fas fa-arrow-alt-circle-right"></i>&nbsp;Redo</a>
        {{-- inputボタン--}}
        {{-- <div> <button type="button" class="navbar-toggler" data-toggle="collapse" data-toggle="tooltip"
            title="費用を入力" data-target="#nav-bar">
            <i class="fas fa-feather"></i>
            </a>
          </button>
          <div class="collapse navbar-collapse navbar-dark bg-light" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
              <li>
                <h5><i class="fas fa-pencil-alt"></i> Main Input</h5>
              </li> --}}
              {{-- フォームグループ開始 --}}
              {{-- <form action="#.php" method="POST">
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
              </form> --}}
          </diV>

      </nav>
    </div>
  </div>
</div>
</div>
@endif