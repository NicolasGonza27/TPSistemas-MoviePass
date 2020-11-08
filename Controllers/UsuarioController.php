<?php
    
    namespace Controllers;

    use DAObd\UsuarioDAO as UsuarioDAO;
    use Models\Usuario as Usuario;
    use Exception;

    class UsuarioController
    {

        private $usuarioDAO;

        public function __construct()
        {
            $this->usuarioDAO = new UsuarioDAO();
        }

        public function Add(Usuario $user)
        {
            try
            {
                $this->usuarioDAO->Add($user);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
        
        public function ShowHomeClientViews()
        {
            try
            {
                require_once(VIEWS_PATH."Views-Cliente/home-client.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function AddNuevoUsuario($nombre,$apellido, $dni, $email, $password, $fecha_nac)
        {
            try
            {
                $usuario = new Usuario(null,2,$nombre,$apellido,$dni,$email,$password,$fecha_nac);
                $error = 0;
                if($this->usuarioDAO->GetOneByEmail($email)) 
                {
                    $_SESSION["error"] = 2;   
                }
                else 
                {
                    $this->usuarioDAO->Add($usuario);
                }
                $this->StartLogin();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
            

        public function Delete($id)
        {
            try
            {
                $this->usuarioDAO->Remove($id);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function StartLogin()
        {
            require_once(VIEWS_PATH."/login.php");
        }
       
    }
?>