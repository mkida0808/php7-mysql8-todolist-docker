<?php
require(__DIR__ . '/../../../app/dotinstall/php_webdev/functions.php');
// $path = __DIR__;
$names = [
  'Taro',
  'Jiro',
  'Saburo',
];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>php web development</title>
</head>

<body>
  <?php if (empty($names)) : ?>
    <p>配列には空です</p>
  <?php else : ?>
    <?php foreach ($names as $name) : ?>
      <li><?php echo h($name); ?></li>
    <?php endforeach; ?>
  <?php endif; ?>
  <p>Hello, <?= h($name); ?></p>
</body>

</html>