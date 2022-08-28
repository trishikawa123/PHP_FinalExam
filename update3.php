<?php
session_start();
sschk();
$pdo = db_conn();

//1. POSTデータ取得
$category  = $_POST["category"];
$num = $_POST["num"];
$vs    = $_POST["vs"];
$location = $_POST["location"];
$points = $_POST["points"];
$datetime   = $_POST["datetime"];
$id    = $_POST["id"];   //idを取得

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数


//３．データ登録SQL作成
// $stmt = $pdo->prepare("INSERT INTO user_event( points )VALUES(:points)");
// $stmt->bindValue(':points',  $points,   PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

$stmt = $pdo->prepare ("SELECT * FROM gs_user_table JOIN user_event ON gs_user_table.id = user_event.user_id");
$stmt->bindValue(':user_id', $_POST["user_id"], PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}
?>
