<?php
session_start();
ob_start();

require './Conn.php';
require './Crud.php';

if ((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Alteracao: incluindo shrink-to BS -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Bootstrap -->
    <link rel="shortcut icon" href="image/favicon2.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" 
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <title>Dashboard</title>
</head>
<body>
    
    <!-- <nav class="navbar navbar-expand-lg">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-md-9">                
                <a class="navbar-brand" href="#">BRA Parking</a>
            </div>
            <div class="col"></div>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav col-md-3 ml-auto"> -->
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="cadastrar.php">Cadastrar <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="listar.php">Listar<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="contato.php">Contato <span class="sr-only">(current)</span></a>
                </li> -->
            <!-- </ul>
        </div>
    </nav> -->

    <div class="content">
         <!-- Sidebar -->
         <div class="sidebar">
                <a href="dashboard.php" class="sidebar-nav"><i class="icon fa-solid fa-gauge"></i><span>Perfil</span></a>

                <a href="listar.php" class="sidebar-nav"><i class="icon fa-solid fa-list"></i><span>Listar</span></a>

                <a href="cadastrar.php" class="sidebar-nav"><i class="icon fa-solid fa-file-lines"></i><span>Cadastrar</span></a>

                <!-- <a href="visualizar.php" class="sidebar-nav"><i class="icon fa-solid fa-eye"></i><span>Visualizar</span></a> -->

                <!-- <a href="alerta.php" class="sidebar-nav"><i class="icon fa-solid fa-triangle-exclamation"></i><span>Alerta</span></a>

                <a href="botao.php" class="sidebar-nav"><i class="icon fa-solid fa-egg"></i><span>Botões</span></a> -->

                <a href="sair.php" class="sidebar-nav"><i class="icon fa-solid fa-arrow-right-from-bracket"></i><span>Logout</span></a>
            </div>

            <div class="container-fluid">
                <h1>Bem vindo!<?php echo $_SESSION['nome'];?></h1><br>
                <?php if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                } ?>
                <img id="embreve" src="image/em-breve.jpg" alt="construcao"><br><br><br>
                <a href="sair.php">Sair</a>
            </div>
    </div>
       
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" 
    crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="js/custom.js"></script>
</body>
</html>
