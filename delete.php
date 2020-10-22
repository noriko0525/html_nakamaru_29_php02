<?php
$id      = $_GET["id"];

try{
    $pdo=new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');//ホストアドレス,IDパスはさくらなどレンタルサーバーの際は書き換え
}catch(PDOException $e){
    exit('DbConnectError:' .$e->getMessage());
}

$sql = 'DELETE FROM gs_ln_table WHERE id = :id;';
$stmt = $pdo->prepare($sql);
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