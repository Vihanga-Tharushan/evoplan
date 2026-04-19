<?php

class M_Event {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    

    public function createEvent($data) {
        $this->db->query("INSERT INTO events (event_name, client_id, event_type,event_description, start_datetime, end_datetime, guest_count, venue_address, venue_type) VALUES (:event_name, :client_id, :event_type, :event_description, :start_datetime, :end_datetime, :guest_count, :venue_address, :venue_type)");
        
        // Bind values
        $this->db->bind(':event_name', $data['event_name']);
        $this->db->bind(':client_id', $data['client_id']);
        $this->db->bind(':event_type', $data['event_type']);
        $this->db->bind(':start_datetime', $data['start_datetime']);
        $this->db->bind(':end_datetime', $data['end_datetime']);
        $this->db->bind(':guest_count', $data['guest_count']);
        $this->db->bind(':venue_address', $data['venue_address']);
        $this->db->bind(':venue_type', $data['venue_type']);
        $this->db->bind(':event_description', $data['event_description']);

        
        // Execute
        if($this->db->execute()) {
            return $this->db->lastInsertId(); // Return the ID of the newly created event
        } else {
            return false;
        }
    }


    public function getEventById($eventId) {
        $this->db->query("SELECT * FROM events WHERE event_id = :eventId");
        $this->db->bind(':eventId', $eventId);
        return $this->db->single();
    }

    //check if client has an event at that moment (overlap detection)
    public function checkEventHasThisTime($data) {
        // Prevent client from having multiple events at the same moment
        // Uses >= and <= to reject even back-to-back events (strict no-overlap policy)
        // If event.end >= input.start AND event.start <= input.end → OVERLAP DETECTED
        $this->db->query("SELECT * FROM events WHERE client_id = :client_id AND end_datetime >= :start_datetime AND start_datetime <= :end_datetime");
        $this->db->bind(':client_id', $data['client_id']);
        $this->db->bind(':start_datetime', $data['start_datetime']);
        $this->db->bind(':end_datetime', $data['end_datetime']);
        $result = $this->db->single();
        return $result ? true : false;
    }

    public function addServiceNeedToEvent($eventId, $service_type_id) {
        $this->db->query("INSERT INTO event_services(event_id, service_type_id) VALUES (:event_id, :service_type_id)");
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':service_type_id', $service_type_id);
        
