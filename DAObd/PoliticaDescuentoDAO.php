<?php 

    namespace DAObd;

    use Models\PoliticaDescuento as PoliticaDescuento;
    use PDOException;

    class PoliticaDescuentoDAO
    {

        private $connection;
        private $tableName = "politicas_descuento";


        public function Add(PoliticaDescuento $politicaDescuento)
        {
            try 
            {
               $query = "INSERT INTO politicas_descuento (porcentaje_descuento,descripcion,eliminado) VALUES (:porcentaje_descuento,:descripcion,:eliminado);";

               $parameters["porcentaje_descuento"] = $politicaDescuento->getPorcentaje_descuento();
               $parameters["descripcion"] = $politicaDescuento->getDescripcion();
               $parameters["eliminado"] = false;
               
               $dias_descuento = $politicaDescuento->Get_Dias_descuento();

               $this->connection = Connection::GetInstance();

               $this->connection->ExecuteNonQuery($query,$parameters);

               foreach($dias_descuento as $dia)
               {
                   
                   try
                   {
                        $query = "INSERT INTO politica_de_descuento_x_dia (id_politica_descuento,dia_de_la_semana,eliminado) VALUES (:id_politica_descuento,:dia_de_la_semana,:eliminado);";

                        $parametersTwo["id_politica_descuento"] = $this->GetLastIdPoliticaDescuento();
                        $parametersTwo["dia_de_la_semana"] = $dia;
                        $parametersTwo["eliminado"] = false;

                        $this->connection = Connection::GetInstance();

                        $this->connection->ExecuteNonQuery($query,$parametersTwo);
         
                   }
                   catch(PDOException $e)
                   {
                        throw new PDOException($e->getMessage());
                   }
                   
               } 

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAll(bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE eliminado = :eliminado;";

                $parameters["eliminado"] = $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    $newResultSet =  $this->mapear($resultSet);
                
                    return  $newResultSet;
                }

                return  false;
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetDaysOfPoliticaDescuento($id_politica_descuento, $eliminado = false)
        {
            try
            {
                $query = "SELECT dia_de_la_semana FROM politica_de_descuento_x_dia WHERE (eliminado = :eliminado) AND (id_politica_descuento = :id_politica_descuento);";

                $parameters["id_politica_descuento"] = $id_politica_descuento;
                $parameters["eliminado"] = $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                $newResultSet = array();

                foreach($resultSet as $result)
                {
                    array_push($newResultSet,$result["dia_de_la_semana"]);
                }

                return $newResultSet;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }

        }

        public function GetOnePorcentajeDeDescuentoPorDia($dia_de_la_semana)
        {
            try 
            {
                $query = "SELECT
                p_d.id_politica_descuento AS id_politica_descuento,
                p_dxdia.dia_de_la_semana AS dia_de_la_semana, 
                p_d.porcentaje_descuento AS porcentaje_descuento
                FROM
                politicas_descuento p_d
                INNER JOIN politica_de_descuento_x_dia p_dxdia
                ON p_d.id_politica_descuento = p_dxdia.id_politica_descuento
                WHERE p_dxdia.dia_de_la_semana = :dia_de_la_semana;";

                $parameters["dia_de_la_semana"] = $dia_de_la_semana;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    return  $resultSet[0];
                }

                return  array();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }


        public function GetOne($id_politica_descuento)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE id_politica_descuento = :id_politica_descuento";

                $this->connection = Connection::GetInstance();

                $parameters['id_entrada'] = $id_politica_descuento;

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
                throw new PDOException($e->getMessage());
            }
        }

        public function GetLastIdPoliticaDescuento()
        {
            try 
            {
                $query = "SELECT max(id_politica_descuento) as maximo_id FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if($resultSet["0"]["maximo_id"])
                {
                    return $resultSet["0"]["maximo_id"];
                }
                else
                {
                    return false;
                }
                
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function Remove($id_politica_descuento)
        {     
            try 
            {

                $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado
                WHERE (id_politica_descuento = :id_politica_descuento);";

                $this->connection = Connection::GetInstance();

                $parameters['id_politica_descuento'] = $id_politica_descuento;
                $parameters['eliminado'] = true;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }
        
        protected function mapear($politicasDescuento)
        {
            $resp = array_map(function($p)
            {
                return new PoliticaDescuento($p['id_politica_descuento'],$p['porcentaje_descuento'],$this->GetDaysOfPoliticaDescuento($p['id_politica_descuento']),$p['descripcion']);
            }, $politicasDescuento);

            return $resp;
        }

    }


?>