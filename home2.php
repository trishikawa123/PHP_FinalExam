<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT SUM(points) FROM user_event");
$status = $stmt->execute();

?>