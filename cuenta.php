<?php
    // Mostrar errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // mantener sesión
    session_start();
    // obtener id de sesión
    $id = $_SESSION["id"];

    $cadena = file_get_contents("plantillaCuenta.html");  

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }
    
    // Cortar el html por el comodín ##fila##
    $trozos = explode("##fila##", $cadena);  

    // INFORMACIÓN DE LA CUENTA
    // Realizar la consulta de usuarios
    $consulta = "SELECT * FROM USUARIO WHERE idUsuario='$id'";
    $cuerpo = "";
    if($resultado = $conexion->query($consulta)) {
        // Imprimir hasta la tabla
        echo $trozos[0];
        while ($datos = $resultado->fetch_assoc()) {
            // Sustituir la plantilla
            $aux = $trozos[1]; 
            $aux = str_replace("##nombre##", $datos["nombre"], $aux);
            $aux = str_replace("##Apellido##", $datos["apellido"], $aux);
            $aux = str_replace("##Correo##", $datos["correo"], $aux);
            $cuerpo = $cuerpo . $aux;
            // Imprimir el contenido
            echo $cuerpo;
            // Guardar el tipo de usuario para añadir o no después las opciones de administrador
            $tipo = $datos["rol"];
        }
        // Imprimir la etiqueta final de tabla
        echo $trozos[2];

        // RUTAS RESERVADAS
        // Realizar la consulta de usuarios
        $consultaRutas = "SELECT nombreItinerario FROM RESERVA, RUTA WHERE RESERVA.idItinerario=RUTA.idItinerario AND RESERVA.idUsuario='$id'";

        $cuerpo2 = "";
        if($resultado = $conexion->query($consultaRutas)) {
            // Imprimir hasta la tabla
            echo $trozos[3];
            while ($datos = $resultado->fetch_assoc()) {
                // Sustituir la plantilla
                $aux = $trozos[4];
                $aux = str_replace("##rutas##", $datos["nombreItinerario"], $aux);
                $cuerpo2 = $cuerpo2 . $aux;
                
            }
            // Imprimir el contenido
            echo $cuerpo2;
            // Imprimir la etiqueta final de tabla
            //echo $trozos[4];
        }

        // Si es un administrador, tiene acceso a dos botones más
        if($tipo == "admin"){
            // Añadir los botones de csv o json
            echo "<a href=plantillaCSV.php>";
            echo "<button>CSV</button>";
            echo "</a>";
            echo "<a href=getjson.php>";
            echo "<button>JSON</button>";
            echo "</a>";
            echo "<br>";
            // Opciones de administrados de base de datos
            echo "<table>
                <tr>
                    <th>RUTAS</th>
                    <th>PAÍSES</th>
                </tr>
                <tr>
                    <td><a href='aniadirRutas.php'> Añadir rutas</a></td>
                    <td><a href='aniadirPaises.php'> Añadir país</a></td>
                <tr>
                <tr>
                    <td><a href='modificarRuta.php'> Modificar rutas</a></td>
                    <td><a href='administrarPaises.php'> Modificar país</a></td>
                </tr>
                <tr>
                    <td><a href='eliminarRuta.php'> Eliminar rutas</a></td> 
                    <td><a href='eliminarPaises.php'> Eliminar país</a></td> 
                </tr>
                <tr>
                    <td><a href='fotos1.php'> Añadir fotos</a></td>
                </tr>
                
            </table>";
        }
        // Imprimir el resto del documento html
        echo $trozos[6];
    }
?>