<?php
    // Mantener sesión actual
    session_start();
    
    // Eliminar los datos de la cookies
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
        }
        // Liberar todas las variables de la sesión
        session_unset();
        // Destruir/cerrar sesión
        session_destroy();
        // Informar al usuario y volver al menú principal
        echo "<script>
                alert('Sesión cerrada');
                window.location= 'index.php'
        </script>";
?>