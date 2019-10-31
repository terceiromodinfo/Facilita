<?php
session_start();

/**
 * Função para usar o método post
 */

function post() {
    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    return $post;
}

/**
 * Função para usar o método get
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

/*
 * Exibe um botão que contem informações muito complexas, mas serve para deixar o código mais agradável
 */

function superLinkGet($destino, $variavelGet, $arquivo, $parametroLoading, $palavraExibida, $class) {
    ?>
    <a <?php print 'href="' . $destino . '?' . $variavelGet . '=' . $arquivo . ' "' ?> onclick="carregando('Ps')" class="<?php print $class ?>"><?php print $palavraExibida; ?></a><br>
    <?php
}

/*
 * Retorna a arquitetura do Array do relatório final. Não tem funcionalidade no código
 * apenas serve para o programador ter uma ideia do desenho da arquitetura do array que recebe os dados 
 */

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
            0 => array(
                "Porcentagem_de_Recuperações" => "",
                "Disciplina_em_Recuperações" => "",
                "Disciplina_Total" => "",
                "Porcentagem_Recuperada" => "",
                "Disciplina_Recuperada" => ""
            )
        ),
        "Se_o_Ano_Acabasse_Hoje" => array(
            "Disciplina_em_Prova_Final" => "",
            "Disciplina_Reprovadas" => "",
            "Disciplinas_Aprovadas" => ""
        )
    );
}

/*
 * Verifica a existencia do parametro na variavel global
 */

function ExisteParamNoArray($variavelGlobal, $valor, $numeros) {

    if (isset($_SESSION[$variavelGlobal][$numeros][$valor])) {

        if ($_SESSION[$variavelGlobal][$numeros][$valor] === "") {
            return "--";
        } else {
            return $_SESSION[$variavelGlobal][$numeros][$valor];
        }
    } else {
        return "--";
    }
}
/*
 * Organiza os dados na variável global correta para ser usada nos códigos
 */

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

/*
 * Retorna quantidade de advertências que a matricula passada tem
 */

function getSD($matricula) {
    $Indiciplina = $_SESSION['ArrayDeDados4'];
    $quantidade = 0;
    for ($a = 0; $a < count($Indiciplina); $a++) {
        if ($Indiciplina[$a]["matricula"] === $matricula) {
            $quantidade++;
        }
    }
    return $quantidade;
}

/*
 * Retorna quantidade de extra class que a matricula passada tem
 */


function getEC($matricula) {
    $ExtraClass = $_SESSION['ArrayDeDados3'];
    $quantidade = 0;
    for ($a = 0; $a < count($ExtraClass); $a++) {
        if ($ExtraClass[$a]["matricula"] === $matricula) {
            $quantidade++;
        }
    }
    return $quantidade;
}

/*
 * retorna um array com todas as informações do progresso do aluno
 */

function getProgressoGeral($info) {
    $resultDeInfo = array();
    $chaves = array(0 => "Bimestre_1", 1 => "Bimestre_2", 2 => "Bimestre_3", 3 => "Bimestre_4");
    $chaves2 = array(0 => "Media_1", 1 => "Media_2", 2 => "Media_3", 3 => "Media_4");

    for ($a = 0; $a < 4; $a++) {
        $dicEmRecupe = 0;
        $dicRecupe = 0;
        for ($b = 0; $b < count($info); $b++) {
            $convertido = (double) $info[$b][$chaves[$a]];
            if (($convertido != 0) && $convertido < 7) {
                //Aqui trabalharemos o código de informações do Progresso Geral
                $dicEmRecupe = $dicEmRecupe + 1;
                $convertido2 = (double) $info[$b][$chaves2[$a]];
                if ($convertido2 >= 7) {
                    $dicRecupe = $dicRecupe + 1;
                }

                $resultDeInfo[$a]["Disciplina_Total"] = count($info);
                $resultDeInfo[$a]["Disciplina_em_Recuperações"] = $dicEmRecupe;
                $resultDeInfo[$a]["Disciplina_Recuperada"] = $dicRecupe;
                $resultDeInfo[$a]["Porcentagem_de_Recuperações"] = (($resultDeInfo[$a]["Disciplina_Total"] - $resultDeInfo[$a]["Disciplina_em_Recuperações"]) * 100 / $resultDeInfo[$a]["Disciplina_Total"]) - 100;
                $resultDeInfo[$a]["Porcentagem_Recuperada"] = (($resultDeInfo[$a]["Disciplina_em_Recuperações"] - $resultDeInfo[$a]["Disciplina_Recuperada"]) * 100 / $resultDeInfo[$a]["Disciplina_em_Recuperações"]) - 100;
                ;
            }
        }
    }
    return $resultDeInfo;
}

/*
 * Retorna um array com as informações do alunos se o ano acaba-se hoje
 */

function getFimAnoAgora($info) {
    $resultDeInfo = array();
    $resultDeInfoFinal["Aprovado"] = 0;
    $resultDeInfoFinal["Pro_Final"] = 0;
    $resultDeInfoFinal["Reprovado"] = 0;
    $chaves2 = array(0 => "Media_1", 1 => "Media_2", 2 => "Media_3", 3 => "Media_4");
    $media = 0;
    $quantMedia = 0;
    //Roda quantidade de vez do total de diciplina
    for ($a = 0; $a < count($info); $a++) {
        //Roda total de notas na media
        for ($b = 0; $b < count($chaves2); $b++) {
            //Entra se existir uma media
            if ($info[$a][$chaves2[$b]] != 0) {
                $media = $media + $info[$a][$chaves2[$b]];
                $quantMedia = $quantMedia + 1;
            }
        }
       //Entrega o resultado para ser avaliado para próximo código
        $resultDeInfo[$a]["media_somada"] = $media;
        $resultDeInfo[$a]["quantidade_media"] = $quantMedia;
        $resultDeInfo[$a]["id_diciplina"] = $info[$a]["Id_diciplina"];

        $media = 0;
        $quantMedia = 0;
    }
    //Monta o resultado
    for ($c = 0; $c < count($resultDeInfo); $c++) {
        $result = ($resultDeInfo[$c]["media_somada"] / $resultDeInfo[$c]["quantidade_media"]);
        if ($result >= 7) {
            $resultDeInfoFinal["Aprovado"] = $resultDeInfoFinal["Aprovado"] + 1;
        } elseif ($result < 7 && $result > 4) {
            $resultDeInfoFinal["Pro_Final"] = $resultDeInfoFinal["Pro_Final"] + 1;
        } else {
            $resultDeInfoFinal["Reprovado"] = $resultDeInfoFinal["Reprovado"] + 1;
        }
    }
    return $resultDeInfoFinal;
}
