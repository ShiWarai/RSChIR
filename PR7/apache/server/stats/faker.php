<?php
require_once '../vendor/autoload.php';
require_once 'FakerDataInstance.php';

function generate_data(): void
{
    $data = array();

    $faker = Faker\Factory::create();
    $faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
    $faker->addProvider(new Faker\Provider\ru_RU\Color($faker));
    for ($i = 0; $i < 50; $i++) {
        $data_row = new FakerDataInstance(
            $faker->firstName(),
            $faker->lastName(),
            $faker->date(),
            $faker->title(),
            $faker->bloodType()
        );
        $data[] = $data_row;
    }
    $jsonData = json_encode($data);
    file_put_contents('results.json', $jsonData);
}
