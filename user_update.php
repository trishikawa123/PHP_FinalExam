<?php
//$_SESSION使うよ！
session_start();


//1.POSTデータ取得
$name  = $_POST["name"];
$email = $_POST["email"];
$address    = $_POST["address"];
$bday    = $_POST["bday"];
$lid    = $_POST["lid"];
$lpw    = $_POST["lpw"];
// $kanri_flg    = $_POST["kanri_flg"];
// $life_flg    = $_POST["life_flg"];
// $points    = $_POST["points"];
// $reward    = $_POST["reward"];
// $id     = $_POST["id"];


//2.DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();
$pdo = db_conn();

//3.データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_user_table SET name=:name,email=:email,address=:address,bday=:bday,lid=:lid,lpw=:lpw,WHERE id=:id");
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':bday', $bday, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//6.データ登録処理後
if($status==false){
    sql_error($stmt);
  }else{
    redirect("home.php");
  }
  ?>