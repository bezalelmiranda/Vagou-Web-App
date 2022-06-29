<?php 
session_start();
ob_start();

require './Conn.php';
require './Crud.php';

if ((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login.php");
}
if ($_SESSION['nivel-acesso'] != 1){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Somente Administrador!</p>";
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

    <title>BRA PARK</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-md-9">                
                <a class="navbar-brand" href="#">BRA Parking</a>
            </div>
            <div class="col"></div>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav col-md-3 ml-auto">
                <li class="nav-item active">
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
                </li>
            </ul>
        </div>
    </nav>

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
        <!-- <div class="wrapper">
            <div class="row">
                <div class="top-list">
                    <span class="title-content">Listar Vagas Livres</span>
                    <div class="top-list-right"></div>
                </div> -->

    <?php 

        //Mostra a mensagen e depois destroi a mesma
        if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        }
        
        // echo "<div class='content'>";
        echo "<div class='wrapper'>";
        echo "<div class='row'>";
        // echo "<div class='top-list'>";
        // echo "<span class='title-content'>Listar Vagas Livres</span>";
        // echo "<div class='top-list-right'>";
        // echo "<a href='#' class='btn btn-outline-dark btn-lg'>Adicionar Veículo</a>";
        // echo "<a href='#' class='btn btn-outline-dark btn-lg'>Cadastrar Cliente</a>";
        // echo "</div>";
        // echo "</div>";

        // echo "<h2>Listar Vagas Livres</h2>"; 
        //Insanciar a Classes
        //Criando o Objeto $listarUsuarios
        $query_vagas = "SELECT * FROM vagas WHERE hora_entrada < 1 ";
        $result_vagas = $conn->prepare($query_vagas);
        $result_vagas->execute();
            
        // //Imprime informações do danco teste
        foreach($result_vagas as $row_vagas){
        //     //var_dump($row_vagas);
            extract($row_vagas);
        //     echo "<div class='card border-success mb-3' style='width: 15rem;'>";
        //     echo "<img src='./image/BRAPARKING.png' class='card-img-top' alt='Vaga-Logo'>";
        //     echo "<div class='card-body text-success'>";
            // echo "N° da Vaga: $n_vaga<br>";
            // echo "Horario de Entrada: $hora_entrada<br>";
            // echo "Horario De Saida: $hora_saida<br><br><hr>";
            // $vglivres = array();
            // $vglivres = $n_vagas;
        //     echo "<h5 class='card-title'>Vaga $n_vaga</h5>";
        //     echo "<ul class='list-inline'>";
        //     echo "<li class='card-text list-inline-item'><strong>E $hora_entrada</strong></li>";
        //     echo "<li class='card-text list-inline-item'><strong>S $hora_saida</strong></li>";
        //     echo "</ul>";
        //     echo "<a href='#' class='btn btn-primary'>Finalizar</a>";
        //     echo "</div>"; 
        //     echo "</div>";
                
        }

        echo "<div class='top-list'>";
        echo "<span class='title-content'>Listar Vagas Ocupadas</span>";
        echo "<div class='top-list-right'>";
        echo "<button type='button' class='btn btn-primary' data-toggle='modal' 
        data-target='#vagaModal'>Adicionar Veículo</button>";
        // echo "<a href='#' class='btn btn-primary'>Adicionar Veículo</a>";
        echo "</div>";
        echo "</div>";
        
        // echo "<h2>Listar Vagas Ocupadas</h2>";
        //Insanciar a Classes
        //Criando o Objeto $listarUsuarios
        $query_vagas = "SELECT * FROM vagas WHERE hora_entrada > 1 ";
        $result_vagas = $conn->prepare($query_vagas);
        $result_vagas->execute();
            
        //Imprime informações do danco teste
        foreach($result_vagas as $row_vagas){
            //var_dump($row_vagas);
            extract($row_vagas);
            echo "<div class='card' style='width: 12rem;'>";
            echo "<img src='./image/BRAPARKING.png' class='card-img-top' alt='Vaga-Logo'>";
            echo "<div class='card-body'>";
            // echo "N° da Vaga: $n_vaga<br>";
            // echo "Horario de Entrada: $hora_entrada<br>";
            // echo "Horario De Saida: $hora_saida<br><br><hr>";
            echo "<h5 class='card-title'>Vaga $n_vaga</h5>";
            echo "<ul class='list-inline'>";
            echo "<li class='card-text list-inline-item'><strong>E $hora_entrada</strong></li>";
            echo "<li class='card-text list-inline-item'><strong>S $hora_saida</strong></li>";
            echo "</ul>";
            echo "<a href='#' class='btn btn-primary'>Finalizar</a>";
            echo "</div>"; 
            echo "</div>";
                
        }
        echo "</div>";
        echo "</div>";

    ?>

    </div>

     <!-- Modal -->
     <div class="modal fade" id="vagaModal" tabindex="-1" aria-labelledby="vagaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="vagaModalLabel">Adicionar Veículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" name="add_veiculo" method="POST" enctype="multipart/form-data">
                        <div class="form-group text-primary">
                            <label for="placa">Placa:</label>
                            <input class="form-control" type="text" name="placa" id="placa"
                            placeholder="Número da placa" required><br><br>
                        
                            <label for="foto_placa">Foto:</label>
                            <input class="form-control-file" type="file" name="foto_placa" id="foto_equipamento"><br><br>

                            <input type="submit" id="btn-addvaga" class="btn btn-primary ml-10" value="Adicionar" name="AddVeiculo">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    // $vagaslivres = filter_input_array(INPUT_GET, 'id', FILTER_DEFAULT);

    // $retorna = ['vagas' => $vagaslivres];

    // echo json_encode($retorna);

    ?>

    <!-- JQuery -->
    <script src="js/custom.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" 
    crossorigin="anonymous"></script>
</body>
</html>
