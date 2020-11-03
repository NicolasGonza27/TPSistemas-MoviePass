<?php 

    namespace Models;

    class PoliticaDescuento
    {
        private $id_politica_descuento;
        private $porcentaje_descuento;
        private $dias_descuento = array();
        private $descripcion;

        public function __construct($id_politica_descuento = null,$porcentaje_descuento,$dias_descuento = null,$descripcion)
        {
            $this->id_politica_descuento = $id_politica_descuento;
            $this->porcentaje_descuento = $this->check_porcentaje_descuento($porcentaje_descuento);
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

        public function Get_Dias_descuento()
        {
                return $this->dias_descuento;
        }

        public function Add_Dia_descuento(int $dia)
        {
                if($this->check_dia_descuento($dia))
                {
                    array_push($this->dias_descuento,$dia);
                }
                
                return false;
        }

        public function getDescripcion()
        {
                return $this->descripcion;
        }

        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;
        }
    
        public function check_dia_descuento($dia)
        {
                if( ($dia >= 0) && ($dia <= 6) ) 
                {
                        if(!in_array($dia,$this->dias_descuento))
                        {
                                return true;
                        }
                }
                
                return false;
        }

        public function check_porcentaje_descuento($descuento)
        {
                if( ($descuento >= 0) && ($descuento <=100) )
                {
                        return $descuento;
                }
                else 
                {
                        return 0;
                }
        }

    }



?>