<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\SharingsController;
use App\Http\Controllers\UnapprovedController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home画面のルーティング ※認証有無でwelcomeページを表示
Route::get('/', function () {
    if(!\Auth::check()){
        return view('home.home');
    }
    return redirect()->route('Home');
 });

Route::get('home', [HomeController::class, 'home'])->name('Home');

// ユーザー登録等処理のグループ
// ※ver.6時 Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    //  ユーザ登録
    Route::get('signup', [RegisterController::class, 'showRegistrationForm'])->name('signup.get');
    Route::post('signup', [RegisterController::class, 'register'])->name('signup.post');
    //  ログイン
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout.get');

//  ユーザー設定関連ページ
Route::group(['middleware' => ['auth']], function () {
    // ユーザー設定ページ
    Route::get('users', [UsersController::class, 'show'])->name('users.show');
        // ユーザー検索・申請ページ関連
        Route::post('users', [UsersController::class, 'index'])->name('users.index');
        Route::post('users/serch', [UsersController::class, 'store'])->name('users\serch.store');
        // Books関連 My家計簿タブ
        Route::post('users/books', [BooksController::class, 'store'])->name('users\books.store');
        Route::post('users/books/{id}', [BooksController::class, 'activeSwitch'])->name('users\books.activeSwitch');
        Route::delete('users/books/{id}', [BooksController::class, 'destroy'])->name('users\books.destroy');
        // Sharings関連 共有依頼中タブ
        Route::get('users/sharings', [UsersController::class, 'sharings'])->name('users.sharings');
        Route::post('users/sharings/{id}', [SharingsController::class, 'store'])->name('users\sharings.store');
        Route::delete('users/sharings/{id}', [SharingsController::class, 'destroy'])->name('users\sharings.destroy');
        // Unapproved関連 未承認タブ
        Route::get('users/unapproved', [UsersController::class, 'unapproved'])->name('users.unapproved');
        Route::post('users/unapproved/{id}', [UnapprovedController::class, 'store'])->name('users\unapproved.store');
        Route::delete('users/unapproved/{id}', [UnapprovedController::class, 'destroy'])->name('users\unapproved.destroy');
        });

//  Home関連ページ
Route::group(['middleware' => ['auth']], function () {
    // ユーザー詳細ページ ※メインのgetはHomeページのため最上部に記載
    Route::post('home/home/{id}', [HomeController::class, 'store'])->name('home.store');
});
