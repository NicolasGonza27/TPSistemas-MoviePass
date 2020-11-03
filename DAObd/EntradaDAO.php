<?php 

    namespace DAObd;

    use Models\Entrada as Entrada;
    use PDOException;

    class EntradaDAO
    {

        private $connection;
        private $tableName = "entradas";


        public function Add(Entrada $entrada)
        {
            try 
            {
               $query = "INSERT INTO entradas (id_compra,id_funcion,nro_entrada,eliminado) VALUES (:id_compra,:id_funcion,:nro_entrada,:eliminado);";

               $parameters["id_compra"] = $entrada->getId_compra();
               $parameters["id_funcion"] = $entrada->getId_funcion();
               $parameters["nro_entrada"] = $entrada->getNro_entrada();
               $parameters["eliminado"] = false;
               
               $this->connection = Connection::GetInstance();

               return $this->connection->ExecuteNonQuery($query,$parameters);

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
                echo $e->getMessage();
            }
        }

        public function GetOne($id_entrada)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".id_entrada = :id_entrada";

                $this->connection = Connection::GetInstance();

                $parameters['id_entrada'] = $id_entrada;

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

        public function Remove($id_entrada)
        {     
            try 
            {

                $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado
                WHERE (id_entrada = :id_entrada);";

                $this->connection = Connection::GetInstance();

                $parameters['id_entrada'] = $id_entrada;
                $parameters['eliminado'] = true;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;
            

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function Modify($id,Entrada $newEntrada)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET id_compra = :id_compra, id_funcion = :id_funcion, nro_entrada = :nro_entrada, hora_apertura = :hora_apertura, hora_cierre = :hora_cierre, valor_entrada = :valor_entrada
                WHERE (id_entrada = :id_entrada);";

                $this->connection = Connection::GetInstance();

                $parameters["id_compra"] = $newEntrada->getId_compra();
                $parameters["id_funcion"] = $newEntrada->getId_funcion();
                $parameters["nro_entrada"] = $newEntrada->getNro_entrada();
                $parameters["id_entrada"] = $id;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }   

        protected function mapear($entradas)
        {
            $resp = array_map(function($p)
            {
                return new Entrada($p['id_entrada'],$p['id_compra'],$p['id_funcion'],$p['nro_entrada']);
            }, $entradas);

            return $resp;
        }

    }


?>