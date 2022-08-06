<?php

// トレイト
trait LikeTrait
{
  private $likes = 0;

  // インターフェースを実装
  public function like()
  {
    $this->likes++;
  }
}

// インターフェースを定義（ここではlikeメソッド）
interface LikeInterface
{
  public function like();
}

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

class Post extends BasePost implements LikeInterface // インターフェースを実装
{
  // トレイトを呼び出し
  use LikeTrait;

  // final修飾子はメソッドのオーバーライドを禁止する
  // final public function show()
  public function show()
  {
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }
}

class SponsoredPost extends BasePost
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

class PremiumPost extends BasePost implements LikeInterface // インターフェースを実装
{
  // トレイトを呼び出し
  use LikeTrait;
  private $price;

  public function __construct($text, $price)
  {
    parent::__construct($text);
    $this->price = $price;
  }

  // メソッドのオーバーライド
  public function show()
  {
    printf('%s (%d) [%d JPY]' . PHP_EOL, $this->text, $this->likes, $this->price);
  }
}

$posts = [];
$posts[0] = new Post('text000');
$posts[1] = new Post('text001');
$posts[2] = new SponsoredPost('texttext', 'sponsorsponsor');
$posts[3] = new PremiumPost('texttexttext', 5600);

// インターフェースの型継承
function processLikeable(LikeInterface $likeable)
{
  $likeable->like();
}

processLikeable($posts[0]);
processLikeable($posts[3]);

// オブジェクト型の継承（PostだけではなくsponsoredPostも継承する）
function processPost(BasePost $post)
{
  $post->show();
}

// $posts[0]->show();
// $posts[1]->show();
// $posts[2]->show();
// $posts[2]->showSponsor();
$posts[0]->like();
$posts[3]->like();

// Post型の表示
foreach ($posts as $post)
{
  processPost($post);
}