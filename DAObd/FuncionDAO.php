<?php 

   
    namespace DAObd;

    use Models\Movie as Movie;
    use API\MovieAPI as MovieAPI;
    use PDOException;
    use Models\Funcion as Funcion;

    class FuncionDAO 
    {   

        private $connection;
        private $tableName = "funciones";

        public function Add(Funcion $funcion)
        {

            try 
            {
               $query = "INSERT INTO ".$this->tableName." (id_pelicula,id_sala,cant_asistentes,fecha_hora) VALUES 
               (:id_pelicula,:id_sala,:cant_asistentes,:fecha_hora);";
                
               $this->connection = Connection::GetInstance();
               
               $parameters["id_pelicula"] = $funcion->getId_pelicula();
               $parameters["id_sala"] = $funcion->getId_sala();
               $parameters["cant_asistentes"] = $funcion->getCant_asistentes();
               $parameters["fecha_hora"] = $funcion->getFecha_hora();

               return $this->connection->ExecuteNonQuery($query,$parameters);

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

        public function GetAllByMovie($id_movie)
        {
            try 
            {
                $query = "SELECT 
                *
                FROM peliculas p
                INNER JOIN funciones f
                ON p.id = f.id_pelicula
                WHERE id = :id;";

                $parameters["id"] = $id_movie;

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

        public function GetAllFuncionesBySala($id_sala)
        {
            try 
            {
                $query = "SELECT 
                *
                FROM salas s
                INNER JOIN funciones f
                ON s.id_sala = f.id_sala
                WHERE s.id_sala = :id_sala;";

                $parameters["id_sala"] = $id_sala;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    $newResultSet =  $this->mapear($resultSet);

                    if(count($newResultSet) > 1) {
                        return  $newResultSet;
                    }
                    else {
                        return  $newResultSet[0];
                    }
                }

                return  array();
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }


        public function GetOne($id_funcion)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".id_funcion = :id_funcion";

                $this->connection = Connection::GetInstance();

                $parameters["id_funcion"] = $id_funcion;

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

        public function Remove($id_funcion)
        {  
            try 
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id_funcion = :id_funcion;";

                $this->connection = Connection::GetInstance();

                $parameters['id_funcion'] = $id_funcion;

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

        public function Modify($id_funcion,Funcion $newFuncion)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET id_pelicula = :id_pelicula, id_sala = :id_sala, cant_asistentes  = :cant_asistentes, fecha_hora = :fecha_hora
                WHERE (id_funcion = :id_funcion);";

                $this->connection = Connection::GetInstance();

                $parameters["id_funcion"] = $id_funcion;
                $parameters["id_pelicula"] = $newFuncion->getId_pelicula();
                $parameters["id_sala"] = $newFuncion->getId_sala();
                $parameters["cant_asistentes"] = $newFuncion->getCant_asistentes();
                $parameters["fecha_hora"] = $newFuncion->getFecha_hora();

                $return = $this->connection->ExecuteNonQuery($query,$parameters);

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
                return new Funcion($p['id_funcion'],$p['id_pelicula'],$p['id_sala'],$p['cant_asistentes'],$p['fecha_hora']);
            }, $salas);

        return $resp;
        }


    }

?>
