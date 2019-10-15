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


    <body onload="mudaEstilo(<?php print count($relatorio[$matricula[0]]["Informações_do_Aluno"]["Informações_Disciplinares"]) ?>, <?php print count($matricula) ?>)">
        <!-- Barra de navegação do app -->
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Gerador de Relatórios</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="Pesquisa_Matricula.php">Voltar <span class="sr-only">(Página atual)</span></a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="../Back-end/PedacoCodigoLista_Curso.php">(Modo_Desenvolverdor) <span class="sr-only">(Página atual)</span></a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="Edit.php?Serk='<?php print base64_encode("Edição Ativa")?>'">Editar Informações <span class="sr-only">(Página atual)</span></a>
                    </li> 
                </ul>
            </div>
        </nav>
        
        <!-- Fim da barra de navegação do app -->
        
        
        <?php for ($a = 0; $a < count($matricula); $a++) { ?>           
            <div class="container">
                <div class="row">
                    <!--  -->
                    <!-- Começo do painel de de Progresso do Aluno -->

                    <div class="col-md-12">
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
                                        <label>
                                            N O M E : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Nome"] ?>
                                        </label><br>
                                        <label>
                                            T U R M A : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Turma"] ?>
                                        </label><br>
                                        <label>
                                            I D A D E : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Idade"] ?>
                                        </label><br>
                                        <label>
                                            C I D A D E : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Cidade"] ?>
                                        </label><br>
                                        <label>
                                            R E P E T E N T E : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Repetente"] ?>
                                        </label><br>
                                        <label>
                                            A P R O V . N O C O N S E L H O : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Aprov_No_Conselho"] ?>
                                        </label><br>
                                        <label>
                                            A T L E T A : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Atleta"] ?>
                                        </label><br>
                                        <label>
                                            R E C E B E A U X Í L I O : <?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Recebe_Auxilio"] ?>
                                        </label><br>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="col-md-3 central">
                                            <div class="CirculoVermelho">
                                                <h2>CQ</h2>
                                                <h1 class="LetraBranca"><?php print number_format($relatorio[$matricula[$a]]["Informações_do_Aluno"]["CQ"], 1, '.', '') ?></h1>
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
                                <table class="table table-bordered">
                                    <tr class="BackgroundAzul LetraBranca">
                                        <th><h3>Diciplina</h3></th>
                                        <th><h3>B1</h3></th>
                                        <th><h3>R1</h3></th>
                                        <th><h3>M1</h3></th>
                                        <th><h3>B2</h3></th>
                                        <th><h3>R2</h3></th>
                                        <th><h3>M2</h3></th>
                                        <th><h3>B3</h3></th>
                                        <th><h3>R3</h3></th>
                                        <th><h3>M3</h3></th>
                                        <th><h3>B4</h3></th>
                                        <th><h3>R4</h3></th>
                                        <th><h3>M4</h3></th>
                                        <th><h3>PF</h3></th>
                                        <th><h3>MF</h3></th>
                                        <th><h3>Professores</h3></th>
                                    </tr>
                                    <?php for ($b = 0; $b < count($relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"]); $b++) { ?>
                                        <tr id="notas">
                                            <td><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Diciplina"] ?></td>

                                            <td class="LetralCooperBlack" id="<?php print "b1" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_1"] ?></td>                                    
                                            <td class="LetralCooperBlack" id="<?php print "r1" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_1"] ?></td>
                                            <td class="LetrasDestacadas" id="<?php print "m1" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_1"] ?></td>
                                            <td class="LetralCooperBlack" id="<?php print "b2" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_2"] ?></td>                                    
                                            <td class="LetralCooperBlack" id="<?php print "r2" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_2"] ?></td>
                                            <td class="LetrasDestacadas" id="<?php print "m2" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_2"] ?></td>
                                            <td class="LetralCooperBlack" id="<?php print "b3" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_3"] ?></td>                                    
                                            <td class="LetralCooperBlack" id="<?php print "r3" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_3"] ?></td>
                                            <td class="LetrasDestacadas" id="<?php print "m3" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_3"] ?></td>
                                            <td class="LetralCooperBlack" id="<?php print "b4" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_4"] ?></td>                                    
                                            <td class="LetralCooperBlack" id="<?php print "r4" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_4"] ?></td>
                                            <td class="LetrasDestacadas" id="<?php print "m4" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_4"] ?></td>
                                            <td class="LetralCooperBlack" id="<?php print "pf" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Prova_Final"] ?></td>
                                            <td class="LetrasDestacadas" id="<?php print "mf" . (string) $b . $a ?>"><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_Final"] ?></td>

                                            <td><?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Professor"] ?></td>
                                        </tr>                                 
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
                                    
                                    <?php for ($c = 0; $c < count($relatorio[$matricula[$a]]["Progresso_Geral"]); $c++) { ?>
                                        <div class="col-md-12 BackgroundCinza centralTodo">
                                            <h1 class="LetraBranca"><?php print ($c + 1) . "º  " ?>Bimestre</h1>                            
                                        </div>

                                        <div class="col-md-1 central"></div>
                                        <div class="col-md-5 central">
                                            <div class="CirculoVermelhoGrande">
                                                <p class="LetrasGrandes">
                                                    <?php print abs(round($relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Porcentagem_de_Recuperações"])) ?>%<br>
                                                </p>
                                                <p class="LetrasGPequena">
                                                    <?php print $relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_em_Recuperações"] ?>/<?php print $relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_Total"] ?>
                                                </p>

                                            </div>
                                            <h1>Diciplinas em Recuperação</h1>
                                        </div>
                                        <div class="col-md-1 central"></div>
                                        <div class="col-md-5 central">
                                            <div class="CirculoAzulGrande">
                                                <p class="LetrasGrandes">
                                                    <?php print abs(round($relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Porcentagem_Recuperada"])) ?>%<br>
                                                </p>
                                                <p class="LetrasGPequena">
                                                    <?php print $relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_Recuperada"] ?>/<?php print $relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_em_Recuperações"] ?>
                                                </p>
                                            </div>
                                            <h1>Diciplinas Recuperadas</h1>
                                        </div>
                                    <?php } ?>

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
                                        <h1 class="LetrasGrandes"><?php print $relatorio[$matricula[$a]]["Se_o_Ano_Acabasse_Hoje"]["Disciplina_em_Prova_Final"] ?></h1>
                                        <p class="LetrasGPequena">Quantidade de disciplinas em
                                            PROVA FINAL.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="quadradoGrande">
                                        <h1 class="LetrasGrandes"><?php print $relatorio[$matricula[$a]]["Se_o_Ano_Acabasse_Hoje"]["Disciplina_Reprovadas"] ?></h1>
                                        <p class="LetrasGPequena">Quantidade de disciplinas
                                            REPROVADO diretamente.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 quadradoSuperGrande">
                                <div class="col-md-6">
                                    <div>
                                        <h1 class="LetrasGrandes"><?php print $relatorio[$matricula[$a]]["Se_o_Ano_Acabasse_Hoje"]["Disciplinas_Aprovadas"] ?></h1>
                                        <p class="LetrasGPequena">Quantidade de disciplinas
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

                    <!-- Fim do painel de de Progresso de Se o Ano Acabasse Hoje? -->
                </div>            
            </div>
        <?php } ?>        
        <script type="text/javascript" src="bootstrap/jquery/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>  
        <script type="text/javascript" src="bootstrap/js/script2.js"></script>
    </body>

</html>