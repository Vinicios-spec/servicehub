<?php
require_once "config/conexao.php";

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL); 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['txtnome'];
    $idade = $_POST['txtidade'];
    $turma = $_POST['txtturma'];

    $sql = "insert servicos (nome, idade, turma) values(:nome, :idade, :turma)";
    $cmd = $pdo->prepare($sql);
    $cmd->execute([':nome'=>$nome, ':idade'=>$idade, ':turma'=>$turma]);
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
    <title>Cadastro de Alunos</title>
</head>

<body>
    <form action="formaluno.php" method="post">
        <input type="number" name="txtid" id="" hidden>

        <label for="txtnome">Nome</label>
        <input type="text" name="txtnome" id="">

        <label for="txtidade">Idade</label>
        <input type="text" name="txtidade" id="">

        <label for="txtturma">Turma</label>
        <input type="text" name="txtturma" id="">

        <button type="submit">Gravar</button>

    </form>
</body>
</html>

<h2>Lista dos Alunos</h2>
    <table border="1" cellpadding = 10>
        <tr>
           <th>ID</th>
           <th>Nome</th>
           <th>Idade</th>
           <th>Turma</th> 
        </tr>
        <?php foreach($alunos as $aluno): ?>
        <tr>
            <td><?= $aluno['id']?></td>
            <td><?= $aluno['nome']?></td>
            <td><?= $aluno['idade']?></td>
            <td><?= $aluno['turma']?></td>
        </tr>
        <?php endforeach; ?>