<?php
include './Funcoes.php';



print "<pre>";
print_r($_SESSION['ArrayDeDados2']);
print "</pre>";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gerador de Relatórios</title>
        <link rel="stylesheet" href="../Front_end/bootstrap/css/bootstrap.min_1.css">        
    </head>
    <body>
       
        <div class="col-lg-6">
            <?php
            print "<pre>";
            print_r($_SESSION['ArrayDeDados2']);
            print "</pre>";
            ?>
        </div>
        <div class="col-lg-6">
            <?php
            print "<pre>";
            print_r($_SESSION['ArrayDeAlunos']);
            print "</pre>";
            ?>
        </div>        
    </body>
</html>