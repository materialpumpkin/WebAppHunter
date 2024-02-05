# WebAppHunter  
- URL：https://webapphunter-8254aa817a96.herokuapp.com/  

- テストアカウント  
  - Email：ty0213tyd@gmail.com  
  - Password：guest0213  

## トップページイメージ
![image](https://github.com/materialpumpkin/App01/assets/149563362/65208488-84a4-45f6-bcd9-803e53be5f1f)

## このWEBサイトについて  
世の中には便利なWEBアプリが無数にあります。  
このWEBアプリはあなたにとって有用なWEBアプリの情報の収集を手助けします。  
「探す」ではWEBアプリの情報を検索することができ、お気に入りのものは「ブックマーク」ページから簡単にアクセスできます。  
また、自分のお気に入りは「投稿する」でほかの人に共有することができます。  

## 制作背景
現在インターネットには数多くの有用なWEBアプリが存在する一方で、知らないものもたくさんあり、もったいないと感じました。そのような状況に目を向け、WEBアプリの便利さを最大限に活用するために、情報の共有と発見を促すWEBアプリを作ろうと考えました。  
現状、類似のサイトは、ほとんどはサイト作成者の主観に基づいたまとめ記事や紹介サイトが主流です。そのため、ユーザー投稿型は珍しいと感じました。投稿型のプラットフォームを採用することは、ユーザーが未知のWEBアプリについて発見する機会を増やしたいというコンセプトにマッチしていると考えました。  

## 機能

- 探す  
キーワード・カテゴリ及びその両方による絞り込みができる検索機能があります。これを活用し目当てのWEBアプリを探し、その名前をクリックすることで詳細画面に移行します。URLはハイパーリンクになっており、クリックすることで紹介されたWEBアプリを実際に訪れることができます。投稿者のみ、この画面から投稿削除を行えます。また、「探す」ページの検索ボックスの下の「おすすめの投稿」は、すべての投稿がブックマーク数の順番で一覧になっています。

- 投稿する  
こちらから投稿を行えます。キーワード（タグ）は「入力欄を追加する」ボタンを使ってユーザーが好きな個数入力できます。

- ブックマーク  
投稿詳細画面のボタンからブックマーク登録ができ、登録したページはこちらから一覧できます。他ページと違い、ブックマーク一覧からは直接ハイパーリンクに飛べるようになっており、素早く目的のWEBアプリにアクセスできます。これによりこのページ自体がハブのような役割を持つことが期待できます。

## 工夫した点

- 「探す」ページなどで表示するためのアイコン画像は、スクレイピングによって自動取得しています。これによって投稿時にユーザー側で用意する要素が減るため、ハードルが下がり手軽に使いやすくなります。

- 上記の機能に関連して、各サイトが異なるアイコンの規格やURLの仕様を持っているため、コーディング面で詳細な場合分け等の工夫が必要でした。

- カテゴリとタグは似た機能ですが、カテゴリが際限なく増えてしまうとユーザー側が使いにくくなってしまうのではないかと考え、機能を分割しました。カテゴリは最初から用意されている8種類のみですが、タグは一つの投稿に対して好きなだけ指定できます。

- Tailwindは初めて使いましたが、少しでも見やすくなるように調べたり微調整を繰り返したりしました。こういった作業は私の性格上マッチしていると感じ、とても楽しく行うことができました。

## データフロー
![image](https://github.com/materialpumpkin/WebAppHunter/assets/149563362/9832cd05-6c01-40fd-afaf-fdb4cb2a793e)


## 使用技術
- HTML
- TailwindCSS
- JavaScript
- PHP
- Laravel
- MariaDB
- MySQL
- Guzzle

## 環境
- Laravel 9.52.16
- AWS

## 制作者
吉野 樹彦　(Email：ty0213tyd@gmail.com)
