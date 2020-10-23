<?php
    namespace Controllers;

    use DAObd\MovieDAO as MovieDAO;
    use DAObd\CineDAO as CineDAO;
    use DAObd\FuncionDAO as FuncionDAO;
    use DAObd\SalaDAO as SalaDAO;
    use Models\Funcion as Funcion;

    class FuncionController
    {
        private $funcionDAO;
        private $movieDAO;
        private $cineDAO;
        private $salaDAO;

        public function __construct()
        {
            $this->funcionDAO = new FuncionDAO();
            $this->movieDAO = new MovieDAO();
            $this->cineDAO = new CineDAO();
            $this->salaDAO = new SalaDAO();
        }
        
        
       /*  public function ShowDashboardView()
        {
            require_once(VIEWS_PATH."Views-Admin/dashboard.php");
        } */

    
        public function Add($id_sala, $id_pelicula, $cant_asistentes, $fecha_hora) {
            $funcion = new Funcion(null, $id_sala, $id_pelicula, $cant_asistentes, $fecha_hora);
            $this->funcionDAO->Add($funcion);

            /* $this->ShowDashboardView(); */
        }

        public function Remove($id)
        {
            $this->funcionDAO->Remove($id);

            /* $this->ShowDashboardView(); */
        }

        public function GetAll()
        {
            return $this->funcionDAO->GetAll();
        }

        
        public function Modify($id_funcion, Funcion $funcion)
        {
            $this->funcionDAO->Modify($id_funcion, $funcion);

        }

        public function ModifyModal($id_funcion, $id_sala, $id_pelicula, $cant_asistentes, $fecha_hora)
        {
            $funcion = new Funcion($id_funcion, $id_sala, $id_pelicula, $cant_asistentes, $fecha_hora);
            $this->funcionDAO->Modify($id_funcion, $funcion);
            
            $this->ShowDashboardView();
        }

        public function ShowContentMovieFuncionesViews($id)
        {
            $movie = $this->movieAPI->GetOne($id);
            $listFunciones = $this->funcionDAO->GetAllByMovie($id);
            $listCines = $this->cineDAO->GetAll();
            $salaDao = $this->salaDAO;
            require_once(VIEWS_PATH."Views-Admin/content-movie-funciones.php");
        }

        public function ShowCarteleraViews()
        {

            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        public function getMovieListConFuncion()
        {
            $movieListRta = $this->movieDAO->GetAllHaveFunciones();
            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        public function getMovieListSinFuncion()
        {
            $movieList = $this->movieAPI->GetAll();
            $funcionList = $this->funcionDAO->GetAll();
            $movieListRta = array();

            foreach($movieList as $movie) {
                $flag = 0;
                foreach($funcionList as $funcion) {
                    if ($funcion->getId_pelicula() == $movie->getId()) {
                        $flag = 1;
                    }
                }
                if(!$flag) array_push($movieListRta, $movie);
            }

            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        public function GetArrayCineSalas()
        {
            $listCineSalas = array();
            $listCine = $this->cineDAO->GetAll();

            foreach ($listCine as $cine) {
                $listCineSalas[$cine] = $this->salaDAO->GetAllByCine($cine->getId());
            }

            return $listCineSalas;
        }
    }