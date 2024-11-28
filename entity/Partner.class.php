<?php
    require_once __DIR__ . '/../database/IEntity.class.php';
    
    class Partner implements IEntity{

        const RUTA_LOGOS ='images/logo/';

        private $nombre;
        private $logo;
        private $descripcion;
        private $id;

        public function __construct( $nombre="", $logo="", $descripcion=""){ //pondemos valores vacíos por defecto porque la clase FindAll de QueryBuilder usamos
            $this->id= null;                                                 //la sentencia "PDO::FETCH_CLASS" Eso hace que intente instanciarel objeto de tipo Partner antes de leer el propio formulario
            $this->nombre = $nombre;
            $this->logo = $logo;
            $this->descripcion = $descripcion;
        }

        public function toArray(): array{
            return[
                'id'=>$this->getId(),
                'nombre'=>$this->getNombre(),
                'logo'=>$this->getLogo(),
                'descripcion'=>$this->getDescripcion()
            ];
        }

        //Getters
        public function getNombre() {
            return $this->nombre;
        }

        public function getLogo() {
            return $this->logo;
        }

        public function getDescripcion() {
            return $this->descripcion;
        }

        public function getId() {
            return $this->id;
        }
        public function getUrlLOGOS():string {
            return self::RUTA_LOGOS.$this->getNombre(); 
        }
        //Setters
    
        public function setNombre( $nombre): void {
            $this->nombre = $nombre;
        }

        public function setLogo( $logo): void {
            $this->logo = $logo;
        }

        public function setDescripcion( $descripcion): void {
            $this->descripcion = $descripcion;
        }

        public function setId( $id): void {
            $this->id = $id;
        }
    }
?>