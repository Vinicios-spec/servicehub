<?php 
session_start();
require_once "class/Servico.php";

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo']!=1){
  header("Location: login.php");
  exit();
}
$servicos = Servico::listar();
include "includes/header.php";
include "includes/menu.php";
?>


<main class="container mt-5">
  <h2>Solicitações</h2>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Descontinuado</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($servicos as $servico):?>
        <tr>
          <td><?= $servico['id'] ?></td>
          <td><?= $servico['nome'] ?></td>
          <td><?= $servico['descricao']?></td>
          <td><?= $servico['preco']?></td>
          <td>
            <?php 
              $lista = explode(", ", $servico['servicos']);
              foreach($lista as $serv){
               echo '<span class="badge bg-dark me-1 mb-1">'.$serv.'</span>';
              }            
            ?>
          </td>
          <td><?= $servico['status']?></td>
          <td><?= date("d/m/Y H:i", strtotime($servico["data_cad"])) ?></td>
          <td>
            <a href="admin_responder.php?id=" class="btn btn-primary btn-sm">Responder</a>
          </td>
        </tr>
        <?php endforeach ?>
    </tbody>
  </table>

  <a href="admin_dashboard.php" class="btn btn-secondary">Voltar</a>
</main>
<?php 
include "includes/footer.php"
?>