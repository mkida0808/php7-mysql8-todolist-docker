<?php

define('DSN', 'mysql:host=db_dotinstall;dbname=myapp;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
// サーバー変数からサイトURL（ドメイン）を取得、定義する
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

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
  $search = 't%';
  $stmt = $pdo->prepare("select * from posts where message like :search");
  $stmt->execute(['search' => $search]);

  // 単にクエリを実行したい場合（オブジェクトで返ってくる）
  // $pdoStmt = $pdo->query("select * from posts");

  // 単数を配列変換する場合
  // $result = $pdoStmt->fetch();
  // 単数を配列変換する場合
  $posts = $stmt->fetchAll();

  // 見やすい表記で画面出力
  foreach ($posts as $post)
  {
    printf('%s (%d)' . PHP_EOL, $post['message'], $post['likes']);
  }

} catch (\PDOException $e) {
  echo $e->getMessage() . PHP_EOL;
  exit;
}