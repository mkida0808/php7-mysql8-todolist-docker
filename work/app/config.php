<?php

session_start();

define('DSN', 'mysql:host=db_dotinstall;dbname=myapp;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
// サーバー変数からサイトURL（ドメイン）を取得、定義する
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

require_once(__DIR__ . '/functions.php');