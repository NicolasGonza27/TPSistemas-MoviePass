<?php 

namespace DAObd;

use Models\TipoUsuario as TipoUsuario;
use PDOException;

    class TipoUsuarioDAO
    {
        private $connection;
        private $tableName = "tipos_usuario";

        public function Add(TipoUsuario $tipoUsuario)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName."(nombre_tipo_usuario,eliminado
                ) VALUES (:nombre_tipo_usuario,:eliminado);";
            
                $parameters["nombre_tipo_usuario"] = $tipoUsuario->getNombre_tipo_usuario();
                $parameters["eliminado"] =  false;

                $this->connection = Connection::GetInstance();
        
                return $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {   
                throw new PDOException($e->getMessage());
            }

        }   

        public function GetAll(bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE eliminado = :eliminado";

                $parameters["eliminado"] = $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                if($resultSet)
                {
                    $newResultSet = $this->mapear($resultSet);
                
                    return  $newResultSet;
                }

                return  false;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetOne($id_tipo_usuario)
            {
                try 
                {
                    $query = "SELECT * FROM ".$this->tableName." WHERE (id_tipo_usuario = :id_tipo_usuario);";

                    $this->connection = Connection::GetInstance();
                    
                    $parameters['id_tipo_usuario'] = $id_tipo_usuario;

                    $resultSet = $this->connection->Execute($query,$parameters);

                    if($resultSet)
                    {
                        $newResultSet = $this->mapear($resultSet);
                    
                        return  $newResultSet[0];
                    }
                    
                    return false;

                }
                catch(PDOException $e)
                {
                    throw new PDOException($e->getMessage());
                }
            }

        
            public function Remove($id_tipo_usuario)
            {  
                try 
                {
                    $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado  WHERE id_tipo_usuario = :id_tipo_usuario;";

                    $this->connection = Connection::GetInstance();

                    $parameters['eliminado'] = true;
                    $parameters['id_tipo_usuario'] = $id_tipo_usuario;

                    $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                    return $cantRows;

                }
                catch(PDOException $e)
                {
                    throw new PDOException($e->getMessage());
                }
            }

            public function Modify($id_tipo_usuario,TipoUsuario $tipoUsuario)
            {
                try
                {
                    $query = "UPDATE ".$this->tableName." SET nombre_tipo_usuario = :nombre_tipo_usuario
                    WHERE (id_tipo_usuario = :id_tipo_usuario);";

                    $this->connection = Connection::GetInstance();

                    $parameters["nombre_tipo_usuario"] = $tipoUsuario->getNombre_tipo_usuario();
                    $parameters["id_tipo_usuario"] = $id_tipo_usuario;

                    $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                    return  $cantRows;

                }
                catch(PDOException $e)
                {
                    throw new PDOException($e->getMessage());
                }
            }

        protected function mapear($tipos_usuarios)
            {   
                $resp = array_map(function($p)
            {
                return new TipoUsuario($p['id_tipo_usuario'],$p['nombre_tipo_usuario']);
            }, $tipos_usuarios);

            return $resp;
            }

    }



?>