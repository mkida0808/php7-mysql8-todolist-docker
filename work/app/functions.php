<?php

// htmlspecialcharsを導入
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// ランダム文字列でトークンを作成
function createToken() {
  if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }
}

// トークンのバリデーション検証
function validateToken() {
  if (empty($_SESSION['token']) || $_SESSION['token'] !== filter_input(INPUT_POST, 'token')) {
    exit('Invalid post request');
  }
}

// Todoリスト一覧のタイトル更新処理
function toggleTodo($pdo) {
  $id = filter_input(INPUT_POST, 'id');
  if (empty($id)) return;

  $stmt = $pdo->prepare("UPDATE todos SET is_done = NOT is_done WHERE id = :id");
  $stmt->bindValue('id', $id, PDO::PARAM_INT);
  $stmt->execute();
}

// Todoリスト一覧に新規レコードを追加
function addTodo($pdo) {
  // 入力フォームから入力タイトルを取得する
  $title = trim(filter_input(INPUT_POST, 'title'));
  if ($title === '') return;

  $stmt = $pdo->prepare("INSERT INTO todos (title) VALUES (:title)");
  $stmt->bindValue('title', $title, PDO::PARAM_STR);
  $stmt->execute();
}

// Todoリスト一覧を取得
function getTodos($pdo) {
  $stmt = $pdo->query("select * from todos order by id desc");
  $todos = $stmt->fetchAll();
  return $todos;
}

// PDOインスタンス生成
function getPdoInstance() {
  try {
    $pdo = new PDO(
      DSN,
      DB_USER,
      DB_PASS,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false,
      ]
    );
    return $pdo;
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
}