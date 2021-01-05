<?php
// ●●●●●●●●●●●●●●●　データ新規作成処理　●●●●●●●●●●●●●●●●●●


// var_dump($_POST);//まずここで、inputからPOSTされているかチェック
// exit();

// 入力チェック（未入力の場合は弾く，commentのみ任意）
if ( //!isset: 変数が宣言されてかつNULLではないこと。今回は！なのでその反対
  !isset($_POST['joblist']) || $_POST['joblist'] == '' || //POSTが入っていないか、データがからだった時
  !isset($_POST['skill']) || $_POST['skill'] == ''|| 
  !isset($_POST['region']) || $_POST['region'] == ''|| 
  !isset($_POST['resistDate']) || $_POST['resistDate'] == ''
) {
  exit('ParamError'); //処理終了しつつParamError出力
}

// 変数定義
$joblist = $_POST['joblist'];
$skill = $_POST['skill'];
$region= $_POST['region'];
$resistDate = $_POST['resistDate'];

// 「dbname」「port」「host」「username」「password」を設定
$dbn //DB,port, host 紐付け(gsacf_d07_22 が自分のDB名. 変えたのそこだけ)
  = 'mysql:dbname=gsacf_d07_22;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = ''; // （空文字）
try { //例外を投げる。これに当てはまらない(＝つまり例外)についての処理はcatchで行う
  $pdo = new PDO($dbn, $user, $pwd); //PDO:DBサーバとPHPの通信、
} catch (PDOException $e) { //DBサーバとPHPの通信がうまくいかない場合は
  echo json_encode(["db error" => "{$e->getMessage()}"]); //getMessage例外時のメッセージ
  exit();
}
// 「db error:...」が表示されたらdb接続でエラーが発生していることがわかる．
// ->: アロー演算子。PDOExceptionクラスから、getMessageを引っ張ってくる??
// =>: わからん！！

// SQL作成&実行,カラム名と値  (SQL: DBの操作のための言語)
$sql = 'INSERT INTO joblist_table(id, joblist, skill, region, resistDate, created_at, updated_at)VALUES(NULL, :joblist, :skill, :region, :resistDate, sysdate(), sysdate())';
// VALUESの「:」はバインド変数の宣言

$stmt = $pdo->prepare($sql); //PDOクラスのprepareを引っ張ってくる

// バインド変数を設定
$stmt->bindValue(':joblist', $joblist, PDO::PARAM_STR); //PDOクラスのbindValueを引っ張ってくる
$stmt->bindValue(':skill', $skill, PDO::PARAM_STR); 
$stmt->bindValue(':region', $region, PDO::PARAM_STR); 
$stmt->bindValue(':resistDate', $resistDate, PDO::PARAM_STR);

$status = $stmt->execute(); // SQLを実行 **エラーが起きていたのはMySQLとデータ型や名前が合っていないの問題だった


// 失敗時にエラーを出力し，成功時は登録画面に戻る
if ($status == false) {
  $error = $stmt->errorInfo();
  // データ登録失敗次にエラーを表示
  exit('sqlError:' . $error[2]);
} else {
  // 登録ページへ移動
  header('Location:joblist_input.php');
}
