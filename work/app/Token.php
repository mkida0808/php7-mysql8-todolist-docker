<?php

class Token
{
  // ランダム文字列でトークンを作成
  public static function create()
  {
    if (!isset($_SESSION['token']))
    {
      $_SESSION['token'] = bin2hex(random_bytes(32));
    }
  }

  // トークンのバリデーション検証
  public static function validate()
  {
    if (empty($_SESSION['token']) || $_SESSION['token'] !== filter_input(INPUT_POST, 'token'))
    {
      exit('Invalid post request');
    }
  }
}
