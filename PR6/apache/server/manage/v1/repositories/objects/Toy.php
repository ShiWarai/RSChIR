<?php

namespace objects;
class Toy
{
    public int $id;
    public ?string $name;
    public ?string $description;
    public ?int $price;
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
        $this->description = $obj->description;
        $this->price = $obj->price;
        $this->count = $obj->count;
    }
}