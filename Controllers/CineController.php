<?php
    namespace Controllers;

    use DAO\cineDAO as CineDAO;
    use Models\Cine as Cine;

    class CineController
    {
        private $cineDAO;

        public function __construct()
        {
            $this->cineDAO = new CineDAO();
        }
        
        
        public function ShowDashboardView()
        {
            $listaCine = $this->cineDAO->GetAll();
            require_once(VIEWS_PATH."Views-Admin/dashboard.php");
        }

    
        public function Add($id, $nombre, $calle, $numero, $capacidad, $apertura, $cierre, $valor_entrada) {
            $cine = new Cine($id, $nombre, $calle, $numero, $capacidad, $apertura, $cierre, $valor_entrada);
            $this->cineDAO->Add($cine);

            $this->ShowDashboardView();
        }

        public function Remove($id)
        {
            $this->cineDAO->Remove($id);

            $this->ShowDashboardView();
        }

        public function returnCine($id)
        {
           return $this->cineDAO->returnCine($id);
        }

        public function GetAll()
        {
            return $this->cineDAO->GetAll();
        }

        
        public function Modify($id, Cine $cine)
        {
            $this->cineDAO->Modify($id, $cine);

        }

        public function ModifyModal($id, $nombre, $calle, $nunero, $capacidad, $apertura, $cierre, $valor_entrada)
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
    }
?>