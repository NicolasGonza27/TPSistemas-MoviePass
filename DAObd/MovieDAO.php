<?php 

    namespace DAObd;

    use Models\Movie as Movie;
    use API\MovieAPI as MovieAPI;
    use PDOException;
    use DAObd\Connection as Connection;


    class MovieDAO 
    {   

        private $connection;
        private $tableName = "peliculas";
    
        public function refresh()
        {
            try 
            {
                $movieAPI = new MovieAPI();
                $movieList = $movieAPI->GetAll();
                
                foreach($movieList as $movie)
                {   

                    $newMovie = $movieAPI->GetOne($movie->getId());

                    $query = "INSERT INTO ".$this->tableName."(popularity,vote_count,video,poster_path,id,adult,backdrop_path,original_language,original_title,title,vote_average,overview,release_date,runtime) 
                    VALUES (:popularity,:vote_count,:video,:poster_path,:id,:adult,:backdrop_path,:original_language,:original_title,:title,:vote_average,:overview,:release_date,:runtime);";
                    
                    $this->connection = Connection::GetInstance();

                    $parameters["popularity"] = $newMovie->getPopularity();
                    $parameters["vote_count"] = $newMovie->getVote_count();
                    $parameters["video"] = $newMovie->getVideo();
                    $parameters["poster_path"] = $newMovie->getPoster_path();
                    $parameters["id"] = $newMovie->getId();
                    $parameters["adult"] = $newMovie->getAdult();
                    $parameters["backdrop_path"] = $newMovie->getBackdrop_path();
                    $parameters["original_language"] = $newMovie->getOriginal_language();
                    $parameters["original_title"] = $newMovie->getOriginal_title();
                    $parameters["title"] = $newMovie->getTitle();
                    $parameters["vote_average"] = $newMovie->getVote_average();
                    $parameters["overview"] = $newMovie->getOverview();
                    $parameters["release_date"] = $newMovie->getRelease_date();
                    $parameters["runtime"] = $newMovie->getRuntime();

                    $this->connection->ExecuteNonQuery($query,$parameters);
                    
                    $genders = $newMovie->getAllGenre_ids();



                    foreach($genders as $gender)
                    {

                        $queryGender = "INSERT INTO peliculasXGenero (id_pelicula,id_genero) VALUES (:id_pelicula,:id_genero);";
                    
                        $this->connection = Connection::GetInstance();

                        $parametersGender["id_pelicula"] = $newMovie->getId();
                        $parametersGender["id_genero"] = $gender["id"];
                        
                        

                        $this->connection->ExecuteNonQuery($queryGender,$parametersGender);
                    }
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

        public function GetAllByGender($id)
        {
            try 
            {
                $query = "SELECT
                *
                FROM peliculasXGenero pxq
                INNER JOIN peliculas p
                ON p.id = pxq.id_pelicula
                WHERE pxq.id_genero = $id;";

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

        public function GetAllByDate($date)
        {   
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".release_date >= $date";

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
        
        public function GetOne($id_movie)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".id = :id";

                $this->connection = Connection::GetInstance();

                $parameters["id"] = $id_movie;

                $resultSet = $this->connection->Execute($query,$parameters);

                $newResultSet =  $this->mapear($resultSet);

                return  $newResultSet[0];
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        protected function mapear($movies)
        {
            $resp = array_map(function($p)
            {
                return new Movie($p['popularity'],$p['vote_count'],$p['video'],$p['poster_path'],$p['id'],$p['adult'],$p['backdrop_path'],$p['original_language'],
                $p['original_title'],0,$p['title'],$p['vote_average'],$p['overview'],$p['release_date'],$p['runtime']);

            }, $movies);

            return $resp;
        }

    
    }

?>