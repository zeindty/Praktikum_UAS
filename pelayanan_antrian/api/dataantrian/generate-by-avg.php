<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/DataAntrian.php';

$database = new Database();
$db = $database->getConnection();

    $item = new DataAntrian($db);

    $item->generateAntrian();
    if($item->avg_sk != null){
        // create array
        $Data_arr = array(
        "waktu_tunggu" => "Pada <b> Waktu Tunggu </b> kasir MCD Solo Grand Mall memiliki minimal waktu tunggu sebesar ". round($item->min_sk)." menit dan maksimal waktu tunggu sebesar ". round($item->max_sk)." menit dengan rata-rata waktu tunggu sebesar ". date("i:s", $item->avg_sk) . "menit.",
        "banyak_antrian" => "Pada <b> Banyak Antrian </b> (number waiting) kasir 1 MCD Solo Grand Mall memiliki minimal jumlah antrian sebanyak ". round($item->min_spk)." konsumen dan maksimal jumlah antrian sebanyak ". round($item->max_spk)." konsumen dengan rata-rata jumlah banyak antrian ". date("i:s", $item->avg_spk) . "konsumen.",
        );
        http_response_code(200);
        echo json_encode($Data_arr);
    }
    else{
        http_response_code(404);
        echo json_encode("Data antrian not found.");
    }

?>
