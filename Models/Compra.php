<?php 

    namespace Models;

    class Compra
    {
        private $id_compra;
        private $id_usuario;
        private $id_polica_usuario;
        private $cant_entradas;
        private $monto;

        public function __construct($id_compra,$id_usuario,$id_polica_usuario,$cant_entradas,$monto)
        {
            $this->id_compra = $id_compra;
            $this->id_usuario = $id_usuario;
            $this->id_polica_usuario = $id_polica_usuario;
            $this->cant_entradas = $cant_entradas;
            $this->monto = $monto;
        }

        public function getId_compra()
        {
                return $this->id_compra;
        }

        public function setId_compra($id_compra)
        {
                $this->id_compra = $id_compra;

                return $this;
        }

        public function getId_usuario()
        {
                return $this->id_usuario;
        }

        public function setId_usuario($id_usuario)
        {
                $this->id_usuario = $id_usuario;

                return $this;
        }

        public function getId_polica_usuario()
        {
                return $this->id_polica_usuario;
        }

        public function setId_polica_usuario($id_polica_usuario)
        {
                $this->id_polica_usuario = $id_polica_usuario;

                return $this;
        }

        public function getCant_entradas()
        {
                return $this->cant_entradas;
        }

        public function setCant_entradas($cant_entradas)
        {
                $this->cant_entradas = $cant_entradas;

                return $this;
        }

        public function getMonto()
        {
                return $this->monto;
        }

        public function setMonto($monto)
        {
                $this->monto = $monto;

                return $this;
        }

    }

?>