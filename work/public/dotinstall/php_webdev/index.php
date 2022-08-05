<!-- ヘッダーの読み込み -->
<?php
require(__DIR__ . '/../../../app/dotinstall/php_webdev/functions.php');
include(__DIR__ . '/../../../app/dotinstall/php_webdev/parts/header.php');

$names = [
  'Taro',
  'Jiro',
  'Saburo',
];
?>

<!-- メイン -->
<?php if (empty($names)) : ?>
  <p>配列には空です</p>
<?php else : ?>
  <?php foreach ($names as $name) : ?>
    <li><?php echo h($name); ?></li>
  <?php endforeach; ?>
<?php endif; ?>
<p>Hello, <?= h($name); ?></p>

<form action="result.php" method="get">
  <!-- <input type="text" name="message"> -->
  <input type="text" name="username">
  <textarea name="message"></textarea>
  <button>SEND</button>
</form>

<!-- フッターの読み込み -->
<?php
include(__DIR__ . '/../../../app/dotinstall/php_webdev/parts/footer.php');
?>