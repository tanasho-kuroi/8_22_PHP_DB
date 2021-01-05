<?php

function connect_to_db()
{
    // 「dbname」「port」「host」「username」「password」を設定
    $dbn //DB,port, host 紐付け(gsacf_d07_22 が自分のDB名. 変えたのそこだけ)
    = 'mysql:dbname=gsacf_d07_22;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = ''; // （空文字）
    try { //例外を投げる。これに当てはまらない(＝つまり例外)についての処理はcatchで行う
    return new PDO($dbn, $user, $pwd); //PDO:DBサーバとPHPの通信、元々$pdoだったところをreturn(関数返り値)
    } catch (PDOException $e) { //DBサーバとPHPの通信がうまくいかない場合は
    echo json_encode(["db error" => "{$e->getMessage()}"]); //getMessage例外時のメッセージ
    exit();
    }
}
