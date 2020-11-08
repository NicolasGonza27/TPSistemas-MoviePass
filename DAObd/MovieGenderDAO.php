<?php 

    namespace DAObd;

    use API\MovieGenderAPI as MovieGenderAPI;
    use PDOException;
    use Models\MovieGender as MovieGender;


    class MovieGenderDAO
    {
        private $connection;
        private $tableName = "generos";

        public function refresh()
        {
            
            try
            {
                $movieGenderAPI = new MovieGenderAPI(); 
                $movieGenderList = $movieGenderAPI->GetAll();

                foreach($movieGenderList as $movieGender)
                {
                    $query = "INSERT INTO ".$this->tableName." (id_genero,nombre_genero,eliminado) VALUES (:id_genero, :nombre_genero, :eliminado)";
                    
                    $this->connection = Connection::GetInstance();

                    $parameters["id_genero"] = $movieGender->getId();
                    $parameters["nombre_genero"] = $movieGender->getName();
                    $parameters["eliminado"] = false;

                    $this->connection->ExecuteNonQuery($query,$parameters);
                
                }
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
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

                $newResultSet =  $this->mapear($resultSet);

                return  $newResultSet;
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }
        
        public function GetOne($id_genero)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE id_genero = :id_genero;";

                $parameters["id_genero"] = $id_genero;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);


                $newResultSet =  $this->mapear($resultSet);

                return  $newResultSet;
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function Remove($id_genero)
        {     
            try 
            {

                $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado
                WHERE (id_genero = :id_genero);";

                $this->connection = Connection::GetInstance();

                $parameters['id_genero'] = $id_genero;
                $parameters['eliminado'] = true;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        protected function mapear($movies)
        {
            $resp = array_map(function($p)
            {
                return new MovieGender($p["id_genero"],$p["nombre_genero"]);

            }, $movies);

            return $resp;
        }
}


?>