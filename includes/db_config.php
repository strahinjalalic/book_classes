<?php
defined("DB_HOST") ? null : define("DB_HOST", "localhost");
defined("DB_USER") ? null : define("DB_USER", "root");
defined("DB_PASSWORD") ? null : define("DB_PASSWORD", "");
defined("DB_NAME") ? null : define("DB_NAME", "book_classes");


class Database {
    
    private $connection;

    function __construct()
    {
        $this->db_connection();   
    }

    function db_connection() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        return $this->connection;
    }

    function query($sql) {
        $result = $this->connection->query($sql);
        if(!$result) {
            echo "QUERY FAILED! " . $this->connection->error;
        }

        return $result;
    }

    

    function fetch($query) {
        $row = $this->connection->fetch($query);
        if(!$row) {
            echo "QUERY FAILED! " . $this->connection->error;
        }
        return $row;
    }

    function escape_string($property) {
        $escaped = $this->connection->real_escape_string($property);
        return $escaped;
    }

    function prepareFindById($query, $param) {
        $arr = [];
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
    }

    function prepareInsertUpdateDelete($query, $param) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($param);
        return $stmt->rowCount();
    }

}

$database = new Database();
?>