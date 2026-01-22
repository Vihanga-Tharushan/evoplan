<?php
class IssueC extends Controller{

    private $issueModel;
    public function __construct(){
       
        $this->issueModel = $this->model('M_IssueC');
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

    public function complains(){
        $this->view('issue/v_complains');
    }

    public function messages(){
        $this->view('issue/messages');
    }

    public function events(){
        $this->view('issue/v_eventswithissues');}
   
    public function replacement(){
        $this->view('issue/v_replacementslist');
    }
    



public function chats(){
    $this->view('issue/v_chat_issue');
}

public function notifications(){
    $this->view('issue/v_notifications');
}




 
}
?>