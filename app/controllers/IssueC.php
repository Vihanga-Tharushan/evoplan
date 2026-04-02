<?php
class IssueC extends Controller{

    private $issueModel;
    private $complaintModel;
    public function __construct(){
       
        $this->issueModel = $this->model('M_IssueC');
        $this->complaintModel = $this->model('M_Complaints');
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

            $this->view('issue/v_dashboard');
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
            $this->view('issue/reports');
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
            $this->view('issue/v_events');}
    
        public function replacement(){
            $this->view('issue/v_replacementslist');
        }

        public function myaccount(){
            $this->view('issue/myaccount');
        }
        



    public function chats(){
        $this->view('issue/v_chat_issue');
    }

    public function notifications(){
        $this->view('issue/v_notifications');
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

    public function updateComplaintStatus(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get the JSON data from the request body
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid request']);
                return;
            }
            
            $data = [
                'complaint_id' => isset($input['complaint_id']) ? intval($input['complaint_id']) : null,
                'status' => isset($input['status']) ? $input['status'] : null,
                'priority' => isset($input['priority']) ? $input['priority'] : null,
                'resolution_type' => isset($input['resolution_type']) ? $input['resolution_type'] : null,
                'resolution_note' => isset($input['resolution_note']) ? $input['resolution_note'] : null,
                'assigned_ic_id' => isset($input['assigned_ic_id']) ? intval($input['assigned_ic_id']) : null
            ];
            
            // Validation
            if (!$data['complaint_id'] || !$data['status'] || !$data['priority']) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                return;
            }
            
            // Update the complaint
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

    // --- API endpoints for dashboard analytics ---
    public function apiDashboardMetrics() {
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }

        $start = isset($_GET['start']) ? $_GET['start'] . ' 00:00:00' : null;
        $end = isset($_GET['end']) ? $_GET['end'] . ' 23:59:59' : null;

        $metrics = $this->complaintModel->getDashboardMetrics($start, $end);
        echo json_encode(['success' => true, 'data' => $metrics]);
    }

    public function apiIssuesTrend() {
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }
        $months = isset($_GET['months']) ? intval($_GET['months']) : 6;
        $data = $this->complaintModel->getIssuesRaisedVsResolvedLastMonths($months);
        echo json_encode(['success' => true, 'data' => $data]);
    }

    public function apiIssuesByCategory() {
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }
        $start = isset($_GET['start']) ? $_GET['start'] . ' 00:00:00' : null;
        $end = isset($_GET['end']) ? $_GET['end'] . ' 23:59:59' : null;
        $data = $this->complaintModel->getIssuesByCategory($start, $end);
        echo json_encode(['success' => true, 'data' => $data]);
    }

    public function apiComplaintStatus() {
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }
        $start = isset($_GET['start']) ? $_GET['start'] . ' 00:00:00' : null;
        $end = isset($_GET['end']) ? $_GET['end'] . ' 23:59:59' : null;
        $data = $this->complaintModel->getComplaintStatusBreakdown($start, $end);
        echo json_encode(['success' => true, 'data' => $data]);
    }

    public function apiResolutionTimeTrend() {
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }
        $months = isset($_GET['months']) ? intval($_GET['months']) : 6;
        $data = $this->complaintModel->getAvgResolutionTimeTrend($months);
        echo json_encode(['success' => true, 'data' => $data]);
    }

    public function apiReplacementTrend() {
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }
        $months = isset($_GET['months']) ? intval($_GET['months']) : 6;
        $data = $this->complaintModel->getReplacementRequestsTrend($months);
        echo json_encode(['success' => true, 'data' => $data]);
    }

    public function apiTopProviders() {
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
        $data = $this->complaintModel->getTopProvidersByComplaints($limit);
        echo json_encode(['success' => true, 'data' => $data]);
    }







}
?>