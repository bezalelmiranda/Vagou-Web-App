<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/favicon2.ico">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>BRA parking - Home</title>
</head>

<body>
    <nav class="nav">
        <div class="max-width">
            <div class="logo">
             <a href="index.php"><img src="image/vagou.png" alt="vagou-logo"></a>
            </div>
            <ul class="menu" id="menu-site">
                <li><a href="index.php">Home</a></li>
                <li><a href="sobre-empresa.php">Sobre Empresa</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="login.php">Login|Cadastro</a></li>
            </ul>
            <div class="menu-btn" id="menu-btn">
                <i class="fa-solid fa-bars" id="menu-icon"></i>
            </div>
        </div>
    </nav>

    <section class="contact">
        <div class="max-width">
            <h2 class="title">Contato</h2>
            <div class="contact-content">
                <div class="column left">
                    <p>
                        Entre em contato conosco por qualquer dúvida, reclamação ou sugestão.
                        Estamos sempre a disposição para atender às suas dúvidas e ajudar a melhorar o nosso serviço.
                    </p>
                    <div class="icons">
                        <div class="row">
                            <i class="fa-solid fa-user"></i>
                            <div class="info">
                                <div class="head">
                                    Empresa
                                </div>
                                <div class="sub-title">
                                    BRA parking
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <i class="fa-solid fa-location-dot"></i>
                            <div class="info">
                                <div class="head">
                                    Endereço
                                </div>
                                <div class="sub-title">
                                    Avenida Golle
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <i class="fa-solid fa-envelope"></i>
                            <div class="info">
                                <div class="head">
                                    E-mail
                                </div>
                                <div class="sub-title">
                                    rhene@braparking.com.br
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">
                        Mensagem de Contato
                    </div>
                    <form>
                        <div class="fields">
                            <div class="field name">
                                <input type="text" placeholder="Digite o nome" required>
                            </div>
                            <div class="field email">
                                <input type="email" placeholder="Digite o e-mail" required>
                            </div>
                        </div>

                        <div class="field">
                            <input type="text" placeholder="Digite o assunto" required>
                        </div>

                        <div class="field textarea">
                            <textarea cols="30" rows="10" placeholder="Digite o conteúdo"></textarea>
                        </div>

                        <div class="button-area">
                            <button type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </section>

    <footer>
        <span>Created By <a href="https://www.google.com.br/maps/place/Blumenau,+SC/@-26.8560346,-49.2391869,11z/data=!3m1!4b1!4m5!3m4!1s0x94df1e408b5c3095:0xacfb8520bc1a7644!8m2!3d-26.9165792!4d-49.0717331">BRA parking</a></span>
    </footer>

    <script src="js/custom.js"></script>
</body>

</html>