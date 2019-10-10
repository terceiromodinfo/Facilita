

function mudaEstilo(arrays, arrays2) {
    ;

    for (var a = 0; a < arrays2; a++) {
        for (var i = 0; i < arrays; i++) {
            var um = i.toString();
            var dois = a.toString();
            
            estilizando(um, dois, "b1");
            estilizando(um, dois, "r1");
            estilizando(um, dois, "m1");
            estilizando(um, dois, "b2");
            estilizando(um, dois, "r2");
            estilizando(um, dois, "m2");
            estilizando(um, dois, "b3");
            estilizando(um, dois, "r3");
            estilizando(um, dois, "m3");
            estilizando(um, dois, "b4");
            estilizando(um, dois, "r4");
            estilizando(um, dois, "m4");
            estilizando(um, dois, "pf");
            estilizando(um, dois, "mf");

        }
    }

}

function estilizando(um, dois, posicao) {
    var obj = document.getElementById(posicao + um + dois);

    if (document.getElementById(posicao + um + dois).innerHTML <= 4) {
        obj.style.color = "Red";
    } else if (document.getElementById(posicao + um + dois).innerHTML > 4 && document.getElementById("notas").innerHTML < 7) {
        obj.style.color = "OrangeRed";
    } else {
        obj.style.color = "DodgerBlue";
    }
}
 