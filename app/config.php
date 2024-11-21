<?php
    return[
        'database'=>[
            'name'=>'proyecto',
            'username'=>'userProyecto',
            'password'=>'unai2003',
            'connection'=>'mysql:host=dwes.local', //localhost | dwes.local
            'options'=>[
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true
            ]
    ]

]?>