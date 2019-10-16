<?php

include './Funcoes.php';
//Funçãos atibuida e uma variavel para o uso do metodo POST e GET
$post = post();
$get = get();

/*
 * codigo que pega as informaçoes do arquivo .csv, faz a conversão 
 * para um Array
 * 
 * LerCsv é o nome dado ao botão, quando clicado mandarar em FORM via POST os CSV
 * para ser convertido em ARRAY
 */

if (isset($post['LerCsv'])) {
    //Variavel Global
    //Receberar o potencial de evasão
    $_SESSION['ArrayDeDados'] = array();
    //Receberar informações diciplinares
    $_SESSION['ArrayDeDados2'] = array();
    //Receberar informações de extra classe
    $_SESSION['ArrayDeDados3'] = array();
    //Receberar informações de indiciplinas
    $_SESSION['ArrayDeDados4'] = array();
    //Receberar Informações a ser exibida no relatorio
    $_SESSION['ArrayDeAlunos'] = array();
    //Receberar os alunos do arquivos inseridos
    $_SESSION['ArrayDeAlunosPesquisado'] = array();

    //Variaveis exclusiva para uso somente dentro do IF

    $contador = 0;
    $ArraysDeDados = array();
    $ArraysDeDados2 = array();
    $ArraysDeDados3 = array();
    $ArraysDeDados4 = array();

    /*
     * Recebe os valores do formulario e passa pelos tratamentos de erros, depois para função,
     * que converte para array
     * */

    $arquivo = $_FILES["file"]["tmp_name"];
    $nome = $_FILES["file"]["name"];

    $arquivo2 = $_FILES["file2"]["tmp_name"];
    $nome2 = $_FILES["file2"]["name"];

    $arquivo3 = $_FILES["file3"]["tmp_name"];
    $nome3 = $_FILES["file3"]["name"];

    $arquivo4 = $_FILES["file4"]["tmp_name"];
    $nome4 = $_FILES["file4"]["name"];


    /*
     * Aqui tratarar de erros como, arquivos vazio, ou
     * de extenção diferente
     */


    //Tratamento de erro caso esteja vazia
    if (($arquivo === "") || ($arquivo2 === "") || ($arquivo3 === "") || ($arquivo4 === "")) {
        $erro_code = base64_encode("N_arquivoSelecionado");
        exit(header("location:../Front_end/index.php?Error=" . $erro_code . ""));
    }

    //Tratamento de erro caso diferente de CSV
    if ($nome != "") {
        $texto = explode(".", $nome);
        $extencao = end($texto);
        if ($extencao != "csv") {
            $erro_code = base64_encode("DiferenteD_Csv");
            exit(header("location:../Front_end/index.php?Error=" . $erro_code . ""));
        }
    }
    //Tratamento de erro caso diferente de CSV
    if ($nome2 != "") {
        $texto2 = explode(".", $nome2);
        $extencao2 = end($texto2);
        if ($extencao2 != "csv") {
            $erro_code = base64_encode("DiferenteD_Csv2");
            exit(header("location:../Front_end/index.php?Error=" . $erro_code . ""));
        }
    }

    //Tratamento de erro caso diferente de CSV
    if ($nome3 != "") {
        $texto3 = explode(".", $nome3);
        $extencao3 = end($texto3);
        if ($extencao3 != "csv") {
            $erro_code = base64_encode("DiferenteD_Csv3");
            exit(header("location:../Front_end/index.php?Error=" . $erro_code . ""));
        }
    }

    //Tratamento de erro caso diferente de CSV
    if ($nome4 != "") {
        $texto4 = explode(".", $nome4);
        $extencao4 = end($texto4);
        if ($extencao4 != "csv") {
            $erro_code = base64_encode("DiferenteD_Csv4");
            exit(header("location:../Front_end/index.php?Error=" . $erro_code . ""));
        }
    }

    /*
     *  Usar uma função para converter o .CSV em array
     */
    $ArraysDeDados = csvtojson($arquivo, ",");
    $ArraysDeDados2 = csvtojson($arquivo2, ",");
    $ArraysDeDados3 = csvtojson($arquivo3, ",");
    $ArraysDeDados4 = csvtojson($arquivo4, ",");

    /*
     * Organizando os arquivos, usando uma função para organizalos cada um 
     * em sua variavel global adquadra, pois o layout da pagina não obriga o usuario 
     * a selecionas os .CSV em forma organizada,
     */

    organizaDados($ArraysDeDados);
    organizaDados($ArraysDeDados2);
    organizaDados($ArraysDeDados3);
    organizaDados($ArraysDeDados4);

    /*
     * Aqui iremos organizar, o primeiro .CSV que está na variavel global "ArraysDeDados" nele esta todos alunos
     * de todos cursos, como ele e a base principal de informções, e necessario verificar o segundo .CSV que esta
     * no "ArraysDeDados2" que contem iformações apenas de um curso, o codigo ira indentificar qual é esse curso
     * e armazenar somente as informações deste curso na variavel $ArrayDeAlunos.
     */

    $ArrayDeAlunos = null;

    for ($a = 0; $a < count($_SESSION['ArrayDeDados']); $a++) {
        if ($_SESSION['ArrayDeDados2'][0]["turma"] === $_SESSION['ArrayDeDados'][$a]["turma"]) {
            $_SESSION['ArrayDeDados'][$a]["Ec"] = getEC($_SESSION['ArrayDeDados'][$a]["matricula"]);
            $_SESSION['ArrayDeDados'][$a]["Sd"] = getSD($_SESSION['ArrayDeDados'][$a]["matricula"]);
            $ArrayDeAlunos[$contador] = $_SESSION['ArrayDeDados'][$a];
            $contador++;
        }
    }

    //Guardando as informçoes em uma variavel global

    $_SESSION['ArrayDeAlunos'] = $ArrayDeAlunos;
    $_SESSION['ArrayDeAlunosPesquisado'] = $ArrayDeAlunos;

    /*
      print "<pre>";
      print_r($_SESSION['ArrayDeAlunos']);
      print_r($_SESSION['ArrayDeAlunosPesquisado']);
      //print_r($_SESSION['ArrayDeDados3']);;
      //print_r($_SESSION['ArrayDeDados4']);
      print "</pre>";
     * 
     */





    /*
     * Elimina todas as variaveis que não serão mais utilizada, pois serão reutilizadas em outros codigos
     */

    unset($post['LerCsv'], $ArrayDeAlunos, $ArraysDeDados, $ArraysDeDados2, $ArraysDeDados3, $ArraysDeDados4, $a, $contador, $arquivo, $arquivo2, $arquivo3, $arquivo4, $erro_code,
            $nome, $nome2, $nome3, $nome4, $texto, $texto2, $texto3, $texto4, $extencao, $extencao2, $extencao3, $extencao4);
    exit(header("location:../Front_end/Pesquisa_Matricula.php"));
}

