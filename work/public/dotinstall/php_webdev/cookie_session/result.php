<?php
require('../../../../app/dotinstall/php_webdev/functions.php');

$colorFromGet = filter_input(INPUT_GET, 'color') ?? 'transparent';
setcookie('color', $colorFromGet);

include('../../../../app/dotinstall/php_webdev/parts/header.php');
?>

  <p><?= h($colorFromGet); ?></p>
  <p><a href="index.php">Go back</a></p>

<?php
include('../../../../app/dotinstall/php_webdev/parts/footer.php');