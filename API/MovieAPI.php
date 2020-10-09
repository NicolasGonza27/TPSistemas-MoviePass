<?php 

    namespace API;

    use Models\Movie as Movie;

    class MovieAPI
    {
        private $movieList;
        private $jsonContent;

        public function __construct()
        {
            $this->movieList = array();
            $this->jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=241053b8db24b510787d177925c66cdb");
        }

        public function getAll()
        {
            $this->RetrieveData();
            return $this->movieList;
        }

        public function RetrieveData()
        {
                $this->movieList = array();

                $contentArray = ($this->jsonContent) ? json_decode($this->jsonContent, true) : array();

                foreach($contentArray["results"] as $content)
                {   
                    
                    $popularity = $content["popularity"]; 
                    $vote_count = $content["vote_count"];
                    $video = $content["video"];
                    $id = $content["id"];
                    $adult = $content["adult"];
                    $backdrop_path = $content["backdrop_path"];
                    $original_language = $content["original_language"];
                    $original_title = $content["original_title"];
                    $title = $content["title"];
                    $overview = $content["overview"];
                    
                    $movie = new Movie($popularity,$vote_count,$video,$id,$adult,$backdrop_path,$original_language,$original_title,$title,$overview);
                 
                    array_push($this->movieList, $movie);
                }
        }

    }




?>