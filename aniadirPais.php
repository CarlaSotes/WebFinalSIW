<?php
    // mantener sesión
    session_start();
    // obtener id de sesión
    $id = $_SESSION["id"];

    // Obtener el contenido de la plantilla
    $cadena = file_get_contents("plantillaAniadirPais.html");  

    // Obtener los datos
    $continente = $_POST["continente"];
    $lema = $_POST["lema"];
    $pais = $_POST["pais"];
    $id = $_POST["id"];

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Realizar la consulta de países
    $consulta = "INSERT INTO PAIS VALUES ('$pais','$continente', '$id','$lema')";
    if($resultado = $conexion->query($consulta)) {
        echo "<script>
                alert('País añadido');
                window.location= 'cuenta.php'
        </script>";
    }else{
        echo "<script>
                alert('País no añadido');
                window.location= 'cuenta.php'
        </script>";
    }
?>