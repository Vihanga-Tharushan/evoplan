<?php
    class M_Availability {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }
    
        public function EditAvailability($data) {
            $this->db->query("UPDATE provider_availability SET time_slot = :time_slot WHERE service_id = :service_id");
            $this->db->bind(':time_slot', $data['time_slot']);
            $this->db->bind(':service_id', $data['service_id']);
            return $this->db->execute();
        }


        public function AddAvailability($data) {
            $this->db->query("INSERT INTO provider_availability (service_id, start_date, end_date, status) VALUES (:service_id, :start_date, :end_date, :status)");
            $this->db->bind(':start_date', $data['start_date']);
            $this->db->bind(':end_date', $data['end_date']);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':service_id', $data['service_id']);

            
            //Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function DeleteAvailability($data) {
            $this->db->query("DELETE FROM provider_availability WHERE availability_id = :availability_id ");
            $this->db->bind(':availability_id', $data['availability_id']);
            
            //Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function getAvailabilityByServiceProvider($serviceId) {
            $this->db->query("SELECT * FROM provider_availability WHERE service_id = :service_id ORDER BY start_date ASC");
            $this->db->bind(':service_id', $serviceId);
            $results = $this->db->resultSet();
            return $results;
        }
}
?>