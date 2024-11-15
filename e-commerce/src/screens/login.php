<?php
include("../controller/php/conexao.php");

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $code_login = "SELECT id_usuario, nome_usuario FROM usuario WHERE senha_usuario = '" . $senha . "' AND email_usuario = '" . $email . "';";
    $query_login = $mysqli->query($code_login) or die("Falha na execução do código SQL: " . $mysqli->error);

    while ($fetch_login = $query_login->fetch_assoc()) {
        $login[] = $fetch_login;
        $_SESSION['id'] = $login[0]['id_usuario'];
        $_SESSION['nome'] = $login[0]['nome_usuario'];
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
    }


    if (($query_login->num_rows) == 0) {
        echo "Cadastro não encontrado";
    } elseif (($query_login->num_rows) == 1) {
        header('location: ./home.php');
        // echo $_SESSION['id'];
        // echo $_SESSION['nome'];
    }





    // echo $nome . "<br>" . $email . "<br>" . $senha;
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Skate Store</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <form action="" method="POST">

        <div class="wrapper-login">
            <div class="container-login">

                <div style="display:flex; align-items:start; flex-direction:column;width:80%">
                    <div class="title-login">Login</div>
                    <div class="subtitle-login">Insira seus dados para avançar</div>
                </div>

                <div class="column-input">
                    <div class="bundle-input-label">
                        <label for="email" class="input-label">E-mail</label>
                        <input type="text" placeholder="E-mail" name="email" class="input-login">
                    </div>

                    <div class="bundle-input-label">
                        <label for="senha" class="input-label">Senha</label>
                        <input type="password" placeholder="Senha" name="senha" class="input-login">
                    </div>

                </div>
                <input type="submit" class="button-login" value="Entrar">
            </div>
        </div>








    </form>




</body>

</html>