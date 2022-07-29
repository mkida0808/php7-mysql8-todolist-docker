<?php

require_once(__DIR__ . '/../app/config.php');

createToken();

$pdo = getPdoInstance();

// Todiリスト一覧にタイトルを追加関数を呼び出す
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  validateToken();
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
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
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