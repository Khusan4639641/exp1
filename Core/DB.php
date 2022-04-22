<?php
namespace Core;

use \App\Config;

class DB
{

    public $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO("mysql:host=" . Config::DB_HOST . ";port=".Config::DB_PORT.";dbname=" . Config::DB_NAME, Config::DB_USER, Config::DB_PASSWORD);
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }
    public function insert($table, $data)
    {
       // 1. Êëþ÷è ìàññèâà
       $keys = array_keys($data);
       // 2. Ñôîðìèðîâàòü ñòðîêó title, content
       $stringOfKeys = implode(',', $keys);
       //3. Ñôîðìèðîâàòü ìåòêè
       $placeholders = ":" . implode(', :', $keys);
//        end test
       $sql = "INSERT INTO $table ($stringOfKeys) VALUES ($placeholders)";
       $statement = $this->pdo->prepare($sql);
       $statement->execute($data); //true || false
       return $this->pdo->lastInsertId();
    }
    public function update($table, $data)
    {
        $fields = '';

        foreach($data as $key => $value)
        {
            if($key!="id")
             $fields .= $key . "=:" . $key . ",";
        }
        $fields = rtrim($fields, ',');

        $sql = "UPDATE $table SET $fields WHERE id=:id";

        $statement = $this->pdo->prepare($sql);
        return $statement->execute($data); // true || false
    }

    public function delete($table, $id)
    {
            $sql = "DELETE FROM $table WHERE id=:id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(":id", $id);
            return $statement->execute();
    }
    public function joinLeft($table1,$table2,$key1,$key2)
    {
       $sql = "SELECT $table1.*, $table2.* FROM $table1 LEFT JOIN $table2 on $table1.$key1 = $table2.$key2 ORDER BY $table1.id DESC";
       $statement = $this->pdo->prepare($sql);
       $statement->execute();
       $result = $statement->fetchAll(\PDO::FETCH_OBJ);

       return $result;
   }
   public function all($table) /// posts , articles, tasks
   {
       $sql = "SELECT * FROM $table ORDER BY id DESC";
       $statement = $this->pdo->prepare($sql); //ïîäãîòîâèòü
       $statement->execute(); //true || false
       $results = $statement->fetchAll(\PDO::FETCH_OBJ);

       return $results;
   }
}
