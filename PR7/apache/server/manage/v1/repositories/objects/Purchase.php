<?php

namespace objects;
class Purchase
{
    public int $id;
    public ?string $name;
    public ?int $toy_id;
    public ?int $wholesale_price;
    public ?int $count;

    public function copy(object $obj): void
    {
        $this->id = $obj->id;
        $this->init_data($obj);
    }

    public function copy_data(int $id, object $obj): void
    {
        $this->id = $id;
        $this->init_data($obj);
    }

    private function init_data(object $obj)
    {
        $this->name = $obj->name;
        $this->toy_id = $obj->toy_id;
        $this->wholesale_price = $obj->wholesale_price;
        $this->count = $obj->count;
    }
}