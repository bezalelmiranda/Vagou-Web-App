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

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

    //Calcular o inicio visualização
    $qnt_result_pg = 7; //Quantidade de registro por página
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_usuario = "SELECT usr.id, usr.nome, usr.celular, usr.cpf, usr.email, usr.created, nvl.nivel, pl.plano
                       FROM usuarios AS usr 
                       INNER JOIN niveis_acesso AS nvl ON nvl.id=usr.niveis_acesso_id
                       INNER JOIN planos AS pl ON pl.id=usr.plano_id
                       ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->execute();
   //var_dump($result_usuario);

    $dados = "<div class='table-responsive'>
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Celular</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Plano</th>
                        <th>Nivel de Acesso</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";
    while ($row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC)) {
        extract($row_usuario);
        $dados .= "<tr>
                    <td>$id</td>
                    <td>$nome</td>
                    <td>$celular</td>
                    <td>$cpf</td>
                    <td>$email</td>
                    <td>$plano</td>
                    <td>$nivel</td>
                    <td>
                        <button id='$id' class='btn btn-outline-primary btn-sm' onclick='visUsuario($id)'>Visualizar</button>

                        <button id='$id' class='btn btn-outline-warning btn-sm' onclick='editUsuarioDados($id)'>Editar</button>

                        <button id='$id' class='btn btn-outline-danger btn-sm' onclick='apagarUsuarioDados($id)'>Apagar</button>
                    </td>
                </tr>";
    }

    $dados .= "</tbody>
        </table>
    </div>";

    //Paginação - Somar a quantidade de usuários
    $query_pg = "SELECT COUNT(id) AS num_result FROM usuarios";
    $result_pg = $conn->prepare($query_pg);
    $result_pg->execute();
    $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

    //Quantidade de pagina
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    $max_links = 2;

    $dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

    $dados .= "<li class='page-item'><a href='#' class='page-link' onclick='listarUsuarios(1)'>Primeira</a></li>";

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
        if($pag_ant >= 1){
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($pag_ant)' >$pag_ant</a></li>";
        }        
    }    

    $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

    for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
        if($pag_dep <= $quantidade_pg){
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($pag_dep)'>$pag_dep</a></li>";
        }        
    }

    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($quantidade_pg)'>Última</a></li>";
    $dados .=   '</ul></nav>';

    echo $dados;
} else {
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>";
}
