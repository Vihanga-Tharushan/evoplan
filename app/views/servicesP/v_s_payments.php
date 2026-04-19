<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php //require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar1.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_payments.css">

<style>
  :root {
    --primary: #4B006E;
    --secondary: #6F1A8C;
    --dark: #0b1026;
    --light: #f7f8fc;
    --text: #111827;
    --muted: #6b7280;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --border: #e5e7eb;
    --shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    --shadow-hover: 0 6px 12px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
    --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    --card-shadow-hover: 0 6px 16px rgba(0, 0, 0, 0.12);
    --radius: 16px;         /* Border radius */
    --radius-sm: 8px;       /* Small border radius */
    --sidebar-width: 280px;
    --header-height: 72px;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: var(--light);
    color: var(--text);
    
}

.main {
    flex: 1;
    margin-top: 50px;
    margin-left: 270px;
    transition: margin-left 0.3s ease;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

/* Header */
.header {
    margin-bottom: 32px;
}

.header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 8px;
}

.subtitle {
    color: var(--muted);
    font-size: 1rem;
}

/* Tabs */
.tabs-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 24px;
}

.tabs {
    display: flex;
    border-bottom: 1px solid #e5e7eb;
}

.tab {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 16px 24px;
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    color: var(--muted);
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    position: relative;
    font-size: 16px;
}

.tab:hover {
    color: var(--text);
}

.tab.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
}

.tab .icon {
    font-size: 20px;
}

.badge {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
}

.badge-success {
    background-color: var(--success);
}

/* Tab Content */
.tab-content {
    display: none;
    animation: fadeIn 0.3s ease;
}

.tab-content.active {
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

/* Summary Stats */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.summary-card {
    background: white;
    padding: 24px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: var(--transition);
    border: 1px solid var(--border);
}

.summary-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
}

.summary-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 28px;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.2);
}

.summary-content {
    flex: 1;
}

.summary-label {
    color: var(--muted);
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.summary-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 4px;
}

.summary-subtitle {
    font-size: 0.875rem;
    color: var(--muted);
}

/* Table Container */
.table-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(75, 0, 110, 0.1);
    overflow: hidden;
}

.table-header-section {
    padding: 15px;
    border-bottom: 2px solid var(--border);
    
}

.table-header-section h3 {
    font-size: 1.55rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 4px;
}

.table-header-section p {
    color: var(--muted);
    font-size: 0.875rem;
}

/* Table Styles */
.earnings-table {
    width: 100%;
    border-collapse: collapse;
}

.earnings-table thead {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
}

.earnings-table thead th {
    padding: 16px 12px;
    text-align: left;
    font-weight: 700;
    font-size: 0.875rem;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
}

.earnings-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #e2e8f0;
}

.earnings-table tbody tr:hover {
    background: linear-gradient(135deg, rgba(248, 250, 252, 0.8) 0%, rgba(241, 245, 249, 0.6) 100%);
    transform: translateX(4px);
    box-shadow: 4px 0 12px rgba(75, 0, 110, 0.1);
}

.earnings-table tbody tr:last-child {
    border-bottom: none;
}

.earnings-table td {
    padding: 16px 12px;
    vertical-align: middle;
    font-size: 0.875rem;
    color: var(--text);
}

.amount {
    font-weight: 700;
    color: var(--success);
    font-size: 1rem;
}

.transaction-id {
    font-family: 'Monaco', 'Menlo', monospace;
    font-weight: 600;
    color: var(--primary);
}

.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}

.status-completed {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
}

.status-pending {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning);
}

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

/* System Description */
.system-description {
    background: rgba(248, 250, 252, 0.8);
    border: 1px solid rgba(226, 232, 240, 0.6);
    border-radius: 8px;
    padding: 16px 20px;
    margin: 28px 0 24px 0;
    backdrop-filter: blur(10px);
}

.system-description p {
    color: var(--muted);
    font-size: 0.975rem;
    line-height: 1.6;
    margin: 0;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.info-icon {
    color: var(--primary);
    font-size: 18px;
    margin-top: 2px;
    flex-shrink: 0;
}

/* Payment Details Container */
.payment-details-container {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.payment-request-container {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.card {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        overflow: hidden;
        border: 1px solid var(--border);
        margin-bottom: 20px;
    }

    .card:hover {
        box-shadow: var(--card-shadow-hover);
        transform: translateY(-3px);
    }

    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--light-gray);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

/* Large Detail Card */
.detail-card-large {
    background: white;
    border-radius: 12px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    overflow: hidden;
}

.card-header-large {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 24px;
    border-bottom: 2px solid var(--border);
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.card-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-radius: 12px;
    font-size: 24px;
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.2);
}

.card-header-large h3 {
    font-size: 1.55rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 4px;
}

.card-header-large p {
    color: var(--muted);
    font-size: 0.975rem;
}

/* Alert Box */
.alert {
    padding: 16px 20px;
    border-radius: 8px;
    margin: 24px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    border-left: 4px solid;
}

.alert-icon {
    font-size: 20px;
    margin-top: 2px;
}

.alert-content {
    flex: 1;
}

.alert-title {
    font-weight: 600;
    margin-bottom: 4px;
    font-size: 0.95rem;
}

.alert-text {
    font-size: 0.975rem;
    line-height: 1.5;
}

.alert-info {
    background: rgba(59, 130, 246, 0.1);
    border-color: #3b82f6;
    color: #1e40af;
}

.alert-warning {
    background: rgba(245, 158, 11, 0.1);
    border-color: var(--warning);
    color: #92400e;
}

/* Form Styles */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    padding: 24px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 0 24px;
}

