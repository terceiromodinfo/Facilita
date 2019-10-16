<?php
include '../Back-end/Funcoes.php';
$get = get();

if (isset($get["Serk"]) && base64_decode($get["Serk"]) == "Edição Ativa") {
    $relatorio = $_SESSION['Relatorio'];
    $matricula = $_SESSION['Matricula'];
    /*
     * Aqui sera criado o HTML misto com PHP para faser as edições necessarias
     */
    for ($a = 0; $a < count($matricula); $a++) {
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
            <body>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <form id="form" action="../Back-end/Excript_Principal.php" method="POST" enctype="multipart/form-data">
                                <!-- Painel de Progresso do Aluno -->

                                <div class="col-sm-12"><h1>Painel de Progresso do Aluno</h1></div>

                                <div class="col-sm-8">
                                    <div class="col-sm-6">
                                        <label>Nome:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="nome" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Nome"] ?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Turma:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="turma" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Turma"] ?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Idade:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="idade" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Idade"] ?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Cidade:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="cidade" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Cidade"] ?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Repetente:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="repetente" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Repetente"] ?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Aprovado No Conselho:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="aprovadoNoConselho" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Aprov_No_Conselho"] ?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Atleta:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="atleta" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Atleta"] ?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Recebe Auxilio:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="recebeAuxilio" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Recebe_Auxilio"] ?>">
                                    </div>

                                    <div class="col-sm-3">
                                        <label>CQ:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="cq" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["CQ"] ?>">
                                    </div>

                                    <div class="col-sm-3">
                                        <label>PE:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="pe" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["PE"] ?>">
                                    </div>

                                    <div class="col-sm-3">
                                        <label>SD:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="sd" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["SD"] ?>">
                                    </div>

                                    <div class="col-sm-3">
                                        <label>EC:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="ec" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["EC"] ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="col-sm-12">
                                        <div class="col-sm-12">
                                            <label>Link da imagem do Grafico:</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="imgGrafic" value="<?php if (isset($relatorio[$matricula[$a]]["Informações_do_Aluno"]["ImagemGrafico"])) {print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["ImagemGrafico"];} ?>">
                                        </div>
                                        <div class="col-sm-12">
                                            <label>Link da imagem do Perfil:</label>
                                            <input type="text" class="form-control input-group-lg chat-input"  name="imgPerfil" value="<?php if (isset($relatorio[$matricula[$a]]["Informações_do_Aluno"]["ImagemGrafico"])) {print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["ImagemPerfil"];} ?>">
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- Fim Painel de Progresso do Aluno -->

                                <!-- Painel de Notas do Aluno -->  
                                <div class="col-sm-12"><h1>Painel de Progresso do Aluno</h1></div>
                                <table class="table table-responsive-lg">
                                    <tr class="BackgroundCinza LetraBranca">
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
                                    <?php for ($b = 0; $b < count($relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"]); $b++) { 
                                        $diciplina = $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Diciplina"];?>
                                        <tr id="notas">
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "diciplina".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Diciplina"] ?>"></td>

                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "bimestre1".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_1"] ?>"></td>                                    
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "recuperacao1".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_1"] ?>"></td>
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "media1".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_1"] ?>"></td>
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "bimestre2".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_2"] ?>"></td>                                    
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "recuperacao2".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_2"] ?>"></td>
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "media2".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_2"] ?>"></td>
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "bimestre3".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_3"] ?>"></td>                                    
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "recuperacao3".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_3"] ?>"></td>
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "media3".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_3"] ?>"></td>
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "bimestre4".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_4"] ?>"></td>                                    
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "recuperacao4".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_4"] ?>"></td>
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "media4".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_4"] ?>"></td>
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "prova_final".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Prova_Final"] ?>"></td>
                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "media_final".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_Final"] ?>"></td>

                                            <td><input type="text" class="form-control input-group-lg chat-input"  name="<?php print "professor".$b ?>" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Professor"] ?>"></td>
                                        </tr>                                 
                                    <?php } ?>

                                </table> 
                                <!-- Fim Painel de Notas do Aluno -->

                                <!-- Painel de Porcentagens do Aluno -->
                                <div class="col-sm-12">
                                    <h1>Progresso de Recuperção</h1>
                                    <?php if (count($relatorio[$matricula[$a]]['Progresso_Geral']) < 4) { ?>
                                        <a class="btn btn-secondary btn-block" href="../Back-end/Excript_Principal.php?AddBimestre=<?php print $matricula[$a] ?>">Adicionar Bimestre</a>                                  
                                    <?php } ?>
                                </div><br>

                                <?php for ($c = 0; $c < count($relatorio[$matricula[$a]]["Progresso_Geral"]); $c++) { ?>

                                    <div class="col-sm-12">                                    
                                        <div class="col-md-12 BackgroundCinza centralTodo">
                                            <h1 class="LetraBranca"><?php print ($c + 1) . "º  " ?>Bimestre</h1>                            
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Porcentagem de Recuperações</label>
                                            <input type="text" class="form-control input-group-lg chat-input"  name="<?php print "PdR".$c ?>" value="<?php print abs(round($relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Porcentagem_de_Recuperações"])) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Disciplina em Recuperações</label>
                                            <input type="text" class="form-control input-group-lg chat-input"  name="<?php print "DeR".$c ?>" value="<?php print abs(round($relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_em_Recuperações"])) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Todas as Disciplina Total</label>
                                            <input type="text" class="form-control input-group-lg chat-input"  name="<?php print "DT".$c ?>" value="<?php print abs(round($relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_Total"])) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Porcentagem Recuperada</label>
                                            <input type="text" class="form-control input-group-lg chat-input"  name="<?php print "PR".$c ?>" value="<?php print abs(round($relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Porcentagem_Recuperada"])) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Disciplina Recuperada</label>
                                            <input type="text" class="form-control input-group-lg chat-input"  name="<?php print "DR".$c ?>" value="<?php print abs(round($relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_Recuperada"])) ?>">
                                        </div>
                                    </div>

                                <?php } ?>

                                <!-- Fim Painel de Porcentagens do Aluno -->

                                <!-- Se o ano acabace hoje -->
                                <div class="col-sm-12">
                                    <h1>Se o Ano Acabasse Hoje</h1>                                    
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label>Disciplina em Provas Finais</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="DicProvFinal" value="<?php print $relatorio[$matricula[$a]]["Se_o_Ano_Acabasse_Hoje"]["Disciplina_em_Prova_Final"] ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Disciplina Reprovadas Diretamente</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="DiciReprovDirect" value="<?php print $relatorio[$matricula[$a]]["Se_o_Ano_Acabasse_Hoje"]["Disciplina_Reprovadas"] ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Disciplina Aprovadas</label>
                                        <input type="text" class="form-control input-group-lg chat-input"  name="DiciAprov" value="<?php print $relatorio[$matricula[$a]]["Se_o_Ano_Acabasse_Hoje"]["Disciplinas_Aprovadas"] ?>">
                                    </div>
                                </div>
                                <label></label>
                                <!-- Se o ano acabace hoje -->

                                <input type="submit" class="btn btn-block btn-success" onclick="carregando('form')" value="Salvar" name="EditarDados">
                            </form>                            
                        </div>                        
                    </div>
                </div>  
                <div class="col-lg-12" id="resultado" align="center"></div>

                <script type="text/javascript" src="bootstrap/jquery/jquery.js"></script>
                <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="bootstrap/js/Script.js"></script>
                <script type="text/javascript" src="bootstrap/js/script2.js"></script>
            </body>
        </html>    
        <?php
    }
    //print "<pre>";
    //print_r($matricula);
    //print "<pre>";
}
