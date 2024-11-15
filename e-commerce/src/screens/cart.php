<?php

include("../controller/php/conexao.php");

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

if (isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];
}

if (isset($_SESSION['nome'])) {
    $nome = $_SESSION['nome'];
}


include('../controller/php/query_produto.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MKRT - Cart</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <nav class="navbar navbar-light container-fluid">
        <div class="container-fluid navbar-content">
            <div class="div-logo-name-navbar">
                <a class="navbar-brand" href="./home.php">
                    <img src="../imgs/logo.png" alt="logo" class="logo-navbar">
                    <label for="">MRKT</label </a>

            </div>

            <div class="icons-navbar">
                <a href="./home.php">
                    <div class="cart-background">
                        <ion-icon name="cart-outline" class="cart-navbar"></ion-icon>
                        <?php if (isset($_SESSION['qtdTotalCart']) && $_SESSION['qtdTotalCart'] > 0) {
                            echo '<div class="background-cart-notification"><label class="cart-notification">' . $_SESSION['qtdTotalCart'] . '</label></div>';
                        } ?>
                    </div>
                </a>


                <div class="line-navbar"></div>


                <div class="div-logins-navbar">

                    <?php
                    if (isset($id_usuario) && isset($nome) && isset($email)) {
                        echo "<div class='icon-login-background'>
                            <ion-icon name='person' class='icon-login'></ion-icon>
                        </div>
                        <div class='texts-navbar-login'>
                            <label>Ola, <b>" . $nome . "</b></label>
                            <label>" . $email . "</label>
                        </div>";
                    } else {
                        echo "<a href='./login.php'><input type='button' class='btn-login-navbar' value='Entrar'></input></a>";
                    }

                    ?>



                </div>

            </div>

        </div>
    </nav>

    <div class="cart-screen">

        <div class="container-cart">
            <div class="row-container-cart">

                <div class="txt-container-cart">
                    <div class="title-container-cart">Carrinho de Compras</div>
                    <div class="subtitle-container-cart">Informações de Registro</div>
                </div>

            </div>

            <div class="grid-container-cart">



                <?php
                $carrinho = json_decode($_COOKIE['carrinho'], true);

                if(!isset($num_carrinho)){
                    $num_carrinho = 0;                    
                }

                if (isset($_COOKIE['carrinho'])) {
                    foreach ($carrinho as $id_produto => $quantidade) {

                        $code_produto_carrinho = "SELECT * FROM produtos WHERE id_produto = " . $id_produto;
                        $query_produto_carrinho = $mysqli->query($code_produto_carrinho) or die("Falha na execução do código SQL: " . $mysqli->error);

                        while ($fetch_produto_carrinho = $query_produto_carrinho->fetch_assoc()) {
                            $produto_carrinho[] = $fetch_produto_carrinho;
                        }

                        $_SESSION['teste_carrinho'] = $produto_carrinho;


                        echo "
                            <div class='card-container-cart'>
                                
                                <div class='conteudo-card-cart'>
                                    <img src='../imgs/" . $produto_carrinho[$num_carrinho]['imagem_produto'] . "' alt=''>

                                    <div class='txt-card-cart'>

                                        <div class='title-card-cart'>" . $produto_carrinho[$num_carrinho]['nome_produto'] . "</div>

                                        <div class='prices-card-cart'>
                                            <div class='incash-card-cart'>R$" . str_replace('.', ',', $produto_carrinho[$num_carrinho]['preco_produto']) ."</div>
                                            <div class='installments-card-cart'>6x de R$" . str_replace('.', ',', round(intval($produto_carrinho[$num_carrinho]['preco_produto']) / 6 , 2)) . "</div>
                                        </div>

                                    </div>

                                </div>

                                <div class='buttons-card-cart'>
                                <div type='button' onclick='removeToCart(" . $id_produto . ")' value='Remover Produto' class='button-excluir-cart'><ion-icon name='trash-outline' class='trash-icon-card'></ion-icon></div>
                                <div class='quantidade-cart'> Quantidade: " . $quantidade . "</div>
                                </div>

                            </div>
                        ";
                        $num_carrinho = $num_carrinho + 1;
                    }
                } else {
                    echo "Seu carrinho está vazio!";
                }



                ?>








                <!-- <div class="card-container-cart">

                    <div class="conteudo-card-cart">
                        <?php echo '<img src="../imgs/' . $produtos[0]['imagem_produto'] . '" alt="' . $produtos[0]['nome_produto'] . '">' ?>

                        <div class="txt-card-cart">

                            <div class="title-card-cart"><?php echo $produtos[0]['nome_produto']; ?></div>

                            <div class="prices-card-cart">
                                <div class="incash-card-cart">
                                    R$<?php echo str_replace('.', ',', $produtos[0]['preco_produto']) ?></div>
                                <div class="installments-card-cart">6x de
                                    R$<?php echo str_replace('.', ',', round(intval($produtos[0]['preco_produto']) / 6, 2)) ?>
                                </div>
                            </div>

                        </div>



                    </div>

                    <div class="buttons-card-cart">
                        <input type='button' onclick='removeToCart(" . $id_produto . ")' value='Remover Produto'>
                    </div>

                </div> -->


            </div>

        </div>













        <!-- <a href="./home.php"><input type="button" value="HOME"></a>

        <?php
        if (isset($_COOKIE['carrinho'])) {
            $carrinho = json_decode($_COOKIE['carrinho'], true);

            echo "<h3>Produtos no Carrinho:</h3>";
            foreach ($carrinho as $id_produto => $quantidade) {
                echo "Produto ID: $id_produto - Quantidade: $quantidade <input type='button' onclick='removeToCart(" . $id_produto . ")' value='Remover Produto'><br>";
            }
        } else {
            echo "Seu carrinho está vazio.";
        }
        ?> -->

    </div>






    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../controller/js/add-to-cart.js"></script>
</body>

</html>