<?php 

    namespace Controllers;

    use API\MovieAPI as MovieAPI;

    class MovieController
    {
        private $movieAPI;
        
        public function __construct()
        {
            $this->movieAPI = new MovieAPI();
        }
        
        public function GetAll()
        {
            return $this->movieAPI->getAll();
        }
        
        public function GetAllByGender($gender)
        {
            return $this->movieAPI->GetAllByGender($gender);
        }

        public function GetAllByDate($date)
        { 
            return $this->movieAPI->GetAllByDate($date);
        }

        public function GetByName($title)
        {
            return $this->movieAPI->GetByName($title);
        }

        public function GetOne($id)
        {
            return $this->movieAPI->GetOne($id);
        }

        public function ShowContentViews($id)
        {
            $movie = $this->movieAPI->GetOne($id);
            require_once(VIEWS_PATH."Views-Cliente/content-movie.php");
        }

        public function ShowListViewsByGender($gender = null)
        {   
            if(!$gender) 
            {
                if(isset($_SESSION["busqueda"]))
                {   
                    $gender = $_SESSION["busqueda"];
                }
            }
            
            $listMovie = $this->GetAllByGender($gender);
            require_once(VIEWS_PATH."Views-Cliente/list-movie.php");
        }

        public function ShowListViewsByDate($date = null)
        {   
            if(!$date)
            {
                if(isset($_SESSION["busqueda"]))
                {   
                    $date = $_SESSION["busqueda"];
                }
            }
           
            $listMovie = $this->GetAllByDate($date);
            $_SESSION["busqueda"] = $date;
            require_once(VIEWS_PATH."Views-Cliente/list-movie.php");
        }

    }   


?> 