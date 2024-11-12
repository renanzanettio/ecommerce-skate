<?php

if (!isset($_SESSION)) {
    session_start();
}

function salvarCarrinhoNoCookie($carrinho) {
    setcookie('carrinho', json_encode($carrinho), time() + (86400 * 30), "/"); // 30 dias
}

if(!$_SESSION['qtdTotalCart']){
    $_SESSION['qtdTotalCart'] = 0;
}

function incrementarQuantidade($id_produto) {
    if (isset($_COOKIE['carrinho'])) {
        $carrinho = json_decode($_COOKIE['carrinho'], true); // Decodifica o carrinho salvo
    } else {
        $carrinho = [];
    }

    if (isset($carrinho[$id_produto])) {
        $carrinho[$id_produto]++;
    } else {
        $carrinho[$id_produto] = 1;
    }

    salvarCarrinhoNoCookie($carrinho);
    $_SESSION['qtdTotalCart'] = $_SESSION['qtdTotalCart'] + 1 ;

}



if (isset($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];
    incrementarQuantidade($id_produto);
}

header("Location: ../../screens/home.php#produtos");
exit();
?>
