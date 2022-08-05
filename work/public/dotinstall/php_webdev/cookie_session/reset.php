<?php
require('../../../../app/dotinstall/php_webdev/functions.php');

// setcookie('color', '');
unset($_SESSION['color']);

header('Location: http://localhost:8562/dotinstall/php_webdev/cookie_session/index.php');