<?php

class M_Complaints {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function submitClientComplaint($data) {
        $this->db->query("
            INSERT INTO client_complaints 
            (client_id, event_id, service_id, complainant_type, issue_type, description, status) 
            VALUES 
            (:client_id, :event_id, :service_id, :complainant_type, :issue_type, :description, 'SEND')
        ");
        
        // Bind values
        $this->db->bind(':client_id', $data['client_id']);
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':service_id', isset($data['service_id']) && !empty($data['service_id']) ? $data['service_id'] : NULL);
        $this->db->bind(':complainant_type', $data['complainant_type']);
        $this->db->bind(':issue_type', $data['issue_type']);
        $this->db->bind(':description', $data['description']);

        // Execute
        return $this->db->execute();
    }
    
    public function getClientComplaintsByClientId($client_id) {
        $this->db->query("
            SELECT 
                cc.*,
                e.event_name,
                sp.businessName as service_provider_name
            FROM client_complaints cc
            LEFT JOIN events e ON cc.event_id = e.event_id
            LEFT JOIN service_providers sp ON cc.service_id = sp.service_id
            WHERE cc.client_id = :client_id
            ORDER BY cc.created_at DESC
        ");
        $this->db->bind(':client_id', $client_id);
        return $this->db->resultSet();
    }

    public function getComplaintsByServiceProvider($service_id) {
        $this->db->query("SELECT * FROM provider_complaints WHERE service_id = :service_id ORDER BY created_at DESC");
        $this->db->bind(':service_id', $service_id);
        return $this->db->resultSet();
    }

    public function getComplaintById($complaint_id) {
        $this->db->query("SELECT * FROM provider_complaints WHERE complaint_id = :complaint_id");
        $this->db->bind(':complaint_id', $complaint_id);
        return $this->db->single();
    }

    public function getAllServiceProviderComplaints() {
        $this->db->query("
            SELECT 
                pc.*,
                sp.businessName as provider_name,
                e.event_name,
                CASE 
                    WHEN pc.complainant_type = 'CLIENT' THEN (SELECT name FROM clients WHERE client_id = e.client_id LIMIT 1)
                    ELSE 'Unknown'
                END as client_name
            FROM provider_complaints pc
            LEFT JOIN service_providers sp ON pc.service_id = sp.service_id
            LEFT JOIN events e ON pc.event_id = e.event_id
            WHERE pc.status != 'RESOLVED'
            ORDER BY pc.priority DESC, pc.created_at DESC
        ");
        return $this->db->resultSet();
    }



    public function getClientNameByServiceId($service_id) {
        $this->db->query("SELECT name FROM service_providers WHERE service_id = :service_id LIMIT 1");
        $this->db->bind(':service_id', $service_id);
        $result = $this->db->single();
        return $result ? $result->name : 'Unknown Provider';
    }

    public function getEventNameById($event_id) {
        $this->db->query("SELECT event_name FROM events WHERE event_id = :event_id LIMIT 1");
        $this->db->bind(':event_id', $event_id);
        $result = $this->db->single();
        return $result ? $result->event_name : 'Unknown Event';
    }

    public function updateComplaint($data) {
        $this->db->query("
            UPDATE provider_complaints 
            SET 
                status = :status,
                priority = :priority,
                resolution_type = :resolution_type,
                resolution_note = :resolution_note,
                resolved_at = :resolved_at,
                assigned_ic_id = :assigned_ic_id
            WHERE complaint_id = :complaint_id
        ");
        
        // Bind values
        $this->db->bind(':complaint_id', $data['complaint_id']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':priority', $data['priority']);
        $this->db->bind(':resolution_type', isset($data['resolution_type']) && !empty($data['resolution_type']) ? $data['resolution_type'] : NULL);
        $this->db->bind(':resolution_note', isset($data['resolution_note']) && !empty($data['resolution_note']) ? $data['resolution_note'] : NULL);
        $this->db->bind(':assigned_ic_id', isset($data['assigned_ic_id']) && !empty($data['assigned_ic_id']) ? $data['assigned_ic_id'] : NULL);
        
        // Set resolved_at timestamp if status is RESOLVED
        $resolvedAt = ($data['status'] === 'RESOLVED') ? date('Y-m-d H:i:s') : NULL;
        $this->db->bind(':resolved_at', $resolvedAt);

        // Execute
        return $this->db->execute();
    }


    public function getSolvedComplaintsByIcId($ic_id) {
        $this->db->query("SELECT * FROM provider_complaints WHERE assigned_ic_id = :ic_id AND status = 'RESOLVED' ORDER BY resolved_at DESC");
        $this->db->bind(':ic_id', $ic_id);
        return $this->db->resultSet();
    }



}