.form-group label,
.pin-label {
    font-size: 0.975rem;
    font-weight: 600;
    color: var(--text);
}

.form-group input,
.form-group select,
.form-select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border);
    border-radius: 8px;
    font-size: 15px;
    color: var(--text);
    background: white;
    transition: var(--transition);
    font-family: inherit;
}

.form-group input:focus,
.form-group select:focus,
.form-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
}

/* PIN Input */
.pin-section {
    padding: 24px;
}

.pin-input-group {
    display: flex;
    gap: 12px;
    margin: 12px 0;
}

.pin-input {
    width: 60px;
    height: 60px;
    font-size: 24px;
    text-align: center;
    font-weight: 700;
    border: 2px solid var(--border);
    border-radius: 8px;
    transition: all 0.3s ease;
    color: var(--text);
    background: white;
}

.pin-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
}

.pin-input.filled {
    border-color: var(--primary);
    background: rgba(75, 0, 110, 0.05);
}

.pin-helper {
    font-size: 12px;
    color: var(--muted);
    margin-top: 8px;
}

/* Buttons */
.button-group {
    display: flex;
    gap: 12px;
    padding: 24px;
}

.btn {
    padding: 12px 28px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    justify-content: center;
}

.btn-primary {
    background: var(--primary);
    color: white;
    margin: 0 24px 24px 24px;
}

.btn-primary:hover {
    background: var(--secondary);
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
}

.btn-success {
    background: var(--success);
    color: white;
}

.btn-success:hover {
    background: #059669;
    box-shadow: var(--shadow-hover);
}

.btn-secondary {
    background: var(--light);
    color: var(--text);
    border: 2px solid var(--border);
}

.btn-secondary:hover {
    background: #e5e7eb;
}

.btn-icon {
    font-size: 16px;
}

/* Process Steps */
.process-steps {
    list-style: none;
    padding: 24px;
}

.process-steps li {
    display: flex;
    gap: 20px;
    margin-bottom: 24px;
    align-items: flex-start;
}

.process-steps li:last-child {
    margin-bottom: 0;
}

.step-number {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border-radius: 50%;
    font-weight: 700;
    font-size: 18px;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.2);
}

.step-content {
    flex: 1;
    padding-top: 8px;
}

.step-content strong {
    color: var(--text);
    display: block;
    margin-bottom: 4px;
}

/* Modal */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    padding: 24px;
}

.modal-content {
    background: white;
    border-radius: 12px;
    max-width: 800px;
    width: 100%;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
}

.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 24px;
    border-bottom: 1px solid var(--border);
}

.modal-title-section {
    display: flex;
    align-items: center;
    gap: 16px;
}

.modal-title-section h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text);
}

.close-btn {
    padding: 8px;
    background: none;
    border: none;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.3s;
    font-size: 20px;
    color: var(--muted);
}

.close-btn:hover {
    background: var(--light);
}

.modal-body {
    flex: 1;
    overflow-y: auto;
    padding: 24px;
}

.modal-section {
    margin-bottom: 32px;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
}

.section-icon {
    font-size: 28px;
    color: var(--primary);
}

.section-header h3 {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--text);
}

.description-box {
    background: linear-gradient(135deg, #fffbf0 0%, #fef9f3 100%);
    border: 2px solid #fde68a;
    border-radius: 12px;
    padding: 28px 24px;
    box-shadow: 0 4px 20px rgba(75, 0, 110, 0.06);
}

.description-box p {
    color: var(--text);
    line-height: 1.8;
    font-size: 1.05rem;
    font-weight: 500;
    margin: 0;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-top: 32px;
}

.detail-card-modal {
    background: white;
    padding: 24px;
    border-radius: 12px;
    border: 1px solid var(--border);
    box-shadow: 0 2px 12px rgba(75, 0, 110, 0.06);
    transition: all 0.3s ease;
}

.detail-card-modal:hover {
    border-color: var(--primary);
    box-shadow: 0 8px 24px rgba(75, 0, 110, 0.12);
    transform: translateY(-2px);
}

.detail-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--light);
}

.detail-icon {
    font-size: 20px;
}

.detail-header h4 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text);
}

.detail-content {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.detail-content label {
    display: inline;
    font-size: 0.75rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 1.2px;
    font-weight: 800;
}

.detail-content label::after {
    content: ':';
    margin-right: 8px;
}

.detail-content p {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text);
    display: inline;
    margin: 0;
}

.modal-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding: 24px;
    border-top: 1px solid var(--border);
    background: var(--light);
}

/* KPI Cards */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.kpi-card {
    background: white;
    border-radius: var(--radius-sm);
    padding: 20px;
    box-shadow: var(--card-shadow);
    transition: var(--transition);
    display: flex;
    flex-direction: column;
}

.kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--card-shadow-hover);
}

.kpi-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.kpi-title {
    color: var(--text);
    font-size: 1.2rem;
    font-weight: 500;
}

.kpi-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.kpi-icon.primary { background: rgba(75, 0, 110, 0.1); color: var(--primary); }
.kpi-icon.success { background: rgba(16, 185, 129, 0.1); color: var(--success); }
.kpi-icon.warning { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
.kpi-icon.danger { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

.kpi-value {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 4px;
}

.kpi-change {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    font-weight: 600;
}

.kpi-change.positive { color: var(--success); }
.kpi-change.negative { color: var(--danger); }
.kpi-change.warning { color: var(--warning); }

.kpi-change i {
    margin-right: 4px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .main {
        margin-left: 0;
        margin-top: 0;
    }

    .container {
        padding: 16px;
    }

    .tabs {
        flex-wrap: wrap;
    }

    .tab {
        flex: 1 1 auto;
        min-width: 150px;
        padding: 12px 16px;
        font-size: 0.875rem;
    }

    .summary-grid {
        grid-template-columns: 1fr;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    .details-grid {
        grid-template-columns: 1fr;
    }

    .table-container {
        overflow-x: auto;
    }

    .earnings-table {
        min-width: 800px;
    }

    .button-group {
        flex-direction: column;
    }

    .btn {
        width: 100%;
    }

    .pin-input {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .header h1 {
        font-size: 1.5rem;
    }

    .summary-value {
        font-size: 1.5rem;
    }

    .pin-input {
        width: 45px;
        height: 45px;
        font-size: 18px;
    }
}

</style>

<body>
    <div class="main">
        <!-- Main Container -->
        <div class="container">
            
            <!-- Tabs Navigation -->

            <div class="tabs-container">
                <div class="tabs">
                    <button class="tab active" data-tab="earnings" onclick="switchTab('earnings')">
                        <i class="fa fa-wallet"></i>
                        My Earnings
                        <span class="badge badge-success" id="earnings-count">6</span>
                    </button>
                    <button class="tab" data-tab="payment-setup" onclick="switchTab('payment-setup')">
                        <i class="fa fa-credit-card"></i>
                        Payment Details
                    </button>
                    <button class="tab" data-tab="pin-enter" onclick="switchTab('pin-enter')">
                        <i class="fa fa-lock"></i>
                        Request Payment
                    </button>
                </div>
            </div>

            <!-- TAB 1: MY EARNINGS -->
            <div id="earnings" class="tab-content active">
                
                <!-- KPI Section -->
                <div class="kpi-grid">
                            <div class="kpi-card">
                                <div class="kpi-header">
                                    <div class="kpi-title">Total Earnings</div>
                                    <div class="kpi-icon primary">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                </div>
                                <div class="kpi-value">Rs. <?php echo $data['totalEarnings']; ?></div>
                                <div class="kpi-change positive">
                                </div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-header">
                                    <div class="kpi-title">Pending Payment</div>
                                    <div class="kpi-icon warning">
                                        <i class="fas fa-hourglass-half"></i>
                                    </div>
                                </div>
                                <div class="kpi-value">Rs. <?php echo $data['pendingPayments']; ?></div>
                                <div class="kpi-change positive">
                                </div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-header">
                                    <div class="kpi-title">Paid Out</div>
                                    <div class="kpi-icon success">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                </div>
                                <div class="kpi-value">Rs. <?php echo $data['paidoutPayments']; ?></div>
                                <div class="kpi-change positive">
                                </div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-header">
                                    <div class="kpi-title">Total Events Completed</div>
                                    <div class="kpi-icon primary">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                                <div class="kpi-value"><?php echo $data['totalEventCompleted']; ?></div>
                                <div class="kpi-change positive">
                                </div>
                            </div>
                        </div>    

                <!-- Events Income Table -->
                <div class="table-container">
                    <div class="table-header-section">
                        <h3>Income From Events</h3>
                    </div>
                    <table id="earnings-table" class="earnings-table">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Event Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="earnings-container">
                            <!-- Populated by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- System Info
                <div class="system-description">
                    <p><i class="fas fa-info-circle"></i> Your earnings are calculated based on completed events. Pending payments will be processed within 3-5 business days after event completion. You can request payment for pending amounts using the "Request Payment" tab.</p>
                </div> -->
            </div>

            <!-- TAB 2: PAYMENT DETAILS -->
            <div id="payment-setup" class="tab-content">
                <div class="payment-details-container">
                    <!-- Bank Account Card -->
                    <div class="detail-card-large">
                        <div class="card-header-large">
                            <div class="kpi-icon primary">
                            <i class="fas fa-university"></i>
                            </div>
                            <div>
                                <h3>Bank Account Details</h3>
                                <p>Manage your bank information for payment transfers</p>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <div class="kpi-icon primary">
                            <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="alert-content">
                                <div class="alert-title">Bank Details Information</div>
                                <div class="alert-text">Your bank details are securely stored and only used for payment transfers. Verify all information is accurate to avoid payment delays.</div>
                            </div>
                        </div>

                        <!-- Display Mode -->
                        <div id="bankDetailsDisplay" style="padding: 24px;">
                            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                                <div>
                                    <label style="font-size: 0.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1.2px; font-weight: 800;">Bank Name</label>
                                    <p id="displayBankName" style="font-size: 1rem; font-weight: 600; color: var(--text); margin-top: 8px;">-</p>
                                </div>
                                <div>
                                    <label style="font-size: 0.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1.2px; font-weight: 800;">Account Holder Name</label>
                                    <p id="displayAccountHolder" style="font-size: 1rem; font-weight: 600; color: var(--text); margin-top: 8px;">-</p>
                                </div>
                                <div>
                                    <label style="font-size: 0.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1.2px; font-weight: 800;">Account Number</label>
                                    <p id="displayAccountNumber" style="font-size: 1rem; font-weight: 600; color: var(--text); margin-top: 8px;">-</p>
                                </div>
                                <div>
                                    <label style="font-size: 0.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1.2px; font-weight: 800;">Branch Name</label>
                                    <p id="displayBranchName" style="font-size: 1rem; font-weight: 600; color: var(--text); margin-top: 8px;">-</p>
                                </div>
                            </div>
                            <button class="btn btn-primary" onclick="toggleEditMode(true)" style="margin-top: 20px;">
                                <i class="fas fa-edit"></i>
                                Update Details
                            </button>
                        </div>

                        <!-- Edit Mode -->
                        <div id="bankDetailsForm" style="display: none;">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Bank Name *</label>
                                   <select id="bankName">
                                        <option value="">Select your bank...</option>
                                        <option value="Bank of Ceylon" <?php echo (isset($data['bankdetails']->bankName) && $data['bankdetails']->bankName === 'Bank of Ceylon') ? 'selected' : ''; ?>>Bank of Ceylon</option>
                                        <option value="Commercial Bank" <?php echo (isset($data['bankdetails']->bankName) && $data['bankdetails']->bankName === 'Commercial Bank') ? 'selected' : ''; ?>>Commercial Bank</option>
                                        <option value="Hatton National Bank" <?php echo (isset($data['bankdetails']->bankName) && $data['bankdetails']->bankName === 'Hatton National Bank') ? 'selected' : ''; ?>>Hatton National Bank</option>
                                        <option value="Sampath Bank" <?php echo (isset($data['bankdetails']->bankName) && $data['bankdetails']->bankName === 'Sampath Bank') ? 'selected' : ''; ?>>Sampath Bank</option>
                                        <option value="People's Bank" <?php echo (isset($data['bankdetails']->bankName) && $data['bankdetails']->bankName === "People's Bank") ? 'selected' : ''; ?>>People's Bank</option>
                                        <option value="National Savings Bank" <?php echo (isset($data['bankdetails']->bankName) && $data['bankdetails']->bankName === 'National Savings Bank') ? 'selected' : ''; ?>>National Savings Bank</option>
                                        <option value="Pan Asia Bank" <?php echo (isset($data['bankdetails']->bankName) && $data['bankdetails']->bankName === 'Pan Asia Bank') ? 'selected' : ''; ?>>Pan Asia Bank</option>
                                        <option value="NSB Bank" <?php echo (isset($data['bankdetails']->bankName) && $data['bankdetails']->bankName === 'NSB Bank') ? 'selected' : ''; ?>>NSB Bank</option>
                                        <option value="Union Bank" <?php echo (isset($data['bankdetails']->bankName) && $data['bankdetails']->bankName === 'Union Bank') ? 'selected' : ''; ?>>Union Bank</option>
                                   </select>
                                </div>

                                <div class="form-group">
                                    <label>Account Holder Name *</label>
                                    <input type="text" id="accountHolder" placeholder="Full name as per bank records" value="<?php echo $data['bankdetails']->accountHolderName ?? ''; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Account Number *</label>
                                    <input type="text" id="accountNumber" placeholder="Your account number" value="<?php echo $data['bankdetails']->accountNumber ?? ''; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Branch Name *</label>
                                    <input type="text" id="branchName" placeholder="e.g., Colombo Main Branch" value="<?php echo $data['bankdetails']->branchName ?? ''; ?>">
                                </div>
                            </div>

                            <div style="display: flex; gap: 12px; padding: 24px; padding-top: 0;">
                                <button class="btn btn-primary" onclick="saveBankDetails()">
                                    <i class="fas fa-save"></i>
                                    Save Changes
                                </button>
                                <button class="btn btn-secondary" onclick="toggleEditMode(false)">
                                    <i class="fas fa-times"></i>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: REQUEST PAYMENT -->
            <div id="pin-enter" class="tab-content">
                <div class="payment-request-container">
                    <!-- PIN Entry Card -->
                    <div class="detail-card-large">
                        <div class="card-header-large">
                            <div class="kpi-icon primary">
                            <i class="fas fa-lock"></i>
                            </div>
                            <div>
                                <h3>Request Payment Access</h3>
                                <p>Enter your security PIN to initiate a payment request</p>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div class="alert-content">
                                <div class="alert-title">Important: PIN Requirement</div>
                                <div class="alert-text">You must obtain a 6-digit PIN from the Client to process payment requests. This PIN prevents unauthorized payment requests and protects your account. Do not share this PIN with anyone.</div>
                            </div>
                        </div>

                        <div class="pin-section">
                            <label class="pin-label">PIN Code</label>
                            <div class="pin-input-group" id="pinInputGroup">
                                <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="0">
                                <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="1">
                                <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="2">
                                <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="3">
                                <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="4">
                                <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="5">
                            </div>
                            <p class="pin-helper">Enter the 6-digit PIN provided by your Client</p>
                        </div>

                        <div id="pinAlert" style="display: none;"></div>

                        <div class="form-group">
                            <label>Select Event for Payment</label>
                            <select id="paymentEventSelect" class="form-select">
                                <option value="">Select an event...</option>
                                <option value="1">Smith Wedding Reception - Rs. 8,000</option>
                                <option value="2">Corporate Gala 2025 - Rs. 12,500</option>
                                <option value="3">Birthday Bash - Rohit - Rs. 5,800</option>
                                <option value="4">Annual Company Dinner - Rs. 7,500</option>
                                <option value="5">Johnson Family Anniversary - Rs. 4,200</option>
                                <option value="6">Charity Gala Event - Rs. 7,800</option>
                            </select>
                        </div>


                        <div class="button-group">
                            <button class="btn btn-success" id="submitPaymentBtn" onclick="submitPaymentRequest()">
                                <i class="fas fa-paper-plane"></i>
                                Request Payment
                            </button>
                            <button class="btn btn-secondary" id="resetPinBtn" onclick="resetPin()">
                                <i class="fas fa-redo"></i>
                                Clear
                            </button>
                        </div>
                    </div>

                    <!-- Payment Process Guide -->
                    <div class="detail-card-large">
                        <div class="card-header-large">
                            <i class="fas fa-clipboard-list"></i>
                            <div>
                                <h3>Payment Process Guide</h3>
                                <p>Follow these steps to request your payment</p>
                            </div>
                        </div>

                        <ol class="process-steps">
                            <li>
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <strong>Verify Bank Details:</strong> Ensure your bank account information is accurate and up-to-date.
                                </div>
                            </li>
                            <li>
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <strong>Obtain PIN:</strong> After finishing the event, contact your Client to get your unique 6-digit payment PIN.
                                </div>
                            </li>
                            <li>
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <strong>Enter PIN:</strong> Input the PIN in the payment request section above.
                                </div>
                            </li>
                            <li>
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <strong>Request Payment:</strong> Click "Request Payment" to submit your payment request.
                                </div>
                            </li>
                            <li>
                                <div class="step-number">5</div>
                                <div class="step-content">
                                    <strong>Confirmation:</strong> You'll receive an email confirmation within 2-4 hours.
                                </div>
                            </li>
                            <li>
                                <div class="step-number">6</div>
                                <div class="step-content">
                                    <strong>Payment Transfer:</strong> Funds will be transferred to your account within 1-3 business days.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div id="event-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title-section">
                    <h2 id="modal-title">Event Details</h2>
                    <span id="modal-status" class="status-badge">Completed</span>
                </div>
                <button class="close-btn" onclick="closeModal()">
                    <i class="close-icon">✕</i>
                </button>
            </div>

            <div class="modal-body">
                <div class="modal-section">
                    <div class="section-header">
                        <i class="fas fa-calendar-check section-icon"></i>
                        <h3 id="modal-event-name">Event Name</h3>
                    </div>
                    <div class="description-box">
                        <p id="modal-description">Event description will appear here...</p>
                    </div>
                </div>

                <div class="details-grid">
                    <div class="detail-card-modal">
                        <div class="detail-header">
                            <i class="fas fa-chart-bar detail-icon"></i>
                            <h4>Payment Information</h4>
                        </div>
                        <div class="detail-content">
                            <label>Amount</label>
                            <p id="modal-amount">Rs. 0</p>
                            <label>Status</label>
                            <p id="modal-payment-status">Pending</p>
                        </div>
                    </div>

                    <div class="detail-card-modal">
                        <div class="detail-header">
                            <i class="fas fa-calendar-check detail-icon"></i>
                            <h4>Event Timeline</h4>
                        </div>
                        <div class="detail-content">
                            <label>Event Date</label>
                            <p id="modal-date">N/A</p>
                            <label>Payment Date</label>
                            <p id="modal-payment-date">Pending</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
// Earnings Data Storage
const URLROOT = "<?php echo URLROOT; ?>";
const serviceId = "<?php echo $_SESSION['service_id'] ?? ''; ?>";
let earningsData = [];

// Global State
let currentTab = 'earnings';
let currentEvent = null;



// Helper function to capitalize first letter
function Capitalize(str) {
    if (!str) return 'Not specified';
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}


function getAllpayments(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", URLROOT + "/Service/getAllPayments", true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            // Store the fetched payments in earningsData
            if (response.allPayments && Array.isArray(response.allPayments)) {
                earningsData = response.allPayments;
                renderEarnings();
            }
        } else {
            console.error("Error fetching payments: " + xhr.status);
        }
    };
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify({ serviceId: serviceId }));
}


// Initialize App
document.addEventListener('DOMContentLoaded', function() {
    getAllpayments();
    initializePinInputs();
    loadBankDetails();
});

// Switch Tab Function
function switchTab(tab) {
    currentTab = tab;
    
    // Update active tab UI
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(t => {
        if (t.getAttribute('data-tab') === tab) {
            t.classList.add('active');
        } else {
            t.classList.remove('active');
        }
    });
    
    // Show/hide tab content
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        if (content.id === tab) {
            content.classList.add('active');
        } else {
            content.classList.remove('active');
        }
    });
}

