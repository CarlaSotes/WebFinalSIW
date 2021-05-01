<?php

    //Base de datos a utilizar
    //$conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    $dsn = 'mysql:host=dbserver;dbname=db_grupo11';

    $connect = new PDO($dsn, 'grupo11', 'ailieWei2S');
    $error = '';
    $comment_name = '';
    $comment_content = '';

    //Comprobacion del nombre del usuario que realiza el comentario
    if(empty($_POST["comment_name"]))
    {
        $error .= '<p class="text-danger">Name is required</p>';
    }else {
        $comment_name = $_POST["comment_name"];
    }




    //Comprobacion del contenido del comentario
    if(empty($_POST["comment_content"]))
    {
        $error .= '<p class="text-danger">Comment is required</p>';
    }
    else{
        $comment_content = $_POST["comment_content"];
    }

    if($error == '')
    {
        /*
         * "
         INSERT INTO COMENTARIO
         (comentario_padre_id, comentario, nombrePersona)
         VALUES (:comentario_padre_id, :comentario, :nombrePersona)
         "
         */
        $query = "
          INSERT INTO COMENTARIO
         (comentario_padre_id, comentario, nombrePersona)
         VALUES (:comentario_padre_id, :comentario, :nombrePersona)
         ";
        $sentencia = $connect->prepare($query);
        $sentencia->execute(
            array(
                /*
                 * ':comentario_padre_id' => $_POST["comment_id"],
                   ':comentario'    => $comment_content,
                    ':nombrePersona' => $comment_name
                 */
                ':comentario_padre_id' => $_POST["comment_id"],
                ':comentario'    => $comment_content,
                ':nombrePersona' => $comment_name
            )
        );
        $error = '<label class="text-success">Comment Added</label>';
    }

    //-------------------------------------EN CASO DE ERROR MANDAR MENSAJE-----------------------------------------
    $data = array(
        'error'  => $error
    );

    echo json_encode($data);

?>

