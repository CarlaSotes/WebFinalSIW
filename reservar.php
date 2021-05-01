<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Obtener el idItinerario a reservar
    $idItinerario = $_GET['idItinerario'];
    // Para poder reservarlo, lo guardamos en una variable de sesión
    session_start();
    $_SESSION["idItinerario"] = $idItinerario;

    // Comprobar si tiene una sesión iniciada
    if(!isset($_SESSION["id"])){
        echo "<script>
            alert('Para poder reservar este viaje debe estar registrado. Se le va a reconducir a la página de Login.');
            window.location= 'registrar.html';
            </script>";
    }else{
        // Obtener el id de sesión
        $sesion = $_SESSION["id"];

        // Establecer conexión con la base de datos
        $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11");
        //$conexion = mysqli_connect("localhost","root", "","db_grupo11");

        // Comprobar si ha ido mal la conexión
        if(mysqli_connect_errno()){
            echo "ha ido  mal" . mysqli_connect_error();
            exit();
        }

        // Hacer la consulta para indicar con qué usuario se va a reservar
        $consulta = "SELECT correo FROM USUARIO WHERE idUsuario='$sesion'";

        if($resultado = $conexion->query($consulta)) {
            while ($datos = $resultado->fetch_assoc()) {
                $correo = $datos["correo"];
            }
        }
    }
?>

<script>
    // Cuadro de diálogo que indique si reservar con esa cuenta; confirm es un cuadro que tiene dos botones: aceptar y cancelar
    var confirmacion = confirm('Va a inciar sesión con el correo <?php echo $correo; ?>, si quiere con otro usuario, acceda a su cuenta y cierre sesión.');
    if(confirmacion){
        alert('Se va a reservar el viaje...');
        window.location='hacerReserva.php';
       
    } else {
        alert("Viaje no reservado, va a ir a la página de inicio...")
        window.location= 'index.php';
    }
</script>


    