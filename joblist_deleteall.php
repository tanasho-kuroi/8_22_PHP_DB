<?php
// ●●●●●●●●●●●●●●●　物理削除処理(※論理削除を使っているので、こっちは現在使用していない(2021/1/5))　●●●●●●●●●●●●●●●●●●

// ●●●●●●●●●●●●　Web参照　●●●●●●●●●●●●●●●●●


///DB接続の関数化
include ("functions.php");//DB接続の関数
$pdo = connect_to_db();//DB接続の関数の返り値を$pdoに代入



try{
  // $stmt = $pdo->prepare('DELETE FROM joblist_table');//tableの中身を消す(id番号そのまま残る)
  $stmt = $pdo->prepare('TRUNCATE TABLE joblist_table');//tableごと削除して再作成(idが1に戻る)
  // $stmt = $pdo->prepare('DROP TABLE joblist_table');//tableごと削除しそのまま。。。注意！！
  $status=$stmt->execute();//今回idを取得する必要なし。
  // $stmt->execute(array(':id' => $_GET["id"]));//$_POSTでは消えなかった。$_GETじゃないとダメみたい。何故？

  if($status == false){
    echo 'エラーが発生しました。:' . $e->getMessage();
  }else{
    // echo "全データ削除しました。";
    header("Location:joblist_read.php");
    exit();
  }
  } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
}







// // 「dbname」「port」「host」「username」「password」を設定
// $dbn //DB,port, host 紐付け(gsacf_d07_22 が自分のDB名. 変えたのそこだけ)
//   = 'mysql:dbname=gsacf_d07_22;charset=utf8;port=3306;host=localhost';
// $user = 'root';
// $pwd = ''; // （空文字）
// try { //例外を投げる。これに当てはまらない(＝つまり例外)についての処理はcatchで行う
//   $pdo = new PDO($dbn, $user, $pwd); //PDO:DBサーバとPHPの通信、
// } catch (PDOException $e) { //DBサーバとPHPの通信がうまくいかない場合は
//   echo json_encode(["db error" => "{$e->getMessage()}"]); //getMessage例外時のメッセージ
//   exit();
// }

// try{
// // $stmt = $pdo->prepare('DELETE FROM joblist_table WHERE id = :id');//idはdeliteに飛ぶリンクで引っ張ってくる
// // $stmt->execute(array(':id' => $_GET["id"]));//$_POSTでは消えなかった。$_GETじゃないとダメみたい。何故？

// // $stmt = DROP TABLE joblist_table;//undefined と言われる
// // $stmt = TRUNCATE TABLE joblist_table;//undefined と言われる

// // バインド変数を設定
// $stmt->bindValue(':joblist', $joblist, PDO::PARAM_STR); //PDOクラスのbindValueを引っ張ってくる
// $stmt->bindValue(':skill', $skill, PDO::PARAM_STR); 
// $stmt->bindValue(':region', $region, PDO::PARAM_STR); 
// $stmt->bindValue(':resistDate', $resistDate, PDO::PARAM_STR);

// $status = $stmt->execute(); // SQLを実行 **エラーが起きていたのはMySQLの問題だった

// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetchAll 全てのデータを配列として格納する
// $output = "";

// // var_dump($result);//配列が全て入る
// // exit();

//   foreach ($result as $record) {
//     $stmt = $pdo->prepare('DELETE FROM joblist_table WHERE id = :id');//idはdeliteに飛ぶリンクで引っ張ってくる
//     $stmt->execute(array(':id' => $record["id"]));//$_POSTでは消えなかった。$_GETじゃないとダメみたい。何故？
//     // $output .= "<tr>"; //.=は追加していく演算子
//     // $output .= "<td>{$record["resistDate"]}</td>";
//     // $output .= "<td>{$record["joblist"]}</td>";
//     // $output .= "<td>{$record["skill"]}</td>";
//     // $output .= "<td>{$record["region"]}</td>";
//     // $output .= "<td><a href=joblist_delete.php?id={$record["id"]}>削除</a>\n</td>";
//     // $output .= "</tr>";
//     //  ↓HTMLに<tr><td>resistDate</td><td>joblist</td>....<tr>の形でデータが入る 
//   }


// echo "table全データ削除しました。";

// } catch (Exception $e) {
//           echo 'エラーが発生しました。:' . $e->getMessage();
// }

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

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>全データ削除完了</title>
  </head>
  <body>          
  <p>
      <a href="joblist_read.php">投稿一覧へ</a>
  </p> 
  </body>
</html>