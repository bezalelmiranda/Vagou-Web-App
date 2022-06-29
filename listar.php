<?php 
session_start();
ob_start();

include_once './Conn.php';
//require './Crud.php';

if ((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login.php");

    //Mostra a mensagen e depois destroi a mesma
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="image/favicon2.ico">
    <link  rel=" folha de estilo "   href=" CSS/reset.css ">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">
    <title>BRA PARK</title>
</head>
<body class="listar-adm">
    <!-- <nav class="nav">
        <div class="max-width">
            <div class="logo">
                <img src="image/Logo carro.png" alt="BRA parking">
                <a href="index.php">BRA parking</a>
            </div>
            <ul class="menu" id="menu-site">
                <li><a href="index.php">Home</a></li>
                <li><a href="sobre-empresa.php">Sobre Empresa</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
            <div class="menu-btn" id="menu-btn">
                <i class="fa-solid fa-bars" id="menu-icon"></i>
            </div>
        </div>
    </nav> -->

    <div class="content">
        <!-- Sidebar -->
        <div class="sidebar">
        <a href="dashboard.php" class="sidebar-nav"><i class="icon fa-solid fa-gauge"></i><span>Perfil</span></a>

        <a href="vagas.php" class="sidebar-nav"><i class="icon fa-solid fa-car"></i><span>Vagas</span></a>

        <a href="#" class="sidebar-nav"><i class="icon fa-solid fa-file-lines"></i><button class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">Cadastrar</button></a>
        

        <!-- <a href="visualizar.php" class="sidebar-nav"><i class="icon fa-solid fa-eye"></i><span>Visualizar</span></a> -->

        <!-- <a href="alerta.php" class="sidebar-nav"><i class="icon fa-solid fa-triangle-exclamation"></i><span>Alerta</span></a>

        <a href="botao.php" class="sidebar-nav"><i class="icon fa-solid fa-egg"></i><span>Botões</span></a> -->

        <a href="sair.php" class="sidebar-nav"><i class="icon fa-solid fa-arrow-right-from-bracket"></i><span>Logout</span></a>
    </div>
    
    <div class="container">
        <!-- <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4>Listar Usuários</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">
                        Cadastrar
                    </button>
                </div>
            </div>
        </div>
        <hr> -->

        <span id="msgAlerta"></span>

        <div class="row">
            <div class="col-lg-12">
                <span class="listar-usuarios"></span>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadUsuarioModalLabel">Cadastrar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cad-usuario-form">
                        <span id="msgAlertaErroCad"></span>
                        <div class="mb-3">
                            <label for="nome" class="col-form-label">Nome:</label>
                            <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome completo">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">E-mail:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Digite o seu melhor e-mail">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <input type="submit" class="btn btn-outline-success btn-sm" id="cad-usuario-btn" value="Cadastrar" />
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="visUsuarioModal" tabindex="-1" aria-labelledby="visUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visUsuarioModalLabel">Detalhes do Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertaErroVis"></span>
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt>
                        <dd class="col-sm-9"><span id="idUsuario"></span></dd>

                        <dt class="col-sm-3">Nome</dt>
                        <dd class="col-sm-9"><span id="nomeUsuario"></span></dd>

                        <dt class="col-sm-3">E-mail</dt>
                        <dd class="col-sm-9"><span id="emailUsuario"></span></dd>

                    </dl>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsuarioModalLabel">Editar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-usuario-form">
                        <span id="msgAlertaErroEdit"></span>

                        <input type="hidden" name="id" id="editid">

                        <div class="mb-3">
                            <label for="nome" class="col-form-label">Nome:</label>
                            <input type="text" name="nome" class="form-control" id="editnome" placeholder="Digite o nome completo">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">E-mail:</label>
                            <input type="email" name="email" class="form-control" id="editemail" placeholder="Digite o seu melhor e-mail">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <input type="submit" class="btn btn-outline-warning btn-sm" id="edit-usuario-btn" value="Salvar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" 
    crossorigin="anonymous"></script>
</body>
</html>
