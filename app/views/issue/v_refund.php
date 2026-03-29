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
            <button class="tab-button active" data-tab="pending-issues">
                <i class="fas fa-clock"></i>
                Pending Issues
                <span class="badge" id="pendingCount">0</span>
            </button>
            <button class="tab-button" data-tab="failed-transactions">
                <i class="fas fa-times-circle"></i>
                Failed Transactions
                <span class="badge" id="failedCount">0</span>
            </button>
            <button class="tab-button" data-tab="refund-requests">
                <i class="fas fa-money-bill-wave"></i>
                Refund Requests
                <span class="badge" id="refundsCount">0</span>
            </button>
            <button class="tab-button" data-tab="payment-mismatches">
                <i class="fas fa-balance-scale"></i>
                Payment Mismatches
                <span class="badge" id="mismatchCount">0</span>
            </button>
            <button class="tab-button" data-tab="resolved-issues">
                <i class="fas fa-check-circle"></i>
                Resolved
                <span class="badge" id="resolvedCount">0</span>
            </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Pending Issues Tab -->
            <div id="pending-issues" class="tab-pane active">
                <div class="content-header">
                    <h2>All Pending Payment Issues</h2>
                    <div class="filter-group">
                        <input type="text" id="searchPending" class="search-input" placeholder="Search by event or client...">
                    </div>
                </div>
                <div class="table-container">
                    <table class="complaints-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Client</th>
                                <th>Issue Type</th>
                                <th>Amount</th>
                                <th>Priority</th>
                                <th>Reported</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="pendingTableBody">
                            <!-- Dynamically populated -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Failed Transactions Tab -->
            <div id="failed-transactions" class="tab-pane">
                <div class="content-header">
                    <h2>Failed Transactions</h2>
                    <div class="filter-group">
                        <input type="text" id="searchFailed" class="search-input" placeholder="Search...">
                    </div>
                </div>
                <div class="table-container">
                    <table class="complaints-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Client</th>
                                <th>Amount</th>
                                <th>Failure Reason</th>
                                <th>Attempts</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="failedTableBody">
                            <!-- Dynamically populated -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Refund Requests Tab -->
            <div id="refund-requests" class="tab-pane">
                <div class="content-header">
                    <h2>Refund Requests</h2>
                    <div class="filter-group">
                        <select id="refundTypeFilter" class="filter-select">
                            <option value="">All Types</option>
                            <option value="last_minute">Last Minute Cancellation</option>
                            <option value="full">Full Refund</option>
                            <option value="partial">Partial Refund</option>
                        </select>
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
                                <th>Original Amount</th>
                                <th>Refund Type</th>
                                <th>Refund Amount</th>
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

            <!-- Payment Mismatches Tab -->
            <div id="payment-mismatches" class="tab-pane">
                <div class="content-header">
                    <h2>Payment Mismatches</h2>
                    <div class="filter-group">
                        <input type="text" id="searchMismatches" class="search-input" placeholder="Search...">
                    </div>
                </div>
                <div class="table-container">
                    <table class="complaints-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Client</th>
                                <th>Expected</th>
                                <th>Received</th>
                                <th>Difference</th>
                                <th>Reason</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="mismatchTableBody">
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

    <!-- Issue Details Modal -->
    <div id="issueModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modalTitle">Payment Issue Details</h2>
                    <button class="close-btn" onclick="closeIssueModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="modalContent">
                        <!-- Dynamically populated based on issue type -->
                    </div>
                </div>
                <div class="modal-footer" id="modalFooter">
                    <!-- Dynamically populated -->
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
                        <h3>Refund Calculation</h3>
                        <div class="refund-breakdown">
                            <div class="breakdown-row">
                                <span class="breakdown-label">Original Payment:</span>
                                <span class="breakdown-value" id="refundOriginal">$0.00</span>
                            </div>
                            <div class="breakdown-row highlight">
                                <span class="breakdown-label">Refund Type:</span>
                                <span class="breakdown-value" id="refundType">-</span>
                            </div>
                            <div class="breakdown-row" id="providerFeeRow" style="display: none;">
                                <span class="breakdown-label">Provider Compensation (15%):</span>
                                <span class="breakdown-value warning" id="providerFee">-$0.00</span>
                            </div>
                            <div class="breakdown-row total">
                                <span class="breakdown-label">Refund to Client:</span>
                                <span class="breakdown-value success" id="refundAmount">$0.00</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-group">
                            <label class="form-label">Refund Type</label>
                            <select id="refundTypeSelect" class="form-select" onchange="updateRefundCalculation()">
                                <option value="full">Full Refund (100%)</option>
                                <option value="last_minute">Last Minute Cancellation (85%)</option>
                                <option value="partial">Partial Refund (Custom)</option>
                            </select>
                        </div>

                        <div class="form-group" id="customAmountGroup" style="display: none;">
                            <label class="form-label">Custom Refund Amount</label>
                            <input type="number" id="customRefundAmount" class="form-input" step="0.01" placeholder="Enter custom amount">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Reason for Refund</label>
                            <textarea id="refundReason" class="form-textarea" rows="4" placeholder="Explain the reason for this refund..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <input type="checkbox" id="notifyClient" checked> 
                                Notify client via email
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <input type="checkbox" id="compensateProviders" checked> 
                                Compensate service providers (for last-minute cancellations)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeRefundModal()">Cancel</button>
                    <button class="btn btn-primary" onclick="processRefund()">
                        <i class="fas fa-check"></i>
                        Process Refund
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Modal -->
    <div id="verifyModal" class="modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><i class="fas fa-shield-alt"></i> Verify Issue</h2>
                    <button class="close-btn" onclick="closeVerifyModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="info-text">Verify this payment issue before proceeding with resolution.</p>
                    
                    <div class="form-group">
                        <label class="form-label">Verification Status</label>
                        <select id="verifyStatus" class="form-select">
                            <option value="verified">Issue Verified</option>
                            <option value="needs_info">Needs More Information</option>
                            <option value="invalid">Invalid Issue</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Verification Notes</label>
                        <textarea id="verifyNotes" class="form-textarea" rows="4" placeholder="Add your verification notes..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <input type="checkbox" id="notifyAdmin" checked> 
                            Notify admin team
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeVerifyModal()">Cancel</button>
                    <button class="btn btn-primary" onclick="submitVerification()">
                        <i class="fas fa-check"></i>
                        Submit Verification
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    <div id="successToast" class="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Action completed successfully!</span>
    </div>

    <script>// Mock Data - Simulating payment issues
