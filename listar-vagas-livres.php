<?php

include_once "./Conn.php";

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

    //Calcular o inicio visualização
    $qnt_result_pg = 25; //Quantidade de registro por página
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_vg_livre = "SELECT * FROM vagas WHERE hora_entrada < 1 
                        ORDER BY n_vaga 
                        LIMIT $inicio, $qnt_result_pg";
    $result_vg_livre = $conn->prepare($query_vg_livre);
    $result_vg_livre->execute();

    if (($result_vg_livre) and ($result_vg_livre->rowCount() != 0)) {

        $dados = "<span class='title-modal-vg-livres'>VAGAS LIVRES</span><br><hr>";
        $dados .= "<div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                        <div class='btn-group' role='group' aria-label='First group'>";

        while ($row_vagas = $result_vg_livre->fetch(PDO::FETCH_ASSOC)) {
            extract($row_vagas);

            $dados .="<button id='$n_vaga' type='button' class='btn btn-outline-dark ml-2 mr-2' data-toggle='modal' data-target='#listLivresModal' onclick='selectVaga($n_vaga)'>$n_vaga</button>";
        }

        $dados .= "</div></div><br>";

        //Paginação - Somar a quantidade de usuários
        $query_pg = "SELECT COUNT(n_vaga) AS num_result FROM vagas";
        $result_pg = $conn->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        //Quantidade de pagina
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        $max_links = 2;

        $dados .= "<nav aria-label='Page navigation example'><ul class='pagination justify-content-center pagination-sm'>";

        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarLivresPag(1)'>Primeira</a></li>";

        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarLivresPag($pag_ant)'>$pag_ant</a></li>";
            }            
        }        

        $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

        for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
            if($pag_dep <= $quantidade_pg){
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarLivresPag($pag_dep)'>$pag_dep</a></li>";
            }            
        }
        

        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarLivresPag($quantidade_pg)'>Última</a></li>";

        $dados .= "</ul></nav>"; 

        $retorna = ['erro' => false, 'dados' => $dados];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum produto encontrado!</div>"];
    }
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum produto encontrado!</div>"];
}


echo json_encode($retorna);