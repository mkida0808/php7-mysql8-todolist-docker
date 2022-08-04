<?php
require('../../../../app/dotinstall/php_webdev/functions.php');
include('../../../../app/dotinstall/php_webdev/parts/header.php');
$color = 'transparent';
?>

<form action="result.php" method="get">
  <label><input type="radio" name="color" value="orange"> Orange</label>
  <label><input type="radio" name="color" value="pink"> Pink</label>
  <label><input type="radio" name="color" value="gold"> Gold</label>
  <button>Send</button>
</form>

<?php

include('../../../../app/dotinstall/php_webdev/parts/footer.php');
