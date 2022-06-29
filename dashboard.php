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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem vindo!<?php echo $_SESSION['nome'];?></h1>
    <?php if (isset($_SESSION['msg'])) {
              echo $_SESSION['msg'];
              unset($_SESSION['msg']);
    } ?>
    <a href="sair.php">Sair</a>
</body>
</html>