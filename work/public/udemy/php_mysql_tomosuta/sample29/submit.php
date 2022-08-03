<?php
$file = $_FILES['picture'];
// var_dump($file);
$path = 'images/' . $file['name'];
$success = move_uploaded_file($file['tmp_name'], $path);

if ($file['type'] === 'image/jpeg') {
  if ($success) {
    echo '成功しました';
  } else {
    echo '失敗しました';
  }
} else {
  echo 'ファイル形式はjpegを指定して下さい';
}