function addToCart(id_produto) {

    window.location.href = `../controller/php/processar_cart.php?id_produto=${id_produto}`;

}

function removeToCart(id_produto) {
    window.location.href = `../controller/php/remove_cart.php?id_produto=${id_produto}`;
}