// Render Earnings Table
function renderEarnings() {
    const container = document.getElementById('earnings-container');
    
    if (earningsData.length === 0) {
        container.innerHTML = `
            <tr>
                <td colspan="6" style="text-align: center; padding: 48px; color: var(--muted);">
                    No earnings data available
                </td>
            </tr>
        `;
        return;
    }
    
    container.innerHTML = earningsData.map(earning => createEarningRow(earning)).join('');
    populateEventDropdown();
}

// Populate Event Dropdown dynamically
function populateEventDropdown() {
    const dropdown = document.getElementById('paymentEventSelect');
    dropdown.innerHTML = '<option value="">Select an event...</option>';
    
    // Get unique events based on event_id
    const uniqueEvents = new Map();
    earningsData.forEach(payment => {
        if (!uniqueEvents.has(payment.event_id)) {
            uniqueEvents.set(payment.event_id, {
                event_id: payment.event_id,
                event_name: payment.event_name,
                amount: payment.amount
            });
        }
    });
    
    // Add options for each unique event
    uniqueEvents.forEach(event => {
        const amount = parseFloat(event.amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        const eventDisplay = event.event_name ? event.event_name : `Event #${event.event_id}`;
        const option = document.createElement('option');
        option.value = event.event_id;
        option.textContent = `${eventDisplay} - Rs. ${amount}`;
        dropdown.appendChild(option);
    });
}

// Create Earning Table Row HTML
function createEarningRow(earning) {
    const statusClass = earning.payment_status === 'COMPLETED' ? 'status-completed' : 'status-pending';
    const statusText = earning.payment_status === 'COMPLETED' ? 'Completed' : 'Pending';
    const createdDate = new Date(earning.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    const amount = parseFloat(earning.amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    
    // Use event_name if available, otherwise fallback to event_id
    const eventDisplay = earning.event_name ? earning.event_name : `Event #${earning.event_id}`;
    const eventType = Capitalize(earning.event_type || 'N/A');
    
    return `
        <tr class="earning-row">
            <td><strong>${eventDisplay}</strong></td>
            <td>${createdDate}</td>
            <td>${eventType}</td>
            <td class="amount">Rs. ${amount}</td>
            <td><span class="status-badge ${statusClass}">${statusText}</span></td>
            <td>
                <button class="table-view-btn" onclick="openEventModal(${earning.payment_id})" title="View Details">
                    <i class="fas fa-eye"></i>
                    <span>View</span>
                </button>
            </td>
        </tr>
    `;
}

// Open Event Modal
function openEventModal(paymentId) {
    currentEvent = earningsData.find(e => e.payment_id === paymentId);
    if (!currentEvent) return;
    
    // Populate modal
    populateModal(currentEvent);
    
    // Show modal
    document.getElementById('event-modal').style.display = 'flex';
}

// Populate Modal with Event Data
function populateModal(payment) {
    const statusClass = payment.payment_status === 'COMPLETED' ? 'status-completed' : 'status-pending';
    const statusText = payment.payment_status === 'COMPLETED' ? 'Completed' : 'Pending';
    const createdDate = new Date(payment.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    const amount = parseFloat(payment.amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    const paymentType = payment.payment_type === 'FULL_PAYMENT' ? 'Full Payment' : 'Refund';
    
    // Event details
    const eventName = payment.event_name ? payment.event_name : `Event #${payment.event_id}`;
    const eventType = Capitalize(payment.event_type || 'Not specified');
    const location = payment.venue_address || 'Not specified';
    const guestCount = payment.guest_count || 'N/A';
    
    // Event date formatting
    const eventDate = payment.start_datetime 
        ? new Date(payment.start_datetime).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })
        : 'N/A';
    const eventTime = payment.start_datetime
        ? new Date(payment.start_datetime).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })
        : 'N/A';
    
    // Populate modal header
    document.getElementById('modal-title').textContent = eventName;
    document.getElementById('modal-status').textContent = statusText;
    document.getElementById('modal-status').className = `status-badge ${statusClass}`;
    
    // Populate modal event info
    document.getElementById('modal-event-name').textContent = eventName;
    document.getElementById('modal-description').innerHTML = `<strong>${eventType}</strong> | Payment Status: ${statusText}`;
    document.getElementById('modal-amount').textContent = `Rs. ${amount}`;
    document.getElementById('modal-payment-status').textContent = statusText;
    document.getElementById('modal-date').textContent = createdDate;
    
    // Payment date
    const paidDate = payment.paid_at ? new Date(payment.paid_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }) : 'Pending';
    document.getElementById('modal-payment-date').textContent = paidDate;
    
    // Add event details to modal if they exist (you may need to add these elements to your modal HTML)
    displayEventDetailsInModal(eventDate, eventTime, location, guestCount, payment.event_description);
}

