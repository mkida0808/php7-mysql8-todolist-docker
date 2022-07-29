<?php

define('DSN', 'mysql:host=db_dotinstall;dbname=myapp;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
// サーバー変数からサイトURL（ドメイン）を取得、定義する
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

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
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

// htmlspecialcharsを導入
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
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

// Todiリスト一覧にタイトルを追加関数を呼び出す
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  addTodo($pdo);

  // 再読み込みの際にpostされないようにトップにリダイレクトする
  // SITE_URLはSERVER変数から取得する
  header('Location: SITE_URL');
  exit;
}

// Todoリスト一覧を呼び出す
$todos = getTodos($pdo);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>Todos</h1>

  <form action="" method="post">
    <input type="text" name="title" placeholder="Type new todo.">
    <!-- <button>Add</button> -->
  </form>

  <ul>
    <!-- DBから取得したTodoリストを表示 -->
    <?php foreach ($todos as $todo): ?>
      <li>
        <input type="checkbox" <?= $todo->is_done ? 'checked' : '' ?>>
        <span class="<?= $todo->is_done ? 'done' : '' ?>">
          <?= h($todo->title); ?>
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>