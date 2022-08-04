<?php
require(__DIR__ . '/../../../app/dotinstall/php_webdev/functions.php');
// $path = __DIR__;
  $name = 'Makoto, <script>alert(1)</script>, aaaaaa';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>php web development</title>
</head>
<body>
  <p>Hello, <?= h($name); ?></p>
</body>
</html>