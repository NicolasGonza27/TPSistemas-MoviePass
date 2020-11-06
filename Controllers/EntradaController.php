<?php
namespace Controllers;

    use DAObd\EntradaDAO as EntradaDAO;
    use Models\Entrada as Entrada;

    class EntradaController
    {
        private $entradaDAO;

        public function __construct()
        {
            $this->entradaDAO = new EntradaDAO();
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
            $this->cineDAO->Modify($id, $entrada);

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

    }
?>

