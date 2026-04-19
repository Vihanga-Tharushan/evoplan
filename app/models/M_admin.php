<?php
    class M_Admin {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        // Get all transactions data with detailed information
        public function getTransactions(){
            $this->db->query("SELECT 
                t.transaction_id,
                t.event_id,
                t.sender_id,
                t.receiver_id,
                t.sender_type,
                t.receiver_type,
                t.total_amount,
                t.payment_method,
                t.payment_status,
                t.paid_at,
                t.created_at,
                COALESCE(c.name, CONCAT(sp.fname, ' ', sp.lname)) AS sender_name,
                COALESCE(sp2.businessName, c2.name) AS receiver_name,
                e.event_name,
                e.event_type
            FROM transactions t
            LEFT JOIN clients c ON t.sender_id = c.client_id AND t.sender_type = 'CLIENT'
            LEFT JOIN service_providers sp ON t.sender_id = sp.service_id AND t.sender_type = 'SERVICEP'
            LEFT JOIN service_providers sp2 ON t.receiver_id = sp2.service_id AND t.receiver_type = 'SERVICEP'
            LEFT JOIN clients c2 ON t.receiver_id = c2.client_id AND t.receiver_type = 'CLIENT'
            LEFT JOIN events e ON t.event_id = e.event_id
            ORDER BY t.created_at DESC");
            $results = $this->db->resultSet();
            return $results;
        }

        // Get all clients payments data
        public function getClientPayments(){
            $this->db->query("SELECT 
                t.transaction_id,
                t.event_id,
                t.sender_id,
                t.total_amount,
                t.payment_status,
                c.name AS client_name,
                e.event_name,
                e.event_type,
                e.created_at AS event_created_at
            FROM transactions t
            LEFT JOIN clients c ON t.sender_id = c.client_id
            LEFT JOIN events e ON t.event_id = e.event_id
            WHERE t.sender_type = 'CLIENT'
            ORDER BY t.created_at DESC");
            $results = $this->db->resultSet();
            return $results;
        }

        //Get all service provider payments request data
        public function getProviderPaymentsRequests(){
            $this->db->query("SELECT 
                spp.payment_id,
                spp.service_id,
                spp.event_id,
                spp.amount,
                spp.payment_status,
                spp.created_at,
                sp.businessName,
                sp.serviceType,
                e.event_name
            FROM service_provider_payments spp
            LEFT JOIN service_providers sp ON spp.service_id = sp.service_id
            LEFT JOIN events e ON spp.event_id = e.event_id
            WHERE sp.Approval = 'APPROVED' AND sp.status = 'ACTIVE' AND pin_confirm = 'CONFIRMED'
            ORDER BY spp.created_at ASC");
            $results = $this->db->resultSet();
            return $results;
        }

        // Get all service applications data with service provider information
        public function getServiceApplications(){
            $this->db->query("SELECT 
                service_id,
                fname,
                lname,
                businessName,
                serviceType,
                license,
                Approval,
                email,
                DATE (created_at) AS created_at
            FROM service_providers
            ORDER BY created_at DESC");
            $results = $this->db->resultSet();
            return $results;
        }
        
        // Update service provider approval status
        public function updateServiceApproval($service_id, $approval_status){
            $this->db->query("UPDATE service_providers SET Approval = :approval WHERE service_id = :service_id");
            $this->db->bind(':approval', $approval_status);
            $this->db->bind(':service_id', $service_id);
            
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Get all client complaints data with client information
        public function getClientComplaints(){
            $this->db->query("SELECT 
                cc.complaint_id,
                cc.client_id,
                cc.event_id,
                cc.issue_type,
                cc.description,
                cc.status,
                cc.created_at,
                c.name AS client_name
            FROM client_complaints cc
            LEFT JOIN clients c ON cc.client_id = c.client_id
            ORDER BY cc.created_at DESC");
            $results = $this->db->resultSet();
            return $results;
        }

        // Get all service provider complaints data with provider information
        public function getProviderComplaints(){
            $this->db->query("SELECT 
                pc.complaint_id,
                pc.service_id,
                pc.event_id,
                pc.event_name,
                pc.complaint_type,
                pc.description_text,
                pc.status,
                pc.created_at,
                COALESCE(sp.businessName, CONCAT(sp.fname, ' ', sp.lname)) AS service_name
            FROM provider_complaints pc
            LEFT JOIN service_providers sp ON pc.service_id = sp.service_id
            ORDER BY pc.created_at DESC");
            $results = $this->db->resultSet();
            return $results;
        }

        // Get all clients data (only ACTIVE)
        public function getClients(){
            $this->db->query("SELECT * FROM clients WHERE status = 'ACTIVE'");
            $results = $this->db->resultSet();
            return $results;
        }

        // Get all service providers data (only APPROVED and ACTIVE)
        public function getServiceProviders(){
            $this->db->query("SELECT * FROM service_providers WHERE Approval = 'APPROVED' AND status = 'ACTIVE'");
            $results = $this->db->resultSet();
            return $results;
        }

        // Soft delete profiles by ID and type (client or service provider) - changes status to DEACTIVE
        public function deleteProfile($user_id, $type = 'client'){
            if ($type === 'service_provider') {
                return $this->updateServiceProviderStatus($user_id, 'DEACTIVE');
            } else {
                return $this->updateClientStatus($user_id, 'DEACTIVE');
            }
        }
        
        // Update client status
        public function updateClientStatus($client_id, $status){
            $this->db->query("UPDATE clients SET status = :status WHERE client_id = :client_id");
            $this->db->bind(':status', $status);
            $this->db->bind(':client_id', $client_id);
            
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        // Update service provider status
        public function updateServiceProviderStatus($service_id, $status){
            $this->db->query("UPDATE service_providers SET status = :status WHERE service_id = :service_id");
            $this->db->bind(':status', $status);
            $this->db->bind(':service_id', $service_id);
            
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        // Add Admin
        public function addAdmin($data){
            $this->db->query("INSERT INTO admins (a_name, a_email, a_phone, a_password) VALUES (:a_name, :a_email, :a_phone, :a_password)");
            // Bind values
            $this->db->bind(':a_name', $data['a_name']);
            $this->db->bind(':a_email', $data['a_email']);
            $this->db->bind(':a_phone', $data['a_phone']);
            $this->db->bind(':a_password', $data['a_password']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Load all admins
        public function getAdmins(){
            $this->db->query("SELECT * FROM admins");
            $results = $this->db->resultSet();
            return $results;
        }

        // Find admin by email
        public function findAdminByEmail($a_email) {
            $this->db->query("SELECT * FROM admins WHERE a_email = :a_email");
            $this->db->bind(':a_email', $a_email);

            $row = $this->db->single();

            // Check row
            if($row){
                return true;
            } else {
                return false;
            }
        }
        
        // Update Admin
        public function updateAdmin($data){
            $this->db->query("UPDATE admins SET a_name = :a_name, a_email = :a_email, a_phone = :a_phone, a_password = :a_password WHERE a_id = :a_id");
            // Bind values
            $this->db->bind(':a_name', $data['a_name']);
            $this->db->bind(':a_email', $data['a_email']);
            $this->db->bind(':a_phone', $data['a_phone']);
            $this->db->bind(':a_password', password_hash($data['a_password'], PASSWORD_DEFAULT));
            $this->db->bind(':a_id', $data['a_id']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Get Admin by ID
        public function getAdminById($a_id){
            $this->db->query("SELECT * FROM admins WHERE a_id = :a_id");
            $this->db->bind(':a_id', $a_id);

            $row = $this->db->single();

            return $row;
        }

        // Delete Admin
        public function deleteAdmin($a_id){
            $this->db->query("DELETE FROM admins WHERE a_id = :a_id");
            // Bind values
            $this->db->bind(':a_id', $a_id);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        // Login Admin
        public function adminLogin($a_email, $a_password){
            $this->db->query("SELECT * FROM admins WHERE a_email = :a_email");
            $this->db->bind(':a_email', $a_email);

            $row = $this->db->single();

            $hashed_password = $row->a_password;

            if(password_verify($a_password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        // Add Coordinator
        public function addCoordinator($data){
            $this->db->query("INSERT INTO coordinators (ic_name, ic_email, ic_phone, ic_password) VALUES (:ic_name, :ic_email, :ic_phone, :ic_password)");
            // Bind values
            $this->db->bind(':ic_name', $data['ic_name']);
            $this->db->bind(':ic_email', $data['ic_email']);
            $this->db->bind(':ic_phone', $data['ic_phone']);
            $this->db->bind(':ic_password', $data['ic_password']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Load all coordinators
        public function getCoordinators(){
            $this->db->query("SELECT * FROM coordinators");
            $results = $this->db->resultSet();
            return $results;
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

        // Update Coordinator
        public function updateCoordinator($data){
            $this->db->query("UPDATE coordinators SET ic_name = :ic_name, ic_email = :ic_email, ic_phone = :ic_phone, ic_password = :ic_password WHERE ic_id = :ic_id");
            // Bind values
            $this->db->bind(':ic_name', $data['ic_name']);
            $this->db->bind(':ic_email', $data['ic_email']);
            $this->db->bind(':ic_phone', $data['ic_phone']);
            $this->db->bind(':ic_password', password_hash($data['ic_password'], PASSWORD_DEFAULT));
            $this->db->bind(':ic_id', $data['ic_id']);

            // Execute  
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Get Coordinator by ID
        public function getCoordinatorById($ic_id){
            $this->db->query("SELECT * FROM coordinators WHERE ic_id = :ic_id");
            $this->db->bind(':ic_id', $ic_id);

            $row = $this->db->single();

            return $row;
        }

        // Delete Coordinator
        public function deleteCoordinator($ic_id){
            $this->db->query("DELETE FROM coordinators WHERE ic_id = :ic_id");
            // Bind values
            $this->db->bind(':ic_id', $ic_id);

            // Execute
            if($this->db->execute()){
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

        // Add Photo to Landing Page
        public function addPhoto($data){
            $this->db->query("INSERT INTO landing_photos (event_name, event_date, event_photo_name) VALUES (:event_name, :event_date, :event_photo_name)");
            // Bind values
            $this->db->bind(':event_name', $data['event_name']);
            $this->db->bind(':event_date', $data['event_date']);
            $this->db->bind(':event_photo_name', $data['event_photo_name']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Load all landing page photos to display in admin features page
        public function getLandingPagePhotos(){
            $this->db->query("SELECT * FROM landing_photos where status = 'ACTIVE'");
            $results = $this->db->resultSet();
            return $results;
        }

        // Get Photo by ID
        public function getPhotoById($photo_id){
            $this->db->query("SELECT * FROM landing_photos WHERE photo_id = :photo_id");
            $this->db->bind(':photo_id', $photo_id);

            $row = $this->db->single();

            return $row;
        }

        // Update landing page photo (with new photo)
        public function updatePhoto($data){
            $this->db->query("UPDATE landing_photos SET event_name = :event_name, event_date = :event_date, event_photo_name = :event_photo_name WHERE photo_id = :photo_id");
            // Bind values
            $this->db->bind(':event_name', $data['event_name']);
            $this->db->bind(':event_date', $data['event_date']);
            $this->db->bind(':event_photo_name', $data['event_photo_name']);
            $this->db->bind(':photo_id', $data['photo_id']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Update landing page photo info only (without changing photo)
        public function updatePhotoInfo($data){
            $this->db->query("UPDATE landing_photos SET event_name = :event_name, event_date = :event_date WHERE photo_id = :photo_id");
            // Bind values
            $this->db->bind(':event_name', $data['event_name']);
            $this->db->bind(':event_date', $data['event_date']);
            $this->db->bind(':photo_id', $data['photo_id']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Delete landing page photo
        public function deletePhoto($photo_id){
            $this->db->query("UPDATE landing_photos SET status = :status WHERE photo_id = :photo_id");
            // Bind values
            $this->db->bind(':status', 'DEACTIVE');
            $this->db->bind(':photo_id', $photo_id);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Get event progress distribution for dashboard
        public function getEventProgressDistribution(){
            $counts = [0, 0, 0]; // [33%, 66%, 100%]
            
            // Count events at 33% progress (Basic Details only)
            $this->db->query("SELECT COUNT(*) as count FROM events WHERE progress_precent <= 33.33");
            $result = $this->db->single();
            $counts[0] = $result->count ?? 0;
            
            // Count events at 66% progress (Waiting for confirmations)
            $this->db->query("SELECT COUNT(*) as count FROM events WHERE progress_precent > 33.33 AND progress_precent < 100");
            $result = $this->db->single();
            $counts[1] = $result->count ?? 0;
            
            // Count events at 100% progress (Completed)
            $this->db->query("SELECT COUNT(*) as count FROM events WHERE progress_precent >= 100");
            $result = $this->db->single();
            $counts[2] = $result->count ?? 0;
            
            return $counts;
        }

        // Get service provider approval status distribution for dashboard
        public function getServiceProviderApprovalDistribution(){
            $counts = [0, 0, 0]; // [Approved, Pending, Rejected]
            
            // Count approved service providers
            $this->db->query("SELECT COUNT(*) as count FROM service_providers WHERE Approval = 'APPROVED' AND status = 'ACTIVE'");
            $result = $this->db->single();
            $counts[0] = $result->count ?? 0;
            
            // Count pending service providers
            $this->db->query("SELECT COUNT(*) as count FROM service_providers WHERE (Approval = 'PENDING' OR Approval IS NULL OR Approval = '') AND status = 'ACTIVE'");
            $result = $this->db->single();
            $counts[1] = $result->count ?? 0;
            
            // Count rejected service providers
            $this->db->query("SELECT COUNT(*) as count FROM service_providers WHERE Approval = 'REJECTED' AND status = 'ACTIVE'");
            $result = $this->db->single();
            $counts[2] = $result->count ?? 0;
            
            return $counts;
        }

        // Get total income (Clients to system - system to any user)
        public function getTotalIncome(){
            // Get income from clients to system
            $this->db->query("SELECT COALESCE(SUM(total_amount), 0) as total FROM transactions WHERE sender_type = 'client' AND receiver_type = 'system'");
            $clientToSystem = $this->db->single()->total ?? 0;
            
            // Get expenses from system to users (client or service provider)
            $this->db->query("SELECT COALESCE(SUM(total_amount), 0) as total FROM transactions WHERE sender_type = 'system' AND (receiver_type = 'client' OR receiver_type = 'service_provider')");
            $systemToUsers = $this->db->single()->total ?? 0;
            
            // Total income = Income - Expenses
            return $clientToSystem - $systemToUsers;
        }

        // Get total active users (Active clients + Approved active service providers)
        public function getTotalUsers(){
            // Count active clients
            $this->db->query("SELECT COUNT(*) as count FROM clients WHERE status = 'ACTIVE'");
            $activeClients = $this->db->single()->count ?? 0;
            
            // Count approved active service providers
            $this->db->query("SELECT COUNT(*) as count FROM service_providers WHERE status = 'ACTIVE' AND Approval = 'APPROVED'");
            $approvedProviders = $this->db->single()->count ?? 0;
            
            return $activeClients + $approvedProviders;
        }

        // Get total events count
        public function getTotalEvents(){
            $this->db->query("SELECT COUNT(*) as count FROM events");
            return $this->db->single()->count ?? 0;
        }

        // Get approved active service providers count
        public function getApprovedServiceProviders(){
            $this->db->query("SELECT COUNT(*) as count FROM service_providers WHERE status = 'ACTIVE' AND Approval = 'APPROVED'");
            return $this->db->single()->count ?? 0;
        }

        // Get monthly income data for a specific year
        public function getMonthlyIncome($year){
            $monthlyData = [];
            
            for($month = 1; $month <= 12; $month++){
                // Get income from clients to system for this month/year
                $this->db->query("SELECT COALESCE(SUM(total_amount), 0) as total FROM transactions 
                    WHERE sender_type = 'client' AND receiver_type = 'system' 
                    AND YEAR(created_at) = :year AND MONTH(created_at) = :month");
                $this->db->bind(':year', $year);
                $this->db->bind(':month', $month);
                $clientToSystem = $this->db->single()->total ?? 0;
                
                // Get expenses from system to users for this month/year
                $this->db->query("SELECT COALESCE(SUM(total_amount), 0) as total FROM transactions 
                    WHERE sender_type = 'system' AND (receiver_type = 'client' OR receiver_type = 'service_provider')
                    AND YEAR(created_at) = :year AND MONTH(created_at) = :month");
                $this->db->bind(':year', $year);
                $this->db->bind(':month', $month);
                $systemToUsers = $this->db->single()->total ?? 0;
                
                $monthlyData[] = $clientToSystem - $systemToUsers;
            }
            
            return $monthlyData;
        }

        // Get monthly user growth data for a specific year
        public function getMonthlyUserGrowth($year){
            $monthlyClients = [];
            $monthlyProviders = [];
            
            for($month = 1; $month <= 12; $month++){
                // Count active clients created in this specific month
                $this->db->query("SELECT COUNT(*) as count FROM clients 
                    WHERE status = 'ACTIVE' AND YEAR(created_at) = :year AND MONTH(created_at) = :month");
                $this->db->bind(':year', $year);
                $this->db->bind(':month', $month);
                $activeClients = $this->db->single()->count ?? 0;
                $monthlyClients[] = $activeClients;
                
                // Count approved active service providers created in this specific month
                $this->db->query("SELECT COUNT(*) as count FROM service_providers 
                    WHERE status = 'ACTIVE' AND Approval = 'APPROVED' AND YEAR(created_at) = :year AND MONTH(created_at) = :month");
                $this->db->bind(':year', $year);
                $this->db->bind(':month', $month);
                $approvedProviders = $this->db->single()->count ?? 0;
                $monthlyProviders[] = $approvedProviders;
            }
            
            return [
                'clients' => $monthlyClients,
                'providers' => $monthlyProviders
            ];
        }

        // Get all monthly income data for all years (2022-2026)
        public function getAllMonthlyIncomeData(){
            $data = [];
            for($year = 2022; $year <= 2026; $year++){
                $data[$year] = $this->getMonthlyIncome($year);
            }
            return $data;
        }

        // Get all monthly user growth data for all years (2022-2026)
        public function getAllMonthlyUserGrowthData(){
            $data = [];
            for($year = 2022; $year <= 2026; $year++){
                $data[$year] = $this->getMonthlyUserGrowth($year);
            }
            return $data;
        }
    }