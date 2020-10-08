<?php
    
    namespace Models;

    class Usuario
    {

        private $id;
        private $nombreYApellido;
        private $dni;
        private $email;
        private $password;
        private $fecha_nac;
        private $is_admin;

        public function __construct(int $id, String $nombreYApellido, String $dni, String $email, String $password, String $fecha_nac, $is_admin)
        {
            $this->id = $id;
            $this->nombreYApellido = $nombreYApellido;
            $this->dni = $dni;
            $this->email = $email;
            $this->password = $password;
            $this->fecha_nac = $fecha_nac;
            $this->is_admin = $is_admin; 
        }


        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getNombreYApellido()
        {
                return $this->nombreYApellido;
        }

        public function setNombreYApellido($nombreYApellido)
        {
                $this->nombreYApellido = $nombreYApellido;
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

        public function getIs_admin()
        {
                return $this->is_admin;
        }

        public function setIs_admin($is_admin)
        {
                $this->is_admin = $is_admin;
        }
    }



?>