<?php
require(__DIR__ . '/../../../app/dotinstall/php_webdev/functions.php');
$color = filter_input(INPUT_COOKIE, $color) ?? 'transparent';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>radiobox</title>
</head>

<body style="background-color: <?= h($color); ?>">
  <form action="result3.php" method="post">
    <label><input type="radio" name="color" value="orange"> orange</label>
    <label><input type="radio" name="color" value="pink"> pink</label>
    <label><input type="radio" name="color" value="gold"> gold</label>
    <button>SEND3</button>
  </form>
</body>

</html>