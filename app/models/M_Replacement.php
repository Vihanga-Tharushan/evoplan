<?php
class M_Replacement {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPendingReplacements() {
        $this->db->query("SELECT 
                sr.replacement_id,
                sr.complaint_id,
                sr.source_type,
                sr.replacement_status,
                sr.assigned_ic_id,
                sr.created_at as submitted_at,
                e.event_id,
                e.event_name,
                e.start_datetime as event_date,
                c.client_id,
                c.name as client_name,
                sp.service_id as old_service_id,
                sp.businessName as provider_name,
                sp.serviceType as service_type,
                sp.contact as provider_contact,
                sp.email as provider_email
            FROM service_provider_replacements sr
            JOIN events e ON sr.event_id = e.event_id
            JOIN clients c ON e.client_id = c.client_id
            JOIN service_providers sp ON sr.old_service_id = sp.service_id
            WHERE sr.replacement_status = 'PENDING'
            ORDER BY sr.created_at DESC
        ");
        return $this->db->resultSet();
    }

    public function getReplacementById($replacement_id) {
        $this->db->query("SELECT 
                sr.replacement_id,
                sr.complaint_id,
                sr.source_type,
                sr.replacement_status,
                sr.assigned_ic_id,
                sr.reason,
                sr.created_at as submitted_at,
                sr.updated_at,
                e.event_id,
                e.event_name,
                e.start_datetime as event_date,
                e.end_datetime,
                e.guest_count,
                e.venue_address,
                c.client_id,
                c.name as client_name,
                c.email as client_email,
                c.contact as client_contact,
                c.address as client_address,
                sp.service_id as old_service_id,
                CONCAT(sp.fname, ' ', sp.lname) as provider_name,
                sp.businessName as service_type,
                sp.contact as provider_contact,
                sp.email as provider_email,
                sp.businessAddress as service_address
            FROM service_provider_replacements sr
            JOIN events e ON sr.event_id = e.event_id
            JOIN clients c ON e.client_id = c.client_id
            JOIN service_providers sp ON sr.old_service_id = sp.service_id
            WHERE sr.replacement_id = :replacement_id
        ");
        $this->db->bind(':replacement_id', $replacement_id);
        return $this->db->single();
    }

    public function updateReplacementStatus($replacement_id, $status) {
        $this->db->query("UPDATE service_provider_replacements SET replacement_status = :status, updated_at = NOW() WHERE replacement_id = :replacement_id");
        $this->db->bind(':replacement_id', $replacement_id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }

    public function assignNewProvider($replacement_id, $new_service_id, $assigned_ic_id) {
        $this->db->query("UPDATE service_provider_replacements 
            SET new_service_id = :new_service_id, 
                assigned_ic_id = :assigned_ic_id,
                replacement_status = 'ASSIGNED',
                updated_at = NOW()
            WHERE replacement_id = :replacement_id
        ");
        $this->db->bind(':replacement_id', $replacement_id);
        $this->db->bind(':new_service_id', $new_service_id);
        $this->db->bind(':assigned_ic_id', $assigned_ic_id);
        return $this->db->execute();
    }

    public function removeProviderPackage($event_id, $service_id) {
        $this->db->query("UPDATE event_packages SET status = 'OFF' WHERE event_id = :event_id AND service_id = :service_id");
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':service_id', $service_id);
        return $this->db->execute();
    }

    public function getPackagesByServiceType($serviceType, $excludeServiceId = null) {
        $query = "SELECT 
                p.package_id,
                p.title,
                p.details,
                p.price,
                p.bg_image_name,
                p.notes,
                sp.service_id,
                CONCAT(sp.fname, ' ', sp.lname) AS provider_name,
                sp.businessName,
                sp.serviceType,
                sp.district,
                pro.profile_pic,
                ROUND(AVG(r.rating), 1) AS avg_rating,
                COUNT(r.review_id) AS total_reviews
            FROM v_packages_with_provider AS vp
            INNER JOIN packages p ON vp.package_id = p.package_id
            INNER JOIN service_providers sp ON p.service_id = sp.service_id
            LEFT JOIN provider_profiles pro ON p.service_id = pro.service_id
            LEFT JOIN reviews r ON sp.service_id = r.service_id
            WHERE sp.serviceType = :serviceType";
        
        if ($excludeServiceId) {
            $query .= " AND sp.service_id != :excludeServiceId";
        }
        
        $query .= " GROUP BY p.package_id, sp.service_id, pro.profile_pic
                   ORDER BY avg_rating DESC, p.price ASC";
        
        $this->db->query($query);
        $this->db->bind(':serviceType', $serviceType);
        
        if ($excludeServiceId) {
            $this->db->bind(':excludeServiceId', $excludeServiceId);
        }
        
        return $this->db->resultSet();
    }

    public function assignProviderPackageToEvent($replacement_id, $event_id, $package_id, $new_service_id, $client_id) {
        // Add new package to event_package table
        $this->db->query("INSERT INTO event_packages (event_id, service_id, client_id, package_id, status, created_at) VALUES (:event_id, :service_id, :client_id, :package_id, 'ACTIVE', NOW())");
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':service_id', $new_service_id);
        $this->db->bind(':client_id', $client_id);
        $this->db->bind(':package_id', $package_id);
        $this->db->execute();
        
        // Update replacement table with new service
        $this->db->query("UPDATE service_provider_replacements SET new_service_id = :new_service_id, replacement_status = 'ASSIGNED', updated_at = NOW() WHERE replacement_id = :replacement_id");
        $this->db->bind(':replacement_id', $replacement_id);
        $this->db->bind(':new_service_id', $new_service_id);
        return $this->db->execute();
    }

    public function getReplacementHistory() {
        $this->db->query("SELECT 
                sr.replacement_id,
                sr.complaint_id,
                sr.replacement_status,
                sr.updated_at as resolved_at,
                e.event_id,
                e.event_name,
                e.start_datetime as event_date,
                c.client_id,
                c.name as client_name,
                old_sp.service_id as old_service_id,
                old_sp.businessName as provider_name,
                new_sp.service_id as new_service_id,
                CONCAT(new_sp.fname, ' ', new_sp.lname) as replacement_provider
            FROM service_provider_replacements sr
            JOIN events e ON sr.event_id = e.event_id
            JOIN clients c ON e.client_id = c.client_id
            JOIN service_providers old_sp ON sr.old_service_id = old_sp.service_id
            LEFT JOIN service_providers new_sp ON sr.new_service_id = new_sp.service_id
            WHERE sr.replacement_status = 'ASSIGNED' AND sr.new_service_id IS NOT NULL
            ORDER BY sr.updated_at DESC
        ");
        return $this->db->resultSet();
    }   
}