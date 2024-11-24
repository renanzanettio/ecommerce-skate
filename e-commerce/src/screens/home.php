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




if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['filtro'])) {
    $selectedFilter = $_POST['filtro'];

    if ($selectedFilter === 'todos') {
        $code_filtro = "SELECT * FROM produtos";
        $query_filtro = $mysqli->query($code_filtro) or die("Falha na execução do código SQL: " . $mysqli->error);

        while ($fetch_filtro = $query_filtro->fetch_assoc()) {
            $filtro[] = $fetch_filtro;
        }

        $_SESSION['filtro'] = $filtro;
    } elseif ($selectedFilter === 'montado') {
        $code_filtro = "SELECT * FROM produtos where tipo_produto = 'skate'";
        $query_filtro = $mysqli->query($code_filtro) or die("Falha na execução do código SQL: " . $mysqli->error);

        while ($fetch_filtro = $query_filtro->fetch_assoc()) {
            $filtro[] = $fetch_filtro;
        }

        $_SESSION['filtro'] = $filtro;

    } elseif ($selectedFilter === 'shape') {
        $code_filtro = "SELECT * FROM produtos where tipo_produto = 'shape'";
        $query_filtro = $mysqli->query($code_filtro) or die("Falha na execução do código SQL: " . $mysqli->error);

        while ($fetch_filtro = $query_filtro->fetch_assoc()) {
            $filtro[] = $fetch_filtro;
        }

        $_SESSION['filtro'] = $filtro;

    } elseif ($selectedFilter === 'kit-truck') {
        $code_filtro = "SELECT * FROM produtos where tipo_produto = 'kit'";
        $query_filtro = $mysqli->query($code_filtro) or die("Falha na execução do código SQL: " . $mysqli->error);

        while ($fetch_filtro = $query_filtro->fetch_assoc()) {
            $filtro[] = $fetch_filtro;
        }

        $_SESSION['filtro'] = $filtro;
    }
}

