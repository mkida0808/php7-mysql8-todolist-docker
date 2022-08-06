<?php

// クラス
class Post
{
  // プロパティ
  public $text;
  public $likes = 0;

  public function __construct($text)
  {
    $this->text = $text;
  }

  // メソッド
  public function show()
  {
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }
}

$post[0] = new Post('hello'); // インスタンス
$post[0]->show();
$post[1] = new Post('hello again'); // インスタンス
$post[1]->show();
