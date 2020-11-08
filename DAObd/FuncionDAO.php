<?php 

   
    namespace DAObd;

    use Models\Movie as Movie;
    use API\MovieAPI as MovieAPI;
    use PDOException;
    use Models\Funcion as Funcion;

    class FuncionDAO 
    {   

        private $connection;
        private $tableName = "funciones";

        public function Add(Funcion $funcion)
        {

            try 
            {
               $query = "INSERT INTO ".$this->tableName." (id_pelicula,id_sala,cant_asistentes,fecha_hora,eliminado) VALUES 
               (:id_pelicula,:id_sala,:cant_asistentes,:fecha_hora,:eliminado);";
                
               $this->connection = Connection::GetInstance();
               
               $parameters["id_pelicula"] = $funcion->getId_pelicula();
               $parameters["id_sala"] = $funcion->getId_sala();
               $parameters["cant_asistentes"] = $funcion->getCant_asistentes();
               $parameters["fecha_hora"] = $funcion->getFecha_hora();
               $parameters["eliminado"] = false;

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
                throw new PDOException($e->getMessage());
            }
        }

        public function GetAllByMovie($id_movie)
        {
            try 
            {
                $query = "SELECT 
                *
                FROM peliculas_cartelera p
                INNER JOIN funciones f
                ON p.id = f.id_pelicula
                WHERE (id = :id) AND (f.eliminado = :eliminado);";

                $parameters["id"] = $id_movie;
                $parameters["eliminado"] = false;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    $newResultSet =  $this->mapear($resultSet);
                
                    return  $newResultSet;
                }

                return  array();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetAllByMovieInfo($id_movie, bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT
                c.id_cine, c.nombre_cine, c.calle, c.numero, s.numero_sala, s.cant_butacas - f.cant_asistentes as 'butacas_disp', f.fecha_hora, f.id_funcion, p.id as id_pelicula
                FROM funciones f 
                INNER JOIN peliculas_cartelera p
                ON f.id_pelicula = p.id
                INNER JOIN salas s
                ON f.id_sala = s.id_sala
                INNER JOIN cines c
                ON s.id_cine = c.id_cine
                WHERE (p.id = :id) AND (f.eliminado = :eliminado);";

                $parameters["id"] = $id_movie;
                $parameters["eliminado"] =  $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    return  $resultSet;
                }

                return  array();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }
        
        public function GetAllEntradasXcine(bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT cines.id_cine, ifnull(cantidad,0) as cantidad
                from cines as cines
                left join (select cines.id_cine, sum(c.cant_entradas) as cantidad
                from compras c
                inner join entradas e
                on c.id_compra = e.id_compra
                inner join funciones f
                on e.id_funcion = f.id_funcion
                inner join salas s
                on s.id_sala = f.id_sala
                inner join cines cines
                on s.id_cine = cines.id_cine
                where (c.eliminado = :eliminado) and (e.eliminado = :eliminado) and (f.eliminado = :eliminado) and (s.eliminado = :eliminado) and (cines.eliminado = :eliminado)
                group by cines.id_cine
                ) as cantidad2
                on cines.id_cine = cantidad2.id_cine
                where (cines.eliminado = :eliminado);";
                

                $parameters["eliminado"] =  $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    return  $resultSet;
                }

                return  array();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetAllEntradasXfuncion(bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT f.id_funcion, ifnull(entradas,0) as entradas
                from funciones f
                left join (select e.id_funcion, sum(c.cant_entradas) as entradas
                from compras c
                inner join entradas e
                on c.id_compra = e.id_compra
                inner join funciones f
                on e.id_funcion = f.id_funcion
                where (c.eliminado = :eliminado) and (f.eliminado= :eliminado) and(e.eliminado = :eliminado)
                group by e.id_funcion) as cantidad
                on f.id_funcion = cantidad.id_funcion
                where f.eliminado = false;";
                

                $parameters["eliminado"] =  $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    return  $resultSet;
                }

                return  array();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetAllEntradasXpelicula(bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT cine.id_cine, s.id_sala, e.id_funcion, f.id_pelicula, ifnull(sum(c.cant_entradas),0) as entradas, s.cant_butacas
                from cines cine
                left join salas s
                on cine.id_cine = s.id_cine
                left join funciones f
                on s.id_sala = f.id_sala
                left join entradas e
                on f.id_funcion = e.id_funcion
                left join compras c
                on c.id_compra = e.id_compra
                left join peliculas_cartelera p
                on p.id = f.id_pelicula
                where (p.eliminado = :eliminado)
                group by cine.id_cine, s.id_sala, e.id_funcion, f.id_pelicula;";
                

                $parameters["eliminado"] =  $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    return  $resultSet;
                }

                return  array();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetOneByMovieInfo($id_movie, bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT
                c.id_cine, c.nombre_cine, c.calle, c.numero, s.numero_sala, s.cant_butacas - f.cant_asistentes as 'butacas_disp', f.fecha_hora, f.id_funcion, p.id as id_pelicula
                FROM funciones f 
                INNER JOIN peliculas_cartelera p
                ON f.id_pelicula = p.id
                INNER JOIN salas s
                ON f.id_sala = s.id_sala
                INNER JOIN cines c
                ON s.id_cine = c.id_cine
                WHERE (p.id = :id) AND (f.eliminado = :eliminado);";

                $parameters["id"] = $id_movie;
                $parameters["eliminado"] =  $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    return  $resultSet[0];
                }

                return  array();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetAllInfoFunctions( bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT
                c.id_cine, c.nombre_cine, c.calle, c.numero, p.title, s.numero_sala, s.cant_butacas - f.cant_asistentes as 'butacas_disp', f.fecha_hora, f.id_funcion, p.id as id_pelicula
                FROM funciones f 
                INNER JOIN peliculas_cartelera p
                ON f.id_pelicula = p.id
                INNER JOIN salas s
                ON f.id_sala = s.id_sala
                INNER JOIN cines c
                ON s.id_cine = c.id_cine
                WHERE (f.eliminado = :eliminado);";

                $parameters["eliminado"] =  $eliminado;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    return  $resultSet;
                }

                return  array();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }   

        public function GetAllFuncionesBySala($id_sala)
        {
            try 
            {
                $query = "SELECT 
                *
                FROM salas s
                INNER JOIN funciones f
                ON s.id_sala = f.id_sala
                WHERE (s.id_sala = :id_sala) AND (f.eliminado = :eliminado);";

                $parameters["id_sala"] = $id_sala;
                $parameters["eliminado"] = false;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet) 
                {
                    $newResultSet =  $this->mapear($resultSet);

                    if(count($newResultSet) > 1) {
                        return  $newResultSet;
                    }
                    else {
                        return  $newResultSet[0];
                    }
                }

                return  array();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }


        public function GetOne($id_funcion)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".id_funcion = :id_funcion";

                $this->connection = Connection::GetInstance();

                $parameters["id_funcion"] = $id_funcion;

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
                throw new PDOException($e->getMessage());
            }
        }

        public function Remove($id_funcion)
        {     
            try 
            {

                $query = "UPDATE ".$this->tableName." SET eliminado = :eliminado
                WHERE (id_funcion = :id_funcion);";

                $this->connection = Connection::GetInstance();

                $parameters['id_funcion'] = $id_funcion;
                $parameters['eliminado'] = true;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function Modify($id_funcion,Funcion $newFuncion)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET id_pelicula = :id_pelicula, id_sala = :id_sala, cant_asistentes  = :cant_asistentes, fecha_hora = :fecha_hora
                WHERE (id_funcion = :id_funcion);";

                $this->connection = Connection::GetInstance();

                $parameters["id_funcion"] = $id_funcion;
                $parameters["id_pelicula"] = $newFuncion->getId_pelicula();
                $parameters["id_sala"] = $newFuncion->getId_sala();
                $parameters["cant_asistentes"] = $newFuncion->getCant_asistentes();
                $parameters["fecha_hora"] = $newFuncion->getFecha_hora();

                return $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        protected function mapear($salas)
        {   
            $resp = array_map(function($p)
            {
                return new Funcion($p['id_funcion'],$p['id_pelicula'],$p['id_sala'],$p['cant_asistentes'],$p['fecha_hora']);
            }, $salas);

        return $resp;
        }


    }

?>

