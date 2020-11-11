<?php
    namespace Controllers;

    use DAObd\MovieDAO as MovieDAO;
    use DAObd\CineDAO as CineDAO;
    use DAObd\FuncionDAO as FuncionDAO;
    use DAObd\PoliticaDescuentoDAO as PoliticaDescuentoDAO;
    use DAObd\SalaDAO as SalaDAO;
    use Models\Funcion as Funcion;
    use Exception;

    class FuncionController
    {
        private $funcionDAO;
        private $movieDAO;
        private $cineDAO;
        private $salaDAO;
        private $politicaDescuentoDAO;

        public function __construct()
        {
            $this->funcionDAO = new FuncionDAO();
            $this->movieDAO = new MovieDAO();
            $this->cineDAO = new CineDAO();
            $this->salaDAO = new SalaDAO();
            $this->politicaDescuentoDAO = new PoliticaDescuentoDAO();

        }

    
        public function Add($id_pelicula, $id_sala, $cant_asistentes, $fecha_hora) 
        {
            $funcion = new Funcion(null, $id_pelicula, $id_sala, $cant_asistentes, $fecha_hora);
            $movie = $this->movieDAO->GetOne($id_pelicula);
            $error = 0;

                try
                {
                    if ( ($this->VerifyTimeFuncion($fecha_hora, $movie->getRuntime(), $id_sala)) &&
                    ($this->VerifyCineFuncion($fecha_hora, $id_pelicula)) )
                    {
                        $this->funcionDAO->Add($funcion);    
                    }
                    else 
                    {
                        $error = 1;
                    }

                    $this->ShowContentMovieFuncionesViews($id_pelicula, $error);
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                }
        }

        public function Remove($id,$id_movie)
        {
            try
            {
                $this->funcionDAO->Remove($id);
                $this->ShowContentMovieFuncionesViews($id_movie);
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
                return $this->funcionDAO->GetAll();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        
        public function Modify($id_funcion, Funcion $funcion)
        {

            try
            {
                $this->funcionDAO->Modify($id_funcion, $funcion);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }

        }

        public function ModifyModal($id_funcion, $id_pelicula, $id_sala, $cant_asistentes, $fecha_hora)
        {
            
            try
            {
                $funcion = new Funcion($id_funcion, $id_pelicula, $id_sala, $cant_asistentes, $fecha_hora);
                $movie = $this->movieDAO->GetOne($id_pelicula);
                $error = 0;

                if ( ($this->VerifyTimeFuncion($fecha_hora, $movie->getRuntime(), $id_sala, $id_funcion)) &&
                    ($this->VerifyCineFuncion($fecha_hora, $id_pelicula, $id_funcion)) )
                {
                    $this->funcionDAO->Modify($id_funcion, $funcion);  
                }
                else 
                {
                    $error = 1;
                }

                $this->ShowContentMovieFuncionesViews($id_pelicula, $error);

            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }

        }

        public function ShowContentMovieFuncionesViews($id, $error = 0)
        {   
            try
            {
                $movie = $this->movieDAO->GetOne($id);
                $listFunciones = $this->funcionDAO->GetAllByMovie($id);
                $listCines = $this->cineDAO->GetAllWithCapacity();
                $salaDao = $this->salaDAO;
                $infoFunciones = $this->funcionDAO->GetAllByMovieInfo($id);
                require_once(VIEWS_PATH."Views-Admin/content-movie-funciones.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowContentMovieFuncionesViewsCliente($id)
        {
            try
            {
                $movie = $this->movieDAO->GetOne($id);
                $infoFunciones = $this->funcionDAO->GetAllByMovieInfo($id);
                require_once(VIEWS_PATH."Views-Cliente/content-movie.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowContentMovieFuncionesViewsNotLogin($id)
        {
            try
            {
                $movie = $this->movieDAO->GetOne($id);
                $infoFunciones = $this->funcionDAO->GetAllByMovieInfo($id);
                require_once(VIEWS_PATH."/content-movie-not-login.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowCarteleraViews()
        {
            try
            {
                require_once(VIEWS_PATH."Views-Admin/cartelera.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function getMovieListConFuncion()
        {
            try
            {
                $movieList = $this->movieDAO->GetAll();
                $funcionList = $this->funcionDAO->GetAll();
                $movieListRta = array();

                foreach($funcionList as $funcion) 
                {
                    foreach($movieList as $movie) 
                    {
                        if (($funcion->getId_pelicula() == $movie->getId()) && (!in_array($movie, $movieListRta))) 
                        {
                            array_push($movieListRta, $movie);
                        }
                    }
                }

                require_once(VIEWS_PATH."Views-Admin/cartelera.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        /* public function getMovieListConFuncion()
        {
            $movieListRta = $this->movieDAO->GetAllHaveFunciones();
            require_once(VIEWS_PATH."Views-Admin/cartelera.php");
        } */

        public function getMovieListSinFuncion()
        {
            try
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetArrayCineSalas()
        {
            try
            {
                $listCineSalas = array();
                $listCine = $this->cineDAO->GetAllWithCapacity();

                foreach ($listCine as $cine) {
                    $listCineSalas[$cine] = $this->salaDAO->GetAllByCine($cine->getId());
                }

                return $listCineSalas;
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowBuyTicketsView($id_funcion, $quantity = 1)
        {
            try
            {
                $error = 0;
                $funcion = $this->funcionDAO->GetOne($id_funcion);
                $movie = $this->movieDAO->GetOne($funcion->getId_pelicula());
                $infoUnaFuncion = $this->funcionDAO->GetOneByMovieInfo($funcion->getId_pelicula());
                $cine = $this->cineDAO->GetOne($infoUnaFuncion["id_cine"]);
                /* date('N')-1 
                p_d.id_politica_descuento AS id_politica_descuento,
                p_dxdia.dia_de_la_semana AS dia_de_la_semana, 
                p_d.porcentaje_descuento AS porcentaje_descuento*/
                $porcentaje_descuento = $this->politicaDescuentoDAO->GetOnePorcentajeDeDescuentoPorDia(1);
                $porcentaje = null;
                if(isset($porcentaje_descuento["porcentaje_descuento"])){
                    $porcentaje = $porcentaje_descuento["porcentaje_descuento"];
                }
                $politica_descuento_id = null;
                if(isset($porcentaje_descuento["id_politica_descuento"])){
                    $politica_descuento_id = $porcentaje_descuento["id_politica_descuento"];
                }
                
                if(!$porcentaje){
                    $porcentaje = 0;
                }
                require_once(ROOT.'mercadoPago.php');

                require_once(VIEWS_PATH."Views-Cliente/compra-ticket-user.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function VerifyTimeFuncion($time, $movie_runtime, $id_sala, $id_funcion = null)
        {
            try
            {
                $listFunciones = $this->funcionDAO->GetAllFuncionesBySala($id_sala);
                $fechaHora = explode("T", $time);
                $fecha = $fechaHora[0];
                $hora = $fechaHora[1];

                $runtimeEsper = (intval($movie_runtime) + 15) * 60;

                $inicTime = strtotime($fecha." ".$hora.":00");
                $finTime = strtotime($fecha." ".$hora.":00") + $runtimeEsper;
                $midTime = $inicTime + (($finTime - $inicTime) / 2);
                
                foreach($listFunciones as $funcion) 
                {

                    if($funcion->getId_funcion() == $id_funcion) 
                    {
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
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function VerifyCineFuncion($time, $id_movie, $id_funcion = null)
        {
            try
            {
                $listFunciones = $this->funcionDAO->GetAll();
                $fechaHora = explode("T", $time);
                $fechaFuncion = $fechaHora[0];

                foreach($listFunciones as $funcion) {
                    if($funcion->getId_funcion() == $id_funcion) {
                        continue;
                    }

                    $fechaHora = explode(" ", $funcion->getFecha_hora());
                    $fecha = $fechaHora[0];
                    if (($funcion->getId_pelicula() == $id_movie) && ($fechaFuncion == $fecha)) {
                        return false;
                    }
                }

                return true;
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }
?>
