<?php
    namespace Controllers;

    use DAObd\CineDAO as CineDAO;
    use DAObd\CompraDAO as CompraDAO;
    use Models\Compra as Compra;
    use DAObd\EntradaDAO as EntradaDAO;
    use DAObd\FuncionDAO as FuncionDAO;
    use DAObd\MovieDAO as MovieDAO;
    use DAObd\PoliticaDescuentoDAO as PoliticaDescuentoDAO;
    use Models\Entrada as Entrada;
    use Exception;

    use Models\Usuario as Usuario;


    class EntradaController
    {
        private $entradaDAO;
        private $compraDAO;
        private $funcionDAO;
        private $movieDAO;
        private $cineDAO;
        private $politicaDescuentoDAO;

        public function __construct()
        {
            $this->entradaDAO = new EntradaDAO();
            $this->compraDAO = new CompraDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->movieDAO = new MovieDAO();
            $this->cineDAO = new CineDAO();
            $this->politicaDescuentoDAO = new PoliticaDescuentoDAO();
        }

        public function Add($id_compra, $id_funcion, $nro_entrada) 
        {   
            try
            {
                $entrada = new Entrada(null,$id_compra,$id_funcion,$nro_entrada);
                $this->entradaDAO->Add($entrada);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function Remove($id)
        {
            try
            {
                $this->entradaDAO->Remove($id);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetOne($id)
        {
            try
            {
                return $this->entradaDAO->GetOne($id);
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
                return $this->entradaDAO->GetAll();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        
        public function Modify($id, Entrada $entrada)
        {   
            try
            {
                $this->entradaDAO->Modify($id, $entrada);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllByCompra($id_compra)
        {   
            try
            {
                return $this->entradaDAO->GetAllByCompra($id_compra);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function ShowContentsCompraViews($id_compra)
        {
            try
            {
                $listEntradas = $this->GetAllByCompra($id_compra);
                require_once(VIEWS_PATH."Views-Cliente/content-compra.php");
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function comprarEntradas($cant_entradas, $monto_compra, $id_funcion, $politica_descuento, $numero_tarjeta) 
        {
            //Compra : id_usuario, id_politica_descuento, cant_entradas, monto Entradas: $id_compra, $id_funcion, $nro_entrada
            try
            {
                $error = 0;
                if(($numero_tarjeta[0] == "4") || ($numero_tarjeta[0] == "5")) {
                    $user = $_SESSION["userLogged"];

                    if($politica_descuento == ""){
                        $politica_descuento = null;
                    }
                    $compra = new Compra(null, $user->getId_usuario(), $politica_descuento, $cant_entradas, $monto_compra, date("Y") .'-'.date("m").'-'.date("d"));
                    $this->compraDAO->Add($compra);
                    $rta = $this->compraDAO->GetAll();
                    $pasar_compra = $rta[array_key_last($rta)];
                    
                    for( $i=0 ; $i<$cant_entradas ; $i++) {
                        $numero_entrada = $this->entradaDAO->AutoincrementalNumEntradaXFuncion($id_funcion);
                        $this->Add($pasar_compra->getId_compra(), $id_funcion, $numero_entrada);
                    }
                }
                else {
                    $error = 1;
                }

                if($error == 0){
                    $funcionNuevaCant = $this->funcionDAO->GetOne($id_funcion);
                    $adidtentes_restar = $funcionNuevaCant->getCant_asistentes();
                    $funcionNuevaCant->setCant_asistentes($adidtentes_restar + $cant_entradas);
                    $this->funcionDAO->Modify($id_funcion, $funcionNuevaCant);
                    $this->ShowContentsCompraViews($pasar_compra->getId_compra());
                    /*$para   = 'niclausegonzalez@gmail.com';
                    $titulo    = 'El título';
                    $mensaje   = 'Hola';

                    mail($para, $titulo, $mensaje); */
                }
                else {
                    $quantity = $cant_entradas;
                    $funcion = $this->funcionDAO->GetOne($id_funcion);
                    $movie = $this->movieDAO->GetOne($funcion->getId_pelicula());
                    $infoUnaFuncion = $this->funcionDAO->GetOneByMovieInfo($funcion->getId_pelicula());
                    $cine = $this->cineDAO->GetOne($infoUnaFuncion["id_cine"]);
                    $porcentaje_descuento = $this->politicaDescuentoDAO->GetOnePorcentajeDeDescuentoPorDia(date('N')-1);
                    $porcentaje = $porcentaje_descuento["porcentaje_descuento"];
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
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

    }
?>

