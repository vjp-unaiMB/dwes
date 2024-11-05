<?php
    class QuearyException extends Exception{
        public function __construct(string $mensaje){
            parent::__construct($mensaje);
        }
    }
?>
