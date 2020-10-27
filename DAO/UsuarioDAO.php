<?php
    namespace DAO;

    use DAO\IUsuarioDAO as IUsuarioDAO;
    use Models\Usuario as Usuario;

    class UsuarioDAO implements IUsuarioDAO
    {   

        private $usersList;
        private $fileName;


        public function __construct()
        {
            $this->usersList = array();
            $this->fileName = dirname(__DIR__)."/Data/usuario.json";
        }


        public function Add(Usuario $user)
        {
            $this->RetrieveData();
            array_push($this->usersList,$user);
            $this->SaveAll();
        }

        public function Delete($id) 
        {
            $this->RetrieveData();
            $key = $this->returnKeyById($id);    
             
            unset($this->usersList[$key]);            
            $this->SaveAll();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->usersList;
        }

        
        public function returnLastId()
        {
            $this->RetrieveData();

            $id = 0;

            foreach($this->usersList as $user)
            {   
                $id = $user->getId();
            }

            return $id;
        }

        public function returnKeyById($id)
        {
            $this->RetrieveData();
            foreach($this->usersList as $key=>$user)
            {  
                if($user->getId())
                {
                    return $key;
                }
            }
            
            return false;
        }
        
        public function SearchUser($email,$password)
        {
            $this->RetrieveData();
            foreach($this->usersList as $user)
            {
                if( ($user->getEmail() == $email) && ($user->getPassword() == $password ) )
                {
                    return $user;
                }
            }
        
            return false;
        }

        public function SearchUserBoolean($email)
        {
            $this->RetrieveData();
            foreach($this->usersList as $user)
            {
                if($user->getEmail() == $email)
                {
                    return true;
                }
            }
            return false;
        }

        private function SaveAll()
        {
            $arrayToEncode = array();

            foreach($this->usersList as $user)
            {
                $valuesArray["id"] = $user->getId();
                $valuesArray["nombreYApellido"] = $user->getNombreYApellido();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["fecha_nac"] = $user->getFecha_nac();
                $valuesArray["is_admin"] = $user->getIs_admin();

                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName,$jsonContent);
        }
        
        private function RetrieveData()
        {
            $this->usersList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $id = 0;
                    $nombreYApellido = $valuesArray["nombreYApellido"];
                    $dni = $valuesArray["dni"];
                    $email = $valuesArray["email"];
                    $password = $valuesArray["password"];
                    $fecha_nac =  $valuesArray["fecha_nac"];
                    $is_admin = $valuesArray["is_admin"];

                    $user = new Usuario($id,$nombreYApellido,$dni,$email,$password,$fecha_nac,$is_admin);
                    array_push($this->usersList, $user);
                }
            }
        }

    }   
    

?>