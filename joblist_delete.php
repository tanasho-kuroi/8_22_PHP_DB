<?php
// ●●●●●●●●●●●●●●●　全削除(物理削除)処理　●●●●●●●●●●●●●●●●●●

// ●●●●●●●●●●●●　Web参照　●●●●●●●●●●●●●●●●●


//DB接続の関数化
include ("functions.php");//DB接続の関数
$pdo = connect_to_db();//DB接続の関数の返り値を$pdoに代入


$id = $_GET['id']; //GETでid取得
try{
$sql = 'DELETE FROM joblist_table WHERE id = :id'; //DELETE文を格納。idはバインド変数として残す
$stmt=$pdo -> prepare($sql);//$pdoはDBサーバとの通信
// ->: アロー演算子。PDOクラスのprepareを引っ張ってくる??
$stmt->bindValue(":id", $id, PDO::PARAM_INT);//bindvalue形式でidを取得。
$status = $stmt->execute(); //取得したidを$sqlに入力したもので実行

// $stmt = $pdo->prepare('DELETE FROM joblist_table WHERE id = :id');//idはdeliteに飛ぶリンクで引っ張ってくる
// $stmt->execute(array(':id' => $_GET["id"]));//$_POSTでは消えなかった。$_GETじゃないとダメみたい。何故？

// echo "削除しました。";
header("Location:joblist_read.php");
exit();

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

// $status = $stmt->execute(); // SQLを実行 **エラーが起きていたのはMySQLの問題だった

// var_dump($status);
// exit();

// print_r($e);

// if ($status == false) {
//   $error = $stmt->errorInfo();
//   exit('sqlError:' . $error[2]);
// } else {
//   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//   $output = "";
// }
?>
<!-- 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>削除完了</title>
  </head>
  <body>          
  <p>
      <a href="joblist_read.php">投稿一覧へ</a>
  </p> 
  </body>
</html> -->