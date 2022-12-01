<?php

function get_raw_data(): array {
    $input = file_get_contents('results.json');
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
    $data = get_raw_data();
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
    $raw_data = get_raw_data();
    $gender_count = $func($raw_data);
    $labels = array_keys($gender_count);
    $values = array_values($gender_count);
    return array("labels" => $labels, "values" => $values);
}