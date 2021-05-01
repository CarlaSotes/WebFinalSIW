<?php
    // mantener sesión
    session_start();
    // obtener id de sesión
    $id = $_SESSION["id"];
    
    // Obtener el país
    $pais = $_GET["idpais"];

    // Obtener el contenido de la plantilla
    $cadena = file_get_contents("plantillaFotos2.html");  

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Realizar la consulta de países
    $consulta = "SELECT nombreItinerario, idItinerario FROM RUTA, PAIS WHERE RUTA.idPais=PAIS.idPais AND PAIS.pais = '$pais'";

    $cuerpo = "";
    if($resultado = $conexion->query($consulta)) {
        // Cortar el html por el comodín ##fila##
        $trozos = explode("##fila##", $cadena); 
        
        while ($datos = $resultado->fetch_assoc()) {
            // Sustituir la plantilla
            $aux = $trozos[1]; 
            $aux = str_replace("##idruta##", $datos["idItinerario"], $aux);
			$aux = str_replace("##ruta##", $datos["nombreItinerario"], $aux);
            $cuerpo = $cuerpo . $aux;
        }
    }
    // Imprimir el contenido
    echo $trozos[0]. $cuerpo. $trozos[2];
    
?>