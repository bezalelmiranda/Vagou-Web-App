<?php 
session_start();
ob_start();

include_once './Conn.php';
//require './Crud.php';

if ((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    if ($_SESSION['nivel-acesso'] > 2) {
        $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página!</p>";
        header("Location: login.php");

    //Mostra a mensagen e depois destroi a mesma
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="custom copy.css">
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
        
        <!-- <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadUsuarioModal"> Cadastrar</button> -->
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
        </div> -->
        <hr>

        <span id="msgAlerta"></span>

        <div class="row">
            <div class="col-lg-12">
                <span class="listar-usuarios"></span>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
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
                        
                            <label for="celular" class="col-form-label">Celular:</label>
                            <input type="text" name="celular" class="form-control" id="celular" placeholder="(00) 0 0000-0000">

                            <label for="cpf" class="col-form-label">CPF:</label>
                            <input type="text" name="cpf" class="form-control" id="cpf" placeholder="000.000.000.-00">
                        
                            <label for="email" class="col-form-label">E-mail:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Digite o seu melhor e-mail">

                            <label for="rua" class="col-form-label">Logradouro:</label>
                            <input type="text" name="rua" class="form-control" id="rua" placeholder="Rua: Blumenau, 000">

                            <label for="numero" class="col-form-label">N°:</label>
                            <input type="text" name="numero" class="form-control" id="numero" placeholder="N° 25">

                            <label for="complemento" class="col-form-label">Complemento:</label>
                            <input type="text" name="complemento" class="form-control" id="complemento" placeholder="Ap 1305 ou Casa">

                            <label for="bairro" class="col-form-label">Bairro:</label>
                            <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Centro">

                            <label for="cidade" class="col-form-label">Cidade:</label>
                            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Blumenau">

                            <label for="cep" class="col-form-label">Cep:</label>
                            <input type="text" name="cep" class="form-control" id="cep" placeholder="00000-00">

                            <label for="brapa" class="col-form-label">Senha:</label>
                            <input type="password" name="brapa" class="form-control" id="brapa" placeholder="***********">
                            
                            <label for="plano" class="col-form-label">Plano:</label>
                            <input type="number" name="plano" class="form-control"  id="plano" placeholder="plano">
                        
                            <label for="nivel-acesso" class="col-form-label">Ninel de acesso:</label>
                            <input type="number" name="nivel-acesso" class="form-control"  id="nivel-acesso"  placeholder="Ninel de acesso">

                            <label for="modelo" class="col-form-label">Modelo:</label>
                            <input type="text" name="modelo" class="form-control" id="modelo" placeholder="Ex: Palio">

                            <label for="marca" class="col-form-label">Marca:</label>
                            <input type="text" name="marca" class="form-control" id="marca" placeholder="Ex: FIAT">

                            <label for="placa" class="col-form-label">Placa:</label>
                            <input type="text" name="placa" class="form-control" id="placa" placeholder="Ex: PLF-1215">
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
                        <!-- <dt class="col-sm-4">ID Usuarío</dt>
                        <dd class="col-sm-9"><span id="idUsuario"></span></dd> -->

                        <dt class="col-sm-4">Rua</dt>
                        <dd class="col-sm-9"><span id="ruaUsuario"></span></dd>

                        <dt class="col-sm-4">N°</dt>
                        <dd class="col-sm-9"><span id="numeroUsuario"></span></dd>

                        <dt class="col-sm-4">Complemento</dt>
                        <dd class="col-sm-9"><span id="complementoUsuario"></span></dd>

                        <dt class="col-sm-4">Bairro</dt>
                        <dd class="col-sm-9"><span id="bairroUsuario"></span></dd>

                        <dt class="col-sm-4">Cidade</dt>
                        <dd class="col-sm-9"><span id="cidadeUsuario"></span></dd>

                        <dt class="col-sm-4">Cep</dt>
                        <dd class="col-sm-9"><span id="cepUsuario"></span></dd>

                        <dt class="col-sm-4">Modelo</dt>
                        <dd class="col-sm-9"><span id="modeloVeiculo"></span></dd>

                        <dt class="col-sm-4">Marca</dt>
                        <dd class="col-sm-9"><span id="marcaVeiculo"></span></dd>

                        <dt class="col-sm-4">Placa</dt>
                        <dd class="col-sm-9"><span id="placaVeiculo"></span></dd>
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
                            <label for="celular" class="col-form-label">Celular:</label>
                            <input type="text" name="celular" class="form-control" id="editcelular" placeholder="(00) 0 0000-0000">
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="col-form-label">CPF:</label>
                            <input type="text" name="cpf" class="form-control" id="editcpf" placeholder="000.000.000-00">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">E-mail:</label>
                            <input type="email" name="email" class="form-control" id="editemail" placeholder="Digite o seu melhor e-mail">
                        </div>
                        <div class="mb-3">
                            <label for="brapa" class="col-form-label">Senha:</label>
                            <input type="text" name="brapa" class="form-control" id="editbrapa" placeholder="padrão de recuperação é o Cpf">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="plano" class="col-form-label">Plano:</label>
                            <input type="number" name="plano" class="form-control" id="editplano" placeholder="Ex: Gold">
                        </div>
                        <div class="mb-3">
                            <label for="nivel-acesso" class="col-form-label">Nivel Acesso:</label>
                            <input type="number" name="nivel-acesso" class="form-control" id="editnivel-acesso" placeholder="">
                        </div> -->
                        <input type="hidden" name="id-end" id="editidend">

                        <div class="mb-3">
                            <label for="cep" class="col-form-label">Cep:</label>
                            <input type="text" name="cep" class="form-control" id="editcep" placeholder="00000-00">
                        </div>
                        <div class="mb-3">
                            <label for="rua" class="col-form-label">Rua:</label>
                            <input type="text" name="rua" class="form-control" id="editrua" placeholder="Ex: Benjamim Costant">
                        </div>
                        <div class="mb-3">
                            <label for="numero" class="col-form-label">N°:</label>
                            <input type="text" name="numero" class="form-control" id="editnumero" placeholder="N° 25">
                        </div>
                        <div class="mb-3">
                            <label for="complemento" class="col-form-label">Complemento:</label>
                            <input type="text" name="complemento" class="form-control" id="editcomplemento" placeholder="Casa">
                        </div>
                        <div class="mb-3">
                            <label for="bairro" class="col-form-label">Bairro:</label>
                            <input type="text" name="bairro" class="form-control" id="editbairro" placeholder="Ex: Vila Nova">
                        </div>
                        <div class="mb-3">
                            <label for="cidade" class="col-form-label">Cidade</label>
                            <input type="text" name="cidade" class="form-control" id="editcidade" placeholder="Ex: Blumenau">
                        </div>
                        <div class="mb-3">
                            <label for="modelo" class="col-form-label">Modelo do Veiculo:</label>
                            <input type="text" name="modelo" class="form-control" id="editmodelo" placeholder="Compass">
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="col-form-label">Fabricante:</label>
                            <input type="text" name="marca" class="form-control" id="editmarca" placeholder="Jepp">
                        </div>
                        <div class="mb-3">
                            <label for="placa" class="col-form-label">Placa:</label>
                            <input type="text" name="placa" class="form-control" id="editplaca" placeholder="MLJ-1265">
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
    <script src="js/custom2.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" 
    crossorigin="anonymous"></script>
</body>
</html>
