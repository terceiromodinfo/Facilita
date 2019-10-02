<?php

include './Funcoes.php';
//Funçãos atibuida e uma variavel para o uso do metodo POST e GET
$post = post();
$get = get();
//Variavel Global
$_SESSION['ArrayDeDados'];
$_SESSION['ArrayDeDados2'];
$_SESSION['ArrayDeAlunos'];
$_SESSION['ArrayDeAlunosPesquisado'];
$_SESSION['ArrayDeCusos'];


/*
 * codigo que pega as informaçoes do arquivo .csv, faz a conversão 
 * para um Array
 * 
 * LerCsv é o nome dado ao botão, quando clicado mandarar em FORM via POST os CSV
 * para ser convertido em ARRAY
 */

if (isset($post['LerCsv'])) {
    $contador=0;
    $ArraysDeDados = array();
    $ArraysDeDados2 = array();
    /*
     * Recebe os valores do formulario e passa pelos tratamentos de erros, depois para função,
     * que converte para array
     * */

    $arquivo = $_FILES["file"]["tmp_name"];
    $nome = $_FILES["file"]["name"];

    $arquivo2 = $_FILES["file2"]["tmp_name"];
    $nome2 = $_FILES["file2"]["name"];



    /*
     * Aqui tratarar de erros como, arquivos vazio, ou
     * de extenção diferente
     */


    //Tratamento de erro caso esteja vazia
    if (($arquivo === "") || ($arquivo2 === "")) {
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

    /*
     * Organizando os arquivos
     */

    // Executarar apenas se existir um arquivo valido
    if ($arquivo != "") {
        $ArraysDeDados = csvtojson($arquivo, ",");
        //Organiza usando Arquivo Potencial de evazão como cabeça
        if (array_key_exists("", $ArraysDeDados[0])) {
            $_SESSION['ArrayDeDados'] = $ArraysDeDados;
        } else {
            $_SESSION['ArrayDeDados2'] = $ArraysDeDados;
        }
    }
    // Executarar apenas se existir um arquivo valido
    if ($arquivo2 != "") {
        $ArraysDeDados2 = csvtojson($arquivo2, ",");
        //Organiza usando Arquivo Potencial de evazão como cabeça
        if (array_key_exists("", $ArraysDeDados2[0])) {
            $_SESSION['ArrayDeDados'] = $ArraysDeDados2;
        } else {
            $_SESSION['ArrayDeDados2'] = $ArraysDeDados2;
        }
    }
    
    $ArrayDeAlunos = null;
   
    for ($a = 0; $a < count($_SESSION['ArrayDeDados']); $a++) {
        if($_SESSION['ArrayDeDados2'][0]["turma"] === $_SESSION['ArrayDeDados'][$a]["turma"]){
            $ArrayDeAlunos[$contador] = $_SESSION['ArrayDeDados'][$a];
            $contador++;
        }
    }
   $_SESSION['ArrayDeAlunos'] = $ArrayDeAlunos;
   $_SESSION['ArrayDeAlunosPesquisado'] = $ArrayDeAlunos;
    
   /*
      print "<pre>";
      print_r($_SESSION['ArrayDeAlunos']);
      //print_r($_SESSION['ArrayDeDados2']);
      print "</pre>";
    * 
    */

     


    unset($post['LerCsv'], $ArraysDeDados, $ArraysDeDados2, $a, $contador, $arquivo, $arquivo2, $erro_code,
          $nome, $nome2, $texto, $texto2, $extencao, $extencao2);
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
 * Excript lista todos cursos em contrado no csv

//Codigo vai ser DESCARTADO
if (isset($get['ListaCursos'])) {
    $ArraysDeDados = $_SESSION['ArrayDeDados'];
    $ArrayDeCursos = array();
    $contador = 0;

    for ($a = 0; $a < count($ArraysDeDados); $a++) {
        if ($ArrayDeCursos === array()) {
            $ArrayDeCursos[$contador] = $ArraysDeDados[$a]["turma"];
            $contador++;
        } elseif ($ArrayDeCursos[$contador - 1] !== $ArraysDeDados[$a]["turma"]) {
            $ArrayDeCursos[$contador] = $ArraysDeDados[$a]["turma"];
            $contador++;
        }
    }

    $_SESSION['ArrayDeCusos'] = $ArrayDeCursos;
    unset($get['ListaCursos'], $ArraysDeDados, $ArrayDeCursos, $contador, $a);
    exit(header("location:../Front_end/Lista_Curso.php"));
}
 */


/*
 * Excript retorna todos alunos do curso passado pelo get


if (isset($get['curso'])) {
    $nomeDoCurso = $get['curso'];
    $ArraysDeDados = $_SESSION['ArrayDeDados'];
    $ArrayDeAlunos = array();
    $contador = 0;

    for ($a = 0; $a < count($ArraysDeDados); $a++) {
        if ($nomeDoCurso === $ArraysDeDados[$a]['turma']) {
            $ArrayDeAlunos[$contador] = $ArraysDeDados[$a];
            $contador++;
        }
    }


    $_SESSION['ArrayDeAlunos'] = $ArrayDeAlunos;
    unset($get['curso'], $ArraysDeDados, $ArrayDeCursos, $contador, $a, $ArrayDeAlunos);
    exit(header("location:../Front_end/Lista_Curso.php?retorno"));
}
 */


if (isset($get['texte'])) {

    $f = base64_decode($get['alunos']);

    print "<pre>";
    print_r($f);
    print "</pre>";
}

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
    //Tratamento de erro ainda pra terminar
    /*
      if (!isset($_SESSION['ArrayDeDados2'])) {
      $erro =  base64_encode("faltaDeArquivo");
      exit(header("location:../Front_end/Inserir.php?Error='" .$erro."'"));
      } else {
      for ($a = 0; $a < count($_SESSION['ArrayDeDados2']); $a++) {
      if ($matricula === $_SESSION['ArrayDeDados2'][$a]['matricula']) {
      break;
      } elseif (count($_SESSION['ArrayDeDados2']) === ($a + 1)) {
      $erro = base64_encode("arquivoIncorreto");
      exit(header("location:../Front_end/Inserir.php?Error=" . $erro . ""));
      }
      }
      }
     * 
     */

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
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Média"] = ExisteParamNoArray("ArrayDeDados2", "M1", $c);
                        $ArrayDeAluno[$ArrayDeAlunos[$a]['matricula']]["Informações_do_Aluno"]["Informações_Disciplinares"][$contador]["Média_Final"] = ExisteParamNoArray("ArrayDeDados2", "MF", $c);
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
    print_r($matricula);
    print "</pre>";
    exit(header("location:../Front_end/Relatorio_Aluno.php"));
}