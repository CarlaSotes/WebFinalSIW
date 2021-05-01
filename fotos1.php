<?php
    // Mostrar errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // mantener sesión
    session_start();
    // obtener id de sesión
    $id = $_SESSION["id"];

    // Obtener el contenido de la plantilla
    $cadena = file_get_contents("plantillaFotos1.html");  

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    $trozos = explode("##filapais##", $cadena); 
    
    // Calcular el número de países que hay
    $consulta_paises = "SELECT pais FROM PAIS ORDER BY pais";
    // Ejecutar la consulta
    if($resultado = $conexion->query($consulta_paises)) {
        echo $trozos[0];
        
        $cuerpo ="";
        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[1]; 
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            $cuerpo = $cuerpo . $aux;
        }   
        echo $cuerpo;
        echo $trozos[2];
        
    }
   
?>