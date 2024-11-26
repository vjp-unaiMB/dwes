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

        //este método recibe una imagen de la galeria que queremos guardar mediante una transacción
        public function guarda(imagenGaleria $imagenGaleria){
            $fnGuardaImagen = function () use ($imagenGaleria){//funcion Anonima
                $categoria = $this->GetCategoria($imagenGaleria);
                $categoriaRepository = new CategoriaRepository();
                $categoriaRepository->nuevaImagen($categoria);
                
                $this->save($imagenGaleria);//Guardo Imagen
            };
            $this->executeTransaction($fnGuardaImagen);
        }
    }

    
?>