<?php
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // Iniciar sesión para acceder a las variables de sesión
    session_start();
    // Obtener el itinerario al que van a pertenecer las fotos
    $itinerario = $_SESSION['ruta'];

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    $f = fopen('log.txt','a');
    fputs($f,"hola\n");
    fputs($f,"$itinerario\n");

    // Comprobar si el directorio donde vamos a guardar las imágenes, existe, si no, se crea
    if(!file_exists('im/')){
        mkdir('im/', 0777, false);
    }
    fputs($f,"hola2\n");

    // Obtener los datos del fichero
    $ficherotmp = $_FILES['file']['tmp_name'];              // ej --> /opt/lampp/temp/phpgXzgAS
    $nombreArchivo = $_FILES['file']['name'];               // ej --> pollojoe.jpg                

    // Sacar el nombre base del archivo. Devuelve: nombre.extension
    $ruta = "im/";

    // Realizar la consulta para cambiar de nombre
    $consultaid = "SELECT MAX(idImagen) AS ultimo FROM IMAGEN WHERE iditinerario='$itinerario' GROUP BY iditinerario";
    fputs($f,"$consultaid\n");

    // Ejecutar la query y renombrar el fichero
    if($resultado = $conexion->query($consultaid)){
        if($datos = $resultado->fetch_assoc()){
            $nombreArchivo = $datos['ultimo'] + 1;              // renombrar
            $archivo_extension = $nombreArchivo . '.jpg';       // guardar el nombre con la extensión
            $ruta = $ruta . $archivo_extension;                 // especificar la ruta donde guardar
            fputs($f,"nuevo nombre: $ruta\n");                  // comprobar en el fichero log
        }       
    }

    // Mover el fichero al directorio que queremos
    if(move_uploaded_file($ficherotmp, $ruta)){
        // Realizar consulta de inserción
        $consulta_insertar = "INSERT INTO IMAGEN VALUES('$nombreArchivo','$archivo_extension','$itinerario')";
        fputs($f,"insert: $consulta_insertar\n");

        // Ejecutar consulta
        if($resultado = $conexion->query($consulta_insertar)){
            fputs($f,"consulta ejecutada\n");
        }
    }
?>