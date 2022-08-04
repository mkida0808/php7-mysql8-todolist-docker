<?php
require(__DIR__ . '/../../../app/dotinstall/php_webdev/functions.php');
$colors = filter_input(INPUT_POST, 'colors', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$colors = empty($colors) ? 'None Selected' : implode(',', $colors);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>selectbox</title>
</head>

<body>
    <p><?= nl2br(h($colors)) . '<br>'; ?></p>
</body>

</html>