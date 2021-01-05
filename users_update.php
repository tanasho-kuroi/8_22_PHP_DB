<?php

// ●●●●●●●●●●●●●●●　更新の処理内容　●●●●●●●●●●●●●●●●●●
//  todo_edit.phpでtodo_update.phpにidと更新内容を送る。updateの処理はtodo_update.phpで行う
//  ↑todo_input.phpとtodo_create.php みたいな感じ

// 各値をpostで受け取る
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];

include('functions.php'); //関数のファイルを呼び出し
$pdo = connect_to_db(); //関数の出力を$pdoに代入

// データ登録SQL作成
// data登録SQL作成
$sql = "UPDATE users_table SET username=:username,
password=:password,
updated_at=sysdate() WHERE id=:id";
// ここでもWHEREで指定！重要！！id指定がないと全部更新されちゃう！
// users_table をUPDATE処理、それぞれの変数を割り当て、最後にWHEREでid指定。


// SQL準備&実行
$stmt=$pdo->prepare($sql);

$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();//$stmtを実行した結果を$statusに保存
//$stmtを１行ずつvar_dump  で確認したが、$stmtが変わっているわけではない(= (代入)ではないから？)

// var_dump($stmt);
// exit();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg"=>"{$error[2]}"]);
    exit();
} else {
// 正常にSQLが実行された場合は入力ページファイルに移動する
    // header("Location:password_input.php");
// 正常にSQLが実行された場合は一覧ページファイルに移動し、処理を実行する
    header("Location:users_read.php");

    exit();
}
