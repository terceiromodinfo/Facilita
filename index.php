<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TODO supply a title</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="estilo.css" rel="stylesheet">
        <script type="text/javascript" src="capDeInfo.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row"> 
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
        <!---->
        <!--
        Layout criado para pegar o arquivo desejado e fazer o upload das suas
        informações
        -->
        
                <div class="col-lg-4"></div>  
                <div class="col-lg-4">
                    <div class="">
                        <form action="CodigoFonts.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Selecionar um arquivo</label>
                                <input type="file" class="btn btn-default"  name="file" value="Upload">
                            </div>
                            <input type="submit" class="btn btn-default" value="Prosseguir" name="LerCsv">
                        </form>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
