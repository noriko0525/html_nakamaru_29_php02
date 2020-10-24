<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <title>自習用ファイル</title>
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
        h1{
            width:100%;
            text-align:center;
            font-size:50px;
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
        textarea{
            width:500px;
            margin:10px 0;
            border:2px solid darkslateblue;
            border-radius:10px;
        }
        #wrapper p{
            width:100%;
            font-weight:bold;
            font-size:20px;
            margin:30px 0 0 0;
            text-align:center;
        }
        .btn{
            width:230px;
            padding:10px;
            margin:50px auto;
            display:block;
            cursor:pointer;
            border:none;
            border-radius: 10px;
            background:#EA6264;
            color:#ffffff;
            font-weight:bold;
            font-size:20px;
        }
        #cont{
            width:500px;
            margin:0 auto;
        }
        .select-center{
            text-align:center;
        }
        .genre{
            text-align:center;
        }
        select option{
            background:#EA6264;
            color:#fff;
        }
        select option:hover,
        select option:checked{
            background:#EA6264;
            color:#fff;
        }
        .image-box{
            /* text-align:center; */
            margin:20px 0 0 0;
            border:solid 1px #d3d3d3;
        }
        .image-box{
            /* height:50px; */
            color:#696969;
            padding:5px;
        }
        #btn_fotter{
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <h1>おもいできろくノート</h1>
        <div id="cont">
             <!-- <form method="post" action="insert.php"> -->
             <form id="form1" method="post" action="insert.php" enctype="multipart/form-data">
                <div class="title"><p>タイトル</p>
                <input type="text" name="title" class="waku"> 
                </div>
                <div class="genre"><p>ねんれい</p>
                <div class="select-center">
                    <select name='genre' class="waku">
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                    </select>
                </div>
                </div>
                <div class="star"><p>ばしょ</p>
                    <div class="select-center">
                        <select name='star' class="waku">
                            <option value='おうち'>おうち</option>
                            <option value='じどうかん'>じどうかん</option>
                            <option value='おみせ'>おみせ</option>
                            <option value='こうえん'>こうえん</option>
                            <option value='ゆうえんち'>ゆうえんち</option>
                            <option value='きゃんぷ'>きゃんぷ</option>
                            <option value='ひろしま'>ひろしま</option>
                            <option value='えひめ'>えひめ</option>
                            <option value='うみ'>うみ</option>
                            <option value='やま'>やま</option>
                        </select>
                    </div>
                </div>
                <div class="comment"><p>コメント</p><textarea name="comment" id="" cols="40" rows="4" class="waku"></textarea></div>
                <!-- <div class="btn_table"><a href="select.php">一覧へ</a><div> -->
                <div class="image"><p>ファイル</p>
                <div class="image-box">
                <input type="file" accept="image/*" name="up_file">
                </div>
                </div>
                <!--https://www.webdesignleaves.com/pr/php/php_basic_06.php?name=%E3%83%9E%E3%82%A4%E3%82%B1%E3%83%AB&age=33-->
                <div id="btn_fotter">
                    <input class="btn" type="submit" value="アップデートする">
                    <input class="btn" type="button"  onclick="location.href='select.php'" value="いちらんにいく">
                </div>
                </form>
        </div>
    </div>
</form>
</body>
</html>