const mockPendingIssues = [
    {
        id: 1,
        event_id: 201,
        event_name: "Corporate Annual Gala 2026",
        client_name: "Sarah Williams",
        client_email: "sarah.w@company.com",
        issue_type: "refund_request",
        amount: 45000.00,
        priority: "high",
        status: "pending",
        reason: "Last minute cancellation - CEO unavailable",
        reported_date: "2026-02-04T14:30:00",
        cancellation_type: "last_minute"
    },
    {
        id: 2,
        event_id: 202,
        event_name: "Wedding Reception - Miller",
        client_name: "Michael Chen",
        client_email: "m.chen@email.com",
        issue_type: "payment_mismatch",
        amount: 28000.00,
        expected_amount: 28000.00,
        received_amount: 25000.00,
        priority: "medium",
        status: "pending",
        reason: "Provider replacement caused price change",
        reported_date: "2026-02-03T10:15:00"
    },
    {
        id: 3,
        event_id: 203,
        event_name: "Tech Conference 2026",
        client_name: "Emily Johnson",
        client_email: "emily.j@techconf.com",
        issue_type: "failed_transaction",
        amount: 75000.00,
        priority: "high",
        status: "pending",
        reason: "Credit card declined - insufficient funds",
        reported_date: "2026-02-02T16:45:00",
        attempts: 3
    }
];

