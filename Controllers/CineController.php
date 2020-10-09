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
            require_once(VIEWS_PATH."Views-Admin/dashboard.php");
        }

    
        public function Add($id, $nombre, $direccion, $apertura, $cierre, $valor_entrada)        {
            $cine = new Cine($id, $nombre, $direccion, $apertura, $cierre, $valor_entrada);
            $this->cineDAO->Add($cine);

            $this->ShowDashboardView();
        }

        public function Remove($id)
        {
            $this->cineDAO->Remove($id);

            $this->ShowDashboardView();
        }

        
        public function Modify($id, Cine $cine)
        {
            $this->cineDAO->Modify($id, $cine);

            $this->ShowDashboardView();
        }
    }
?>