<?php

define('DSN', 'mysql:host=db_dotinstall;dbname=myapp;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
// サーバー変数からサイトURL（ドメイン）を取得、定義する
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

class Post
{
  // publicの場合だけ省略出来る
  // public $id;
  // public $message;
  // public $likes;

  public function show()
  {
    echo $this->message . '(' . $this->likes . ')' . PHP_EOL ;
  }
}

try {
  $pdo = new \PDO(
    DSN,
    DB_USER,
    DB_PASS,
    [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      // \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
      \PDO::ATTR_EMULATE_PREPARES => false,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    ]
  );

  $pdo->query("drop tables if exists posts");
  $pdo->query(
    "create table posts (
      id int not null auto_increment,
      message varchar(140),
      likes int,
      primary key (id)
      )"
  );

  $pdo->query("insert into posts (message, likes) values
    ('Thanks', 12),
    ('thanks', 4),
    ('arigatou', 15)
  ");

  $label = '[Good!]';
  // プリペアードステートメント（クエリに値を受け込む場合）
  // $n = 10;
  // $stmt = $pdo->prepare("update posts set message = concat(:label, message) where likes > :n");
  // $stmt->execute(['label' => $label, 'n' => $n]);
  // echo $stmt->rowCount() . ' records update' . PHP_EOL;

  // 文字列検索
  // $search = 't%';
  // $stmt = $pdo->prepare("select * from posts where message like :search");
  // $stmt->execute(['search' => $search]);


  // データを挿入
  $message = 'Merci';
  $likes = 8;
  $stmt = $pdo->prepare("insert into posts (message, likes) values (:message, :likes)");

  // データを挿入後、明示的に面数に対して型を指定する（同じプリペアードステートメントを実行する場合、記述は省略できる）
  $stmt->bindValue('message', $message, \PDO::PARAM_STR);
  $stmt->bindValue('likes', $likes, \PDO::PARAM_INT);
  $stmt->execute();

    // 最後に挿入したデータのIDを取得
    echo $pdo->lastInsertID() . PHP_EOL;

    // データを挿入
    $message = 'Danke';
    $likes = 11;

    // データを挿入後、明示的に面数に対して型を指定する（同じプリペアードステートメントを実行する場合、記述は省略できる）
    // ただし、データを挿入後時、bindParamを技術することでbindValueの定義を省略できる
    $stmt->bindParam('message', $message, \PDO::PARAM_STR);
    $stmt->bindParam('likes', $likes, \PDO::PARAM_INT);
    $stmt->execute();

    // 最後に挿入したデータのIDを取得
    echo $pdo->lastInsertID() . PHP_EOL;

    // データを挿入
    $message = 'Gracias';
    $likes = 123;

    // データを挿入後時、bindParamを技術することでbindValueの定義を省略できる
    $stmt->execute();

    // 最後に挿入したデータのIDを取得
    echo $pdo->lastInsertID() . PHP_EOL;

  // 単にクエリを実行したい場合（オブジェクトで返ってくる）
  $stmt = $pdo->query("select * from posts");

  // 単数を配列変換する場合
  // $result = $pdoStmt->fetch();
  // 単数を配列変換する場合
  $posts = $stmt->fetchAll(\PDO::FETCH_CLASS, 'Post');

  // 見やすい表記で画面出力
  foreach ($posts as $post)
  {
    // printf('[%d] %s (%d)' . PHP_EOL, $post['id'], $post['message'], $post['likes']);
    // クラスから呼び出す場合
    $post->show();
  }

} catch (\PDOException $e) {
  echo $e->getMessage() . PHP_EOL;
  exit;
}