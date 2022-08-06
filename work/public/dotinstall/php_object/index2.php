<?php
class Post // 親クラス（スーパークラス）
{
  // private $text;
  protected $text; // オーバーライドを許す

  public function __construct($text)
  {
    $this->text = $text;
  }

  // final修飾子はメソッドのオーバーライドを禁止する
  // final public function show()
  public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
}

class SponsoredPost extends Post // 子クラス（サブクラス）
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

$posts = [];
$posts[0] = new Post('text000');
$posts[1] = new Post('text001');
$posts[2] = new SponsoredPost('texttext', 'sponsorsponsor');

// オブジェクト型の継承（PostだけではなくsponsoredPostも継承する）
function processPost(Post $post)
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