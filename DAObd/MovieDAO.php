<?php 

    namespace DAObd;

    use Models\Movie as Movie;
    use API\MovieAPI as MovieAPI;
    use PDOException;
    use DAObd\Connection as Connection;


    class MovieDAO 
    {   

        private $connection;
        private $tableName = "peliculas_cartelera";

    
        public function refresh()
        {
            try 
            {

                $movieAPI = new MovieAPI();
                $movieList = $movieAPI->GetAll();
                
                $movieGenderDAO = new MovieGenderDAO();
                $movieGenderDAO->refresh();

                foreach($movieList as $movie)
                {   

                    $newMovie = $movieAPI->GetOne($movie->getId());

                    $query = "INSERT INTO ".$this->tableName."(popularity,vote_count,poster_path,id,adult,title,vote_average,overview,release_date,runtime) 
                    VALUES (:popularity,:vote_count,:poster_path,:id,:adult,:title,:vote_average,:overview,:release_date,:runtime);";
                    
                    $this->connection = Connection::GetInstance();

                    $parameters["popularity"] = $newMovie->getPopularity();
                    $parameters["vote_count"] = $newMovie->getVote_count();
                    $parameters["poster_path"] = $newMovie->getPoster_path();
                    $parameters["id"] = $newMovie->getId();
                    $parameters["adult"] = $newMovie->getAdult();
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

        public function Add($id)
        {
            try 
            {
                $movieAPI = new MovieAPI();
                $movie = $movieAPI->GetOne($id);
                $movieInDAO = $this->GetOne($id, true);

                if($movie)
                {
                    if(!$movieInDAO)
                    {
                        $query = "INSERT INTO ".$this->tableName." (popularity,vote_count,poster_path,id,adult,title,vote_average,overview,release_date,runtime) 
                        VALUES (:popularity,:vote_count,:poster_path,:id,:adult,:title,:vote_average,:overview,:release_date,:runtime);";
                        
                        $this->connection = Connection::GetInstance();
    
                        $parameters["popularity"] = $movie->getPopularity();
                        $parameters["vote_count"] = $movie->getVote_count();
                        $parameters["poster_path"] = $movie->getPoster_path();
                        $parameters["id"] = $movie->getId();
                        $parameters["adult"] = $movie->getAdult();
                        $parameters["title"] = $movie->getTitle();
                        $parameters["vote_average"] = $movie->getVote_average();
                        $parameters["overview"] = $movie->getOverview();
                        $parameters["release_date"] = $movie->getRelease_date();
                        $parameters["runtime"] = $movie->getRuntime();
    
                        $this->connection->ExecuteNonQuery($query,$parameters);
                        
                        $genders = $movie->getAllGenre_ids();
    
                        foreach($genders as $gender)
                        {
    
                            $queryGender = "INSERT INTO peliculasXGenero (id_pelicula,id_genero) VALUES (:id_pelicula,:id_genero);";
                        
                            $this->connection = Connection::GetInstance();
    
                            $parametersGender["id_pelicula"] = $movie->getId();
                            $parametersGender["id_genero"] = $gender["id"];
    
                            $this->connection->ExecuteNonQuery($queryGender,$parametersGender);
                        }
                    }
                    else
                    {
                        $this->UpdateEliminado($id);
                    }
                }

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function UpdateEliminado($id_movie)
        {   
            try 
            {
                $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado
                WHERE (id = :id);";

                $this->connection = Connection::GetInstance();

                $parameters['id'] = $id_movie;
                $parameters['eliminado'] = false;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;
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

                $parameters["eliminado"] = false;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                $newResultSet =  $this->mapear($resultSet);

                return  $newResultSet;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllByGender($id_genero,bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT
                *
                FROM peliculasXGenero pxq
                INNER JOIN peliculas_cartelera p
                ON p.id = pxq.id_pelicula
                WHERE (pxq.id_genero = :id_genero) AND (p.eliminado = :eliminado);";
                
                $parameters["id_genero"] = $id_genero;
                $parameters["eliminado"] = $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                $newResultSet =  $this->mapear($resultSet);

                return  $newResultSet;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllByDate($date,bool $eliminado = false)
        {   
            try 
            {
                $query = "SELECT 
                          * 
                          FROM 
                          ".$this->tableName." 
                          WHERE (release_date >= :date) AND (eliminado = :eliminado); ";


                $parameters["date"] = $date;
                $parameters["eliminado"] = $eliminado;
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                $newResultSet =  $this->mapear($resultSet);

                return  $newResultSet;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetOne($id_movie, bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (id = :id) AND (eliminado = :eliminado);";

                $this->connection = Connection::GetInstance();

                $parameters["id"] = $id_movie;
                $parameters["eliminado"] = $eliminado;

                $resultSet = $this->connection->Execute($query,$parameters);

                $newResultSet =  $this->mapear($resultSet);
                
                if(!empty($newResultSet))
                {
                    return  $newResultSet[0];
                }

                return  false;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllMostPopularity($popularityMin,bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT
                *
                FROM peliculas_cartelera p
                WHERE (p.popularity >= :popularity) AND (p.eliminado = :eliminado);";
                
                $parameters["popularity"] = $popularityMin;
                $parameters["eliminado"] = $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                $newResultSet =  $this->mapear($resultSet);

                return  $newResultSet;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function Remove($id_movie)
        {
            try 
            {

                $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado
                WHERE (id = :id);";

                $this->connection = Connection::GetInstance();

                $parameters['id'] = $id_movie;
                $parameters['eliminado'] = true;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

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
                return new Movie($p['popularity'],$p['vote_count'],$p['poster_path'],$p['id'],$p['adult'],
                0,$p['title'],$p['vote_average'],$p['overview'],$p['release_date'],$p['runtime']);
            }, $movies);

            return $resp;
        }

    
    }

?>