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

    // Consulta
    $consulta = $conexion->query("SELECT * FROM RESERVA");


    if($consulta->num_rows >0){
        $delimiter = ";"; //En caso de problemas, cambiar el delimitador
        $nombreArchivo = "reservas".date('Y-m-d').".csv";

        //Creacion de un apuntador al fichero
        $fp = fopen('php://memory', 'w');

        //Establecer el nombre de columnas de archivo
        $cabeceras = array('idUsuario','idItinerario');
        fputcsv($fp,$cabeceras,$delimiter);

        //Poner resultado de consulta

        while ($filas = $consulta->fetch_assoc()) {
            $linea = array($filas['idUsuario'],$filas['idItinerario']);
            fputcsv($fp, $linea, $delimiter);
        }
        //Se vuelve al principio del fichero csv creado
        fseek($fp,0);
        //Se pone los headers del archivo
        header('Content-type: text/csv');
        header('Content-Disposition: attachmentent; filename="'.$nombreArchivo.'";');

        //output datos
        fpassthru($fp);
    }
    exit;
?>

