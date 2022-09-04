<?php
session_start();
$name = $_SESSION["name"];
$user_id = $_SESSION["user_id"];


include('funcs.php');
sschk();

//２．データ登録SQL作成
// $sql = "SELECT SUM(points) FROM user_event";
// $stmt->bindValue(':id', $id, PDO::PARAM_INT); 
// $status = $stmt->execute();


// (2) データベースに接続

$pdo = db_conn();
$stmt1 = $pdo->prepare("SELECT SUM(points) FROM user_event
WHERE user_id='$user_id'");
$status1 = $stmt1->execute();

$stmt2 = $pdo->prepare("SELECT * FROM user_reward JOIN reward_table ON user_reward.reward_id = reward_table.id WHERE user_id='$user_id'");
$status2 = $stmt2->execute();



$val1 = $stmt1 -> fetch();


$view="";

  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $val2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .= $val2["reward"];
    $view .= "</p>";
  }

// echo $val[0];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>HOME</title>
  <link href="css/bootstrap.min4.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
    Welcome <?php echo $name ?>
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>HOME</legend>
     <label>名前：<?php echo $name; ?>さん</label><br>
     <br>
     <label>チーム：</label><br>
     <br>
     <label>現在のポイント：<?php echo $val1[0]; ?></label><br>
     <br>
     <label>リワード：</label><br>
     <?php echo $view; ?>
     
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
