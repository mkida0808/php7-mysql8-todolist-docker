<?php

require_once(__DIR__ . '/../app/config.php');

createToken();

$pdo = getPdoInstance();

// Todoリスト一覧にタイトルを追加関数、または既存タイトルの更新処理を呼び出す
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  validateToken();
  $action = filter_input(INPUT_GET, 'action');

  switch ($action) {
    case 'add':
      addTodo($pdo);
      break;
    case 'toggle':
      toggleTodo($pdo);
      break;
    case 'delete':
      deleteTodo($pdo);
      break;
    default:
      exit;
  }


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

  <form action="?action=add" method="post">
    <input type="text" name="title" placeholder="Type new todo.">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <!-- <button>Add</button> -->
  </form>

  <ul>
    <!-- DBから取得したTodoリストを表示 -->
    <?php foreach ($todos as $todo): ?>
      <li>
        <form action="?action=toggle" method="post">
          <input type="checkbox" <?= $todo->is_done ? 'checked' : '' ?>>
          <!-- どのidの更新を行うかのためidを送信 -->
          <input type="hidden" name="id" value="<?= h($todo->id); ?>">
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
        <span class="<?= $todo->is_done ? 'done' : '' ?>">
          <?= h($todo->title); ?>
        </span>

        <form action="?action=delete" method="post">
          <span class="delete">x</span>
          <!-- どのidの更新を行うかのためidを送信 -->
          <input type="hidden" name="id" value="<?= h($todo->id); ?>">
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
      </li>
    <?php endforeach; ?>
  </ul>

  <script src="js/main.js"></script>
</body>
</html>