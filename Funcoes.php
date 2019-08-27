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
/**
 * Retorna a quantidade das colunas das array
 */
function getQuantColunas($tabela) {
    //$tabela2 = $_SESSION[$tabela];
    for ($i = 0; $i < 1; $i++) {
        return count($tabela[$i]);
    }
}
/**
 * retorna a quantidade de linhas que existe em uma tabela
 */
function getQuantLinhasTabela($tabela) {
    return count($_SESSION[$tabela]);
}