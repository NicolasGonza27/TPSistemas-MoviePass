<?php 

    namespace Models;

    class TipoSala
    {

        private $id_tipo_sala;
        private $nombre_tipo_sala;

        public function __construct($id_tipo_sala, $nombre_tipo_sala)
        {
            $this->id_tipo_sala = $id_tipo_sala;
            $this->nombre_tipo_sala = $nombre_tipo_sala;
        }


        public function getId_tipo_sala()
        {
                return $this->id_tipo_sala;
        }

        
        public function setId_tipo_sala($id_tipo_sala)
        {
                $this->id_tipo_sala = $id_tipo_sala;
        }

        public function getNombre_tipo_sala()
        {
                return $this->nombre_tipo_sala;
        }

        public function setNombre_tipo_sala($nombre_tipo_sala)
        {
                $this->nombre_tipo_sala = $nombre_tipo_sala;
        }

    }




?>