<?php
    
    namespace Models;

    class Usuario
    {

        private $id_usuario;
        private $id_tipo_usuario;
        private $nombre_usuario;
        private $apellido_usuario;
        private $dni;
        private $email;
        private $password;
        private $fecha_nac;
        
        public function __construct($id_usuario = null,$id_tipo_usuario,$nombre_usuario,$apellido_usuario,$dni,$email,$password,$fecha_nac)
        {
                $this->id_usuario = $id_usuario;
                $this->id_tipo_usuario = $id_tipo_usuario;
                $this->nombre_usuario = $nombre_usuario;
                $this->apellido_usuario = $apellido_usuario;
                $this->dni = $dni;
                $this->email = $email;
                $this->password = $password; 
                $this->fecha_nac = $fecha_nac; 
        }


        public function getId_usuario()
        {
                return $this->id_usuario;
        }

        public function setId_usuario($id_usuario)
        {
                $this->id_usuario = $id_usuario;
        }

        public function getId_tipo_usuario()
        {
                return $this->id_tipo_usuario;
        }

        public function setId_tipo_usuario($id_tipo_usuario)
        {
                $this->id_tipo_usuario = $id_tipo_usuario;
        }

        public function getNombre_usuario()
        {
                return $this->nombre_usuario;
        }

        public function setNombre_usuario($nombre_usuario)
        {
                $this->nombre_usuario = $nombre_usuario;
        }

        public function getApellido_usuario()
        {
                return $this->apellido_usuario;
        }

        public function setApellido_usuario($apellido_usuario)
        {
                $this->apellido_usuario = $apellido_usuario;
        }

        public function getDni()
        {
                return $this->dni;
        }

        public function setDni($dni)
        {
                $this->dni = $dni;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;
        }

        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                $this->password = $password;
        }

        public function getFecha_nac()
        {
                return $this->fecha_nac;
        }

        public function setFecha_nac($fecha_nac)
        {
                $this->fecha_nac = $fecha_nac;
        }
        


        }


      



?>