// Helper function to display event details in modal (optional enhancement)
function displayEventDetailsInModal(date, time, location, guests, description) {
    // This function can be enhanced to populate additional DOM elements with event details
    // For now, the main details are shown in the title and description
    console.log('Event Details:', { date, time, location, guests });
}

// Close Modal
function closeModal() {
    document.getElementById('event-modal').style.display = 'none';
    currentEvent = null;
}

// Close modal when clicking outside
window.addEventListener('click', (e) => {
    const modal = document.getElementById('event-modal');
    if (e.target === modal) {
        closeModal();
    }
});

// update bank details using AJAX

function updateBankDetails() {
    const bankName = document.getElementById('bankName').value.trim();
    const accountHolder = document.getElementById('accountHolder').value.trim();
    const accountNumber = document.getElementById('accountNumber').value.trim();
    const branchName = document.getElementById('branchName').value.trim();
    
    if (!bankName || !accountHolder || !accountNumber || !branchName) {
        alert('Please fill in all bank details fields');
        return;
    }
    
    const xhr = new XMLHttpRequest();
    xhr.open("POST", URLROOT + "/Service/updateBankDetails", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Update display with new values
                document.getElementById('displayBankName').textContent = bankName;
                document.getElementById('displayAccountHolder').textContent = accountHolder;
                document.getElementById('displayAccountNumber').textContent = accountNumber;
                document.getElementById('displayBranchName').textContent = branchName;
                
                // Switch back to display mode
                toggleEditMode(false);
                
                // Show success message
                alert('Bank details updated successfully!');
            } else {
                alert('Failed to update bank details. Please try again.');
            }
        } else {
            alert('Error updating bank details: ' + xhr.status);
        }
    };

    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify({
        serviceId: serviceId,
        bankName: bankName,
        accountHolder: accountHolder,
        accountNumber: accountNumber,
        branchName: branchName
    }));
}

