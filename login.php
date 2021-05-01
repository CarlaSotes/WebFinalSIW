<?php
    // Iniciar sesión-mantener la sesión iniciada
    session_start();

    // Obtener las variables
    $password = $_POST["pswd"];
    $id = $_POST["id"];

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Comprobar si el usuario existe
    $consulta = "SELECT * FROM USUARIO WHERE idUsuario='$id' AND contraseña='$password'";

    if($resultado = $conexion->query($consulta)) {

        // Darle valor a la sesión
        $_SESSION["id"] = $id;
        $comprobacion = $resultado->fetch_assoc();

        //en caso que no haya informacion en la consulta, quiere decir que me devolvio una que esta vacia
        if (strlen($comprobacion["idUsuario"]) ==0 || (empty($comprobacion["idUsuario"])) ){
            echo "<script>
                alert('Usuario no registrado');
                window.location= 'login.html'
                     </script>";
        }else{
            echo "<script>
                    alert('Usuario registrado');
                    window.location= 'cuenta.php'
            </script>";
        }
    }
?>