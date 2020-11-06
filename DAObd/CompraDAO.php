<?php 

    namespace DAObd;

    use Models\Compra as Compra;
    use PDOException;

    class CompraDAO
    {

        private $connection;
        private $tableName = "compras";


        public function Add(Compra $compra)
        {
            try 
            {
               $query = "INSERT INTO compras (id_usuario,id_politica_descuento,cant_entradas,monto,eliminado) VALUES (:id_usuario,:id_politica_descuento,:cant_entradas,:monto,:eliminado);";

               $parameters["id_usuario"] = $compra->getId_usuario();
               $parameters["id_politica_descuento"] = $compra->getId_politica_descuento();
               $parameters["cant_entradas"] = $compra->getCant_entradas();
               $parameters["monto"] = $compra->getMonto();
               $parameters["eliminado"] = false;
               
               $this->connection = Connection::GetInstance();

               return $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAll(bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE eliminado = :eliminado;";

                $parameters["eliminado"] = $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    $newResultSet =  $this->mapear($resultSet);
                
                    return  $newResultSet;
                }

                return  false;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetOne($id_compra)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".id_compra = :id_compra";

                $this->connection = Connection::GetInstance();

                $parameters['id_compra'] = $id_compra;

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    $newResultSet =  $this->mapear($resultSet);

                    return  $newResultSet[0];
                }

                return false;

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function GetAllByUser($id_usuario,bool $eliminado = false)
        {

            try 
            {
                $query = "SELECT
                          c.id_compra as  id_compra,
                          c.id_usuario as id_usuario,
                          ifnull(p.porcentaje_descuento,0) as porcentaje_descuento,
                          c.cant_entradas as cant_entradas,
                          c.monto as monto
                          FROM compras c
                          INNER JOIN politicas_descuento p
                          ON c.id_politica_descuento = p.id_politica_descuento
                          WHERE ( (c.eliminado = :eliminado) AND (c.id_usuario = :id_usuario) );";

                $parameters["eliminado"] = $eliminado;
                $parameters["id_usuario"] = $id_usuario;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    return $resultSet;
                }

                return  false;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }


        }

        

        public function Remove($id_compra)
        {     
            try 
            {

                $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado
                WHERE (id_compra = :id_compra);";

                $this->connection = Connection::GetInstance();

                $parameters['id_compra'] = $id_compra;
                $parameters['eliminado'] = true;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;
            

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function Modify($id,Compra $newCompra)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET nombre_cine = :nombre_cine, calle = :calle, numero = :numero, hora_apertura = :hora_apertura, hora_cierre = :hora_cierre, valor_entrada = :valor_entrada
                WHERE (id_compra = :id_compra);";

                $this->connection = Connection::GetInstance();
                
                $parameters["id_usuario"] = $newCompra->getId_usuario();
                $parameters["id_politica_descuento"] = $newCompra->getId_politica_descuento();
                $parameters["cant_entradas"] = $newCompra->getCant_entradas();
                $parameters["monto"] = $newCompra->getMonto();

                $parameters["id_compra"] = $id;
                
                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }   

        protected function mapear($compras)
        {
            $resp = array_map(function($p)
            {
                return new Compra($p['id_compra'],$p['id_usuario'],$p['id_politica_descuento'],$p['cant_entradas'],$p['monto']);
            }, $compras);

            return $resp;
        }

    }



?>