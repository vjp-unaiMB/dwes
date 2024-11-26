<?php

require 'utils/utils.php';
require_once 'entity/File.class.php';
require_once 'entity/imagenGaleria.class.php';
require_once 'entity/connection.class.php';
require_once 'exceptions/AppException.class.php';
require 'core/app.class.php';
require_once 'repository/imagenGaleriaRepository.class.php';
require_once 'repository/CategoriaRepository.class.php';
require 'entity/categoria.class.php';

$errores = [];
$descripcion = '';
$mensaje='';

try{
    $config = require_once 'app/config.php'; //Almacenamos los parámetros de configuración en $config
    App::bind('config',$config); //Introducimos en nuestro almacén de recursos de APP señálizándolo con la clave "Config"
    //$queryBuilder = new QueryBuilder('imagenes','ImagenGaleria');
    $imagenRepository = new ImagenGaleriaRepositorio();//Crea objeto de tipo ImagenGaleriaRepositorio con sus atributos instanciados gracias al cosntructor
    $categoriaRepository = new CategoriaRepository();//se peude decir lo mismo de esta sentencia.

    if ($_SERVER['REQUEST_METHOD']==='POST'){//cuando se haga Post
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));//Almacenamos la descripcion proporcionada por POST en $descripcion
        $categoria = trim(htmlspecialchars($_POST['categoria']));//Almacenamos la categoria proporcionada por POST en $categoria
        $tiposAceptados=['image/jpeg','image/jpg','image/gif','image/png'];//Array con tipos aceptados de imagen

        $imagen=new File('imagen',$tiposAceptados); 
        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);//usamos el metodo saveUploadFile para guardar la imagen en su carpeta correspondiente (le pasamos la ruta de destino)
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY,ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);//copyFile es otra Function de File que nos permite copiar una rchivo y pegarlo en otra dirección(le pasamos los 2 parametros)

        $imagenGaleria = new ImagenGaleria($imagen->getFileName(),$descripcion,$categoria);
        $imagenRepository->guarda($imagenGaleria); //aplicamos la sentencia SQL de Insert en el servidor
        $descripcion='';
        $mensaje = "Imagen guardada ";
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