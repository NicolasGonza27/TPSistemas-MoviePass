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
                left join (select cines.id_cine, count(e.id_compra) as cantidad
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
        public function GetAllEntradasXcinePesos($fecha_desde  , $fecha_hasta  )
        {
            try 
            {
                $query = "SELECT c.id_cine, ifnull(sum(cineMonto.monto),0) as cantidad
                from cines c
                left join (select e.id_compra, c.monto , s.id_cine, c.fecha_compra
                from entradas e 
                inner join compras c 
                on c.id_compra = e.id_compra 
                inner join funciones f
                on e.id_funcion = f.id_funcion
                inner join salas s
                on s.id_sala = f.id_sala
                inner join cines cines
                on s.id_cine = cines.id_cine
                where (c.fecha_compra >= :fecha_desde) and (c.fecha_compra <= :fecha_hasta)
                 group by e.id_compra, s.id_cine) as cineMonto
                on cineMonto.id_cine = c.id_cine
                group by c.id_cine;";
                

                $parameters["fecha_desde"] =  $fecha_desde;
                $parameters["fecha_hasta"] =  $fecha_desde;


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
                echo $e->getMessage();
            }
        }

        public function GetAllEntradasXfuncion(bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT f.id_funcion, ifnull(entradas,0) as entradas, ifnull(s.cant_butacas-entradas, s.cant_butacas) as disponible
                from funciones f
                left join (select e.id_funcion, count(e.id_compra) as entradas
                from compras c
                inner join entradas e
                on c.id_compra = e.id_compra
                inner join funciones f
                on e.id_funcion = f.id_funcion
                where (c.eliminado = :eliminado) and (f.eliminado= :eliminado) and(e.eliminado = :eliminado)
                group by e.id_funcion) as cantidad
                on f.id_funcion = cantidad.id_funcion
                left join salas s
                on f.id_sala = s.id_sala
                where (f.eliminado = :eliminado);";
                

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

        public function GetAllEntradasXpelicula()
        {
            try 
            {
                $query = "SELECT peliculas.id_pelicula, peliculas.entradas, funciones.butacas as cant_butacas
                from(select f.id_pelicula, sum(s.cant_butacas) as butacas from funciones f inner join salas s on f.id_sala = s.id_sala where(f.eliminado = false) and (s.eliminado= false) group by id_pelicula) as funciones
                inner join (SELECT cine.id_cine, f.id_pelicula, ifnull(count(e.id_compra),0) as entradas, s.cant_butacas
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
                                where (p.eliminado = false) and (f.eliminado = false) and (s.eliminado = false)
                                group by f.id_pelicula) as peliculas
                                on peliculas.id_pelicula = funciones.id_pelicula
                                group by funciones.id_pelicula;";

                

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

        /*Descartada
        public function GetAllEntradasXpeliculaPesos(bool $eliminado = false)
        {
            try 
            {
                $query = "SELECT cine.id_cine,f.id_pelicula, ifnull(sum(c.cant_entradas*c.monto),0) as monto, s.cant_butacas
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
                group by cine.id_cine, f.id_pelicula;";

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
                echo $e->getMessage();
            }
        }*/
        public function GetAllEntradasXpeliculaPesos ($fecha_desde, $fecha_hasta)
        {
            try 
            {
                $query = "SELECT p.id, IFNULL(SUM(peliculaMonto.monto),0) AS monto
                FROM peliculas_cartelera p
                LEFT JOIN (
                            SELECT e.id_compra, c.monto AS monto , p.id AS id_pelicula,c.fecha_compra
                            FROM entradas e 
                            INNER JOIN compras c 
                            ON c.id_compra = e.id_compra 
                            INNER JOIN funciones f
                            ON e.id_funcion = f.id_funcion
                            INNER JOIN peliculas_cartelera p
                            ON p.id = f.id_pelicula
                            WHERE c.fecha_compra BETWEEN :fecha_desde AND :fecha_hasta
                            GROUP BY e.id_compra, p.id
                ) AS peliculaMonto
                ON peliculaMonto.id_pelicula = p.id
                GROUP BY p.id;";

                $this->connection = Connection::GetInstance();
                $parameters["fecha_desde"] = $fecha_desde;
                $parameters["fecha_hasta"] =  $fecha_hasta;


                $resultSet = $this->connection->Execute($query,$parameters);

                return $resultSet;
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
                $query = "SELECT funcion.id_cine, funcion.nombre_cine, funcion.calle, funcion.numero, funcion.title, funcion.id_sala, funcion.numero_sala, funcion.fecha_hora, funcion.id_funcion, funcion.id_pelicula, funcion.butacas_disp, ifnull(count(e.id_compra),0) as entradas
                from funciones fun
                right join (select c.id_cine, c.nombre_cine, c.calle, c.numero, p.title, s.id_sala, s.numero_sala, s.cant_butacas as butacas_disp, f.fecha_hora, f.id_funcion, p.id as id_pelicula
                FROM funciones f 
                INNER JOIN peliculas_cartelera p
                ON f.id_pelicula = p.id
                INNER JOIN salas s
                ON f.id_sala = s.id_sala
                INNER JOIN cines c
                ON s.id_cine = c.id_cine
                WHERE (f.eliminado = false)) as funcion
                on fun.id_funcion = funcion.id_funcion
                left join entradas e
                on e.id_funcion = fun.id_funcion
                left join compras com
                on e.id_compra = com.id_compra
                group by funcion.id_cine, funcion.nombre_cine, funcion.calle, funcion.numero, funcion.title, funcion.id_sala, funcion.numero_sala, funcion.fecha_hora, funcion.id_funcion, funcion.id_pelicula, funcion.butacas_disp;
                ";

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

