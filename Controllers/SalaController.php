<?php
    namespace Controllers;

    use DAO\SalaDAO as SalaDAO;
    use Controllers\CineControllers as CineControllers;
    use Models\Sala as Sala;

    class SalaController
    {
        private $salaDAO;
        private $CineControllers;
        
        public function __construct()
        {
            $this->salaDAO = new SalaDAO();
            $this->CineControllers = new CineControllers();
        }
        
        
       /*  public function ShowDashboardView()
        {
            require_once(VIEWS_PATH."Views-Admin/dashboard.php");
        } */

    
        public function Add($id_sala, $id_cine, $numero_sala, $nombre_sala, $cant_butacas)
            $sala = new Sala($id_sala, $id_cine, $numero_sala, $nombre_sala, $cant_butacas);
            $this->funcionDAO->Add($sala);

            /* $this->ShowDashboardView(); */
        }

        public function Remove($id)
        {
            $this->salaDAO->Remove($id);

            /* $this->ShowDashboardView(); */
        }

        public function returnCine($id_cine)
        {
           return $this->CineControllers->returnCine($id_cine);
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
            
            /* $this->ShowDashboardView(); */
        }
    }