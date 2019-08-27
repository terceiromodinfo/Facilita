
<?php
include './CodigoFonts.php';
include './mostra_erros.php';
$result = $_SESSION['ArrayDeDados'];
//print_r($result);
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
                                                
                    </ul>
                </div>
            </div>
        </nav><br><br><br>
        
        <div class="container">
            <div class="row">
                <?php
                
                /*
                 * Aqui será exibido na paginas as opções de pesquisas
                 * logo apos do usuario escolher pesquisa´por matricula 
                 * será exibido na tela formulario para faser a pesquisa 
                 * por matricula
                 */
                
                if (isset($post['matricula'])) {
                ?>
                
                <div class="col-md-12">
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
                            
                            <form action="CodigoFonts.php" method="POST" enctype="multipart/form-data">
                                <input type="text" class="form-control" name="nomeDaMatricula">
                                <input type="submit" class="btn btn-default" value="Prosseguir" name="pesquisaMatricula">
                            </form>
                            
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div> 
                
                <?php
                } else {
                ?>
                    <div class="col-md-12">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <h3>Qual sua escolha de pesquisa</h3>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="col-md-12">

                        <div class="col-md-4"></div>
                        <div class="col-md-4">   
                            
                                        <form action="ModoDePesquisa.php" method="POST" enctype="multipart/form-data">
                                            <input type="submit" class='btn btn-default btn-lg btn-block' value="Matricula" name="matricula">
                                        </form>
                                    
                                        <form action="CodigoFonts.php" method="POST" enctype="multipart/form-data">
                                            <input type="submit" class='btn btn-default btn-lg btn-block' value="Curso" name="curso">
                                        </form>
                                    

                            

                            
                <?php
                   }
                ?> 

                    </div>
                    <div class="col-md-4"></div>

                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

