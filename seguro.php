<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <script>
            function limpiar_aparcamiento(){
                
                location.href = "limpiar.php";
                
            }
            function volver(){
                
                location.href = "index.php";
                
            }
        </script>
        <style>
            html { height: 100% }
            body { height: 100%; margin: 0; padding: 0; text-align: center;
                    background: rgb(206,220,231); /* Old browsers */
                    background: -moz-linear-gradient(-45deg, rgba(206,220,231,1) 0%, rgba(89,106,114,1) 100%); /* FF3.6+ */
                    background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(206,220,231,1)), color-stop(100%,rgba(89,106,114,1))); /* Chrome,Safari4+ */
                    background: -webkit-linear-gradient(-45deg, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* Chrome10+,Safari5.1+ */
                    background: -o-linear-gradient(-45deg, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* Opera 11.10+ */
                    background: -ms-linear-gradient(-45deg, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* IE10+ */
                    background: linear-gradient(135deg, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* W3C */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cedce7', endColorstr='#596a72',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
            }
            #titulo{
                
                height: 20%;
                width: 100%;
                
            }
            #texto{
                
                height: 20%;
                width: 100%;
                
            }
            #controles{
                
                height: 60%;
                width: 100%;
                
            }
            p{
                
                font-size: 58px;
                color: whitesmoke;
                text-shadow: 5px 5px 5px black;
            }
            button{
                
                width: 40%;
                height: 30%;
                border-radius: 25px;
                font-size: 50px;
                box-shadow: 5px 5px 5px black;
                background: rgb(238,238,238); /* Old browsers */
                background: -moz-linear-gradient(45deg, rgba(238,238,238,1) 0%, rgba(204,204,204,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,rgba(238,238,238,1)), color-stop(100%,rgba(204,204,204,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(45deg, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(45deg, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(45deg, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* IE10+ */
                background: linear-gradient(45deg, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
            }
            h1{text-align: center; font-size: 14 px; color: whitesmoke; margin-top: 5%; font-family: Courier New;}
            
            
        </style>
    </head>
    <body>
        <div id="titulo"><h1>Localizador de parking</h1></div>
        <div id="texto"><p>Seguro?</p></div>
        <div id="controles">
            <button onclick="limpiar_aparcamiento()">SI</button>
            <button onclick="volver()">NO</button>
        </div>
        
    </body>
</html>
