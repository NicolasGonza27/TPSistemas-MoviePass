<?php 

    namespace Models;

    class Compra
    {
        private $id_compra;
        private $id_usuario;
        private $id_politica_descuento;
        private $cant_entradas;
        private $monto;
        private $fecha_compra;

        public function __construct($id_compra,$id_usuario,$id_politica_descuento,$cant_entradas,$monto,$fecha_compra)
        {
            $this->id_compra = $id_compra;
            $this->id_usuario = $id_usuario;
            $this->id_politica_descuento = $id_politica_descuento;
            $this->cant_entradas = $cant_entradas;
            $this->monto = $monto;
            $this->fecha_compra = $fecha_compra;
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

        public function getId_politica_descuento()
        {
                return $this->id_politica_descuento;
        }

        public function setId_politica_descuento($id_politica_descuento)
        {
                $this->id_politica_descuento = $id_politica_descuento;

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

        public function getFecha_compra()
        {
                return $this->fecha_compra;
        }

        public function setFecha_compra($fecha_compra)
        {
                $this->fecha_compra = $fecha_compra;

                return $this;
        }

    }

?>