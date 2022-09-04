<?php
session_start();
include("funcs.php");
sschk();
$pdo = db_conn();

$name = $_SESSION["name"];
$user_id = $_SESSION["user_id"];


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM reward_table");
$status = $stmt->execute();

$stmt_point = $pdo->prepare("SELECT SUM(points) FROM user_event WHERE user_id='$user_id'");
$status_point = $stmt_point->execute();

$val = $stmt_point -> fetch();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    if($val[0] > $r["points"]){
      $view .= '<p>';
      $view .= '<img src="upload/'.$r["img"].'" width="200">';
      $view .= '<a href="reward_detail.php?id='.$r["id"].'">';
      $view .= $r["id"]."|".$r["reward"]."|".$r["points"];
      $view .= '</a>';
      $view .= "　";

    }

    $view .= '</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min3.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<?php include("menu.php"); ?>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
<legend>REWARDS</legend>
  <div>
    <input type="text" id="keyword">
    <button id="send">検索</button>

</div>
    <div class="container jumbotron" id="view"><?=$view?></div>
</div>
<!-- Main[End] -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
//登録ボタンをクリック
$("#send").on("click", function() {
    //axiosでAjax送信
    //Ajax（非同期通信）
    const params = new URLSearchParams();
    params.append('keyword',   $("#keyword").val());
    
    //axiosでAjax送信
    axios.post('select2.php',params).then(function (response) {
        console.log(typeof response.data);//通信OK
        if(response.data){
          //>>>>通信でデータを受信したら処理をする場所<<<<
          document.querySelector("#view").innerHTML=response.data;
        }
    }).catch(function (error) {
        console.log(error);//通信Error
    }).then(function () {
        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
});
</script>

</body>
</html>
