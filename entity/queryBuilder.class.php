<?php

    require __DIR__ . "/../exceptions/QueryException.class.php";
    require_once __DIR__ . "/../core/App.class.php";
    abstract class QueryBuilder{
        
        private $connection;
        private $table;
        private $classEntity;

        public function __construct(string $table, string $classEntity){
            $this->table = $table;
            $this->classEntity = $classEntity;
            $this->connection = App::getConnection();
        }

        //Devuelve un array de elementos que hemos extraido de una tabala de la BD transformados objetos
        private function executeQuery(string $sql){
            $pdoStatement = $this->connection->prepare($sql);//prepara la consulta para su ejecución

            if($pdoStatement->execute() === false){
                throw new QueryException("No se ha podido ejecutar la consulta");
            }
            return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
        }
        public function findAll(): array{
            $sql = "SELECT * from $this->table";
            return $this->executeQuery($sql);
        }
        public function find(int $id): IEntity{
            $sql = "SELECT * from $this->table WHERE id=$id";
            $result = $this->executeQuery($sql);

            if (empty($result)){
                throw new NotFoundException("No se ha encontrado ningún elemento con id $id");
            }
            return $result[0];        
        }

        //nos permite enviar una sentencia en SQL a la base de datos transmitiéndole todos los datos de la imagen 
        public function save(IEntity $entity): void{
            try {
                $parameters = $entity->toArray();
                $sql = sprintf('insert into %s (%s) values (%s)', $this->table, implode(', ', array_keys($parameters)), ':' . implode(',:', array_keys($parameters)));
                
                $statement =$this->connection->prepare($sql);
                $statement->execute($parameters);
            }
            catch (PDOException $exception) {
                throw new QueryException('Error al insertar en la BD');
            }
        }   
        
        //Este método nos sevirá para ejecutar transacciones 
        public function executeTransaction(callable $fnExecuteQuerys){
            try{
                $this->connection->beginTransaction();
                $fnExecuteQuerys();//Con el callable esta vatriable llamamos todas las consultas necesarias.

                $this->connection->commit();//Commit para confirmar las consultas pendientes y ejecutar
            }catch(PDOException $pdoException){
                $this->connection->rollBack();
                throw new QueryException('No se ha podido realizar la operación');
            }
        }

        //recibe una entidad y genera una consulta que modifica dicha entidad en la BD
        public function update(IEntity $entity):void{
            try{
                $parameters = $entity->toArray();
                $sql = sprintf('UPDATE %s SET %s WHERE id=:id',
                    $this->table, $this->getUpdates($parameters));
                $statement = $this->connection->prepare($sql);
                $statement-> execute($parameters);
            }catch(PDOException $pdoException){
                throw new QueryException('Error al actualizar');
            }
            
        }

        //recorremos todos los parámetros menos el ID Para  terminar de armar la sentencia SQL
        private function getUpdates(array $parametres){
            $updates='';
            foreach ($parametres as $key=>$value){
                if($key !== "id"){
                    if($updates !== ''){
                       $updates .= ', '; 
                    }
                    $updates.=$key . '=:' . $key;
                }  
            }
            return $updates;
        } 



       


    }
?>