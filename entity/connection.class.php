<?php

    //Cuando se cree un objeto Connection lo enlazarán con el archivo Conf.php lo que devolverá los parámetros
    //necesarios para que Aquí se cree la conexión con la función make y los datos de config.php .
    class Connection{
        public static function make(){
            try{
                $config = App::get('config')['database'];

                $connection = new PDO(
                    $config['connection'] . ';dbname=' . $config['name'],
                    $config['username'],$config['password'],
                    $config['options']
                );
            }
            catch(PDOException $PDOException){
                throw new AppException("No se ha podido crear la conexión a la BD") ;
            }
            return $connection;
        }
    }


?>
