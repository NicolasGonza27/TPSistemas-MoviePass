<?php

namespace DAObd;

use Models\Fbook as Fbook;
use Models\Usuario as Usuario;
use PDOException;

class FbDAO{
   
    private $connection;
    private $tableName = "fbook";

    /* public function Add(Usuario $usuario, Facebook $user)
        {
            try
            {
                $query = "INSERT INTO ".$this->$tableNameAUX." (id_tipo_usuario,nombre_usuario,apellido_usuario,dni,email,pass_usuario,fecha_nac,eliminado) 
                VALUES (:id_tipo_usuario,:nombre_usuario,:apellido_usuario,:dni,:email,:pass_usuario,:fecha_nac,:eliminado);";
                
                $nombre_completo = $user->getName_user();
                $arregloNombre = explode(" ", $nombre_completo);

                $usuario->setId_tipo_usuario($user->getTipo_usuario());
                $usuario->setEmail($user->getEmail());

                $parameters["id_tipo_usuario"] = $usuario->getId_tipo_usuario();
                $parameters["nombre_usuario"] = $arregloNombre[0];
                $parameters["apellido_usuario"] = $arregloNombre[1];
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

        }    */

        public function AddUser(Fbook $user)
        {
            try
            {
                $query = "INSERT INTO fbook (id, id_usuario) 
                VALUES (:id, :id_usuario);";
                
                $parameters["id"] = $user->getId();
                $parameters["id_usuario"] = $user->getId_user();
                
                $this->connection = Connection::GetInstance();
                
                
                return $this->connection->ExecuteNonQuery($query,$parameters);
                
               
            }
            catch(PDOException $e)
            {   
                throw new PDOException($e->getMessage());
            }

        }

        public function GetAll()
        {
            try 
            {
                $query = "SELECT *
                from usuarios
                inner join fbook
                on usuarios.id_usuario = fbook.id_usuario;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
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

        protected function mapear($usuarios)
        {   
            $resp = array_map(function($p)
            {
                return new Fbook($p['id'],$p['nombre_usuario'],$p['email'],$p['id_usuario']);
            }, $usuarios);

            return $resp;
        }


}

?>