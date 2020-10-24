<?php
//1.入力チェック
//入力チェック
// エラーを出力する
ini_set('display_errors', "On");
if(
    !isset($_POST["title"]) || $_POST["title"] =="" ||
    !isset($_POST["genre"]) || $_POST["genre"] =="" ||
    !isset($_POST["star"]) || $_POST["star"] ==""||
    !isset($_FILES['up_file']['name']) || $_FILES['up_file']['name'] ==""
    // !isset($_POST["comment"]) || $_POST["comment"] ==""
){
    if($_POST["title"] ==""){
        exit('ParamErrorTitile');
    }elseif($_POST["genre"] ==""){
        exit('ParamErrorGenre');
    }elseif($_POST["star"] ==""){
        exit('ParamErrorStar');
    }elseif($_FILES['up_file']['name'] ==""){
        exit('ParamErrorImage');
    }
    exit('ParamError');
}

$id      = $_POST["id"];
$title   = $_POST["title"];
$genre   = $_POST["genre"];
$star    = $_POST["star"];
$comment = $_POST["comment"];
$image = "file/".$_FILES['up_file']['name'];

//一時ファイルができているか（アップロードされているか）チェック
//https://www.php.net/manual/ja/function.is-uploaded-file.php
if(is_uploaded_file($_FILES['up_file']['tmp_name'])){
    //一時ファイルを保存ファイルにコピーできたか
    //https://techacademy.jp/magazine/18804
    if(move_uploaded_file($_FILES['up_file']['tmp_name'],"file/".$_FILES['up_file']['name'])){
        //正常
        echo "uploaded";
    }else{
        //コピーに失敗（だいたい、ディレクトリがないか、パーミッションエラー）
        echo "error while saving.";
    }
}else{
    //そもそもファイルが来ていない。
    echo "file not uploaded.";
}

//2.書き込み処理
try{
    $pdo=new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');//ホストアドレス,IDパスはさくらなどレンタルサーバーの際は書き換え
}catch(PDOException $e){
    exit('DbConnectError:' .$e->getMessage());
}

$sql = "INSERT INTO gs_ln_table(id,title,genre,star,comment,image,inputdate)VALUES(NULL, :a1, :a2, :a3, :a4, :a5, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1',$title, PDO::PARAM_STR);//数値の時はPDO::PARAM_STRをPDO::PARAM_INT
$stmt->bindValue(':a2',$genre, PDO::PARAM_STR);
$stmt->bindValue(':a3',$star, PDO::PARAM_STR);
$stmt->bindValue(':a4',$comment, PDO::PARAM_STR);
$stmt->bindValue(':a5',$image, PDO::PARAM_STR);
// $stmt->bindValue(':a4',sysdate(), PDO::PARAM_STR);　//sysdateはnullでも自動で入れてくれる仕組み
$status = $stmt->execute();

//エラーチェック
if($status==false){
    $error = $stmt->errorInfo();
    print_r($error);//配列の内容を確認
    exit("QueryError:".$error[2]);//処理を止めてエラーの文字列が出る
 }else{
     header("Location: select.php");//半角スペースを入れること、エラーになるよ
     exit;
 }

?>

