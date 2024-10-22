<?php
    require 'views/index.view.php';
    require 'entity/ImagenGaleria.class.php';

    $Imagenes = [];

    for($i=1;$i<13;$i++){
        $ImagenGaleria = new imagenGaleria($i . '.jpg','descripción imagen ' .  $i,rand(300000,2000000),rand(2000,120000),rand(100,500));
        $imagenes[$i] = $ImagenGaleria;
    }

    require 'views/index.view.php';

    
?>