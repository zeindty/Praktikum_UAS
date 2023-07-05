<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/databaseanimal.php';
    include_once '../../models/animals.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Animal($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->id = $data->id;
    // animal values
        $item->name = $data->name;
        $item->taxonomy = $data->taxonomy;
        $item->status = $data->status;
        $item->population = $data->population;
        $item->habitat = $data->habitat;
        $item->location = $data->location;

        if($item->updateAnimal()){
            echo json_encode(['message'=>' Data Hewan berhasil diperbarui.']);
        } else{
            echo json_encode(['message'=>' Data Hewan tidak berhasil diperbarui.']);
    }
?>