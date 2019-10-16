// Importando jquery no script
/*
var imported = document.createElement('script');
imported.src = '../jquery/jquery.js';
document.head.appendChild(imported);
*/

/*
 * função que rodarar uma imagem gif, com significado de mostrar ao usuario
 * que está carregando algo e logo será exibido.
 * O parametro classS passado deve ser o nome do id da teg que deverar sesaparecer
 * para que a imagem á substitua na tela.
 */

function carregando(classS) {
    $.ajax({
        
        beforeSend: function () {
            $("#" + classS).addClass('Invisivel');
            $("#resultado").html("<img src='img/preloader.gif'>");
        },
    });
}

/*
 * Formulario com ajax
 */

function buscarPorMatricula(matricula)
{
    var page = "../Back-end/Excript_Principal.php";

    $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,                
                beforeSend: function () {
                    $("#Pr").addClass('Invisivel');
                    $("#resultado").html("<img src='img/preloader.gif'>");
                },
                data: {matricula: matricula},                
                success: function (msg)
                {
                    $("#Pr").removeClass('Invisivel');
                    $("#resultado").html(msg);
                }
            });
}
$('#buscar2').click(function () {
    buscarPorMatricula($("#matricula").val())
});

