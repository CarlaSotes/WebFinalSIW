<?php

//Se crea un array con datos:  clave-nombrePais ,  valor - numeroItinerarios
$datos  = array( 'australia' =>2,'brasil' =>2 , 'china'=>2, 'coreasur'=>2, 'egipto' =>2
,'espania' =>2,'francia' =>3,'grecia' =>3,'india' =>5,'inglaterra' =>2,'irlanda' =>2
,'italia' =>2,'japon' =>3,'marruecos' =>3,'noruega' =>2,'nzelanda' =>3,'peru' =>2
,'prico' =>2,'senegal' =>2,'tunez' =>2,'usa' =>3) ;



$fp = fopen('paises.json', 'w');
fwrite($fp, json_encode($datos));
fclose($fp);

?>