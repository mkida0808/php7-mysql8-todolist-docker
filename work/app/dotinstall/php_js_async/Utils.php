<?php

namespace MyApp;

class Utils
{
  // htmlspecialcharsを導入
  public static function h($str)
  {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }
}
