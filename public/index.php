<?php
require_once("../lib/bootloader.php");
$lives = getAllLive();

$lives_history = getAllLive(0, true);
?>
<!doctype html>
<html lang="ja">
<head>
  <?php include "../include/header.php"; ?>
  <title>トップ - <?=$env["Title"]?></title>
  <style>
    .top_lists {
      width: 100%;
      padding: 10px 0;
      background: #333;
    }

    .top_lists .no {
      text-align: center;
      color: #606984;
      margin: 50px 0;
    }
    .card {
      color: #212529;
      margin-top: 5px;
    }
    .card-base a {
      text-decoration: none;
    }
    .card-img-top {
      width: 150px;
    }
    .card-img-div {
      text-align: center;
      background: #212121;
    }
    .card-title {
      text-overflow: ellipsis;
      white-space: nowrap;
      max-width: 110%;
      overflow: hidden;
    }
  </style>
</head>
<body>
<?php include "../include/navbar.php"; ?>
<div class="container">
  <div class="top_lists">
    <?php if (!$lives[0]) : ?>
      <div class="no">
        <h4>現在、生放送中の配信はありません</h4>
      </div>
    <?php else : ?>
      <div class="container">
        <h3>KnzkLive: 只今配信中！</h3>
        <div class="row">
          <?php
          if ($lives) {
            $i = 0;
            while (isset($lives[$i])) {
              $url = liveUrl($lives[$i]["id"]);
              $image = getUser($lives[$i]["user_id"])["misc"]["avatar"];
              echo <<< EOF
<div class="col-md-3 card-base">
<a href="{$url}">
<div class="card">
  <div class="card-img-div">
    <img class="card-img-top" src="{$image}">
  </div>
  <div class="card-body">
    <h5 class="card-title">{$lives[$i]["name"]}</h5>
    <p class="card-text">{$lives[$i]["description"]}</p>
  </div>
</div>
</a>
</div>
EOF;
              $i++;
            }
          }
          ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <hr>
</div>
<div class="container" style="margin-top:10px">
  <h3>配信履歴</h3>
  <div class="row">
    <?php
    if ($lives_history) {
      $i = 0;
      while (isset($lives_history[$i])) {
        $url = liveUrl($lives_history[$i]["id"]);
        $image = getUser($lives_history[$i]["user_id"])["misc"]["avatar"];
        echo <<< EOF
<div class="col-md-3 card-base">
<a href="{$url}">
<div class="card">
  <div class="card-img-div">
    <img class="card-img-top" src="{$image}">
  </div>
  <div class="card-body">
    <h5 class="card-title">{$lives_history[$i]["name"]}</h5>
    <p class="card-text">{$lives_history[$i]["description"]}</p>
  </div>
</div>
</a>
</div>
EOF;
        $i++;
      }
    }
    ?>
  </div>
</div>

<?php include "../include/footer.php"; ?>
</body>
</html>
