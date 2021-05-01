<?php

//comentario.php

?>
<!DOCTYPE html>
<html>
<head>
    <title>OPINIONES DE CLIENTES</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href ="comentarios.css"/>

</head>
<body>
<br />
<body>
<div class="header">
    <div class="info">
        <h1><a href="index.php">HERMA</a></h1>
        <h2>OPINIONES DE NUESTROS CLIENTES</h2>
    </div>
</div>
<br />


<div class="gap-20"></div>
<div class="container">
    <form method="POST" id="comment_form">
        <!-- Div para poner el nombre del usuario que realiza el comentario -->
        <div class="form-group">
            <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
        </div>
        <!-- Div para poner el contenido del comentario -->
        <div class="form-group">
            <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
        </div>
        <!-- Div para button encargado de hacer submit del comentario -->
        <div class="form-group">
            <input type="hidden" name="comment_id" id="comment_id" value="0" />
            <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
        </div>
    </form>
    <span id="comment_message"></span>
    <br />
    <div id="display_comment"></div>
</div>
</body>
</html>

<!-- Scripts que se encargan del funcionamiento de comentarios: realizarlos y responder-->
<script>
    //Funcion que se ejecutara cuando el usuario realiza submit
    $(document).ready(function(){
        //Funcionalidades que realizamos tras realizar submit de comentario
        $('#comment_form').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            //alert(form_data)
            $.ajax({
                url:"agregar_comentario" +
                    ".php",
                method:"POST",
                data:form_data,
                dataType:"JSON",
                //en caso de haberse producido problemas, recibimos datos
                success:function(data)
                {
                    if(data.error != '')
                    {
                        $('#comment_form')[0].reset(); //borra comentarios
                        $('#comment_message').html(data.error); //ponems en el html el error
                        $('#comment_id').val('0'); //ponemos el id del comment a 0
                        load_comment();
                    }
                }
            })
        });
        /*
           En caso de no producirse fallo, comentario se procede a mostrar en pantalla. Ya esta en BDD.
         */
        load_comment();

        /*
           Funcion que carga el comentario en pantalla
         */
        function load_comment()
        {

            $.ajax({
                url:"capturar_comentario.php",
                method:"POST",
                //  data:nombre_pais,
                //dataType:"JSON",
                success:function(data)
                {
                    $('#display_comment').html(data);
                }
            })
        }

        $(document).on('click', '.reply', function(){
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment_name').focus();
        });

    });
</script>

<!-- Script que permite volver hacia la ventana anterior-->
<script>
    function goBack() {
        window.history.back();
    }</script>

<div class="container">
    <!-- Boton que permite volver atras -->
    <button onclick="goBack()" class="button">VOLVER</button>
    <!-- Se inserta espacio en blanco -->
    <div class="gap-20"></div>
</div>