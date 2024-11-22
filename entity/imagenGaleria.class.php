<?php
    require_once 'database/IEntity.class.php';
    class imagenGaleria implements IEntity {

        const RUTA_IMAGENES_PORTFOLIO='images/index/portfolio/';
        const RUTA_IMAGENES_GALLERY='images/index/gallery/';
        private $id;
        private $nombre;
        private $descripcion;   
        private $numVisualizaciones;
        private $numLikes;
        private $numDownloads;
        private $categoria;

        public function __construct(string $nombre = '', string $descripcion = '', int $numVisualizaciones = 0, int $numLikes = 0,int $numDownloads = 0,int $categoria=0)
        {
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->numVisualizaciones = $numVisualizaciones;
            $this->numLikes = $numLikes;
            $this->numDownloads = $numDownloads;
            $this->id = null;
            $this->categoria= $categoria;
        }

        public function getId() {
            return $this->id;
        }
        public function getNombre() {
            return $this->nombre;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function getNumVisualizaciones() {
            return $this->numVisualizaciones;
        }
        public function getNumLikes() {
            return $this->numLikes;
        }  
        public function getNumDownloads() {
            return $this->numDownloads;
        }
        public function getUrlPortfolio():string{
            return self::RUTA_IMAGENES_PORTFOLIO.$this->getNombre();
        }
        public function getUrlGallery():string{
            return self::RUTA_IMAGENES_GALLERY.$this->getNombre();
        }
        public function getCategoria(){
            return $this->categoria;
        }        

        public function toArray():array{
            return[
                'id' => $this->getId(),
                'nombre' => $this->getNombre(),
                'descripcion' => $this->getDescripcion(),
                'numVisualizaciones' => $this->getNumVisualizaciones(),
                'numLikes'=> $this->getNumLikes(),
                'numDownloads' => $this->getNumDownloads(),
                'categoria' => $this->getCategoria()
            ];
        }
    }
?>