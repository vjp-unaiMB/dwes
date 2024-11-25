<?php
    require_once 'exceptions/AppException.class.php';

    //Esta clase nos permitirá solicitar objetos ya almacenados para cuando haga falta usaarlos
    //desde el array Container añadiremos y solicitaremos

    class App{
        private static $container=[];
        
        public static function bind($clave,$valor){
        
            static::$container[$clave]=$valor;
        
        }
        
        public static function get(string $key){

            if(!array_key_exists($key,static::$container)){
                throw new AppException('No se ha encontrado la clave en el contenedor');
            }
        
            return static::$container[$key];
        }
        
        public static function getConnection(){//si la conexion no está creada, la crea para luego ser devuelta
            
            if(!array_key_exists('connection',static::$container)){
                static::$container['connection'] = Connection::make();
            }
            return static::$container['connection'];//se devuelve
        }
        
    }
?>