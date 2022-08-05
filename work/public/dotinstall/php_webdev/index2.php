<?php
require(__DIR__ . '/../../../app/dotinstall/php_webdev/functions.php');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>selectbox</title>
</head>

<body>
  <form action="result2.php" method="post">
    <select name="colors[]" multiple>
      <option value="orange">orange</option>
      <option value="pink">pink</option>
      <option value="yellow">yellow</option>
    </select>
    <label><input type="checkbox" name="animals[]" value="dog">dog</label>
    <label><input type="checkbox" name="animals[]" value="cat">cat</label>
    <label><input type="checkbox" name="animals[]" value="monkey">monkey</label>
    <button>SEND2</button>
  </form>
</body>

</html>