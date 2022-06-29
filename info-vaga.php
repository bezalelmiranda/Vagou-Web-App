<?php

include_once "./Conn.php";

$id = filter_input(INPUT_GET, "n_vaga", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_vaga = "SELECT * FROM vagas WHERE n_vaga =:id LIMIT 1"; 
    $result_vaga = $conn->prepare($query_vaga);
    $result_vaga->bindParam(':id', $id);
    $result_vaga->execute();

    $row_vaga = $result_vaga->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_vaga];
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Vaga não encontrada!</div>"];
}



echo json_encode($retorna);