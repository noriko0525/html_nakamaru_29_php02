<?php
$id=$_GET["id"];

try{
    $pdo=new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');//ホストアドレス,IDパスはさくらなどレンタルサーバーの際は書き換え
}catch(PDOException $e){
    exit('DbConnectError:' .$e->getMessage());
}

$sql = "SELECT * FROM gs_ln_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
    $error = $stmt->errorInfo();
 //    print_r($error);//配列の内容を確認
    exit("QueryError:".$error[2]);//処理を止めてエラーの文字列が出る
 }else{
     $row = $stmt->fetch();
    print_r($row);
 }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        body{
            background:cornflowerblue;
        }
        #wrapper{
            width:700px;
            margin:20px auto;
            border-radius:30px;
            background:white;
            padding:20px;
        }
        h1{
            width:100%;
            text-align:center;
        }
        input{
            width:500px;
            height:30px;
            margin:10px 0;
            border:2px solid darkslateblue;
            border-radius:10px;
        }
        textarea{
            width:500px;
            margin:10px 0;
            border:2px solid darkslateblue;
            border-radius:10px;
        }
        #wrapper p{
            width:100px;
            font-weight:bold;
            font-size:20px;
        }
        .btn{
            width:150px;
            margin:30px auto;
            display:block;
            cursor:pointer;
        }
        #cont{
            width:500px;
            margin:0 auto;
        }
    </style>
</head>
<body>
    <form method="post" action="update.php">
    <div id="wrapper">
        <h1>ブックマーク編集ページ</h1>
        <div id="cont">
                <div class="title"><p>サイト名</p><input type="text" name="title" value="<?=$row["title"]?>"></div>
                <div class="genre"><p>ジャンル</p><input type="text" name="genre" value="<?=$row["genre"]?>"></div>
                <div class="star"><p>評価</p><input type="text" name="star" value="<?=$row["star"]?>"></div>
                <div class="comment"><p>コメント</p><textarea name="comment" id="" cols="40" rows="4"><?=$row["comment"]?></textarea></div>
                <div class="image"><p>ファイル</p><?=$row["image"]?></div>
                <input type="hidden" name="up_file" value="<?=$row["image"]?>">
                <input type="hidden" name="id" value="<?=$row["id"]?>">
                <input class="btn" type="submit" value="送信">    
        </div>
    </div>
</form>
</body>

</html>