<?php 

    use API\MovieAPI as MovieAPI;

    class MovieController
    {
        private $movieAPI;
        
        public function __construct()
        {
            $movieAPI = new MovieAPI();
        }
        
        public function ShowListViews()
        {   
            $listMovie = $this->GetAll();
            require_once(VIEWS_PATH."list-movie.php");
        }

        public function GetAll()
        {
            return $this->movieAPI->getAll();
        }
    
    }   


?> 