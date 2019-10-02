<?php
include './Funcoes.php';
/*
 * Excript de exibição de uma lista cursos
 */
/*
$gravi = array(
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
        "Disciplina" => "",
        "Média" => "",
        "Média_Final" => "",
        "Professor" => ""
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
        "[Disciplina_Recuperada]" => ""
    ),
    "Se_o_Ano_Acabasse_Hoje" => array(
        "Disciplina_em_Prova_Final" => "",
        "Disciplina_Reprovadas" => "",
        "Disciplinas_Aprovadas" => ""
    )
);
 * 
 */


$gravi = arrayAluno();


print "<pre>";
print_r($_SESSION['ArrayDeDados2']);

//print_r($gravi);
print "</pre>";
