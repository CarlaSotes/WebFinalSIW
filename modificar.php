<?php
    // mantener sesión
    session_start();
    // obtener id de sesión
    $id = $_SESSION["id"];

    $pais = $_GET["idpais"];
    $ruta = $_GET["rutas"];

    // Obtener el contenido de la plantilla
    $cadena = file_get_contents("rutas2.html");  

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Realizar la consulta de países
    $consulta = "SELECT * FROM RUTA WHERE nombrePais='$pais' AND idItinerario='$ruta'";

    $cuerpo = "";
    if($resultado = $conexion->query($consulta)) {
        $trozos = explode("##fila##", $cadena); 
        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[1];
            $aux = str_replace("##pais##", $datos["nombrePais"], $aux);
            $aux = str_replace("##nombre##", $datos["nombreItinerario"], $aux);
            $aux = str_replace("##contenido##", $datos["contenido"], $aux);
            $cuerpo = $cuerpo . $aux;
        }
    }

    // Imprimir el contenido
    echo $trozos[0]. $cuerpo. $trozos[2];
?>