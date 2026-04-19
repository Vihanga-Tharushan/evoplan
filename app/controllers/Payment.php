<?php

   class Payment extends Controller {

        private $paymentModel;
        private $eventModel;
        
        public function __construct() {
            $this->paymentModel = $this->model('M_Payment');
            $this->eventModel = $this->model('M_Event');
        }

        public function successClientToSytem() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get JSON input
                $inputData = json_decode(file_get_contents('php://input'), true);
                
                // Validate required fields
                if(!isset($inputData['event_id']) || !isset($inputData['client_id']) || !isset($inputData['total_amount'])) {
                    echo json_encode(['success' => false, 'message' => 'Missing required payment data']);
                    return;
                }
                
                $data = [
                    'event_id' => $inputData['event_id'],
                    'sender_id' => $inputData['client_id'],
                    'sender_type' => 'CLIENT',
                    'receiver_id' => 1,
                    'receiver_type' => 'SYSTEM',
                    'total_amount' => $inputData['total_amount'],
                    'payment_method' => $inputData['payment_method'] ?? 'CARD',
                    'payment_status' => $inputData['payment_status'] ?? 'PAID',
                    'gateway_reference' => $inputData['gateway_reference'] ?? 'PayHere_' . time(),
                    'paid_at' => $inputData['paid_at'] ?? date('Y-m-d H:i:s')
                ];

                if($this->paymentModel->makePayment($data)) {

                    $eventpin = $this->generateEventpin($data['event_id']);
                    // Update event status to paid
                    $this->eventModel->updateEventPaymentStatus($data['event_id'], 'STEP_3_PAYMENT', $eventpin, $totalAmount = $data['total_amount']);
                
                    
                    echo json_encode(['success' => true, 'message' => 'Payment recorded successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to record payment in database']);
                }
            } else {
                // If not POST request, show error page
                $this->view('clients/payment/payment_error');
            }
        }

        public function generateEventpin($eventId) {
            $eventId = (int)$eventId;
            $numeric = hexdec(substr(hash('sha256', 'EVOPLAN_PIN_' . $eventId), 0, 8)) % 1000000;
            return str_pad((string)$numeric, 6, '0', STR_PAD_LEFT);
        }

        public function successPage($eventId) {
            $data = [
                'event_id' => $eventId
            ];


            $this->view('clients/payment/payment_success', $data);
        }

        public function errorPage() {
            $this->view('clients/payment/payment_error');
        }

        public function notify() {
            // PayHere IPN Handler
            $merchant_id = $_POST['merchant_id'] ?? '';
            $order_id = $_POST['order_id'] ?? '';
            $payhere_amount = $_POST['payhere_amount'] ?? '';
            $payhere_currency = $_POST['payhere_currency'] ?? '';
            $status_code = $_POST['status_code'] ?? '';
            $md5sig = $_POST['md5sig'] ?? '';
            
            // Load config
            $config = require_once APPROOT . '/config/payhere.php';
            $merchant_secret = $config['merchant_secret'];
            
            // Generate hash
            $local_md5sig = strtoupper(
                md5(
                    $merchant_id . 
                    $order_id . 
                    $payhere_amount . 
                    $payhere_currency . 
                    $status_code . 
                    strtoupper(md5($merchant_secret))
                )
            );
            
            // Verify signature
            if ($local_md5sig === $md5sig && $status_code == 2) {
                // Payment success - update database
                // Extract event_id from order_id (format: EVT_{eventId}_{timestamp})
                $orderParts = explode('_', $order_id);
                if(count($orderParts) >= 2) {
                    $eventId = $orderParts[1];
                    $this->eventModel->updateEventPaymentStatus($eventId, 'paid');
                }
            }
            
            exit;
        }

        public function returnHandler() {
            // Handle return from PayHere
            redirect(URLROOT . '/clients/myevents');
        }

        public function cancelHandler() {
            // Handle payment cancellation
            redirect(URLROOT . '/Payment/errorPage');
        }
    }

?>
