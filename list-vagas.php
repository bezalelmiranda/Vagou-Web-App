<?php
include_once "./Conn.php";

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

    //Calcular o inicio visualização
    $qnt_result_pg = 25; //Quantidade de registro por página
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_vagas_ocupadas = "SELECT * FROM vagas 
                        WHERE hora_entrada > 1
                        ORDER BY n_vaga 
                        LIMIT $inicio, $qnt_result_pg";
    $result_vagas = $conn->prepare($query_vagas_ocupadas);
    $result_vagas->execute();

    if (($result_vagas) and ($result_vagas->rowCount() != 0)) {

        $dados = "<div class='top-list'>
                    <span class='title-content'>VAGAS OCUPADAS</span>
                    <div class='top-list-right'>
                        <button class='btn btn-outline-primary' onclick='listarLivres($pagina)'>Adicionar Veículo</button>
                    </div>        
                </div>";

        $dados .= "<div class='table-responsive'> 
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>VAGAS</th>
                                <th>HORA ENTRADA</th>
                                <th>HORA SAÍDA</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($row_vaga = $result_vagas->fetch(PDO::FETCH_ASSOC)) {
            extract($row_vaga);
            $dados .= "<tr>
                            <td>$n_vaga</td>
                            <td>$hora_entrada</td>
                            <td>$hora_saida</td>
                        </tr>";
        }


        $dados .= "</tbody>
                </table>
                </div>";

        //Paginação - Somar a quantidade de usuários
        $query_pg = "SELECT COUNT(n_vaga) AS num_result FROM vagas";
        $result_pg = $conn->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        //Quantidade de pagina
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        $max_links = 2;

        $dados .= "<nav aria-label='Page navigation example'><ul class='pagination justify-content-center pagination-sm'>";

        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCatProdutos(1)'>Primeira</a></li>";

        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCatProdutos($pag_ant)'>$pag_ant</a></li>";
            }            
        }        

        $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

        for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
            if($pag_dep <= $quantidade_pg){
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCatProdutos($pag_dep)'>$pag_dep</a></li>";
            }            
        }
        

        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCatProdutos($quantidade_pg)'>Última</a></li>";

        $dados .= "</ul></nav>";


        $retorna = ['erro' => false, 'dados' => $dados];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma categoria de produto encontrado!</div>"];
    }
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma categoria de produto encontrado!</div>"];
}



echo json_encode($retorna);
