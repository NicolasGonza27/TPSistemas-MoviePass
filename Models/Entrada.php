<?php 

    namespace Models;

    class Entrada
    {
        private $id_entrada;
        private $id_compra;
        private $id_funcion;
        private $nro_entrada;
        

        public function __construct($id_entrada, $id_compra,$id_funcion,$nro_entrada)
        {
            $this->id_entrada = $id_entrada;
            $this->id_compra = $id_compra;
            $this->id_funcion = $id_funcion;
            $this->nro_entrada = $nro_entrada;

        }

        public function getId_entrada()
        {
                return $this->id_entrada;
        }

        public function setId_entrada($id_entrada)
        {
                $this->id_entrada = $id_entrada;
        }

        public function getId_compra()
        {
                return $this->id_compra;
        }

        public function setId_compra($id_compra)
        {
                $this->id_compra = $id_compra;
        }

        public function getId_funcion()
        {
                return $this->id_funcion;
        }

        public function setId_funcion($id_funcion)
        {
                $this->id_funcion = $id_funcion;
        }

        public function getNro_entrada()
        {
                return $this->nro_entrada;
        }

        public function setNro_entrada($nro_entrada)
        {
                $this->nro_entrada = $nro_entrada;
        }
        
    }



?>