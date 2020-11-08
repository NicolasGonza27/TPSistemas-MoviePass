<?php 

namespace DAObd;

use Models\Usuario as Usuario;
use PDOException;

    class UsuarioDAO
    {
        private $connection;
        private $tableName = "usuarios";

        public function Add(Usuario $usuario)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id_tipo_usuario,nombre_usuario,apellido_usuario,dni,email,pass_usuario,fecha_nac,eliminado) 
                VALUES (:id_tipo_usuario,:nombre_usuario,:apellido_usuario,:dni,:email,:pass_usuario,:fecha_nac,:eliminado);";

                $parameters["id_tipo_usuario"] = $usuario->getId_tipo_usuario();
                $parameters["nombre_usuario"] = $usuario->getNombre_usuario();
                $parameters["apellido_usuario"] = $usuario->getApellido_usuario();
                $parameters["dni"] = $usuario->getDni();
                $parameters["email"] = $usuario->getEmail();
                $parameters["pass_usuario"] = $usuario->getPassword();
                $parameters["fecha_nac"] = $usuario->getFecha_nac();
                $parameters["eliminado"] = false;

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

        public function GetOne($id_usuario)
            {
                try 
                {
                    $query = "SELECT * FROM ".$this->tableName." WHERE (id_usuario = :id_usuario);";

                    $this->connection = Connection::GetInstance();
                    
                    $parameters['id_usuario'] = $id_usuario;

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

            public function GetOneByEmail($email)
            {
                try 
                {
                    $query = "SELECT * FROM ".$this->tableName." WHERE (email = :email);";

                    $this->connection = Connection::GetInstance();
                    
                    $parameters['email'] = $email;

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
        
            public function Remove($id_usuario)
            {  
                try 
                {
                    $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado  WHERE id_usuario = :id_usuario;";

                    $this->connection = Connection::GetInstance();

                    $parameters['eliminado'] = true;
                    $parameters['id_usuario'] = $id_usuario;

                    $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                    return $cantRows;

                }
                catch(PDOException $e)
                {
                    throw new PDOException($e->getMessage());
                }
            }

            public function Modify($id_usuario,Usuario $usuario)
            {
                try
                {
                    $query = "UPDATE ".$this->tableName." SET id_tipo_usuario = :id_tipo_usuario, nombre_usuario = :nombre_usuario, apellido_usuario = :apellido_usuario, dni = :dni, email = :email, pass_usuario = :pass_usuario, fecha_nac = :fecha_nac
                    
                    WHERE (id_usuario = :id_usuario);";

                    $this->connection = Connection::GetInstance();

                    $parameters["id_usuario"] = $id_usuario;
                    $parameters["id_tipo_usuario"] = $usuario->getId_tipo_usuario();
                    $parameters["nombre_usuario"] = $usuario->getNombre_usuario();
                    $parameters["apellido_usuario"] = $usuario->getApellido_usuario();
                    $parameters["dni"] = $usuario->getDni();
                    $parameters["email"] = $usuario->getEmail();
                    $parameters["pass_usuario"] = $usuario->getPassword();
                    $parameters["fecha_nac"] = $usuario->getFecha_nac();

                    $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                    return  $cantRows;

                }
                catch(PDOException $e)
                {
                    throw new PDOException($e->getMessage());
                }
            }

        protected function mapear($usuarios)
        {   
            $resp = array_map(function($p)
            {
                return new Usuario($p['id_usuario'],$p['id_tipo_usuario'],$p['nombre_usuario'],$p['apellido_usuario'],$p['dni'],$p['email'],$p['pass_usuario'],$p['fecha_nac']);
            }, $usuarios);

            return $resp;
        }

    }



?>