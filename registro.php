<?php
    
    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    // Obtener las variables
    $nombre = $_POST["name"];
    $idUsuario = $_POST["id"];
    $apellido = $_POST["surname"];
    $password = $_POST["pswd1"];
    $email = $_POST["email"];

    // Codificar contraseña
    //$pwd_codificada = password_hash($password, PASSWORD_BCRYPT);
   

    // Realizar inserción en la base de datos
    $insercion = "INSERT INTO USUARIO VALUES('$idUsuario', '$nombre', '$apellido', '$email', '$password', 'usr')";

    // Comprobar si se ha hecho bien
    if($resultado = $conexion->query($insercion)) {
        // Iniciar sesión
        session_start();
        // Darle valor a la sesión
        $_SESSION["id"] = $idUsuario;
        
        // Ir a la cuenta
        echo "<script>
                alert('Usuario registrado');
                window.location= 'cuenta.php'
        </script>";
    }else{
        echo "<script>
                alert('Usuario no registrado');
                window.location= 'registro.html'
        </script>";
    }  

   
?>

