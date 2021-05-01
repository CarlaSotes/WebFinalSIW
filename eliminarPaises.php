<?php

    // Obtener el contenido de la plantilla
    $cadena = file_get_contents("plantillaEliminarPais.html");  

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Calcular el número de países que hay
    $consulta_paises = "SELECT pais FROM PAIS";

    // Ejecutar la consulta
    $contador = 0;
    $cuerpo = '';
    if($resultado = $conexion->query($consulta_paises)) {
        $trozos = explode("##filapais##", $cadena); 
        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[1]; 
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            $cuerpo = $cuerpo . $aux;
        }
    }
    // Imprimir el contenido
    echo $trozos[0]. $cuerpo. $trozos[2];
?>