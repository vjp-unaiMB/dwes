<?php
    require_once 'entity/queryBuilder.class.php';

    class PartnerRepository extends QueryBuilder{
        public function __construct(string $table='asociados',string $classEntity='Partner'){
            parent:: __construct($table, $classEntity);
        }
    }
?>