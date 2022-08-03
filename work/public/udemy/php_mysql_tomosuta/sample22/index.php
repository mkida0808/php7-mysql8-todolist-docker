<?php

$age = '２３';

// 全角を半角に変換する
$age = mb_convert_kana($age, 'n', 'UTF-8');

if (is_numeric($age))
{
  echo $age . '歳です';
} else {
  echo '数値を入力して下さい';
}

echo '<br>';

$zip = '423-4467';

if (preg_match("/\A\d{3}[-]\d{4}\z/", $zip)) {
  echo '郵便番号：〒' . $zip;
} else {
  echo '郵便番号を正しく入力して下さい';
}