<?php
    class Cards extends Controller{
        private $cardModel;
        private $user_id = "ABCD-0010111"; // Example user ID
        public function __construct(){
            $this->cardModel = $this->model('M_Cards');
        }

        public function payments(){
            $methods = $this->cardModel->getMethodsById($this->user_id);
        // Pass to view
        $data = ['methods' => $methods];
            $this->view('clients/v_payments', $data);
        }
        public function addmethod(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
               $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $data = [
                    'holder_id' => $this->user_id,
                    'card_name' => trim($_POST['card_name']),
                    'card_number' => trim($_POST['card_number']),
                    'expiry_date' => trim($_POST['expiry_date']),
                    'cvv' => trim($_POST['cvv']),
                    'card_name_err' => '',
                    'card_number_err' => '',
                    'expiry_date_err' => '',
                    'cvv_err' => '',
                ];

                $raw = $data['expiry_date']; // e.g., "06/2027" or "06/27"

            $dt = DateTime::createFromFormat('m/Y', $raw) ?: DateTime::createFromFormat('m/y', $raw);

            if ($dt === false) {
                $data['expiry_date_err'] = 'Invalid expiry date format (use MM/YYYY).';
            } else {
                $normalized = $dt->format('Y-m-01'); // "2027-06-01"
                $data['expiry_date'] = $normalized;  // ✅ Update data
            }

                

                if(empty($data['card_name'])){
                    $data['card_name_err'] = 'Please enter card name';
                }

                if(empty($data['card_number'])){
                    $data['card_number_err'] = 'Please enter card number';
                }

                if(empty($data['expiry_date'])){
                    $data['expiry_date_err'] = 'Please enter expiry date';
                }

                if(empty($data['cvv'])){
                    $data['cvv_err'] = 'Please enter CVV';
                }

                if (empty($data['expiry_date_err'])) {

                if ($this->cardModel->addMethod($data)) {
                    redirect('Cards/payments');
                } else {
                    die('Something went wrong.');
                }
            } else {
                // reload form with errors
                $this->view('clients/v_addmethod', $data);
            }
                if(empty($data['card_name_err']) && empty($data['card_number_err']) && empty($data['expiry_date_err']) && empty($data['cvv_err'])){
                    if($this->cardModel->addMethod($data)){
                       flash('method_message', 'Payment method added successfully');
                       redirect('Pages/about');
                    } else {
                        die('Something went wrong');
                }
            }
                else {
                    $this->view('clients/v_addmethod', $data);
                }
            } else {
                $data = [
                    'card_name' => '',
                    'card_number' => '',
                    'expiry_date' => '',
                    'cvv' => '',
                    'card_name_err' => '',
                    'card_number_err' => '',
                    'expiry_date_err' => '',
                    'cvv_err' => '',
                ];
                $this->view('clients/v_addmethod', $data);
            }

            
        }
        public function addmethodup(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                $this->cardModel->updateMethod($_POST);
                redirect('Cards/payments');
            }
            else{
                // Load the addmethodup view
                $methods = $this->cardModel->getMethodsByCardNumber($_GET['cid']);
                // Pass to view
                $data = ['methods' => $methods];
                $this->view('Clients/v_addmethodup', $data);
            }
        }

        public function removeMethod(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                // Process form data
                $this->cardModel->deleteMethod($_GET['cid']);
                redirect('Cards/payments');
            }
        }


        
    }

?>