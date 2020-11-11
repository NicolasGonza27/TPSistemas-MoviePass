<?php
    
    namespace Controllers;

    use DAObd\UsuarioDAO as UsuarioDAO;
    use Models\Usuario as Usuario;
    use DAObd\FbDAO as FbDAO;
    use Models\Fbook as Fbook;
    use Exception;

    class FbController
    {

        private $usuarioDAO;
        private $user_face;

        public function __construct()
        {
            $this->usuarioDAO = new UsuarioDAO();
            $this->user_face = new FbDAO();
        }

        public function Add(Fbook $user)
        {
            try
            {
                $this->user_face->AddUser($user);
                
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
        
        public function AddNuevoUsuario()
        {
            try
            {
                $id = $_SESSION['fbUserId'];
                $name = $_SESSION['fbUserName'];
                $email = $_SESSION['email'];
                
                $user = new Fbook($id,$name,$email,null); //creo elusuario de fb
                $error = 0;

                $us = $this->usuarioDAO->GetOneByEmail($email); //chequeo que no este en el siste,a
 

                if($us) 
                {       
                    $_SESSION["userLogged"] = $this->usuarioDAO->GetOne($us->getId_usuario()); //si existe me devuelve el usuario
                    $this->StartHome();   
                }
                else 
                {  
                    $nombre_completo = explode(" ", $name);
                    $usuario = new Usuario(null,$user->getTipo_usuario(),$nombre_completo[0],$nombre_completo[1],null,$email,null,null);
                    $this->usuarioDAO->Add($usuario);

                    $usuarioNuevo = $this->usuarioDAO->GetOneByEmail($email); 
                    $user->setId_user($usuarioNuevo->getId_usuario());

                    $this->Add($user);
                    $_SESSION["userLogged"] = $this->usuarioDAO->GetOne($usuarioNuevo->getId_usuario());
                    $this->StartHome();
                }
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
            

        public function Delete($id_usuario)
        {
            try
            {
                $this->usuarioDAO->Remove($id_usuario);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function StartHome()
        {
            header('location: http://localhost/dashboard/TPSistemas-MoviePass/Home/ShowHomeClientViews');
        }

        public function StartLogin()
        {
            header('location: http://localhost/dashboard/TPSistemas-MoviePass/Home/StartLogin');
        }
       
    }
?>