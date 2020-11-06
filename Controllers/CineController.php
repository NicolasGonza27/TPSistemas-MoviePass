<?php
    namespace Controllers;

    use DAObd\CineDAO as CineDAO;
    use Models\Cine as Cine;
    use DAObd\SalaDAO as SalaDAO;

    class CineController
    {
        private $cineDAO;
        private $salaDAO;

        public function __construct()
        {
            $this->cineDAO = new CineDAO();
            $this->salaDAO = new SalaDAO();
        }
        
        
        public function ShowDashboardView(){
            $listaCines = $this->cineDAO->GetAllWithCapacity();
            require_once(VIEWS_PATH."Views-Admin/dashboard.php");
        }

    
        public function Add($nombre, $calle, $numero, $capacidad, $apertura, $cierre, $valor_entrada) {
            $cine = new Cine(null, $nombre, $calle, $numero, $capacidad, $apertura, $cierre, $valor_entrada);
            $this->cineDAO->Add($cine);

            $this->ShowDashboardView();
        }

        public function Remove($id)
        {
            $this->cineDAO->Remove($id);

            $this->ShowDashboardView();
        }

        public function GetOne($id)
        {
           return $this->cineDAO->GetOneWithCapacity($id);
        }

        public function GetAll()
        {
            
            return $this->cineDAO->GetAllWithCapacity();
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