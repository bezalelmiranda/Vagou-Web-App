// document.querySelector('#menu-btn').addEventListener('click', function(){
    

//     document.querySelector('#menu-site').classList.toggle("active");
//     document.querySelector('#menu-icon').classList.toggle("active");
// });

//valoda a força da senha
function senhaForca(){
    var senha = document.getElementById('exampleInputPassword1').value;
     var forca = 0;

    if ((senha.length >= 4) && (senha.length <= 7)){
        forca += 10;
    } else if (senha.length > 7){
        forca += 25;
    }

    if ((senha.length >= 5) && (senha.match(/[a-z]+/))){
        forca += 10;
    }

    if ((senha.length >= 6) && (senha.match(/[A-Z]+/))){
        forca += 20;
    }

    if ((senha.length >= 7) && (senha.match(/[!@#$:;/%&*?]+/))){
        forca += 25;
    }

    mostrarForca(forca);
}

function mostrarForca(forca){
    if (forca < 30){
        document.getElementById("impForcaSenha").innerHTML = "<span style='color:#ff0000'>Fraca</span>";
    }else if ((forca >= 30) && (forca < 50)){
        document.getElementById("impForcaSenha").innerHTML = "<span style='color:#FFD700'>Média</span>";
    }else if ((forca >= 50) && (forca < 70)){
        document.getElementById("impForcaSenha").innerHTML = "<span style='color:#7FFF00'>Forte</span>";
    }else if ((forca >= 70) && (forca < 100)){
        document.getElementById("impForcaSenha").innerHTML = "<span style='color:#008000'>Excelente</span>";
    }
}

// Listar Vagas

const listarCatProdutos = async (pagina) => {
    const dados = await fetch("./list-vagas.php?pagina=" + pagina);
    //const dados = await fetch("./list-categorias.php");
    const resposta = await dados.json();

    if (resposta['erro']) {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    } else {
        document.querySelector(".listar-vagas").innerHTML = resposta['dados'];
    }
}

listarCatProdutos(1);

// Modal Vagas

const listLivresModal = new bootstrap.Modal(document.getElementById("listLivresModal"));

async function listarLivres(pagina){
    // console.log("Página: " + pagina + ". Id da categoria: " + id_cat);
    const dadosLivres = await fetch('./listar-vagas-livres.php?pagina=' + pagina);
    //const dadosProd = await fetch('listar-produtos.php?pagina=' + pagina);

    const respostaLivres = await dadosLivres.json();

    if (respostaLivres['erro']) {
        document.getElementById("msgAlerta").innerHTML = respostaLivres['msg'];
    } else {        
        //document.getElementById("msgAlerta").innerHTML = respostaProd['msg'];
        listLivresModal.show();
        // console.log(pagina);
        document.querySelector(".list-vg-livres").innerHTML = respostaLivres['dados'];
        
    }
}

async function listarLivresPag(pagina){
    const dadosLivres = await fetch('./listar-vagas-livres.php?pagina=' + pagina);
    const respostaLivres = await dadosLivres.json();

    if (respostaLivres['erro']) {
        document.getElementById("msgErroListLivres").innerHTML = respostaLivres['msg'];
    } else {        
        document.querySelector(".list-vg-livres").innerHTML = respostaLivres['dados'];
        
    }
}

//Adicionar veículo

async function selectVaga(n_vaga){
    addVagaMsgErro.innerHTML = "";
    // console.log(n_vaga);
    const dados = await fetch('info-vaga.php?n_vaga=' + n_vaga);
    const respostaInfoVaga = await dados.json();
    //console.log(respostaInfoVaga);
    
    if (respostaInfoVaga['erro']) {
        document.getElementById("msgAlerta").innerHTML = respostaInfoVaga['msg'];
    } else {
        const salvaVaga = new bootstrap.Modal(document.getElementById("addVagaModal"));
        salvaVaga.show();
        document.getElementById("add-vaga").value = respostaInfoVaga['dados'].n_vaga;
    }
}

const addVagaForm = document.getElementById("addVeiculo-form");
const addVagaMsgErro = document.getElementById("msgErroListLivres");
const addModal = new bootstrap.Modal(document.getElementById("addVagaModal"));

addVagaForm.addEventListener("submit", async (e) => {
    e.preventDefault();    

    document.getElementById("add-veiculo-btn").value = "Adicionando veículo...";

    const dadosForm = new FormData(addVagaForm);
    //console.log(dadosForm);
    // for (var dados of dadosForm.entries()){
    //     console.log(dados[0] + " - " + dados[1]);
    // }
    const dadosFormPull = await fetch ("salvar-vaga.php", {
        method: "POST",
        body:dadosForm
    });

    const respostaForm = await dadosFormPull.json();
    // console.log(respostaForm);
    if (respostaForm['erro']) {
        addVagaMsgErro.innerHTML = respostaForm['msg'];
    } else {
        addVagaMsgErro.innerHTML = respostaForm['msg'];
        addVagaForm.reset();
        addModal.hide();
        listarCatProdutos(1);
    }

    document.getElementById("add-veiculo-btn").value = "Adicionar";
});