<?php
session_start();
include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();


//1. POSTデータ取得
$category  = $_POST["category"];
$num = $_POST["num"];
$vs    = $_POST["vs"];
$location = $_POST["location"];
$points = $_POST["points"];
$datetime   = $_POST["datetime"];
$id    = $_POST["id"];   //idを取得
$user_id = $_SESSION["user_id"];

//2. DB接続します
$pdo = db_conn();      //DB接続関数


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO user_event( points,user_id )VALUES($points,$user_id)");

// $stmt = $pdo->prepare ("SELECT * FROM gs_user_table INNERJOIN user_event ON gs_user_table.id = user_event.user_id where user_event.user_id=?");

$status = $stmt->execute(); //実行



//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("home.php");
}
?>
