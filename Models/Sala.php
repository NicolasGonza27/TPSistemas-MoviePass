<?php 

    namespace Models;

    class Sala
    {
        private $id_sala;
        private $id_tipo_sala;
        private $id_cine;
        private $numero_sala;
        private $nombre_sala;
        private $cant_butacas;

        public function __construct($id_sala = null,$id_tipo_sala,$id_cine,$numero_sala,$nombre_sala,$cant_butacas)
        {
            $this->id_sala = $id_sala;
            $this->id_tipo_sala = $id_tipo_sala;
            $this->id_cine = $id_cine;
            $this->numero_sala = $numero_sala;
            $this->nombre_sala = $nombre_sala;
            $this->cant_butacas = $cant_butacas;
        }


        public function getId_sala()
        {
                return $this->id_sala;
        }

        public function setId_sala($id_sala)
        {
                $this->id_sala = $id_sala;
        }

        public function getId_tipo_sala()
        {
                return $this->id_tipo_sala;
        }
 
        public function setId_tipo_sala($id_tipo_sala)
        {
                $this->id_tipo_sala = $id_tipo_sala;
        } 

        public function getId_cine()
        {
                return $this->id_cine;
        }

        public function setId_cine($id_cine)
        {
                $this->id_cine = $id_cine;
        }

        public function getNumero_sala()
        {
                return $this->numero_sala;
        }

        public function setNumero_sala($numero_sala)
        {
                $this->numero_sala = $numero_sala;
        }

        public function getNombre_sala()
        {
                return $this->nombre_sala;
        }

        public function setNombre_sala($nombre_sala)
        {
                $this->nombre_sala = $nombre_sala;
        }

        public function getCant_butacas()
        {
                return $this->cant_butacas;
        }
 
        public function setCant_butacas($cant_butacas)
        {
                $this->cant_butacas = $cant_butacas;
        }

    }
    
?>