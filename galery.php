<?php
require 'utils/utils.php';
require 'utils/File.class.php';
require 'entity/imagenGaleria.class.php';
require 'entity/connection.class.php';

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
        $connection= Connection::make();
        $sql = "INSERT INTO imagenes (nombre,descripcion) values (:nombre,:descreipcion)";
        $pdoStatement = $connection->prepare($sql);
        $parametersStatementArray = [':nombre'=>$imagen->getFileName(), ':descreipcion'=>$descripcion];
        $response = $pdoStatement->execute($parametersStatementArray);
        if($response === false){
            $errores[] = "No se ha podido guardar la imagen en la base de datos";
        }else{
            $descripcion = '';
            $mensaje= 'Imagen guardada';
        }
        $queryStatement = $connection->query($querySql);
        while($row=$queryStatement->fetch()){
            echo "ID: " . $row['id'];
            echo "Nombre: " . $row['nombre'];
            echo "Descripcion: " . $row['descripcion'];
            echo "Visualizaciones: " . $row['numVisualizaciones'];
            echo "Likes: " . $row['numLikes'];
            echo "Descargas: " . $row['numDescargas'];
            // $row = ['id'=>1,nombre'=>'asd','descripcion'=>'dsdas',
            //'numVisualizaciones'=>0,'numLikes'=>0,'numDescargas'=>'0']
        }        

    }
    catch(FileException $exception){
        $errores[]=$exception->getMessage();
    }
    
}

require 'views/galery.view.php';
?>