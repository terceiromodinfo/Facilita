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

                                <div class="col-sm-6">
                                    <label>Nome:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Nome"] ?>">
                                </div>

                                <div class="col-sm-6">
                                    <label>Turma:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Turma"] ?>">
                                </div>

                                <div class="col-sm-6">
                                    <label>Idade:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Idade"] ?>">
                                </div>

                                <div class="col-sm-6">
                                    <label>Cidade:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Cidade"] ?>">
                                </div>

                                <div class="col-sm-6">
                                    <label>Repetente:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Repetente"] ?>">
                                </div>

                                <div class="col-sm-6">
                                    <label>Aprovado No Conselho:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Aprov_No_Conselho"] ?>">
                                </div>

                                <div class="col-sm-6">
                                    <label>Atleta:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Atleta"] ?>">
                                </div>

                                <div class="col-sm-6">
                                    <label>Recebe Auxilio:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Recebe_Auxilio"] ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>CQ:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["CQ"] ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>PE:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["PE"] ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>SD:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["SD"] ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>EC:</label>
                                    <input type="text" class="form-control input-group-lg chat-input"  name="" value="<?php print $relatorio[$matricula[$a]]["Informações_do_Aluno"]["EC"] ?>">
                                </div>
                                
                                <!-- Fim Painel de Progresso do Aluno -->
                                
                                <!-- Painel de Notas do Aluno -->
                                <div class="col-sm-12"><h1>Notas do Aluno</h1></div>                                
                                
                                <!-- Fim Painel de Notas do Aluno -->
                            </form>
                        </div>                        
                    </div>
                </div>                

                <script type="text/javascript" src="bootstrap/jquery/jquery.js"></script>
                <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="bootstrap/js/Script.js"></script>
            </body>
        </html>    
        <?php
    }
    //print "<pre>";
    //print_r($matricula);
    //print "<pre>";
}
