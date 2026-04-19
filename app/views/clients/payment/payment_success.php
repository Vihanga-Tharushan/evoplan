<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/payment/payment.css">

<div class="container">
    <div class="payment-result-container success">
        <div class="result-icon success-icon">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        
        <h1 class="result-title">Payment Successful!</h1>
        <p class="result-message">Your payment has been processed successfully.</p>
        
        <div class="result-details">
            <div class="detail-row">
                <span class="detail-label">Status:</span>
                <span class="detail-value success-badge">Completed</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Date:</span>
                <span class="detail-value"><?php echo date('F d, Y h:i A'); ?></span>
            </div>
            <?php if(isset($data['event_id'])): ?>
            <div class="detail-row">
                <span class="detail-label">Event ID:</span>
                <span class="detail-value">#<?php echo htmlspecialchars($data['event_id']); ?></span>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="result-info">
            <p>✓ All service providers have been notified about your booking</p>
            <p>✓ You will receive confirmation emails shortly</p>
            <p>✓ You can track your event status in My Events</p>
        </div>
        
        <div class="result-actions">
            <a href="<?php echo URLROOT; ?>/Clients/myevents" class="btn-primary">View My Events</a>
            <a href="<?php echo URLROOT; ?>/Clients/home" class="btn-secondary">Go to Home</a>
        </div>
    </div>
</div>

<style>
.payment-result-container {
    max-width: 600px;
    margin: 60px auto;
    padding: 40px;
    text-align: center;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.result-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.success-icon {
    background: #10b981;
    color: white;
}

.result-title {
    font-size: 2rem;
    color: #1f2937;
    margin-bottom: 15px;
}

.result-message {
    font-size: 1.1rem;
    color: #6b7280;
    margin-bottom: 30px;
}

.result-details {
    background: #f9fafb;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #e5e7eb;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    color: #6b7280;
    font-weight: 500;
}

.detail-value {
    color: #1f2937;
    font-weight: 600;
}

.success-badge {
    background: #10b981;
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.9rem;
}

.result-info {
    text-align: left;
    background: #ecfdf5;
    border-left: 4px solid #10b981;
    padding: 20px;
    border-radius: 6px;
    margin-bottom: 30px;
}

.result-info p {
    color: #065f46;
    margin: 8px 0;
    line-height: 1.6;
}

.result-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn-primary, .btn-secondary {
    padding: 12px 30px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #4B006E;
    color: white;
}

.btn-primary:hover {
    background: #3a0055;
    transform: translateY(-2px);
}

.btn-secondary {
    background: white;
    color: #4B006E;
    border: 2px solid #4B006E;
}

.btn-secondary:hover {
    background: #f3f4f6;
}

@media (max-width: 768px) {
    .payment-result-container {
        padding: 30px 20px;
        margin: 30px 15px;
    }
    
    .result-title {
        font-size: 1.5rem;
    }
    
    .result-actions {
        flex-direction: column;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
    }
}
</style>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
