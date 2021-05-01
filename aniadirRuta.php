<?php
    // mantener sesión
    session_start();
    // obtener id de sesión
    $id = $_SESSION["id"];

    // Obtener el contenido de la plantilla
    $cadena = file_get_contents("plantillaAniadirRuta.html");  

    // Obtener los datos
    $pais = $_POST["pais"];
    $itinerario = $_POST["itinerario"];
    $contenido = $_POST["contenido"];
    $idItinerario = $_POST["idItinerario"];
    $idPais = $_POST["idPais"];

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Realizar la consulta de países
    $consulta = "INSERT INTO RUTA VALUES ('$idItinerario','$itinerario','$contenido','$idPais','$pais')";
    if($resultado = $conexion->query($consulta)) {
        echo "<script>
                alert('Ruta añadida');
                window.location= 'cuenta.php'
        </script>";
    }else{
        echo "<script>
                alert('Ruta no añadida');
                window.location= 'cuenta.php'
        </script>";
    }
?>