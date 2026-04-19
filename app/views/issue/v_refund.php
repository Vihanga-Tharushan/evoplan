<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/refund.css" />
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Issues - Financial Conflict Resolution</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles/payment-issues.css">
</head>
<style>
  /* Root Variables */
:root {
    --primary: #4B006E;
    --secondary: #6F1A8C;
    --lightSecondary: #7a6e83ff;
    --dark: #0b1026;
    --light: #f7f8fc;
    --text: #111827;
    --muted: #6b7280;
    --success: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --info: #3b82f6;
    --gray: #64748b;
    --border: #e2e8f0;
    --radius: 16px;
    --white: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: linear-gradient(135deg, var(--light) 0%, #e8e4f0 100%);
    color: var(--text);
    line-height: 1.6;
    min-height: 100vh;
}

.container {
    max-width: 1600px;
    margin-left: 270px;
    margin-top: 50px;
    padding: 20px;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: var(--white);
    padding: 40px;
    border-radius: var(--radius);
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(75, 0, 110, 0.2);
}

.header-content {
    margin-bottom: 25px;
}

.header-content h1 {
    font-size: 2rem;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.subtitle {
    opacity: 0.95;
    font-size: 1rem;
}

.header-stats {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.stat-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    flex: 1;
    min-width: 200px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-info {
    flex: 1;
}

.stat-value {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 2px;
}

.stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
}

/* Tabs */
.tabs {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 24px;
    overflow-x: auto;
}

.tabs {
    display: flex;
    border-bottom: 1px solid #e5e7eb;
}

.tab-button {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 16px 24px;
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    color: #6b7280;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    position: relative;
    font-size: 16px;
}

.tab-button:hover {
    color: var(--text);
}

.tab-button.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
}

.tab-button i {
    width: 20px;
    height: 20px;
    margin-top: 5px;
}

.badge {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
    background-color: #ef4444;
}

.tab-button.active .badge {
    background-color: white;
    color: var(--primary);
}

/* Tab Content */
.tab-content {
    background: var(--white);
    border-radius: var(--radius);
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    min-height: 500px;
}

.tab-pane {
    display: none;
    animation: fadeIn 0.3s ease;
}

.tab-pane.active {
    display: block;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Content Header */
.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 20px;
}

.content-header h2 {
    color: var(--primary);
    font-size: 1.5rem;
}

.filter-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-select,
.filter-input,
.search-input {
    padding: 10px 15px;
    border: 2px solid var(--border);
    border-radius: 8px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: var(--white);
}

.filter-select:focus,
.filter-input:focus,
.search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
}

.search-input {
    min-width: 250px;
}

/* Info Banner */
.info-banner {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    border: 2px solid #93c5fd;
    border-left: 4px solid var(--info);
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #1e40af;
}

.info-banner i {
    font-size: 1.5rem;
}

.info-banner strong {
    color: #1e3a8a;
}

/* Table Container */
.table-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.complaints-table {
    width: 100%;
    border-collapse: collapse;
}

.complaints-table thead {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
}

.complaints-table thead th {
    padding: 16px 12px;
    text-align: left;
    font-weight: 700;
    font-size: 0.875rem;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    background-color: var(--primary);
}

.complaints-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #e2e8f0;
}

.complaints-table tbody tr:hover {
    background: linear-gradient(135deg, rgba(248, 250, 252, 0.8) 0%, rgba(241, 245, 249, 0.6) 100%);
    transform: translateX(4px);
    box-shadow: 4px 0 12px rgba(75, 0, 110, 0.1);
}

.complaints-table tbody tr:last-child {
    border-bottom: none;
}

.complaints-table td {
    padding: 16px 12px;
    vertical-align: middle;
    font-size: 0.875rem;
    color: var(--text);
}

.table-id {
    font-family: 'Monaco', 'Menlo', monospace;
    font-weight: 700;
    color: var(--primary);
}

