<?php
    namespace DAO;

    use Models\Sala as Sala;

    class SalaDAO 
    {
        private $salaList = array();
        private $fileName = ROOT."Data/salaList.json";

        public function Add(Sala $sala)
        {
            $this->RetrieveData();
            
            $sala->setId_sala($this->GetNextId());
            
            array_push($this->salaList, $sala);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->salaList;
        }

        public function Remove($id_sala)
        {            
            $this->RetrieveData();
            
            $this->salaList = array_filter($this->salaList, function($sala) use($id_sala){                
                return $sala->getId_sala() != $id_sala;
            });
            
            $this->SaveData();
        }

        public function Modify($id,Sala $newSala)
        {
            $this->RetrieveData();

            foreach($this->salaList as $key=>$sala)
            {
                if($sala->getId_sala() == $id)
                {
                    $this->salaList[$key] = $newSala;

                    $this->SaveData();
                } 
            }
        }

        private function RetrieveData()
        {
            $this->salaList = array();

            if(file_exists($this->fileName))
            {
                $jsonToDecode = file_get_contents($this->fileName);

                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                
                foreach($contentArray as $content)
                {
                    
                    $id_sala = $content["id_sala"]; 
                    $id_cine = $content["id_cine"];
                    $numero_sala = $content["numero_sala"];
                    $nombre_sala = $content["nombre_sala"];
                    $cant_butacas = $content["cant_butacas"];
                    $salaObj = new Sala($id_sala,$id_cine, $numero_sala, $nombre_sala, $cant_butacas);
                    array_push($this->salaList, $salaObj);
                }
            }

            
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->salaList as $sala)
            {
                $valuesArray = array();
                $valuesArray["id_sala"] = $sala->getId_sala();
                $valuesArray["id_funcion"] = $sala->getId_funcion();
                $valuesArray["numero_sala"] = $sala->getNumero_sala();
                $valuesArray["nombre_sala"] = $sala->getNombre_sala();
                $valuesArray["cant_butacas"] = $sala->getCant_butacas();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->salaList as $sala)
            {
                $id= ($sala->getId_sala() > $id) ? $sala->getId_sala() : $id;
            }

            return $id + 1;
        }
    }
?>