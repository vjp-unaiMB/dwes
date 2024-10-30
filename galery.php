<?php
require 'utils/utils.php';
require 'utils/File.class.php';
require 'entity/imagenGaleria.class.php';

$errores = [];
$descripcion = '';
$mensaje='';

if ($_SERVER['REQUEST_METHOD']==='POST'){
    try{
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAceptados=['image/jpeg','image/jpg','image/gif','image/png'];
        $imagen=new File('imagen',$tiposAceptados); 
        
        $imagen -> saveUploadFile(imagenGaleria::RUTA_IMAGENES_GALLERY);
        $imagen->copyFile(imagenGaleria::RUTA_IMAGENES_GALLERY,imagenGaleria::RUTA_IMAGENES_PORTFOLIO);
        $mensaje = "Datos enviados";
    }
    catch(FileException $exception){
        $errores[]=$exception->getMessage();
    }
    
}

require 'views/galery.view.php';
?>