        return $this->db->execute();
    }


    public function getEventsByClientId($clientId) {
        $this->db->query("SELECT event_id, event_name FROM events WHERE client_id = :clientId ORDER BY start_datetime DESC");
        $this->db->bind(':clientId', $clientId);
        return $this->db->resultSet();
    }

    public function getServiceProvidersForEvent($eventId) {
        $this->db->query("SELECT DISTINCT 
                            sp.service_id,
                            CONCAT(sp.fname, ' ', sp.lname) AS service_provider_name,
                            sp.businessName,
                            sp.serviceType
                        FROM event_packages ep
                        JOIN service_providers sp ON ep.service_id = sp.service_id
                        WHERE ep.event_id = :event_id
                        AND ep.status = 'ON'
                        ORDER BY sp.businessName ASC");
        $this->db->bind(':event_id', $eventId);
        return $this->db->resultSet();
    }

    public function getUpcomingEventsByClientId($clientId) {
        $this->db->query("SELECT * FROM events WHERE client_id = :clientId AND start_datetime >= NOW() ORDER BY start_datetime ASC");
        $this->db->bind(':clientId', $clientId);
        return $this->db->resultSet();
    }

    public function getAllEvents() {
        $this->db->query("SELECT * FROM events ORDER BY start_datetime ASC");
        return $this->db->resultSet();
    }

    public function getPreviousEventsByClientId($clientId) {
        $this->db->query("SELECT * FROM events WHERE client_id = :clientId AND end_datetime < NOW() ORDER BY start_datetime DESC");
        $this->db->bind(':clientId', $clientId);
        return $this->db->resultSet();
    }

    public function getRequiredServicesByEventId($event_id) {
        $this->db->query("SELECT st.name AS service_type FROM event_services es
                                                            JOIN service_types st
                                                            ON es.service_type_id = st.service_type_id
                                                            WHERE es.event_id = :event_id");
        $this->db->bind(':event_id', $event_id);
        $result = $this->db->resultSet();
        return $result;
    }

    public function addPackageToEvent($event_id, $package_id, $service_id, $client_id) {
        $this->db->query("INSERT INTO event_packages(event_id, package_id, service_id, client_id) VALUES (:event_id, :package_id, :service_id, :client_id)");
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':package_id', $package_id);
        $this->db->bind(':service_id', $service_id);
        $this->db->bind(':client_id', $client_id);
        
        return $this->db->execute();
    }

    public function getPackagesByEventId($event_id) {
        $this->db->query("SELECT * FROM event_packages WHERE event_id = :event_id");
        $this->db->bind(':event_id', $event_id);
        return $this->db->resultSet();
    }

    public function getClientByEventId($event_id) {
        $this->db->query("SELECT c.* FROM clients c
                          JOIN events e ON c.client_id = e.client_id
                          WHERE e.event_id = :event_id");
        $this->db->bind(':event_id', $event_id);
        return $this->db->single();
    }

    public function checkPackageInEvent($event_id, $package_id) {
        $this->db->query("SELECT * FROM event_packages WHERE event_id = :event_id AND package_id = :package_id");
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':package_id', $package_id);
        $result = $this->db->single();
        return $result ? true : false;
    }

    public function checkEventProgress($event_id) {
        $this->db->query("SELECT progress_precent FROM events WHERE event_id = :event_id");
        $this->db->bind(':event_id', $event_id);
        $result = $this->db->single();
        return $result ? (int)$result->progress_precent : null;
    }

    public function updateEventProgress($event_id, $progress_precent, $progress_step) {
        $this->db->query("UPDATE events SET progress_precent = :progress_precent, progress_step = :progress_step WHERE event_id = :event_id");
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':progress_precent', $progress_precent);
        $this->db->bind(':progress_step', $progress_step);
        
        return $this->db->execute();
    }

    public function getSelectedPackages($eventId) {
        $this->db->query("SELECT ep.event_package_id,

                        -- package info
                        p.package_id,
                        p.title AS package_name,
                        p.price AS package_price,
                        p.details AS package_details,
                        p.notes AS package_notes,

                        -- service provider info
                        sp.service_id,
                        CONCAT(sp.fname, ' ', sp.lname) AS service_provider_name,
                        sp.serviceType,
                        sp.businessAddress,

                        -- event-package status
                        ep.confirmation_status,
                        ep.sent_status,
                        ep.confirmed_at

                    FROM event_packages ep
                    JOIN packages p
                        ON ep.package_id = p.package_id
                    JOIN service_providers sp
                        ON ep.service_id = sp.service_id

                    WHERE ep.event_id = :event_id
                    AND ep.status = 'ON'");
        $this->db->bind(':event_id', $eventId);
        return $this->db->resultSet();
    }


    public function updateEventVenue($eventId, $venueAddress) {
        $this->db->query("UPDATE events SET venue_address = :venue_address WHERE event_id = :event_id");
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':venue_address', $venueAddress);
        
        return $this->db->execute();
    }
    
    public function getUpcomingEventsByServiceProvider($service_id) {
        $this->db->query("SELECT e.* FROM events e
                          JOIN event_packages ep ON e.event_id = ep.event_id
                          WHERE ep.service_id = :service_id
                          AND e.start_datetime >= NOW()
                          GROUP BY e.event_id
                          ORDER BY e.start_datetime ASC");
        $this->db->bind(':service_id', $service_id);
        return $this->db->resultSet();
    }
    

    public function getPreviousEventsByServiceProvider($service_id) {
        $this->db->query("SELECT e.* FROM events e
                          JOIN event_packages ep ON e.event_id = ep.event_id
                          WHERE ep.service_id = :service_id
                          AND e.end_datetime < NOW()
                          GROUP BY e.event_id
                          ORDER BY e.start_datetime DESC");
        $this->db->bind(':service_id', $service_id);
        return $this->db->resultSet();
    }

    public function rejectEventByProvider($event_id, $service_id, $reason) {

        $this->db->query("UPDATE event_packages SET confirmation_status = 'REJECTED', confirmed_at = NOW(), provider_message = :provider_message WHERE event_id = :event_id AND service_id = :service_id");
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':service_id', $service_id);
        $this->db->bind(':provider_message', $reason);
        
        return $this->db->execute();

    }

    public function confirmEventByProvider($event_id, $service_id, $provider_message) {

        $this->db->query("UPDATE event_packages SET confirmation_status = 'ACCEPTED', confirmed_at = NOW(), provider_message = :provider_message WHERE event_id = :event_id AND service_id = :service_id");
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':service_id', $service_id);
        $this->db->bind(':provider_message', $provider_message);
        
        return $this->db->execute();

    }


    public function getAllEventsByServiceProvider($service_id) {
        
        $this->db->query("SELECT e.* FROM events e
                          JOIN event_packages ep ON e.event_id = ep.event_id
                          WHERE ep.service_id = :service_id
                          GROUP BY e.event_id
                          ORDER BY e.start_datetime DESC");
        $this->db->bind(':service_id', $service_id);
        return $this->db->resultSet();
    }

    public function getTotalEventsByProvider($service_id) {
        $this->db->query("SELECT COUNT(DISTINCT e.event_id) AS total_events FROM events e
                          JOIN event_packages ep ON e.event_id = ep.event_id
                          WHERE ep.service_id = :service_id");
        $this->db->bind(':service_id', $service_id);
        $row = $this->db->single();
        return $row ? (int)$row->total_events : 0;
    }

    public function getUpcomingEventsCountByServiceProvider($service_id) {
        $this->db->query("SELECT COUNT(DISTINCT e.event_id) AS upcoming_events FROM events e
                          JOIN event_packages ep ON e.event_id = ep.event_id
                          WHERE ep.service_id = :service_id
                          AND e.start_datetime >= NOW()");
        $this->db->bind(':service_id', $service_id);
        $row = $this->db->single();
        return $row ? (int)$row->upcoming_events : 0;
    }

    //this is analytics(dashboard page)

    public function getEventStatusData($serviceId){
        $this->db->query("SELECT 
                            confirmation_status,
                            COUNT(*) as count
                        FROM event_packages
                        WHERE service_id = :service_id AND status = 'ON'
                        GROUP BY confirmation_status");
        $this->db->bind(':service_id', $serviceId);
        $results = $this->db->resultSet();
        
        // Format results as array with status as key
        $statusCounts = [
            'ACCEPTED' => 0,
            'PENDING' => 0,
            'REJECTED' => 0,
            'COMPLETED' => 0
        ];
        
        foreach($results as $row) {
            if(isset($statusCounts[$row->confirmation_status])) {
                $statusCounts[$row->confirmation_status] = (int)$row->count;
            }
        }
        
        return $statusCounts;
    }

    public function updateEventPaymentStatus($eventId, $paymentStatus, $event_pin, $totalAmount) {
        $this->db->query("UPDATE events SET progress_step = :progress_step, progress_precent = 100, event_pin = :event_pin, total_cost = :total_cost WHERE event_id = :event_id");
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':progress_step', $paymentStatus);
        $this->db->bind(':event_pin', $event_pin);
        $this->db->bind(':total_cost', $totalAmount);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyAndConfirmEventPin($eventId, $pin) {
        // First, verify the PIN matches the event_pin in database
        $this->db->query("SELECT event_pin FROM events WHERE event_id = :event_id");
        $this->db->bind(':event_id', $eventId);
        $event = $this->db->single();
        
        if (!$event) {
            return ['success' => false, 'message' => 'Event not found'];
        }
        
        // Verify PIN matches - convert both to string and trim whitespace
        $storedPin = trim((string)$event->event_pin);
        $inputPin = trim((string)$pin);
        
        if ($storedPin !== $inputPin) {
            return ['success' => false, 'message' => 'PIN does not match. Please try again.'];
        }
        
        // PIN is correct - return success
        // Note: pin_confirmed will be updated in service_provider_payments table by M_Payment::markAsPinConfirmed()
        return ['success' => true, 'message' => 'PIN verified successfully'];
    }

    public function getEventsWithIssuesByIC($ic_id) {
        $this->db->query("SELECT DISTINCT
                            e.event_id,
                            e.event_name,
                            e.event_type,
                            e.event_description,
                            e.start_datetime,
                            e.end_datetime,
                            e.guest_count,
                            e.venue_address,
                            e.venue_type,
                            e.progress_precent,
                            e.progress_step,
                            e.created_at,
                            e.updated_at,
                            COALESCE(SUM(p.price), 0) as total_cost,
                            c.client_id,
                            c.name AS client_name,
                            c.email AS client_email,
                            c.contact AS client_phone,
                            COUNT(DISTINCT comp.complaint_id) as issue_count,
                            MAX(comp.created_at) as last_issue_date
                        FROM events e
                        JOIN clients c ON e.client_id = c.client_id
                        LEFT JOIN event_packages ep ON e.event_id = ep.event_id
                        LEFT JOIN packages p ON ep.package_id = p.package_id
                        LEFT JOIN client_complaints comp ON e.event_id = comp.event_id AND comp.assigned_ic_id = :ic_id
                        GROUP BY e.event_id
                        ORDER BY e.start_datetime DESC");
        $this->db->bind(':ic_id', $ic_id);
        return $this->db->resultSet();
    }

    public function getEventDetailWithProviders($event_id) {
        $this->db->query("SELECT 
                            ep.event_package_id,
                            ep.event_id,
                            ep.package_id,
                            ep.service_id,
                            ep.confirmation_status,
                            p.title AS package_name,
                            p.price,
                            p.details,
                            sp.service_id,
                            CONCAT(sp.fname, ' ', sp.lname) AS provider_name,
                            sp.businessName,
                            sp.serviceType
                        FROM event_packages ep
                        JOIN packages p ON ep.package_id = p.package_id
                        JOIN service_providers sp ON ep.service_id = sp.service_id
                        WHERE ep.event_id = :event_id AND ep.status = 'ON'");
        $this->db->bind(':event_id', $event_id);
        return $this->db->resultSet();
    }

    public function getEventConflicts($event_id, $ic_id) {
        $this->db->query("SELECT 
                            comp.complaint_id,
                            comp.issue_type AS complaint_type,
                            comp.description,
                            comp.status AS complaint_status,
                            comp.created_at,
                            e.event_id,
                            c.name AS client_name,
                            comp.service_id
                        FROM client_complaints comp
                        LEFT JOIN events e ON comp.event_id = e.event_id
                        LEFT JOIN clients c ON comp.client_id = c.client_id
                        WHERE e.event_id = :event_id AND comp.assigned_ic_id = :ic_id
                        ORDER BY comp.created_at DESC");
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':ic_id', $ic_id);
        return $this->db->resultSet();
    }

    public function getEventTimeline($event_id) {
        $this->db->query("SELECT 
                            e.event_id,
                            e.created_at,
                            'Event Created' as title
                        FROM events e
                        WHERE e.event_id = :event_id_1
                        UNION ALL
                        SELECT 
                            e.event_id,
                            ep.created_at,
                            'Package Selected' as title
                        FROM event_packages ep
                        JOIN events e ON ep.event_id = e.event_id
                        WHERE e.event_id = :event_id_2
                        ORDER BY 2 DESC");
        $this->db->bind(':event_id_1', $event_id);
        $this->db->bind(':event_id_2', $event_id);
        return $this->db->resultSet();
    }

    public function getTotalEventsByClient($clientId) {
        $this->db->query("SELECT COUNT(*) AS total_events FROM events WHERE client_id = :client_id");
        $this->db->bind(':client_id', $clientId);
        $row = $this->db->single();
        return $row ? (int)$row->total_events : 0;
    }

    public function getUpcomingEventsCountByClient($clientId) {
        $this->db->query("SELECT COUNT(*) AS upcoming_events
                          FROM events
                          WHERE client_id = :client_id
                          AND start_datetime >= NOW()
                          AND COALESCE(progress_step, '') <> 'CANCELLED'");
        $this->db->bind(':client_id', $clientId);
        $row = $this->db->single();
        return $row ? (int)$row->upcoming_events : 0;
    }

    public function cancelEvent($eventId, $cancelReason) {
        $this->db->query("UPDATE events 
                          SET is_completed = 'CANCELED', 
                              cancel_reason = :cancel_reason,
                              refundSTate = 'PENDING',
                              updated_at = NOW()
                          WHERE event_id = :event_id");
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':cancel_reason', $cancelReason);
        
        return $this->db->execute();
    }

    // Refund Management Methods
    public function getCancelledEventsPendingRefund() {
        $this->db->query("SELECT 
                            e.event_id,
                            e.event_name,
                            e.event_type,
                            e.total_cost,
                            e.cancel_reason,
                            e.created_at,
                            e.updated_at,
                            c.client_id,
                            c.name AS client_name,
                            c.email AS client_email,
                            t.total_amount AS paid_amount,
                            t.transaction_id
                        FROM events e
                        LEFT JOIN clients c ON e.client_id = c.client_id
                        LEFT JOIN transactions t ON e.event_id = t.event_id AND t.payment_status = 'PAID'
                        WHERE e.is_completed = 'CANCELED' 
                        AND e.refundSTate = 'PENDING'
                        ORDER BY e.updated_at DESC");
        return $this->db->resultSet();
    }

    public function updateRefundStatus($eventId, $refundStatus, $refundAmount = null, $rejectReason = null) {
        if ($refundStatus === 'REFUNDED') {
            $this->db->query("UPDATE events 
                              SET refundSTate = :refund_status,
                                  refundAmount = :refund_amount,
                                  updated_at = NOW()
                              WHERE event_id = :event_id");
            $this->db->bind(':refund_amount', $refundAmount);
        } elseif ($refundStatus === 'REJECTED') {
            $this->db->query("UPDATE events 
                              SET refundSTate = :refund_status,
                                  refundrRejectReaon = :reject_reason,
                                  updated_at = NOW()
                              WHERE event_id = :event_id");
            $this->db->bind(':reject_reason', $rejectReason);
        } else {
            $this->db->query("UPDATE events 
                              SET refundSTate = :refund_status,
                                  updated_at = NOW()
                              WHERE event_id = :event_id");
        }
        
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':refund_status', $refundStatus);
        
        return $this->db->execute();
    }

    public function getResolvedRefunds() {
        $this->db->query("SELECT 
                            e.event_id,
                            e.event_name,
                            e.event_type,
                            e.total_cost,
                            e.cancel_reason,
                            e.refundSTate,
                            e.refundAmount,
                            e.refundrRejectReaon,
                            e.updated_at,
                            c.client_id,
                            c.name AS client_name,
                            c.email AS client_email,
                            t.transaction_id,
                            t.total_amount AS paid_amount
                        FROM events e
                        LEFT JOIN clients c ON e.client_id = c.client_id
                        LEFT JOIN transactions t ON e.event_id = t.event_id AND t.payment_status = 'PAID'
                        WHERE e.is_completed = 'CANCELED' 
                        AND e.refundSTate IN ('REFUNDED', 'REJECTED')
                        ORDER BY e.updated_at DESC");
        return $this->db->resultSet();
    }

    
       
}