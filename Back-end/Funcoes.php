<?php
session_start();

/**
 * Funcão para usar o metodo post
 */
function post() {
    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    return $post;
}

/**
 * Funcão para usar o metodo get
 */
function get() {
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    return $get;
}

/*
 * Função conversão de CSV para Array
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
}

/*
 * Retorna o nome do curso completo
 */

function getNomeCurso($param) {
    switch ($param) {
        case "Integrado em MIN - 2019.1":
            $nomecurso = "Mineração";
            break;
        case "Integrado em AGRO - 2019.1":
            $nomecurso = "Agropecuária";
            break;
        case "Integrado em ADM - 2019.1":
            $nomecurso = "Administração";
            break;
    }
    return $nomecurso;
}

function superLinkGet($destino, $variavelGet, $arquivo, $parametroLoading, $palavraExibida, $class) {
    ?>
    <a <?php print 'href="' . $destino . '?' . $variavelGet . '=' . $arquivo . ' "' ?> onclick="carregando('Ps')" class="<?php print $class ?>"><?php print $palavraExibida; ?></a><br>
    <?php
}

function arrayAluno() {
    return $array = array(
        "Informações_do_Aluno" => array(
            "Nome" => "",
            "Turma" => "",
            "Idade" => "",
            "Cidade" => "",
            "Repetente" => "",
            "Aprov_No_Conselho" => "",
            "Atleta" => "",
            "Recebe_Auxilio" => "",
            "CQ" => "",
            "PE" => "",
            "SD" => "",
            "EC" => ""
        ),
        "Informações_Disciplinares" => array(
            0 => array(
                "Disciplina" => "",
                "Média" => "",
                "Média_Final" => "",
                "Professor" => ""
            )
        ),
        "Progresso_Geral" => array(
            "Porcentagem_de_Recuperações" => "",
            "Disciplina_em_Recuperações" => "",
            "Disciplina_Total" => "",
            "Porcentagem_Recuperada" => "",
            "Disciplina_Recuperada" => ""
        ),
        "Progresso_Base_Comum" => array(
            "Porcentagem_de_Recuperações" => "",
            "Disciplina_em_Recuperações" => "",
            "Disciplina_Total" => "",
            "Porcentagem_Recuperada" => "",
            "Disciplina_Recuperada" => ""
        ),
        "Progresso_Técnico" => array(
            "Porcentagem_de_Recuperações" => "",
            "Disciplina_em_Recuperações" => "",
            "Disciplina_Total" => "",
            "Porcentagem_Recuperada" => "",
            "Disciplina_Recuperada" => ""
        ),
        "Se_o_Ano_Acabasse_Hoje" => array(
            "Disciplina_em_Prova_Final" => "",
            "Disciplina_Reprovadas" => "",
            "Disciplinas_Aprovadas" => ""
        )
    );
}
function ExisteParamNoArray($variavelGlobal, $valor, $numeros) {
    if(isset($_SESSION[$variavelGlobal][$numeros][$valor])){
        if ($_SESSION[$variavelGlobal][$numeros][$valor] === " "){
            return "--";
        } else {
            return $_SESSION[$variavelGlobal][$numeros][$valor];
        }
        
    } else {
        return "--";
    }
}

function organizaDados($array) {
   end($array[0]);
   switch (key($array[0])) {
       case "Pe": $_SESSION['ArrayDeDados'] = $array;
           break;
       case "ativo": $_SESSION['ArrayDeDados2'] = $array;
           break;
       case "extra_classe_id": $_SESSION['ArrayDeDados3'] = $array;
           break;
       case "tipo_advertencia": $_SESSION['ArrayDeDados4'] = $array;
           break;
       
   }
}

function getSD($matricula) {
    $Indiciplina = $_SESSION['ArrayDeDados4'];
    $quantidade = 0;
    for ($a = 0; $a < count($Indiciplina); $a++) {
        if($Indiciplina[$a]["matricula"] === $matricula){
            $quantidade++;
        }
    }
    return $quantidade;
}

function getEC($matricula) {
    $ExtraClass = $_SESSION['ArrayDeDados3'];
    $quantidade = 0;
    for ($a = 0; $a < count($ExtraClass); $a++) {
        if($ExtraClass[$a]["matricula"] === $matricula){
            $quantidade++;
        }
    }
    return $quantidade;
}