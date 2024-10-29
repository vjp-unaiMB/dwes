<?php
    function esOpcionMenuActiva($nombre):bool{
        if( $nombre === $_SERVER['REQUEST_URI']){
            return true;
        }else{
            return false;
        }
    }

    function existeOpcionActivaEnArray($array){
        for($i = 0 ; $i < count($array) ; $i++){
            if(esOpcionMenuActiva($array[$i])){
                return true;
            }
        }
    }
?>