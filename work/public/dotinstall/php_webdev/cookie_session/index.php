<?php
require('../../../../app/dotinstall/php_webdev/functions.php');
include('../../../../app/dotinstall/php_webdev/parts/header.php');
?>

<form action="result.php" method="get">
  <label><input type="radio" name="color" value="orange"> Orange</label>
  <label><input type="radio" name="color" value="pink"> Pink</label>
  <label><input type="radio" name="color" value="gold"> Gold</label>
  <button>Send</button>
  <div>
    <a href="reset.php">[reset cookie/session]</a>
  </div>
</form>

<?php

include('../../../../app/dotinstall/php_webdev/parts/footer.php');
