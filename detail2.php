<?php

//1. POSTデータ取得
$category  = $_POST["category"];
$num = $_POST["num"];
$vs    = $_POST["vs"];
$location = $_POST["location"];
$points = $_POST["points"];
$datetime   = $_POST["datetime"];
$id    = $_POST["id"];   //idを取得


// (2) データベースに接続

$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

// (3) SQL作成
$stmt = $pdo->prepare("INSERT INTO user_event (
	points
) VALUES (
	:points
)");

// (4) 登録するデータをセット
$stmt->bindParam( ':points', $points, PDO::PARAM_INT);

// (5) SQL実行
$res = $stmt->execute();

// (6) データベースの接続解除
$pdo = null;

/４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}
?>