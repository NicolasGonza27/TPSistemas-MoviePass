<?php

    namespace DAObd;

    use DAObd\Connection as Connection;
    use Models\Sala as Sala;
    use PDOException;

    class SalaDAO
        {   
            private $connection;
            private $tableName = "salas";

            public function Add(Sala $sala)
            {
                try
                {
                    $query = "INSERT INTO ".$this->tableName." (id_tipo_sala,id_cine,numero_sala,nombre_sala,cant_butacas) VALUES (:id_tipo_sala,:id_cine,:numero_sala,:nombre_sala,:cant_butacas);";

                    $parameters["id_tipo_sala"] = $sala->getId_tipo_sala();
                    $parameters["id_cine"] = $sala->getId_cine();
                    $parameters["numero_sala"] = $sala->getNumero_sala();
                    $parameters["nombre_sala"] = $sala->getNombre_sala();
                    $parameters["cant_butacas"] = $sala->getCant_butacas();
     
                    $this->connection = Connection::GetInstance();
            
                    return $this->connection->ExecuteNonQuery($query,$parameters);

                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            }

            public function GetAllByCine($idCine, bool $eliminado = false)
            {
                try 
                {
                    $query = "SELECT id_sala,id_tipo_sala,id_cine,numero_sala,nombre_sala,cant_butacas FROM ".$this->tableName." WHERE (id_cine = :id_cine) AND (eliminado = :eliminado);";
    
                    $this->connection = Connection::GetInstance();
    
                    $parameters['id_cine'] = $idCine;
                    $parameters['eliminado'] = $eliminado;

                    $resultSet = $this->connection->Execute($query,$parameters);
                    
                    if($resultSet)
                    {
                        $newResultSet = $this->mapear($resultSet);
                    
                        return  $newResultSet;
                    }

                    return  array();
    
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            }

            public function GetLastSalaNumberByCine($idCine, bool $eliminado = false)
            {
                try 
                {
                    $query = "SELECT max(numero_sala) as maximo_id FROM ".$this->tableName." WHERE (id_cine = :id_cine);";
    
                    $this->connection = Connection::GetInstance();
    
                    $parameters['id_cine'] = $idCine;

                    $resultSet = $this->connection->Execute($query,$parameters);
                    
                    if($resultSet["0"]["maximo_id"])
                    {
                        return $resultSet["0"]["maximo_id"];
                    }
                    else
                    {
                        return 0;
                    }
                    
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            }

            public function GetOne($id_sala)
            {
                try 
                {
                    $query = "SELECT id_sala,id_tipo_sala,id_cine,numero_sala,nombre_sala,cant_butacas FROM ".$this->tableName." WHERE (id_sala = :id_sala);";
    
                    $this->connection = Connection::GetInstance();
                    
                    $parameters['id_sala'] = $id_sala;

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

            public function Remove($id_sala)
            {  
                try 
                {
                    $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado  WHERE id_sala = :id_sala;";

                    $this->connection = Connection::GetInstance();

                    $parameters['eliminado'] = true;
                    $parameters['id_sala'] = $id_sala;

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

            public function Modify($id_sala,Sala $newSala)
            {
                try
                {
                    $query = "UPDATE ".$this->tableName." SET id_tipo_sala = :id_tipo_sala ,id_cine = :id_cine, numero_sala = :numero_sala, nombre_sala  = :nombre_sala, cant_butacas = :cant_butacas
                    WHERE (id_sala = :id_sala);";

                    $this->connection = Connection::GetInstance();

                    $parameters["id_sala"] = $id_sala;
                    $parameters["id_tipo_sala"] = $newSala->getId_tipo_sala();
                    $parameters["id_cine"] = $newSala->getId_cine();
                    $parameters["numero_sala"] = $newSala->getNumero_sala();
                    $parameters["nombre_sala"] = $newSala->getNombre_sala();
                    $parameters["cant_butacas"] = $newSala->getCant_butacas();

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

            protected function mapear($salas)
            {   
                $resp = array_map(function($p)
            {
                return new Sala($p['id_sala'],$p['id_tipo_sala'],$p['id_cine'],$p['numero_sala'],$p['nombre_sala'],$p['cant_butacas']);
            }, $salas);

            return $resp;
            }

        }




?>