<?php
  $name = 'Makoto, <script>alert(1)</script>';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>php web development</title>
</head>
<body>
  <p>Hello, <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></p>
</body>
</html>