.table-type {
    font-weight: 600;
    color: var(--text);
}

.table-client, .table-provider, .table-event {
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight: 500;
}

.table-created {
    white-space: nowrap;
}

.table-amount {
    font-weight: 700;
    color: var(--text);
}

.table-amount.positive {
    color: var(--success);
}

.table-amount.negative {
    color: var(--danger);
}

/* Badges */
.status-badge,
.priority-badge,
.type-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.priority-badge {
    background: var(--info);
    color: var(--white);
}

.priority-badge.CRITICAL,
.priority-badge.high {
    background: var(--danger);
}

.priority-badge.HIGH,
.priority-badge.medium {
    background: var(--warning);
    color: var(--dark);
}

.priority-badge.MEDIUM,
.priority-badge.low {
    background: var(--info);
}

.priority-badge.LOW {
    background: var(--success);
}

.status-badge {
    background: var(--secondary);
    color: var(--white);
}

.status-badge.pending {
    background: var(--warning);
    color: var(--dark);
}

.status-badge.verified {
    background: var(--info);
}

.status-badge.resolved {
    background: var(--success);
}

.type-badge {
    background: var(--lightSecondary);
    color: var(--white);
}

.type-badge.failed {
    background: var(--danger);
}

.type-badge.refund {
    background: var(--warning);
    color: var(--dark);
}

.type-badge.mismatch {
    background: var(--info);
}

/* Buttons */
.table-view-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(75, 0, 110, 0.2);
}

.table-view-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.3);
}

.table-view-btn:active {
    transform: translateY(0);
}

.table-view-btn i {
    font-size: 12px;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: var(--white);
    box-shadow: 0 2px 8px rgba(75, 0, 110, 0.2);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.3);
}

.btn-secondary {
    background: var(--gray);
    color: var(--white);
}

.btn-secondary:hover {
    background: var(--muted);
}

.btn-success {
    background: var(--success);
    color: var(--white);
}

.btn-success:hover {
    background: #059669;
}

.btn-danger {
    background: var(--danger);
    color: var(--white);
}

.btn-danger:hover {
    background: #dc2626;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    z-index: 1000;
    animation: fadeIn 0.3s ease;
    overflow-y: auto;
    padding: 20px;
}

.modal.active {
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.modal-dialog {
    width: 100%;
    max-width: 900px;
    margin: 40px auto;
}

.modal-dialog.modal-sm {
    max-width: 600px;
}

.modal-content {
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px 30px;
    border-bottom: 2px solid var(--border);
    background: linear-gradient(135deg, rgba(75, 0, 110, 0.03) 0%, rgba(111, 26, 140, 0.03) 100%);
}

.modal-header h2 {
    color: var(--primary);
    font-size: 1.5rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.close-btn {
    background: none;
    border: none;
    font-size: 2rem;
    color: var(--muted);
    cursor: pointer;
    transition: all 0.3s ease;
    line-height: 1;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

.close-btn:hover {
    color: var(--danger);
    background: rgba(239, 68, 68, 0.1);
}

.modal-body {
    padding: 30px;
    max-height: calc(90vh - 200px);
    overflow-y: auto;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 20px 30px;
    border-top: 2px solid var(--border);
    background: var(--light);
}

/* Refund Summary Card */
.refund-summary-card {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border: 2px solid #86efac;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
}

.refund-summary-card h3 {
    color: var(--primary);
    margin-bottom: 20px;
    font-size: 1.25rem;
}

.refund-breakdown {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.breakdown-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: var(--white);
    border-radius: 8px;
}

.breakdown-row.highlight {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 197, 253, 0.1) 100%);
    border: 1px solid #93c5fd;
}

.breakdown-row.total {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: var(--white);
    font-weight: 700;
    font-size: 1.1rem;
}

.breakdown-label {
    font-weight: 600;
}

.breakdown-value {
    font-weight: 700;
    font-size: 1.1rem;
}

.breakdown-value.success {
    color: var(--white);
}

.breakdown-value.warning {
    color: var(--danger);
}

/* Form Elements */
.form-section {
    margin-top: 25px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text);
}

