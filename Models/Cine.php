<?php
    namespace Models;

    class Cine{

        private $id;
        private $nombre;
        private $direccion;
        private $capacidad;
        private $hor_apertura;
        private $hor_cierre;
        private $valor_entrada;

        function __construct (int $id = null, string $nombre = '', string $direccion, string $capacidad,  float $hor_apertura = '', float $hor_cierre = '', float $valor_entrada = ''){

          $this->id = $id;
          $this->nombre = $nombre;
          $this->direccion = $direccion;
          $this->capadidad = $capacidad;
          $this->hor_apertura = $hor_apertura;
          $this->hor_cierre = $hor_cierre;
          $this->valor_entrada = $valor_entrada;
        }

        
        public function getId()
        {
                return $this->id;
        }


        public function setId($id)
        {
                $this->id = $id;

        }

      
        public function getNombre()
        {
                return $this->nombre;
        }


        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

        }

        public function getDireccion()
        {
                return $this->direccion;
        }


        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;

        }

        /**
         * Get the value of hor_apertura
         */ 
        public function getHor_apertura()
        {
                return $this->hor_apertura;
        }

 
        public function setHor_apertura($hor_apertura)
        {
                $this->hor_apertura = $hor_apertura;

        }

        public function getHor_cierre()
        {
                return $this->hor_cierre;
        }

        public function setHor_cierre($hor_cierre)
        {
                $this->hor_cierre = $hor_cierre;

        }

       
        public function getValor_entrada()
        {
                return $this->valor_entrada;
        }

        public function setValor_entrada($valor_entrada)
        {
                $this->valor_entrada = $valor_entrada;
        }

        public function getCapacidad()
        {
                return $this->capacidad;
        }

        public function setCapacidad($capacidad)
        {
                $this->capacidad = $capacidad;

        }
    }

    

?>