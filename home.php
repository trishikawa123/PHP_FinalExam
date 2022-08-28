<?php
session_start();
$name = $_SESSION["name"];


include('funcs.php');
sschk();

//２．データ登録SQL作成
// $sql = "SELECT SUM(points) FROM user_event";
// $stmt->bindValue(':id', $id, PDO::PARAM_INT); 
// $status = $stmt->execute();


// (2) データベースに接続

$pdo = db_conn();
$stmt = $pdo->prepare("SELECT SUM(points) FROM user_event");
$status = $stmt->execute();

$val = $stmt -> fetch();
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

    Welcome <?php echo $name; ?>　
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
     <label>現在のポイント：<?php echo $val[0]; ?></label><br>
     <br>
     <label>リワード：<input type="text" name="reward"></label><br>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
