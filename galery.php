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
    $connection = App::getConnection();
    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAceptados=['image/jpeg','image/jpg','image/gif','image/png'];

        $imagen=new File('imagen',$tiposAceptados); 
        
        $imagen -> saveUploadFile(imagenGaleria::RUTA_IMAGENES_GALLERY);
        $imagen->copyFile(imagenGaleria::RUTA_IMAGENES_GALLERY,imagenGaleria::RUTA_IMAGENES_PORTFOLIO);
        
        $sql = "INSERT INTO imagenes (nombre,descripcion) values (:nombre,:descreipcion)";
        $pdoStatement = $connection->prepare($sql);
        $parametros = [':nombre'=>$imagen->getFileName(), ':descreipcion'=>$descripcion];
        $response = $pdoStatement->execute($parametros);
        if($response === false){
            $errores[] = "No se ha podido guardar la imagen en la base de datos";
        }else{
            $descripcion = '';
            $mensaje= 'Imagen guardada';
        }
        

    }
    $queryBuilder = new QueryBuilder($connection);
    $imagenes = $queryBuilder->findAll('imagenes','ImagenGaleria');
}catch(FileException $exception){
    $errores[]=$exception->getMessage();
}catch(QuearyException $exception){
    $errores[]=$exception->getMessage();
}catch (AppException $exception){
    $errores[] = $exception->getMessage();
}

    
require 'views/galery.view.php';
?>