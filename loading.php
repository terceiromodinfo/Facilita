
        <style>
            .load {
            width: 100px;
            height: 100px;
            position: absolute;
            top: 30%;
            left: 45%;
            color: blue;
            }
        </style>
    
        <div class="load"><img src="img/preloader.gif"></div>
        
        <script>
    //código usando DOM (JS Puro)
    document.addEventListener("DOMContentLoaded", function(event) { 
    var estilo = document.getElementsByClassName('load');
    estilo[0].style.visibility = "hidden";
    });
        </script>
   
