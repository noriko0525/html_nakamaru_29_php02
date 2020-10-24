<?php
$id      = $_POST["id"];
$title   = $_POST["title"];
$genre   = $_POST["genre"];
$star    = $_POST["star"];
$comment = $_POST["comment"];
$image = $_POST["up_file"];


echo $id;
echo $star ;

try{
    $pdo=new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');//ホストアドレス,IDパスはさくらなどレンタルサーバーの際は書き換え
}catch(PDOException $e){
    exit('DbConnectError:' .$e->getMessage());
}

$sql = 'UPDATE gs_ln_table SET title=:title, genre=:genre, star=:star, comment=:comment ,image=:image WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title',$title, PDO::PARAM_STR);//数値の時はPDO::PARAM_STRをPDO::PARAM_INT
$stmt->bindValue(':genre',$genre, PDO::PARAM_STR);
$stmt->bindValue(':star',$star, PDO::PARAM_STR);
$stmt->bindValue(':comment',$comment, PDO::PARAM_STR);
$stmt->bindValue(':image',$image, PDO::PARAM_STR);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
    $error = $stmt->errorInfo();
 //    print_r($error);//配列の内容を確認
    exit("QueryError:".$error[2]);//処理を止めてエラーの文字列が出る
 }else{
     header("location: select.php");//必ず半角スペース入れる！！
     exit;
}

?>