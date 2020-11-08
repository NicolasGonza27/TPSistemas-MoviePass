<?php
    namespace Controllers;

    use DAObd\CineDAO as CineDAO;
    use DAObd\SalaDAO as SalaDAO;
    use DAObd\TipoSalaDAO;
    use Models\Sala as Sala;
    use Exception;

    class SalaController
    {

        private $tipoSalaDao;
        private $salaDAO;
        private $cineDAO;
        
        public function __construct()
        {
            $this->tipoSalaDao = new TipoSalaDAO();
            $this->salaDAO = new SalaDAO();
            $this->cineDAO = new CineDAO();
        }
        
        
        public function ShowSalaDashboardView($id_cine)
        {   
            try
            {
                $cine = $this->cineDAO->GetOnewithCapacity($id_cine);
                $listaSala = $this->GetAllByCine($id_cine);
                $listTiposSalas = $this->tipoSalaDao->GetAll();
                $lastIdOfSalaByCine = $this->salaDAO->GetLastSalaNumberByCine($cine->GetId());
                require_once(VIEWS_PATH."Views-Admin/SalaDashboard.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

    
        public function Add($id_cine,$numero_sala,$tipo_sala, $nombre_sala, $cant_butacas)
        {
            try
            {
                $sala = new Sala(null,$tipo_sala, $id_cine, $numero_sala, $nombre_sala, $cant_butacas);
                $this->salaDAO->Add($sala);
                $this->ShowSalaDashboardView($id_cine);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function Remove($id, $id_cine)
        {
            try
            {
                $this->salaDAO->Remove($id);

                $this->ShowSalaDashboardView($id_cine);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function returnCine($id_cine)
        {
            try
            {
                return $this->cineDAO->GetOneWithCapacity($id_cine);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
        
        public function Modify($id_sala, Sala $sala)
        {
            try
            {
                $this->salaDAO->Modify($id_sala, $sala);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ModifyModal($id_sala, $id_cine, $numero_sala,$tipo_sala, $nombre_sala, $cant_butacas)
        {
            try
            {
                $sala  = new Sala($id_sala, $tipo_sala,$id_cine, $numero_sala, $nombre_sala, $cant_butacas);
                $this->salaDAO->Modify($id_sala, $sala);
                
                $this->ShowSalaDashboardView($id_cine);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllByCine($id_cine)
        {
            try
            {
                return $this->salaDAO->GetAllByCine($id_cine);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
            
        }
    }