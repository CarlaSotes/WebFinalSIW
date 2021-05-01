<?php
    // mantener sesión
    session_start();
    // obtener id de sesión
    $id = $_SESSION["id"];
    $lema = $_POST["pais"];
    $nuevopais = $_GET["pais"];
echo $lema;
echo $nuevopais;
?>