<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once "config/conexao.php";
    $nome = $_POST['txtnome'];
    $descricao = $_POST['txtdescricao'];
    $preco = $_POST['txtpreco'];

    $sql = "insert servicos (nome, descricao, preco) values(:nome, :descricao, :preco)";
    $cmd = $pdo->prepare($sql);
    $cmd->execute([':nome' => $nome, ':descricao' => $descricao, ':preco' => $preco]);
    $id = $pdo->lastInsertId();

    if (isset($id)) {
        echo "Serviço cadastrado com Sucesso, com o ID" . $id;
    } else {
        echo "Falha ao cadastrar o serviço";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro de Serviços</title>
</head>

<body>
    <form class="form" action="formservico.php" method="post">
        <input type="number" name="txtid" id="" hidden>

        <label for="txtnome">Nome</label>
        <input type="text" name="txtnome" id="">

        <label for="txtdescricao">Descrição</label>
        <input type="text" name="txtdescricao" id="">

        <label for="txtpreco">Preço</label>
        <input type="text" name="txtpreco" id="">

        <button class="btn btn-lg" type="submit">Gravar</button>

    </form>
</body>

</html>