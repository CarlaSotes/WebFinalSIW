
<?php

    //Base de datos a utilizar
    $dsn = 'mysql:host=dbserver;dbname=db_grupo11';


    $connect = new PDO($dsn, 'grupo11', 'ailieWei2S');

    /*
     * SELECT * FROM COMENTARIO
        WHERE comentario_padre_id = '0'
        ORDER BY id_comentario DESC
     */
    $query = "
        SELECT * FROM COMENTARIO
        WHERE comentario_padre_id = '0'
        ORDER BY id_comentario DESC
        ";

    $sentencia = $connect->prepare($query);

    /*
     * Ejecurtar la consulta: devuelve comment-id, parent-id, comment, comment-sender-name, date, pais_nombre
     */
$sentencia->execute();


    $result = $sentencia->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '
         <div class="panel panel-default">
          <div class="panel-heading">By <b>'.$row["nombrePersona"].'</b> on <i>'.$row["date"].'</i></div>
          <div class="panel-body">'.$row["comentario"].'</div>
          <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id_comentario"].'">Reply</button></div>
         </div>
         ';
        $output .= get_reply_comment($connect, $row["id_comentario"]);
    }

    echo $output;

    //Obtener comentario que responde al actual
    function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
    {
        //  SELECT * FROM COMENTARIO WHERE comentario_padre_id = '".$parent_id."'
        $query = "
          SELECT * FROM COMENTARIO WHERE comentario_padre_id = '".$parent_id."'
         ";
        $output = '';
        $sentencia = $connect->prepare($query);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        $count = $sentencia->rowCount();
        if($parent_id == 0)
        {
            $marginleft = 0;
        }
        else
        {
            $marginleft = $marginleft + 48;
        }
        if($count > 0)
        {
            foreach($resultado as $row)
            {
                $output .= '
           <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
            <div class="panel-heading">By <b>'.$row["nombrePersona"].'</b> on <i>'.$row["date"].'</i></div>
            <div class="panel-body">'.$row["comentario"].'</div>
            <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id_comentario"].'">Reply</button></div>
           </div>
           ';
                $output .= get_reply_comment($connect, $row["id_comentario"], $marginleft);
            }
        }
        return $output;
    }

?>
