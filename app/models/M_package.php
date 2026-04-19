<?php
    class M_package {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Create package
        public function create($data){ //create package
            $this->db->query("INSERT INTO packages (service_id, title, details, price, bg_image_name) VALUES (:service_id, :title, :details, :price, :bg_image_name)");
            // Bind values
            $this->db->bind(':service_id', $data['service_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':details', $data['details']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':bg_image_name', $data['bg_image_name']);
           
           
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
            $this->db->query("UPDATE packages SET title = :title, details = :details, price = :price, bg_image_name = :bg_image_name WHERE package_id = :id");
            // Bind values
            $this->db->bind(':id', $data['id']);  
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':details', $data['details']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':bg_image_name', $data['bg_image_name']);
           
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

        public function getTotalPackagesByProvider($service_id) {
            $this->db->query("SELECT COUNT(*) AS total_packages FROM packages WHERE service_id = :service_id");
            $this->db->bind(':service_id', $service_id);
            $row = $this->db->single();
            return $row ? (int)$row->total_packages : 0;
        }


        public function getPackagePerformanceData($service_id) {
            $this->db->query("SELECT
                p.package_id,
                p.title AS package_name,
                COUNT(ep.event_package_id) AS usage_count
            FROM packages p
            LEFT JOIN event_packages ep ON p.package_id = ep.package_id
            WHERE p.service_id = :service_id AND (ep.status = 'ON' OR ep.status IS NULL)
            GROUP BY p.package_id, p.title
            ORDER BY usage_count DESC");

            $this->db->bind(':service_id', $service_id);
            $results = $this->db->resultSet();
            
            // Format as expected by chart
            $formatted = [
                'labels' => [],
                'data' => []
            ];
            
            foreach($results as $row) {
                $formatted['labels'][] = $row->package_name;
                $formatted['data'][] = (int)$row->usage_count;
            }
            
            return $formatted;
        }

        

    }
?>