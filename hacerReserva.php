<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Abrir sesión para poder acceder a las variables
    session_start();
    $sesion = $_SESSION["id"];
    $idItinerario = $_SESSION["idItinerario"];

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11");
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11");

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Hacer la consulta para indicar con qué usuario se va a reservar
    $insercion = "INSERT INTO RESERVA VALUES ('$sesion','$idItinerario')";

    // Ejecutar la consulta
    if($resultado = $conexion->query($insercion)) {
        echo "<script>
            alert('VIAJE REGISTRADO');
            window.location= 'cuenta.php'
        </script>";
    }
?>