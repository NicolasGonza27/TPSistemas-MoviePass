<?php
    namespace Models;

    class Cine{

        private $id;
        private $nombre;
        private $calle;
        private $numero;
        private $capacidad;
        private $hor_apertura;
        private $hor_cierre;
        private $valor_entrada;

        function __construct ($id = null, $nombre = '', $calle = '', $numero  = '' , $capacidad = '', $hor_apertura = null, $hor_cierre = null, $valor_entrada = null){

          $this->id = $id;
          $this->nombre = $nombre;
          $this->calle = $calle;
          $this->numero = $numero;
          $this->capacidad = $capacidad;
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

                /**
         * Get the value of calle
         */ 
        public function getCalle()
        {
                return $this->calle;
        }

        /**
         * Set the value of calle
         *
         * @return  self
         */ 
        public function setCalle($calle)
        {
                $this->calle = $calle;

                return $this;
        }

        /**
         * Get the value of numero
         */ 
        public function getNumero()
        {
                return $this->numero;
        }

        /**
         * Set the value of numero
         *
         * @return  self
         */ 
        public function setNumero($numero)
        {
                $this->numero = $numero;

                return $this;
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