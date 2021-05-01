<?php
    // mantener sesión
    session_start();
    // obtener id de sesión
    $id = $_SESSION["id"];

    $cadena = file_get_contents("plantillaDescargarCSV.html");

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

        // Si es un administrador, tiene acceso a dos botones más
        if($tipo == "admin"){
            // Opciones de administrados de base de datos
            echo "<table>
                    <tr>
                        <th>RUTAS</th>
                        <th>PAÍSES</th>
                        <th>USUARIOS</th>                    
                        <th>RESERVAS</th>
                        <th>IMÁGENES</th>
                    </tr>
                    <tr>
                        <td><a href='descargar_rutas_csv.php'>Descargar rutas</a></td>
                        <td><a href='descargar_paises_csv.php'>Descargar países</a></td>
                        <td><a href='descargar_usuarios_csv.php'>Descargar usuarios</a></td> 
                        <td><a href='descargar_reservas_csv.php'>Descargar reservas</a></td> 
                        <td><a href='descargar_imagenes_csv.php'>Descargar imágenes</a></td> 
                    </tr>
                </table>";
        }
        // Imprimir el resto del documento html
        echo $trozos[3];
    }
?>
