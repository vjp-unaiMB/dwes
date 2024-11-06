<?php


class Connection{
    public static function make($config){
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
