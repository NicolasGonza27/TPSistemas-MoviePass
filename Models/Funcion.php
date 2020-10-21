<?php 

    namespace Models;

    class Funcion
    {
        private $id_funcion;
        private $id_pelicula;
        private $id_sala;
        private $cant_asistentes;
        private $fecha_hora;

        public function __construct($id_funcion,$id_pelicula,$id_sala,$cant_asistentes,$fecha_hora)
        {
            $this->id_funcion = $id_funcion;
            $this->id_pelicula = $id_pelicula;
            $this->id_sala = $id_sala;
            $this->cant_asistentes = $cant_asistentes;
            $this->fecha_hora = $fecha_hora;
        }

        public function getId_funcion()
        {
                return $this->id_funcion;
        }
 
        public function setId_funcion($id_funcion)
        {
                $this->id_funcion = $id_funcion;
        }

        public function getId_pelicula()
        {
                return $this->id_pelicula;
        }

        public function setId_pelicula($id_pelicula)
        {
                $this->id_pelicula = $id_pelicula;
        }

        public function getId_sala()
        {
                return $this->id_sala;
        }

        public function setId_sala($id_sala)
        {
                $this->id_sala = $id_sala;
        }

        public function getCant_asistentes()
        {
                return $this->cant_asistentes;
        }

        public function setCant_asistentes($cant_asistentes)
        {
                $this->cant_asistentes = $cant_asistentes;
        }

        public function getFecha_hora()
        {
                return $this->fecha_hora;
        }

        public function setFecha_hora($fecha_hora)
        {
                $this->fecha_hora = $fecha_hora;
        }
        
    }
?>