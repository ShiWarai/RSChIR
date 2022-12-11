<?php
class ShopDatabase
{
    public ?mysqli $conn;

    public function createConnection(): ?mysqli
    {
        $this->conn = new mysqli("db", "user", "password", "appDB");
        return $this->conn;
    }
}