.form-label input[type="checkbox"] {
    margin-right: 8px;
}

.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border);
    border-radius: 8px;
    font-size: 0.95rem;
    font-family: inherit;
    transition: all 0.3s ease;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
}

.form-textarea {
    resize: vertical;
}

.info-text {
    background: var(--light);
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    color: var(--muted);
}

/* Issue Details */
.issue-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.detail-card {
    background: var(--light);
    padding: 20px;
    border-radius: 12px;
    border: 2px solid var(--border);
}

.detail-card h4 {
    color: var(--primary);
    margin-bottom: 10px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-card p {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text);
    margin: 0;
}

/* Toast Notification */
.toast {
    position: fixed;
    bottom: -100px;
    right: 30px;
    background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
    color: var(--white);
    padding: 16px 24px;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(16, 185, 129, 0.3);
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 2000;
    transition: bottom 0.3s ease;
    font-weight: 600;
}

.toast.show {
    bottom: 30px;
}

.toast i {
    font-size: 1.5rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 40px;
    color: var(--muted);
}

.empty-state i {
    font-size: 4rem;
    opacity: 0.3;
    margin-bottom: 20px;
}

.empty-state p {
    font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .issue-details-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .page-header {
        padding: 25px;
    }

    .header-stats {
        flex-direction: column;
    }

    .stat-card {
        min-width: 100%;
    }

    .tabs {
        flex-direction: column;
    }

    .tab-button {
        min-width: 100%;
    }

    .tab-content {
        padding: 20px;
    }

    .content-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .filter-group {
        width: 100%;
    }

    .filter-select,
    .filter-input,
    .search-input {
        width: 100%;
    }

    .table-container {
        overflow-x: auto;
        border-radius: 8px;
    }

    .complaints-table {
        min-width: 900px;
    }

    .complaints-table thead th {
        padding: 10px 6px;
        font-size: 0.75rem;
    }

    .complaints-table td {
        padding: 10px 6px;
        font-size: 0.75rem;
    }

    .table-client, .table-provider, .table-event {
        max-width: 100px;
    }

    .table-view-btn {
        padding: 6px 12px;
        font-size: 0.75rem;
        gap: 4px;
    }

    .modal {
        padding: 10px;
    }

    .modal-dialog {
        margin: 20px auto;
    }

    .modal-header,
    .modal-body,
    .modal-footer {
        padding: 20px;
    }

    .issue-details-grid {
        grid-template-columns: 1fr;
    }

    .refund-breakdown {
        font-size: 0.9rem;
    }

    .toast {
        right: 10px;
        left: 10px;
    }

    .toast.show {
        bottom: 10px;
    }
}

