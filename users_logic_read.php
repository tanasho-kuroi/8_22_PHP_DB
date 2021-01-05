<?php

// ●●●●●●●●●●●●●●●　論理削除したデータを一覧表示　●●●●●●●●●●●●●●●●●●


//DB接続の関数化
include ("functions.php");//DB接続の関数
$pdo = connect_to_db();//DB接続の関数の返り値を$pdoに代入

// SQL作成&実行,データを引っ張ってくるテーブル名を指定する。  (SQL: DBの操作のための言語)
// DESC:降順, ASC:昇順
if (isset($_POST['sort-username'])) {//isset: 変数がセットされているかを調べる
  $sql = 'SELECT * FROM users_table ORDER BY username DESC';
}else{
$sql = 'SELECT * FROM users_table';
}
// この時は単に'SELECT * FROM users_table'という文字列を$sqlで定義しているだけ


$stmt = $pdo->prepare($sql); //PDOクラスのprepareを引っ張ってくる

// var_dump($stmt);//object(PDOStatement)#2 (1) { ["queryString"]=> string(27) "SELECT * FROM users_table" }
// exit();

// バインド変数を設定
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR); //PDOクラスのbindValueを引っ張ってくる

$status = $stmt->execute(); // SQLを実行 **エラーが起きていたのはMySQLの問題だった

// var_dump($status);//bool
// exit();


if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetchAll 全てのデータを配列として格納する
  $output = "";

// var_dump($result);//配列が全て入る
// exit();

  foreach ($result as $record) {
// var_dump($record["is_deleted"]);//
// exit();
    if($record["is_deleted"]==0){
    }else{
      $output .= "<tr>"; //.=は追加していく演算子
      $output .= "<td>{$record["username"]}</td>";
      $output .= "<td>{$record["password"]}</td>";
      $output .= "<td><a href=users_logic_comeback.php?id={$record["id"]}>データ復帰</a>\n</td>";//論理削除
      $output .= "</tr>";
      //  ↓HTMLに<tr><td>username</td><td>joblist</td>....<tr>の形でデータが入る 
    }
  }

      // $output .= "<td><a href=users_deleteall.php}>全削除</a>\n</td>";
 // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($record);
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザデータ（削除データ一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>ユーザデータ（削除データ一覧画面）</legend>
    <a href="users_read.php">一覧画面</a>
    <table>
      <thead>
        <tr>
          <th>名前</th>
          <th>パスワード</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>username</td><td>joblist</td>....<tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>

    </table>

        <p>ソートボタン</p>
        <div class="sort-button">
          <form action="users_logic_read.php" method="post">
            <button type="submit" name="sort-username" class="btn btn-info" style="margin-right: 10px;">名前順</button>
          </form>
        </div>

  </fieldset>
</body>

</html>