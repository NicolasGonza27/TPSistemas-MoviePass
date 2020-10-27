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

    
        public function Add($id_pelicula, $id_sala, $cant_asistentes, $fecha_hora) {
            $funcion = new Funcion(null, $id_pelicula, $id_sala, $cant_asistentes, $fecha_hora);
            $movie = $this->movieDAO->GetOne($id_pelicula);
            if ($this->VerifyTimeFuncion($fecha_hora, $movie->getRuntime(), $id_sala)){
                $this->funcionDAO->Add($funcion);    
            }
            else {
                echo "<script>alert('La fecha y hora de la sala que ha indicado no estan disponibles para programaresta funcion, verifique los horarios e intente nuevamente');</script>";
            }

            $this->ShowContentMovieFuncionesViews($id_pelicula);
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

        public function ModifyModal($id_funcion, $id_pelicula, $id_sala, $cant_asistentes, $fecha_hora)
        {
            $funcion = new Funcion($id_funcion, $id_pelicula, $id_sala, $cant_asistentes, $fecha_hora);
            $movie = $this->movieDAO->GetOne($id_pelicula);
            if ($this->VerifyTimeFuncion($fecha_hora, $movie->getRuntime(), $id_sala, $id_funcion)){
                $this->funcionDAO->Modify($id_funcion, $funcion);  
            }
            else {
                echo "<script>alert('La fecha y hora de la sala que ha indicado no estan disponibles para programaresta funcion, verifique los horarios e intente nuevamente');</script>";
            }

            $this->ShowContentMovieFuncionesViews($id_pelicula);
        }

        public function ShowContentMovieFuncionesViews($id)
        {
            $movie = $this->movieDAO->GetOne($id);
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
            $movieList = $this->movieDAO->GetAll();
            $funcionList = $this->funcionDAO->GetAll();
            $movieListRta = array();

            foreach($funcionList as $funcion) {
                foreach($movieList as $movie) {
                    if (($funcion->getId_pelicula() == $movie->getId()) && (!in_array($movie, $movieListRta))) {
                        array_push($movieListRta, $movie);
                    }
                }
            }

            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        /* public function getMovieListConFuncion()
        {
            $movieListRta = $this->movieDAO->GetAllHaveFunciones();
            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        } */

        public function getMovieListSinFuncion()
        {
            $movieList = $this->movieDAO->GetAll();
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

        public function VerifyTimeFuncion($time, $movie_runtime, $id_sala, $if_funcion = null)
        {
            $listFunciones = $this->funcionDAO->GetAllFuncionesBySala($id_sala);

            $fechaHora = explode("T", $time);
            $fecha = $fechaHora[0];
            $hora = $fechaHora[1];

            $runtimeEsper = (intval($movie_runtime) + 15) * 60;

            $inicTime = strtotime($fecha." ".$hora.":00");
            $finTime = strtotime($fecha." ".$hora.":00") + $runtimeEsper;
            $midTime = $inicTime + (($finTime - $inicTime) / 2);
            
            foreach($listFunciones as $funcion) {

                if($funcion->getId_funcion() == $if_funcion) {
                    continue;
                }

                $inicFuncionTime = $funcion->getFecha_hora();
                $fechaHora = explode(" ", $inicFuncionTime);
                $fecha = $fechaHora[0];
                $hora = $fechaHora[1];

                $runtimeEsper = (intval($movie_runtime) + 15) * 60;
                
                $inicFuncion = strtotime($inicFuncionTime);
                $finFuncion = strtotime($fecha." ".$hora) + $runtimeEsper;

                if((($inicTime >= $inicFuncion) && ($inicTime <= $finFuncion)) ||
                    (($midTime >= $inicFuncion) && ($midTime <= $finFuncion)) ||
                    (($finTime >= $inicFuncion) && ($finTime <= $finFuncion))) {
                    return false;
                }
            }

            return true;
        }
    }
?>
