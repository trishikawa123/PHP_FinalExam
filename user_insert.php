<?php
//$_SESSION使うよ！
session_start();
include "funcs.php";
sschk();

//1. POSTデータ取得
$name  = $_POST["name"];
$email = $_POST["email"];
$address    = $_POST["address"];
$bday    = $_POST["bday"];
$lid    = $_POST["lid"];
$lpw    = $_POST["lpw"];
$kanri_flg    = $_POST["kanri_flg"];
$life_flg    = $_POST["life_flg"];
$points    = $_POST["points"];
$reward    = $_POST["reward"];
$user_id = $_SESSION["user_id"];

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(name,email,address,bday,lid,lpw,points,reward,kanri_flg,life_flg)VALUES(:name,:email,:address,:bday,:lid,:lpw,:points,:reward,:kanri_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR); 
$stmt->bindValue(':address', $address, PDO::PARAM_STR); 
$stmt->bindValue(':bday', $bday, PDO::PARAM_STR); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':points', $points, PDO::PARAM_INT); 
$stmt->bindValue(':reward', $reward, PDO::PARAM_STR); 
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: home.php");
    exit;
}
