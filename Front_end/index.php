
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
                    <li class="nav-item active">
                        <a class="nav-link" href="../Back-end/PedacoCodigoLista_Curso.php">Informações <span class="sr-only">(Página atual)</span></a>
                    </li> 
                </ul>
            </div>
        </nav>
        
        <!-- Fim da barra de navegação do app -->
            
        <!-- Formulario  -->
        
        <div class="col-lg-4"></div>  
        <div class="col-lg-4">
            <div class=""> 
                <form id="form" action="../Back-end/Excript_Principal.php" method="POST" enctype="multipart/form-data">
                    <label>Selecionar o arquivo potencial evasão, o arquivo de informações disciplinares, o arquivo
                    de extra classe, o arquivo de indisciplina.                 
                    </label><br><br><br>
                    <div class="form-group">
                        <label>Selecionar a o arquivo</label>
                        <input type="file" class="btn btn-default"  name="file" value="Upload">
                    </div>
                    <div class="form-group">
                        <label>Selecionar a o arquivo</label>
                        <input type="file" class="btn btn-default"  name="file2" value="Upload">
                    </div>
                    <div class="form-group">
                        <label>Selecionar a o arquivo</label>
                        <input type="file" class="btn btn-default"  name="file3" value="Upload">
                    </div>
                    <div class="form-group">
                        <label>Selecionar a o arquivo</label>
                        <input type="file" class="btn btn-default"  name="file4" value="Upload">
                    </div>
                    <input type="submit" class="btn btn-default" onclick="carregando('form')" value="Prosseguir" name="LerCsv">
                </form>
            </div>
        </div>
        <div class="col-lg-4"></div>
        
        
        <!-- Fim formulario do app -->
        
        <!-- Div para aparecer o loading -->
        <div class="col-lg-12" id="resultado" align="center"></div>
        
        <script type="text/javascript" src="bootstrap/jquery/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/Script.js"></script>
    </body>
</html>
<?php 
include '../Back-end/Funcoes.php';
$get = get();
        if (isset($get['Error'])) {
           
            $Error =  base64_decode($get['Error']);
            switch ($Error) {
                case  "N_arquivoSelecionado";
                    print "<script>alert('Não foi selecionado todos arquivos')</script>";
                    unset($get['Error']);
                    break;
                case  "DiferenteD_Csv";
                    print "<script>alert('Primeiro arquivo diferente de CSV')</script>";
                    unset($get['Error']);
                    break;
                case  "DiferenteD_Csv2";
                    print "<script>alert('Segundo arquivo diferente de CSV')</script>";
                    unset($get['Error']);
                    break;
            }
          
            //print "<script>alert('Não foi selecionado nenhum arquivo')</script>";
            unset($get['Error']);
        }
?>