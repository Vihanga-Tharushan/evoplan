<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/allfinalpayment.css">
    <div class="container">
        <div class="header">
            <h1>View All Final Payments</h1>
        </div>

        <div class="event-details">
            <div class="detail-row">
                <div class="detail-label">Event Owner</div>
                <div class="detail-value">
                    <div class="owner-info">
                        <div class="owner-avatar">CF</div>
                        <div class="owner-details">
                            <h3>Chris Friedky</h3>
                            <p>Superintendent Villanova</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Event Title/Type</div>
                <div class="detail-value">Birthday Party</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Event Venue</div>
                <div class="detail-value">120/B, Hanthana Road, Kandy</div>
            </div>

            <div class="detail-row">
                <div class="detail-label"></div>
                <div class="detail-value">
                    <div class="time-row">
                        <div class="time-item">
                            <strong>Start time:</strong>&nbsp;&nbsp;3 P.M
                        </div>
                        <div class="time-item">
                            <strong>End time:</strong>&nbsp;&nbsp;11 P.M
                        </div>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label"></div>
                <div class="detail-value">
                    <div class="time-row">
                        <div class="time-item">
                            <strong>Start date:</strong>&nbsp;&nbsp;2025/05/05
                        </div>
                        <div class="time-item">
                            <strong>End date:</strong>&nbsp;&nbsp;2025/05/05
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="service-providers">
            <div class="section-title">Service Providers</div>
            
            <div class="provider-card">
                <button class="card-menu">⋯</button>
                <div class="provider-detail">
                    <div class="provider-label">Service Provider Code</div>
                    <div class="provider-value">#SP_0001</div>
                </div>
                <div class="provider-detail">
                    <div class="provider-label">Package Type</div>
                    <div class="provider-value">Silver Package</div>
                </div>
                <div class="provider-detail">
                    <div class="provider-label">Package Price</div>
                    <div class="provider-value">RS. 25,000</div>
                </div>
                <div class="special-notes">
                    <div class="provider-label">Special Notes</div>
                    <textarea class="notes-textarea" placeholder="Add special notes..."></textarea>
                </div>
            </div>

            <div class="provider-card">
                <button class="card-menu">⋯</button>
                <div class="provider-detail">
                    <div class="provider-label">Service Provider Code</div>
                    <div class="provider-value">#SP_0002</div>
                </div>
                <div class="provider-detail">
                    <div class="provider-label">Package Type</div>
                    <div class="provider-value">Golden Package</div>
                </div>
                <div class="provider-detail">
                    <div class="provider-label">Package Price</div>
                    <div class="provider-value">RS. 35,000</div>
                </div>
                <div class="special-notes">
                    <div class="provider-label">Special Notes</div>
                    <textarea class="notes-textarea" placeholder="Add special notes..."></textarea>
                </div>
            </div>

            <div class="provider-card">
                <button class="card-menu">⋯</button>
                <div class="provider-detail">
                    <div class="provider-label">Service Provider Code</div>
                    <div class="provider-value">#SP_0003</div>
                </div>
                <div class="provider-detail">
                    <div class="provider-label">Package Type</div>
                    <div class="provider-value">Diamond Package</div>
                </div>
                <div class="provider-detail">
                    <div class="provider-label">Package Price</div>
                    <div class="provider-value">RS. 50,000</div>
                </div>
                <div class="special-notes">
                    <div class="provider-label">Special Notes</div>
                    <textarea class="notes-textarea" placeholder="Add special notes..."></textarea>
                </div>
            </div>
        </div>

        <div class="total-section">
            <div class="total-row">
                <div class="total-label">Total Price</div>
                <div class="total-value">RS. 110,000</div>
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn btn-secondary">Edit</button>
            <button class="btn btn-primary" onclick="location.href='<?php echo URLROOT; ?>/Clients/payments';">Make Payment</button>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php';?>