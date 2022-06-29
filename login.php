<?php
session_start();
ob_start();

include_once './Conn.php';
//require './Crud.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/favicon2.ico">
    <link rel="stylesheet" href="css/custom-login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>BRA parking - Login</title>
</head>
<body>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo">
                <img src="image/Logo carro.png" alt="BRA parking">
                <a href="index.php">BRA parking</a>
            </div>
            <ul class="menu" id="menu-site">
                <li><a href="index.php">Home</a></li>
                <li><a href="sobre-empresa.php">Sobre Empresa</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="login.php">Login|Cadastro</a></li>
            </ul>
            <div class="menu-btn" id="menu-btn">
                <i class="fa-solid fa-bars" id="menu-icon"></i>
            </div>
        </div>
    </nav>

    <section class="top">
        <div class="max-width">
            <div class="top-content">
                <nav class="d-flex">
                    <div class="container-login">
                        <div class="wrapper-login">
                            <div class="title">
                                <div class="logo1">
                                    <img src="image/Logo carro.png" alt="BRA parking" width="30px">
                                    <span>BRA parking</span>
                                </div>
                            </div>
                            <form action="./validaLogin.php" method="POST" class="form-login">
                                <div class="row">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="email" placeholder="E-mail" required>
                                </div>
                                <div class="row">
                                    <i class="fa-solid fa-lock"></i>
                                    <input type="password" name="brapa" placeholder="Senha" required>
                                </div>

                                <div class="row button">
                                    <input type="submit" name="db_login" value="Acessar">
                                </div>

                                <div class="signup-link">
                                    <a href="cadastrar.php">Cadastrar</a> - <a href="#">Esqueceu a senha</a><br>
                                    <?php if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                    } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </nav>   
            </div>
        </div>
    </section> 
    <footer>
        <span>Created By <a href="https://www.google.com.br/maps/place/Blumenau,+SC/@-26.8560346,-49.2391869,11z/data=!3m1!4b1!4m5!3m4!1s0x94df1e408b5c3095:0xacfb8520bc1a7644!8m2!3d-26.9165792!4d-49.0717331">BRA parking</a></span>
    </footer>
    <script src="js/custom.js"></script>
</body>
</html>