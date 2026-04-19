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

        // Get total events for coordinator
        public function getTotalEvent($ic_id){
            $this->db->query("SELECT COUNT(DISTINCT e.event_id) as total FROM events e 
                             WHERE e.status = 'ON' 
                             LIMIT 1");
            $result = $this->db->single();
            return $result->total ?? 0;
        }

        // Get total issues for coordinator
        public function getTotalIssues($ic_id){
            $this->db->query("SELECT COUNT(DISTINCT c.complaint_id) as total 
                             FROM provider_complaints c 
                             WHERE c.status != 'SEND' 
                             AND c.assigned_ic_id = :ic_id 
                             UNION ALL
                             SELECT COUNT(DISTINCT c.complaint_id) as total 
                             FROM client_complaints c 
                             WHERE c.status != 'SEND' 
                             AND c.assigned_ic_id = :ic_id");
            $this->db->bind(':ic_id', $ic_id);
            $results = $this->db->resultSet();
            
            $total = 0;
            foreach($results as $row){
                $total += $row->total;
            }
            return $total;
        }

        // Get total complaints for coordinator
        public function getTotalComplaints($ic_id){
            $this->db->query("SELECT COUNT(DISTINCT pc.complaint_id) as total 
                     FROM provider_complaints pc
                     WHERE pc.assigned_ic_id = :ic_id OR pc.assigned_ic_id IS NULL
                     UNION ALL
                     SELECT COUNT(DISTINCT cc.complaint_id) as total
                     FROM client_complaints cc 
                     WHERE cc.assigned_ic_id = :ic_id OR cc.assigned_ic_id IS NULL");
            $this->db->bind(':ic_id', $ic_id);
            $results = $this->db->resultSet();
    
            $total = 0;
            foreach($results as $row){
                $total += $row->total ?? 0;
            }
            return $total;
        }

        // Get total refunds for coordinator
        
        // Get coordinator by ID
        public function getCoordinatorById($ic_id) {
            $this->db->query("SELECT ic_id, ic_name, ic_email, ic_phone FROM coordinators WHERE ic_id = :ic_id");
            $this->db->bind(':ic_id', $ic_id);
            return $this->db->single();
        }

        // Update coordinator personal information
        public function updateCoordinatorInfo($ic_id, $ic_name, $ic_email, $ic_phone) {
            $this->db->query("UPDATE coordinators SET ic_name = :ic_name, ic_email = :ic_email, ic_phone = :ic_phone WHERE ic_id = :ic_id");
            $this->db->bind(':ic_id', $ic_id);
            $this->db->bind(':ic_name', $ic_name);
            $this->db->bind(':ic_email', $ic_email);
            $this->db->bind(':ic_phone', $ic_phone);
            return $this->db->execute();
        }

        // Update coordinator password
        public function updateCoordinatorPassword($ic_id, $new_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $this->db->query("UPDATE coordinators SET ic_password = :ic_password WHERE ic_id = :ic_id");
            $this->db->bind(':ic_id', $ic_id);
            $this->db->bind(':ic_password', $hashed_password);
            return $this->db->execute();
        }

        // Verify coordinator's current password
        public function verifyCoordinatorPassword($ic_id, $password) {
            $this->db->query("SELECT ic_password FROM coordinators WHERE ic_id = :ic_id");
            $this->db->bind(':ic_id', $ic_id);
            $row = $this->db->single();
            
            if ($row && password_verify($password, $row->ic_password)) {
                return true;
            }
            return false;
        }
    }

