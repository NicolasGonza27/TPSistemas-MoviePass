<?php 

    namespace Models;

    class PoliticaDescuento
    {
        private $id_politica_descuento;
        private $porcentaje_descuento;
        private $dias_descuento;
        private $descripcion;

        public function __construct($id_politica_descuento,$porcentaje_descuento,$dias_descuento,$descripcion)
        {
            $this->id_politica_descuento = $id_politica_descuento;
            $this->porcentaje_descuento = $porcentaje_descuento;
            $this->dias_descuento = $dias_descuento;
            $this->descripcion = $descripcion;

        }

        public function getId_politica_descuento()
        {
                return $this->id_politica_descuento;
        }

        public function setId_politica_descuento($id_politica_descuento)
        {
                $this->id_politica_descuento = $id_politica_descuento;
        }

        public function getPorcentaje_descuento()
        {
                return $this->porcentaje_descuento;
        }

        public function setPorcentaje_descuento($porcentaje_descuento)
        {
                $this->porcentaje_descuento = $porcentaje_descuento;

                return $this;
        }

        public function getDias_descuento()
        {
                return $this->dias_descuento;
        }

        public function setDias_descuento($dias_descuento)
        {
                $this->dias_descuento = $dias_descuento;

                return $this;
        }

        public function getDescripcion()
        {
                return $this->descripcion;
        }

        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }
    }



?>