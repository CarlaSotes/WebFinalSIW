<?php
    // Mostrar errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Obtener contenido html
    $cadena = file_get_contents("main.html");
    
    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Crear sentencia sql
    $consultaEuropa = "select pais from PAIS where continente='EUROPA'";
    $consultaAmerica = "select pais from PAIS where continente='AMERICA'";
    $consultaAsia = "select pais from PAIS where continente='ASIA'";
    $consultaAfrica = "select pais from PAIS where continente='ÁFRICA'";
    $consultaOceania = "select pais from PAIS where continente='OCEANÍA'";
    
    // Europa
    if($resultado = $conexion->query($consultaEuropa)) { 
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);

        $cuerpo = ""; 
        $aux = "";
    
        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[1];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo .= $aux;
        }
    }

    // America
    if($resultado = $conexion->query($consultaAmerica)) { 
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);

        $cuerpo2 = ""; 
        $aux = "";
    
        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[3];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo2 .= $aux;
        }
    }


    // Asia
    if($resultado = $conexion->query($consultaAsia)) { 
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);

        $cuerpo3 = ""; 
        $aux = "";
    
        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[5];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo3 .= $aux;
        }
    }

    if($resultado = $conexion->query($consultaAfrica)) { 
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);

        $cuerpo4 = ""; 
        $aux = "";
    
        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[7];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo4 .= $aux;
        }
    }

    // Oceania
    if($resultado = $conexion->query($consultaOceania)) { 
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);

        $cuerpo5 = ""; 
        $aux = "";
    
        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[9];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo5 .= $aux;
        }
    }

    // Mostrar todo
    echo $trozos[0] . $cuerpo . $trozos[2] . $cuerpo2 . $trozos[4] . $cuerpo3 . $trozos[6] . $cuerpo4 . $trozos[8] . $cuerpo5. $trozos[10];

?>