// Save Bank Details with AJAX
function saveBankDetails() {
    const bankNameSelect = document.getElementById('bankName');
    const bankName = bankNameSelect ? bankNameSelect.value.trim() : '';
    const accountHolder = document.getElementById('accountHolder').value.trim();
    const accountNumber = document.getElementById('accountNumber').value.trim();
    const branchName = document.getElementById('branchName').value.trim();
    
    if (!bankName || !accountHolder || !accountNumber || !branchName) {
        alert('Please fill in all bank details fields');
        return;
    }
    
    // Send AJAX request to update database
    const xhr = new XMLHttpRequest();
    xhr.open('POST', URLROOT + '/Service/updateBankDetails', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Update display with new values
                document.getElementById('displayBankName').textContent = bankName;
                document.getElementById('displayAccountHolder').textContent = accountHolder;
                document.getElementById('displayAccountNumber').textContent = accountNumber;
                document.getElementById('displayBranchName').textContent = branchName;
                
                // Switch back to display mode
                toggleEditMode(false);
                
                // Show success message
                alert('Bank details saved successfully!');
            } else {
                alert('Error: ' + (response.message || 'Failed to save bank details'));
            }
        } else {
            alert('Error: Server error ' + xhr.status);
        }
    };
    
    xhr.onerror = function() {
        alert('Network error while saving bank details');
    };
    
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
        bankName: bankName,
        accountHolder: accountHolder,
        accountNumber: accountNumber,
        branchName: branchName
    }));
}

