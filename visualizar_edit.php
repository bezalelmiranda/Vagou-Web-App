<?php
include_once './Conn.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_usuario = "SELECT usr.id, usr.nome, usr.cpf, usr.celular, usr.email, usr.brapa, usr.plano_id, usr.niveis_acesso_id,                        
    edrc.id, edrc.cep, edrc.rua, edrc.numero, edrc.complemento, edrc.bairro, edrc.cidade, edrc.usuario_id,                       
    vcl.id, vcl.modelo, vcl.marca, vcl.placa, vcl.usuario_id    
    FROM usuarios AS usr    
    INNER JOIN enderecos AS edrc ON edrc.usuario_id=usr.id    
    INNER JOIN veiculos AS vcl ON vcl.usuario_id=usr.id    
    WHERE usr.id = :id LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':id', $id);
    $result_usuario->execute();

    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
   
    $retorna = ['erro' => false, 'dados' => $row_usuario];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}

echo json_encode($retorna);

// if (!empty($id)) {

//     $query_endereco = "SELECT id, cep, rua, numero, complemento, bairro, cidade, usuario_id FROM enderecos WHERE usuario_id = :usuario_id LIMIT 1";
//     $result_endereco = $conn->prepare($query_endereco);
//     $result_usuario->bindParam(':usuario_id', $id);
//     $result_endereco->execute();

//     $row_usuario = $result_endereco->fetch(PDO::FETCH_ASSOC);

//     $retorna2 = ['erro' => false, 'dados2' => $row_usuario];    
// } else {
//     $retorna2 = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
// }

// echo json_encode($retorna2);