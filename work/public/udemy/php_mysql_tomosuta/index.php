<?php

date_default_timezone_set('Asia/Tokyo');

// 日付の扱い
// for ($i = 0; $i < 366; $i++):
//   $time = strtotime('+' . $i . ' day');
//   $day = date('n/j(D)', $time);
//   echo $day . '<br>';
// endfor;


// 文字列や数値列の書式（例えば桁数など）を指定する
// $date = sprintf('%04d.%02d.%02d', 2022, 1, 2);
// echo $date;


// ファイル書き込み
// file_put_contents('news.txt', 'テキストテキストテキストテキスト');


// ファイル読み込み1（ファイルを読み込んでその後ファイルの中身を編集したりする場合に）
// $news = file_get_contents('news.txt');
// echo $news;


// ファイル読み込み2（ただ単に読み込んでブラウザ表示するときに）
// readfile('news.txt');
?>

<?php
// XMLファイル読み込み
$xmlTree = simplexml_load_file('rss.xml');
foreach ($xmlTree->channel->item as $item):
?>

<a href="<?= $item->link; ?>"><?= $item->title . '<br>'; ?></a>

<?php
endforeach;
?>

<?php
echo '<br>';
  // JSONファイル読み込み
  $file = file_get_contents('feed.json');
  $json = json_decode($file);

  foreach ($json->items as $item):
?>
<?= $item->title . '<br>'; ?>
<?php endforeach; ?>

<?php
echo '<br>';
// JSON書き込み
$json_sample = [
  "title" => "JSONサンプル",
  "items" => [
    "りんご",
    "みかん",
  ],
];
$json = json_encode($json_sample, JSON_UNESCAPED_UNICODE);
// $json = json_encode($json_sample);
echo $json;
file_put_contents('json_sample.json', $json);
?>