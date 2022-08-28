<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php" enctype="multipart/form-data">
    <div class="jumbotron">
        <fieldset>
            <legend>イベント</legend>
            <label>カテゴリー：<input type="text" name="category"></label><br>
            <label>マッチ：<input type="text" name="num"></label><br>
            <label>場所：<input type="text" name="location"></label><br>
            <label>ポイント数：<input type="text" name="points"></label><br>
            <label>開催日：<input type="date" name="datetime"></label><br>
<!--
            <label><textArea name="naiyou" rows="4" cols="40"></textArea></label><br>
            <label><input type="file" name="upfile" accept="image/*"></label><br>
-->
            <input type="submit" value="送信">
        </fieldset>
    </div>
</form>
<!-- Main[End] -->



</body>
</html>
