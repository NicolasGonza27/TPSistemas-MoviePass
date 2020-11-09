<?php
    
    namespace Controllers;

    use DAObd\UsuarioDAO as UsuarioDAO;
    use Models\Usuario as Usuario;

    class UsuarioController
    {

        private $usuarioDAO;

        public function __construct()
        {
            $this->usuarioDAO = new UsuarioDAO();
        }

        public function Add(Usuario $user)
        {
            $this->usuarioDAO->Add($user);
        }
        
        public function ShowHomeClientViews()
        {
            require_once(VIEWS_PATH."Views-Cliente/home-client.php");
        }

        public function AddNuevoUsuario($nombre,$apellido, $dni, $email, $password, $fecha_nac)
        {
            $usuario = new Usuario(null,2,$nombre,$apellido,$dni,$email,$password,$fecha_nac);
            $error = 0;
            if($this->usuarioDAO->GetOneByEmail($email)) 
            {
                $error = 2;   
            }
            else 
            {
                $this->usuarioDAO->Add($usuario);
            }
            require_once("Views/home.php");
            
        }

        public function Delete($id)
        {
            $this->usuarioDAO->Remove($id);
        }
       
    }
?>