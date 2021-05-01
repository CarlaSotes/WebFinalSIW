<?php
    // Mantener la sesión iniciada
    session_start();

    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11"); // local

    // Comprobar la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }


    if(isset($_POST['importSubmit'])){

        //Permitir arhcivos mimes
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        //Validar si el archivo elegido es un csv, de no ser asi, dar error
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

            // Si el archivo esta subido
            if(is_uploaded_file($_FILES['file']['tmp_name'])){

                // Abrir el arhcivo en modo lectura
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                // Saltarse la primera linea
                fgetcsv($csvFile);

                // Parsear linea a linea el archivo
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    //Obtener una linea de datos
                    //Se separa de acuerdo al delimitante
                    $datos = explode(';',$line[0]);

                    $idUsuario   = $datos[0];
                    $nombre  = $datos[1];
                    $apellido = $datos[2];
                    $correo = $datos[3];
                    $contraseña = $datos[4];
                    $rol = $datos[5];


                    // comprobar si existe ya la persona en la BD
                    $prevQuery = "SELECT idUsuario FROM USUARIO WHERE correo = '$correo' ";
                    $prevResult = $conexion->query($prevQuery);

                    if($prevResult->num_rows > 0){
                        //ACTUALIZAR EN BD
                        $conexion->query("UPDATE USUARIO SET nombre = '$nombre', apellido = '$apellido', contraseña = '$contraseña' WHERE correo = '$correo'");
                    }else{
                        // INSERTAR USER EN DB
                        $conexion->query("INSERT INTO USUARIO VALUES ('$idUsuario', '$nombre','$apellido','$correo','$contraseña','$rol')");
                    }
                }

                // Cerrar el archivo CSV abierto
                fclose($csvFile);
                $qstring = '?status=succ';
            }else{
                $qstring = '?status=err';
            }
        }else{
            $qstring = '?status=invalid_file';
        }
    }

    // Redireccionar a la pagina principal
    header("Location: importar.php".$qstring);
?>