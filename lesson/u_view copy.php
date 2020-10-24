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
            background: radial-gradient(#F2B9A1, #EA6264);
        }
        #wrapper{
            width:700px;
            margin:20px auto;
            border-radius:30px;
            background:white;
            padding:20px;
            color:#EA6264;
        }
        .waku{
            width:500px;
            height:50px;
            margin:10px 0;
            border-radius:10px;
            border:none;
            background:#d3d3d3;
            padding:5px;
        }
        :focus {
            outline: none;
        }
        h1{
            width: 100%;
            text-align: center;
            font-size: 50px;
        }
        input{
            width:500px;
            /* height:30px; */
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
            width: 100%;
            font-weight: bold;
            font-size: 20px;
            margin: 30px 0 0 0;
            text-align: center;
        }
        .btn{
            width: 250px;
            padding: 10px;
            margin: 50px auto;
            display: block;
            cursor: pointer;
            border: none;
            border-radius: 10px;
            background: #EA6264;
            color: #ffffff;
            font-weight: bold;
            font-size: 20px;
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
        <h1>おもいできろくかきかえ</h1>
        <div id="cont">
                <div class="title"><p>サイト名</p><input type="text"class="waku" name="title" value="<?=$row["title"]?>"></div>
                <div class="genre"><p>ジャンル</p><input type="text"class="waku" name="genre" value="<?=$row["genre"]?>"></div>
                <div class="star"><p>評価</p><input type="text"class="waku" name="star" value="<?=$row["star"]?>"></div>
                <div class="comment"><p>コメント</p><textarea class="waku" name="comment" id="" cols="40" rows="4"><?=$row["comment"]?></textarea></div>
                <div class="image"><p>ファイル</p>
                <?php
                    if($row["image"] ==""){
                    $view .="<div>";
                    $view .="<div>88</div>";
                    }else{
                    $view .= $row["image"] . "\n";
                    $view .= '<input type="hidden" name="up_file" value="'.$row["image"].'">' . "\n";
                    $view .= '<a href="javascript:void(0);" ' . "\n";
                    $view .= 'onclick="var ok = confirm(\'削除しますか？\');' . "\n";
                    $view .= 'if (ok) location.href=\'delete.php?id='.$row['id'].'&del=1\'">' . "\n";
                    $view .= '<i class="far fa-trash-alt"></i> 削除</a>' . "\n";
                    }
                ?>
                <?=$view?>          
                </div>
                <input type="hidden" name="id" value="<?=$row["id"]?>">
                <input class="btn" type="submit" value="送信">    
        </div>
    </div>
</form>
</body>

</html>