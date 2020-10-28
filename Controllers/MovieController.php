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

        public function GetAllCarteleraByTitle($title)
        {
            return $this->movieAPI->GetAllByTitle($title);
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

        public function GetAllOutCarteleraByTitle($title)
        {
            return $this->movieAPI->GetAllByTitleOutCartelera($title);
        }

        public function GetAllOutCarteleraByGender($id_gender)
        {
            return $this->movieAPI->GetAllByGenderOutCartelera($id_gender);
        }

        public function GetAllOutCarteleraByDate($id)
        { 
            return $this->movieAPI->GetAllByDateOutCartelera($id);
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
            $_SESSION["backbutton"] = "busquedaGender";
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
            $_SESSION["backbutton"] = "busquedaDate";
            require_once(VIEWS_PATH."Views-Cliente/list-movie.php");
        }

        public function ShowListViewsByTituloAdminCartelera($title = null)
        {   
            if(!$title) 
            {
                if(isset($_SESSION["busquedaTitleCartelera"]))
                {   
                    $title = $_SESSION["busquedaTitleCartelera"];
                }
            }
            
            $movieListRta = $this->GetAllCarteleraByTitle($title);
            $_SESSION["busquedaTitleCartelera"] = $title;
            $_SESSION["backbutton"] = "busquedaTitleCartelera";
            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        public function ShowListViewsByGenderAdminCartelera($id_gender = null)
        {   
            if(!$id_gender) 
            {
                if(isset($_SESSION["busquedaGenderCartelera"]))
                {   
                    $id_gender = $_SESSION["busquedaGenderCartelera"];
                }
            }
            
            $movieListRta = $this->GetAllCarteleraByGender($id_gender);
            $_SESSION["busquedaGenderCartelera"] = $id_gender;
            $_SESSION["backbutton"] = "busquedaGenderCartelera";
            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        public function ShowListViewsByDateAdminCartelera($date = null)
        {   
            if(!$date)
            {
                if(isset($_SESSION["busquedaDateCartelera"]))
                {   
                    $date = $_SESSION["busquedaDateCartelera"];
                }
            }
           
            $movieListRta = $this->GetAllCarteleraByDate($date);
            $_SESSION["busquedaDateCartelera"] = $date;
            $_SESSION["backbutton"] = "busquedaDateCartelera";
            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        public function ShowListViewsByTitleAdminOutCartelera($title = null)
        {   
            if(!$title) 
            {
                if(isset($_SESSION["busquedaTitleOutCartelera"]))
                {   
                    $title = $_SESSION["busquedaTitleOutCartelera"];
                }
            }
            
            $movieListRta = $this->GetAllOutCarteleraByTitle($title);
            $_SESSION["busquedaTitleOutCartelera"] = $title;
            require_once(VIEWS_PATH."Views-Admin/movies-out-cartelera.php");
        }

        public function ShowListViewsByGenderAdminOutCartelera($id_gender = null)
        {   
            if(!$id_gender) 
            {
                if(isset($_SESSION["busquedaGenderOutCartelera"]))
                {   
                    $id_gender = $_SESSION["busquedaGenderOutCartelera"];
                }
            }
            
            $movieListRta = $this->GetAllOutCarteleraByGender($id_gender);
            $_SESSION["busquedaGenderOutCartelera"] = $id_gender;
            require_once(VIEWS_PATH."Views-Admin/movies-out-cartelera.php");
        }

        public function ShowListViewsByDateAdminOutCartelera($date = null)
        {   
            if(!$date)
            {
                if(isset($_SESSION["busquedaDateOutCartelera"]))
                {   
                    $date = $_SESSION["busquedaDateOutCartelera"];
                }
            }
           
            $movieListRta = $this->GetAllOutCarteleraByDate($date);
            $_SESSION["busquedaDateOutCartelera"] = $date;
            require_once(VIEWS_PATH."Views-Admin/movies-out-cartelera.php");
        }

        public function GetCartelera()
        {
            $movieListRta = $this->GetAllCartelera();
            $_SESSION["backbutton"] = "cartelera";
            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        public function GetMovieOutCartelera()
        {
            $movieListRta = $this->GetAllOutCartelera();
            require_once(VIEWS_PATH."Views-Admin/movies-out-cartelera.php");
        }


    }   


?> 