</style>
<body>
    <div class="container">
        

        <!-- Tab Navigation -->
        <div class="tabs">
            <button class="tab-button active" data-tab="refund-requests">
                <i class="fas fa-money-bill-wave"></i>
                Refund Requests
                <span class="badge" id="refundsCount">0</span>
            </button>
            <button class="tab-button" data-tab="resolved-issues">
                <i class="fas fa-check-circle"></i>
                Resolved
                <span class="badge" id="resolvedCount">0</span>
            </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Refund Requests Tab -->
            <div id="refund-requests" class="tab-pane active">
                <div class="content-header">
                    <h2>Refund Requests</h2>
                    <div class="filter-group">
                        <input type="text" id="searchRefunds" class="search-input" placeholder="Search...">
                    </div>
                </div>
                <div class="info-banner">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        <strong>Refund Policy:</strong> Last-minute cancellations receive 85% refund. 15% is retained for provider compensation as they reserved their time.
                    </div>
                </div>
                <div class="table-container">
                    <table class="complaints-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Client</th>
                                <th>Total Amount</th>
                                <th>Refund Amount (85%)</th>
                                <th>Reason</th>
                                <th>Requested</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="refundsTableBody">
                            <!-- Dynamically populated -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Resolved Issues Tab -->
            <div id="resolved-issues" class="tab-pane">
                <div class="content-header">
                    <h2>Resolved Payment Issues</h2>
                    <div class="filter-group">
                        <input type="date" id="resolvedFromDate" class="filter-input">
                        <input type="date" id="resolvedToDate" class="filter-input">
                        <input type="text" id="searchResolved" class="search-input" placeholder="Search...">
                    </div>
                </div>
                <div class="table-container">
                    <table class="complaints-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Issue Type</th>
                                <th>Amount</th>
                                <th>Resolution</th>
                                <th>Resolved By</th>
                                <th>Resolved Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="resolvedTableBody">
                            <!-- Dynamically populated -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Refund Processing Modal -->
    <div id="refundModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><i class="fas fa-money-bill-wave"></i> Process Refund</h2>
                    <button class="close-btn" onclick="closeRefundModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="refund-summary-card">
                        <h3>Refund Calculation (85% Standard Rate)</h3>
                        <div class="refund-breakdown">
                            <div class="breakdown-row">
                                <span class="breakdown-label">Total Amount:</span>
                                <span class="breakdown-value" id="refundOriginal">Rs. 0.00</span>
                            </div>
                            <div class="breakdown-row">
                                <span class="breakdown-label">Provider Compensation (15%):</span>
                                <span class="breakdown-value warning" id="providerFee">-Rs. 0.00</span>
                            </div>
                            <div class="breakdown-row total">
                                <span class="breakdown-label">Refund to Client (85%):</span>
                                <span class="breakdown-value success" id="refundAmount">Rs. 0.00</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-group">
                            <label class="form-label">Refund Decision</label>
                            <div style="display: flex; gap: 15px;">
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                    <input type="radio" name="refundDecision" value="approve" checked onchange="updateRefundDecision()">
                                    <span style="font-weight: 600;">Approve Refund</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                    <input type="radio" name="refundDecision" value="reject" onchange="updateRefundDecision()">
                                    <span style="font-weight: 600;">Reject Refund</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Cancellation Reason</label>
                            <textarea id="refundReason" class="form-textarea" rows="4" placeholder="Reason for cancellation and refund..."></textarea>
                        </div>

                        <div class="form-group" id="rejectionReasonGroup" style="display: none;">
                            <label class="form-label">Rejection Reason</label>
                            <textarea id="rejectionReason" class="form-textarea" rows="4" placeholder="Explain why this refund is being rejected..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <input type="checkbox" id="notifyClient" checked> 
                                Notify client via email
                            </label>
                        </div>

                        <div class="form-group" id="compensateProvidersGroup">
                            <label class="form-label">
                                <input type="checkbox" id="compensateProviders" checked> 
                                Compensate service providers (for last-minute cancellations)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeRefundModal()">Cancel</button>
                    <button class="btn btn-primary" id="processBtn" onclick="processRefund()">
                        <i class="fas fa-check"></i>
                        Approve Refund
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- View Resolved Refund Modal -->
    <div id="resolvedRefundModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><i class="fas fa-eye"></i> Refund Details</h2>
                    <button class="close-btn" onclick="closeResolvedModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="issue-details-grid">
                        <div class="detail-card">
                            <h4>Event Name</h4>
                            <p id="detailEventName">-</p>
                        </div>
                        <div class="detail-card">
                            <h4>Client Name</h4>
                            <p id="detailClientName">-</p>
                        </div>
                        <div class="detail-card">
                            <h4>Original Amount</h4>
                            <p id="detailOriginalAmount">LKR 0.00</p>
                        </div>
                        <div class="detail-card">
                            <h4>Refund Status</h4>
                            <p id="detailStatus">-</p>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 style="color: var(--primary); margin-bottom: 15px;">Refund Breakdown</h3>
                        <div class="refund-breakdown">
                            <div class="breakdown-row">
                                <span class="breakdown-label">Total Amount:</span>
                                <span class="breakdown-value" id="detailRefundOriginal">LKR 0.00</span>
                            </div>
                            <div class="breakdown-row">
                                <span class="breakdown-label">Provider Compensation (15%):</span>
                                <span class="breakdown-value warning" id="detailProviderFee">-LKR 0.00</span>
                            </div>
                            <div class="breakdown-row total">
                                <span class="breakdown-label">Refund to Client (85%):</span>
                                <span class="breakdown-value success" id="detailRefundAmount">LKR 0.00</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-group">
                            <label class="form-label">Cancellation Reason:</label>
                            <p id="detailReason">-</p>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-group">
                            <label class="form-label">Resolved Date:</label>
                            <p id="detailResolvedDate">-</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeResolvedModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    <div id="successToast" class="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Action completed successfully!</span>
    </div>

    <script>// Fetch pending refunds from database