// Load Bank Details on Page Load
function loadBankDetails() {
    const bankNameSelect = document.getElementById('bankName');
    const accountHolder = document.getElementById('accountHolder');
    const accountNumber = document.getElementById('accountNumber');
    const branchName = document.getElementById('branchName');
    
    // Get values from form fields
    const bankName = bankNameSelect && bankNameSelect.value ? bankNameSelect.value.trim() : '';
    const accountHolderText = accountHolder ? accountHolder.value.trim() : '';
    const accountNumberText = accountNumber ? accountNumber.value.trim() : '';
    const branchNameText = branchName ? branchName.value.trim() : '';
    
    // Display current bank details in read-only view
    document.getElementById('displayBankName').textContent = bankName || 'Not set';
    document.getElementById('displayAccountHolder').textContent = accountHolderText || 'Not set';
    document.getElementById('displayAccountNumber').textContent = accountNumberText || 'Not set';
    document.getElementById('displayBranchName').textContent = branchNameText || 'Not set';
}

// Toggle Between Display and Edit Mode
function toggleEditMode(isEdit) {
    const displayDiv = document.getElementById('bankDetailsDisplay');
    const formDiv = document.getElementById('bankDetailsForm');
    const bankNameSelect = document.getElementById('bankName');
    
    if (isEdit) {
        displayDiv.style.display = 'none';
        formDiv.style.display = 'block';
        
        // Pre-select the current bank in dropdown if it has a value
        if (bankNameSelect && bankNameSelect.value) {
            bankNameSelect.focus();
        }
    } else {
        displayDiv.style.display = 'block';
        formDiv.style.display = 'none';
    }
}

