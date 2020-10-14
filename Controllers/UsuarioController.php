<?php
    
    namespace Controllers;

    use DAO\UsuarioDAO as UsuarioDAO;
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

        public function AddNuevoUsuario($nombreYApellido, $dni, $email, $password, $fecha_nac)
        {
            $user = new Usuario();
            $user->setNombreYApellido($nombreYApellido);
            $user->setDni($dni);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setFecha_nac($fecha_nac);
            
            if ($this->usuarioDAO->SearchUserBoolean($email,$password)) 
            {
                echo'<script type="text/javascript">
                        alert("El correo electronico o la contraseña no estan disponibles");
                    </script>';     
            }
            else 
            {
                $this->usuarioDAO->Add($user);
            }
            require_once("Views/home.php");
            
        }

        public function Delete($id)
        {
            $this->usuarioDAO->Delete($id);
        }
       
    }
?>