/*
 * Excript para pesquisa da matricula 
 * 
 * Retorna todos alunos se á matricula pesquisada vier em branco
 * Retorna todas informações do aluno se a matricula for valida
 * Retorna matricula invalida caso for chegue ao final
 */

if (isset($post['matricula'])) {
    $matricula = $post['matricula'];
    $ArraysDeDados = $_SESSION['ArrayDeAlunos'];
    $_SESSION['ArrayDeAlunosPesquisado'] = null;
    if ($matricula === "") {
        $_SESSION['ArrayDeAlunosPesquisado'] = $ArraysDeDados;
    } else {
        for ($a = 0; $a < count($ArraysDeDados); $a++) {

            if ($matricula === $ArraysDeDados[$a]['matricula']) {

                $_SESSION['ArrayDeAlunosPesquisado'][0] = $ArraysDeDados[$a];
                exit(header("location:../Front_end/Lista_De_Alunos.php"));
            }
        }
        $erro = "Matricula é invalida";
        $_SESSION['ArrayDeAlunosPesquisado'][0] = $erro;
    }
    unset($post['matricula'], $matricula, $ArraysDeDados, $erro, $a);
    exit(header("location:../Front_end/Lista_De_Alunos.php"));
}

/*
 * Organiza todas as informções para ser exibida no relatorio
 */

