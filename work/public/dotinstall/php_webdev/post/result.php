<?php
require('../../../../app/dotinstall/php_webdev/functions.php');
include('../../../../app/dotinstall/php_webdev/parts2/header.php');

$message = trim(filter_input(INPUT_POST, 'message'));
$message = $message !== '' ? $message : '...';

$fp = fopen('../../../../app/dotinstall/php_webdev/messages.txt', 'a');
fwrite($fp, $message . "\n");
fclose($fp);

?>
  <p>Message added!</p>
  <p><a href="index.php">Go back</a></p>

<?php
include('../../../../app/dotinstall/php_webdev/parts2/footer.php');