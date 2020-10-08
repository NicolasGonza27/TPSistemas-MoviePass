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
        
        public function Delete($id)
        {
            $this->usuarioDAO->Delete($id);
        }
       
    }

    

?>