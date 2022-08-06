<?php

// 厳密な型チェック
declare(strict_types=1);

// クラス
class Post
{
  // プロパティ
  private $text;
  private $likes = 0;

  public function __construct(string $text)
  {
    $this->text = $text;
  }

  // メソッド
  public function show()
  {
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }

  public function like()
  {
    $this->likes++;
    if ($this->likes > 100)
    {
      $this->likes = 100;
    }
  }
}

$posts[0] = new Post('123123123'); // インスタンス
$posts[1] = new Post('hello again'); // インスタンス

$posts[0]->like();
$posts[1]->like();

$posts[0]->show();
$posts[1]->show();