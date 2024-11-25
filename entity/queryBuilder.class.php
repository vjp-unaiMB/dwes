<?php
require __DIR__ . '/../exceptions/QueryException.class.php';
require_once 'core/app.class.php';

abstract class QueryBuilder{
    private $connection;
    private $table;
    private $classEntity;

    public function __construct(string $table, string $classEntity){
        $this->connection=App::getConnection();
        $this->table=$table;
        $this->classEntity=$classEntity;
    }

    //Devuelve un array de elementos que hemos extraido de una tabala de la BD transformados objetos
    public function findAll() : array{
        $sql = "SELECT * from $this->table";
        $pdoStatement = $this -> connection->prepare($sql);
        if($pdoStatement->execute() === false){
            throw new QueryException("No se ha podido ejecutar la consulta");
        }
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,$this->classEntity);//(fethcAll)devuelve unos objetos transformados con (FetchClass) en objeto de la clase que le indicamos con $classEntity
    }

    //nos permite enviar una sentencia en SQL a la base de datos transmitiéndole todos los datos de la imagen 
    public function save(IEntity $entity) : void {
        try{
            $parameters = $entity->toArray();
        
            $sql = sprintf('insert into %s (%s) values (%s)',
            $this->table,
            implode(', ',array_keys($parameters)),
            ':' . implode(',:',array_keys($parameters)));
            $statement = $this->connection->prepare($sql);//print_r($statement->errorInfo());print_r($parameters);
            $statement->execute($parameters);
            
        }
        catch(PDOException $exception){
            throw new QueryException('Error al insertar en la BD');
        }
    }

    public function executeTransaction(callable $fnExecuteQuerys){
        try{
            $this->connection->beginTransaction();
            $fnExecuteQuerys();

            $this->connection->commit();
        }catch (PDOException $PDOException){
            $this->connection->rollBack();
            throw new QueryException("No se ha podido realizar la operación");
        }
    }
}


?>