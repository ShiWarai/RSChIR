<?php

class Database {
    private string $host = "db";
    private string $database = "appDB";
    private string $username = "root";
    private string $password = "root_password";
    public ?mysqli $conn;

    public function get_connection(): ?mysqli
    {
        $this->conn = null;

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        $this->conn->query("set names utf8");

        return $this->conn;
    }
}

$database = new Database();