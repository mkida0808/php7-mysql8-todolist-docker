<?php

define('DSN', 'mysql:host=db_dotinstall;dbname=myapp;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');

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

// Todoリスト一覧を取得
function getTodos($pdo) {
  $stmt = $pdo->query("select * from todos order by id desc");
  $todos = $stmt->fetchAll();
  return $todos;
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

  <ul>
    <li>
      <input type="checkbox"><span>Title</span>
    </li>
    <li>
      <input type="checkbox" checked><span class="done">Title</span>
    </li>
    <li>
      <input type="checkbox"><span>Title</span>
    </li>
  </ul>
</body>
</html>