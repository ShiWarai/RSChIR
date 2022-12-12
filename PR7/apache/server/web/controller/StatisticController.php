<?php
include_once "vendor/autoload.php";
include_once "web/model/FakerDataModel.php";
include_once "web/model/PlotModel.php";

class StatisticController extends Controller {
    private array $fakerData;
    private PlotModel $plots;

    function __construct()
    {
        parent::__construct();

        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
        $faker->addProvider(new Faker\Provider\ru_RU\Color($faker));
        for ($i = 0; $i < 50; $i++) {
            $data_row = new FakerDataModel(
                $faker->firstName(),
                $faker->lastName(),
                $faker->date(),
                $faker->title(),
                $faker->bloodType()
            );
            $this->fakerData[] = $data_row;
        }
        $jsonData = json_encode($this->fakerData);
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/stats/results.json", $jsonData);

        $buffer = array();
        $buffer['gender_type'] = $this->get_labels_and_values("get_gender_type_count");
        $buffer['gender_count'] = $this->get_labels_and_values("get_gender_count");
        $buffer['gender_and_blood'] = $this->get_gender_blood_tuple();
        $this->plots = new PlotModel($buffer);
    }

    function index() {
        $data = array();

        $data['table'] = $this->get_raw_data();

        $images = array();
        $images[] = $this->plots->draw_plot_bar("plot_bar");
        $images[] = $this->plots->draw_plot_pie("plot_pie");
        $images[] = $this->plots->draw_plot_scatter("plot_scatter");
        $data['images'] = $images;

        $this->view->generate("StatisticView.php", $data);
    }

    function get_raw_data(): array {
        $input = file_get_contents($_SERVER['DOCUMENT_ROOT']."/stats/results.json");
        return json_decode($input);
    }

    function get_gender_count($data): array
    {
        $gender_count = array();
        foreach ($data as $row) {
            $gender = $row->gender;
            if(!isset($gender_count[$gender])) {
                $gender_count[$gender] = 0;
            }
            $gender_count[$gender] += 1;
        }
        return $gender_count;
    }

    function get_gender_type_count($data): array
    {
        $gender_type_count = array();
        foreach ($data as $row) {
            $gender = $row->gender;
            if(!isset($gender_type_count[$gender])) {
                $gender_type_count[$gender] = 0;
            }
            $gender_type_count[$gender] += 1;
        }
        return $gender_type_count;
    }

    function get_blood_type_count($data): array
    {
        $blood_type_count = array();
        foreach ($data as $row) {
            $bloodType = $row->bloodType;
            if(!isset($blood_type_count[$bloodType])) {
                $blood_type_count[$bloodType] = 0;
            }
            $blood_type_count[$bloodType] += 1;
        }
        return $blood_type_count;
    }

    function get_month_count($data): array
    {
        $count = array();
        foreach ($data as $row) {
            $value = $row->month;
            if(!isset($count[$value])) {
                $count[$value] = 0;
            }
            $count[$value] += 1;
        }
        return $count;
    }

    function get_gender_blood_tuple(): array {
        $data = $this->get_raw_data();
        $blood_array = array();
        $gender_array = array();
        $blood_keys = array();
        $gender_keys = array();
        foreach ($data as $row) {
            if (!in_array($row->gender, $gender_keys)) {
                $gender_keys[] = $row->gender;
            }
            if (!in_array($row->bloodType, $blood_keys)) {
                $blood_keys[] =$row->bloodType;
            }
        }
        $gender_keys = array_flip($gender_keys);
        $blood_keys = array_flip($blood_keys);
        foreach ($data as $row) {
            $gender_array[] = $gender_keys[$row->gender];
            $blood_array[] = $blood_keys[$row->bloodType];
        }
        return array(
            "gender" => $gender_array,
            "blood" => $blood_array,
            "gender_keys" => array_values($gender_keys),
            "blood_keys" => array_values($blood_keys)
        );
    }

    function get_labels_and_values($func): array
    {
        $raw_data = $this->get_raw_data();
        $gender_count = $this->$func($raw_data);
        $labels = array_keys($gender_count);
        $values = array_values($gender_count);
        return array("labels" => $labels, "values" => $values);
    }
}