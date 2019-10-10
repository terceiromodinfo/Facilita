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
        exit(header("location:../Front_End/index.php?Error=" . $erro_code . ""));
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

    $ArrayDeAlunos = $_SESSION['ArrayDeAlunos'];
    $ArraysDeDados2 = $_SESSION['ArrayDeDados2'];

    if (base64_decode($get['alunos']) === "todos") {

        for ($b = 0; $b < count($ArrayDeAlunos); $b++) {
            $matricula[$b] = $ArrayDeAlunos[$b]["matricula"];
        }
    } else {
        $matricula[0] = base64_decode($get['alunos']);
    }

    //$ArrayDeAluno = arrayAluno();
    //print_r($matricula);
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
                //$ArrayDeAluno[0]["Informações_do_Aluno"]["PR"] = ExisteParamNoArray("ArrayDeAlunos", "Pr", $a);                     
                $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["EC"] = ExisteParamNoArray("ArrayDeAlunos", "Ec", $a);
                $contador = 0;
                for ($c = 0; $c < count($ArraysDeDados2); $c++) {
                    if ($ArraysDeDados2[$c]["matricula"] === $ArrayDeAlunos[$a]['matricula']) {
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Diciplina"] = ExisteParamNoArray("ArrayDeDados2", "disciplina", $c);
                        
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
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Media_Final"] = ExisteParamNoArray("ArrayDeDados2", "MF", $c);
                        
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Professor"] = ExisteParamNoArray("ArrayDeDados2", "professor", $c);
                        $contador++;
                    }
                }

                //print "<pre>";
                //print_r($ArrayDeAluno);
                //print "</pre>";
            }
        }
    }
    $_SESSION['Matricula'] = $matricula;
    $_SESSION['Relatorio'] = $ArrayDeAluno;

    print "<pre>";
    //print_r($_SESSION['ArrayDeDados']);
    print "</pre>";
    exit(header("location:../Front_end/Relatorio_Aluno.php"));
}