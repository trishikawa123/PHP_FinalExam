<?php
session_start();
sschk();
$pdo = db_conn();

//1. POSTデータ取得
$reward  = $_POST["reward"];
$points = $_POST["points"];
$id    = $_POST["id"];   //idを取得

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table( reward )VALUES(:reward)");
// $stmt->bindValue(':reward',  $reward,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute(); //実行



//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("reward.php");
}
?>
