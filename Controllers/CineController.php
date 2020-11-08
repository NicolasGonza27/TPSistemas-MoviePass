<?php
    namespace Controllers;

    use DAObd\CineDAO as CineDAO;
    use Models\Cine as Cine;
    use DAObd\SalaDAO as SalaDAO;
use Exception;

class CineController
    {
        private $cineDAO;
        private $salaDAO;

        public function __construct()
        {
            $this->cineDAO = new CineDAO();
            $this->salaDAO = new SalaDAO();
        }
        
        
        public function ShowDashboardView()
        {
            try
            {
                $listaCines = $this->cineDAO->GetAllWithCapacity();
                require_once(VIEWS_PATH."Views-Admin/dashboard.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
            
        }

    
        public function Add($nombre, $calle, $numero, $capacidad, $apertura, $cierre, $valor_entrada) 
        {
            try
            {
                $cine = new Cine(null, $nombre, $calle, $numero, $capacidad, $apertura, $cierre, $valor_entrada);
                $this->cineDAO->Add($cine);
                $this->ShowDashboardView();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        
        
        }

        public function Remove($id)
        {   
            try
            {
                $this->cineDAO->Remove($id);
                $this->ShowDashboardView();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetOne($id)
        {
           try
           {
                return $this->cineDAO->GetOneWithCapacity($id);
           }
           catch(Exception $e)
           {
                echo $e->getMessage();
           }

        }

        public function GetAll()
        {
            try
            {
                return $this->cineDAO->GetAllWithCapacity();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        
        public function Modify($id, Cine $cine)
        {   
            try
            {
                $this->cineDAO->Modify($id, $cine);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }

        }

        public function ModifyModal($id, $nombre, $calle, $nunero, $capacidad, $apertura, $cierre, $valor_entrada)
            {
                try
                {
                    $cine = new Cine();
                    $cine->setId($id);
                    $cine->setNombre($nombre);
                    $cine->setCalle($calle);
                    $cine->setNumero($nunero);
                    $cine->setCapacidad($capacidad);
                    $cine->setHor_apertura($apertura);
                    $cine->setHor_cierre($cierre);
                    $cine->setValor_entrada($valor_entrada);

                    $this->cineDAO->Modify($id, $cine);
                    
                    $this->ShowDashboardView();
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                }
            }

    }
?>