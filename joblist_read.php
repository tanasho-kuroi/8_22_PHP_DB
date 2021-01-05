<?php

// ●●●●●●●●●●●●●●●　一覧表示　●●●●●●●●●●●●●●●●●●



//DB接続の関数化
include ("functions.php");//DB接続の関数
$pdo = connect_to_db();//DB接続の関数の返り値を$pdoに代入

// var_dump($_POST);//object(PDOStatement)#2 (1) { ["queryString"]=> string(27) "SELECT * FROM joblist_table" }
// exit();

// SQL作成&実行,データを引っ張ってくるテーブル名を指定する。  (SQL: DBの操作のための言語)
// DESC:降順, ASC:昇順
if (isset($_POST['sort-resistDate'])) {//isset: 変数がセットされているかを調べる
  $sql = 'SELECT * FROM joblist_table ORDER BY resistDate DESC';
}elseif(isset($_POST['sort-joblist'])){
  $sql = 'SELECT * FROM joblist_table ORDER BY joblist ASC';
}elseif(isset($_POST['sort-skill'])){
  $sql = 'SELECT * FROM joblist_table ORDER BY skill ASC';
}elseif(isset($_POST['sort-region'])){
$sql = 'SELECT * FROM joblist_table ORDER BY region ASC';
}else{
$sql = 'SELECT * FROM joblist_table';
}
// この時は単に'SELECT * FROM joblist_table'という文字列を$sqlで定義しているだけ


$stmt = $pdo->prepare($sql); //PDOクラスのprepareを引っ張ってくる

// var_dump($stmt);//object(PDOStatement)#2 (1) { ["queryString"]=> string(27) "SELECT * FROM joblist_table" }
// exit();

// バインド変数を設定
$stmt->bindValue(':joblist', $joblist, PDO::PARAM_STR); //PDOクラスのbindValueを引っ張ってくる
$stmt->bindValue(':skill', $skill, PDO::PARAM_STR); 
$stmt->bindValue(':region', $region, PDO::PARAM_STR); 
$stmt->bindValue(':resistDate', $resistDate, PDO::PARAM_STR);

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
// var_dump($record["delete_flag"]);//
// exit();
    if($record["delete_flag"]==1){
    }else{
      $output .= "<tr>"; //.=は追加していく演算子
      $output .= "<td>{$record["resistDate"]}</td>";
      $output .= "<td>{$record["joblist"]}</td>";
      $output .= "<td>{$record["skill"]}</td>";
      $output .= "<td>{$record["region"]}</td>";
      $output .= "<td><a href=joblist_edit.php?id={$record["id"]}>編集</a></td>";//getでidを送っている
      // $output .= "<td><a href=joblist_delete.php?id={$record["id"]}>削除</a>\n</td>";//getでidを送っている
      $output .= "<td><a href=joblist_logic_delete.php?id={$record["id"]}>削除</a>\n</td>";//論理削除
      $output .= "</tr>";
      //  ↓HTMLに<tr><td>resistDate</td><td>joblist</td>....<tr>の形でデータが入る 
    }
  }
  
  $output2 = "{$_POST["msg"]}";

      // $output .= "<td><a href=joblist_deleteall.php}>全削除</a>\n</td>";
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
  <title>DB連携型joblist（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>DB連携型joblist（一覧画面）</legend>
    <a href="joblist_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>resistDate</th>
          <th>joblist</th>
          <th>skill</th>
          <th>region</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>resistDate</td><td>joblist</td>....<tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>

    </table>
        </br>

        <p>削除したデータ：<?= $output2 ?></p>
        </br>
        </br>

        <a href="joblist_logic_read.php">削除したデータを表示</a>
        </br>
        </br>
        <a href="joblist_deleteall.php">全削除</a>


        <p>ソートボタン</p>
        <div class="sort-button">
          <form action="joblist_read.php" method="post">
            <button type="submit" name="sort-resistDate" class="btn btn-info" style="margin-right: 10px;">日付</button>
            <button type="submit" name="sort-joblist" class="btn btn-info" style="margin-right: 10px;">仕事内容</button>
            <button type="submit" name="sort-skill" class="btn btn-info" style="margin-right: 10px;">スキル</button>
            <button type="submit" name="sort-region" class="btn btn-info" style="margin-right: 10px;">地域</button>
          </form>
        </div>

  </fieldset>
</body>

</html>