// Initialize PIN Inputs
function initializePinInputs() {
    const pinInputs = document.querySelectorAll('.pin-input');
    
    pinInputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1) {
                // Move to next input
                if (index < pinInputs.length - 1) {
                    pinInputs[index + 1].focus();
                }
                e.target.classList.add('filled');
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && e.target.value === '') {
                if (index > 0) {
                    pinInputs[index - 1].focus();
                    pinInputs[index - 1].classList.remove('filled');
                }
            }
        });

        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasteData = e.clipboardData.getData('text');
            if (/^\d{6}$/.test(pasteData)) {
                pasteData.split('').forEach((digit, i) => {
                    if (i < pinInputs.length) {
                        pinInputs[i].value = digit;
                        pinInputs[i].classList.add('filled');
                    }
                });
                pinInputs[pinInputs.length - 1].focus();
            }
        });
    });
}

// Reset PIN
function resetPin() {
    const pinInputs = document.querySelectorAll('.pin-input');
    pinInputs.forEach(input => {
        input.value = '';
        input.classList.remove('filled');
    });
    
    const pinAlert = document.getElementById('pinAlert');
    pinAlert.style.display = 'none';
    
    pinInputs[0].focus();
}

// Submit Payment Request
function submitPaymentRequest() {
    const pinInputs = document.querySelectorAll('.pin-input');
    const pin = Array.from(pinInputs).map(input => input.value).join('');
    const selectedEvent = document.getElementById('paymentEventSelect');
    const selectedOption = selectedEvent.selectedOptions[0];
    
    // Validation
    if (pin.length !== 6 || pin === '000000') {
        showAlert('Please enter a valid 6-digit PIN', 'danger');
        return;
    }
    
    if (!selectedOption || selectedOption.value === '') {
        showAlert('Please select an event for payment', 'danger');
        return;
    }
    
    const eventId = parseInt(selectedOption.value);
    const selectedEventData = earningsData.find(e => e.event_id === eventId);
    
    if (!selectedEventData) {
        showAlert('Invalid event selection', 'danger');
        return;
    }
    
    // Check bank details
    const bankName = document.getElementById('bankName').value;
    const accountNumber = document.getElementById('accountNumber').value;
    const branchName = document.getElementById('branchName').value;
    
    if (!bankName || !accountNumber || !branchName) {
        showAlert('Please fill in all bank details first in the Payment Details tab', 'danger');
        return;
    }
    
    // Verify PIN via AJAX before proceeding
    console.log('Verifying PIN for Event ID:', eventId, 'PIN:', pin);
    verifyPaymentPin(eventId, pin, selectedEventData, bankName);
}

// Verify PIN via AJAX
function verifyPaymentPin(eventId, pin, eventData, bankName) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', URLROOT + '/Service/verifyPaymentPin', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            
            if (response.success) {
                // PIN verified successfully - update pin_confirmed in database
                const amount = parseFloat(eventData.amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                
                showAlert(
                    `✅ PIN verified successfully!<br>` +
                    `Event ID: ${eventData.event_id}<br>` +
                    `Amount: Rs. ${amount}<br>` +
                    `Bank: ${bankName}<br>` +
                    `Payment request has been confirmed.`,
                    'success'
                );
                
                // Reset form after success
                setTimeout(() => {
                    resetPin();
                    document.getElementById('paymentEventSelect').value = '';
                }, 2000);
            } else {
                // PIN verification failed
                showAlert(response.message || 'PIN verification failed. Please try again.', 'danger');
            }
        } else {
            showAlert('Error verifying PIN: Server error ' + xhr.status, 'danger');
        }
    };
    
    xhr.onerror = function() {
        showAlert('Network error while verifying PIN', 'danger');
    };
    
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
        eventId: eventId,
        pin: pin
    }));
}

// Show Alert
function showAlert(message, type) {
    const pinAlert = document.getElementById('pinAlert');
    const alertClass = type === 'success' ? 'alert-info' : 'alert-warning';
    const icon = type === 'success' ? '✅' : '❌';
    
    pinAlert.innerHTML = `
        <div class="alert ${alertClass}" style="margin: 16px 0;">
            <div class="alert-icon">${icon}</div>
            <div class="alert-content">
                <div class="alert-text">${message}</div>
            </div>
        </div>
    `;
    pinAlert.style.display = 'block';
    
    if (type === 'success') {
        setTimeout(() => {
            pinAlert.style.display = 'none';
        }, 5000);
    }
}

// View Payment Details
function viewPaymentDetails(date, amount, transactionId, bank, status) {
    // Populate the existing modal with payment details
    document.getElementById('modal-title').textContent = 'Payment Details';
    document.getElementById('modal-status').textContent = status;
    document.getElementById('modal-status').className = `status-badge ${status.toLowerCase() === 'success' ? 'status-completed' : 'status-pending'}`;
    
    document.getElementById('modal-event-name').textContent = `Payment Transaction ${transactionId}`;
    document.getElementById('modal-description').textContent = `Payment received from ${bank} on ${date}. Transaction ID: ${transactionId}`;
    document.getElementById('modal-amount').textContent = `Rs. ${parseInt(amount).toLocaleString()}`;
    document.getElementById('modal-payment-status').textContent = status;
    document.getElementById('modal-date').textContent = date;
    document.getElementById('modal-payment-date').textContent = date;
    
    // Show modal
    document.getElementById('event-modal').style.display = 'flex';
}
</script>
</body>
</html>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>