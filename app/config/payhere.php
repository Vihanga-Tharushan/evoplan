<?php
// config/payhere.php
return [
    'merchant_id' => '1234037',                 // Sandbox Merchant ID
    'merchant_secret' => 'MTY4MTExNjIxNzI5ODU4NDQxNzUzMzMwOTg5NzQzNTEzMzUzNDQ2', // Sandbox Secret
    'sandbox' => true,                           // true for sandbox, false for live
    'currency' => 'LKR',
    'return_url' => URLROOT . '/Payment/returnHandler',
    'cancel_url' => URLROOT . '/Payment/cancelHandler',
    'notify_url' => URLROOT . '/Payment/notify', // must be publicly accessible (for production, use full domain URL)
];
?>