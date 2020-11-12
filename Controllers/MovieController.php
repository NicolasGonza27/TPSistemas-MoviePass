<?php 

    namespace Controllers;
    use API\MovieAPI;
    use DAObd\MovieDAO as MovieDAO;
    use Controllers\FuncionController as FuncionController;
    use API\MovieGenderAPI as MovieGenderAPI;
    use Exception;


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
            try
            {
                $this->movieDAO->Add($id_movie);
                $this->GetMovieOutCartelera();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllCartelera()
        {
            try
            {
                return $this->movieDAO->getAll();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllCarteleraByTitle($title)
        {
            try
            {
                return $this->movieAPI->GetAllByTitle($title);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
        
        public function GetAllCarteleraByGender($id_gender)
        {
            try
            {
                return $this->movieDAO->GetAllByGender($id_gender);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllCarteleraByDate($date)
        {
            try
            {
                return $this->movieDAO->GetAllByDate($date);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllOutCartelera()
        {
            try
            {
                return $this->movieAPI->GetAllOutCartelera();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllOutCarteleraByTitle($title)
        {
            try
            {
                return $this->movieAPI->GetAllByTitleOutCartelera($title);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllOutCarteleraByGender($id_gender)
        {
            try
            {
                return $this->movieAPI->GetAllByGenderOutCartelera($id_gender);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllOutCarteleraByDate($id)
        {
            try
            {
                return $this->movieAPI->GetAllByDateOutCartelera($id);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function Refresh()
        {
            try
            {
                $this->movieDAO->refresh();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetOne($id)
        {
            try
            {
                return $this->movieDAO->GetOne($id);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }

        }

        public function ShowContentViews($id)
        {
            try
            {
                $movie = $this->movieDAO->GetOne($id);
                $listFuncion = $this->funcionController->GetAll();
                require_once(VIEWS_PATH."Views-Cliente/content-movie.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }


        public function ShowListViewsByTitle($title = null)
        {   
            try
            {
                if(!$title) 
                {
                    if(isset($_SESSION["busquedaTitle"]))
                    {   
                        $title = $_SESSION["busquedaTitle"];
                    }
                }
                
                $listMovie = $this->GetAllCarteleraByTitle($title);
                $_SESSION["busquedaTitle"] = $title;
                $_SESSION["backbutton"] = "busquedaTitle";
                require_once(VIEWS_PATH."Views-Cliente/list-movie.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }


        public function Remove($id)
        {
            try
            {
                $this->movieDAO->Remove($id);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }


        public function ShowListViewsByGender($id_gender = null)
        {   
            try
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByDate($date = null)
        {   
            try
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByTituloAdminCartelera($title = null)
        {   
            try
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByGenderAdminCartelera($id_gender = null)
        {   
            try
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByDateAdminCartelera($date = null)
        {   
            try
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByTitleAdminOutCartelera($title = null)
        {   
            try
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByGenderAdminOutCartelera($id_gender = null)
        {   
            try
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByDateAdminOutCartelera($date = null)
        {   
            try
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetCartelera()
        {
            try
            {
                $movieListRta = $this->GetAllCartelera();
                $_SESSION["backbutton"] = "cartelera";
                require_once(VIEWS_PATH."Views-Admin/cartelera.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetMovieOutCartelera()
        {
            try
            {
                $movieListRta = $this->GetAllOutCartelera();
                require_once(VIEWS_PATH."Views-Admin/movies-out-cartelera.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function RemoveMovieCartelera($id)
        {
            try
            {
            $this->Remove($id);
            
                if(isset($_SESSION["backbutton"])) 
                { 
                    $backButton = $_SESSION["backbutton"];
                    if($backButton == "busquedaTitleCartelera") 
                    { 
                        $this->ShowListViewsByTituloAdminCartelera();
                    } 
                    elseif($backButton == "busquedaGenderCartelera") 
                    { 
                        $this->ShowListViewsByGenderAdminCartelera();
                    } 
                    elseif($backButton == "busquedaDateCartelera") 
                    { 
                        $this->ShowListViewsByDateAdminCartelera();
                    } 
                    elseif($backButton == "cartelera") 
                    { 
                        $this->GetCartelera();
                    } 
                }
                
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByTitleNotLogin($title = null)
        {   
            try
            {
                if(!$title) 
                {
                    if(isset($_SESSION["busquedaTitle"]))
                    {   
                        $title = $_SESSION["busquedaTitle"];
                    }
                }
                
                $listMovie = $this->GetAllCarteleraByTitle($title);
                $_SESSION["busquedaTitle"] = $title;
                $_SESSION["backbutton"] = "busquedaTitle";
                require_once(VIEWS_PATH."/list-movie-not-login.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByGenderNotLogin($id_gender = null)
        {   
            try
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
                require_once(VIEWS_PATH."list-movie-not-login.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowListViewsByDateNotLogin($date = null)
        {   
            try
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
                
                require_once(VIEWS_PATH."list-movie-not-login.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function AddCarteleraForMostPopularity($id_movie)
        {
            try
            {
                $this->movieDAO->Add($id_movie);
                $movieAPI = new MovieAPI();
                $movieGenderAPI = new MovieGenderAPI();
                $listMovie = $movieAPI->GetAllMostPopularityOutCartelera(100);
                $listMovieGender = $movieGenderAPI->GetAll();
                require_once(VIEWS_PATH . "Views-Admin/filterOutCartelera.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        
    }
