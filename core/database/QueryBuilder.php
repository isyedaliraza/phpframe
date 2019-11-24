<?php
class QueryBuilder {
    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function selectAll($table, $intoTable) {
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'App\\Models\\'.$intoTable);
    }

    public function insert($table, $values) {
        $sql = sprintf(
            'insert into %s(%s) values(%s);', 
            $table, 
            implode(',', array_keys($values)), 
            ':'.implode(', :', array_keys($values))
        );
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($values);
            header('Location: /');
        }
        catch(Exception $e) {
            //die($e->getMessage());
            die('Something went wrong. Please try again later.');
        }
    }
}
