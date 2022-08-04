<!-- ヘッダーの読み込み -->
<?php
require(__DIR__ . '/../../../app/dotinstall/php_webdev/functions.php');
include(__DIR__ . '/../../../app/dotinstall/php_webdev/parts/header.php');

$message = trim(filter_input(INPUT_GET, 'message'));
$username = trim(filter_input(INPUT_GET, 'username'));

// $message = $message !== '' ? $message : 'メッセージを入力して下さい';
// $username = $username !== '' ? $username : 'ユーザー名を入力して下さい';
?>

<!-- メイン -->
<?php if ($message === '' || $username === '') : ?>
  <p>入力フォームに未入力、またはスペースがあります</p>
<?php else : ?>
  <p><?= h($message); ?> by <?= h($username); ?></p>
<?php endif; ?>
<p><a href="index.php">Go Back</a></p>

<!-- フッターの読み込み -->
<?php
include(__DIR__ . '/../../../app/dotinstall/php_webdev/parts/footer.php');
?>