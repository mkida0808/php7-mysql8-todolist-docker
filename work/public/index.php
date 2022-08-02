<?php

require_once(__DIR__ . '/../app/config.php');

use MyApp\Database;
use MyApp\Todo;
use MyApp\Utils;

$pdo = Database::getInstance();

$todo = new Todo($pdo);
$todo->processPost();
$todos = $todo->getAll();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <!-- トークン関連は一括で取得、送信する -->
  <main data-token="<?= Utils::h($_SESSION['token']); ?>">
    <header>
      <h1>Todos</h1>
      <!-- Todoリスト一覧の一括削除ボタン（チェックボックスにチェックがあるリスト） -->
      <span class="purge">Purge</span>
    </header>

    <!-- Todoリスト一覧に追加する入力フォーム（送信先や送信形式はJSで指定する） -->
    <form>
      <input type="text" name="title" placeholder="Type new todo.">
    </form>
    <ul>
      <!-- DBから取得したTodoリストを表示 -->
      <?php foreach ($todos as $todo) : ?>
        <li data-id="<?= Utils::h($todo->id); ?>">
          <input type="checkbox" <?= $todo->is_done ? 'checked' : '' ?>>
          <!-- チェックボックスのONOFFの画面振る舞いはCSSに移す  -->
          <span><?= Utils::h($todo->title); ?></span>

          <!-- タイトル削除のためのid, tokenをカスタムデータ属性に置き換えてJS制御にまわす  -->
          <span class="delete">x</span>

        </li>
      <?php endforeach; ?>
    </ul>
  </main>

  <script src="js/main.js"></script>
</body>

</html>