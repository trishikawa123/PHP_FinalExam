<?php
session_start();
$id = $_GET["id"]; //?id~**を受け取る
include("funcs.php");
sschk();
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    sql_error($stmt);
}else{
    $row = $stmt->fetch();
}

// ライブラリ読み込み
require_once "phpqrcode/qrlib.php";

// URLを定数に設定
$url = 'create_qr.php?data='.$_GET['data'];
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min4.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<?php include("menu.php"); ?>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update2.php">
  <div class="jumbotron">
   <fieldset>
    <legend>[編集]</legend>
     <label>日時：<input type="datetime" name="datetime" readonly value="<?=$row["datetime"]?>"></label><br>
     <label>カテゴリー：<input type="text" name="category" readonly value="<?=$row["category"]?>"></label><br>
     <label>試合：<input type="text" name="num" readonly value="<?=$row["num"]?>"></label><br>
     <label>対戦相手：<input type="text" name="vs" readonly value="<?=$row["vs"]?>"></label><br>
     <label>場所：<input type="text" name="location" readonly value="<?=$row["location"]?>"></label><br>
     <label>ポイント：<input type="integer" name="points" readonly value="<?=$row["points"]?>"></label><br>
     <?php echo '<img src="create_qr.php" />'?>
     <br>
     <input type="submit" value="獲得">
     <input type="hidden" name="id" value="<?=$id?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
