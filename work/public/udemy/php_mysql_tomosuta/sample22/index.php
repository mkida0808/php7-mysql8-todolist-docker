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