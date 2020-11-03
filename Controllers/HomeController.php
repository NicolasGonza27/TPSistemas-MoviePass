<?php
    namespace Controllers;

    use API\MovieAPI as MovieAPI;
    use API\MovieGenderAPI as MovieGenderAPI;
    use DAObd\CineDAO as CineDAO;
    use DAObd\MovieDAO as MovieDAO;
    use DAObd\UsuarioDAO as UsuarioDAO;

    class HomeController
    {   
        private $usuarioDAO;
        private $cineDAO;
        private $movieGenderAPI;

        public function __construct()
        {
            $this->usuarioDAO = new UsuarioDAO();
            $this->cineDAO = new CineDAO();
            $this->movieGenderAPI = new MovieGenderAPI();
        }
           
        public function Index($message = "")
        {
            if(isset($_SESSION["userLogged"]))
            {
                $user = $_SESSION["userLogged"];
                
                if($user->getId_tipo_usuario() == 1)
                {   
                    $this->ShowDashboardView();
                }
                elseif($user->getId_tipo_usuario() == 2)
                {
                    $this->ShowHomeClientViews();
                }
            }
            else
            {
                $error = 0;
                require_once(VIEWS_PATH."home.php");
            }
        }        
        
        public function ShowDashboardView()
        {
            $listaCine = $this->cineDAO->GetAll();
            require_once(VIEWS_PATH."Views-Admin/dashboard.php");
        }

        public function ShowListMovieView()
        {
            $listMovie = 
            require_once(VIEWS_PATH."Views-Cliente/list-movie.php");
        }

        public function ShowHomeClientViews()
        {
            require_once(VIEWS_PATH."Views-Cliente/home-client.php");
        }

        public function ShowFiltersViews()
        {
            $movieDAO = new MovieDAO();
            $listMovie = $movieDAO->GetAllMostPopularity(500);
            $listMovieGender = $this->movieGenderAPI->GetAll();
            require_once(VIEWS_PATH."Views-Cliente/filters.php");
        }  

        public function ShowFiltersViewsAdminCartelera()
        {
            $movieDAO = new MovieDAO();
            $listMovie = $movieDAO->GetAllMostPopularity(500);
            $listMovieGender = $this->movieGenderAPI->GetAll();
            require_once(VIEWS_PATH."Views-Admin/filterCartelera.php");
        }  
        
        public function ShowFiltersViewsAdminOutCartelera()
        {
            $movieAPI = new MovieAPI();
            $listMovie = $movieAPI->GetAllMostPopularityOutCartelera();
            $listMovieGender = $this->movieGenderAPI->GetAll();
            require_once(VIEWS_PATH."Views-Admin/filterOutCartelera.php");
        }  

        public function Login($email,$password)
        {
            $user = $this->usuarioDAO->GetOneByEmail($email);
            $error = 0;
            if($user)
            {
                if($user->GetPassword() == $password) 
                {                    
                    $_SESSION["userLogged"] = $user;
                    
                    if($user->getId_tipo_usuario() == 1)
                    {   
                        $this->ShowDashboardView();
                    }
                    elseif($user->getId_tipo_usuario() == 2) 
                    {
                        require_once(VIEWS_PATH ."Views-Cliente/home-client.php");
                    }
                }
                else
                {
                    $error = 1;
                    require_once(VIEWS_PATH."home.php");
                }
            }
            else
            {
                $error = 1;
                require_once(VIEWS_PATH."home.php");
            }
        
        }

        public function Logout()
        {   
            session_destroy();
            session_start();
            session_destroy();
            $this->Index();
        }


    }
?>
