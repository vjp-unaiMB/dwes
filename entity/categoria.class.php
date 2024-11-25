<?php
    require_once __DIR__ . '/../database/IEntity.class.php';
    
    class Categoria implements IEntity{
        private $id;
        private $nombre;
        private $numImagenes;

        public function __construct(string $nombre='',int $numImagenes=0)
        {
            $this->nombre = $nombre;
            $this->numImagenes = $numImagenes;
        }

        public function getId():int {
            return $this->id;
        }

        public function getNombre():string {
            return $this->nombre;
        }

        public function getNumImagenes():int {
            return $this->numImagenes;
        }

        public function setId( $id): void {
            $this->id = $id;
        }

        public function setNombre( $nombre): void {
            $this->nombre = $nombre;
        }

        public function setNumImagenes( $numImagenes): void {
            $this->numImagenes = $numImagenes;
        }

        public function toArray(): array{
            return [
                'id'=> $this->getId(),
                'nombre'=> $this->getNombre(),
                'numImagenes'=> $this->getNumImagenes()
            ];
        }
    }
?>