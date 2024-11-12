<?php 

if (!isset($_SESSION)) {
    session_start();
}

$code_produtos = "SELECT * FROM produtos";
$query_produtos = $mysqli->query($code_produtos) or die("Falha na execução do código SQL: " . $mysqli->error);

while ($fetch_produtos = $query_produtos->fetch_assoc()) {
    $produtos[] = $fetch_produtos;
}

$_SESSION['produtos'] = $produtos;

?>