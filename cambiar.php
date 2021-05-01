<?php
    // Obtener el país anterior
    $pais_anterior = $_POST["idpais"];

    // Obtener el resto de datos
    $continente = $_POST["continente"];
    $lema = $_POST["lema"];
    $nuevopais = $_POST["pais"];

    // Obtener el contenido de la plantilla
    $cadena = file_get_contents("pais.html");

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Realizar la consulta de países
    $consulta = "UPDATE PAIS SET continente='$continente',lema='$lema', pais='$nuevopais' WHERE pais='$pais_anterior'";

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