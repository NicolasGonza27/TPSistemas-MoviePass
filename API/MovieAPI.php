<?php 

    namespace API;

    use Models\Movie as Movie;
    use API\MovieGenderAPI as MovieGenderAPI;

class MovieAPI
    {
        private $movieList;
        private $fileName;

        public function __construct()
        {
            $this->movieList = array();
            $this->fileName = "https://api.themoviedb.org/3/movie/now_playing?api_key=241053b8db24b510787d177925c66cdb";
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->movieList;
        }

        public function GetAllByGender($name_gender)
        {
            $this->RetrieveData();
            $moviesByGender = array();

            $movieGenderAPI = new MovieGenderAPI();

            $gender = $movieGenderAPI->Get($name_gender);

            if($gender) 
            {
                foreach($this->movieList as $movie)
                {
                    if($movie->exists_gender_id($gender->getId()))
                    {
                        array_push($moviesByGender,$movie);
                    }
                }
            }
            
            return $moviesByGender;
        }

        public function GetAllByDate($date)
        {   
            $this->RetrieveData();
            $moviesByDate= array();

            foreach($this->movieList as $movie)
            {   
                if($movie->getRelease_date() >= $date)
                {   
                    array_push($moviesByDate,$movie);
                }
            }
        
            return $moviesByDate;
        }

        public function GetByName($title)
        {
            $this->RetrieveData();

            foreach($this->movieList as $movie)
            {   
                if(strcasecmp ( $movie->getTitle(),$title ))
                {   
                    return $movie;
                }
            }
        
            return false;
        }

        public function GetOne($id)
        {
            $this->RetrieveData();

            foreach($this->movieList as $movie)
            {   
                if($movie->getId() == $id)
                {   
                    return $movie;
                }
            }
        
            return false;
        }

        public function RetrieveData()
        {
            $this->movieList = array();

            for($i = 1; $i < 65; $i++)
            {
                $jsonContent = file_get_contents($this->fileName."&page=$i");
                $contentArray = ($jsonContent) ? json_decode($jsonContent, true) : array();
                foreach($contentArray["results"] as $content)
                {     
                    $popularity = $content["popularity"]; 
                    $vote_count = $content["vote_count"];
                    $video = $content["video"];
                    $poster_path = $content["poster_path"];
                    $id = $content["id"];
                    $adult = $content["adult"];
                    $backdrop_path = $content["backdrop_path"];
                    $original_language = $content["original_language"];
                    $original_title = $content["original_title"];
                    $genre_ids = $content["genre_ids"];
                    $title = $content["title"];
                    $vote_average = $content["vote_average"];
                    $overview = $content["overview"];
                    $release_date = date($content["release_date"]);
                    
                    $movie = new Movie($popularity,$vote_count,$video,$poster_path,$id,$adult,$backdrop_path,$original_language,
                    $original_title,$genre_ids,$title,$vote_average,$overview,$release_date);

                    array_push($this->movieList, $movie);
                }
            
            }   
        
        }

    }




?>