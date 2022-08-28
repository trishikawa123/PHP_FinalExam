<?php
//$_SESSION使うよ！
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();
$pdo = db_conn();


//1. POSTデータ取得
$name      = filter_input( INPUT_POST, "name" );
$email      = filter_input( INPUT_POST, "email" );
$address      = filter_input( INPUT_POST, "address" );
$bday      = filter_input( INPUT_POST, "bday" );
$lid       = filter_input( INPUT_POST, "lid" );
$lpw       = filter_input( INPUT_POST, "lpw" );
$kanri_flg = filter_input( INPUT_POST, "kanri_flg" );
$points = filter_input( INPUT_POST, "points" );
$reward = filter_input( INPUT_POST, "reward" );
$lpw       = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化

//2. DB接続します
// $pdo = db_conn();

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
