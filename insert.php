<?php
session_start();
include("funcs.php");
$pdo = db_conn();
//1. POSTデータ取得
$category   = $_POST["category"];
$num  = $_POST["num"];
$location  = $_POST["location"];
$points  = $_POST["points"];
$datetime  = $_POST["datetime"];
//$naiyou = $_POST["naiyou"];
//$img   = fileUpload("upfile","upload");

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table( category, num, location, points, datetime, indate )VALUES(:category, :num, :location, :points, :datetime, sysdate())");
$stmt->bindValue(':category', $category);
$stmt->bindValue(':num', $num);
$stmt->bindValue(':location', $location);
$stmt->bindValue(':points', $points);
$stmt->bindValue(':datetime', $datetime);
//$stmt->bindValue(':naiyou', $naiyou);
//$stmt->bindValue(':img', $img);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("index.php");
}
?>
