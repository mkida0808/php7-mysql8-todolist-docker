<?php
// $color = $colorFromGet ?? filter_input(INPUT_COOKIE, 'color') ?? 'transparent';
$color = $_SESSION['color'] ?? 'transparent';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>php web development</title>
</head>

<body style="background-color: <?php echo h($color); ?>;">