const mockFailedTransactions = [
    {
        id: 4,
        event_id: 204,
        event_name: "Birthday Party - Anderson 50th",
        client_name: "David Martinez",
        client_email: "d.martinez@email.com",
        amount: 8500.00,
        failure_reason: "Card expired",
        attempts: 2,
        last_attempt: "2026-02-05T09:30:00",
        status: "pending"
    },
    {
        id: 5,
        event_id: 205,
        event_name: "Charity Fundraiser Gala",
        client_name: "Jennifer Brown",
        client_email: "jen.brown@charity.org",
        amount: 32000.00,
        failure_reason: "Payment gateway timeout",
        attempts: 1,
        last_attempt: "2026-02-04T15:20:00",
        status: "pending"
    },
    {
        id: 6,
        event_id: 206,
        event_name: "Product Launch Event",
        client_name: "Robert Lee",
        client_email: "r.lee@startup.com",
        amount: 22000.00,
        failure_reason: "Insufficient funds",
        attempts: 4,
        last_attempt: "2026-02-03T11:45:00",
        status: "pending"
    }
];

const mockRefundRequests = [
    {
        id: 7,
        event_id: 207,
        event_name: "University Graduation Ceremony",
        client_name: "Amanda Garcia",
        client_email: "a.garcia@university.edu",
        original_amount: 55000.00,
        refund_type: "last_minute",
        refund_amount: 46750.00,
        provider_fee: 8250.00,
        requested_date: "2026-02-01T08:00:00",
        reason: "Venue double-booked, event cancelled 3 days before",
        status: "pending"
    },
    {
        id: 8,
        event_id: 208,
        event_name: "Holiday Office Party",
        client_name: "Thomas Wilson",
        client_email: "t.wilson@corp.com",
        original_amount: 15000.00,
        refund_type: "full",
        refund_amount: 15000.00,
        provider_fee: 0,
        requested_date: "2026-01-30T14:20:00",
        reason: "Event cancelled 2 weeks in advance",
        status: "pending"
    },
    {
        id: 9,
        event_id: 209,
        event_name: "Art Gallery Opening",
        client_name: "Lisa Anderson",
        client_email: "lisa.a@gallery.com",
        original_amount: 12000.00,
        refund_type: "partial",
        refund_amount: 6000.00,
        provider_fee: 6000.00,
        requested_date: "2026-02-02T16:00:00",
        reason: "Reduced guest count, partial service cancellation",
        status: "pending"
    }
];

const mockPaymentMismatches = [
    {
        id: 10,
        event_id: 210,
        event_name: "Sports Awards Banquet",
        client_name: "Kevin Taylor",
        client_email: "k.taylor@sports.org",
        expected_amount: 20000.00,
        received_amount: 18500.00,
        difference: -1500.00,
        reason: "Provider replacement - new provider charged less",
        reported_date: "2026-02-01T11:30:00",
        status: "pending"
    },
    {
        id: 11,
        event_id: 211,
        event_name: "Fashion Show Gala",
        client_name: "Sophie Martin",
        client_email: "sophie.m@fashion.com",
        expected_amount: 38000.00,
        received_amount: 42000.00,
        difference: 4000.00,
        reason: "Additional services added after quote",
        reported_date: "2026-01-29T13:45:00",
        status: "pending"
    }
];

const mockResolvedIssues = [
    {
        id: 12,
        event_id: 212,
        event_name: "Business Conference 2026",
        client_name: "Mark Johnson",
        issue_type: "refund_request",
        amount: 42000.00,
        resolution: "Full refund processed",
        resolved_by: "IC-001 (John Smith)",
        resolved_date: "2026-01-28T16:00:00",
        status: "resolved"
    },
    {
        id: 13,
        event_id: 213,
        event_name: "Summer Festival",
        client_name: "Rachel Green",
        issue_type: "failed_transaction",
        amount: 18500.00,
        resolution: "Payment retried successfully with new card",
        resolved_by: "IC-002 (Sarah Davis)",
        resolved_date: "2026-01-27T10:30:00",
        status: "resolved"
    },
    {
        id: 14,
        event_id: 214,
        event_name: "Charity Auction Night",
        client_name: "Daniel Brown",
        issue_type: "payment_mismatch",
        amount: 3500.00,
        resolution: "Difference refunded to client",
        resolved_by: "IC-001 (John Smith)",
        resolved_date: "2026-01-26T14:15:00",
        status: "resolved"
    }
];

