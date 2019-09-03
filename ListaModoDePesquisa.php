<?php
include './Funcoes.php';
include './mostra_erros.php';
$ArraysDeCurso =  $_SESSION['ArrayDeCursos'];
$ArraysDeUsuario = $_SESSION['ArrayDeUsuario'];
$ModoPesquisa = $_SESSION['ModoDeListaDePesquisa'];
//print_r($ArraysDeCurso);
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Facilita Relatório</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="estilo.css" rel="stylesheet">
        <script type="text/javascript" src="capDeInfo.js"></script>
    </head>
    <body>
        <!--!-->
        <!-- Cabeçario da pagina-->
        <nav class="navbar navbar-default navbar-fixed-top corFundoAzul">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-navegacao">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span>  
                    </button>
                    <a href="#pageTop" class="navbar-brand" style="font-weight: bold">Facilita</a>
                </div>
                <div class="collapse navbar-collapse menu-navegacao" id="menu-navegacao">
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li>
                            <a class="" href="index.php">Pagina Inicial</a>
                        </li>
                        <li>
                            <a class="" href="ModoDePesquisa.php">Modo de Pesquisa</a>
                        </li>
                                                
                    </ul>
                </div>
            </div>
        </nav><br><br><br>
        <!---->
        <!--
        Layout criado para pegar o arquivo desejado e fazer o upload das suas
        informações
        -->
        <div class="container">
            <div class="row"> 
                <div class="col-lg-4"></div>  
                <div class="col-lg-4">                   
                    <?php
                    if ($ModoPesquisa === "Usuario") {
                    ?>
                    <form action="RelatorioDeUsuario.php" method="POST" enctype="multipart/form-data">                            
                            <input type="submit" class="btn btn-info btn-lg btn-block" value="Gerar pra Todos" name="GerarTodos">
                    </form><br>
                    
                        <?php
                    }
                    /*
                     * Script exibe na pagina do usuario qual pesquisa ele está a faser.
                     * Exemplo exibira uma lista de curso se está pesquisando por cursos
                     * ou exibe uma lista de alunos
                     */
                    switch ($ModoPesquisa) {
                        case "Curso":
                            for ($a = 0; $a < count($ArraysDeCurso); $a++) {                                
                                print "<a class='btn btn-default btn-lg btn-block' href='CodigoFonts.php?nomeCurso=" . $ArraysDeCurso[$a] . "'>" . $ArraysDeCurso[$a] . "</a><br>";                          
                            }
                            break;
                        case "Usuario":
                            for ($b = 0; $b < count($ArraysDeUsuario); $b++) {
                                print "<a class='btn btn-default btn-lg btn-block' href='RelatorioDeUsuario.php?nomeUsuario=" . serialize($ArraysDeUsuario[$b]). "'>" . $ArraysDeUsuario[$b]['nome'] . "</a><br>";                                
                            }
                            break;
                    }
                    ?>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
