<?php
session_start();
ob_start();

require './Conn.php';
require './Crud.php';

//Recebe o Array do form
$formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo "<pre>"; print_r($formData); die;
//Verifica se não está vazio 
if (!empty($formData['email'])) {
    //var_dump($formData);
    //Cria o objeto para fazer o cadastro no banco
    $query_cadastrar = "INSERT INTO usuarios (nome, celular, cpf, email, brapa, plano_id, niveis_acesso_id, created) 
                        VALUES (:nome, :celular, :cpf, :email, :brapa, :plano_id, :niveis_acesso_id, NOW())";
    $add_cadastro = $conn->prepare($query_cadastrar);
    $add_cadastro->bindParam(':nome', $formData['nome']);
    $add_cadastro->bindParam(':celular', $formData['celular']);
    $add_cadastro->bindParam(':cpf', $formData['cpf']);
    $add_cadastro->bindParam(':email', $formData['email']);
    $add_cadastro->bindParam(':brapa', $formData['brapa']);
    $add_cadastro->bindParam(':plano_id', $formData['planos']);
    $add_cadastro->bindParam(':niveis_acesso_id', $formData['nivel-acesso']);
    $add_cadastro->execute();

    $id_usuario = $conn->lastInsertId();

    $query_endereco = "INSERT INTO enderecos (cep, rua, numero, complemento, bairro, cidade, usuario_id, created)
                        VALUES (:cep, :rua, :numero, :complemento, :bairro, :cidade, :usuario_id, NOW())";
    $add_endereco = $conn->prepare($query_endereco);
    $add_endereco->bindParam(':cep', $formData['cep']);
    $add_endereco->bindParam(':rua', $formData['rua']);
    $add_endereco->bindParam(':numero', $formData['numero']);
    $add_endereco->bindParam(':complemento', $formData['complemento']);
    $add_endereco->bindParam(':bairro', $formData['bairro']);
    $add_endereco->bindParam(':cidade', $formData['cidade']);
    $add_endereco->bindParam(':usuario_id', $id_usuario);
    $add_endereco->execute();

    $query_veiculo = "INSERT INTO veiculos (modelo, marca, placa, usuario_id, created)
                        VALUES (:modelo, :marca, :placa, :usuario_id, NOW())";
    $add_veiculo = $conn->prepare($query_veiculo);
    $add_veiculo->bindParam(':modelo', $formData['modelo']);
    $add_veiculo->bindParam(':marca', $formData['marca']);
    $add_veiculo->bindParam(':placa', $formData['placa']);
    $add_veiculo->bindParam(':usuario_id', $id_usuario);
    $add_veiculo->execute();


    if(($add_cadastro->rowCount()) && ($add_endereco->rowCount()) && ($add_veiculo->rowCount())) {
        //Mostra a mensagem se cadastrado com sucesso redireciona para a pagina index.php
        $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
        header("Location: dashboard.php");
    } else {
        $_SESSION['msg'] ="<p style='color: #f00;'>Usuário não cadastrado com sucesso!</p>";
        header("Location: cadastrar.php");
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="css/customcadastrar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>BRA parking</title>
</head>

<body>
    <!-- Criação da Barra de Menu -->
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
                <li><a href="login.php">Login</a></li>
            </ul>
            <div class="menu-btn" id="menu-btn">
                <i class="fa-solid fa-bars" id="menu-icon"></i>
            </div>
        </div>
    </nav>




    <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav col-md-3 ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="listar.php">Listar <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="vagas.php">Vagas <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="contato.php">Contato <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
    </nav> -->




    <!-- Form de cadastro teste -->

    <div class="container">
        <br><br><br><br>
        <h2>Cadastro de Usuários</h2><br>
        <form class="row g-3 needs-validation" active="" method="POST" novalidate>
            <div class="col-md-6">
                <label for="nome_usuario" class="form-label">Nome completo</label>
                <input type="text" class="form-control" name="nome" id="nome_usuario" placeholder="Digite seu nome completo" required>
                <div class="valid-feedback">
                    Ok
                </div>
            </div>

            <div class="invalid-feedback">
                Digite o nome corretamente!
            </div><br>

            <div class="col-md-3">
                <label for="validationCustom02" class="form-label">Telefone de contato</label>
                <input type="text" class="form-control" id="validationCustom02" name="celular" placeholder="(00) 0 0000-0000" value="" onchange="validaCel()" required>
                <div class="valid-feedback">
                    Ok
                </div>
                <div class="invalid-feedback">
                    Digite um telefone válido!
                </div>
            </div><br>

            <div class="col-md-3">
                <label for="validationCustom03" class="form-label">CPF</label>
                <input type="text" class="form-control" id="validationCustom03" name="cpf" placeholder="000.000.000-00" value="" onchange="validaCpf()" required>
                <div class="valid-feedback">
                    Ok
                </div>
                <div class="invalid-feedback">
                    Digite seu CPF!
                </div><br>
            </div>

            <div class="col-md-6">
                <label for="validationCustom04" class="form-label">Logradouro</label>
                <input type="text" name="rua" class="form-control" id="validationCustom04" placeholder="Rua: Blumenau, 000" value="" required>
                <div class="valid-feedback">
                    Ok
                </div>
                <div class="invalid-feedback">
                    Digite seu endereço!
                </div><br>
            </div>

            <div class="col-md-1">
                <label for="validationCustom04" class="form-label">N°</label>
                <input type="text" name="numero" class="form-control" id="validationCustom04" placeholder="N° 25" value="" required>
                <div class="valid-feedback">
                    Ok
                </div>
                <div class="invalid-feedback">
                    Digite seu endereço!
                </div><br>
            </div>

            <div class="col-md-2">
                <label for="validationCustom04" class="form-label">Complemento</label>
                <input type="text" name="complemento" class="form-control" id="validationCustom04" placeholder="Ap 1305 ou Casa" value="" required>
                <div class="valid-feedback">
                    Ok
                </div>
                <div class="invalid-feedback">
                    Digite seu endereço!
                </div><br>
            </div>

            <div class="col-md-3">
                <label for="validationCustom05" class="form-label">Bairro</label>
                <input type="text" name="bairro" class="form-control" id="validationCustom05" placeholder="Centro" value="" required>
                <div class="valid-feedback">
                    Ok
                </div>
                <div class="invalid-feedback">
                    Digite seu bairro!
                </div><br>
            </div>

            <div class="col-md-3">
                <label for="validationCustom06" class="form-label">Cidade</label>
                <input type="text" name="cidade" class="form-control" id="validationCustom06" placeholder="Blumenau" aria-describedby="emailHelp" value="" required>
                <div class="valid-feedback">
                    Ok
                </div>
                <div class="invalid-feedback">
                    Digite sua cidade!
                </div><br>
            </div>

            <div class="col-md-2">
                <label for="validationCustom05" class="form-label">CEP</label>
                <input type="text" name="cep" class="form-control" id="validationCustom05" id="cep" placeholder="00000-000" required>
                <div class="invalid-feedback">
                    Digite o cep corretamente!
                </div>
            </div>

            <div class="col-md-4">
                <label for="exampleInputEmail" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Ex: joao@gmail.com" aria-describedby="emailHelp" value="" required>
                <div class="valid-feedback">
                    Ok
                </div>
                <div class="invalid-feedback">
                    Digite seu e-mail!
                </div><br>
            </div>

            <div class="col-md-3">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" name="brapa" class="form-control" id="exampleInputPassword1" placeholder="**********" value="" onkeyup="senhaForca()" required>
                <div id="impForcaSenha">
                <label>Força da senha</label>
                </div>
            </div>

            <div class="invalid-feedback">
                Digite uma senha válida!
            </div><br>

            <div class="col-md-3">
                <label for="validationCustom05" class="form-label">Placa do veículo</label>
                <input type="text" name="placa" class="form-control" id="validationCustom05" placeholder="AAA-1B11" required>
                <div class="invalid-feedback">
                    Digite corretamente!
                </div>
            </div>

            <div class="col-md-3">
                <label for="validationCustom05" class="form-label">Modelo do veículo</label>
                <input type="text" name="modelo" class="form-control" id="validationCustom05" placeholder="Gol" required>
                <div class="invalid-feedback">
                    Digite corretamente!
                </div>
            </div>

            <div class="col-md-3">
                <label for="validationCustom05" class="form-label">Marca do veículo</label>
                <input type="text" name="marca" class="form-control" id="validationCustom05" placeholder="Volkswagen" required>
                <div class="invalid-feedback">
                    Digite corretamente!
                </div><br>
            </div>



            <div hidden>
                <input type="number" name="nivel-acesso" value="4" >
            </div>

            <div class="col-md-3">
                <label for="validationCustom06" class="form-label">Planos</label><br>
                <select name="planos" id="planos">
                    <option selected="selected" value="1">Ouro</option>
                    <option value="2">Prata</option>
                    <option value="3">Bronze</option>

                </select>
                <div class="valid-feedback">
                    Ok
                </div>
                <div class="invalid-feedback">
                    Digite sua cidade!
                </div><br>
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Aceito os termos e condições
                    </label>
                    <div class="invalid-feedback">
                        Você deve concordar antes de enviar.
                    </div>
                </div><br>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="SendAddUser" value="cadastrar">Cadastrar</button>
            </div>
            <div>
                <?php if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                } ?>
            </div>
        </form>
    </div>
    </div>
    </div>
    <script src="js/custom.js"></script>
    <!--Validando campos celular e cpf com mask Cleave -->
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        new Cleave('#validationCustom03', {
            delimiters: ['.', '.', '-'],
            blocks: [3, 3, 3, 2],
            numericOnly: true
        });

        new Cleave('#validationCustom02', {
            delimiters: ['(', ')', '-'],
            blocks: [0, 2, 5, 4],
            numericOnly: true
        });
    </script>
</body>

</html>