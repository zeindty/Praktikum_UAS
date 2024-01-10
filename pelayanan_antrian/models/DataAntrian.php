<?php
class DataAntrian{
    // Connection
    private $conn;
    // Table
    private $db_table = "rekapdata";
    // Columns
    public $id;
    public $waktu_kedatangan;
    public $selisih_kedatangan;
    public $waktu_awal_pelayanan;
    public $selisih_pelayanan_kasir;
    public $waktu_selesai;
    public $selisih_keluar_antrian;
    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }
    // GET ALL
    public function getAll(){
        $sqlQuery = "SELECT id, waktu_kedatangan, selisih_kedatangan, waktu_awal_pelayanan, selisih_pelayanan_kasir, waktu_selesai,  selisih_keluar_antrian FROM ". $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
public function createData(){
    $sqlQuery = "INSERT INTO ". $this->db_table ."
    SET
    waktu_kedatangan = :waktu_kedatangan,
    selisih_kedatangan = :selisih_kedatangan,
    waktu_awal_pelayanan = :waktu_awal_pelayanan,
    selisih_pelayanan_kasir = :selisih_pelayanan_kasir,
    waktu_selesai = :waktu_selesai,
    selisih_keluar_antrian = :selisih_keluar_antrian";
    
    $stmt = $this->conn->prepare($sqlQuery);
    
    // sanitize
    $this->waktu_kedatangan=htmlspecialchars(strip_tags($this->waktu_kedatangan));
    $this->selisih_kedatangan=htmlspecialchars(strip_tags($this->selisih_kedatangan));
    $this->waktu_awal_pelayanan=htmlspecialchars(strip_tags($this->waktu_awal_pelayanan));
    $this->selisih_pelayanan_kasir=htmlspecialchars(strip_tags($this->selisih_pelayanan_kasir));
    $this->waktu_selesai=htmlspecialchars(strip_tags($this->waktu_selesai));
    $this->selisih_keluar_antrian=htmlspecialchars(strip_tags($this->selisih_keluar_antrian));
    
    // bind data
    $stmt->bindParam(":waktu_kedatangan", $this->waktu_kedatangan);
    $stmt->bindParam(":selisih_kedatangan", $this->selisih_kedatangan);
    $stmt->bindParam(":waktu_awal_pelayanan", $this->waktu_awal_pelayanan);
    $stmt->bindParam(":selisih_pelayanan_kasir", $this->selisih_pelayanan_kasir);
    $stmt->bindParam(":waktu_selesai", $this->waktu_selesai);
    $stmt->bindParam(":selisih_keluar_antrian", $this->selisih_keluar_antrian);

    if($stmt->execute()){
        return true;
    }
    return false;
}

    // READ single
    public function getSingleData(){
        $sqlQuery = "SELECT
        id,
        waktu_kedatangan,
        selisih_kedatangan,
        waktu_awal_pelayanan,
        selisih_pelayanan_kasir,
        waktu_selesai,
        selisih_keluar_antrian      
        FROM
        ". $this->db_table ."
        WHERE
        id = ?
        LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->waktu_kedatangan = $dataRow['waktu_kedatangan'];
        $this->selisih_kedatangan = $dataRow['selisih_kedatangan'];
        $this->waktu_awal_pelayanan = $dataRow['waktu_awal_pelayanan'];
        $this->selisih_pelayanan_kasir = $dataRow['selisih_pelayanan_kasir'];
        $this->waktu_selesai = $dataRow['waktu_selesai'];
        $this->selisih_keluar_antrian = $dataRow['selisih_keluar_antrian'];
    }
    // UPDATE
public function updateData(){
    $sqlQuery = "UPDATE
    ". $this->db_table ."
    SET
    waktu_kedatangan = :waktu_kedatangan,
    selisih_kedatangan = :selisih_kedatangan,
    waktu_awal_pelayanan = :waktu_awal_pelayanan,
    selisih_pelayanan_kasir = :selisih_pelayanan_kasir,
    waktu_selesai = :waktu_selesai,
    selisih_keluar_antrian = :selisih_keluar_antrian
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($sqlQuery);
    
    $this->waktu_kedatangan=htmlspecialchars(strip_tags($this->waktu_kedatangan));
    $this->selisih_kedatangan=htmlspecialchars(strip_tags($this->selisih_kedatangan));
    $this->waktu_awal_pelayanan=htmlspecialchars(strip_tags($this->waktu_awal_pelayanan));
    $this->selisih_pelayanan_kasir=htmlspecialchars(strip_tags($this->selisih_pelayanan_kasir));
    $this->waktu_selesai=htmlspecialchars(strip_tags($this->waktu_selesai));
    $this->selisih_keluar_antrian=htmlspecialchars(strip_tags($this->selisih_keluar_antrian));
    $this->id=htmlspecialchars(strip_tags($this->id));
    
    // bind data
    $stmt->bindParam(":waktu_kedatangan", $this->waktu_kedatangan);
    $stmt->bindParam(":selisih_kedatangan", $this->selisih_kedatangan);
    $stmt->bindParam(":waktu_awal_pelayanan", $this->waktu_awal_pelayanan);
    $stmt->bindParam(":selisih_pelayanan_kasir", $this->selisih_pelayanan_kasir);
    $stmt->bindParam(":waktu_selesai", $this->waktu_selesai);
    $stmt->bindParam(":selisih_keluar_antrian", $this->selisih_keluar_antrian);
    $stmt->bindParam(":id", $this->id);

    try {
        $stmt->execute();
        return true;
    }
    catch(PDOException $exception) {
        die($exception->getMessage());
    }
}

    // DELETE
    function deleteData(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function generateAntrian(){
        $sqlQuery = "SELECT MIN(selisih_kedatangan) AS min_sk, MAX(selisih_kedatangan) AS max_sk, AVG(selisih_kedatangan) AS avg_sk, MIN(selisih_pelayanan_kasir) AS min_spk, MAX(selisih_pelayanan_kasir) AS max_spk, AVG(selisih_pelayanan_kasir) AS avg_spk
        FROM
        ". $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->min_sk = $dataRow['min_sk'];
        $this->max_sk = $dataRow['max_sk'];
        $this->avg_sk = $dataRow['avg_sk'];
        $this->min_spk = $dataRow['min_spk'];
        $this->max_spk = $dataRow['max_spk'];
        $this->avg_spk = $dataRow['avg_spk'];
    }

   
}
?>