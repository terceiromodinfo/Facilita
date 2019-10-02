<?php

if (isset($_SESSION['ArrayDeAlunosPesquisado'])) {
    
} else {
    include '../Back-end/Funcoes.php';
}

if (count($_SESSION['ArrayDeAlunosPesquisado']) > 1) {
    print "<br><br><br>";
    superLinkGet("../Back-end/Excript_Principal.php", "alunos", base64_encode("todos"), "Ps", "Gerar todos", "btn btn-default btn-lg btn-block");
    print "<br>";
}


for ($a = 0; $a < count($_SESSION['ArrayDeAlunosPesquisado']); $a++) {
    if ($_SESSION['ArrayDeAlunosPesquisado'][0] !== "Matricula é invalida") {
        superLinkGet("../Back-end/Excript_Principal.php", "alunos", base64_encode($_SESSION['ArrayDeAlunosPesquisado'][$a]['matricula']), "Ps", $_SESSION['ArrayDeAlunosPesquisado'][$a]['aluno'], "btn btn-lg btn-block");
    } else {
        print "<label>Matricula é invalida</label>";
    }
}

            
        
      