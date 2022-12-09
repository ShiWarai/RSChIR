<?php

class FakerDataInstance
{
    public string $name;
    public string $surname;
    public string $date;
    public string $gender;
    public string $bloodType;

    public function __construct(string $name, string $surname, string $date, string $gender, string $bloodType)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->date = $date;
        $this->gender = $gender;
        $this->bloodType = $bloodType;
    }
}