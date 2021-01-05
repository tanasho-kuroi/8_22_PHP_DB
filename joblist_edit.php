<?php
// ●●●●●●●●●●●●●●●　更新内容入力画面　●●●●●●●●●●●●●●●●●●
//  todo_edit.phpでtodo_update.phpにidと更新内容を送る。updateの処理はtodo_update.phpで行う
//  ↑todo_input.phpとtodo_create.php みたいな感じ

include("functions.php");
// var_dump($_GET);
// exit();
$id = $_GET['id'];

$pdo = connect_to_db();//DB接続関数
$sql = 'SELECT * FROM joblist_table WHERE id=:id';//SELECT文のセット、id指定した項目のみ
$stmt = $pdo->prepare($sql);//$pdoに$sqlを入力して使用準備した結果を$stmtに代入
$stmt -> bindValue(':id',$id, PDO::PARAM_INT);//バインド変数で取得したidを$stmtに入力
$status = $stmt->execute();//$stmtを実行した結果を$statusに代入。$statusはboolでtrue or false

if ($status == false){
  $error = $stmt->errorInfo();//PDOクラスのerrorInfo関数を$stmtに入力し、その結果を$errorに入力
  echo json_encode(["error_msg"=>"{$error[2]}"]);
  exit();
}else{
  $record = $stmt->fetch(PDO::FETCH_ASSOC);//fetchで結果セット(配列みたいな感じ)の1行を取得する。
  // PDO::FETCH_ASSOC: は、結果セットに 返された際のカラム名で添字を付けた配列を返します。
  // 結果、$record には狙ったDBデータ１行分が格納される
  // var_dump($record);
  // var_dump($stmt);
  // exit();
  $record2 .= $record['resistDate'];
  $record2 .= ', ';
  $record2 .= $record['joblist'];
  $record2 .= ', ';
  $record2 .= $record['skill'];
  $record2 .= ', ';
  $record2 .= $record['region'];
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <!-- todo_update.phpにidと更新内容を送る。updateの処理はtodo_update.phpで行う -->
  <!-- ↑todo_input.phpとtodo_create.php みたいな感じ-->
  <!-- POSTであることに注意！！ -->
  <form action="joblist_update.php" method="POST">
    <fieldset>
      <legend>DB連携型joblist(**編集画面**)</legend>
      <a href="joblist_read.php">一覧画面へ戻る</a>
            <!-- 以下、ここはPOSTで送っている -->
            <!-- type, nameはあわせるだけ。valueは上記PHPから該当の値を引っ張ってくる -->

      <div>
        お仕事: <input type="text" name="joblist" value="<?= $record["joblist"] ?>">
      </div>
      <div>
        具体的なスキル(資格とかじゃなくてOK。何ができるか？を具体的に書いてください):</br>
        <input type="text" name="skill" value="<?= $record["skill"] ?>">
      </div>
      <div>
        住んでいる地域: <input type="text" name="region" value="<?= $record["region"] ?>">
      </div>
      <div>
        登録日: <input type="date" name="resistDate" value="<?= $record["resistDate"] ?>">
      </div>
      <div>
        <input type="hidden" name="id" value="<?= $record['id'] ?>">
        <!-- なぜhiddenなのか？ inputで入れたいが、ユーザがいじれない様にする為？ -->
      </div>
      <div>
        <button>submit</button>
      </div>
      
    </fieldset>
  </form>

  <div>
    <p>編集前：<?= $record2 ?></p>
  </div>
</body>

</html>