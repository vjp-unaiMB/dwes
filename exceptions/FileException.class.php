<?php
    class FileException extends Exception {
        public function __contruct(string $mensaje){
            parent ::__construct( $mensaje );
        }
    }
?>