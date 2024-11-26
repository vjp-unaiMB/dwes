<?php
    require_once 'entity/queryBuilder.class.php';

    class MensajeRepository extends QueryBuilder{
        public function __construct(string $table='mensajes',string $classEntity='Mensaje'){
            parent:: __construct($table, $classEntity);
        }
    }
?>