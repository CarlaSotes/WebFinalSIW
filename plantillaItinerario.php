<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Obtener contenido html
    $cadena = file_get_contents("plantillaItinerario.html");
    $idPais = $_GET['idpais']; //se obtiene el pais del que se quiere mostrar el itinerario

    $paislower = strtolower($idPais);



switch($paislower){
        case "corea del sur":
            $paislower = "corea";
            break;
        case "puerto rico":
            $paislower = "prico";
            break;
        case "nueva zelanda":
            $paislower = "nzelanda";
            break;
        case "repÚblica checa":
            $paislower = "rcheca";
            break;
        case "espaÑa":
            $paislower = "espania";
            break;
        case "tÚnez":
            $paislower = "tunez";
            break;
    }


    $cadena = str_replace("##estilocss##", $paislower, $cadena);
    $cadena = str_replace("##nombrePaisTitulo##", $idPais, $cadena); //sustituir por nombre de pais



    // Establecer conexión con la base de datos
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11");
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11");

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    //PARTE 0: cargar el lema del pais
    $consultaLema = "SELECT lema FROM PAIS WHERE pais ='$idPais' ";

    if($resultado = $conexion->query($consultaLema)) {
        while ($datos = $resultado->fetch_assoc()) {
            $cadena = str_replace("##lema##", $datos['lema'], $cadena);
        }
    }


//PARTE 1: CARGAR EL MENU DESPLEGABLE
    //Reciclamos las sentencias sql de index.php
    $consultaEuropa = "SELECT pais FROM PAIS WHERE continente='EUROPA'";
    $consultaAmerica = "SELECT pais FROM PAIS WHERE continente='AMERICA'";
    $consultaAsia = "SELECT pais FROM PAIS WHERE continente='ASIA'";
    $consultaAfrica = "SELECT pais FROM PAIS WHERE continente='ÁFRICA'";
    $consultaOceania = "SELECT pais FROM PAIS WHERE continente='OCEANÍA'";

    // Europa
    if($resultado = $conexion->query($consultaEuropa)) {
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);
        //$trozosaux = explode("##idpais##", $cadena);

        $cuerpo = "";
        $aux = "";
        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[1];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo .= $aux;
        }
    }

    // America
    if($resultado = $conexion->query($consultaAmerica)) {
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);

        $cuerpo2 = "";
        $aux = "";

        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[3];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo2 .= $aux;
        }
    }

    // Asia
    if($resultado = $conexion->query($consultaAsia)) {
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);

        $cuerpo3 = "";
        $aux = "";

        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[5];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo3 .= $aux;
        }
    }

    // Africa
    if($resultado = $conexion->query($consultaAfrica)) {
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);

        $cuerpo4 = "";
        $aux = "";

        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[7];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo4 .= $aux;
        }
    }

    // Oceania
    if($resultado = $conexion->query($consultaOceania)) {
        // Separar por ##fila##
        $trozos = explode("##fila##", $cadena);

        $cuerpo5 = "";
        $aux = "";

        while ($datos = $resultado->fetch_assoc()) {
            $aux = $trozos[9];
            $aux = str_replace("##pais##", $datos["pais"], $aux);
            //ponemos el nombrePais en la url
            $aux = str_replace("##idpais##", $datos["pais"], $aux);
            $cuerpo5 .= $aux;
        }
    }

    // Mostrar menu: esto muestra el menu, pero ahora hay que manipular los itinerarios
    //se tendra que realizar algo parecido a lo visto   
    //esta variable contiene lo ya realizado
    $cadenaActual =  $trozos[0] . $cuerpo . $trozos[2] . $cuerpo2 . $trozos[4] . $cuerpo3 . $trozos[6] . $cuerpo4 . $trozos[8] . $cuerpo5;


    // PARTE 2: cargar los itinerarios
    // realizamos la consulta
    $consulta = "SELECT * FROM RUTA WHERE nombrePais  = '$idPais' ";


    //rellenamos el menu que se encuentra en la parte derecha de la pantalla
    if($resultado = $conexion->query($consulta)) {

        // Separar por ##fila##
        $trozos_side = explode(" ##filaMenu##", $trozos[10]);


        $cuerpoSide = "";
        $auxTexto = "";


        //devuelve un array asociativo e iterara tantas veces como planes existan
        while ($datos = $resultado->fetch_assoc()) {
            $auxTexto = $trozos_side[1];
            $auxTexto = str_replace("##nombreitinerario##", $datos["nombreItinerario"], $auxTexto); //ponemos el nombre del itinerario
            $auxTexto = str_replace("-iditinerario-", $datos["idItinerario"], $auxTexto); //ponemos el id del itinerario
            $cuerpoSide .= $auxTexto;
        }

    }else{
        echo "esto ha petado";
    }


    // Rellenamos los itinerarios
    if($resultado = $conexion->query($consulta)) {

        // Separar por ##fila##
        $trozos_itinerario = explode("##article##",  $trozos_side [2]);


        $cuerpoItinerario = "";
        $auxTexto = "";


        //devuelve un array asociativo e iterara tantas veces como planes existan
        while ($datos = $resultado->fetch_assoc()) {
            $auxTexto = $trozos_itinerario[1];
            $auxTexto = str_replace("##iditinerario##", $datos["idItinerario"], $auxTexto);
            $auxTexto = str_replace("##nombreitinerarioActual##", $datos["nombreItinerario"], $auxTexto);
            $auxTexto = str_replace("##textoItinerario##", $datos["contenido"], $auxTexto);
            $auxTexto = str_replace("##nombrePaisActual##", $idPais, $auxTexto);
            $cuerpoItinerario .= $auxTexto;
        }

   }else{
        echo "esto ha petado";
    }


    echo $cadenaActual.$trozos_side[0]. $cuerpoSide.$trozos_itinerario[0].$cuerpoItinerario.$trozos_itinerario[2];
?>