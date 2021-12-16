<?php

class DB {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "spitogatos";
    public $conn;

    //Returns the connection object
    function connect(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            return false;
        }
        return $this->conn;
    }

    function close() {
        $this->conn->close();
        return;
    }
}


?>