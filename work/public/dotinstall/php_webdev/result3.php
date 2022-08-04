<?php
require(__DIR__ . '/../../../app/dotinstall/php_webdev/functions.php');
// $colors = filter_input(INPUT_POST, 'colors', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
// $color = filter_input(INPUT_POST, 'color');

// $colors = empty($colors) ? 'None Selected Colors.' : implode(',', $colors);
// $color = empty($color) ? 'None Selected Color.' : $color;
// $color = isset($color) ? $color : 'None selected (!isset)';
// $color = $color ?? 'None selected (null型演算子)';
// $color = filter_input(INPUT_POST, 'color') ?? 'None selected (null型演算子)';
$color = filter_input(INPUT_POST, 'color') ?? 'transparent';
setcookie('color', $color);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>radio</title>
</head>

<body style="background-color: <?= h($color); ?>">
    <p><?= nl2br(h($color)); ?></p>
    <p><a href="index3.php">戻る</a></p>
</body>

</html>