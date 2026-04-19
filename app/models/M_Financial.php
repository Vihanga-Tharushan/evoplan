<?php

class M_Financial{

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getFinancialSummaryByServiceProvider($service_id) {
        $this->db->query("SELECT 
                            (SELECT COUNT(*) FROM events WHERE service_id = :service_id) AS total_events,
                            (SELECT IFNULL(SUM(total_cost), 0) FROM events WHERE service_id = :service_id) AS total_revenue,
                            (SELECT IFNULL(SUM(total_cost), 0) FROM events WHERE service_id = :service_id AND event_date >= CURDATE()) AS upcoming_revenue
                          ");
        $this->db->bind(':service_id', $service_id);
        return $this->db->single();
    }
}



?>