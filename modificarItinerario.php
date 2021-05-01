<?php
    // Obtener el país y ruta anteriores
    $pais_anterior = $_POST["idpais"];
    $ruta_anterior = $_POST["rutas"];

    // Obtener los datos actuales
    $ruta_actual = $_POST["ruta"];
    $contenido = $_POST["contenido"];

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Realizar la consulta de actualizar la ruta
    $consulta = "UPDATE RUTA SET nombreItinerario='$ruta_actual', contenido='$contenido' WHERE nombrePais='$pais_anterior' AND idItinerario='$ruta_anterior'";

    // Ejecutar consulta
    if($resultado = $conexion->query($consulta)) {
        echo "<script>
            alert('País modificado');
            window.location= 'cuenta.php'
        </script>";
    }else{
        echo "<script>
            alert('País no modificado');
            window.location= 'cuenta.php'
        </script>";
}
?>