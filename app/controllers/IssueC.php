<?php
class IssueC extends Controller{

        private $clientModel;

        private $packageModel;

        private $profileModel;

        private $ratingModel;

        private $availabilityModel;

        private $postModel;

        private $messageModel;

        private $eventModel;

        private $notificationModel;

        private $complaintModel;

        private $paymentModel;

        private $issueModel;

        private $replacementModel;

        public function __construct(){

            $this->clientModel = $this->model('M_Client');
            $this->packageModel = $this->model('M_package');
            $this->profileModel = $this->model('M_ServicsProfile');
            $this->ratingModel = $this->model('M_ratings');
            $this->availabilityModel = $this->model('M_Availability');
            $this->postModel = $this->model('M_Posts');
            $this->messageModel = $this->model('M_Message');
            $this->eventModel = $this->model('M_Event');
            $this->notificationModel = $this->model('M_notification');
            $this->complaintModel = $this->model('M_Complaints');
            $this->paymentModel = $this->model('M_Payment');
            $this->issueModel = $this->model('M_IssueC');
            $this->replacementModel = $this->model('M_Replacement');


        }

    
    public function coordinator_login(){
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Form submitting
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'ic_email' => trim($_POST['ic_email']),
          'ic_password' => trim($_POST['ic_password']),

          'ic_email_err' => '',
          'ic_password_err' => ''
        ];

        // Validate email
        if(empty($data['ic_email'])){
          $data['ic_email_err'] = 'Please enter your email';
        } else {
          if($this->issueModel->findCoordinatorByEmail($data['ic_email'])) {
              // User found
          } else {
            $data['ic_email_err'] = 'Email is Incorrect';
          }
        }
        

        // Validate password
        if(empty($data['ic_password'])) {
          $data['ic_password_err'] = 'Please enter your password';
        } 

