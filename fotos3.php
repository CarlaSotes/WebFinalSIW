<?php
	// Iniciar sesión para acceder a las variables
    session_start();

    // Obtener la ruta
    $idruta = $_GET['rutas'];
    
    // Asignar a una variable de sesión (actúa como global) el idRuta
    $_SESSION['ruta'] = $idruta;
    

    // Ir a la página para subir fotos
    $dropzone = file_get_contents("dropzone.html");
    // Imprimir el contenido
    echo $dropzone;
?>