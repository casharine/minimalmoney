## 目次
<ul>
<a href="#アプリケーションのリンクとサンプルアカウント">testへのリンク</a>
</ul>


## アプリケーションのリンクとサンプルアカウント
 サンプルとして以下の夫アカウントをご使用ください<br>
 なお、DBは定期的に初期化しますので自由にご利用ください。<br>
 <br>
 ・アプリケーション<br>
 http://minimalmoney.herokuapp.com/<br>
 ・メールアドレス<br>
  otto@gmail.com<br>
 ・パスワード<br>
  12341234<br>
 <br>
 上記のアカウントには家計簿を作成しておりますので
 2021年12月の家計簿名Aをご確認ください。
 <br>
 ※他に、子及び妻のアカウントは仕訳入力無

## サンプルアカウントと主な機能
 上記のアカウントでログインください。<br>
 ログイン後はフッターナビゲーションバーから以下のページへアクセスできます。<br>
 
 ■画面別の主な機能
 ＜認証関連＞
 認証済みユーザー以外はwelecomeページからサインアップ及びログインページにアクセス可
 
 ＜ユーザー管理＞<br>
 ・ログアウト<br>
 ・使用する家計簿変更（家計簿名Aに2012/12にサンプルデータ有）<br>
 ・家計簿の新規作成<br>
 ・家計簿の削除<br>
 ・ユーザー検索（妻・子をあらかじめ用意）<br>
 ・検索結果から共有依頼申請<br>
 ・共有依頼申請の取消<br>
 ・被共有依頼の承認、却下<br>
 
 ＜家計簿を入力＞<br>
 ・表示・編集年月の変更
 ・家計簿の入力
 ・月次家計簿の確認
 <br>
 ・表示・編集年月の変更
 ・予算の入力
 ・月次予算の確認
 
## 御覧いただきたいソースコード 
  ＜HomeController他＞<br>
  終盤に実装した家計簿及び予算入力ページでは、UserControllerが冗長化してしまった反省を活かし、いかに
  コンパクトに可読性を高めるか、MVCの本来の役割を意識し実装し、オブジェクト指向のアプローチ（継承やカプセル化など）、scoope、配列、
  ライブラリの活用などスクールで学ばなかった機能を独自で学びコーディングしております。
  <br><br>
  ＜UsersController他><br>
  序盤に実装したUser管理ページは冗長的ですがテックスクールのtwitterクローンのポートフォリオに比べ複雑なDBアクセス
  となり、入れ子構造のEloquent、EagarLoading、ER図の見直しなど何度も試行錯誤し実装しました。<br>
 <br>
## 設計図・仕様書について<br>
 以下より、仕様書、ER図、サイトマップ、ワイヤフレームを確認いただけます。<br>
 https://cacoo.com/diagrams/7C7vMFjy05OcG78j/2A216<br>

以上
