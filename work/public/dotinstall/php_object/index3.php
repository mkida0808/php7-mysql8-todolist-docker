<?php

// 抽象クラス（子クラスに以下のメソッドを必ず明記する）
abstract class BasePost
{
  // private $text;
  protected $text; // オーバーライドを許す

  public function __construct($text)
  {
    $this->text = $text;
  }
  // 抽象メソッド
  abstract public function show();
}

class Post extends BasePost // 親クラス（スーパークラス）
{
  // final修飾子はメソッドのオーバーライドを禁止する
  // final public function show()
  public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
}

class SponsoredPost extends BasePost // 子クラス（サブクラス）
{
  private $sponsor;

  public function __construct($text, $sponsor)
  {
    parent::__construct($text);
    $this->sponsor = $sponsor;
  }

  public function showSponsor()
  {
    printf('%s' . PHP_EOL, $this->sponsor);
  }

  // メソッドのオーバーライド
  public function show()
  {
    printf('%s by %s' . PHP_EOL, $this->text ,$this->sponsor);
  }
}

class PremiumPost extends BasePost // 子クラス（サブクラス）
{
  private $price;

  public function __construct($text, $price)
  {
    parent::__construct($text);
    $this->price = $price;
  }

  // メソッドのオーバーライド
  public function show()
  {
    printf('%s [%d JPY]' . PHP_EOL, $this->text ,$this->price);
  }
}

$posts = [];
$posts[0] = new Post('text000');
$posts[1] = new Post('text001');
$posts[2] = new SponsoredPost('texttext', 'sponsorsponsor');
$posts[3] = new PremiumPost('texttexttext', 5600);

// オブジェクト型の継承（PostだけではなくsponsoredPostも継承する）
function processPost(BasePost $post)
{
  $post->show();
}

// $posts[0]->show();
// $posts[1]->show();
// $posts[2]->show();
// $posts[2]->showSponsor();

// Post型の表示
foreach ($posts as $post)
{
  processPost($post);
}