<?php
include_once("objects/Purchase.php");
use objects\Purchase;

class PurchaseRepository {
    private ?mysqli $conn;
    private string $table_name = "purchase";

    public function __construct($db) {
        $this->conn = $db;
    }

    function create(Purchase $purchase): bool
    {
        $query = "INSERT INTO ".$this->table_name."(name, toy_id, wholesale_price, count) VALUE ('".$purchase->name."', '".$purchase->toy_id."', '".$purchase->wholesale_price."', '".$purchase->count."');";

        return $this->conn->query($query) and $this->conn->commit();
    }

    function read(int $id) {
        $query = "SELECT s.id, s.name, s.toy_id, s.wholesale_price, s.count FROM ".$this->table_name." AS s WHERE s.id = ".$id.";";

        return $this->conn->query($query)->fetch_object();
    }

    function read_all(): array
    {
        $query = "
        SELECT s.id, s.name, s.toy_id, s.wholesale_price, s.count FROM ".$this->table_name." AS s
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

    function update(Purchase $purchase): int
    {
        if($this->check($purchase->id)) {
            $query = "
            UPDATE ".$this->table_name." 
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

    function delete(int $id): bool
    {
        $query = "DELETE FROM ".$this->table_name." WHERE id = ".$id.";";
        $this->conn->query($query);

        if($this->conn->affected_rows == 1) {
            $this->conn->commit();
            return 1;
        } else {
            if ($this->check($id))
                return 0;
            else
                return -1;
        }
    }

    function check(int $id): bool
    {
        $query = "SELECT EXISTS(SELECT * FROM ".$this->table_name." WHERE id = ".$id.");";
        $stmt = $this->conn->query($query)->fetch_row();

        return strcmp($stmt[0], "1") == 0;
    }
}