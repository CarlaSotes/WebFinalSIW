<?php

    //Descripcion : se obtiene la info de los itinerarios y la pone en un pdf
    $idPais = $_GET['nombrePais']; //se obtiene el pais del que se quiere mostrar el itinerario

    //se cambia el nombre a algunos paises, para que esten en mismo formato que DB
    switch($idPais){
        case "corea":
            $idPais = "corea del sur";
            break;
        case "prico":
            $idPais = "puerto rico";
            break;
        case "nzelanda":
            $idPais = "nueva zelanda";
            break;
        case "rcheca":
            $idPais = "republica checa";
    }
    echo $idPais;

    define('FPDF_FONTPATH', 'font/');
    require('fpdf182\fpdf.php');



    //Create new pdf file
    $pdf=new FPDF();

    //Open file
    $pdf->Open();

    //Disable automatic page break
    $pdf->SetAutoPageBreak(false);

    //Add first page
    $pdf->AddPage();

    //set initial y axis position per page
    $y_axis_initial = 25;

    //print column titles for the actual page
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetY($y_axis_initial);
    $pdf->SetX(25);
    $pdf->Cell(100, 6, 'CONTENIDO', 1, 0, 'L', 1);

    //initialize counter
    $i = 0;

    //Set maximum rows per page
    $max = 25;

    //Set Row Height
    $row_height = 6;

    $y_axis = $y_axis_initial + $row_height;


    //se establace conexion la databasu
    $conexion = mysqli_connect("dbserver","grupo11", "ailieWei2S","db_grupo11"); // nube
    //$conexion = mysqli_connect("localhost","root", "","db_grupo11");

    // Comprobar si ha ido mal la conexión
    if(mysqli_connect_errno()){
        echo "ha ido  mal" . mysqli_connect_error();
        exit();
    }

    //se crea la consulta
    $consultaRuta = "Select contenido from ruta where nombrePais  = '$idPais' ";

    //se muestra consulta de las rutas del pais
    if($resultado = $conexion->query($consultaRuta)) {

        if ($i == $max)
        {
            $pdf->AddPage();

            //print column titles for the current page
            $pdf->SetY($y_axis_initial);
            $pdf->SetX(25);
            $pdf->Cell(100, 6, 'CONTENIDO', 1, 0, 'L', 1);

            //Go to next row
            $y_axis = $y_axis + $row_height;

            //Set $i variable to 0 (first row)
            $i = 0;
        }
        $contenido = $resultado['contenido'];

        $pdf->SetY($y_axis);
        $pdf->SetX(25);
        $pdf->Cell(100, 6, $contenido, 1, 0, 'L', 1);

        //Ir a siguiente fila
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
    }
    $pdf->Output();


?>