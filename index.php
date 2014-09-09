<?php
$lat = 0;
$lng = 0;

try {
    
    include 'conexion.php';
    
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

    $result = mysqli_query($con,"SELECT lat,lng FROM posicion WHERE id=1");

    $fila = mysqli_fetch_row($result);

    $lat = $fila[0];
    $lng = $fila[1];

    mysqli_close($con);
    
} catch (Exception $ex) {
    
    echo "Error accedint a la Base de Dades.";
    
}

?>
<!DOCTYPE html>
<!--
Aplicación: Localizador de aparcamiento.
Autor: Moisés Aguilar
Fecha: 11 de Noviembre de 2013
Comentarios: Aplicación para recordar donde hemos aparcado nuestro vehículo.
-->
<html>
    <head>
        <title>Aparcamiento</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCQt49pKh4iZvkowhRNHLXCXV5n8TaTPw0&sensor=true"></script>
        
        <style type="text/css">
            html { height: 100% }
            body { height: 100%; margin: 0; padding: 0; 
                   background: rgb(206,220,231); /* Old browsers */
                   background: -moz-linear-gradient(-45deg, rgba(206,220,231,1) 0%, rgba(89,106,114,1) 100%); /* FF3.6+ */
                   background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(206,220,231,1)), color-stop(100%,rgba(89,106,114,1))); /* Chrome,Safari4+ */
                   background: -webkit-linear-gradient(-45deg, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* Chrome10+,Safari5.1+ */
                   background: -o-linear-gradient(-45deg, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* Opera 11.10+ */
                   background: -ms-linear-gradient(-45deg, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* IE10+ */
                   background: linear-gradient(135deg, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* W3C */
                   filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cedce7', endColorstr='#596a72',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
            }
            #map_canvas { width: 100%; height: 90%; margin: 0; padding: 0}
            #controles { width: 100%; height: 10%; text-align: left; margin: 0; padding: 0;}
            button{width: 40%; height: 100%; font-size: 12px; float: left; font-family: Courier New;}
            h1{text-align: center; font-size: 14 px; color: whitesmoke; margin-top: 30%; font-family: Courier New;}
            h2{text-align: center; font-size: 16px; color: whitesmoke; font-family: Courier New; margin-top: 15%;}
            #distancia_aparcamiento{width: 20%; height: 100%; float: left;}
            img{display: block; margin: auto; vertical-align: middle;}
        </style>
    </head>
    <body>
        <!--<embed id="sonido" hidden="true" src="sounds/beep2.mp3" autostart="true" loop="true">-->
        <div id="map_canvas"><h1>Localizador de parking</h1></div>
        <div id="controles">
            <button onclick="aparcar(LAT,LNG)">Aparcar</button>
            <!--<button onclick="actualizar_posicion()">Actualizar posición</button>-->
            <div id="distancia_aparcamiento"></div>
            <button onclick="limpiar_aparcamiento()">Limpiar aparcamiento</button>
        </div>
    </body>
</html>
<script type="text/javascript">
        function ChangeLoop () {
            var embed = document.getElementById ("sonido");

            if ('loop' in embed) {
                embed.loop = true;
            } else {
                //alert ("Your browser doesn't support this example!");
            }
        }
        
        setInterval(ChangeLoop,1000);
        
</script>
        <script type="text/javascript">
            //Variables Globales Lat Lng
            var MyLatLngGM;
            var MyLatLng;
            var LAT;
            var LNG;
            var LAT_V = <?php echo $lat ?>;
            var LNG_V = <?php echo $lng ?>;
            
            function FRecargar(){
                
                location.href = 'index.php';
                
            }
            
            function showMap(position) {
            // Show a map centered at (position.coords.latitude, position.coords.longitude).
                //document.write("lat: "+position.coords.latitude+" , lng: "+position.coords.longitude);
                MyLatLng=position.coords.latitude+","+position.coords.longitude;
                LAT=position.coords.latitude;
                LNG=position.coords.longitude;
                
                initialize(LAT,LNG);
                
                //alert(LAT+","+LNG);
                
            }
            
            // One-shot position request.
            navigator.geolocation.getCurrentPosition(showMap);
            
            // Request repeated updates.
            //watchId = navigator.geolocation.watchPosition(actualizar_marcador);
            
            //initialize(LAT,LNG);
            
            
            
        
        </script>
<script type="text/javascript">
    
            function deg2rad(deg){
                return deg * (Math.PI/180)
            }
            //Calculo de la distáncia entre dos coordenadas.
            function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2){
                var R = 6371; // Radius of the earth in km
                var dLat = deg2rad(lat2-lat1);  // deg2rad below
                var dLon = deg2rad(lon2-lon1); 
                var a = 
                    Math.sin(dLat/2) * Math.sin(dLat/2) +
                    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
                    Math.sin(dLon/2) * Math.sin(dLon/2)
                    ; 
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
                var d = R * c; // Distance in km
                return d;
            }
            
            //declaras marker como global y la inicializas en el primer proceso o de manera global por igual 
            //puede ser un objeto LatLng o lat y lng por separado
            function actualizar_marcador(position){
                // Leer coordenadas desde archivo 
                alert('entra');
                MyLatLng=position.coords.latitude+","+position.coords.longitude;
                LAT=position.coords.latitude;
                LNG=position.coords.longitude;
                
                var newLatlng = new google.maps.LatLng(LAT, LNG);
                marker_persona.setPosition(newLatlng);
                marker_persona.setMap(map);
                map.setCenter(newLatlng);
                
                
                
            }
            
            function initialize(LAT,LNG) {
                
                    //Estilo de Mapa
                    var styles = [
                        {
                          featureType: "all",
                          stylers: [
                            { saturation: -80 }
                          ]
                        },{
                          featureType: "road.arterial",
                          elementType: "geometry",
                          stylers: [
                            { hue: "#00ffee" },
                            { saturation: 50 }
                          ]
                        },{
                          featureType: "poi.business",
                          elementType: "labels",
                          stylers: [
                            { visibility: "off" }
                          ]
                        }
                      ];
                
                    var myLatlng = new google.maps.LatLng(LAT,LNG);
                    
                     // Create a new StyledMapType object, passing it the array of styles,
                    // as well as the name to be displayed on the map type control.
                    var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
                    
                    var mapOptions = {
                      zoom: 15,
                      center: myLatlng,
                      mapTypeControl: true,
                      mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DEFAULT},
                      zoomControl: true,
                      zoomControlOptions: {style: google.maps.ZoomControlStyle.LARGE},
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    
                    
                    
                    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
                    
                    //Associate the styled map with the MapTypeId and set it to display.
                    map.mapTypes.set('map_style', styledMap);
                    map.setMapTypeId('map_style');

                    //Iconos
                    persona = 'icons/persona.png';
                    vehiculo = 'icons/vehiculo.png';

                    marker_persona = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title:"Persona",
                        icon: persona
                    });
                    
                    var myLatlng2 = new google.maps.LatLng(LAT_V,LNG_V);
                    
                    marker_vehiculo = new google.maps.Marker({
                        position: myLatlng2,
                        map: map,
                        title:"Vehiculo",
                        icon: vehiculo
                    });
                    
                    // Request repeated updates.
                    //watchId = navigator.geolocation.watchPosition(actualizar_marcador);
                    
                    obtener_coordenadas();
                    
           }
            
            function obtener_coordenadas(){                
                
                setInterval(function(){
                    
                    // One-shot position request.
                    navigator.geolocation.getCurrentPosition(function(position){
                        
                        MyLatLng=position.coords.latitude+","+position.coords.longitude;
                        LAT=position.coords.latitude;
                        LNG=position.coords.longitude;

                        var newLatlng = new google.maps.LatLng(LAT, LNG);
                        marker_persona.setPosition(newLatlng);
                        marker_persona.setMap(map);
                        map.setCenter(newLatlng);

                        if((LAT_V!=0)&&(LNG_V!=0)){
                            //Calculamos la distancia entre el usuario y el vehiculo.
                            document.getElementById("distancia_aparcamiento").innerHTML = "<h2>" + (Math.round(getDistanceFromLatLonInKm(LAT,LNG,LAT_V,LNG_V) * 100) / 100) + "<br>Km</h2>";
                            //document.getElementById("distancia_aparcamiento").innerHTML = "<p>Distancia del coche: Km</p>";
                        }else{
                            document.getElementById("distancia_aparcamiento").innerHTML = "<img src='icons/vehiculo.png'>";
                        }
                        
                        
                    });
                    
                },5000);
                
            }
    
            
        </script>
        <script>
            
            function aparcar(LAT,LNG){
                
                location.href = "aparcar.php?lat="+LAT+"&lng="+LNG;
                
            }
            function limpiar_aparcamiento(){
                
                location.href = "seguro.php";
                
            }
            function actualizar_posicion(){
                
                //location.href = "index.php";
                actualizar_marcador();
                
            }
        
        </script>
