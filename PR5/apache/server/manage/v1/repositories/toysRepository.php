<?php
include_once("objects/Toy.php");
use objects\Toy;

class ToysRepository {
    private ?mysqli $conn;
    private string $table_name = "toy";

    public function __construct($db) {
        $this->conn = $db;
    }

    function create(Toy $toy): bool
    {
        $query = "INSERT INTO ".$this->table_name."(name, description, price, count) VALUE ('".$toy->name."', '".$toy->description."', ".$toy->price.", ".$toy->count.");";

        return $this->conn->query($query) and $this->conn->commit();
    }

    function read(int $id) {
        $query = "SELECT s.id, s.name, s.description, s.price, s.count FROM ".$this->table_name." AS s WHERE s.id = ".$id.";";

        return $this->conn->query($query)->fetch_object();
    }

    function read_all(): array
    {
        $query = "
        SELECT s.id, s.name, s.description, s.price, s.count FROM ".$this->table_name." AS s
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

    function update(Toy $toy): int
    {
        if($this->check($toy->id)) {
            $query = "
            UPDATE ".$this->table_name." 
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

    function delete(int $id): int
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