if (isset($get['alunos'])) {
     
    //pega os valores guardados nas variaveis global
    $ArrayDeAlunos = $_SESSION['ArrayDeAlunos'];
    $ArraysDeDados2 = $_SESSION['ArrayDeDados2'];
    
    /*
     * Faz uma verificação se o usuario esta pedindo apenas o relatorio de um aluno ou todos do curso.
     * Aqui ele recebera "TODOS" ou a matricula do aluno escolhido.
     * Se ele pedir o relatorio "todos" sera passada para variavel todas as matriculas existente na turma,
     * caso não ele recebera a matricula enviado pelo GET
     */
    if (base64_decode($get['alunos']) === "todos") {

        for ($b = 0; $b < count($ArrayDeAlunos); $b++) {
            $matricula[$b] = $ArrayDeAlunos[$b]["matricula"];
        }
    } else {
        $matricula[0] = base64_decode($get['alunos']);
    }

    /*
     * Aqui existirão duas variaveis parecidas "$ArrayDeAluno" e "$ArrayDeAlunos"
     * $ArrayDeAlunos são todos alunos de uma turma
     * Ja $ArrayDeAluno reberar de $ArrayDeAlunos, mas de forma organizada tudo pronto para ser
     * passado para o relatorio final.
     * 
     * O codigo verificara qual matricula existente em $ArrayDeAlunos e igual á matricula do aluno escolhido
     * pelo usuario.
     * 
     * A função chamada ExisteParamNoArray() e para ferificar se exite esses dados se não ouver ela retornara um valor "--"
     * Primeiro parametro ("ArrayDeAlunos") é o nome da variavel global, segundo ("aluno") dado exitente na variavel global, 
     * terceiro ($a) posição do dados no global.
     * 
     * À arquitetura do array pode ser entendida usando o seguinte codigo | print_r(arrayAluno()); |
     */
    for ($a = 0; $a < count($ArrayDeAlunos); $a++) {
        for ($d = 0; $d < count($matricula); $d++) {
            if ($matricula[$d] === $ArrayDeAlunos[$a]['matricula']) {
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Nome"] = ExisteParamNoArray("ArrayDeAlunos", "aluno", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Turma"] = ExisteParamNoArray("ArrayDeAlunos", "turma", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Idade"] = ExisteParamNoArray("ArrayDeAlunos", "idade", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Cidade"] = ExisteParamNoArray("ArrayDeAlunos", "cidade", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Repetente"] = ExisteParamNoArray("ArrayDeAlunos", "repetente", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Aprov_No_Conselho"] = ExisteParamNoArray("ArrayDeAlunos", "aprov_no_conselho", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Atleta"] = ExisteParamNoArray("ArrayDeAlunos", "atleta", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Recebe_Auxilio"] = ExisteParamNoArray("ArrayDeAlunos", "recebe_auxilio", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["CQ"] = ExisteParamNoArray("ArrayDeAlunos", "Cq", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["PE"] = ExisteParamNoArray("ArrayDeAlunos", "Pe", $a);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["SD"] = ExisteParamNoArray("ArrayDeAlunos", "Sd", $a);                                   
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["EC"] = ExisteParamNoArray("ArrayDeAlunos", "Ec", $a);
                $contador = 0;
                for ($c = 0; $c < count($ArraysDeDados2); $c++) {
                    if ($ArraysDeDados2[$c]["matricula"] === $ArrayDeAlunos[$a]['matricula']) {
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Diciplina"] = ExisteParamNoArray("ArrayDeDados2", "disciplina", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Id_diciplina"] = ExisteParamNoArray("ArrayDeDados2", "disciplina_id", $c);

                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Bimestre_1"] = ExisteParamNoArray("ArrayDeDados2", "B1", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Recuperar_1"] = ExisteParamNoArray("ArrayDeDados2", "R1", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Media_1"] = ExisteParamNoArray("ArrayDeDados2", "M1", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Bimestre_2"] = ExisteParamNoArray("ArrayDeDados2", "B2", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Recuperar_2"] = ExisteParamNoArray("ArrayDeDados2", "R2", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Media_2"] = ExisteParamNoArray("ArrayDeDados2", "M2", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Bimestre_3"] = ExisteParamNoArray("ArrayDeDados2", "B3", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Recuperar_3"] = ExisteParamNoArray("ArrayDeDados2", "R3", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Media_3"] = ExisteParamNoArray("ArrayDeDados2", "M3", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Bimestre_4"] = ExisteParamNoArray("ArrayDeDados2", "B4", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Recuperar_4"] = ExisteParamNoArray("ArrayDeDados2", "R4", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Media_4"] = ExisteParamNoArray("ArrayDeDados2", "M4", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Prova_Final"] = ExisteParamNoArray("ArrayDeDados2", "PF", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Media_Final"] = (double) ExisteParamNoArray("ArrayDeDados2", "MF", $c);

                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Professor"] = ExisteParamNoArray("ArrayDeDados2", "professor", $c);
                        $contador++;
                    }
                }

                $progressoGeral = getProgressoGeral($ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"]);

                for ($e = 0; $e < count($progressoGeral); $e++) {
                    $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Progresso_Geral"][$e]["Porcentagem_de_Recuperações"] = $progressoGeral[$e]["Porcentagem_de_Recuperações"];
                    $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Progresso_Geral"][$e]["Disciplina_em_Recuperações"] = $progressoGeral[$e]["Disciplina_em_Recuperações"];
                    $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Progresso_Geral"][$e]["Disciplina_Total"] = $progressoGeral[$e]["Disciplina_Total"];
                    $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Progresso_Geral"][$e]["Porcentagem_Recuperada"] = $progressoGeral[$e]["Porcentagem_Recuperada"];
                    $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Progresso_Geral"][$e]["Disciplina_Recuperada"] = $progressoGeral[$e]["Disciplina_Recuperada"];
                }
                $SeAnoAcaba = getFimAnoAgora($ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"]);
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Se_o_Ano_Acabasse_Hoje"]["Disciplina_em_Prova_Final"] = $SeAnoAcaba["Pro_Final"];
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Se_o_Ano_Acabasse_Hoje"]["Disciplina_Reprovadas"] = $SeAnoAcaba["Reprovado"];
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Se_o_Ano_Acabasse_Hoje"]["Disciplinas_Aprovadas"] = $SeAnoAcaba["Aprovado"];
            }
        }
    }
    $_SESSION['Matricula'] = $matricula;
    $_SESSION['Relatorio'] = $ArrayDeAluno;

    
    unset($get['alunos'], $matricula, $ArrayDeAluno, $ArrayDeAlunos, $a, $e, $d, $SeAnoAcaba, $progressoGeral, $contador);
    exit(header("location:../Front_end/Relatorio_Aluno.php"));
}

//Edição do dados que foram exibido no relatorio
if (isset($post['EditarDados'])) {

    $matricula = $_SESSION['Matricula'];
    $relatorio = $_SESSION['Relatorio'];
    
    /*
     * Sera enserido as mudanças que o usuario fez na edição 
     */
    for ($a = 0; $a < count($matricula); $a++) {

        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Nome"] = $post['nome'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Turma"] = $post['turma'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Idade"] = $post['idade'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Cidade"] = $post['cidade'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Repetente"] = $post['repetente'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Aprov_No_Conselho"] = $post['aprovadoNoConselho'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Atleta"] = $post['atleta'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Recebe_Auxilio"] = $post['recebeAuxilio'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["CQ"] = $post['cq'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["PE"] = $post['pe'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["SD"] = $post['sd'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["EC"] = $post['ec'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["ImagemGrafico"]= $post['imgGrafic'];
        $relatorio[$matricula[$a]]["Informações_do_Aluno"]["ImagemPerfil"]= $post['imgPerfil'];

        for ($b = 0; $b < count($relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"]); $b++) {
            $diciplina = $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Diciplina"];

            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_1"] = $post['bimestre1' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_1"] = $post['recuperacao1' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_1"] = $post['media1' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_2"] = $post['bimestre2' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_2"] = $post['recuperacao2' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_2"] = $post['media2' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_3"] = $post['bimestre3' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_3"] = $post['recuperacao3' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_3"] = $post['media3' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Bimestre_4"] = $post['bimestre4' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Recuperar_4"] = $post['recuperacao4' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_4"] = $post['media4' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Prova_Final"] = $post['prova_final' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Media_Final"] = $post['media_final' . $b];

            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Professor"] = $post['professor' . $b];
            $relatorio[$matricula[$a]]["Informações_do_Aluno"]["Informações_Disciplinares"][$b]["Diciplina"] = $post['diciplina' . $b];
        }
        for ($c = 0; $c < count($relatorio[$matricula[$a]]["Progresso_Geral"]); $c++) {
            $relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Porcentagem_de_Recuperações"] = $post['PdR' . $c];
                    $relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_em_Recuperações"] = $post['DeR' . $c];
                    $relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_Total"] = $post['DT' . $c];
                    $relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Porcentagem_Recuperada"] = $post['PR' . $c];
                    $relatorio[$matricula[$a]]["Progresso_Geral"][$c]["Disciplina_Recuperada"] = $post['DR' . $c];
        }
        $relatorio[$matricula[$a]]["Se_o_Ano_Acabasse_Hoje"]["Disciplina_em_Prova_Final"] = $post['DicProvFinal'];
        $relatorio[$matricula[$a]]["Se_o_Ano_Acabasse_Hoje"]["Disciplina_Reprovadas"] = $post['DiciReprovDirect'];
        $relatorio[$matricula[$a]]["Se_o_Ano_Acabasse_Hoje"]["Disciplinas_Aprovadas"] = $post['DiciAprov'];
        
    }
    $_SESSION['Relatorio'] = $relatorio;
    unset($post['EditarDados'], $relatorio, $a, $b, $c, $matricula, $diciplina);
    exit(header("location:../Front_end/Relatorio_Aluno.php"));
}
/*
 * Como o codigo exibe no relatorio final apenas as informações de bimestres que possua notas
 * Esse codigo adiciona um novo bimestre em branco para a edição
 */
if (isset($get['AddBimestre'])) {
    $matricula = $get['AddBimestre'];
    $Progresso_Geral = $_SESSION['Relatorio'][$matricula]['Progresso_Geral'];
    if (count($Progresso_Geral) < 4) {
        $Progresso_Geral[count($Progresso_Geral)]["Porcentagem_de_Recuperações"] = 0;
        $Progresso_Geral[count($Progresso_Geral) - 1]["Disciplina_em_Recuperações"] = 0;
        $Progresso_Geral[count($Progresso_Geral) - 1]["Disciplina_Total"] = 0;
        $Progresso_Geral[count($Progresso_Geral) - 1]["Porcentagem_Recuperada"] = 0;
        $Progresso_Geral[count($Progresso_Geral) - 1]["Disciplina_Recuperada"] = 0;

        $_SESSION['Relatorio'][$matricula]['Progresso_Geral'] = $Progresso_Geral;
    }

    unset($post['AddBimestre'], $matricula, $Progresso_Geral);
    exit(header("location:../Front_end/Edit.php?Serk=" . base64_encode("Edição Ativa") . ""));
}