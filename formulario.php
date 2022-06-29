<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/Logo carro.png">
    <!-- Incluir os icones do font-awesome da CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="custom2.css">
    <title>Adm - Celke</title>
</head>

<body>
    <!-- Inicio Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="bars">
                <i class="fa-solid fa-bars"></i>
            </div>
            <img src="image/Logo carro.png" alt="Celke" class="logo2">
        </div>

        <div class="navbar-content">
            <div class="notification">
                <i class="fa-solid fa-bell"></i>
                <span class="number">7</span>
                <div class="dropdown-menu">
                    <div class="dropdown-content">
                        <li>
                            <img src="image/user.gif" alt="Usuario" width="40">
                            <div class="text">
                                Fusce ut leo pretium, luctus elit id, vulputate lectus.
                            </div>
                        </li>
                        <li>
                            <img src="image/user.gif" alt="Usuario" width="40">
                            <div class="text">
                                Fusce ut leo pretium, luctus elit id, vulputate lectus.
                            </div>
                        </li>
                    </div>
                </div>
            </div>

            <div class="avatar">
                <img src="image/user.gif" alt="Usuario" width="40">
                <div class="dropdown-menu setting">
                    <div class="item">
                        <span class="fa-solid fa-user"></span> Perfil
                    </div>
                    <div class="item">
                        <span class="fa-solid fa-gear"></span> Configuração
                    </div>
                    <div class="item">
                        <span class="fa-solid fa-arrow-right-from-bracket"></span> Sair
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Fim Navbar -->

    <!-- Inicio Conteudo -->
    <div class="content">
        <!-- Inicio da Sidebar -->
        <div class="sidebar">
            <a href="index.html" class="sidebar-nav"><i class="icon fa-solid fa-house"></i><span>Dashboard</span></a>

            <a href="listar.html" class="sidebar-nav"><i class="icon fa-solid fa-list"></i><span>Listar</span></a>
            <a href="formulario.html" class="sidebar-nav active"><i
                    class="icon fa-solid fa-file-lines"></i><span>Formulário</span></a>

            <a href="login.html" class="sidebar-nav"><i
                    class="icon fa-solid fa-arrow-right-from-bracket"></i><span>Sair</span></a>

        </div>
        <!-- Fim da Sidebar -->
        <!-- Inicio do conteudo do administrativo -->
        <div class="wrapper">
            <div class="row">
                <div class="top-list">
                    <span class="title-content">Formulário</span>
                    <div class="top-list-right">
                        <a href="listar.html" class="btn-info">Listar</a>
                    </div>
                </div>
                <div class="content-adm">
                    <form class="form-adm">
                        <div class="row-input">
                            <div class="column">
                                <label class="title-input">Nome</label>
                                <input type="text" name="name" id="name" class="input-adm" placeholder="Nome completo">
                            </div>

                            <div class="column">
                                <label class="title-input">E-mail</label>
                                <input type="email" name="email" id="email" class="input-adm"
                                    placeholder="E-mail principal">
                            </div>

                            <div class="column">
                                <label class="title-input">Campo 3</label>
                                <input type="text" name="campo_3" id="campo_3" class="input-adm" placeholder="Campo 3">
                            </div>

                            <div class="column">
                                <label class="title-input">Campo 4</label>
                                <input type="text" name="campo_4" id="campo_4" class="input-adm" placeholder="Campo 4">
                            </div>

                            <div class="row-input">
                                <div class="column">
                                    <label class="title-input">Campo 5</label>
                                    <input type="text" name="campo_5" id="campo_5" class="input-adm"
                                        placeholder="Campo 5">
                                </div>
                            </div>

                            <div class="row-input">
                                <div class="column">
                                    <label class="title-input">Descrição</label>
                                    <textarea name="descricao" id="descricao" class="input_adm" placeholder="Descrição"></textarea>
                                </div>
                            </div>

                            <button type="button" class="btn-success">Cadastrar</button>
                        </div>
                    </form>
                </div>


            </div>

        </div>
        <!-- Fim do conteudo do administrativo -->
    </div>
    <!-- Fim Conteudo -->

    <script src="js/custom_adm.js"></script>

</body>

</html>