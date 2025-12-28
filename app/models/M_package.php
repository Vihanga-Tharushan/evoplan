<?php
    class M_package {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Create package
        public function create($data){ //create package
            $this->db->query("INSERT INTO packages (service_id, title, details, price, bg_image_name, notes) VALUES (:service_id, :title, :details, :price, :bg_image_name, :notes)");
            // Bind values
            $this->db->bind(':service_id', $data['service_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':details', $data['details']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':bg_image_name', $data['bg_image_name']);
            $this->db->bind(':notes', $data['notes']);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        
        public function getPackagesByProvider($service_id){
            $this->db->query("SELECT * FROM packages WHERE service_id = :service_id");
            $this->db->bind(':service_id', $service_id);
            $results = $this->db->resultSet();
            return $results;
        }


        public function edit($data){ //edit package
            $this->db->query("UPDATE packages SET title = :title, details = :details, price = :price, bg_image_name = :bg_image_name, notes = :notes WHERE package_id = :id");
            // Bind values
            $this->db->bind(':id', $data['id']);  
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':details', $data['details']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':bg_image_name', $data['bg_image_name']);
            $this->db->bind(':notes', $data['notes']);
           
            
            
            
            
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }  

        }

        public function deletePackage($package_id){
            $this->db->query("DELETE FROM packages WHERE package_id = :package_id");
            // Bind value
            $this->db->bind(':package_id', $package_id);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }  
        }

        public function getPackageById($package_id){
            $this->db->query("SELECT * FROM packages WHERE package_id = :package_id");
            $this->db->bind(':package_id', $package_id);
            $row = $this->db->single();
            return $row;
        }

        public function getAllPackages(){
            $this->db->query("SELECT * FROM v_packages_with_provider");
            $results = $this->db->resultSet();
            return $results;
        }

    }
?>