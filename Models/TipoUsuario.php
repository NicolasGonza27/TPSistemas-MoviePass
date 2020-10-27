<?php
    
    namespace Models;

    class TipoUsuario
    {
        private $id_tipo_usuario;
        private $nombre_tipo_usuario;

        public function __construct($id_tipo_usuario = null,$nombre_tipo_usuario)
        {
            $this->id_tipo_usuario = $id_tipo_usuario;
            $this->nombre_tipo_usuario = $nombre_tipo_usuario;
        }

        public function getId_tipo_usuario()
        {
                return $this->id_tipo_usuario;
        }

        public function setId_tipo_usuario($id_tipo_usuario)
        {
                $this->id_tipo_usuario = $id_tipo_usuario;

                return $this;
        }

        public function getNombre_tipo_usuario()
        {
                return $this->nombre_tipo_usuario;
        }

        public function setNombre_tipo_usuario($nombre_tipo_usuario)
        {
                $this->nombre_tipo_usuario = $nombre_tipo_usuario;

                return $this;
        }
    }

?>