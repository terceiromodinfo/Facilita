

function mudaEstilo(arrays, arrays2) {
    for (var a = 0; a < arrays2; a++) {
        for (var i = 0; i < arrays; i++) {
            var um = i.toString();
            var dois = a.toString();
            
            var obj = document.getElementById(um + dois);
            
            if (document.getElementById(um + dois).innerHTML <= 4) {
                obj.style.color = "Red";
            } else if (document.getElementById(um + dois).innerHTML > 4 && document.getElementById("notas").innerHTML < 7) {
                obj.style.color = "OrangeRed";
            } else {
                obj.style.color = "DodgerBlue";
            }

            var obj = document.getElementById("f" + um + dois);

            if (document.getElementById("f" + um + dois).innerHTML <= 4) {
                obj.style.color = "Red";
            } else if (document.getElementById("f" + um + dois).innerHTML > 4 && document.getElementById("notas").innerHTML < 7) {
                obj.style.color = "OrangeRed";
            } else {
                obj.style.color = "DodgerBlue";
            }
            
            
        }
    }

    /*
     
     
     var media_final = document.getElementById("media_final").innerHTML;
     * 
     */


}
 