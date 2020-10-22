<?php 


    namespace DAObd;

    use Models\Cine as Cine;
    use PDOException;

    class CineDAO
    {

        private $connection;
        private $tableName = "cines";

        public function Add(Cine $cine)
        {
            try 
            {
               $query = "INSERT INTO ".$this->tableName." (nombre_cine,calle,numero,hora_apertura,hora_cierre,valor_entrada) 
               VALUES (:nombre_cine, :calle, :numero, :hora_apertura, :hora_cierre, :valor_entrada);";

               $this->connection = Connection::GetInstance();

               $parameters["nombre_cine"] = $cine->getNombre();
               $parameters["calle"] = $cine->getCalle();
               $parameters["numero"] = $cine->getNumero();
               $parameters["hora_apertura"] = $cine->getHor_apertura();
               $parameters["hora_cierre"] = $cine->getHor_cierre();
               $parameters["valor_entrada"] = $cine->getValor_entrada();

               $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAll()
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                if($resultSet) 
                {
                    $newResultSet =  $this->mapear($resultSet);
                
                    return  $newResultSet;
                }

                return  false;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetOne($id_cine)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".id_cine = $:id_cine";

                $this->connection = Connection::GetInstance();

                $parameters['id_cine'] = $id_cine;

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    $newResultSet =  $this->mapear($resultSet);

                    return  $newResultSet[0];
                }

                return false;

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function Remove($id_cine)
        {     
            try 
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id_cine = :id_cine;";

                $this->connection = Connection::GetInstance();

                $parameters['id_cine'] = $id_cine;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                if($cantRows)
                {
                    return true;
                }
                else
                {
                    return false;
                }

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function Modify($id,Cine $newCine)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET nombre_cine = :nombre_cine, calle = :calle,numero = :numero, hora_apertura = :hora_apertura, hora_cierre = :hora_cierre, valor_entrada = :valor_entrada
                WHERE (id_cine = :id_cine);";

                $this->connection = Connection::GetInstance();

                $parameters["id_cine"] = $id;
                $parameters["nombre_cine"] = $newCine->getNombre();
                $parameters["calle"] = $newCine->getCalle();
                $parameters["numero"] = $newCine->getNumero();
                $parameters["hor_apertura"] = $newCine->getHor_apertura();
                $parameters["hor_cierre"] = $newCine->getHor_cierre();
                $parameters["valor_entrada"] = $newCine->getValor_entrada();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }   

        protected function mapear($cines)
        {
            $resp = array_map(function($p)
            {
                return new Cine($p['id_cine'],$p['nombre_cine'],$p['calle'],$p['numero'],0,$p['hora_apertura'],$p['hora_cierre'],$p['valor_entrada']);

            }, $cines);

            return $resp;
        }

    }



?>