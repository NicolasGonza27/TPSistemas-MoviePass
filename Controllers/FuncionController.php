<?php
    namespace Controllers;

    use DAO\FuncionDAO as FuncionDAO;
    use Models\Funcion as Funcion;

    class FuncionController
    {
        private $funcionDAO;

        public function __construct()
        {
            $this->funcionDAO = new FuncionDAO();
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
    }