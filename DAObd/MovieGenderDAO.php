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
                    $query = "INSERT INTO ".$this->tableName." (id_genero,nombre_genero) VALUES (:id_genero, :nombre_genero)";
                    
                    $this->connection = Connection::GetInstance();

                    $parameters["id_genero"] = $movieGender->getId();
                    $parameters["nombre_genero"] = $movieGender->getName();

                    $this->connection->ExecuteNonQuery($query,$parameters);
                
                }
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

                $newResultSet =  $this->mapear($resultSet);

                return  $newResultSet;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        
        public function GetOne($id)
        {

        }

        protected function mapear($movies)
        {
            $resp = array_map(function($p)
            {
                return new MovieGender($p["id"],$p["name"]);

            }, $movies);

            return $resp;
        }
}


?>