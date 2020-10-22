<?php
$input1 = $_POST["input1"];

try{
    $pdo=new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');//ホストアドレス,IDパスはさくらなどレンタルサーバーの際は書き換え
}catch(PDOException $e){
    exit('DbConnectError:' .$e->getMessage());
}

$view="";

if($input1 !== ""){
    $stmt = $pdo->prepare("SELECT * FROM gs_ln_table WHERE title LIKE '%$input1%'");
}else{
    $stmt = $pdo->prepare("SELECT * FROM gs_ln_table");
}
$status = $stmt->execute();
if($status==false){
   $error = $stmt->errorInfo();
   exit("QueryError:".$error[2]);//処理を止めてエラーの文字列が出る
}else{
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        // $view .="<p>" .$result["inputdate"] .$result["id"]."-".$result["bookname"] ."</p>";//頭の.はデータを上書きしないで追加する記述
           $view .="<div>";
           $view .='<a href="u_view.php?id='.$result["id"].'">';
           $view .="<fieldset>";
           $view .="<table>";
           $view .="<tr><th>タイトル:</th>"."<td>".$result["title"]."</td></tr>";
           $view .="<tr><th>ジャンル:</th>"."<td>".$result["genre"]."</td></tr>";
           $view .="<tr><th>おすすめ度:</th>"."<td>".$result["star"]."</td></tr>";
           $view .="<tr><th>コメント:</th>"."<td>".$result["comment"]."</td></tr>";
           $view .="<tr><th>画像:</th>"."<td>".$result["image"]."</td></tr>";
           $view .="</table>";
           $view .='</fieldset>';
           $view .='</a>';
           $view .='<a href="delete.php?id='.$result["id"].'"><div>削除×</div></a>';
           $view .='</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自習用ファイル</title>
    <style type="text/css">
        body{
            background:cornflowerblue;
        }
        h1{
            text-align:center;
        }
        #wrapper{
            width:700px;
            margin:20px auto;
            border-radius:30px;
            background:white;
            padding:20px;
        }
        fieldset{
            border:solid 1px darkslateblue;
            border-radius:10px;
            margin:20px 0 0;
        }
        #cont{
            width:100%;
            margin:0 auto;
        }
        a{
            text-decoration:none;
            color:#333333;
        }
        a:link { color: #333333; }
        a:visited { color: #000080; }
        a:hover { color: #ff0000; }
        a:active { color: #ff8000; }
        th{
            width:120px;
            vertical-align:top;
        }
        td{
            width:570px;
        }
        input{
            width:500px;
            height:30px;
            margin:10px 0;
            border:2px solid darkslateblue;
            border-radius:10px;
        }
        .btn{
            width:150px;
            margin:30px auto;
            display:block;
            cursor:pointer;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <h1>ブックマーク一覧</h1>
        <form action="select.php" method="post">
        <div id="search">タイトル検索：
        <input type="text" name="input1">
        <input class="btn" type="submit" name="submit" value="検索">
        </div>
        </form>
        <div id="cont">
        <div class=""><?=$view?></div> 
        </div>
        <input class="btn" type="submit" onclick="location.href='index.php'" value="ブックマーク入力ページ">
    </div>
<script>

</script>
</body>
</html>