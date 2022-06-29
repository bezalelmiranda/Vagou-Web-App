<?php

include_once "./Conn.php";

//Recebe o Array do form
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if (empty($dados['id'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Ações não concluída, tente novamente!</div>"];
} elseif (empty($dados['placa'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Ações não concluída, tente novamente!</div>"];
} else {
    //Cria o objeto para fazer o cadastro no banco
    $query_cadastrar = "UPDATE vagas SET hora_entrada = CURTIME() WHERE n_vaga=:id";
    $add_veiculo = $conn->prepare($query_cadastrar);
    $add_veiculo->bindParam('id', $dados['id']);

    if($add_veiculo->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Veículo registrado e vaga ocupada!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Veículo não registrado e vaga não ocupada!</div>"];
    }
}
    echo json_encode($retorna);
?>