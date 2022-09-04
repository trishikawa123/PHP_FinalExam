<?php
session_start();
include("funcs.php");
sschk();
$id = filter_input( INPUT_GET, "id" );
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    sql_error($stmt);
}else{
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>USERデータ登録</title>
  <link href="css/bootstrap.min3.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["name"]; ?>さん
    <?php echo $_SESSION["user_id"]; ?>　　
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>My Profile</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <br>
     <!-- <label>チーム：<input type="text" name="team" value="<?=$row["team"]?>"></label><br>
     <br> -->
     <label>email：<input type="text" name="email" value="<?=$row["email"]?>"></label><br>
     <br>
     <label>住所：<input type="text" name="address" value="<?=$row["address"]?>"></label><br>
     <br>
     <label>生年月日：<input type="date" name="bday" value="<?=$row["bday"]?>"></label><br>
     <br>
     <label>Login ID：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <br>
     <label>Login PW：<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <!-- <label>管理FLG： -->
      <!-- 一般<input type="radio" name="kanri_flg" value="0">　
      管理者<input type="radio" name="kanri_flg" value="1"> -->
    </label>
    <br>
     <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
