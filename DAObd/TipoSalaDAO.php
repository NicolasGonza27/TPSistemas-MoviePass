<?php 

    namespace DAObd;

use PDOException;
use Models\TipoSala as TipoSala;

class TipoSalaDAO
    {
        private $connection;
        private $tableName = "tipos_sala";
    
        public function Add(TipoSala $tipoSala)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName."(nombre_tipo_sala,eliminado) VALUES (:nombre_tipo_sala,:eliminado);";
               
                $parameters["nombre_tipo_sala"] = $tipoSala->getNombre_tipo_sala();
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
                $query = "SELECT * FROM ".$this->tableName." WHERE eliminado = :eliminado";

                $parameters["eliminado"] = $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                if($resultSet)
                {
                    $newResultSet = $this->mapear($resultSet);
                
                    return  $newResultSet;
                }

                return  false;

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetOne($id_tipo_sala)
            {
                try 
                {
                    $query = "SELECT * FROM ".$this->tableName." WHERE (id_tipo_sala = :id_tipo_sala);";
    
                    $this->connection = Connection::GetInstance();
                    
                    $parameters['id_tipo_sala'] = $id_tipo_sala;

                    $resultSet = $this->connection->Execute($query,$parameters);
    
                    if($resultSet)
                    {
                        $newResultSet = $this->mapear($resultSet);
                    
                        return  $newResultSet[0];
                    }
                    
                    return false;
    
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            }

        
            public function Remove($id_tipo_sala)
            {  
                try 
                {
                    $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado  WHERE id_tipo_sala = :id_tipo_sala;";

                    $this->connection = Connection::GetInstance();

                    $parameters['eliminado'] = true;
                    $parameters['id_tipo_sala'] = $id_tipo_sala;

                    $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                    return $cantRows;

                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            }

            public function Modify($id_sala,TipoSala $newTipoSala)
            {
                try
                {
                    $query = "UPDATE ".$this->tableName." SET nombre_tipo_sala = :nombre_tipo_sala WHERE (id_tipo_sala = :id_tipo_sala);";

                    $this->connection = Connection::GetInstance();

                    $parameters["id_tipo_sala"] = $id_sala;
                    $parameters["nombre_tipo_sala"] = $newTipoSala->getNombre_tipo_sala();

                    $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                    return  $cantRows;

                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            }
    
        protected function mapear($tiposSalas)
            {   
                $resp = array_map(function($p)
            {
                return new TipoSala($p['id_tipo_sala'],$p['nombre_tipo_sala']);
            }, $tiposSalas);

            return $resp;
            }

    }




?>