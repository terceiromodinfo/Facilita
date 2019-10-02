<!DOCTYPE html>
<!--
App:   Gerenciador de relatório de desempenho
Autor: Lucas Alberico de Sousa
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gerador de Relatórios</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min_1.css">
        <link rel="stylesheet" href="bootstrap/css/Style.css">

    </head>
    <body>
        <!-- Barra de navegação do app -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Gerador de Relatórios</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Inicio <span class="sr-only">(Página atual)</span></a>
                    </li>                    
                </ul>
            </div>
        </nav>

        <!-- Fim da barra de navegação do app -->

        <!-- Formulario com ajax -->
        <div class="col-md-12" id="Pr">
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h3>Informe a matricula</h3>
                </div>
                <div class="col-md-4"></div>
            </div>  
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <div class="input-group">
                        <input type="text" class="form-control" id="matricula" placeholder="Buscar por ...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" id="buscar2" type="button">Buscar</button>
                        </span>
                    </div>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <!-- Div para aparecer o loading -->
        <br><br><br>
        <div class="col-lg-4"></div>
        <div class="col-lg-4" id="resultado" align="center">
            <?php include './Lista_De_Alunos.php';?>
        </div>
        <div class="col-lg-4"></div>

        <script type="text/javascript" src="bootstrap/jquery/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/Script.js"></script>
    </body>
</html>