// State
let currentIssue = null;
let filteredPending = [...mockPendingIssues];
let filteredFailed = [...mockFailedTransactions];
let filteredRefunds = [...mockRefundRequests];
let filteredMismatches = [...mockPaymentMismatches];
let filteredResolved = [...mockResolvedIssues];

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    initializeTabs();
    renderAllTables();
    updateStats();
    setupFilters();
});

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
    renderPendingIssues();
    renderFailedTransactions();
    renderRefundRequests();
    renderPaymentMismatches();
    renderResolvedIssues();
}

// Render Pending Issues
function renderPendingIssues() {
    const tbody = document.getElementById('pendingTableBody');
    
    if (filteredPending.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <p>No pending payment issues</p>
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = filteredPending.map(issue => {
        const issueTypeLabel = formatIssueType(issue.issue_type);
        return `
            <tr>
                <td class="table-id">#${issue.id}</td>
                <td class="table-event" title="${issue.event_name}">${issue.event_name}</td>
                <td class="table-client" title="${issue.client_name}">${issue.client_name}</td>
                <td><span class="type-badge ${issue.issue_type.replace('_', '-')}">${issueTypeLabel}</span></td>
                <td class="table-amount">$${issue.amount.toLocaleString()}</td>
                <td><span class="priority-badge ${issue.priority}">${issue.priority.toUpperCase()}</span></td>
                <td class="table-created">
                    <div style="font-weight: 600;">${getTimeSince(issue.reported_date)}</div>
                    <div style="color: var(--muted); font-size: 0.75rem;">${formatDate(issue.reported_date)}</div>
                </td>
                <td>
                    <button class="table-view-btn" onclick="viewIssue(${issue.id}, 'pending')" title="View Details">
                        <i class="fas fa-eye"></i>
                        <span>View</span>
                    </button>
                </td>
            </tr>
        `;
    }).join('');

    document.getElementById('pendingCount').textContent = filteredPending.length;
}

// Render Failed Transactions
function renderFailedTransactions() {
    const tbody = document.getElementById('failedTableBody');
    
    if (filteredFailed.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <p>No failed transactions</p>
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = filteredFailed.map(issue => `
        <tr>
            <td class="table-id">#${issue.id}</td>
            <td class="table-event" title="${issue.event_name}">${issue.event_name}</td>
            <td class="table-client" title="${issue.client_name}">${issue.client_name}</td>
            <td class="table-amount">$${issue.amount.toLocaleString()}</td>
            <td class="table-type">${issue.failure_reason}</td>
            <td><span class="priority-badge ${issue.attempts > 2 ? 'high' : 'medium'}">${issue.attempts}</span></td>
            <td class="table-created">
                <div style="font-weight: 600;">${getTimeSince(issue.last_attempt)}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${formatDate(issue.last_attempt)}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="viewIssue(${issue.id}, 'failed')" title="View Details">
                    <i class="fas fa-eye"></i>
                    <span>Resolve</span>
                </button>
            </td>
        </tr>
    `).join('');

    document.getElementById('failedCount').textContent = filteredFailed.length;
}

// Render Refund Requests
function renderRefundRequests() {
    const tbody = document.getElementById('refundsTableBody');
    
    if (filteredRefunds.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <p>No refund requests</p>
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = filteredRefunds.map(issue => `
        <tr>
            <td class="table-id">#${issue.id}</td>
            <td class="table-event" title="${issue.event_name}">${issue.event_name}</td>
            <td class="table-client" title="${issue.client_name}">${issue.client_name}</td>
            <td class="table-amount">$${issue.original_amount.toLocaleString()}</td>
            <td><span class="type-badge refund">${formatRefundType(issue.refund_type)}</span></td>
            <td class="table-amount positive">$${issue.refund_amount.toLocaleString()}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${getTimeSince(issue.requested_date)}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${formatDate(issue.requested_date)}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="viewRefund(${issue.id})" title="Process Refund">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Process</span>
                </button>
            </td>
        </tr>
    `).join('');

    document.getElementById('refundsCount').textContent = filteredRefunds.length;
}

// Render Payment Mismatches
function renderPaymentMismatches() {
    const tbody = document.getElementById('mismatchTableBody');
    
    if (filteredMismatches.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <p>No payment mismatches</p>
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = filteredMismatches.map(issue => {
        const diffClass = issue.difference > 0 ? 'positive' : 'negative';
        return `
            <tr>
                <td class="table-id">#${issue.id}</td>
                <td class="table-event" title="${issue.event_name}">${issue.event_name}</td>
                <td class="table-client" title="${issue.client_name}">${issue.client_name}</td>
                <td class="table-amount">$${issue.expected_amount.toLocaleString()}</td>
                <td class="table-amount">$${issue.received_amount.toLocaleString()}</td>
                <td class="table-amount ${diffClass}">${issue.difference > 0 ? '+' : ''}$${Math.abs(issue.difference).toLocaleString()}</td>
                <td class="table-type">${issue.reason}</td>
                <td>
                    <button class="table-view-btn" onclick="viewIssue(${issue.id}, 'mismatch')" title="View Details">
                        <i class="fas fa-eye"></i>
                        <span>Resolve</span>
                    </button>
                </td>
            </tr>
        `;
    }).join('');

    document.getElementById('mismatchCount').textContent = filteredMismatches.length;
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
            <td class="table-amount">$${issue.amount.toLocaleString()}</td>
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
    const totalPending = mockPendingIssues.length + mockFailedTransactions.length + 
                        mockRefundRequests.length + mockPaymentMismatches.length;
    const totalRefunds = mockRefundRequests.length;
    const totalAmount = mockPendingIssues.reduce((sum, issue) => sum + issue.amount, 0);

    // document.getElementById('pendingIssues').textContent = totalPending;
    // document.getElementById('refundRequests').textContent = totalRefunds;
    // document.getElementById('totalAmount').textContent = `$${totalAmount.toLocaleString()}`;
}

// Setup Filters
function setupFilters() {
    document.getElementById('searchPending').addEventListener('input', () => applyFilter('pending'));
    document.getElementById('searchFailed').addEventListener('input', () => applyFilter('failed'));
    document.getElementById('searchRefunds').addEventListener('input', () => applyFilter('refunds'));
    document.getElementById('refundTypeFilter').addEventListener('change', () => applyFilter('refunds'));
    document.getElementById('searchMismatches').addEventListener('input', () => applyFilter('mismatches'));
    document.getElementById('searchResolved').addEventListener('input', () => applyFilter('resolved'));
    document.getElementById('resolvedFromDate').addEventListener('change', () => applyFilter('resolved'));
    document.getElementById('resolvedToDate').addEventListener('change', () => applyFilter('resolved'));
}

// Apply Filters
function applyFilter(type) {
    const searchTerm = document.getElementById(`search${type.charAt(0).toUpperCase() + type.slice(1)}`).value.toLowerCase();
    
    if (type === 'pending') {
        filteredPending = mockPendingIssues.filter(issue => 
            issue.event_name.toLowerCase().includes(searchTerm) ||
            issue.client_name.toLowerCase().includes(searchTerm)
        );
        renderPendingIssues();
    } else if (type === 'failed') {
        filteredFailed = mockFailedTransactions.filter(issue => 
            issue.event_name.toLowerCase().includes(searchTerm) ||
            issue.client_name.toLowerCase().includes(searchTerm)
        );
        renderFailedTransactions();
    } else if (type === 'refunds') {
        const refundType = document.getElementById('refundTypeFilter').value;
        filteredRefunds = mockRefundRequests.filter(issue => {
            const matchesSearch = issue.event_name.toLowerCase().includes(searchTerm) ||
                                 issue.client_name.toLowerCase().includes(searchTerm);
            const matchesType = !refundType || issue.refund_type === refundType;
            return matchesSearch && matchesType;
        });
        renderRefundRequests();
    } else if (type === 'mismatches') {
        filteredMismatches = mockPaymentMismatches.filter(issue => 
            issue.event_name.toLowerCase().includes(searchTerm) ||
            issue.client_name.toLowerCase().includes(searchTerm)
        );
        renderPaymentMismatches();
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
    if (type === 'pending') {
        issue = mockPendingIssues.find(i => i.id === id);
    } else if (type === 'failed') {
        issue = mockFailedTransactions.find(i => i.id === id);
    } else if (type === 'mismatch') {
        issue = mockPaymentMismatches.find(i => i.id === id);
    } else if (type === 'resolved') {
        issue = mockResolvedIssues.find(i => i.id === id);
    }

    if (!issue) return;

    currentIssue = { ...issue, type };
    
    document.getElementById('modalTitle').textContent = `Payment Issue #${id}`;
    
    let content = `
        <div class="issue-details-grid">
            <div class="detail-card">
                <h4>Event Name</h4>
                <p>${issue.event_name}</p>
            </div>
            <div class="detail-card">
                <h4>Client</h4>
                <p>${issue.client_name}</p>
            </div>
            <div class="detail-card">
                <h4>Amount</h4>
                <p>$${issue.amount?.toLocaleString() || issue.original_amount?.toLocaleString()}</p>
            </div>
            <div class="detail-card">
                <h4>Status</h4>
                <p><span class="status-badge ${issue.status}">${issue.status}</span></p>
            </div>
        </div>
        <div class="form-section">
            <div class="form-group">
                <label class="form-label">Reason</label>
                <p>${issue.reason || issue.resolution || 'N/A'}</p>
            </div>
        </div>
    `;

    document.getElementById('modalContent').innerHTML = content;
    
    let footer = '';
    if (type !== 'resolved') {
        footer = `
            <button class="btn btn-secondary" onclick="closeIssueModal()">Close</button>
            <button class="btn btn-primary" onclick="openVerifyModal()">
                <i class="fas fa-shield-alt"></i>
                Verify & Resolve
            </button>
        `;
    } else {
        footer = `<button class="btn btn-secondary" onclick="closeIssueModal()">Close</button>`;
    }
    
    document.getElementById('modalFooter').innerHTML = footer;
    document.getElementById('issueModal').classList.add('active');
}

// View Refund
function viewRefund(id) {
    const refund = mockRefundRequests.find(r => r.id === id);
    if (!refund) return;

    currentIssue = refund;
    
    // Populate refund modal
    document.getElementById('refundOriginal').textContent = `$${refund.original_amount.toLocaleString()}`;
    document.getElementById('refundType').textContent = formatRefundType(refund.refund_type);
    document.getElementById('providerFee').textContent = `-$${refund.provider_fee.toLocaleString()}`;
    document.getElementById('refundAmount').textContent = `$${refund.refund_amount.toLocaleString()}`;
    
    // Set refund type
    document.getElementById('refundTypeSelect').value = refund.refund_type;
    
    // Show/hide provider fee row
    if (refund.refund_type === 'last_minute') {
        document.getElementById('providerFeeRow').style.display = 'flex';
    } else {
        document.getElementById('providerFeeRow').style.display = 'none';
    }
    
    document.getElementById('refundReason').value = refund.reason;
    
    document.getElementById('refundModal').classList.add('active');
}

// Update Refund Calculation
function updateRefundCalculation() {
    if (!currentIssue) return;
    
    const refundType = document.getElementById('refundTypeSelect').value;
    const originalAmount = currentIssue.original_amount;
    let refundAmount, providerFee;
    
    if (refundType === 'full') {
        refundAmount = originalAmount;
        providerFee = 0;
        document.getElementById('providerFeeRow').style.display = 'none';
        document.getElementById('customAmountGroup').style.display = 'none';
    } else if (refundType === 'last_minute') {
        refundAmount = originalAmount * 0.85;
        providerFee = originalAmount * 0.15;
        document.getElementById('providerFeeRow').style.display = 'flex';
        document.getElementById('customAmountGroup').style.display = 'none';
    } else if (refundType === 'partial') {
        document.getElementById('providerFeeRow').style.display = 'none';
        document.getElementById('customAmountGroup').style.display = 'block';
        refundAmount = parseFloat(document.getElementById('customRefundAmount').value) || 0;
        providerFee = originalAmount - refundAmount;
    }
    
    document.getElementById('refundType').textContent = formatRefundType(refundType);
    document.getElementById('providerFee').textContent = `-$${providerFee.toLocaleString()}`;
    document.getElementById('refundAmount').textContent = `$${refundAmount.toLocaleString()}`;
}

// Process Refund
function processRefund() {
    const reason = document.getElementById('refundReason').value;
    const notifyClient = document.getElementById('notifyClient').checked;
    const compensateProviders = document.getElementById('compensateProviders').checked;
    
    if (!reason.trim()) {
        alert('Please provide a reason for the refund');
        return;
    }
    
    // Simulate refund processing
    showToast('Refund processed successfully!');
    
    // Move to resolved
    const index = mockRefundRequests.findIndex(r => r.id === currentIssue.id);
    if (index > -1) {
        const resolved = {
            id: currentIssue.id,
            event_id: currentIssue.event_id,
            event_name: currentIssue.event_name,
            client_name: currentIssue.client_name,
            issue_type: 'refund_request',
            amount: currentIssue.refund_amount,
            resolution: `Refund processed: $${currentIssue.refund_amount.toLocaleString()}`,
            resolved_by: 'IC-001 (Current User)',
            resolved_date: new Date().toISOString(),
            status: 'resolved'
        };
        
        mockRefundRequests.splice(index, 1);
        mockResolvedIssues.unshift(resolved);
    }
    
    closeRefundModal();
    renderAllTables();
    updateStats();
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
        
        // Move to resolved
        if (currentIssue.type === 'pending') {
            const index = mockPendingIssues.findIndex(i => i.id === currentIssue.id);
            if (index > -1) {
                const resolved = {
                    id: currentIssue.id,
                    event_id: currentIssue.event_id,
                    event_name: currentIssue.event_name,
                    client_name: currentIssue.client_name,
                    issue_type: currentIssue.issue_type,
                    amount: currentIssue.amount,
                    resolution: notes,
                    resolved_by: 'IC-001 (Current User)',
                    resolved_date: new Date().toISOString(),
                    status: 'resolved'
                };
                
                mockPendingIssues.splice(index, 1);
                mockResolvedIssues.unshift(resolved);
            }
        }
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
        'refund_request': 'Refund Request',
        'failed_transaction': 'Failed Transaction',
        'payment_mismatch': 'Payment Mismatch',
        'partial_payment': 'Partial Payment'
    };
    return types[type] || type;
}

function formatRefundType(type) {
    const types = {
        'full': 'Full Refund (100%)',
        'last_minute': 'Last Minute (85%)',
        'partial': 'Partial Refund'
    };
    return types[type] || type;
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
    if (e.target.id === 'verifyModal') closeVerifyModal();
});

// Custom amount input listener
document.getElementById('customRefundAmount').addEventListener('input', updateRefundCalculation);
</script>
</body>
</html>

  <?php require APPROOT . '/views/inc/footer.php'; ?>