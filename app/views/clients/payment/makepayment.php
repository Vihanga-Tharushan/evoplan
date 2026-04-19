<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/payment/payment.css">

<div class="container">
    <div class="payment-container">
        <div class="payment-header">
            <h2>Complete Your Payment</h2>
            <p class="payment-subtitle">Event: <?php echo htmlspecialchars($data['event_details']->event_name ?? 'Your Event'); ?></p>
        </div>

        <!-- Payment Summary -->
        <div class="payment-summary-card">
            <h3>Payment Summary</h3>
            <div class="summary-items">
                <?php if(!empty($data['packages'])): ?>
                    <?php foreach($data['packages'] as $package): ?>
                        <div class="summary-item">
                            <span class="item-name"><?php echo htmlspecialchars($package->package_name); ?></span>
                            <span class="item-price">Rs. <?php echo number_format($package->package_price, 2); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="summary-total">
                <span class="total-label">Total Amount</span>
                <span class="total-amount">Rs. <?php echo number_format($data['total_amount'], 2); ?></span>
            </div>
        </div>

        <!-- Payment Button -->
        <div class="payment-action">
            <button type="button" id="payhere-payment" class="payhere-btn">
                <span class="btn-icon">🔒</span>
                <span>Pay Securely with PayHere</span>
            </button>
            <p class="secure-note">
                <span class="secure-icon">🛡️</span>
                Your payment is secured by PayHere
            </p>
        </div>

        <div class="payment-info">
            <p><strong>Note:</strong> After successful payment, all service providers will be notified about your booking.</p>
        </div>
    </div>
</div>



<!-- PayHere Payment Integration -->
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
<script>
    const URLROOT = '<?php echo URLROOT; ?>';
    const eventId = '<?php echo $data['event_id']; ?>';
    const clientId = '<?php echo $data['client_id']; ?>';
    const totalAmount = parseFloat('<?php echo $data['total_amount']; ?>');
    const orderId = '<?php echo $data['order_id']; ?>';
    const merchantId = '<?php echo $data['merchant_id']; ?>';
    const paymentHash = '<?php echo $data['hash']; ?>';
    const amount = '<?php echo $data['amount']; ?>';


    document.addEventListener('DOMContentLoaded', function() {

        console.log("===== Payment Data Loaded =====");
        console.log("URLROOT:", URLROOT);
        console.log("Event ID:", eventId);
        console.log("Client ID:", clientId);
        console.log("Total Amount:", totalAmount);
        console.log("Order ID:", orderId);
        console.log("Merchant ID:", merchantId);
        console.log("Payment Hash:", paymentHash);
        console.log("Amount:", amount);
        console.log("==============================");
        
        if (window.payhere) {
            console.log("✓ PayHere SDK loaded successfully");
        } else {
            console.error("✗ Failed to load PayHere SDK");
            alert("Unable to load payment gateway. Please refresh the page.");
        }
        
        // Validate all required data is present
        if (!eventId || !clientId || !totalAmount || !orderId || !merchantId || !paymentHash) {
            console.error("Missing payment data!");
            alert("Payment data is incomplete. Please try again.");
        } else {
            console.log("✓ All payment data validated");
        }
    });
    document.getElementById('payhere-payment').addEventListener('click', function() {
        
    payhere.onCompleted = function onCompleted(orderId) {
            console.log("Payment completed. EventID:" + eventId + " OrderID:" + orderId);
            // Send payment success to backend
            fetch(`${URLROOT}/Payment/successClientToSytem`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    event_id: eventId,
                    client_id: clientId,
                    gateway_reference: orderId,
                    total_amount: totalAmount,
                    payment_method: 'CARD',
                    payment_status: 'PAID',
                    paid_at: new Date().toISOString().slice(0, 19).replace('T', ' ')
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    window.location.href = `${URLROOT}/Payment/successPage/${eventId}`;
                } else {
                    alert('Payment recorded but there was an issue. Please contact support.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.error('Error details:', {
                    message: error.message,
                    stack: error.stack,
                    name: error.name
                });
                alert('An error occurred while recording payment. Please contact support.');
            });
        };

        payhere.onDismissed = function onDismissed() {
            console.log("Payment dismissed");
        };

        payhere.onError = function onError(error) {
            console.log("Error:" + error);
            window.location.href = `${URLROOT}/Payment/errorPage`;
        };

        // Payment object
        // NOTE: Business name and logo are set in PayHere merchant account settings
        // Sandbox shows "Demo Business" - this is normal for testing
        // For live mode: Configure at https://www.payhere.lk/merchant/ → Settings → Business Profile
        var payment = {
            "sandbox": true, // Set to false when going live with production merchant credentials
            "merchant_id": merchantId,
            "return_url": `${URLROOT}/Payment/returnHandler`,
            "cancel_url": `${URLROOT}/Payment/cancelHandler`,
            "notify_url": `${URLROOT}/Payment/notify`,
            "order_id": orderId,
            "items": "Event Booking - <?php echo htmlspecialchars($data['event_details']->event_name ?? 'Event'); ?>",
            "amount": amount,
            "currency": "LKR",
            "hash": paymentHash,
            "first_name": "<?php echo htmlspecialchars($data['client_name']); ?>",
            "last_name": "",
            "email": "<?php echo htmlspecialchars($data['client_email']); ?>",
            "phone": "",
            "address": "",
            "city": "",
            "country": "Sri Lanka"
        };

        payhere.startPayment(payment);
    });

    
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
