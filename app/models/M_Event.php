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

    //check if client has an event at that moment
    public function checkEventHasThisTime($data) {
        $this->db->query("SELECT * FROM events WHERE client_id = :client_id AND ((start_datetime <= :start_datetime AND end_datetime >= :start_datetime) OR (start_datetime <= :end_datetime AND end_datetime >= :end_datetime) OR (start_datetime >= :start_datetime AND end_datetime <= :end_datetime))");
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

    public function updateEventPaymentStatus($eventId, $paymentStatus) {
        $this->db->query("UPDATE events SET progress_step = :progress_step, progress_precent = 100 WHERE event_id = :event_id");
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':progress_step', $paymentStatus);
        
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
       
}