<?php
    class M_eventView {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        // Load all events
        public function getEvents(){
            $this->db->query("SELECT e.*, p.p_name FROM events e JOIN providers p ON e.provider_id = p.p_id");
            $results = $this->db->resultSet();
            return $results;
        }

        // Load all events from view with nested packages and providers
        public function getEventsFullView(){
            $this->db->query("SELECT * FROM event_full_view ORDER BY event_id, package_name, service_provider_name");
            $results = $this->db->resultSet();
            
            if(!$results){
                return [];
            }

            // Transform flat data into nested structure
            $events = [];
            $eventMap = [];

            foreach($results as $row){
            $eventId = $row->event_id;

                // Initialize event if not exists
                if(!isset($eventMap[$eventId])){
                    $event = [
                        'event_id' => $row->event_id,
                        'client_id' => null,
                        'client_name' => $row->client_name ?? '',
                        'client_email' => $row->client_email ?? '',
                        'client_phone' => $row->client_phone ?? '',
                        'event_name' => $row->event_name,
                        'event_type' => $row->event_type,
                        'event_description' => $row->description ?? '',
                        'start_datetime' => $row->event_date . 'T' . (str_replace('00:00:00', '', $row->start_time) ?: '09:00:00'),
                        'end_datetime' => $row->event_date . 'T' . (str_replace('00:00:00', '', $row->end_time) ?: '17:00:00'),
                        'guest_count' => (int)($row->guest_count ?? 0),
                        'venue_type' => 'HAS_VENUE',
                        'venue_address' => $row->venue ?? '',
                        'total_cost' => (float)($row->total_cost ?? 0),
                        'progress_percent' => (int)($row->progress_precent ?? 100),
                        'status' => 'Completed',
                        'packages' => [],
                        'providers' => [],
                        'conflicts' => [],
                        'timeline' => []
                    ];
                    $eventMap[$eventId] = $event;
                    $events[] = &$eventMap[$eventId];
                }

                // Add package with its provider if not null
                if($row->package_name){
                    // Check if package already exists
                    $packageIndex = -1;
                    foreach($eventMap[$eventId]['packages'] as $idx => $pkg){
                        if($pkg['name'] === $row->package_name){
                            $packageIndex = $idx;
                            break;
                        }
                    }

                    if($packageIndex === -1){
                        // New package - add it with its provider
                        $eventMap[$eventId]['packages'][] = [
                            'name' => $row->package_name,
                            'cost' => (float)($row->package_cost ?? 0),
                            'items' => 'Package items',
                            'providers' => []
                        ];
                        $packageIndex = count($eventMap[$eventId]['packages']) - 1;
                    }

                    // Add provider to this package if provider exists
                    if($row->service_provider_name){
                        // Check if provider already exists for this package
                        $providerExists = false;
                        foreach($eventMap[$eventId]['packages'][$packageIndex]['providers'] as $prov){
                            if($prov['name'] === $row->service_provider_name){
                                $providerExists = true;
                                break;
                            }
                        }

                        if(!$providerExists){
                            $eventMap[$eventId]['packages'][$packageIndex]['providers'][] = [
                                'id' => $eventMap[$eventId]['event_id'] * 100 + count($eventMap[$eventId]['packages'][$packageIndex]['providers']),
                                'name' => $row->service_provider_name,
                                'role' => $row->service_provider_role ?? 'Service Provider',
                                'confirmation' => strtolower($row->confirmation_status ?? 'pending')
                            ];
                        }
                    }
                }
            }

            return array_values($events);
        }

    }