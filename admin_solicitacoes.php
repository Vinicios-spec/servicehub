<?php 
session_start();
require_once "class/Solicitacao.php";

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo']!=1){
  header("Location: login.php");
  exit();
}
$solicitacoes = Solicitacao::listar();
include "includes/header.php";
include "includes/menu.php";
?>


<main class="container mt-5">
  <h2>Solicitações</h2>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Email</th>
        <th>Serviços</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($solicitacoes as $solicitacao):?>
        <tr>
          <td><?= $solicitacao['id'] ?></td>
          <td><?= $solicitacao['cliente_nome'] ?></td>
          <td><?= $solicitacao['email']?></td>
          <td>
            <?php 
              $lista = explode(", ", $solicitacao['servicos']);
              foreach($lista as $serv){
               echo '<span class="badge bg-dark me-1 mb-1">'.$serv.'</span>';
              }            
            ?>
          </td>
          <td><?= $solicitacao['status']?></td>
          <td><?= date("d/m/Y H:i", strtotime($solicitacao["data_cad"])) ?></td>
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