<?php 

    namespace Controllers;
    use API\MovieAPI;
    use DAObd\MovieDAO as MovieDAO;
    use Controllers\FuncionController as FuncionController;
    use Models\Movie;

class MovieController
    {
        private $movieDAO;
        private $movieAPI;
        
        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->movieAPI = new MovieAPI();
            $this->funcionController = new FuncionController();
            $listFuncion=array();

        }
        
        public function AddCartelera($id_movie)
        {
            $this->movieDAO->Add($id_movie);
            $this->GetMovieOutCartelera();
        }

        public function GetAllCartelera()
        {
            return $this->movieDAO->getAll();
        }
        
        public function GetAllCarteleraByGender($id_gender)
        {
            return $this->movieDAO->GetAllByGender($id_gender);
        }

        public function GetAllCarteleraByDate($date)
        { 
            return $this->movieDAO->GetAllByDate($date);
        }

        public function GetAllOutCartelera()
        {
            return $this->movieAPI->GetAllOutCartelera();
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
                if(isset($_SESSION["busquedaGender"]))
                {   
                    $id_gender = $_SESSION["busquedaGender"];
                }
            }
            
            $listMovie = $this->GetAllCarteleraByGender($id_gender);
            $_SESSION["busquedaGender"] = $id_gender;
            require_once(VIEWS_PATH."Views-Cliente/list-movie.php");
        }

        public function ShowListViewsByDate($date = null)
        {   
            if(!$date)
            {
                if(isset($_SESSION["busquedaDate"]))
                {   
                    $date = $_SESSION["busquedaDate"];
                }
            }
           
            $listMovie = $this->GetAllCarteleraByDate($date);
            $_SESSION["busquedaDate"] = $date;
            require_once(VIEWS_PATH."Views-Cliente/list-movie.php");
        }

        public function GetCartelera()
        {
            $movieListRta = $this->GetAllCartelera();
            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        public function GetMovieOutCartelera()
        {
            $movieListRta = $this->GetAllOutCartelera();
            require_once(VIEWS_PATH."Views-Admin/movies-out-cartelera.php");
        }


    }   


?> 