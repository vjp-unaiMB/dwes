<?php
    require_once 'entity/queryBuilder.class.php';

    class ImagenGaleriaRepositorio extends QueryBuilder{
        public function __construct(string $table='imagenes',string $classEntity ='ImagenGaleria'){
            parent::__construct($table, $classEntity);
        }
    }
?>