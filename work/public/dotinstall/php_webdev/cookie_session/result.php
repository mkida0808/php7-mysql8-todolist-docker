<?php

require('../../../../app/dotinstall/php_webdev/functions.php');

// $color = filter_input(INPUT_GET, 'color');
// $color = isset($color) ? $color : 'None selected';
// $color = $color ?? 'None selected';
$color = filter_input(INPUT_GET, 'color') ?? 'None selected';

include('../../../../app/dotinstall/php_webdev/parts/header.php');

?>

  <p><?= h($color); ?></p>
  <p><a href="index.php">Go back</a></p>

<?php

include('../../../../app/dotinstall/php_webdev/parts/footer.php');