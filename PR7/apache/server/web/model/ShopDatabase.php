<?php
require_once "Purchase.php";
require_once "Toy.php";

class ShopDatabase
{
    public ?mysqli $conn;
    private string $purchase_table_name = "purchase";
    private string $toy_table_name = "toy";

    public function createConnection(): ?mysqli
    {
        $this->conn = new mysqli("db", "root", "root_password", "appDB");
        $this->conn->query("set names utf8");
        return $this->conn;
    }

    function purchase_create(Purchase $purchase): bool
    {
        $query = "INSERT INTO ".$this->purchase_table_name."(name, toy_id, wholesale_price, count) VALUE ('".$purchase->name."', '".$purchase->toy_id."', '".$purchase->wholesale_price."', '".$purchase->count."');";

        return $this->conn->query($query) and $this->conn->commit();
    }

    function purchase_read(int $id) {
        $query = "SELECT s.id, s.name, s.toy_id, s.wholesale_price, s.count FROM ".$this->purchase_table_name." AS s WHERE s.id = ".$id.";";

        return $this->conn->query($query)->fetch_object();
    }

    function purchase_read_all(): array
    {
        $query = "
        SELECT s.id, s.name, s.toy_id, s.wholesale_price, s.count FROM ".$this->purchase_table_name." AS s
        ORDER BY s.id; 
        ";

        $stmt = $this->conn->query($query);

        if ($stmt != null) {
            $result = array();
            foreach ($stmt as $purch) {
                $purchase = new Purchase();
                $purchase->copy((object) $purch);

                $result[] = (array) $purchase;
            }
            return $result;
        } else {
            return array();
        }
    }

    function purchase_update(Purchase $purchase): int
    {
        if($this->purchase_check($purchase->id)) {
            $query = "
            UPDATE ".$this->purchase_table_name." 
            SET name = '" . $purchase->name . "', toy_id = '" . $purchase->toy_id . "', wholesale_price = '" . $purchase->wholesale_price . "', count = '" . $purchase->count . "'
            WHERE id = " . $purchase->id . ";";
            $this->conn->query($query);

            if ($this->conn->affected_rows == 1) {
                $this->conn->commit();
                return 1;
            } else
                return 0;
        } else
            return -1;
    }

    function purchase_delete(int $id): bool
    {
        $query = "DELETE FROM ".$this->purchase_table_name." WHERE id = ".$id.";";
        $this->conn->query($query);

        if($this->conn->affected_rows == 1) {
            $this->conn->commit();
            return 1;
        } else {
            if ($this->purchase_check($id))
                return 0;
            else
                return -1;
        }
    }

    function purchase_check(int $id): bool
    {
        $query = "SELECT EXISTS(SELECT * FROM ".$this->purchase_table_name." WHERE id = ".$id.");";
        $stmt = $this->conn->query($query)->fetch_row();

        return strcmp($stmt[0], "1") == 0;
    }

    function toy_create(Toy $toy): bool
    {
        $query = "INSERT INTO ".$this->toy_table_name."(name, description, price, count) VALUE ('".$toy->name."', '".$toy->description."', ".$toy->price.", ".$toy->count.");";

        return $this->conn->query($query) and $this->conn->commit();
    }

    function toy_read(int $id) {
        $query = "SELECT s.id, s.name, s.description, s.price, s.count FROM ".$this->toy_table_name." AS s WHERE s.id = ".$id.";";

        return $this->conn->query($query)->fetch_object();
    }

    function toy_read_all(): array
    {
        $query = "
        SELECT s.id, s.name, s.description, s.price, s.count FROM ".$this->toy_table_name." AS s
        ORDER BY s.id; 
        ";

        $stmt = $this->conn->query($query);

        if ($stmt != null) {
            $result = array();
            foreach ($stmt as $purch) {
                $toys = new Toy();
                $toys->copy((object) $purch);

                $result[] = (array) $toys;
            }
            return $result;
        } else {
            return array();
        }
    }

    function toy_update(Toy $toy): int
    {
        if($this->toy_check($toy->id)) {
            $query = "
            UPDATE ".$this->toy_table_name." 
            SET name = '" . $toy->name . "', description = '" . $toy->description . "', price = '" . $toy->price . "', count = '" . $toy->count . "'
            WHERE id = " . $toy->id . ";";
            $this->conn->query($query);

            if ($this->conn->affected_rows == 1) {
                $this->conn->commit();
                return 1;
            } else
                return 0;
        } else
            return -1;
    }

    function toy_delete(int $id): int
    {
        $query = "DELETE FROM ".$this->toy_table_name." WHERE id = ".$id.";";
        $this->conn->query($query);

        if($this->conn->affected_rows == 1) {
            $this->conn->commit();
            return 1;
        } else {
            if ($this->toy_check($id))
                return 0;
            else
                return -1;
        }
    }

    function toy_check(int $id): bool
    {
        $query = "SELECT EXISTS(SELECT * FROM ".$this->toy_table_name." WHERE id = ".$id.");";
        $stmt = $this->conn->query($query)->fetch_row();

        return strcmp($stmt[0], "1") == 0;
    }
}