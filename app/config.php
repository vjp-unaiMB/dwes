<?php
    //Archivo en el que proporcionamos los parámetros de conexión mediante una llamada a este
    return[
        'database'=>[
            'name'=>'proyecto',
            'username'=>'userProyecto',
            'password'=>'userProyecto',
            'connection'=>'mysql:host=localhost', //localhost | dwes.local
            'options'=> [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT=>true
            ]
        ]
    ];
?>