<?php
    class M_IssueC {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        // Find coordinator by email
        public function findCoordinatorByEmail($ic_email) {
            $this->db->query("SELECT * FROM coordinators WHERE ic_email = :ic_email");
            $this->db->bind(':ic_email', $ic_email);

            $row = $this->db->single();

            // Check row
            if($row){
                return true;
            } else {
                return false;
            }
        }

        // Login Coordinator
        public function coordinatorLogin($ic_email, $ic_password){
            $this->db->query("SELECT * FROM coordinators WHERE ic_email = :ic_email");
            $this->db->bind(':ic_email', $ic_email);

            $row = $this->db->single();

            $hashed_password = $row->ic_password;

            if(password_verify($ic_password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        public function createIssueInvestigation($data){
            $this->db->query("INSERT INTO issueinvestigation (issue_type, refund, notes, replace_item, cost, v_response, priority, a_note) VALUES (:issue_type, :refund, :notes, :replace_item, :cost, :v_response, :priority, :a_note)");            // Bind values
            $this->db->bind(':issue_type', $data['issue_type']);
            $this->db->bind(':refund', $data['refund']);
            $this->db->bind(':notes', $data['notes']);
            $this->db->bind(':replace_item', $data['replace_item']);
            $this->db->bind(':cost', $data['cost']);
            $this->db->bind(':v_response', $data['v_response']);
            $this->db->bind(':priority', $data['priority']);
            $this->db->bind(':a_note', $data['a_note']);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getIssueReports(){
            $this->db->query("SELECT * FROM issueinvestigation");
            $row = $this->db->resultSet();
            return $row;
        }

        public function getIssueReportById($id){
            $this->db->query("SELECT * FROM issueinvestigation WHERE id = :id");
            $this->db->bind(':id', $id);
            $row = $this->db->single();
            return $row;
        }

        public function editIssueReport($data){
            $this->db->query("UPDATE issueinvestigation SET issue_type = :issue_type, refund = :refund, notes = :notes, replace_item = :replace_item, cost = :cost, v_response = :v_response, priority = :priority, a_note = :a_note WHERE id = :id");
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':issue_type', $data['issue_type']);
            $this->db->bind(':refund', $data['refund']);
            $this->db->bind(':notes', $data['notes']);
            $this->db->bind(':replace_item', $data['replace_item']);
            $this->db->bind(':cost', $data['cost']);
            $this->db->bind(':v_response', $data['v_response']);
            $this->db->bind(':priority', $data['priority']);
            $this->db->bind(':a_note', $data['a_note']);
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function deleteIssueReport($id){
            $this->db->query("DELETE FROM issueinvestigation WHERE id = :id");
            $this->db->bind(':id', $id);
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


    }
