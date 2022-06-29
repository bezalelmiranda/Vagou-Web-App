<?php

include_once './Conn.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);



if (empty($dados['nome'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
} elseif (empty($dados['celular'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo contato!</div>"];
} elseif (empty($dados['cpf'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo cpf!</div>"];
} elseif (empty($dados['email'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>"];
} elseif (empty($dados['rua'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo rua!</div>"];
} elseif (empty($dados['numero'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo numero!</div>"];
} elseif (empty($dados['complemento'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo complemento!</div>"];
} elseif (empty($dados['bairro'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo bairro!</div>"];
} elseif (empty($dados['cidade'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo cidade!</div>"];
} elseif (empty($dados['cep'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo cep!</div>"];
} elseif (empty($dados['brapa'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>"];
} elseif (empty($dados['plano'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nivel de acesso!</div>"];
} elseif (empty($dados['nivel-acesso'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nivel de acesso!</div>"];
} elseif (empty($dados['modelo'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo modelo do veiculo!</div>"];
} elseif (empty($dados['marca'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo marca do veiculo!</div>"];
} elseif (empty($dados['placa'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo placa do veiculo!</div>"];
} else {
    

    $query_cadastrar = "INSERT INTO usuarios (nome, celular, cpf, email, brapa, plano_id, niveis_acesso_id, created) 
                        VALUES (:nome, :celular, :cpf, :email, :brapa, :plano_id, :niveis_acesso_id, NOW())";
    $add_cadastro = $conn->prepare($query_cadastrar);
    $add_cadastro->bindParam(':nome', $dados['nome'],PDO::PARAM_STR);
    $add_cadastro->bindParam(':celular', $dados['celular'],PDO::PARAM_STR);
    $add_cadastro->bindParam(':cpf', $dados['cpf'],PDO::PARAM_STR);
    $add_cadastro->bindParam(':email', $dados['email'],PDO::PARAM_STR);
    $add_cadastro->bindParam(':brapa', $dados['brapa'],PDO::PARAM_STR);
    $add_cadastro->bindParam(':plano_id', $dados['plano'],PDO::PARAM_INT);
    $add_cadastro->bindParam(':niveis_acesso_id', $dados['nivel-acesso'],PDO::PARAM_INT);
    $add_cadastro->execute();

    $id_usuario = $conn->lastInsertId();

    $query_endereco = "INSERT INTO enderecos (cep, rua, numero, complemento, bairro, cidade, usuario_id, created)
                        VALUES (:cep, :rua, :numero, :complemento, :bairro, :cidade, :usuario_id, NOW())";
    $add_endereco = $conn->prepare($query_endereco);
    $add_endereco->bindParam(':cep', $dados['cep']);
    $add_endereco->bindParam(':rua', $dados['rua']);
    $add_endereco->bindParam(':numero', $dados['numero']);
    $add_endereco->bindParam(':complemento', $dados['complemento']);
    $add_endereco->bindParam(':bairro', $dados['bairro']);
    $add_endereco->bindParam(':cidade', $dados['cidade']);
    $add_endereco->bindParam(':usuario_id', $id_usuario);
    $add_endereco->execute();

    $query_veiculo = "INSERT INTO veiculos (modelo, marca, placa, usuario_id, created)
                        VALUES (:modelo, :marca, :placa, :usuario_id, NOW())";
    $add_veiculo = $conn->prepare($query_veiculo);
    $add_veiculo->bindParam(':modelo', $dados['modelo']);
    $add_veiculo->bindParam(':marca', $dados['marca']);
    $add_veiculo->bindParam(':placa', $dados['placa']);
    $add_veiculo->bindParam(':usuario_id', $id_usuario);
    $add_veiculo->execute();

    if(($add_cadastro->rowCount()) && ($add_endereco->rowCount()) && ($add_veiculo->rowCount())) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];
    }
}

echo json_encode($retorna);
