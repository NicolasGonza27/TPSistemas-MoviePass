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
                if(isset($_SESSION['fbUserId']))
                {
                    $id = $_SESSION['fbUserId'];
                    $name = $_SESSION['fbUserName'];
                    $email = $_SESSION['email'];
                }
 
               // $id_usuario = $this->FbDAO->nextId();
                $user = new Fbook($id,3,$name,$email);
                $error = 0;
                if($this->usuarioDAO->GetOneByEmail($email)) 
                {
                    $_SESSION["error"] = 2;
                    $this->StartLogin();   
                }
                else 
                {
                    $this->Add($user);
                    $nombre_completo = explode(" ", $name);
                    $usuario = new Usuario(null,$user->getTipo_usuario(),$nombre_completo[0],$nombre_completo[1],null,$email,null,null);
                    $this->usuarioDAO->Add($usuario);
                    $_SESSION["userLogged"] = $usuario;
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
            require_once(VIEWS_PATH."login.php");
        }
       
    }
?>