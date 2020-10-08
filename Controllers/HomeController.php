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
                    $this->ShowListMovieView();
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
            require_once(VIEWS_PATH."Views-Cliente/list-movie.php");
        }

        public function Login($email,$password)
        {
            $user = $this->usuarioDAO->SearchUser($email,$password);

            if($user)
            {
                if($user->getIs_admin())
                    {   
                        $this->ShowDashboardView();
                    }
                    else
                    {
                        $this->ShowListMovieView();
                    }
            }
            else
            {
                $this->Index("Incorrect username and/or password");
            }
        
        }

        public function Logout()
        {   
            session_destroy();
            $this->Index();
        }
    }
?>
