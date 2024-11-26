<?php

require 'utils/utils.php';
require_once 'entity/File.class.php';
require_once 'entity/Partner.class.php';
require_once 'entity/connection.class.php';
require 'core/app.class.php';
require_once 'repository/PartnerRepository.class.php';

$errores = [];
$descripcion = '';
$mensaje='';

try{
    $config = require_once 'app/config.php'; //Almacenamos los parámetros de configuración en $config
    App::bind('config',$config); //Introducimos en nuestro almacén de recursos de APP señálizándolo con la clave "Config"

    $partnerRepository = new PartnerRepository();//Crea objeto de tipo PartnerRepository con sus atributos instanciados gracias al cosntructor

    if ($_SERVER['REQUEST_METHOD']==='POST'){//cuando se haga Post
        $nombre = trim(htmlspecialchars($_POST['nombre']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));//Almacenamos la descripcion proporcionada por POST en $descripcion
        $tiposAceptados=['image/jpeg','image/jpg','image/gif','image/png'];//Array con tipos aceptados de imagen

        $logo=new File('imagen',$tiposAceptados); //usamos la clase File para crear el logo del Partner

        $logo->saveUploadFile(Partner::RUTA_LOGOS);//usamos el metodo saveUploadFile para guardar la imagen en su carpeta correspondiente (le pasamos la ruta de destino)
        
        $partner = new Partner($nombre,$logo->getFileName(),$descripcion);//Creamos el objeto de la Imagen a subirse a la BBDD, con sus parámetros
        $partnerRepository->save($partner); //aplicamos la sentencia SQL de Insert en el servidor
        $descripcion='';
        $mensaje = "Patrocinador guardado";
    }

}catch(FileException $exception){
    $errores[]=$exception->getMessage();
}catch(QueryException $exception){
    $errores[]=$exception->getMessage();
}catch (AppException $exception){
    $errores[] = $exception->getMessage();
}
finally{
    $partners = $partnerRepository->findAll();//Finalmente nos traemos de la BBDD todos los elementos para luego distribuirlos
}
require 'views/partners.view.php';
?>