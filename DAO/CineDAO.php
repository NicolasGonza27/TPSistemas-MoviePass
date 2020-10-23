<?php
    namespace DAO;

    use DAO\ICineDAO as ICineDAO;
    use Models\Cine as Cine;

    class CineDAO implements ICineDAO
    {
        private $cineList = array();
        private $fileName = ROOT."Data/cineList.json";

        public function Add(Cine $cine)
        {
            $this->RetrieveData();
            
            $cine->setId($this->GetNextId());
            
            array_push($this->cineList, $cine);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cineList;
        }

        public function Remove($id)
        {            
            $this->RetrieveData();
            
            $this->cineList = array_filter($this->cineList, function($cine) use($id){                
                return $cine->getId() != $id;
            });
            
            $this->SaveData();
        }

        public function Modify($id,Cine $newCine)
        {
            $this->RetrieveData();

            foreach($this->cineList as $key=>$cine)
            {
                if($cine->getId() == $id)
                {
                    $this->cineList[$key] = $newCine;

                    $this->SaveData();
                } 
            }
        }

        public function returnCine($id)
        {
            $this->RetrieveData();

            foreach($this->cineList as $key=>$cine)
            {
                if($cine->getId() == $id)
                {
                    return $cine;
                }
            }

            return false;
        }

        private function RetrieveData()
        {
            $this->cineList = array();

            if(file_exists($this->fileName))
            {
                $jsonToDecode = file_get_contents($this->fileName);

                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                
                foreach($contentArray as $content)
                {
                    
                    $id = $content["id"]; 
                    $nombre = $content["nombre"];
                    $calle = $content["calle"];
                    $numero = $content["numero"];
                    $capacidad = $content["capacidad"];
                    $hor_apertura = $content["hor_apertura"];
                    $hor_cierre = $content["hor_cierre"];
                    $valor_entrada = $content["valor_entrada"];
                    $cineObj = new Cine($id, $nombre, $calle, $numero, $capacidad ,$hor_apertura, $hor_cierre, $valor_entrada);
                    array_push($this->cineList, $cineObj);
                }
            }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cineList as $cine)
            {
                $valuesArray = array();
                $valuesArray["id"] = $cine->getId();
                $valuesArray["nombre"] = $cine->getNombre();
                $valuesArray["calle"] = $cine->getCalle();
                $valuesArray["numero"] = $cine->getNumero();
                $valuesArray["capacidad"] = $cine->getCapacidad();
                $valuesArray["hor_apertura"] = $cine->getHor_apertura();
                $valuesArray["hor_cierre"] = $cine->getHor_cierre();
                $valuesArray["valor_entrada"] = $cine->getValor_entrada();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->cineList as $cine)
            {
                $id = ($cine->getId() > $id) ? $cine->getId() : $id;
            }

            return $id + 1;
        }
    }
?>