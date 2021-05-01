<?php
    // Mantener la sesión iniciada
    session_start();

    ini_set('memory_limit', '-1');

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Consulta del contenido de la web
    $consultaRuta = "SELECT * FROM RUTA";

    // Ejecutar la consulta y almacenar todos los datos
    if($resultado = $conexion->query($consultaRuta)) {
        $datos_json_ruta[]='';
        while ($datos = $resultado->fetch_assoc()) {
            $datos_json_ruta[] = $datos;
        }
    }

    // Codificar en formato json
    $json_ruta = json_encode($datos_json_ruta);
    // Imprimir los datos por pantalla
    echo $json_ruta;


    $consultaPais = "SELECT * FROM PAIS";

    // Ejecutar la consulta y almacenar todos los datos
    if($resultado = $conexion->query($consultaPais)) {
        $datos_json_pais[]='';
        while ($datos = $resultado->fetch_assoc()) {
            $datos_json_pais[] = $datos;
        }
    }

    // Codificar en formato json
    $json_pais = json_encode($datos_json_pais);
    // Imprimir los datos por pantalla
    echo $json_pais;


    $consultaImagen = "SELECT * FROM IMAGEN";

    // Ejecutar la consulta y almacenar todos los datos
    if($resultado = $conexion->query($consultaImagen)) {
        $datos_json_imagen[]='';
        while ($datos = $resultado->fetch_assoc()) {
            $datos_json_imagen[] = $datos;
        }
    }

    // Codificar en formato json
    $json_imagen = json_encode($datos_json_imagen);
    // Imprimir los datos por pantalla
    echo $json_imagen;

?>