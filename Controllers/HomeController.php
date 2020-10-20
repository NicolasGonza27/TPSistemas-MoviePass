<?php
    namespace Controllers;

    use DAO\UsuarioDAO as UsuarioDAO;

    class HomeController
    {   
        private $usuarioDAO;

        public function __construct()
        {
            $this->usuarioDAO = new UsuarioDAO();
        }
           
        public function Index($message = "")
        {
            if(isset($_SESSION["userLogged"]))
            {
                $user = $_SESSION["userLogged"];
                
                if($user->getIs_admin())
                {   
                    $this->ShowDashboardView();
                }
                else
                {
                    $this->ShowHomeClientViews();
                }
            }
            else
            {
                require_once(VIEWS_PATH."home.php");
            }
        }        
        
        public function ShowDashboardView()
        {
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
            require_once(VIEWS_PATH."Views-Cliente/filters.php");
        }  

        public function Login($email,$password)
        {
            $user = $this->usuarioDAO->SearchUser($email,$password);

            if($user)
            {
                $_SESSION["userLogged"] = $user;

                if($user->getIs_admin())
                {   
                    $this->ShowDashboardView();
                }
                else
                {
                    require_once(VIEWS_PATH ."Views-Cliente/home-client.php");
                }
            }
            else
            {
                echo "<script> if(confirm('Los datos que ingreso no corresponden a nungun usuario registrado.'));";
                echo "window.location = '/dashboard/TPSistemas-MoviePass/Home'; </script>";
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