        if(empty($data['ic_email_err']) && empty($data['ic_password_err'])) {
          // Log the admin
          // $loggedInAdmin = $this->adminModel->adminLogin($data['a_email'], $data['a_password']);
          $loggedInIssueC = $this->issueModel->CoordinatorLogin($data['ic_email'], $data['ic_password']);

          if ($loggedInIssueC) {
            // Create Session

            $this->createCoordinatorSession($loggedInIssueC);
            
          } else {
            $data['ic_password_err'] = 'Password is incorrect';
            $this->view('issue/v_ic_login', $data);
          }
        } else {
          // Load view with errors
          $this->view('issue/v_ic_login', $data);
        }

      
      } else {
        // Intial Form
        $data = [
          'ic_email' => '',
          'ic_password' => '',

          'ic_email_err' => '',
          'ic_password_err' => ''
        ];

        // Load view
        $this->view('issue/v_ic_login', $data);
      }

    }


    public function createCoordinatorSession($coordinator){
        $_SESSION['ic_id'] = $coordinator->ic_id;
        $_SESSION['ic_name'] = $coordinator->ic_name;
        $_SESSION['ic_email'] = $coordinator->ic_email;
        redirect('IssueC/dashboard');
    }
    
        public function dashboard(){

            $Ic_id = $_SESSION['ic_id'];

            $totalevents = $this->issueModel->getTotalEvent($Ic_id);
            $totalIssues = $this->issueModel->getTotalIssues($Ic_id);
            $totalComplaints = $this->issueModel->getTotalComplaints($Ic_id);
            $pendingReplacements = $this->replacementModel->getPendingReplacements();
            $totalRefunds = $this->eventModel->getResolvedRefunds();

            $pendingCount = is_array($pendingReplacements) ? count($pendingReplacements) : 0;
            $refundCount = is_array($totalRefunds) ? count($totalRefunds) : 0;

            $data = [
                'totalevents' => $totalevents,
                'totalIssues' => $totalIssues,
                'totalComplaints' => $totalComplaints,
                'pending' => $pendingCount,
                'totalRefunds' => $refundCount
            ];
            $this->view('issue/v_dashboard', $data);
        }

        public function eventswithissues(){
                
                $this->view('issue/v_eventswithissues');
                
            }
        public function issueInvestigation(){
                
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    // Process service creation
                    $data=[
                        'issue_type' => trim($_POST['issue_type']),//varchar
                        'refund' => trim($_POST['refund']), //varchar
                        'notes' =>trim($_POST['notes']),
                        'replace_item' =>trim($_POST['replace_item']),
                        'cost' => trim($_POST['cost']), //decimal
                        'v_response' => trim($_POST['v_response']),
                        'priority' => trim($_POST['priority']),
                        'a_note' => trim($_POST['a_note']),

                        //error fields
                        
                        'refund_err' => '',
                        'notes_err' => '',
                        'cost_err' =>''
                    ];

                    //validation refund
                    if(empty($data['refund'])){
                        $data['refund_err'] = 'Please select an option';
                    }
                    

                    //validation notes
                    if(empty($data['notes'])){
                        $data['notes_err'] = 'Please enter notes';
                    }

                    //validation cost
                    if(empty($data['cost'])){
                        $data['cost_err'] = 'Please enter cost';
                    }

                    if(empty($data['refund_err']) && empty($data['notes_err']) && empty($data['cost_err'])){
                        
                        //create issue investigation
                        if($this->issueModel->createIssueInvestigation($data)){
                            flash('issue_message', 'Issue Investigation Created');
                            redirect('IssueC/v_adminreports');
                        }
                    } else {
                        $this->view('issue/v_eventsdetails', $data);
                    }
                }
                else {

                    $data = [
                        'issue_type' => '',
                        'refund' => '',
                        'notes' => '',
                        'replace_item' => '',
                        'cost' => '',
                        'v_response' => '',
                        'priority' => '',
                        'a_note' => '',
                        //error fields
                        'refund_err' => '',
                        'notes_err' => '',
                        'cost_err' =>''
                    ];
                    

                    $this->view('issue/v_eventsdetails', $data);
                }

                
                
        }    
        public function issuecprofile(){
                
                $this->view('issue/v_issuecprofile');
                
        }

        public function v_replacementslist(){
                
                $this->view('issue/v_replacementslist');
                
            }

        public function v_refund(){
                
                $this->view('issue/v_refund');

    }
        public function v_adminreports(){
                
            $issueReports = $this->issueModel->getIssueReports();
            
            $data = [
                'issueReports' => $issueReports
            ];

            $this->view('issue/v_adminreports', $data);
                

        }

        public function editReport($id){
                
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    // Process service report update
                $data=[

                    'id' => $id,
                    'issue_type' => trim($_POST['issue_type']),
                    'refund' => trim($_POST['refund']),
                    'notes' => trim($_POST['notes']),
                    'replace_item' => trim($_POST['replace_item']),
                    'cost' => trim($_POST['cost']),
                    'v_response' => trim($_POST['v_response']),
                    'priority' => trim($_POST['priority']),
                    'a_note' => trim($_POST['a_note']),

                    //error fields
                    'refund_err' => '',
                    'notes_err' => '',
                    'cost_err' =>''
                ];

                //validation refund
                    if(empty($data['refund'])){
                        $data['refund_err'] = 'Please select an option';
                    }
                    

                    //validation notes
                    if(empty($data['notes'])){
                        $data['notes_err'] = 'Please enter notes';
                    }

                    //validation cost
                    if(empty($data['cost'])){
                        $data['cost_err'] = 'Please enter cost';
                    }

                    if(empty($data['refund_err']) && empty($data['notes_err']) && empty($data['cost_err'])){
                        
                        //create issue investigation
                        if($this->issueModel->editIssueReport($data)){
                            flash('issue_message', 'Issue Investigation Created');
                            redirect('IssueC/v_adminreports');
                        }
                    } else {
                        $this->view('issue/v_eventsdetails', $data);
                    }
                    
                    redirect('IssueC/v_adminreports');
            }else{
            
                $issueReports = $this->issueModel->getIssueReportById($id);
                
                $data = [
                    'id' => $issueReports->id,
                    'issue_type' => $issueReports->issue_type,
                    'refund' => $issueReports->refund,
                    'notes' => $issueReports->notes,
                    'replace_item' => $issueReports->replace_item,
                    'cost' => $issueReports->cost,
                    'v_response' => $issueReports->v_response,
                    'priority' => $issueReports->priority,
                    'a_note' => $issueReports->a_note,

                    //error fields
                    'refund_err' => '',
                    'notes_err' => '',
                    'cost_err' =>''
                ];

                $this->view('issue/issueReport/v_editreport', $data);
                    
            }
        }


        public function deleteIssueReport($id){
            $issueReports = $this->issueModel->getIssueReportById($id);
            if($this->issueModel->deleteIssueReport($id)){
                flash('issue_message', 'Issue Report Deleted');
                redirect('IssueC/v_adminreports');
            }else{
                die("Something went wrong");
            }
        }


        public function reports(){

            $Ic_id = $_SESSION['ic_id'];

            $totalevents = $this->issueModel->getTotalEvent($Ic_id);
            $totalIssues = $this->issueModel->getTotalIssues($Ic_id);
            $totalComplaints = $this->issueModel->getTotalComplaints($Ic_id);
           // $totalRefunds = $this->issueModel->getTotalRefunds($Ic_id);

            $data = [
                'totalevents' => $totalevents,
                'totalIssues' => $totalIssues,
                'totalComplaints' => $totalComplaints,
               // 'totalRefunds' => $totalRefunds
            ];
            $this->view('issue/reports', $data);
        }

        public function payments(){
            $this->view('issue/v_refund');
        }

        public function complaints(){
            $this->view('issue/v_complaints');
        }

        public function messages(){
            $this->view('issue/messages');
        }

        public function events(){
            $this->view('issue/v_events');
        }

        public function getEventsWithIssues(){
            // Set JSON header
            header('Content-Type: application/json');
            
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $ic_id = isset($_SESSION['ic_id']) ? (int)$_SESSION['ic_id'] : 0;
                
                if(!$ic_id) {
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => 'Unauthorized - No session IC ID']);
                    return;
                }

                try {
                    $eventModel = $this->model('M_Event');
                    $events = $eventModel->getEventsWithIssuesByIC($ic_id);
                    
                    // Enrich events with provider and conflict data
                    foreach($events as &$event) {
                        $packageData = $eventModel->getEventDetailWithProviders($event->event_id);
                        
                        // Extract packages and providers from package data
                        $event->packages = [];
                        $event->providers = [];
                        
                        if ($packageData) {
                            $providerMap = [];
                            foreach($packageData as $pkg) {
                                // Add package
                                $event->packages[] = (object)[
                                    'name' => $pkg->package_name,
                                    'cost' => $pkg->price,
                                    'items' => $pkg->details,
                                    'confirmation_status' => $pkg->confirmation_status
                                ];
                                
                                // Collect unique providers
                                $providerKey = $pkg->service_id . '_' . $pkg->provider_name;
                                if (!isset($providerMap[$providerKey])) {
                                    $providerMap[$providerKey] = (object)[
                                        'id' => $pkg->service_id,
                                        'name' => $pkg->provider_name,
                                        'role' => $pkg->serviceType,
                                        'confirmation' => $pkg->confirmation_status
                                    ];
                                }
                            }
                            $event->providers = array_values($providerMap);
                        }
                        
                        $event->conflicts = $eventModel->getEventConflicts($event->event_id, $ic_id);
                        $event->timeline = $eventModel->getEventTimeline($event->event_id);
                    }

                    echo json_encode(['success' => true, 'data' => $events]);
                } catch (Exception $e) {
                    http_response_code(500);
                    echo json_encode(['success' => false, 'error' => 'Server Error: ' . $e->getMessage()]);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            }
        }
    
        public function replacement(){
            $this->view('issue/v_replacementslist');
        }

        public function myaccount(){
            $this->view('issue/myaccount');
        }
        



    public function chats(){
        $this->view('issue/v_chat_issue');
    }

    public function getCoordinatorConversations(){
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
            return;
        }

        // Check if coordinator is logged in
        if (!isset($_SESSION['ic_id'])) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Coordinator not authenticated']);
            return;
        }

        try {
            $ic_id = $_SESSION['ic_id'];
            
            // Get client conversations separately
            $clientConversations = $this->messageModel->getCoordinatorClientConversations($ic_id);
            
            // Get provider conversations separately
            $providerConversations = $this->messageModel->getCoordinatorProviderConversations($ic_id);
            
            $response = [
                'status' => 'success',
                'data' => [
                    'clients' => $clientConversations,
                    'providers' => $providerConversations
                ]
            ];
            
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function checkOrCreateConversation(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['client_id'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'client_id is required']);
            return;
        }

        // Check if coordinator is logged in
        if (!isset($_SESSION['ic_id'])) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Coordinator not authenticated']);
            return;
        }

        $ic_id = $_SESSION['ic_id'];
        $client_id = intval($input['client_id']);

        try {
            // Check or create coordinator conversation with client
            $conversation = $this->messageModel->checkOrCreateCoordinatorConversation($ic_id, 'CLIENT', $client_id);

            if ($conversation) {
                echo json_encode(['status' => 'success', 'conversation_id' => $conversation->conversation_id]);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Failed to create conversation']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function notifications(){
        $ic_id = $_SESSION['ic_id'];
        
        // Get notifications and stats for issue coordinator
        $notifications = $this->notificationModel->getIssueCoordinatorNotifications($ic_id);
        $stats = $this->notificationModel->getIssueCoordinatorNotificationStats($ic_id);
        
        $data = [
            'notifications' => $notifications,
            'stats' => $stats
        ];
        
        $this->view('issue/v_notifications', $data);
    }

    public function getServiceProviderComplaints(){

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $complaints = $this->complaintModel->getAllServiceProviderComplaints();
            echo json_encode(['success' => true, 'data' => $complaints]);
            
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    
    public function getClientComplaints(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $complaints = $this->complaintModel->getAllClientComplaints();
            echo json_encode(['success' => true, 'data' => $complaints]);
            
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    public function updateProviderComplaintStatus(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid request']);
                return;
            }
            
            $data = [
                'complaint_id' => isset($input['complaint_id']) ? intval($input['complaint_id']) : null,
                'status' => isset($input['status']) ? $input['status'] : null,
                'resolution_type' => isset($input['resolution_type']) ? $input['resolution_type'] : null,
                'resolution_note' => isset($input['resolution_note']) ? $input['resolution_note'] : null,
                'assigned_ic_id' => isset($input['assigned_ic_id']) ? intval($input['assigned_ic_id']) : null
            ];
            
            if (!$data['complaint_id'] || !$data['status']) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                return;
            }
            
            if($this->complaintModel->updateComplaint($data)){
                echo json_encode(['success' => true, 'message' => 'Complaint updated successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Failed to update complaint']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    public function updateClientComplaintStatus(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid request']);
                return;
            }
            
            $data = [
                'complaint_id' => isset($input['complaint_id']) ? intval($input['complaint_id']) : null,
                'status' => isset($input['status']) ? $input['status'] : null,
                'resolution_type' => isset($input['resolution_type']) ? $input['resolution_type'] : null,
                'resolution_note' => isset($input['resolution_note']) ? $input['resolution_note'] : null,
                'assigned_ic_id' => isset($input['assigned_ic_id']) ? intval($input['assigned_ic_id']) : null
            ];
            
            if (!$data['complaint_id'] || !$data['status']) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                return;
            }
            
            if($this->complaintModel->updateClientComplaint($data)){
                echo json_encode(['success' => true, 'message' => 'Complaint updated successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Failed to update complaint']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    public function getPendingReplacements(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $pendingReplacements = $this->replacementModel->getPendingReplacements();
            echo json_encode(['success' => true, 'data' => $pendingReplacements]);
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    public function getReplacementHistory(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $replacementHistory = $this->replacementModel->getReplacementHistory();
            echo json_encode(['success' => true, 'data' => $replacementHistory]);
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    public function removeProviderPackage(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $event_id = isset($_POST['event_id']) ? (int)$_POST['event_id'] : 0;
            $service_id = isset($_POST['service_id']) ? (int)$_POST['service_id'] : 0;
            $replacement_id = isset($_POST['replacement_id']) ? (int)$_POST['replacement_id'] : 0;

            if($event_id && $service_id && $replacement_id) {
               
                $removed = $this->replacementModel->removeProviderPackage($event_id, $service_id);
                
                if($removed) {
                    // Also update replacement status to indicate package was removed
                    $this->replacementModel->updateReplacementStatus($replacement_id, 'REMOVED');
                    echo json_encode(['success' => true, 'message' => 'Provider package removed successfully']);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to remove provider package']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing required parameters']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    public function getPackagesByServiceType(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $serviceType = isset($_GET['serviceType']) ? trim($_GET['serviceType']) : '';
            $excludeServiceId = isset($_GET['excludeServiceId']) ? (int)$_GET['excludeServiceId'] : null;

            if (!$serviceType) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Service type is required']);
                return;
            }

            $packages = $this->replacementModel->getPackagesByServiceType($serviceType, $excludeServiceId);
            echo json_encode(['success' => true, 'data' => $packages]);
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    public function assignProviderPackageToEvent(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $replacement_id = isset($_POST['replacement_id']) ? (int)$_POST['replacement_id'] : 0;
            $event_id = isset($_POST['event_id']) ? (int)$_POST['event_id'] : 0;
            $package_id = isset($_POST['package_id']) ? (int)$_POST['package_id'] : 0;
            $new_service_id = isset($_POST['new_service_id']) ? (int)$_POST['new_service_id'] : 0;
            $client_id = isset($_POST['client_id']) ? (int)$_POST['client_id'] : 0;

            if($replacement_id && $event_id && $package_id && $new_service_id && $client_id) {
                $assigned = $this->replacementModel->assignProviderPackageToEvent($replacement_id, $event_id, $package_id, $new_service_id, $client_id);
                
                if($assigned) {
                    echo json_encode(['success' => true, 'message' => 'Package assigned successfully']);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to assign package']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing required parameters']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    public function getReplacementData(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
           
                $input = json_decode(file_get_contents('php://input'), true);
                if (!$input) {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Invalid request']);
                    return;
                }

                $data = [
                    'issue_id' => isset($input['issue_id']) ? intval($input['issue_id']) : null
                ];
                
                if (!$data['issue_id']) {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing Issue ID']);
                    return;
                }
                
                $replacementData = $this->replacementModel->getReplacementDataByIssueId($data['issue_id']);
                echo json_encode(['success' => true, 'data' => $replacementData]);
                
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
    }
    }

    public function getSolvedComplaints(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get the JSON data from the request body
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid request']);
                return;
            }
            
            $data = [
                'ic_id' => isset($input['ic_id']) ? intval($input['ic_id']) : null
            ];
            
            if (!$data['ic_id']) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing IC ID']);
                return;
            }
            
            $complaints = $this->complaintModel->getSolvedComplaintsByIcId($data['ic_id']);
            echo json_encode(['success' => true, 'data' => $complaints]);
            
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    public function getSolvedClientComplaints(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get the JSON data from the request body
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid request']);
                return;
            }
            
            $data = [
                'ic_id' => isset($input['ic_id']) ? intval($input['ic_id']) : null
            ];
            
            if (!$data['ic_id']) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing IC ID']);
                return;
            }
            
            $complaints = $this->complaintModel->getSolvedClientComplaintsByIcId($data['ic_id']);
            echo json_encode(['success' => true, 'data' => $complaints]);
            
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
        }
    }

    

    // Refund Management Endpoints
    public function getPendingRefunds() {
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }

        $refunds = $this->eventModel->getCancelledEventsPendingRefund();
        echo json_encode(['success' => true, 'data' => $refunds]);
    }

    public function processRefund() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || !isset($input['event_id']) || !isset($input['refund_decision']) || !isset($input['refund_amount'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing required fields']);
            return;
        }

        $eventId = intval($input['event_id']);
        $decision = $input['refund_decision']; // 'REFUNDED' or 'REJECTED'
        $refundAmount = floatval($input['refund_amount']);
        $rejectReason = isset($input['reject_reason']) ? $input['reject_reason'] : null;

        try {
            if ($decision === 'REFUNDED') {
                // Process the refund in transactions table
                if($this->paymentModel->processRefund($eventId, $refundAmount)) {
                    // Update event refund status
                    $this->eventModel->updateRefundStatus($eventId, 'REFUNDED', $refundAmount);
                    echo json_encode(['success' => true, 'message' => 'Refund processed successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['success' => false, 'error' => 'Failed to process refund']);
                }
            } elseif ($decision === 'REJECTED') {
                // Update event refund status to rejected
                $this->eventModel->updateRefundStatus($eventId, 'REJECTED', null, $rejectReason);
                echo json_encode(['success' => true, 'message' => 'Refund request rejected']);
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid refund decision']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
        }
    }

    public function getResolvedRefunds() {
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }

        $refunds = $this->eventModel->getResolvedRefunds();
        echo json_encode(['success' => true, 'data' => $refunds]);
    }

    public function viewprovider($id){

            $profile = $this->profileModel->getProfileById($id);
            $profileV = $this->profileModel->getProfileByServiceId($id);
            $rating = $this->ratingModel->getRatingsSummary($id);
            $availability = $this->availabilityModel->getAvailabilityByServiceProvider($id);
            $EventsPosts = $this->postModel->getEventPostsByServiceProvider($id);
            $EventMedia = $this->postModel->getMediaByServiceId($id);
            $data = [

                'profile' => $profile,
                'rating' => $rating,
                'availability' => $availability,
                'EventsPosts' => $EventsPosts,
                'EventMedia' => $EventMedia,
                'profileV' => $profileV

            ];
            $this->view('issue/providerProfile/serviceProviderprofile', $data);
        }







    public function sendReport(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || !isset($input['coordinator_name'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing required fields']);
            return;
        }

        // Check if coordinator is logged in
        if (!isset($_SESSION['ic_id'])) {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Coordinator not authenticated']);
            return;
        }

        try {
            $reportData = [
                'ic_id' => $_SESSION['ic_id'],
                'coordinator_name' => $input['coordinator_name'],
                'report_period' => isset($input['report_period']) ? $input['report_period'] : 'Weekly Report',
                'content' => isset($input['content']) ? $input['content'] : '',
                'submission_date' => isset($input['submission_date']) ? $input['submission_date'] : date('Y-m-d H:i:s')
            ];

            // Return success response
            echo json_encode([
                'success' => true,
                'message' => 'Report submitted successfully',
                'submission_id' => 'REP-' . date('Ymd-His'),
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function getCoordinatorData(){
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        // Check if coordinator is logged in
        if (!isset($_SESSION['ic_id'])) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Not authenticated']);
            return;
        }

        try {
            $ic_id = $_SESSION['ic_id'];
            $coordinator = $this->issueModel->getCoordinatorById($ic_id);
            
            if ($coordinator) {
                echo json_encode(['success' => true, 'data' => $coordinator]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Coordinator not found']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error fetching coordinator data']);
        }
    }

    public function updatePersonalInfo(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        // Check if coordinator is logged in
        if (!isset($_SESSION['ic_id'])) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Not authenticated']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
            return;
        }

        $ic_id = $_SESSION['ic_id'];
        $ic_name = isset($input['ic_name']) ? trim($input['ic_name']) : '';
        $ic_email = isset($input['ic_email']) ? trim($input['ic_email']) : '';
        $ic_phone = isset($input['ic_phone']) ? trim($input['ic_phone']) : '';

        // Validate inputs
        if (empty($ic_name) || empty($ic_email) || empty($ic_phone)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'All fields are required']);
            return;
        }

        // Validate email format
        if (!filter_var($ic_email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid email format']);
            return;
        }

        // Update coordinator info
        if ($this->issueModel->updateCoordinatorInfo($ic_id, $ic_name, $ic_email, $ic_phone)) {
            // Update session
            $_SESSION['ic_name'] = $ic_name;
            $_SESSION['ic_email'] = $ic_email;
            
            echo json_encode(['success' => true, 'message' => 'Personal information updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update information']);
        }
    }

    public function updatePassword(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        // Check if coordinator is logged in
        if (!isset($_SESSION['ic_id'])) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Not authenticated']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
            return;
        }

        $ic_id = $_SESSION['ic_id'];
        $currentPassword = isset($input['currentPassword']) ? $input['currentPassword'] : '';
        $newPassword = isset($input['newPassword']) ? $input['newPassword'] : '';

        // Validate inputs
        if (empty($currentPassword) || empty($newPassword)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'All fields are required']);
            return;
        }

        // Verify current password
        if (!$this->issueModel->verifyCoordinatorPassword($ic_id, $currentPassword)) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
            return;
        }

        // Validate new password strength (at least 8 chars, 1 uppercase, 1 lowercase, 1 number)
        if (strlen($newPassword) < 8) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters']);
            return;
        }

        if (!preg_match('/[A-Z]/', $newPassword)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Password must contain at least one uppercase letter']);
            return;
        }

        if (!preg_match('/[a-z]/', $newPassword)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Password must contain at least one lowercase letter']);
            return;
        }

        if (!preg_match('/[0-9]/', $newPassword)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Password must contain at least one number']);
            return;
        }

        // Update password
        if ($this->issueModel->updateCoordinatorPassword($ic_id, $newPassword)) {
            echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update password']);
        }
    }

    public function apiDashboardMetrics(){
        if (ob_get_level()) ob_end_clean();
        
        if (!isset($_SESSION['ic_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Not authenticated']);
            exit;
        }
        header('Content-Type: application/json');
        $start = isset($_GET['start']) ? $_GET['start'] : null;
        $end = isset($_GET['end']) ? $_GET['end'] : null;
        
        try {
            $metrics = $this->complaintModel->getDashboardMetrics($start, $end);
            echo json_encode(['success' => true, 'data' => $metrics]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

    public function apiIssuesTrend(){
        if (ob_get_level()) ob_end_clean();
        header('Content-Type: application/json');
        $months = isset($_GET['months']) ? intval($_GET['months']) : 6;
        
        try {
            $trend = $this->complaintModel->getIssuesRaisedVsResolvedCombined($months);
            echo json_encode(['success' => true, 'data' => $trend]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

    public function apiIssuesByCategory(){
        if (ob_get_level()) ob_end_clean();
        header('Content-Type: application/json');
        $start = isset($_GET['start']) ? $_GET['start'] : null;
        $end = isset($_GET['end']) ? $_GET['end'] : null;
        
        try {
            $category = $this->complaintModel->getIssuesByCategoryCombined($start, $end);
            echo json_encode(['success' => true, 'data' => $category]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

    public function apiComplaintStatus(){
        if (ob_get_level()) ob_end_clean();
        header('Content-Type: application/json');
        $start = isset($_GET['start']) ? $_GET['start'] : null;
        $end = isset($_GET['end']) ? $_GET['end'] : null;
        
        try {
            $status = $this->complaintModel->getComplaintStatusBreakdownCombined($start, $end);
            echo json_encode(['success' => true, 'data' => $status]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

    public function apiTopProviders(){
        if (ob_get_level()) ob_end_clean();
        header('Content-Type: application/json');
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
        
        try {
            $top = $this->complaintModel->getTopProvidersByComplaints($limit);
            echo json_encode(['success' => true, 'data' => $top]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

    public function getUnreadNotificationCount(){
        if (!isset($_SESSION['ic_id'])) {
            echo json_encode(['success' => false, 'error' => 'Not authenticated']);
            return;
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $unreadNotifications = $this->notificationModel->getIssueCoordinatorUnreadNotifications($_SESSION['ic_id']);
            $unreadCount = count($unreadNotifications);
            echo json_encode(['unreadCount' => $unreadCount, 'success' => true]);
        }
    }

    public function logout(){
        session_unset();
        session_destroy();
        redirect('Evo/evoplan');
    }
}
