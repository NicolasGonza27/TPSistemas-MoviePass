<?php
namespace Controllers;

    use DAObd\EntradaDAO as EntradaDAO;
    use Models\Entrada as Entrada;
    use Exception;

    class EntradaController
    {
        private $entradaDAO;

        public function __construct()
        {
            $this->entradaDAO = new EntradaDAO();
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
                $this->cineDAO->Modify($id, $entrada);
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

    }
?>

