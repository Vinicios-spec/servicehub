<?php 

include_once "config/conexao.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    echo "<h3>Chamado pela ação do formulário (POST)</h3>";
    $id = $_POST['txtid'];
    $sql = "select nome from servicos where id = :id";
    $cmd = $pdo->prepare($sql);
    $cmd->execute([":id"=>$id]);
    $serv = $cmd->fetch(PDO::FETCH_ASSOC);
    var_dump($serv);
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    echo "<h3>Chamado pelo URL ou formulário method='get</h3>";
    $idViaGet = $_GET['txtid'];
    var_dump($idViaGet);
    $sql = "select nome from servicos where id = :id";
    $cmd = $pdo->prepare($sql);
    $cmd->execute([":id"=>$idViaGet]);
    $serv = $cmd->fetch(PDO::FETCH_ASSOC);
    var_dump($serv);
}


// var_dump($_SERVER['REQUEST_METHOD']);


?>
