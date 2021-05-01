<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Aceptar caractéres especiales -->
    <meta charset="UTF-8">
    <!-- Título de la página -->
    <title>HERMA-GALERIA</title>
    <!-- Agregar CSS -->
    <link rel="stylesheet" href ="cargarGaleria.css"/>
    <!-- fancybox CSS library -->
    <!-- 1. Agregar jQuery and fancybox files -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <!-- Funcion JS que permite ir a la ventana anterior -->
    <script>
        function goBack() {
            window.history.back();
        }</script>
</head>

<body>
<div class="header">
    <div class="sides">
        <a href="#" class="logo">HERMA</a>
    </div>
    <div class="info">
        <h1><a href="#category">HERMA</a></h1>
        <h2>"Deja que el dios de los viajeros te guíe a tu próximo destino"</h2>
    </div>
</div>


<div class="container">
    <div class="gallery">
        <?php
        $dbHost = 'dbserver';
        $dbUsername = 'grupo11';
        $dbPassword = 'ailieWei2S';
        $dbName = 'db_grupo11';
        $IDItinerario = $_GET['idItinerario'];
        $nombrePais = $_GET['nombrePais'];
        //Crear conexion con la base de datos
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        //En caso que la operacion de problemas
        if ($db->connect_error) {
            die("Unable to connect database: " . $db->connect_error);
        }

        //Obtener las imagenes del itinerario seleccionado por el usuario
        $query = $db->query("SELECT * FROM IMAGEN where idItinerario = $IDItinerario");

        //Mientras existan imagenes, ir mostrandolas
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $imageThumbURL = 'im/'.$row["nombreArchivo"];
                $imageURL = 'im/'.$row["nombreArchivo"];
                ?>
                <a href="<?php echo $imageURL; ?>" data-fancybox="group" data-caption="<?php echo $row["nombreArchivo"]; ?>" >
                    <img src="<?php echo $imageThumbURL; ?>" class = "w3-round-xlarge"  alt=""  style="width:30%" />
                </a>
            <?php }
        } ?>
    </div>
</div>

<div class="container">
        <!-- Boton que permite volver atras -->
        <button onclick="goBack()" class="button">VOLVER</button>
        <!-- Se inserta espacio en blanco -->
        <div class="gap-20"></div>
</div>

</body>
</html>