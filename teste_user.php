<?php 
include_once "class/Cliente.php";

$cliente = new Cliente();
$cli = $cliente->buscarPorUsuario(182);

print_r($cliente->getTelefone());


?>