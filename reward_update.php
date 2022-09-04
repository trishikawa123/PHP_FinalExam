<?php
session_start();
include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();


//1. POSTデータ取得
$reward  = $_POST["reward"];
$points = $_POST["points"];
$reward_id    = $_POST["id"];   //idを取得
$user_id = $_SESSION["user_id"];

//2. DB接続します

$pdo = db_conn();      //DB接続関数


//３．データ登録SQL作成
$stmt1 = $pdo->prepare("INSERT INTO user_reward( reward_id,user_id )VALUES($reward_id,$user_id)");

$status1 = $stmt1->execute(); //実行

// $stmt->bindValue(':reward',  $reward,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt2 = $pdo->prepare("INSERT INTO user_event( points,user_id )VALUES($points,$user_id)");

$status2 = $stmt2->execute(); //実行



//４．データ登録処理後
if($status2==false){
    sql_error($stmt2);
}else{
    redirect("reward.php");
}
?>
