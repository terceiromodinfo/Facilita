<?php
include './Funcoes.php';
$relatorio = $_SESSION['Relatorio'];
$matricula = $_SESSION['Matricula'];
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
        
<?php

  print "<pre>";
  print_r($_SESSION['Relatorio']);
  print "</pre>";
 
?>
       
    </body>
</html>
