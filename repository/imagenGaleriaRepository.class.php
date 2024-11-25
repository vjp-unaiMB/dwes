<?php
    require_once 'entity/queryBuilder.class.php';
    //la función de estos repositorios es la de introducir todas las funciones que requieran acceder a la BD
    class ImagenGaleriaRepositorio extends QueryBuilder{
        public function __construct(string $table='imagenes',string $classEntity ='ImagenGaleria'){
            parent::__construct($table, $classEntity);
        }
        public function GetCategoria(ImagenGaleria $imagenGaleria):Categoria {
            $categoriaRepository = new CategoriaRepository();
            return $categoriaRepository->find($imagenGaleria->getCategoria());
        }
    }

    
?>