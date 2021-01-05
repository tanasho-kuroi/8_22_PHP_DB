<?php
// ●●●●●●●●●●●●●●●　論理削除したデータを元に戻す(フラグを０にするだけ)　●●●●●●●●●●●●●●●●●●


// ●●●●●●●●●●●●　Web参照　●●●●●●●●●●●●●●●●●


//DB接続の関数化
include ("functions.php");//DB接続の関数
$pdo = connect_to_db();//DB接続の関数の返り値を$pdoに代入


$id = $_GET['id']; //GETでid取得

try{
// $sql = 'DELETE FROM joblist_table WHERE id = :id'; //DELETE文を格納。idはバインド変数として残す
$sql = 'UPDATE joblist_table SET delete_flag=0 WHERE id = :id'; //DELETE文を格納。idはバインド変数として残す
$stmt=$pdo -> prepare($sql);//$pdoはDBサーバとの通信
// ->: アロー演算子。PDOクラスのprepareを引っ張ってくる??
$stmt->bindValue(":id", $id, PDO::PARAM_INT);//bindvalue形式でidを取得。
$stmt->delete_flag=1 ;//delete_flag に1を代入
$status = $stmt->execute(); //取得したidを$sqlに入力したもので実行

// echo "削除しました。";
header("Location:joblist_logic_read.php");
exit();

} catch (Exception $e) {
        echo 'エラーが発生しました。:' . $e->getMessage();
}
?>