if(isset($_SESSION['filtro'])){
    $filtro = $_SESSION['filtro'];
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/smartphone.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Skate Store</title>
</head>

<body>

    <nav class="navbar navbar-light container-fluid">
        <div class="container-fluid navbar-content">
            <div class="div-logo-name-navbar">
                <a class="navbar-brand" href="#">
                    <img src="../imgs/logo.png" alt="logo" class="logo-navbar">
                    <label for="">MRKT</label </a>

            </div>

            <div class="icons-navbar">
                <a href="./cart.php">
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
                        </div>
                        <div class='line-navbar'></div>
                        <a href='../controller/php/logout.php'><ion-icon name='log-out-outline' class='cart-navbar''></ion-icon></a>
                        "
                        
                        
                        ;
                    } else {
                        echo "<a href='./login.php'><input type='button' class='btn-login-navbar' value='Entrar'></input></a>";
                    }

                    ?>



                </div>

            </div>

        </div>
    </nav>

    <div class="home-screen container-fluid">

        <div class="background-home-screen container-fluid">

        </div>

        <div class="conteudo-home-screen container-fluid">

            <div class="txt-home-screen">
                <label class="title-home-screen">Onde sua Jornada Começa!</label>
                <label class="subtitle-home-screen"> Para quem faz das ruas seu palco e das manobras seu estilo</label>
            </div>

            <img src="../imgs/skate-homescreen.png" alt="skate" class="skate-homescreen">

        </div>


    </div>

    <section id="produtos"></section>
    <div class="items-screen">

        <div class="row-categorias-loja">

            <div class="categoria-loja">

                <div class="txt-categoria ">
                    <label class="subtitle-categoria">Pronto para qualquer desafio!</label>
                    <label class="title-categoria">Skate Montado</label>
                </div>

                <img src="../imgs/skate-montado-categoria.png" alt="Skate Montado" class="categoria-img-1">

            </div>

            <div class="categoria-loja">

                <div class="txt-categoria">
                    <label class="subtitle-categoria">Leveza em cada manobra!</label>
                    <label class="title-categoria">Shape</label>
                </div>

                <img src="../imgs/shape-categoria.png" alt="Shape" class="categoria-img-2">

            </div>

            <div class="categoria-loja categoria-3">

                <div class="txt-categoria">
                    <label class="subtitle-categoria">Truck + Roda de alta qualidade!</label>
                    <label class="title-categoria">Kit Truck</label>
                </div>

                <img src="../imgs/kit-truck-categoria.png" alt="Skate Montado" class="categoria-img-3">

            </div>




        </div>

        <div class="row-top-items-screen">

            <div class="txt-row-top">
                <div class="title-items-screen">Produtos em destaque:</div>
                <div class="subtitle-items-screen">Confira o melhor de cada categoria!</div>
            </div>

            <form id="filterForm" action="./home.php#produtos" method="POST">
                <div class="conteudo-filtro-item-screen">

                    <input type="radio" name="filtro" id="todos" class="option-filtro" value="todos"
                        onclick="submitForm()" <?php echo (isset($_POST['filtro']) && $_POST['filtro'] === 'todos') ? 'checked' : ''; ?>>
                    <label for="todos">Todos</label>

                    <input type="radio" name="filtro" id="montado" class="option-filtro" value="montado"
                        onclick="submitForm()" <?php echo (isset($_POST['filtro']) && $_POST['filtro'] === 'montado') ? 'checked' : ''; ?>>
                    <label for="montado">Montado</label>

                    <input type="radio" name="filtro" id="shape" class="option-filtro" value="shape"
                        onclick="submitForm()" <?php echo (isset($_POST['filtro']) && $_POST['filtro'] === 'shape') ? 'checked' : ''; ?>>
                    <label for="shape">Shape</label>

                    <input type="radio" name="filtro" id="kit-truck" class="option-filtro" value="kit-truck"
                        onclick="submitForm()" <?php echo (isset($_POST['filtro']) && $_POST['filtro'] === 'kit-truck') ? 'checked' : ''; ?>>
                    <label for="kit-truck">Kit Truck</label>

                </div>
            </form>

        </div>






        <div class="grid-produtos row">


            <?php

            if(isset($filtro) && !empty($filtro)){
                foreach ($filtro as $produto) {

                    echo "<input type='text' class='displaynone' id='idProduto' value='" . $produto['id_produto'] . "'>
                    </input>
                    <div class='card-produto col-md-5'>
                    
                    <div class='card-image' style=\"background-image: url('../imgs/" . htmlspecialchars($produto['imagem_produto']) . "');\"></div>
              
                    <div class='div-texts-card'>
              
                        <div class='title-card'>" . $produto['nome_produto'] . "</div>
              
                        <div style='display:flex; flex-direction:row; justify-content:space-between; align-items:center; position:relative; width:100%;'>
                            <div style='display:flex; flex-direction:column'>
                                <div class='card-prices'>
                                    <div class='incash-card'>R$" . str_replace('.', ',', $produto['preco_produto']) . "</div>
              
                                    <div class='installments-card'>6x de R$" . str_replace('.', ',', round(intval($produto['preco_produto']) / 6, 2)) . " sem juros</div>
                                </div>
                            </div>
              
                            <div class='add-to-cart-button' id='addToCart' onclick='addToCart(" . $produto['id_produto'] . ")'>
                                <ion-icon name='cart-outline' class='cart-button'></ion-icon>
                            </div>                    
                        </div>
                    </div>
                </div>";
                }
            }  else{
                foreach ($produtos as $produto) {

                    echo "<input type='text' class='displaynone' id='idProduto' value='" . $produto['id_produto'] . "'>
                    </input>
                    <div class='card-produto col-md-5'>
                    
                    <div class='card-image' style=\"background-image: url('../imgs/" . htmlspecialchars($produto['imagem_produto']) . "');\"></div>
              
                    <div class='div-texts-card'>
              
                        <div class='title-card'>" . $produto['nome_produto'] . "</div>
              
                        <div style='display:flex; flex-direction:row; justify-content:space-between; align-items:center; position:relative; width:100%;'>
                            <div style='display:flex; flex-direction:column'>
                                <div class='card-prices'>
                                    <div class='incash-card'>R$" . str_replace('.', ',', $produto['preco_produto']) . "</div>
              
                                    <div class='installments-card'>6x de R$" . str_replace('.', ',', round(intval($produto['preco_produto']) / 6, 2)) . " sem juros</div>
                                </div>
                            </div>
              
                            <div class='add-to-cart-button' id='addToCart' onclick='addToCart(" . $produto['id_produto'] . ")'>
                                <ion-icon name='cart-outline' class='cart-button'></ion-icon>
                            </div>                    
                        </div>
                    </div>
                </div>";
                }
            }




            ?>















        </div>
    </div>




    <script>
        function submitForm() {
            document.getElementById("filterForm").submit();
        }
    </script>
    <script src="../controller/js/add-to-cart.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>