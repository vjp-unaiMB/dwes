<?php
    class Asociado{

    private $nombre;
    private $logo;
    private $descripcion;

    public function __construct($nombre, $logo, $descripcion){

        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;

    }
}
?>