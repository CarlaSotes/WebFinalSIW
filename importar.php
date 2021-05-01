<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>IMPORTAR</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="cuenta.css" rel="stylesheet">
    <!-- Show/hide CSV upload form -->
    <script>
        function formToggle(ID){
            var element = document.getElementById(ID);
            if(element.style.display === "none"){
                element.style.display = "block";
            }else{
                element.style.display = "none";
            }
        }
    </script>

    <script>
        function goBack() {
            window.history.back();
        }</script>
</head>

<style>
    .gap-20 {
    width:100%;
    height:20px;
    }
</style>

<h1> Importar</h1>


<body>
    <?php
    // Mantener la sesión iniciada
    session_start();

    // Obtener mensajes de status
    if(!empty($_GET['status'])){
        switch($_GET['status']){
            case 'succ':
                $statusType = 'alert-success';
                $statusMsg = 'Datos de usuarios han sido importados correctamente';
                break;
            case 'err':
                $statusType = 'alert-danger';
                $statusMsg = 'Han ocurrido problemas, intenta otra vez.';
                break;
            case 'invalid_file':
                $statusType = 'alert-danger';
                $statusMsg = 'Por favor, introduce un archivo CSV válido...';
                break;
            default:
                $statusType = '';
                $statusMsg = '';
        }
    }
    ?>

    <!-- Mostrar mensaje de estado -->
    <?php if(!empty($statusMsg)){ ?>
        <div class="col-xs-12">
            <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
        </div>
    <?php } ?>

<div class="row">
    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Importar Usuarios</a>
        </div>
    </div>

    <!-- CSV formulario -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="importarUsuarios.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>
</div>
    <button onclick="goBack()">ATRAS</button>

</body>

</html>

