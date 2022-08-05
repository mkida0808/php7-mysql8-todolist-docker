<?php
require('../../../../app/dotinstall/php_webdev/functions.php');
include('../../../../app/dotinstall/php_webdev/parts/header.php');

createToken();

define('FILENAME', '../../../../app/dotinstall/php_webdev/messages.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validateToken();

  $message = trim(filter_input(INPUT_POST, 'message'));
  $message = $message !== '' ? $message : '...';

  $fp = fopen(FILENAME, 'a');
  fwrite($fp, $message . "\n");
  fclose($fp);

  header('Location: http://localhost:8562/dotinstall/php_webdev/post/result.php');
  exit;
}

$messages = file(FILENAME, FILE_IGNORE_NEW_LINES);

?>

<ul>
<?php foreach ($messages as $message): ?>
  <li><?= h($message); ?></li>
<?php endforeach; ?>
</ul>

<form action="" method="post">
  <input type="text" name="message">
  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  <button>Send</button>
</form>

<?php

include('../../../../app/dotinstall/php_webdev/parts/footer.php');
