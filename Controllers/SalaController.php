<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use DAO\SalaDAO as SalaDAO;
    use Models\Sala as Sala;

    class SalaController
    {
        private $salaDAO;
        private $cineDAO;
        
        public function __construct()
        {
            $this->salaDAO = new SalaDAO();
            $this->cineDAO = new CineDAO();
        }
        
        
        public function ShowSalaDashboardView($id_cine)
        {
            $cine = $this->cineDAO->returnCine($id_cine);
            $listaSala = $this->GetSalaListXCineId($id_cine);
            require_once(VIEWS_PATH."Views-Admin/SalaDashboard.php");
        }

    
        public function Add($id_sala, $id_cine, $numero_sala, $nombre_sala, $cant_butacas)
        {
            $sala = new Sala($id_sala, $id_cine, $numero_sala, $nombre_sala, $cant_butacas);
            $this->salaDAO->Add($sala);

            $this->ShowSalaDashboardView($id_cine);
        }

        public function Remove($id, $id_cine)
        {
            $this->salaDAO->Remove($id);

            $this->ShowSalaDashboardView($id_cine);
        }

        public function returnCine($id_cine)
        {
           return $this->cineDAO->returnCine($id_cine);
        }

        public function GetAll()
        {
            return $this->salaDAO->GetAll();
        }

        
        public function Modify($id_sala, Sala $sala)
        {
            $this->salaDAO->Modify($id_sala, $sala);

        }

        public function ModifyModal($id_sala, $id_cine, $numero_sala, $nombre_sala, $cant_butacas)
        {
            $sala  = new Sala($id_sala, $id_cine, $numero_sala, $nombre_sala, $cant_butacas);
            $this->salaDAO->Modify($id_sala, $sala);
            
            $this->ShowSalaDashboardView($id_cine);
        }

        public function GetSalaListXCineId($id_cine)
        {
            return $this->salaDAO->GetSalaListXCineId($id_cine);
        }
    }