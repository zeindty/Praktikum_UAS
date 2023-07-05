<?php
        class Animal{
        // Connection
        private $conn;
        // Table
        private $db_table = "Animal";
        // Columns
        public $id;
        public $name;
        public $taxonomy;
        public $status;
        public $population;
        public $habitat;
        public $location;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getAnimals(){
            $sqlQuery = "SELECT id, name, taxonomy, status, population, habitat, location FROM ". $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createAnimal(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        taxonomy = :taxonomy, 
                        status = :status, 
                        population = :population, 
                        habitat = :habitat, 
                        location = :location";

            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->taxonomy=htmlspecialchars(strip_tags($this->taxonomy));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->population=htmlspecialchars(strip_tags($this->population));
            $this->habitat=htmlspecialchars(strip_tags($this->habitat));
            $this->location=htmlspecialchars(strip_tags($this->location));

            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":taxonomy", $this->taxonomy);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":population", $this->population);
            $stmt->bindParam(":habitat", $this->habitat);
            $stmt->bindParam(":location", $this->location);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
        // READ single
        public function getSingleAnimal(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        taxonomy, 
                        status, 
                        population, 
                        habitat,
                        location
                    FROM
                        ". $this->db_table ."
                    WHERE 
                        id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $dataRow['name'];
            $this->taxonomy = $dataRow['taxonomy'];
            $this->status = $dataRow['status'];
            $this->population = $dataRow['population'];
            $this->habitat = $dataRow['habitat'];
            $this->location = $dataRow['location'];
        } 
        // UPDATE
        public function updateAnimal(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        taxonomy = :taxonomy, 
                        status = :status, 
                        population = :population, 
                        habitat = :habitat,
                        location = :location
                    WHERE 
                        id = :id";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->taxonomy=htmlspecialchars(strip_tags($this->taxonomy));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->population=htmlspecialchars(strip_tags($this->population));
            $this->habitat=htmlspecialchars(strip_tags($this->habitat));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->id=htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":taxonomy", $this->taxonomy);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":population", $this->population);
            $stmt->bindParam(":habitat", $this->habitat);
            $stmt->bindParam(":location", $this->location);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
        // DELETE
        function deleteAnimal(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(1, $this->id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
