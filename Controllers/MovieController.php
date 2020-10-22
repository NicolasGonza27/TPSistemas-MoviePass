<?php 

    namespace Controllers;

    use DAObd\MovieDAO as MovieDAO;

    class MovieController
    {
        private $movieDAO;
        
        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
        }
        
        public function GetAll()
        {
            return $this->movieDAO->getAll();
        }
        
        public function GetAllByGender($gender)
        {
            return $this->movieDAO->GetAllByGender($gender);
        }

        public function GetAllByDate($id)
        { 
            return $this->movieDAO->GetAllByDate($id);
        }

        public function Refresh()
        {
            $this->movieDAO->refresh();
        }

        public function GetOne($id)
        {
            return $this->movieDAO->GetOne($id);
        }

        public function ShowContentViews($id)
        {
            $movie = $this->movieDAO->GetOne($id);
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
            $_SESSION["busqueda"] = $gender;
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