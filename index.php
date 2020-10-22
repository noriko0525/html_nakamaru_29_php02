<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自習用ファイル</title>
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
        .waku{
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
            width:300px;
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
    <div id="wrapper">
        <h1>ブックマーク入力ページ</h1>
        <div id="cont">
             <!-- <form method="post" action="insert.php"> -->
             <form method="post" action="insert.php" enctype="multipart/form-data">
                <div class="title"><p>サイト名※必須</p><input type="text" name="title" class="waku"></div>
                <div class="genre"><p>ジャンル※必須</p><input type="text" name="genre" class="waku"></div>
                <div class="star"><p>評価※必須</p><input type="text" name="star" class="waku"></div>
                <div class="comment"><p>コメント</p><textarea name="comment" id="" cols="40" rows="4" class="waku"></textarea></div>
                <!-- <div class="btn_table"><a href="select.php">一覧へ</a><div> -->
                <div class="image"><p>ファイル</p><input type="file" accept="image/*" name="up_file"></div>
                <input class="btn" type="submit" value="アップデート">
                </form>
        </div>
    </div>
</form>
</body>
</html>