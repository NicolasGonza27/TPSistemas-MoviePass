<?php 

    namespace Controllers;



    use DAObd\MovieDAO as MovieDAO;
    use Controllers\FuncionController as FuncionController;

    class MovieController
    {
        private $movieDAO;
        
        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->funcionController = new FuncionController();
            $listFuncion=array();

        }
        
        public function GetAll()
        {
            return $this->movieDAO->getAll();
        }
        
        public function GetAllByGender($id_gender)
        {
            return $this->movieDAO->GetAllByGender($id_gender);
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
            $listFuncion = $this->funcionController->GetAll();
            require_once(VIEWS_PATH."Views-Cliente/content-movie.php");
        }

        public function ShowListViewsByGender($id_gender = null)
        {   
            if(!$id_gender) 
            {
                if(isset($_SESSION["busqueda"]))
                {   
                    $id_gender = $_SESSION["busqueda"];
                }
            }
            
            $listMovie = $this->GetAllByGender($id_gender);
            $_SESSION["busqueda"] = $id_gender;
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