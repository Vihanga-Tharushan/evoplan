<?php

class M_Payment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getEventPinForPaidEvent($eventId){
        $this->db->query("SELECT event_pin FROM events WHERE event_id = :event_id AND progress_step = 'STEP_3_PAYMENT' LIMIT 1");
        $this->db->bind(':event_id', $eventId);
        $row = $this->db->single();
        return $row ? $row->event_pin : null;
    }
    public function getPaymentByEventId($eventId) {
        $this->db->query("SELECT * FROM transactions WHERE event_id = :event_id AND payment_status = 'PAID' ORDER BY transaction_id DESC LIMIT 1");
        $this->db->bind(':event_id', $eventId);
        return $this->db->single();
    }


    public function makePayment($data) {
        // Check if payment already exists for this transaction pair
        $this->db->query("SELECT * FROM transactions WHERE event_id = :event_id AND sender_id = :sender_id AND receiver_id = :receiver_id AND payment_status = 'PAID'");
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':sender_id', $data['sender_id']);
        $this->db->bind(':receiver_id', $data['receiver_id']);
        $existingPayment = $this->db->single();
        
        if($existingPayment) {
            // Payment already exists, return true to avoid duplicate
            return true;
        }
        
        $this->db->query("INSERT INTO transactions (event_id, sender_id, receiver_id, sender_type, receiver_type, total_amount, payment_method, payment_status, gateway_reference, paid_at) VALUES (:event_id, :sender_id, :receiver_id, :sender_type, :receiver_type, :total_amount, :payment_method, :payment_status, :gateway_reference, :paid_at)");
        // Bind values
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':sender_id', $data['sender_id']);
        $this->db->bind(':receiver_id', $data['receiver_id']);
        $this->db->bind(':sender_type', $data['sender_type'] ?? 'CLIENT');
        $this->db->bind(':receiver_type', $data['receiver_type'] ?? 'SERVICEP');
        $this->db->bind(':total_amount', $data['total_amount']);
        $this->db->bind(':payment_method', $data['payment_method'] ?? 'CARD');
        $this->db->bind(':payment_status', $data['payment_status'] ?? 'PAID');
        $this->db->bind(':gateway_reference', $data['gateway_reference'] ?? null);
        $this->db->bind(':paid_at', $data['paid_at'] ?? date('Y-m-d H:i:s'));
        
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


    //update pin confirmation 
    public function markAsPinConfirmed($eventId, $serviceId) {
        $this->db->query("UPDATE service_provider_payments SET pin_confirm = 'CONFIRMED', pin_confirmed_at = NOW() WHERE event_id = :event_id AND service_id = :service_id");
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':service_id', $serviceId);

        if ($this->db->execute()) {
            return ['success' => true, 'message' => 'PIN confirmed successfully'];
        } else {
            return ['success' => false, 'message' => 'Failed to confirm PIN'];
        }
    }

    public function getTotalPaidAmountByClient($clientId) {
        $this->db->query("SELECT COALESCE(SUM(total_amount), 0) AS total_paid
                          FROM transactions
                          WHERE sender_id = :client_id
                          AND sender_type = 'CLIENT'
                          AND payment_status = 'PAID'");
        $this->db->bind(':client_id', $clientId);
        $row = $this->db->single();
        return $row ? (float)$row->total_paid : 0.0;
    }

    public function getFinancialOverviewByClient($clientId) {
        $this->db->query("SELECT YEAR(COALESCE(paid_at, NOW())) AS y,
                                 MONTH(COALESCE(paid_at, NOW())) AS m,
                                 COALESCE(SUM(total_amount), 0) AS amount
                          FROM transactions
                          WHERE sender_id = :client_id
                          AND sender_type = 'CLIENT'
                          AND payment_status = 'PAID'
                          GROUP BY YEAR(COALESCE(paid_at, NOW())), MONTH(COALESCE(paid_at, NOW()))
                          ORDER BY YEAR(COALESCE(paid_at, NOW())) DESC, MONTH(COALESCE(paid_at, NOW())) ASC");
        $this->db->bind(':client_id', $clientId);
        $rows = $this->db->resultSet();

        $series = [];
        foreach ($rows as $row) {
            $year = (string)($row->y ?? '');
            $monthIndex = (int)($row->m ?? 0) - 1;
            if ($year === '' || $monthIndex < 0 || $monthIndex > 11) {
                continue;
            }
            if (!isset($series[$year])) {
                $series[$year] = array_fill(0, 12, 0);
            }
            $series[$year][$monthIndex] = (float)($row->amount ?? 0);
        }

        if (empty($series)) {
            $currentYear = (string)date('Y');
            $series[$currentYear] = array_fill(0, 12, 0);
        }

        $years = array_keys($series);
        rsort($years, SORT_NUMERIC);

        // Ensure ordered output by year desc.
        $orderedSeries = [];
        foreach ($years as $y) {
            $orderedSeries[$y] = $series[$y];
        }

        $growth = [];
        for ($i = 0; $i < count($years); $i++) {
            $year = $years[$i];
            $currentTotal = array_sum($orderedSeries[$year]);
            $prevYear = isset($years[$i + 1]) ? $years[$i + 1] : null;
            $prevTotal = $prevYear ? array_sum($orderedSeries[$prevYear]) : 0;

            if ($prevTotal > 0) {
                $pct = (($currentTotal - $prevTotal) / $prevTotal) * 100;
            } else {
                $pct = $currentTotal > 0 ? 100 : 0;
            }
            $growth[$year] = sprintf('%+d%%', (int)round($pct));
        }

        return [
            'years' => $years,
            'series' => $orderedSeries,
            'growth' => $growth
        ];
    }

    public function getClientEventTransactions($clientId, $eventId = null) {
        $query = "SELECT * FROM transactions 
                  WHERE sender_id = :client_id 
                  AND sender_type = 'CLIENT'";
        
        if ($eventId !== null) {
            $query .= " AND event_id = :event_id";
        }
        
        $query .= " ORDER BY paid_at DESC";
        
        $this->db->query($query);
        $this->db->bind(':client_id', $clientId);
        
        if ($eventId !== null) {
            $this->db->bind(':event_id', $eventId);
            return $this->db->single();
        }
        
        return $this->db->resultSet();
    }


    //service provider related methods

    public function getTotalEarningsByServiceProvider($service_id) {
        $this->db->query("SELECT COALESCE(SUM(amount), 0) AS total_earnings
                          FROM service_provider_payments
                          WHERE service_id = :service_id");
        $this->db->bind(':service_id', $service_id);
        $row = $this->db->single();
        return $row ? (float)$row->total_earnings : 0.0;
    }

    public function getFinancialOverviewByServiceProvider($service_id, $year) {
        $this->db->query("SELECT MONTH(created_at) AS m, COALESCE(SUM(amount), 0) AS amount
                          FROM service_provider_payments
                          WHERE service_id = :service_id
                          AND YEAR(created_at) = :year
                          AND payment_status IN ('PENDING', 'COMPLETED')
                          GROUP BY MONTH(created_at)
                          ORDER BY MONTH(created_at) ASC");
        $this->db->bind(':service_id', $service_id);
        $this->db->bind(':year', $year);
        $rows = $this->db->resultSet();

        // Initialize monthly data array with zeros
        $monthlyData = array_fill(0, 12, 0);

        // Fill in the actual values from the query results
        foreach ($rows as $row) {
            $monthIndex = (int)$row->m - 1; // Convert month to 0-based index
            $monthlyData[$monthIndex] = (float)$row->amount;
        }

        // Calculate growth rate
        $prevYear = $year - 1;
        $this->db->query("SELECT COALESCE(SUM(amount), 0) AS amount
                          FROM service_provider_payments
                          WHERE service_id = :service_id
                          AND YEAR(created_at) = :prev_year
                          AND payment_status IN ('PENDING', 'COMPLETED')");
        $this->db->bind(':service_id', $service_id);
        $this->db->bind(':prev_year', $prevYear);
        $prevYearTotal = $this->db->single();
        $prevTotal = $prevYearTotal ? (float)$prevYearTotal->amount : 0;
        
        $currentTotal = array_sum($monthlyData);
        if ($prevTotal > 0) {
            $growth = (($currentTotal - $prevTotal) / $prevTotal) * 100;
        } else {
            $growth = $currentTotal > 0 ? 100 : 0;
        }

        return [
            'data' => $monthlyData,
            'growth' => sprintf('%+d%%', (int)round($growth))
        ];
    }

    public function getPendingPaymentsByServiceProvider($service_id) {
        $this->db->query("SELECT count(*) AS pending_count FROM service_provider_payments WHERE service_id = :service_id AND payment_status = 'PENDING' ORDER BY created_at DESC");
        $this->db->bind(':service_id', $service_id);
        $row = $this->db->single();
        return $row ? (int)$row->pending_count : 0;
    }

    public function getTotalPendingPaymentAmountByServiceProvider($service_id) {
        $this->db->query("SELECT COALESCE(SUM(amount), 0) AS pending_amount 
                          FROM service_provider_payments 
                          WHERE service_id = :service_id 
                          AND payment_status = 'PENDING'");
        $this->db->bind(':service_id', $service_id);
        $row = $this->db->single();
        return $row ? (float)$row->pending_amount : 0.0;
    }

    public function getTotalPaidOutPaymentsAmountByServiceProvider($service_id) {
        $this->db->query("SELECT COALESCE(SUM(amount), 0) AS paidout_amount 
                          FROM service_provider_payments 
                          WHERE service_id = :service_id 
                          AND payment_status = 'PAID'");
        $this->db->bind(':service_id', $service_id);
        $row = $this->db->single();
        return $row ? (float)$row->paidout_amount : 0.0;
    }

    public function getAllPaymentsByServiceProvider($service_id) {
        $this->db->query("SELECT * FROM service_provider_payments WHERE service_id = :service_id ORDER BY created_at DESC");
        $this->db->bind(':service_id', $service_id);
        return $this->db->resultSet();
    }

    public function getBankDetailsByServiceProvider($service_id) {
        $this->db->query("SELECT bankName, accountHolderName, accountNumber, branchName FROM service_providers WHERE service_id = :service_id LIMIT 1");
        $this->db->bind(':service_id', $service_id);
        return $this->db->single();
    }

    // Fetch event details for a given event_id
    public function getEventDetailsForPayment($event_id) {
        $this->db->query("SELECT event_id, event_name, event_type, event_description, start_datetime, end_datetime, guest_count, venue_address, venue_type 
                          FROM events 
                          WHERE event_id = :event_id");
        $this->db->bind(':event_id', $event_id);
        return $this->db->single();
    }

    // Fetch all event details for multiple event IDs used in payments
    public function getEventDetailsForPayments($event_ids) {
        if (empty($event_ids)) {
            return [];
        }
        
        $placeholders = implode(',', array_fill(0, count($event_ids), '?'));
        $this->db->query("SELECT event_id, event_name, event_type, event_description, start_datetime, end_datetime, guest_count, venue_address, venue_type 
                          FROM events 
                          WHERE event_id IN ($placeholders)");
        
        foreach ($event_ids as $index => $id) {
            $this->db->bind($index + 1, $id);
        }
        
        return $this->db->resultSet();
    }

    //update bank details for service provider
    public function updateBankDetails($data) {
        $this->db->query("UPDATE service_providers SET bankName = :bankName, accountHolderName = :accountHolderName, accountNumber = :accountNumber, branchName = :branchName WHERE service_id = :service_id");
        $this->db->bind(':bankName', $data['bankName']);
        $this->db->bind(':accountHolderName', $data['accountHolderName']);
        $this->db->bind(':accountNumber', $data['accountNumber']);
        $this->db->bind(':branchName', $data['branchName']);
        $this->db->bind(':service_id', $_SESSION['service_id']);
        
        return $this->db->execute();
    }

    // Refund Processing Methods
    public function processRefund($eventId, $refundAmount) {
        // Get original transaction details
        $this->db->query("SELECT * FROM transactions WHERE event_id = :event_id AND payment_status = 'PAID' LIMIT 1");
        $this->db->bind(':event_id', $eventId);
        $originalTransaction = $this->db->single();

        if (!$originalTransaction) {
            return false; // No paid transaction found
        }

        // Create refund transaction record
        $this->db->query("INSERT INTO transactions (event_id, sender_id, receiver_id, sender_type, receiver_type, total_amount, payment_method, payment_status, gateway_reference, paid_at) 
                          VALUES (:event_id, :sender_id, :receiver_id, :sender_type, :receiver_type, :refund_amount, :payment_method, :payment_status, :gateway_reference, :paid_at)");
        
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':sender_id', $originalTransaction->receiver_id); // Refund goes back to client
        $this->db->bind(':receiver_id', 1); // Assuming 1 is the system account or original sender
        $this->db->bind(':sender_type', 'SYSTEM');
        $this->db->bind(':receiver_type', 'CLIENT');
        $this->db->bind(':refund_amount', $refundAmount); // Negative amount for refund
        $this->db->bind(':payment_method', $originalTransaction->payment_method);
        $this->db->bind(':payment_status', 'REFUND');
        $this->db->bind(':gateway_reference', 'REFUND_' . $originalTransaction->gateway_reference);
        $this->db->bind(':paid_at', date('Y-m-d H:i:s'));

        return $this->db->execute();
    }

    public function getRefundsByEventId($eventId) {
        $this->db->query("SELECT * FROM transactions WHERE event_id = :event_id AND payment_status = 'REFUND' ORDER BY paid_at DESC");
        $this->db->bind(':event_id', $eventId);
        return $this->db->resultSet();
    }




}


?>