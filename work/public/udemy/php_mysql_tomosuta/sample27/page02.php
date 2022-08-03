<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sample27 - page02</title>
</head>
<body>
Sessionの値：<?php echo $_SESSION['message']; ?>
</body>
</html>