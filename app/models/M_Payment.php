<?php

class M_Payment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function makePayment($data) {
        // Check if payment already exists for this event
        $this->db->query("SELECT * FROM event_payments WHERE event_id = :event_id AND payment_status = 'PAID'");
        $this->db->bind(':event_id', $data['event_id']);
        $existingPayment = $this->db->single();
        
        if($existingPayment) {
            // Payment already exists, return true to avoid duplicate
            return true;
        }
        
        $this->db->query("INSERT INTO event_payments (event_id, client_id, total_amount, payment_method, payment_status, gateway_reference, paid_at) VALUES (:event_id, :client_id, :total_amount, :payment_method, :payment_status, :gateway_reference, :paid_at)");
        // Bind values
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':client_id', $data['client_id']);
        $this->db->bind(':total_amount', $data['total_amount']);
        $this->db->bind(':payment_method', $data['payment_method'] ?? 'CARD'); // PayHere primarily uses cards
        $this->db->bind(':payment_status', $data['payment_status']);
        $this->db->bind(':gateway_reference', $data['gateway_reference']);
        $this->db->bind(':paid_at', $data['paid_at']);
        
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}

?>