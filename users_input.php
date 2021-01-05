<!DOCTYPE html>
<html lang="ja">
<!-- // ●●●●●●●●●●●●●●●　新規データ入力画面　●●●●●●●●●●●●●●●●●● -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> ユーザ作成画面 </title>
</head>

<body>
  <!-- formで"joblist_create.php" を使うよという宣言をする(最初これが抜けてた) -->
  <form action="users_create.php" method="POST">/
    <fieldset>
      <legend> ユーザ作成画面 </legend>
      <a href="users_read.php">ユーザ一覧画面</a>

      <div>
        名前: <input type="text" name="username" id="username_input">
      </div>
      <div>
        パスワード: 
        <input type="text" name="password" id="password_input">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

  <!-- <a href="joblist_autoinput.php">Auto Input</a> -->
  <button id="btn">自動入力</button>
  <div id="echo"></div>
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script>
// <body>
//   <h1>オブジェクトの練習</h1>
//   <button id="btn">表示</button>
//   <div id="echo"></div>



      $('#btn').on('click', function () {
      // 乱数(ここは趣味)
        var random= Math.floor(Math.random()*21);
        // console.log(random);
      // データの作成
        const classes = [
          { username: 'ジーズ太郎' +random, password: random},
        ];
      // ブラウザ上に表示
        // $('#echo').html('<p>' + classes[0].joblist + '</p>' + '<p>' + classes[0].skill + '</p>')

        document.getElementById( "username_input" ).value = classes[0].username;
        document.getElementById( "password_input" ).value = classes[0].password;
      })


      // // 乱数(日付)(ここは趣味)
      // function getRandomYmd(fromYmd, toYmd){
      
      //   var d1 = new Date(fromYmd);
      //   var d2 = new Date(toYmd);
      
      //   var c = (d2 - d1) / 86400000;
      //   var x = Math.floor(Math.random() * (c+1));
      
      //   d1.setDate(d1.getDate() + x);
      
      //   //フォーマット整形
      //   var y = d1.getFullYear();
      //   var m = ("00" + (d1.getMonth()+1)).slice(-2);
      //   var d = ("00" + d1.getDate()).slice(-2);
      
      //   return y + "-" + m + "-" + d;
      // }
    
  </script>



</body>

</html>