<?php
    namespace Controllers;

    use DAObd\CineDAO as CineDAO;
    use DAObd\CompraDAO as CompraDAO;
    use Models\Compra as Compra;
    use DAObd\EntradaDAO as EntradaDAO;
    use DAObd\FuncionDAO as FuncionDAO;
    use DAObd\MovieDAO as MovieDAO;
    use Models\Entrada as Entrada;
    use Models\Usuario as Usuario;

    class EntradaController
    {
        private $entradaDAO;
        private $compraDAO;
        private $funcionDAO;
        private $movieDAO;
        private $cineDAO;

        public function __construct()
        {
            $this->entradaDAO = new EntradaDAO();
            $this->compraDAO = new CompraDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->movieDAO = new MovieDAO();
            $this->cineDAO = new CineDAO();
        }

        public function Add($id_compra, $id_funcion, $nro_entrada) 
        {
            $entrada = new Entrada(null,$id_compra,$id_funcion,$nro_entrada);
            $this->entradaDAO->Add($entrada);
        }

        public function Remove($id)
        {
            $this->entradaDAO->Remove($id);
        }

        public function GetOne($id)
        {
           return $this->entradaDAO->GetOne($id);
        }

        public function GetAll()
        {
            return $this->entradaDAO->GetAll();
        }

        
        public function Modify($id, Entrada $entrada)
        {
            $this->entradaDAO->Modify($id, $entrada);

        }

        public function GetAllByCompra($id_compra)
        {
            return $this->entradaDAO->GetAllByCompra($id_compra);
        }

        public function ShowContentsCompraViews($id_compra)
        {
            $listEntradas = $this->GetAllByCompra($id_compra);
            require_once(VIEWS_PATH."Views-Cliente/content-compra.php");
        }

        public function comprarEntradas($cant_entradas, $monto_compra, $id_funcion, $numero_tarjeta) 
        {
            //Compra : id_usuario, id_politica_descuento, cant_entradas, monto Entradas: $id_compra, $id_funcion, $nro_entrada
            $error = 0;
            var_dump($numero_tarjeta);
            if(($numero_tarjeta[0] == "4") || ($numero_tarjeta[0] == "5")) {
                $user = $_SESSION["userLogged"];
                $compra = new Compra(null, $user->getId_usuario(), 1, $cant_entradas, $monto_compra, date("Y") .'-'.date("m").'-'.date("d"));
                $this->compraDAO->Add($compra);
                $rta = $this->compraDAO->GetAll();
                $pasar_compra = $rta[array_key_last($rta)];
                
                for( $i=0 ; $i<$cant_entradas ; $i++) {
                    $this->Add($pasar_compra->getId_compra(), $id_funcion, 7);
                }

            }
            else {
                $error = 1;
            }

            if($error == 0){
                $funcionNuevaCant = $this->funcionDAO->GetOne($id_funcion);
                $adidtentes_restar = $funcionNuevaCant->getCant_asistentes();
                $funcionNuevaCant->setCant_asistentes($adidtentes_restar - $cant_entradas);
                $this->funcionDAO->Modify($id_funcion, $funcionNuevaCant);
                $this->ShowContentsCompraViews($pasar_compra->getId_compra());
/* 
                $para      = 'niclausegonzalez@gmail.com';
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
                require_once(ROOT.'mercadoPago.php');

                require_once(VIEWS_PATH."Views-Cliente/compra-ticket-user.php");
            }
        }

    }
?>

