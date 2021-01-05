<?php
// ●●●●●●●●●●●●●●●　論理削除処理　●●●●●●●●●●●●●●●●●●

// ●●●●●●●●●●●●　Web参照　●●●●●●●●●●●●●●●●●
// 削除したデータの内容をPOSTで送付
// https://qiita.com/okdyy75/items/d21eb95f01b28f945cc6


//DB接続の関数化
include ("functions.php");//DB接続の関数
$pdo = connect_to_db();//DB接続の関数の返り値を$pdoに代入


$id = $_GET['id']; //GETでid取得
try{
  // $sql = 'DELETE FROM joblist_table WHERE id = :id'; //DELETE文を格納。idはバインド変数として残す
  $sql = 'UPDATE joblist_table SET delete_flag=1 WHERE id = :id'; //DELETE文を格納。idはバインド変数として残す


  $stmt=$pdo -> prepare($sql);//$pdoはDBサーバとの通信
  // ->: アロー演算子。PDOクラスのprepareを引っ張ってくる??
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);//bindvalue形式でidを取得。
  $stmt->delete_flag=1 ;//delete_flag に1を代入
  $status = $stmt->execute(); //取得したidを$sqlに入力したもので実行
  //   // PDO::FETCH_ASSOC: は、結果セットに 返された際のカラム名で添字を付けた配列を返します。
  //   // 結果、$record には狙ったDBデータ１行分が格納される


  $sql2 = 'SELECT * FROM joblist_table WHERE id=:id';//SELECT文のセット、id指定した項目のみ
  $stmt2 = $pdo->prepare($sql2);//$pdoに$sqlを入力して使用準備した結果を$stmtに代入
  $stmt2 -> bindValue(':id',$id, PDO::PARAM_INT);//バインド変数で取得したidを$stmtに入力
  $status2 = $stmt2->execute();//$stmtを実行した結果を$statusに代入。$statusはboolでtrue or false

  // if ($status2 == false){
  //   $error = $stmt2->errorInfo();//PDOクラスのerrorInfo関数を$stmtに入力し、その結果を$errorに入力
  //   echo json_encode(["error_msg"=>"{$error[2]}"]);
  //   exit();
  // }else{
    $record2 = $stmt2->fetch(PDO::FETCH_ASSOC);//fetchで結果セット(配列みたいな感じ)の1行を取得する。
  //   // var_dump($record2);
  //   // // var_dump($stmt);
  //   // exit();
  // }

  // $stmt = $pdo->prepare('DELETE FROM joblist_table WHERE id = :id');//idはdeliteに飛ぶリンクで引っ張ってくる

  // header("Location:joblist_read.php");

  // 削除したデータの内容をPOSTで送付
        $deleteItem .= $record2["resistDate"];
        $deleteItem .= ', ';
        $deleteItem .= $record2["joblist"];
        $deleteItem .= ', ';
        $deleteItem .= $record2["skill"];
        $deleteItem .= ', ';
        $deleteItem .= $record2["region"];
      $url = 'http://localhost/8_22_kadai_PHP/joblist_read.php';
      $message = array(
          'msg' => $deleteItem,
      );
      $context = array(
          'http' => array(
              'method'  => 'POST',
              'header'  => implode("\r\n", array('Content-Type: application/x-www-form-urlencoded',)),
              'content' => http_build_query($message)
          )
      );
      $html = file_get_contents($url, false, stream_context_create($context));
      // var_dump($http_response_header);
      // var_dump($message);
      // var_dump($context);
      // var_dump($http);//NULLが返ってくる
  // exit();
      echo $html;

  exit();

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}


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