// State
let currentIssue = null;
let mockRefundRequests = [];
let mockResolvedIssues = [];
let filteredRefunds = [];
let filteredResolved = [];

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    initializeTabs();
    loadPendingRefunds();
    loadResolvedRefunds();
    setupFilters();
});

// Load Pending Refunds from Database
async function loadPendingRefunds() {
    try {
        const response = await fetch('<?php echo URLROOT; ?>/IssueC/getPendingRefunds', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const result = await response.json();
        if (result.success && result.data) {
            mockRefundRequests = result.data.map(refund => ({
                refund_id: refund.event_id,
                event_id: refund.event_id,
                event_name: refund.event_name,
                client_name: refund.client_name,
                total_amount: parseFloat(refund.total_cost || 0),
                refund_amount: parseFloat(refund.total_cost || 0) * 0.85,
                cancel_reason: refund.cancel_reason,
                refund_status: 'PENDING',
                created_at: refund.updated_at
            }));
            
            filteredRefunds = [...mockRefundRequests];
            renderAllTables();
            updateStats();
        }
    } catch (error) {
        console.error('Error loading refunds:', error);
    }
}

// Load Resolved Refunds from Database
async function loadResolvedRefunds() {
    try {
        const response = await fetch('<?php echo URLROOT; ?>/IssueC/getResolvedRefunds', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const result = await response.json();
        if (result.success && result.data) {
            mockResolvedIssues = result.data.map(refund => ({
                id: refund.event_id,
                event_id: refund.event_id,
                event_name: refund.event_name,
                client_name: refund.client_name,
                amount: parseFloat(refund.refundAmount || 0),
                original_amount: parseFloat(refund.total_cost || 0),
                issue_type: refund.refundSTate === 'REFUNDED' ? 'REFUNDED' : 'REJECTED',
                resolution: refund.refundSTate === 'REFUNDED' ? 'Refund Approved' : 'Refund Rejected',
                resolved_by:'Issue Coordinator',
                resolved_date: refund.updated_at,
                reason: refund.cancel_reason
            }));
            
            filteredResolved = [...mockResolvedIssues];
            renderAllTables();
            updateStats();
        }
    } catch (error) {
        console.error('Error loading resolved refunds:', error);
    }
}

// Tab Management
function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            switchTab(tabName);
        });
    });
}

function switchTab(tabName) {
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('data-tab') === tabName) {
            btn.classList.add('active');
        }
    });

    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    document.getElementById(tabName).classList.add('active');
}

// Render All Tables
function renderAllTables() {
    renderRefundRequests();
    renderResolvedIssues();
}

