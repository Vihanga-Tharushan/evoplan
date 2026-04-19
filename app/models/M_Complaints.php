<?php

class M_Complaints {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function submitClientComplaint($data) {
        $this->db->query("INSERT INTO client_complaints 
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
        $this->db->query("SELECT 
                cc.*,
                e.event_name,
                sp.businessName as service_provider_name
            FROM client_complaints cc
            LEFT JOIN events e ON cc.event_id = e.event_id
            LEFT JOIN service_providers sp ON cc.service_id = sp.service_id
            WHERE cc.client_id = :client_id AND cc.client_visible = 'ON' AND cc.status_flag = 'ON'
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

    public function getClientComplaintById($complaint_id) {
        $this->db->query("SELECT cc.*,
                e.event_name,
                sp.businessName as service_provider_name
            FROM client_complaints cc
            LEFT JOIN events e ON cc.event_id = e.event_id
            LEFT JOIN service_providers sp ON cc.service_id = sp.service_id
            WHERE cc.complaint_id = :complaint_id AND cc.client_visible = 'ON' AND cc.status_flag = 'ON'");
        $this->db->bind(':complaint_id', $complaint_id);
        return $this->db->single();
    }

    public function getAllServiceProviderComplaints() {
        $this->db->query("SELECT pc.*,
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
            ORDER BY pc.created_at DESC
        ");
        return $this->db->resultSet();
    }

    public function getAllClientComplaints() {//join clients to get names
        $this->db->query("SELECT cc.complaint_id, cc.client_id, cc.event_id, cc.service_id, cc.complainant_type, cc.issue_type, cc.description, cc.status, cc.created_at, cc.updated_at, cc.resolution_type, cc.resolution_note, cc.resolved_at, cc.assigned_ic_id,
                e.event_name,
                sp.businessName as service_provider_name,
                c.name as client_name
            FROM client_complaints cc
            LEFT JOIN events e ON cc.event_id = e.event_id
            LEFT JOIN service_providers sp ON cc.service_id = sp.service_id
            LEFT JOIN clients c ON cc.client_id = c.client_id
            WHERE cc.status != 'RESOLVED'
            ORDER BY cc.created_at DESC
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
        $this->db->query("UPDATE provider_complaints 
            SET 
                status = :status,
                resolution_type = :resolution_type,
                resolution_note = :resolution_note,
                resolved_at = :resolved_at,
                assigned_ic_id = :assigned_ic_id
            WHERE complaint_id = :complaint_id
        ");
        
        // Bind values
        $this->db->bind(':complaint_id', $data['complaint_id']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':resolution_type', isset($data['resolution_type']) && !empty($data['resolution_type']) ? $data['resolution_type'] : NULL);
        $this->db->bind(':resolution_note', isset($data['resolution_note']) && !empty($data['resolution_note']) ? $data['resolution_note'] : NULL);
        $this->db->bind(':assigned_ic_id', isset($data['assigned_ic_id']) && !empty($data['assigned_ic_id']) ? $data['assigned_ic_id'] : NULL);
        
        // Set resolved_at timestamp if status is RESOLVED
        $resolvedAt = ($data['status'] === 'RESOLVED') ? date('Y-m-d H:i:s') : NULL;
        $this->db->bind(':resolved_at', $resolvedAt);

        // Execute
        return $this->db->execute();
    }

    public function updateClientComplaint($data) {
        $this->db->query("UPDATE client_complaints 
            SET 
                status = :status,
                resolution_type = :resolution_type,
                resolution_note = :resolution_note,
                resolved_at = :resolved_at,
                assigned_ic_id = :assigned_ic_id
            WHERE complaint_id = :complaint_id
        ");
        
        $this->db->bind(':complaint_id', $data['complaint_id']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':resolution_type', isset($data['resolution_type']) && !empty($data['resolution_type']) ? $data['resolution_type'] : NULL);
        $this->db->bind(':resolution_note', isset($data['resolution_note']) && !empty($data['resolution_note']) ? $data['resolution_note'] : NULL);
        $this->db->bind(':assigned_ic_id', isset($data['assigned_ic_id']) && !empty($data['assigned_ic_id']) ? $data['assigned_ic_id'] : NULL);
        
        $resolvedAt = ($data['status'] === 'RESOLVED') ? date('Y-m-d H:i:s') : NULL;
        $this->db->bind(':resolved_at', $resolvedAt);

        return $this->db->execute();
    }


    public function getSolvedComplaintsByIcId($ic_id) {
        $this->db->query("SELECT pc.*,
                sp.businessName as provider_name,
                e.event_name,
                CASE 
                    WHEN pc.complainant_type = 'CLIENT' THEN (SELECT name FROM clients WHERE client_id = e.client_id LIMIT 1)
                    ELSE 'Unknown'
                END as client_name
            FROM provider_complaints pc
            LEFT JOIN service_providers sp ON pc.service_id = sp.service_id
            LEFT JOIN events e ON pc.event_id = e.event_id
            WHERE pc.assigned_ic_id = :ic_id AND pc.status = 'RESOLVED'
            ORDER BY pc.resolved_at DESC");
        $this->db->bind(':ic_id', $ic_id);
        return $this->db->resultSet();
    }

    public function getSolvedClientComplaintsByIcId($ic_id) {
        $this->db->query("SELECT cc.complaint_id, cc.client_id, cc.event_id, cc.service_id, cc.complainant_type, cc.issue_type, cc.description, cc.status, cc.created_at, cc.updated_at, cc.resolution_type, cc.resolution_note, cc.resolved_at, cc.assigned_ic_id,
                e.event_name,
                sp.businessName as service_provider_name,
                c.name as client_name
            FROM client_complaints cc
            LEFT JOIN events e ON cc.event_id = e.event_id
            LEFT JOIN service_providers sp ON cc.service_id = sp.service_id
            LEFT JOIN clients c ON cc.client_id = c.client_id
            WHERE cc.assigned_ic_id = :ic_id AND cc.status = 'RESOLVED'
            ORDER BY cc.resolved_at DESC");
        $this->db->bind(':ic_id', $ic_id);
        return $this->db->resultSet();
    }

    // --- Analytics methods for dashboard ---
    public function getDashboardMetrics($start_date = null, $end_date = null) {
        // Open issues (currently unresolved)
        $this->db->query("SELECT COUNT(*) AS open_issues FROM (
            SELECT complaint_id FROM provider_complaints WHERE status != 'RESOLVED'
            UNION ALL
            SELECT complaint_id FROM client_complaints WHERE status != 'RESOLVED'
        ) as combined_open");
        $open = $this->db->single();

        // Resolved this period
        if ($start_date && $end_date) {
            $this->db->query("SELECT COUNT(*) AS resolved_count FROM (
                SELECT complaint_id FROM provider_complaints WHERE status = 'RESOLVED' AND resolved_at BETWEEN :start1 AND :end1
                UNION ALL
                SELECT complaint_id FROM client_complaints WHERE status = 'RESOLVED' AND resolved_at BETWEEN :start2 AND :end2
            ) as combined_resolved");
            $this->db->bind(':start1', $start_date);
            $this->db->bind(':end1', $end_date);
            $this->db->bind(':start2', $start_date);
            $this->db->bind(':end2', $end_date);
            $resolved = $this->db->single();
        } else {
            $this->db->query("SELECT COUNT(*) AS resolved_count FROM (
                SELECT complaint_id FROM provider_complaints WHERE status = 'RESOLVED'
                UNION ALL
                SELECT complaint_id FROM client_complaints WHERE status = 'RESOLVED'
            ) as combined_resolved");
            $resolved = $this->db->single();
        }

        // Pending replacements
        if ($start_date && $end_date) {
            $this->db->query("SELECT COUNT(*) AS pending_replacements FROM event_financial_breakdown WHERE replacement_status = 'REPLACEMENT' AND created_at BETWEEN :start AND :end");
            $this->db->bind(':start', $start_date);
            $this->db->bind(':end', $end_date);
            $pending = $this->db->single();
        } else {
            $this->db->query("SELECT COUNT(*) AS pending_replacements FROM event_financial_breakdown WHERE replacement_status = 'REPLACEMENT'");
            $pending = $this->db->single();
        }

        // Events count (instead of avg resolution time for the 4th card as per dashboard.js logic)
        $this->db->query("SELECT COUNT(*) as events_count FROM events WHERE status = 'ON'");
        $events = $this->db->single();

        return [
            'open_issues' => isset($open->open_issues) ? intval($open->open_issues) : 0,
            'resolved_count' => isset($resolved->resolved_count) ? intval($resolved->resolved_count) : 0,
            'pending_replacements' => isset($pending->pending_replacements) ? intval($pending->pending_replacements) : 0,
            'events_count' => isset($events->events_count) ? intval($events->events_count) : 0
        ];
    }

    public function getIssuesRaisedVsResolvedLastMonths($months = 6) {
        $results = [];
        for ($i = $months-1; $i >= 0; $i--) {
            $start = date('Y-m-01 00:00:00', strtotime("-{$i} months"));
            $end = date('Y-m-t 23:59:59', strtotime("-{$i} months"));

            $this->db->query("SELECT COUNT(*) AS raised FROM provider_complaints WHERE created_at BETWEEN :start AND :end");
            $this->db->bind(':start', $start);
            $this->db->bind(':end', $end);
            $raised = $this->db->single();

            $this->db->query("SELECT COUNT(*) AS resolved FROM provider_complaints WHERE status = 'RESOLVED' AND resolved_at BETWEEN :start AND :end");
            $this->db->bind(':start', $start);
            $this->db->bind(':end', $end);
            $resolved = $this->db->single();

            $results[] = [
                'label' => date('M Y', strtotime($start)),
                'raised' => intval($raised->raised ?? 0),
                'resolved' => intval($resolved->resolved ?? 0)
            ];
        }
        return $results;
    }

    public function getIssuesByCategory($start_date = null, $end_date = null) {
        if ($start_date && $end_date) {
            $this->db->query("SELECT complaint_type AS category, COUNT(*) AS cnt FROM provider_complaints WHERE created_at BETWEEN :start AND :end GROUP BY complaint_type");
            $this->db->bind(':start', $start_date);
            $this->db->bind(':end', $end_date);
        } else {
            $this->db->query("SELECT complaint_type AS category, COUNT(*) AS cnt FROM provider_complaints GROUP BY complaint_type");
        }
        return $this->db->resultSet();
    }

    public function getComplaintStatusBreakdown($start_date = null, $end_date = null) {
        if ($start_date && $end_date) {
            $this->db->query("SELECT status, COUNT(*) AS cnt FROM provider_complaints WHERE created_at BETWEEN :start AND :end GROUP BY status");
            $this->db->bind(':start', $start_date);
            $this->db->bind(':end', $end_date);
        } else {
            $this->db->query("SELECT status, COUNT(*) AS cnt FROM provider_complaints GROUP BY status");
        }
        return $this->db->resultSet();
    }

    public function getAvgResolutionTimeTrend($months = 6) {
        $results = [];
        for ($i = $months-1; $i >= 0; $i--) {
            $start = date('Y-m-01 00:00:00', strtotime("-{$i} months"));
            $end = date('Y-m-t 23:59:59', strtotime("-{$i} months"));

            $this->db->query("SELECT AVG(TIMESTAMPDIFF(DAY, created_at, resolved_at)) AS avg_days FROM provider_complaints WHERE status = 'RESOLVED' AND resolved_at BETWEEN :start AND :end");
            $this->db->bind(':start', $start);
            $this->db->bind(':end', $end);
            $avg = $this->db->single();

            $results[] = [
                'label' => date('M Y', strtotime($start)),
                'avg_days' => $avg && isset($avg->avg_days) ? round(floatval($avg->avg_days), 2) : null
            ];
        }
        return $results;
    }

    public function getReplacementRequestsTrend($months = 6) {
        $results = [];
        for ($i = $months-1; $i >= 0; $i--) {
            $start = date('Y-m-01 00:00:00', strtotime("-{$i} months"));
            $end = date('Y-m-t 23:59:59', strtotime("-{$i} months"));

            $this->db->query("SELECT COUNT(*) AS cnt FROM event_financial_breakdown WHERE replacement_status = 'REPLACEMENT' AND created_at BETWEEN :start AND :end");
            $this->db->bind(':start', $start);
            $this->db->bind(':end', $end);
            $cnt = $this->db->single();

            $results[] = [
                'label' => date('M Y', strtotime($start)),
                'count' => intval($cnt->cnt ?? 0)
            ];
        }
        return $results;
    }

    public function getTopProvidersByComplaints($limit = 5) {
        $this->db->query("SELECT sp.service_id, sp.businessName AS provider_name, COUNT(pc.complaint_id) AS cnt FROM provider_complaints pc LEFT JOIN service_providers sp ON pc.service_id = sp.service_id GROUP BY pc.service_id ORDER BY cnt DESC LIMIT :limit");
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    public function getIssuesRaisedVsResolvedCombined($months = 6) {
        $results = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $start = date('Y-m-01 00:00:00', strtotime("-{$i} months"));
            $end = date('Y-m-t 23:59:59', strtotime("-{$i} months"));

            // Provider complaints
            $this->db->query("SELECT 
                                SUM(CASE WHEN created_at BETWEEN :start1 AND :end1 THEN 1 ELSE 0 END) as raised_p,
                                SUM(CASE WHEN status = 'RESOLVED' AND resolved_at BETWEEN :start2 AND :end2 THEN 1 ELSE 0 END) as resolved_p
                             FROM provider_complaints");
            $this->db->bind(':start1', $start);
            $this->db->bind(':end1', $end);
            $this->db->bind(':start2', $start);
            $this->db->bind(':end2', $end);
            $p_counts = $this->db->single();

            // Client complaints
            $this->db->query("SELECT 
                                SUM(CASE WHEN created_at BETWEEN :start1 AND :end1 THEN 1 ELSE 0 END) as raised_c,
                                SUM(CASE WHEN status = 'RESOLVED' AND resolved_at BETWEEN :start2 AND :end2 THEN 1 ELSE 0 END) as resolved_c
                             FROM client_complaints");
            $this->db->bind(':start1', $start);
            $this->db->bind(':end1', $end);
            $this->db->bind(':start2', $start);
            $this->db->bind(':end2', $end);
            $c_counts = $this->db->single();

            $results[] = [
                'label' => date('M Y', strtotime($start)),
                'raised' => (int)($p_counts->raised_p ?? 0) + (int)($c_counts->raised_c ?? 0),
                'resolved' => (int)($p_counts->resolved_p ?? 0) + (int)($c_counts->resolved_c ?? 0)
            ];
        }
        return $results;
    }

    public function getIssuesByCategoryCombined($start_date = null, $end_date = null) {
        $sql = "SELECT category, SUM(cnt) as cnt FROM (
                    SELECT complaint_type AS category, COUNT(*) AS cnt FROM provider_complaints ";
        if ($start_date && $end_date) {
            $sql .= "WHERE created_at BETWEEN :start1 AND :end1 ";
        }
        $sql .= "GROUP BY complaint_type
                    UNION ALL
                    SELECT issue_type AS category, COUNT(*) AS cnt FROM client_complaints ";
        if ($start_date && $end_date) {
            $sql .= "WHERE created_at BETWEEN :start2 AND :end2 ";
        }
        $sql .= "GROUP BY issue_type
                ) combined GROUP BY category";

        $this->db->query($sql);
        if ($start_date && $end_date) {
            $this->db->bind(':start1', $start_date);
            $this->db->bind(':end1', $end_date);
            $this->db->bind(':start2', $start_date);
            $this->db->bind(':end2', $end_date);
        }
        return $this->db->resultSet();
    }

    public function getComplaintStatusBreakdownCombined($start_date = null, $end_date = null) {
        $sql = "SELECT status, SUM(cnt) as cnt FROM (
                    SELECT status, COUNT(*) AS cnt FROM provider_complaints ";
        if ($start_date && $end_date) {
            $sql .= "WHERE created_at BETWEEN :start1 AND :end1 ";
        }
        $sql .= "GROUP BY status
                    UNION ALL
                    SELECT status, COUNT(*) AS cnt FROM client_complaints ";
        if ($start_date && $end_date) {
            $sql .= "WHERE created_at BETWEEN :start2 AND :end2 ";
        }
        $sql .= "GROUP BY status
                ) combined GROUP BY status";

        $this->db->query($sql);
        if ($start_date && $end_date) {
            $this->db->bind(':start1', $start_date);
            $this->db->bind(':end1', $end_date);
            $this->db->bind(':start2', $start_date);
            $this->db->bind(':end2', $end_date);
        }
        return $this->db->resultSet();
    }

    public function submitServicePComplaint($data) {
        $this->db->query("INSERT INTO provider_complaints 
            (service_id, event_id, complainant_type, complaint_type,event_name, description_text, status) 
            VALUES 
            (:service_id, :event_id, :complainant_type, :complaint_type, :event_name, :description_text, 'SEND')
        ");
        
        // Bind values
        $this->db->bind(':service_id', $data['service_id']);
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':complainant_type', $data['complainant_type']);
        $this->db->bind(':complaint_type', $data['complaint_type']);
        $this->db->bind(':description_text', $data['description_text']);
        $this->db->bind(':event_name', $data['event_name']);

        // Execute
        return $this->db->execute();
    }

}