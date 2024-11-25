<?php
    //Esta interfaz obligará a nuestras entidades a incorporar una función toArray que devuelva los datos de cada entidad en un array. 
    interface IEntity{
        public function toArray():array;
    }

?>