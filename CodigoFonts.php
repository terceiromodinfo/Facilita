<?php
include './loading.php';
include './Funcoes.php';
//Função atibuida e uma variavel para o uso do metodo POST e GET
$post = post();
$get = get();


/*
 * codigo que pega as informaçoes do arquivo .csv, faz a conversão 
 * para JSON, depois para Array
 */
if (isset($post['LerCsv'])) {
    /*
     * Função conversão para json
     */
    function csvtojson($file, $delimiter) {
        
        if (($handle = fopen($file, "r")) === false) {
            die("can't open the file.");
        }

        $csv_headers = fgetcsv($handle, 4000, $delimiter);
        $csv_json = array();
        
        while ($row = fgetcsv($handle, 4000, $delimiter)) {
            $csv_json[] = array_combine($csv_headers, $row);
        }
        
        fclose($handle);
        return $csv_json;
        //return json_encode($csv_json);
    }
    /*
     * Recebe os valores do formulario e passa para função,
     * que converte para json
     */

    $arquivo = $_FILES["file"]["tmp_name"];
    $nome = $_FILES["file"]["name"];

    $ArraysDeDados = csvtojson($arquivo, ",");
    //print_r($jsonresult);
    // Converte de json para um array 
    
    //$ArraysDeDados = json_decode($jsonresult, true);
    
    //Passa os dados para uma variavel global
    
    $_SESSION['ArrayDeDados'] = $ArraysDeDados;
    
    unset($post['LerCsv']);
    header("location:ModoDePesquisa.php");
}
/*
 * Script retorna um Aluno que será exibido no relatorio
 */
if (isset($post['pesquisaMatricula'])) {
    $matricula = $post['nomeDaMatricula'];
    
    $Arrays = $_SESSION['ArrayDeDados'];
    $n = array_search($matricula, array_column($Arrays, 'matricula'));
    
    if ($n === false) {

    }  else {
        $_SESSION['ResultadoDeUsuario'] = $Arrays[$n];
    }
    
    unset($post['pesquisaMatricula']);            
    header("location:RelatorioDeUsuario.php");
    /*
    for ($a = 0; $a < getQuantLinhasTabela("ArrayDeDados"); $a++) {
        if ($matricula === $Arrays[$a]["matricula"]) {
            //Variavel global para saber se o usuario existe
            $_SESSION['TRUE_FALSE'] = "true";
            //Variavel global para passar os dados do usuario
            $_SESSION['ResultadoDeUsuario'] = $Arrays[$a];
            unset($post['pesquisaMatricula']);            
            header("location:RelatorioDeUsuario.php");
            break;
        }elseif ((getQuantLinhasTabela("ArrayDeDados")-1) == $a) {
            $_SESSION['TRUE_FALSE'] = "false";
            unset($post['pesquisaMatricula']);
            header("location:RelatorioDeUsuario.php");
        }
    }
     * 
     */
    
}
/*
 * Script retorna todos cursos existentes 
 */
if (isset($post['curso'])) {
    $Arrays = $_SESSION['ArrayDeDados'];
    $ArraysDeCurso = [];
    $repitido = FALSE;
    $contador = 0;
    for ($b = 0; $b < getQuantLinhasTabela("ArrayDeDados"); $b++) {
        
        for ($c = 0; $c < count($ArraysDeCurso); $c++) {
            if ($ArraysDeCurso[$c] === $Arrays[$b]['curso']) {
                $repitido = TRUE;
                break;                           
            }  else {
                $repitido = FALSE;
            }
        }
        if (($ArraysDeCurso == []) || ($repitido == FALSE)) {
            $ArraysDeCurso[$contador] = $Arrays[$b]['curso'];
            $contador++;
        }
        
    }
    // Variavel global para passar somente nome dos cursos ETC.
    $_SESSION['ArrayDeCursos'] = $ArraysDeCurso;
    //Variavel global para saber qual lista devve ser exibida na pagina web
    $_SESSION['ModoDeListaDePesquisa'] = "Curso";
    unset($post['curso']);
    header("location:ListaModoDePesquisa.php");
}

/*
 * Script retorna todos alunos do curso expecificado
 */
if (isset($get['nomeCurso'])) {
    $Arrays = $_SESSION['ArrayDeDados'];
    $nomeCurso = $get['nomeCurso'];
    $ArraysDeUsuario = [];
    $contador1 = 0;
    for ($d = 0; $d < getQuantLinhasTabela("ArrayDeDados"); $d++) {
        if ($Arrays[$d]["curso"] === $nomeCurso) {
            $ArraysDeUsuario[$contador1] = $Arrays[$d];
            $contador1++;
        }
    }
    $_SESSION['ArrayDeUsuario'] = $ArraysDeUsuario;
    $_SESSION['ModoDeListaDePesquisa'] = "Usuario";
    unset($get['nomeCurso']);
    header("location:ListaModoDePesquisa.php");
}
/*
if (isset($get['nomeUsuario'])) {
    $Arrays = $_SESSION['ArrayDeDados'];
    $matriculaDeUsuario = $get['nomeUsuario'];
    
    for ($e = 0; $e < getQuantLinhasTabela("ArrayDeDados"); $e++) {
        if ($Arrays[$e]["matricula"] === $matriculaDeUsuario) {
            $_SESSION['ResultadoDeUsuario'] = $Arrays[$e];
            header("location:RelatorioDeUsuario.php");
            break;
        }
    }
    
}
 * 
 */

/*
 * Limpa todos dados existente na variavel global $_SESSION['ResultadoDeUsuario']
 */
if (isset($get['sair'])) {
    $_SESSION['TRUE_FALSE'] = NULL;
    $_SESSION['ResultadoDeUsuario'] = NULL;  
    unset($get['sair']);
    header("location:ModoDePesquisa.php");
}


//print$obj[0]["matricula"];
?>
