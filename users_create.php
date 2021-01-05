<?php
// ●●●●●●●●●●●●●●●　データ新規作成処理　●●●●●●●●●●●●●●●●●●


// var_dump($_POST);//まずここで、inputからPOSTされているかチェック
// exit();

// 入力チェック（未入力の場合は弾く，commentのみ任意）
if ( //!isset: 変数が宣言されてかつNULLではないこと。今回は！なのでその反対
  !isset($_POST['username']) || $_POST['username'] == '' || //POSTが入っていないか、データがからだった時
  !isset($_POST['password']) || $_POST['password'] == ''
) {
  exit('ParamError'); //処理終了しつつParamError出力
}

// 変数定義
$username = $_POST['username'];
$password = $_POST['password'];


//DB接続の関数化
include ("functions.php");//DB接続の関数
$pdo = connect_to_db();//DB接続の関数の返り値を$pdoに代入


// SQL作成&実行,カラム名と値  (SQL: DBの操作のための言語)
// $sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, created_at, updated_at)VALUES(NULL, :username, :password, :is_admin, :is_deleted, sysdate(), sysdate())';
$sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, created_at, updated_at)VALUES(NULL, :username, :password, 0, 0, sysdate(), sysdate())';
// VALUESの「:」はバインド変数の宣言

$stmt = $pdo->prepare($sql); //PDOクラスのprepareを引っ張ってくる
// var_dump($pdo);
// var_dump($sql);
// exit();

// バインド変数を設定
$stmt->bindValue(':username', $username, PDO::PARAM_STR); //PDOクラスのbindValueを引っ張ってくる
$stmt->bindValue(':password', $password, PDO::PARAM_STR); 

$status = $stmt->execute(); // SQLを実行 


// 失敗時にエラーを出力し，成功時は登録画面に戻る
if ($status == false) {
  $error = $stmt->errorInfo();
  // データ登録失敗次にエラーを表示
  exit('sqlError:' . $error[2]);
} else {
  // 登録ページへ移動
  header('Location:users_input.php');
}
