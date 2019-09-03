<?php
include './Funcoes.php';
//include './mostra_erros.php';
$post = post();
$get = get();

if (isset($get['nomeUsuario'])) {
    $usuario = unserialize($get['nomeUsuario']);
    unset($get['nomeUsuario']);
}  else {
    $usuario = $_SESSION['ResultadoDeUsuario'];
}

$UerExistSimNao = $_SESSION['TRUE_FALSE'];
$quantVotas = 0;

if ($UerExistSimNao == "false") {
    print "user não existe";
}

if (isset($post['GerarTodos'])) {
$usuario =  $_SESSION['ArrayDeUsuario'];
}
if (isset($usuario['matricula'])){
   $quantVotas = (count($usuario['matricula']));
}  else {
   $quantVotas =  getQuantLinhasTabela("ArrayDeUsuario");    
}
//Valendo
//print_r($usuario);


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
                            <a class="" href="ListaModoDePesquisa.php">Voltar</a>
                        </li>
                        <li>
                            <a class="" href="CodigoFonts.php?sair">Sair</a>
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
                
                <!---->
                <!--Pagina das informações-->
                <?php
                for ($a = 0; $a < $quantVotas; $a++) {                   
                    if (isset($usuario['matricula'])) {$usuario[0] = $usuario;}
                ?>
                <div class="col-md-12">
                    <div class="col-lg-4">
                        <img src="img/default.png" alt="..." class="img-rounded">
                    </div>
                    <div class="col-lg-6"><?php?>
                        <address>
                            <h2><strong><?php print $usuario[$a]['nome'] ?></strong></h2><br><br>
                            <strong><?php print $usuario[$a]['matricula'] ?></strong><br><br>
                            <strong><?php print $usuario[$a]['curso'] ?></strong><br><br>                          
                        </address>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <tr>
                            <td>                           </td>
                        </tr>
                    </table>
                    <div class="col-md-4">
                        <address>
                            <strong>Media Matematica:  <?php print $usuario[$a]['media matematica'] ?></strong></h2><br><br>
                            <strong>Media de Portugues:  <?php print $usuario[$a]['media portugues'] ?></strong><br><br>
                            <strong>Atendimento EC:  <?php print $usuario[$a]['numero de atendimento ec'] ?></strong><br><br> 
                            <strong>Advertencias:  <?php print $usuario[$a]['numero de advertencias'] ?></strong><br><br>
                        </address>
                    </div>
                    
                    <div class="col-md-6"></div>
                </div>
                <div class="col-md-12">
                        <table class="table table-hover">

                            <tr >
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                            </tr>
                            <tr >
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                            </tr>
                            <tr >
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                            </tr>
                            <tr >
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td></tr>
                            <tr >
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                                <td >...</td>
                            </tr>

                        </table>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                           <table class="table table-hover">

                            <tr class="active">
                                <td class="active">...</td>
                                <td class="success">...</td>
                                <td class="warning">...</td>
                                <td class="danger">...</td>
                                <td class="info">...</td>
                            </tr>
                            <tr class="success">
                                <td class="active">...</td>
                                <td class="success">...</td>
                                <td class="warning">...</td>
                                <td class="danger">...</td>
                                <td class="info">...</td>
                            </tr>
                            <tr class="warning">
                                <td class="active">...</td>
                                <td class="success">...</td>
                                <td class="warning">...</td>
                                <td class="danger">...</td>
                                <td class="info">...</td>
                            </tr>
                            <tr class="danger"><td class="active">...</td>
                                <td class="success">...</td>
                                <td class="warning">...</td>
                                <td class="danger">...</td>
                                <td class="info">...</td></tr>
                            <tr class="info">
                                <td class="active">...</td>
                                <td class="success">...</td>
                                <td class="warning">...</td>
                                <td class="danger">...</td>
                                <td class="info">...</td>
                            </tr>

                        </table><br><br><br><br><br>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                
                <?php
                }
                ?>
                <div class="col-lg-4"></div>  
                <div class="col-lg-4">                   
                    
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

