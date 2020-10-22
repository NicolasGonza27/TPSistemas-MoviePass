<?php
    namespace DAO;

    use Models\Funcion as Funcion;

    class FuncionDAO 
    {
        private $funcionList = array();
        private $fileName = ROOT."Data/funcionList.json";

        public function Add(Funcion $funcion)
        {
            $this->RetrieveData();
            
            $funcion->setId_funcion($this->GetNextId());
            
            array_push($this->funcionList, $funcion);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->funcionList;
        }

        public function Remove($id_funcion)
        {            
            $this->RetrieveData();
            
            $this->funcionList = array_filter($this->funcionList, function($funcion) use($id_funcion){                
                return $funcion->getId_funcion() != $id_funcion;
            });
            
            $this->SaveData();
        }

        public function Modify($id,Funcion $newFuncion)
        {
            $this->RetrieveData();

            foreach($this->funcionList as $key=>$funcion)
            {
                if($funcion->getId_funcion() == $id)
                {
                    $this->funcionList[$key] = $newFuncion;

                    $this->SaveData();
                } 
            }
        }

        public function returnFuncionXidPelicula($idMovie)
        {
            $this->RetrieveData();
            $funcionListXid = array();

            foreach($this->funcionList as $key=>$funcion)
            {
                if($funcion->getId_pelicula() == $idMovie)
                {
                    array_push($funcionListXid,$funcion);
                }
            }

            return $funcionListXid;
        }

        private function RetrieveData()
        {
            $this->funcionList = array();

            if(file_exists($this->fileName))
            {
                $jsonToDecode = file_get_contents($this->fileName);

                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                
                foreach($contentArray as $content)
                {
                    
                    $id_funcion = $content["id_funcion"]; 
                    $id_pelicula = $content["id_pelicula"];
                    $id_sala = $content["id_sala"];
                    $cant_asistentes = $content["cant_asistentes"];
                    $fecha_hora = $content["fecha_hora"];
                    $funcionObj = new Funcion($id_funcion,$id_pelicula, $id_sala, $cant_asistentes, $fecha_hora);
                    array_push($this->funcionList, $funcionObj);
                }
            }

            
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->funcionList as $funcion)
            {
                $valuesArray = array();
                $valuesArray["id_funcion"] = $funcion->getId_funcion();
                $valuesArray["id_sala"] = $funcion->getId_sala();
                $valuesArray["id_pelicula"] = $funcion->getId_pelicula();
                $valuesArray["cant_asistentes"] = $funcion->getCant_asistentes();
                $valuesArray["fecha_hora"] = $funcion->getFecha_hora();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->funcionList as $funcion)
            {
                $id= ($funcion->getId_funcion() > $id) ? $funcion->getId_funcion() : $id;
            }

            return $id + 1;
        }
    }
?>