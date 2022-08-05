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
      // \PDO::ATTR_EMULATE_PREPARES => false,
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

  $pdoStmt = $pdo->query("show tables");
  $result = $pdoStmt->fetch();
  var_dump($result);
} catch (\PDOException $e) {
  echo $e->getMessage();
  exit;
}