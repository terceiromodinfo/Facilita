

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
    //alert(Math.trunc(document.getElementById(posicao + um + dois).innerHTML));
    var obj = document.getElementById(posicao + um + dois);
    if(document.getElementById(posicao + um + dois).innerHTML <= 0){
        document.getElementById(posicao + um + dois).innerHTML = null;
    }else if (Math.trunc(document.getElementById(posicao + um + dois).innerHTML) >= 7) {
        obj.style.color = "DodgerBlue";
    } else if ((Math.trunc(document.getElementById(posicao + um + dois).innerHTML) > 4) & (Math.trunc(document.getElementById(posicao + um + dois).innerHTML) < 7)) {;
        obj.style.color = "orangered";
    } else {
        obj.style.color = "Red";
    }
}
 