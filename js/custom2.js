const tbody = document.querySelector(".listar-usuarios");
const cadForm = document.getElementById("cad-usuario-form");
const editForm = document.getElementById("edit-usuario-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));
const editModal = new bootstrap.Modal(document.getElementById("editUsuarioModal"));

const listarUsuarios = async (pagina) => {
    const dados = await fetch("./validalist.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarUsuarios(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("cad-usuario-btn").value = "Salvando...";
    console.log()

    if (document.getElementById("nome").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>";
    } else if (document.getElementById("email").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>";
    } else if (document.getElementById("celular").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo celular!</div>";
    } else if (document.getElementById("cpf").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Cpf!</div>";
    }  else if (document.getElementById("rua").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Logradouro!</div>";
    } else if (document.getElementById("numero").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo N°!</div>";
    } else if (document.getElementById("complemento").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Complemento!</div>";
    } else if (document.getElementById("bairro").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Bairro!</div>";
    } else if (document.getElementById("cidade").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Cidade!</div>";
    } else if (document.getElementById("cep").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Cep!</div>";
    } else if (document.getElementById("brapa").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Senha!</div>";
    } else if (document.getElementById("plano").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo plano!</div>";
    } else if (document.getElementById("nivel-acesso").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nivel de acesso!</div>";
    } else if (document.getElementById("modelo").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Modelo do Veiculo!</div>";
    } else if (document.getElementById("marca").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Marca do Veiculo!</div>";
    } else if (document.getElementById("placa").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Placa do Veiculo!</div>";
    } else {
        const dadosForm = new FormData(cadForm);
        //dadosForm.append("add", 1);
        //console.log("chegou aqui1");
        const dados = await fetch("cadastrar_modal.php", {
            method: "POST",
            body: dadosForm,
            
        });

        const resposta = await dados.json();
        //console.log("chegou aqui2" + var_export(resposta));
        if (resposta['erro']) {
            //console.log("chegou aqui3" + var_export(resposta));
            msgAlertaErroCad.innerHTML = resposta['msg'];
        } else {
            //console.log("chegou aqui4" + var_export(resposta));
            msgAlerta.innerHTML = resposta['msg'];
            cadForm.reset();
            cadModal.hide();
            listarUsuarios(1);
        }
    }

    document.getElementById("cad-usuario-btn").value = "Cadastrar";
});

async function visUsuario(id) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?id=' + id);                     
    const resposta = await dados.json();

    if (resposta['erro']) {
        //console.log("Acessou1: " + id);
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visUsuarioModal"));
        visModal.show();
        //console.log(resposta);
        //console.log("Acessou2: " + id);
        // document.getElementById("idUsuario").innerHTML = resposta['dados'].id;
        // document.getElementById("nomeUsuario").innerHTML = resposta['dados'].nome;
        // document.getElementById("celularUsuario").innerHTML = resposta['dados'].celular;
        // document.getElementById("cpfUsuario").innerHTML = resposta['dados'].cpf;
        // document.getElementById("emailUsuario").innerHTML = resposta['dados'].email;
        // if (resposta['dados'].plano_id == 1){
        //     document.getElementById("planoUsuario").innerHTML = 'Gold';
        // } else if (resposta['dados'].plano_id == 2){
        //     document.getElementById("planoUsuario").innerHTML = 'Prata';
        // } else if (resposta['dados'].plano_id == 3) {
        //     document.getElementById("planoUsuario").innerHTML = 'Bronze';
        // }
        // if (resposta['dados'].niveis_acesso_id == 1){
        //     document.getElementById("nivelUsuario").innerHTML = 'Super Administrador';
        // } else if (resposta['dados'].niveis_acesso_id == 2){
        //     document.getElementById("nivelUsuario").innerHTML = 'Administrador';
        // } else if (resposta['dados'].niveis_acesso_id == 3){
        //     document.getElementById("nivelUsuario").innerHTML = 'Colaborador';
        // } else if (resposta['dados'].niveis_acesso_id == 4){
        //     document.getElementById("nivelUsuario").innerHTML = 'Cliente';
        // }
        // document.getElementById("criadoUsuario").innerHTML = resposta['dados'].created;
        document.getElementById("ruaUsuario").innerHTML = resposta['dados'].rua;
        document.getElementById("numeroUsuario").innerHTML = resposta['dados'].numero;
        document.getElementById("complementoUsuario").innerHTML = resposta['dados'].complemento; 
        document.getElementById("bairroUsuario").innerHTML = resposta['dados'].bairro;
        document.getElementById("cidadeUsuario").innerHTML = resposta['dados'].cidade;
        document.getElementById("cepUsuario").innerHTML = resposta['dados'].cep;
        document.getElementById("modeloVeiculo").innerHTML = resposta['dados'].modelo;
        document.getElementById("marcaVeiculo").innerHTML = resposta['dados'].marca;
        document.getElementById("placaVeiculo").innerHTML = resposta['dados'].placa;
    }
}

async function editUsuarioDados(id) {
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar_edit.php?id=' + id);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        //console.log("Aqui");
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        editModal.show();
        document.getElementById("editid").value = resposta['dados'].id;
        document.getElementById("editnome").value = resposta['dados'].nome;
        document.getElementById("editcelular").value = resposta['dados'].celular;
        document.getElementById("editcpf").value = resposta['dados'].cpf;
        document.getElementById("editemail").value = resposta['dados'].email;
        document.getElementById("editbrapa").value = resposta['dados'].brapa;
        // document.getElementById("editplano").value = resposta['dados'].plano_id;
        // document.getElementById("editnivel-acesso").value = resposta['dados'].niveis_acesso_id;
        document.getElementById("editidend").value = resposta['dados'].id_end;
        document.getElementById("editcep").value = resposta['dados'].cep;
        document.getElementById("editrua").value = resposta['dados'].rua;
        document.getElementById("editnumero").value = resposta['dados'].numero;
        document.getElementById("editcomplemento").value = resposta['dados'].complemento; 
        document.getElementById("editbairro").value = resposta['dados'].bairro;
        document.getElementById("editcidade").value = resposta['dados'].cidade;
        document.getElementById("editmodelo").value = resposta['dados'].modelo;
        document.getElementById("editmarca").value = resposta['dados'].marca;
        document.getElementById("editplaca").value = resposta['dados'].placa;
    }
}

editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-usuario-btn").value = "Salvando...";

    const dadosForm = new FormData(editForm);
    //console.log(dadosForm);
    /*for (var dadosFormEdit of dadosForm.entries()){
        console.log(dadosFormEdit[0] + " - " + dadosFormEdit[1]);
    }*/

    const dados = await fetch("editar.php", {
        method: "POST",
        body: dadosForm
    });

    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlertaErroEdit.innerHTML = resposta['msg'];
    } else {
        msgAlertaErroEdit.innerHTML = resposta['msg'];
        editForm.reset();
        editModal.hide();
        listarUsuarios(1);
    }

    document.getElementById("edit-usuario-btn").value = "Salvar";
});

async function apagarUsuarioDados(id) {
    console.log("acessou" + id);

    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if(confirmar == true){
        const dados = await fetch('apagar.php?id=' + id);

        const resposta = await dados.json();
        if (resposta['erro']) {
            msgAlerta.innerHTML = resposta['msg'];
        } else {
            msgAlerta.innerHTML = resposta['msg'];
            listarUsuarios(1);
        }
    }    

} 