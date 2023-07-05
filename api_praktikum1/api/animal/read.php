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
    if(isset($_GET['id'])){  // cek id
        $item = new Animal($db);
        $item->id = isset($_GET['id']) ? $_GET['id'] : die();

        $item->getSingleAnimal();
        if($item->name != null){
            // create array
            $ani_arr = array(
                "id" => $item->id,
                "name" => $item->name,
                "taxonomy" => $item->taxonomy,
                "status" => $item->status,
                "population" => $item->population,
                "habitat" => $item->habitat,
                "location" => $item->location
            );

            http_response_code(200);
            echo json_encode($ani_arr);
        }
        else{
            http_response_code(404);
            echo json_encode("Animal not found.");
        }
    }   
    else {
        $items = new Animal($db);
        $stmt = $items->getAnimals();
        $itemCount = $stmt->rowCount();

        //echo json_encode($itemCount);
        if($itemCount > 0){

            $animalArr = array();
            $animalArr["body"] = array();
            $animalArr["itemCount"] = $itemCount;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    "id" => $id,
                    "name" => $name,
                    "taxonomy" => $taxonomy,
                    "status" => $status,
                    "population" => $population,
                    "habitat" => $habitat,
                    "location" => $location
                );
                array_push($animalArr["body"], $e);
            }
            echo json_encode($animalArr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No record found.")
            );
        }
    }
?>