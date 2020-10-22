<?php
    namespace Controllers;

    use API\MovieAPI as MovieAPI;
    use DAO\FuncionDAO as FuncionDAO;
    use Models\Funcion as Funcion;

    class FuncionController
    {
        private $funcionDAO;
        private $movieAPI;

        public function __construct()
        {
            $this->funcionDAO = new FuncionDAO();
            $this->movieAPI = new MovieAPI();
        }
        
        
       /*  public function ShowDashboardView()
        {
            require_once(VIEWS_PATH."Views-Admin/dashboard.php");
        } */

    
        public function Add($id_funcion, $id_cine, $id_pelicula, $cant_asistentes, $fecha_hora) {
            $funcion = new Funcion($id_funcion, $id_cine, $id_pelicula, $cant_asistentes, $fecha_hora);
            $this->funcionDAO->Add($funcion);

            /* $this->ShowDashboardView(); */
        }

        public function Remove($id)
        {
            $this->funcionDAO->Remove($id);

            /* $this->ShowDashboardView(); */
        }

        public function returnCine($id)
        {
           return $this->funcionDAO->returnCine($id);
        }

        public function GetAll()
        {
            return $this->funcionDAO->GetAll();
        }

        
        public function Modify($id_funcion, Funcion $funcion)
        {
            $this->cineDAO->Modify($id_funcion, $funcion);

        }

        public function ModifyModal($id_funcion, $id_cine, $id_pelicula, $cant_asistentes, $fecha_hora)
        {
            $funcion = new Funcion($id_funcion, $id_cine, $id_pelicula, $cant_asistentes, $fecha_hora);
            $this->funcionDAO->Modify($id_funcion, $funcion);
            
            $this->ShowDashboardView();
        }

        public function ShowContentMovieFuncionesViews($id)
        {
            $movie = $this->movieAPI->GetOne($id);
            $listFunciones = $this->funcionDAO->returnFuncionXid($id);
            require_once(VIEWS_PATH."Views-Admin/content-movie-funciones.php");
        }

        public function ShowCarteleraViews()
        {
            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        }

        public function getMovieListConFuncion()
        {
            $movieList = $this->movieAPI->GetAll();
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
    }