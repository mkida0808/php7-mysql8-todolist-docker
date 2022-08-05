<?php
require('../../../../app/dotinstall/php_webdev/functions.php');
include('../../../../app/dotinstall/php_webdev/parts/header.php');

$messages = file('../../../../app/dotinstall/php_webdev/messages.txt', FILE_IGNORE_NEW_LINES);
?>

<ul>
<?php foreach ($messages as $message): ?>
  <li><?= h($message); ?></li>
<?php endforeach; ?>
</ul>

<form action="result.php" method="post">
  <input type="text" name="message">
  <button>Send</button>
</form>

<?php

include('../../../../app/dotinstall/php_webdev/parts/footer.php');
