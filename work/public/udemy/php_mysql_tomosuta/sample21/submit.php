<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sample21</title>
</head>

<body>
  <h2>ご予約予定日</h2>
  <?php if (!empty($_REQUEST['reserve'])) : ?>
    <?php $reserves = $_REQUEST['reserve']; ?>
    <?php foreach ($reserves as $reserve) : ?>
      <li><?= htmlspecialchars($reserve, ENT_QUOTES); ?></li>
    <?php endforeach; ?>
  <?php else : ?>
    <p>予約の指定はありません</p>
  <?php endif; ?>
</body>

</html>