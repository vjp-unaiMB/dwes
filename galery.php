<?php
require 'utils/utils.php';
require 'utils/File.class.php';
require 'entity/imagenGaleria.class.php';
require 'entity/connection.class.php';
require 'entity/queryBuilder.class.php';
require 'exceptions/AppException.class.php';

$errores = [];
$descripcion = '';
$mensaje='';

try{
    $config = require_once 'app/config.php';
    App::bind('config',$config);
    $queryBuilder = new QueryBuilder('imagenes','ImagenGaleria');

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAceptados=['image/jpeg','image/jpg','image/gif','image/png'];

        $imagen=new File('imagen',$tiposAceptados); 
        
        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY,ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);
        
        $imagenGaleria = new ImagenGaleria($imagen->getFileName(),$descripcion);
        $queryBuilder->save($imagenGaleria);
        $descripcion='';
        $mensaje = "Imagen guardada";
    }
}catch(FileException $exception){
    $errores[]=$exception->getMessage();
}catch(QueryException $exception){
    $errores[]=$exception->getMessage();
}catch (AppException $exception){
    $errores[] = $exception->getMessage();
}
finally{
    $imagenes = $queryBuilder->findAll();
}
require 'views/galery.view.php';
?>