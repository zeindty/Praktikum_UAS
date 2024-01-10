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
$table_name = 'db_table';

if(isset($_GET['id'])){
    $item = new DataAntrian($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getSingleData();
    if($item->waktu_kedatangan != null){
        // create array
        $data_arr = array(
        "id" => $item->id,
        "waktu_kedatangan" => $item->waktu_kedatangan,
        "selisih_kedatangan" => $item->selisih_kedatangan,
        "waktu_awal_pelayanan" => $item->waktu_awal_pelayanan,
        "selisih_pelayanan_kasir" => $item->selisih_pelayanan_kasir,
        "waktu_selesai" => $item->waktu_selesai,
        "selisih_keluar_antrian" => $item->selisih_keluar_antrian
        );
        http_response_code(200);
        echo json_encode($data_arr);
    }
    else{
        http_response_code(404);
        echo json_encode("Data antrian not found.");
    }
}
else {
    $items = new DataAntrian($db);
    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){
        $DataArr = array();
        $DataArr["body"] = array();
        $DataArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "waktu_kedatangan" => $waktu_kedatangan,
                "selisih_kedatangan" => $selisih_kedatangan,
                "waktu_awal_pelayanan" => $waktu_awal_pelayanan,
                "selisih_pelayanan_kasir" => $selisih_pelayanan_kasir,
                "waktu_selesai" => $waktu_selesai,
                "selisih_keluar_antrian" => $selisih_keluar_antrian
            );
            array_push($DataArr["body"], $e);
        }
        echo json_encode($DataArr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("messstock" => "No record found."));
    }
}
?>
