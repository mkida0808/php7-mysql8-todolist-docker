<?php

session_start();

define('DSN', 'mysql:host=db_dotinstall;dbname=myapp;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
// サーバー変数からサイトURL（ドメイン）を取得、定義する
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

// 各クラスを自動で呼び出す
spl_autoload_register(function ($class) {
  $fileName = sprintf(__DIR__ . '/%s.php', $class);

  if (file_exists($fileName)) {
    require($fileName);
  } else {
    echo 'File not found: ' . $fileName;
    exit;
  }
});