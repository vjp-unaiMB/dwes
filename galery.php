<?php
require 'utils/utils.php';
require 'utils/File.class.php';
require 'entity/imagenGaleria.class.php';
require 'entity/connection.class.php';
require 'entity/queryBuilder.class.php';
require 'exceptions/AppException.class.php';
require 'entity/repository/imagenGaleriaRepository.class.php';
require 'entity/repository/CategoriaRepository.class.php';
require 'entity/categoria.class.php';

$errores = [];
$descripcion = '';
$mensaje='';

try{
    $config = require_once 'app/config.php';
    App::bind('config',$config);
    //$queryBuilder = new QueryBuilder('imagenes','ImagenGaleria');
    $imagenRepository = new ImagenGaleriaRepositorio();
    $categoriaRepository = new CategoriaRepository();

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $categoria = trim(htmlspecialchars($_POST['categoria']));
        $tiposAceptados=['image/jpeg','image/jpg','image/gif','image/png'];

        $imagen=new File('imagen',$tiposAceptados); 
        
        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY,ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);
        
        $imagenGaleria = new ImagenGaleria($imagen->getFileName(),$descripcion,$categoria);
        $imagenRepository->save($imagenGaleria);
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
    $imagenes = $imagenRepository->findAll();
    $categorias = $categoriaRepository->findAll();
}
require 'views/galery.view.php';
?>