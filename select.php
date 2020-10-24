<?php
$input1 = $_POST["input1"];

try{
    $pdo=new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');//ホストアドレス,IDパスはさくらなどレンタルサーバーの際は書き換え
}catch(PDOException $e){
    exit('DbConnectError:' .$e->getMessage());
}

$view="";

if($input1 !== ""){
    $stmt = $pdo->prepare("SELECT * FROM gs_ln_table WHERE title LIKE '%$input1%' OR star LIKE '%$input1%' OR genre LIKE '%$input1%' OR comment LIKE '%$input1%'");
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
        //    $view .='<div class="tile">';
        //    $view .='<a href="u_view.php?id='.$result["id"].'">';
        //    $view .="<fieldset>";
        //    $view .="<table>";
        //    $view .="<tr><th>タイトル:</th>"."<td>".$result["title"]."</td></tr>";
        //    $view .="<tr><th>ねんれい:</th>"."<td>".$result["genre"]."</td></tr>";
        //    $view .="<tr><th>おすすめ度:</th>"."<td>".$result["star"]."</td></tr>";
        //    $view .="<tr><th>コメント:</th>"."<td>".$result["comment"]."</td></tr>";
        //    $view .='<tr><th>画像:</th><td><img src="'.$result["image"] .'"width="100"></td></tr>';
        //    $view .="</table>";
        //    $view .='</fieldset>';
        //    $view .='</a>';
        //    $view .='<a href="delete.php?id='.$result["id"].'"><div>削除×</div></a>';
        //    $view .='</div>';

           $view .='<div class="tile">';
           $view .='<a href="u_view.php?id='.$result["id"].'">';
           $view .="<fieldset>";
           $view .='<img class="triming" src="'.$result["image"].'">';
           $view .='</fieldset>';
           $view .='</a>';
           $view .='<div class="delete">';
           $view .='<a href="delete.php?id='.$result["id"].'"><div>×</div></a>';
           $view .='</div>';
           $view .='</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>自習用ファイル</title>
    <style type="text/css">
        body{
            background: radial-gradient(#F2B9A1, #EA6264);
            font-family: "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", "Meiryo", "verdana", sans-serif;
        }
        h1{
            width:100%;
            text-align:center;
            font-size:50px;
            color:#ffffff;
            font-weight:bold;
        }
        #search{
            text-align:center;
            color:#ffffff;
            font-size:30px;
            font-weight:bold;
        }
        #search input{
            width: 500px;
            height: 50px;
            margin: 10px 0 0 10px;
            border-radius: 10px;
            border: none;
            /* background: #d3d3d3; */
            padding: 5px;
        }
        .btn{
            width:250px !important;
            height: 60px !important;
            margin:30px auto;
            cursor:pointer;
            z-index:100;
            position:absolute;
            font-size:20px;
            font-weight:bold;
            border-radius: 10px;
            border: none;
            background: #ffffff;
            padding: 5px;
        }
        #wrapper{
            /* width:100%;
            margin:20px auto;
            border-radius:30px;
            background:white;
            padding:20px; */
            
            margin: 0 auto;
            padding: 5px;
            width: 90%;
            /* background-color: #fff; */
            column-count: 5;
            column-gap: 0;
        }
        @media (max-width: 800px) {
        #wrapper {
            column-count: 2;
        }
        }

        @media (max-width: 480px) {
        #wrapper {
            column-count: 1;
        }
        }
        .tile{
            padding: 5px;
            -webkit-column-break-inside: avoid;
            page-break-inside: avoid;
            break-inside: avoid;
            position:relative;
        }
        fieldset{
            border-radius:10px;
            border:none;
            margin:20px 0;
            background-color:#ffffff;
        }
        .triming{
            width:100%;
	        object-fit:cover;
        }
        .delete{
            position:absolute;
            bottom:30px;
            right:10px;
            width:20px;
            height:20px;
            padding:2px;
            text-align:center;
            border-radius:5px;
            background-color:#5f9ea0;
        }
        .delete a{
            color:#ffffff;
        }
        #cont{
            /* width:100%;
            margin:0 auto; */
        }
        a{
            text-decoration:none;
            color:#333333;
        }
        th{
            width:120px;
            vertical-align:top;
        }
        td{
            width:570px;
        }
        #btn-wrapper{
            width:100%;
            height:100px;
            position:absolute;
            bottom:0px;
            text-align:center;
            /* background-color:#000000; */
        }
        #btn_add{
            position:absolute;
            text-align:center;
            background-color:#000000;
            opacity: 0.5;
            bottom:0px;
            right:0px;
            width:100%;
            height:100px;
            z-index:10;
        }
        .btn{

        }
    </style>
</head>
<body>
        <h1>おもいでいちらん</h1>
        <form action="select.php" method="post">
        <div id="search">けんさく：
        <input type="text" name="input1">
        <input class="btn" type="submit" name="submit" value="検索">
        </div>
        </form>
    <div id="wrapper">
        <!-- <div id="cont"> -->
        <?=$view?>
        <!-- </div> -->
    </div>
    <div id="btn-wrapper">
        
        <input class="btn" type="submit" onclick="location.href='index.php'" value="おもいでにゅうりょく">
        <div id="btn_add"></div>
    </div>
<script>

</script>
</body>
</html>