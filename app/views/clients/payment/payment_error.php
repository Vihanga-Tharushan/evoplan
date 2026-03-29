<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/payment/payment.css">

<div class="container">
    <div class="payment-result-container error">
        <div class="result-icon error-icon">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
        </div>
        
        <h1 class="result-title">Payment Failed</h1>
        <p class="result-message">We couldn't process your payment. Please try again.</p>
        
        <div class="result-details">
            <div class="detail-row">
                <span class="detail-label">Status:</span>
                <span class="detail-value error-badge">Failed</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Date:</span>
                <span class="detail-value"><?php echo date('F d, Y h:i A'); ?></span>
            </div>
        </div>
        
        <div class="result-info error-info">
            <p><strong>Possible reasons:</strong></p>
            <p>• Insufficient funds in your account</p>
            <p>• Payment was cancelled</p>
            <p>• Network connection issues</p>
            <p>• Invalid payment details</p>
        </div>
        
        <div class="result-actions">
            <a href="javascript:history.back()" class="btn-primary">Try Again</a>
            <a href="<?php echo URLROOT; ?>/Clients/home" class="btn-secondary">Go to Home</a>
        </div>
        
        <p class="support-text">
            Need help? <a href="<?php echo URLROOT; ?>/support" class="support-link">Contact Support</a>
        </p>
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

.error-icon {
    background: #ef4444;
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

.error-badge {
    background: #ef4444;
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.9rem;
}

.result-info {
    text-align: left;
    padding: 20px;
    border-radius: 6px;
    margin-bottom: 30px;
}

.error-info {
    background: #fef2f2;
    border-left: 4px solid #ef4444;
}

.error-info p {
    color: #991b1b;
    margin: 8px 0;
    line-height: 1.6;
}

.result-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-bottom: 20px;
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

.support-text {
    color: #6b7280;
    font-size: 0.95rem;
}

.support-link {
    color: #4B006E;
    text-decoration: none;
    font-weight: 600;
}

.support-link:hover {
    text-decoration: underline;
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
