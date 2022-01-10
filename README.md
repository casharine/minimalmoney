## アプリケーションのリンク
 

## アプリケーションのリンクとサンプルアカウント
http://minimalmoney.herokuapp.com/<br>
<br>
 なお、サンプルとして夫アカウントをご使用ください<br>
 ・メールアドレス<br>
  otto@gmail.com<br>
 ・パスワード<br>
  12341234<br>
 <br>
 上記のアカウントには家計簿を作成しておりますので
 2021年12月の家計簿名Aをご確認ください。

## サンプルアカウントについて
 上記のアカウントでログインください。<br>
 ログイン後はフッターナビゲーションバーから以下のページへアクセスできます。<br>
 
 ＜ユーザー管理＞<br>
 家計簿の作成、検索、共有依頼、承認が行えます。<br>
 
 ＜家計簿を入力＞<br>
 ログイン後はこちらに遷移します。<br>
 家計簿の入力と月次家計簿の確認及び、表示・編集年月の変更が行えます。<br>
 <br>
 ＜予算を入力＞<br>
 家計簿の入力と月次家計簿の確認及び、表示・編集年月の変更が行えます。<br>
 
## 御覧いただきたいソースコード 
  ＜HomeController他＞<br>
  終盤に実装した家計簿及び予算入力ページでは、UserControllerが冗長化してしまった反省を活かし、いかに
  コンパクトに可読性を高めるか、MVCの本来の役割を意識し実装し、trait、scoope、配列、ライブラリの活用など
  スクールで学ばなかった機能を用いてコーディングしております。
  <br><br>
  ＜UsersController他><br>
  序盤に実装したUser管理ページはテックスクールのtwitterクローンのポートフォリオに比べ複雑なDBアクセス
  として入れ子構造のEloquentやEagarLoadingなどを独自で学び積極的に用いました。<br>
 <br>
## 設計図・仕様書について<br>
 以下より、仕様書、ER図、サイトマップ、ワイヤフレームを確認いただけます。<br>
 https://cacoo.com/diagrams/7C7vMFjy05OcG78j/2A216<br>

以上
