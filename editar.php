<?php

include_once './Conn.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dados);

if (empty($dados['id'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
} elseif (empty($dados['nome'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
} elseif (empty($dados['celular'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo contato!</div>"];
} elseif (empty($dados['cpf'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo cpf!</div>"];
} elseif (empty($dados['email'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>"];
} elseif (empty($dados['brapa'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>"];
}  elseif (empty($dados['rua'])) {
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
}  elseif (empty($dados['modelo'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo modelo do veiculo!</div>"];
} elseif (empty($dados['marca'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo marca do veiculo!</div>"];
} elseif (empty($dados['placa'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo placa do veiculo!</div>"];
}else {
    $query_usuario= "UPDATE usuarios SET nome=:nome, celular=:celular, cpf=:cpf, email=:email, brapa=:brapa WHERE id=:id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':nome', $dados['nome']);
    $edit_usuario->bindParam(':celular', $dados['celular']);
    $edit_usuario->bindParam(':cpf', $dados['cpf']);
    $edit_usuario->bindParam(':email', $dados['email']);
    $edit_usuario->bindParam(':brapa', $dados['brapa']);
    $edit_usuario->bindParam(':id', $dados['id']);
    $edit_usuario->execute();

    $query_endereco = "UPDATE enderecos SET cep=:cep, rua=:rua, numero=:numero, complemento=:complemento, bairro=:bairro, cidade=:cidade
                        WHERE usuario_id=:id";
    $edit_endereco = $conn->prepare($query_endereco);
    $edit_endereco->bindParam(':cep', $dados['cep']);
    $edit_endereco->bindParam(':rua', $dados['rua']);
    $edit_endereco->bindParam(':numero', $dados['numero']);
    $edit_endereco->bindParam(':complemento', $dados['complemento']);
    $edit_endereco->bindParam(':bairro', $dados['bairro']);
    $edit_endereco->bindParam(':cidade', $dados['cidade']);
    $edit_endereco->bindParam(':id', $dados['id']);
    $edit_endereco->execute();

    $query_veiculo = "UPDATE veiculos SET modelo=:modelo, marca=:marca, placa=:placa WHERE usuario_id=:id";
    $edit_veiculo = $conn->prepare($query_veiculo);
    $edit_veiculo->bindParam(':modelo', $dados['modelo']);
    $edit_veiculo->bindParam(':marca', $dados['marca']);
    $edit_veiculo->bindParam(':placa', $dados['placa']);
    $edit_veiculo->bindParam(':id', $dados['id']);
    $edit_veiculo->execute();

    if (($edit_usuario->rowCount()) && ($edit_endereco->rowCount()) && ($edit_veiculo-->rowCount()))  {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não editado com sucesso!</div>"];
    } else {
        $retorna = ['error' => true, 'msg' => "<div class='alert alert-success' role='alert'>Usuário editado com sucesso!</div>"];
    }
}

echo json_encode($retorna);


// elseif (empty($dados['plano'])) {
//     $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nivel de acesso!</div>"];
// } elseif (empty($dados['nivel-acesso'])) {
//     $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nivel de acesso!</div>"];
// }
