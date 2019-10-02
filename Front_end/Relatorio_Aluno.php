<?php
include '../Back-end/Funcoes.php';
$relatorio = $_SESSION['Relatorio'];
$matricula = $_SESSION['Matricula'];
?>
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
    
    <body onload="mudaEstilo(<?php print count($relatorio[$matricula[0]]["Informações_do_Aluno"]["Informações_Disciplinares"]) ?>, <?php print count($matricula)?>)">
     <?php for ($a = 0; $a < count($matricula); $a++) { ?>           
        <div class="container">
            <div class="row">
                <!--  -->
                <!-- Começo do painel de de Progresso do Aluno -->
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h1 class="titulo">Painel de Progresso do Aluno</h1>
                    <div class="col-md-12">                        
                        <!-- Informações do Aluno -->
                        <div class="col-md-12 BackgroundCBranco">
                            <!-- Lado Esquerdo -->
                            <div class="col-md-7">
                                <div class="col-md-5">
                                    <img src="img/default.png">
                                </div> 
                                <div class="col-md-7">
                                    <h6>
                                        N O M E : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Nome"] ?>
                                    </h6>
                                    <h6>
                                        T U R M A : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Turma"] ?>
                                    </h6>
                                    <h6>
                                        I D A D E : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Idade"] ?>
                                    </h6>
                                    <h6>
                                        C I D A D E : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Cidade"] ?>
                                    </h6>
                                    <h6>
                                        R E P E T E N T E : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Repetente"] ?>
                                    </h6>
                                    <h6>
                                        A P R O V . N O C O N S E L H O : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Aprov_No_Conselho"] ?>
                                    </h6>
                                    <h6>
                                        A T L E T A : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Atleta"] ?>
                                    </h6>
                                    <h6>
                                        R E C E B E A U X Í L I O : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Recebe_Auxilio"] ?>
                                    </h6>
                                </div> 
                                <div class="col-md-12">
                                    <div class="col-md-3 central">
                                        <div class="CirculoVermelho">
                                            <h2>CQ</h2>
                                            <h1 class="LetraBranca"><?php print round($relatorio[$matricula[$a]]["Informações_do_Aluno"]["CQ"]) ?></h1>
                                        </div>                                    
                                    </div>
                                    <div class="col-md-3 central">
                                        <div class="CirculoVermelho">
                                            <h2>PE</h2>
                                            <h1 class="LetraBranca"><?php print round($relatorio[$matricula[$a]]["Informações_do_Aluno"]["PE"]) ?></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3 central">
                                        <div class="CirculoVermelho">
                                            <h2>SD</h2>
                                            <h1 class="LetraBranca"><?php print round($relatorio[$matricula[$a]]["Informações_do_Aluno"]["SD"]) ?></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3 central">
                                        <div class="CirculoVermelho">
                                            <h2>EC</h2>
                                            <h1 class="LetraBranca"><?php print round($relatorio[$matricula[$a]]["Informações_do_Aluno"]["EC"]) ?></h1>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <!-- Lado Direito -->
                            <div class="col-md-5">
                                <img  src="img/WINWORD_2018-06-25_15-04-58.png" class="img-fluid" alt="Responsive image">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table class="table">
                                <tr class="BackgroundAzul LetraBranca">
                                    <th><h3>Diciplina</h3></th>
                                    <th><h3>Média</h3></th>
                                    <th><h3>Média Final</h3></th>
                                    <th><h3>Professores</h3></th>
                                </tr>
                                <?php for ($b = 0; $b < count($relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"]); $b++) {  ?>
                                <tr id="notas">
                                    <td><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Diciplina"] ?></td>
                                    <td id="<?php print (string)$b.$a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Média"] ?></td>
                                    <td id="<?php print "f".(string)$b.$a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Média_Final"] ?></td>
                                    <td><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Professor"] ?></td>
                                </tr> 
                                <script type="text/javascript" src="bootstrap/js/script2.js"></script>
                                <?php } ?>
                                
                            </table>                        
                        </div>
                    </div>
                    <!-- Fim do painel de de Progresso do Aluno -->

                    <!-- Começo do painel de de Progresso de Recuperção -->
                    <h1 class="titulo">Progresso de Recuperção</h1>
                    <div class="col-md-12 BackgroundCinza">
                        
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="col-md-12 BackgroundAzul centralTodo">
                                <h1 class="LetraBranca">Progresso Geral</h1>                            
                            </div>
                            <div class="col-md-12 central">

                                <div class="col-md-1 central"></div>
                                <div class="col-md-5 central">
                                    <div class="CirculoVermelhoGrande">
                                        <p class="LetrasGrandes">
                                            66%<br>
                                        </p>
                                        <p class="LetrasGPequena">
                                            12/18
                                        </p>

                                    </div>
                                    <h1>Diciplinas em Recuperação</h1>
                                </div>
                                <div class="col-md-1 central"></div>
                                <div class="col-md-5 central">
                                    <div class="CirculoAzulGrande">
                                        <p class="LetrasGrandes">
                                            66%<br>
                                        </p>
                                        <p class="LetrasGPequena">
                                            12/18
                                        </p>
                                    </div>
                                    <h1>Diciplinas Recuperadas</h1>
                                </div>

                            </div>

                            <div class="col-md-12 BackgroundAzul centralTodo">
                                <h1 class="LetraBranca">Progresso Base Comum</h1>                            
                            </div>
                            <div class="col-md-12 central">

                                <div class="col-md-1 central"></div>
                                <div class="col-md-5 central">
                                    <div class="CirculoVermelhoGrande">
                                        <p class="LetrasGrandes">
                                            66%<br>
                                        </p>
                                        <p class="LetrasGPequena">
                                            12/18
                                        </p>
                                    </div>
                                    <h1>Diciplinas em Recuperação</h1>
                                </div>
                                <div class="col-md-1 central"></div>
                                <div class="col-md-5 central">
                                    <div class="CirculoAzulGrande">
                                        <p class="LetrasGrandes">
                                            66%<br>
                                        </p>
                                        <p class="LetrasGPequena">
                                            12/18
                                        </p>
                                    </div>
                                    <h1>Diciplinas Recuperadas</h1>
                                </div>

                            </div>
                            <div class="col-md-12 BackgroundAzul centralTodo">
                                <h1 class="LetraBranca">Progresso Tecnico</h1>                            
                            </div>
                            <div class="col-md-12 central">

                                <div class="col-md-1 central"></div>
                                <div class="col-md-5 central">
                                    <div class="CirculoVermelhoGrande">
                                        <p class="LetrasGrandes">
                                            66%<br>
                                        </p>
                                        <p class="LetrasGPequena">
                                            12/18
                                        </p>
                                    </div>
                                    <h1>Diciplinas em Recuperação</h1>
                                </div>
                                <div class="col-md-1 central"></div>
                                <div class="col-md-5 central">
                                    <div class="CirculoAzulGrande">
                                        <p class="LetrasGrandes">
                                            66%<br>
                                        </p>
                                        <p class="LetrasGPequena">
                                            12/18
                                        </p>
                                    </div>
                                    <h1>Diciplinas Recuperadas</h1>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <!-- Fim do painel de de Progresso de Recuperção -->

                    <!-- Começo do painel de de Progresso de Se o Ano Acabasse Hoje? -->
                    <h1 class="titulo">Se o Ano Acabasse Hoje?</h1>
                    <div class="col-md-12">                        
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="quadradoGrande">
                                    <h1 class="LetrasGrandes">5</h1>
                                    <p class="LetrasGPequena">Quantidade de disciplinas em
                                        PROVA FINAL.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="quadradoGrande">
                                    <h1 class="LetrasGrandes">6</h1>
                                    <p class="LetrasGPequena">Quantidade de disciplinas
                                        REPROVADO diretamente.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 quadradoSuperGrande">
                            <div class="col-md-6">
                                <div>
                                    <h1 class="LetrasGrandes">2</h1>
                                    <p class="LetrasGPequena">Quantidade de disciplinas em
                                        APROVADAS.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <img class="img-responsive" style="margin: 10px" src="img/ferido-maca-pessoas-carregar-desenhos_csp19456639.jpg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <!-- Fim do painel de de Progresso de Se o Ano Acabasse Hoje? -->
            </div>            
        </div>
        <?php } ?>
        <script type="text/javascript" src="bootstrap/jquery/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>        
    </body>
    
</html>