// Render Refund Requests
function renderRefundRequests() {
    const tbody = document.getElementById('refundsTableBody');
    
    if (!tbody || filteredRefunds.length === 0) {
        if (tbody) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="8" class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <p>No refund requests pending</p>
                    </td>
                </tr>
            `;
        }
        return;
    }

    tbody.innerHTML = filteredRefunds.map(issue => `
        <tr>
            <td class="table-id">REF-${String(issue.event_id).padStart(5, '0')}</td>
            <td class="table-event" title="${issue.event_name}">${truncateText(issue.event_name, 30)}</td>
            <td class="table-client" title="${issue.client_name}">${truncateText(issue.client_name, 20)}</td>
            <td class="table-amount">LKR ${issue.total_amount.toFixed(2)}</td>
            <td class="table-amount positive">LKR ${issue.refund_amount.toFixed(2)}</td>
            <td class="table-type" title="${issue.cancel_reason}">${truncateText(issue.cancel_reason, 50)}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${getTimeSince(issue.created_at)}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${formatDate(issue.created_at)}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="viewRefund(${issue.event_id})" title="Process Refund">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Process</span>
                </button>
            </td>
        </tr>
    `).join('');

    if (document.getElementById('refundsCount')) {
        document.getElementById('refundsCount').textContent = filteredRefunds.length;
    }
}

// Render Resolved Issues
function renderResolvedIssues() {
    const tbody = document.getElementById('resolvedTableBody');
    
    if (filteredResolved.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>No resolved issues</p>
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = filteredResolved.map(issue => `
        <tr>
            <td class="table-id">#${issue.id}</td>
            <td class="table-event" title="${issue.event_name}">${issue.event_name}</td>
            <td><span class="type-badge">${formatIssueType(issue.issue_type)}</span></td>
            <td class="table-amount">Rs. ${issue.amount.toLocaleString()}</td>
            <td class="table-type">${issue.resolution}</td>
            <td class="table-client">${issue.resolved_by}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${formatDate(issue.resolved_date)}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${formatTime(issue.resolved_date)}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="viewIssue(${issue.id}, 'resolved')" title="View Details">
                    <i class="fas fa-eye"></i>
                    <span>View</span>
                </button>
            </td>
        </tr>
    `).join('');

    document.getElementById('resolvedCount').textContent = filteredResolved.length;
}

// Update Stats
function updateStats() {
    const totalPending = mockRefundRequests.length;
    const totalRefunds = mockRefundRequests.length;
    const totalAmount = mockRefundRequests.reduce((sum, issue) => sum + issue.original_amount, 0);

    // document.getElementById('pendingIssues').textContent = totalPending;
    // document.getElementById('refundRequests').textContent = totalRefunds;
    // document.getElementById('totalAmount').textContent = `$${totalAmount.toLocaleString()}`;
}

// Setup Filters
function setupFilters() {
    document.getElementById('searchRefunds').addEventListener('input', () => applyFilter('refunds'));
    document.getElementById('searchResolved').addEventListener('input', () => applyFilter('resolved'));
    document.getElementById('resolvedFromDate').addEventListener('change', () => applyFilter('resolved'));
    document.getElementById('resolvedToDate').addEventListener('change', () => applyFilter('resolved'));
}

// Apply Filters
function applyFilter(type) {
    const searchTerm = document.getElementById(`search${type.charAt(0).toUpperCase() + type.slice(1)}`).value.toLowerCase();
    
    if (type === 'refunds') {
        filteredRefunds = mockRefundRequests.filter(issue => {
            const matchesSearch = issue.event_name.toLowerCase().includes(searchTerm) ||
                                 issue.client_name.toLowerCase().includes(searchTerm);
            return matchesSearch;
        });
        renderRefundRequests();
    } else if (type === 'resolved') {
        const dateFrom = document.getElementById('resolvedFromDate').value;
        const dateTo = document.getElementById('resolvedToDate').value;
        
        filteredResolved = mockResolvedIssues.filter(issue => {
            const matchesSearch = issue.event_name.toLowerCase().includes(searchTerm) ||
                                 issue.client_name?.toLowerCase().includes(searchTerm);
            const issueDate = new Date(issue.resolved_date);
            const matchesDateFrom = !dateFrom || issueDate >= new Date(dateFrom);
            const matchesDateTo = !dateTo || issueDate <= new Date(dateTo);
            return matchesSearch && matchesDateFrom && matchesDateTo;
        });
        renderResolvedIssues();
    }
}

// View Issue
function viewIssue(id, type) {
    let issue;
    if (type === 'resolved') {
        issue = mockResolvedIssues.find(i => i.id === id);
    }

    if (!issue) return;

    currentIssue = { ...issue, type };
    
    // Populate detail fields
    document.getElementById('detailEventName').textContent = issue.event_name || '-';
    document.getElementById('detailClientName').textContent = issue.client_name || '-';
    document.getElementById('detailOriginalAmount').textContent = `LKR ${parseFloat(issue.original_amount || 0).toFixed(2)}`;
    document.getElementById('detailReason').textContent = issue.reason || '-';
    document.getElementById('detailResolvedDate').textContent = formatDate(issue.resolved_date) + ' at ' + formatTime(issue.resolved_date);
    
    // Set status badge
    const statusElement = document.getElementById('detailStatus');
    if (issue.issue_type === 'REFUNDED') {
        statusElement.innerHTML = '<span class="status-badge resolved">REFUNDED</span>';
    } else {
        statusElement.innerHTML = '<span class="status-badge">REJECTED</span>';
    }
    
    // Calculate and display refund breakdown
    const totalAmount = parseFloat(issue.original_amount || 0);
    const providerFee = totalAmount * 0.15;
    const refundAmount = totalAmount * 0.85;
    
    document.getElementById('detailRefundOriginal').textContent = `LKR ${totalAmount.toFixed(2)}`;
    document.getElementById('detailProviderFee').textContent = `-LKR ${providerFee.toFixed(2)}`;
    document.getElementById('detailRefundAmount').textContent = `LKR ${refundAmount.toFixed(2)}`;
    
    document.getElementById('resolvedRefundModal').classList.add('active');
}

// View Refund
function viewRefund(id) {
    const refund = mockRefundRequests.find(r => r.event_id === id);
    if (!refund) return;

    currentIssue = refund;
    const providerFee = refund.total_amount - refund.refund_amount;
    
    // Populate refund modal
    document.getElementById('refundOriginal').textContent = `LKR ${refund.total_amount.toFixed(2)}`;
    const serviceFee = refund.total_amount * 0.15; // 15% fee
    document.getElementById('providerFee').textContent = `-LKR ${serviceFee.toFixed(2)}`;
    document.getElementById('refundAmount').textContent = `LKR ${refund.refund_amount.toFixed(2)}`;
    
    document.getElementById('refundReason').value = refund.cancel_reason;
    
    // Reset decision options
    document.querySelector('input[name="refundDecision"][value="approve"]').checked = true;
    updateRefundDecision();
    
    document.getElementById('refundModal').classList.add('active');
}



// Update Refund Decision
function updateRefundDecision() {
    const decision = document.querySelector('input[name="refundDecision"]:checked').value;
    const rejectionGroup = document.getElementById('rejectionReasonGroup');
    const compensateGroup = document.getElementById('compensateProvidersGroup');
    const processBtn = document.getElementById('processBtn');
    
    if (decision === 'reject') {
        rejectionGroup.style.display = 'block';
        compensateGroup.style.display = 'none';
        processBtn.innerHTML = '<i class="fas fa-times"></i> Reject Refund';
        processBtn.className = 'btn btn-danger';
    } else {
        rejectionGroup.style.display = 'none';
        compensateGroup.style.display = 'block';
        processBtn.innerHTML = '<i class="fas fa-check"></i> Approve Refund';
        processBtn.className = 'btn btn-primary';
    }
}

// Process Refund
async function processRefund() {
    const decision = document.querySelector('input[name="refundDecision"]:checked').value;
    const cancellationReason = document.getElementById('refundReason').value;
    const rejectionReason = document.getElementById('rejectionReason')?.value || '';
    
    if (!cancellationReason.trim()) {
        alert('Please provide the cancellation reason');
        return;
    }
    
    if (decision === 'reject' && !rejectionReason.trim()) {
        alert('Please provide a rejection reason');
        return;
    }

    const processBtn = document.getElementById('processBtn');
    const originalText = processBtn?.innerHTML;
    if (processBtn) {
        processBtn.disabled = true;
        processBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    }

    try {
        const response = await fetch('<?php echo URLROOT; ?>/IssueC/processRefund', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                event_id: currentIssue.event_id,
                refund_decision: decision === 'approve' ? 'REFUNDED' : 'REJECTED',
                refund_amount: currentIssue.refund_amount, // 85% of total_cost
                reject_reason: rejectionReason
            })
        });

        const result = await response.json();
        if (result.success) {
            closeRefundModal();
            showToast(result.message || 'Refund processed successfully!');
            await loadPendingRefunds();
            await loadResolvedRefunds();
        } else {
            alert('Error: ' + (result.error || 'Failed to process refund'));
        }
    } catch (error) {
        console.error('Error processing refund:', error);
        alert('Failed to process refund. Please try again.');
    } finally {
        if (processBtn) {
            processBtn.disabled = false;
            processBtn.innerHTML = originalText;
        }
    }
}

// Open Verify Modal
function openVerifyModal() {
    closeIssueModal();
    document.getElementById('verifyModal').classList.add('active');
}

// Submit Verification
function submitVerification() {
    const status = document.getElementById('verifyStatus').value;
    const notes = document.getElementById('verifyNotes').value;
    
    if (!notes.trim()) {
        alert('Please add verification notes');
        return;
    }
    
    if (status === 'verified') {
        showToast('Issue verified and marked as resolved!');
    } else {
        showToast('Verification status updated!');
    }
    
    closeVerifyModal();
    renderAllTables();
    updateStats();
}

// Close Modals
function closeIssueModal() {
    document.getElementById('issueModal').classList.remove('active');
    currentIssue = null;
}

function closeRefundModal() {
    document.getElementById('refundModal').classList.remove('active');
    currentIssue = null;
}

function closeResolvedModal() {
    document.getElementById('resolvedRefundModal').classList.remove('active');
    currentIssue = null;
}

function closeVerifyModal() {
    document.getElementById('verifyModal').classList.remove('active');
}

// Show Toast
function showToast(message) {
    const toast = document.getElementById('successToast');
    document.getElementById('toastMessage').textContent = message;
    toast.classList.add('show');
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Utility Functions
function formatIssueType(type) {
    const types = {
        'REFUNDED': 'Refund Approved',
        'REJECTED': 'Refund Rejected',
        'refund_request': 'Refund Request',
        'failed_transaction': 'Failed Transaction',
        'payment_mismatch': 'Payment Mismatch',
        'partial_payment': 'Partial Payment'
    };
    return types[type] || type;
}

function truncateText(text, length) {
    if (!text) return '';
    return text.length > length ? text.substring(0, length) + '...' : text;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
    });
}

function formatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
}

function getTimeSince(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diff = now - date;
    
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    
    if (days > 0) return `${days}d ago`;
    if (hours > 0) return `${hours}h ago`;
    return 'Just now';
}

// Close modals on outside click
document.addEventListener('click', (e) => {
    if (e.target.id === 'issueModal') closeIssueModal();
    if (e.target.id === 'refundModal') closeRefundModal();
    if (e.target.id === 'resolvedRefundModal') closeResolvedModal();
    if (e.target.id === 'verifyModal') closeVerifyModal();
});
</script>
</body>
</html>

  <?php require APPROOT . '/views/inc/footer.php'; ?>