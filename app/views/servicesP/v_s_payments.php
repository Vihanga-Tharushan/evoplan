<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php //require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar1.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_payments.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Payments</title>
    <style>
        :root {
            --accent: #7c3aed;
            --accent-2: #8a7cfb;
            --bg: #f7f7fb;
            --panel: #ffffff;
            --muted-surface: #f3f4f6;
            --text: #0f172a;
            --muted: #6b7280;
            --border: #e5e7eb;
            --radius: 16px;
            --shadow: 0 1px 2px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.06);
            --header-h: 90px;
            --frame: 1400px;
             --primary: #4B006E;     /* Dark purple */
            --primary-light: #8b5cf6;
            --secondary: #4c1d95;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --light: #f8fafc;
            --dark: #1e293b;
            --gray: #64748b;
            --available: #dbeafe;
            --booked: #fecaca;
            --unavailable: #f1f5f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .main{
            margin-top: 70px;
            margin-left: 250px;
        }

        .header {
            height: var(--header-h);
            background: var(--panel);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 30px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
        }

        .container {
            max-width: var(--frame);
            margin: 0 auto;
            padding: 30px 20px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-header p {
            color: var(--muted);
            font-size: 14px;
        }

        /* Tabs */
        .tabs-container {
            display: flex;
            gap: 0;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--border);
            background: var(--panel);
            border-radius: var(--radius) var(--radius) 0 0;
            padding: 0;
        }

        .tab-button {
            padding: 16px 24px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: var(--muted);
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            margin-bottom: -2px;
        }

        .tab-button:hover {
            color: var(--primary);
        }

        .tab-button.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Cards */
        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
            margin-bottom: 24px;
        }

        .card h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--text);
        }

        .card p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        /* Income Table */
        .income-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .income-table thead {
            background: var(--muted-surface);
        }

        .income-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
        }

        .income-table td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        .income-table tr:hover {
            background: var(--muted-surface);
            transition: background 0.2s ease;
        }

        .amount {
            font-weight: 700;
            color: var(--success);
            font-size: 15px;
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

        /* Summary Stats */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: var(--muted-surface);
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid var(--primary);
        }

        .summary-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .summary-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
        }

        .summary-subtitle {
            font-size: 12px;
            color: var(--muted);
            margin-top: 4px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: var(--text);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            max-width: 400px;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: var(--panel);
            color: var(--text);
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(109, 40, 217, 0.1);
        }

        .form-group input::placeholder {
            color: var(--muted);
        }

        /* Pin Input */
        .pin-input-group {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .pin-input {
            width: 50px;
            height: 50px;
            font-size: 24px;
            text-align: center;
            font-weight: 700;
            border: 2px solid var(--border);
            border-radius: 8px;
            transition: all 0.3s ease;
            color: var(--text);
            background: var(--panel);
        }

        .pin-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(109, 40, 217, 0.1);
        }

        .pin-input.filled {
            border-color: var(--primary);
            background: rgba(109, 40, 217, 0.05);
        }

        /* Alert Box */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-left: 4px solid;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { 
                opacity: 0; 
                transform: translateY(-10px);
            }
            to { 
                opacity: 1; 
                transform: translateY(0);
            }
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
            font-size: 14px;
        }

        .alert-text {
            font-size: 13px;
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

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: var(--success);
            color: #065f46;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: var(--danger);
            color: #7f1d1d;
        }

        /* Buttons */
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary);
            box-shadow: var(--shadow);
        }

        .btn-primary:disabled {
            background: var(--muted);
            cursor: not-allowed;
            opacity: 0.6;
        }

        .btn-secondary {
            background: var(--muted-surface);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--border);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            box-shadow: var(--shadow);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            box-shadow: var(--shadow);
        }

        /* Section Title */
        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border);
        }

        .divider {
            height: 1px;
            background: var(--border);
            margin: 24px 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 0 20px;
            }

            .container {
                padding: 20px 15px;
            }

            .page-header h2 {
                font-size: 22px;
            }

            .tabs-container {
                overflow-x: auto;
            }

            .tab-button {
                padding: 14px 16px;
                font-size: 13px;
                white-space: nowrap;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .form-group input,
            .form-group select {
                max-width: 100%;
            }

            .pin-input {
                width: 45px;
                height: 45px;
                font-size: 20px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
<div class="main">
   

    <!-- Main Container -->
    <div class="container">
        <div class="page-header">
            <h2>Payment Management</h2>
            <p>View your income from events and manage payment details</p>
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <button class="tab-button active" data-tab="earnings">📊 My Earnings</button>
            <button class="tab-button" data-tab="payment-setup">💳 Payment Details</button>
            <button class="tab-button" data-tab="pin-enter">🔒 Enter PIN</button>
        </div>

        <!-- TAB 1: MY EARNINGS -->
        <div id="earnings" class="tab-content active">
            <!-- Income Summary -->
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">Total Earnings</div>
                    <div class="summary-value">₹ 45,800</div>
                    <div class="summary-subtitle">All time earnings</div>
                </div>
                <div class="summary-card" style="border-left-color: var(--warning);">
                    <div class="summary-label">Pending Payment</div>
                    <div class="summary-value">₹ 12,500</div>
                    <div class="summary-subtitle">Awaiting payout</div>
                </div>
                <div class="summary-card" style="border-left-color: var(--success);">
                    <div class="summary-label">Paid Out</div>
                    <div class="summary-value">₹ 33,300</div>
                    <div class="summary-subtitle">Successfully received</div>
                </div>
            </div>

            <!-- Events Income Table -->
            <div class="card">
                <h3>Income From Events</h3>
                <p>View detailed income breakdown from each event you've worked on</p>

                <table class="income-table">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Event Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Smith Wedding Reception</strong></td>
                            <td>Jan 15, 2025</td>
                            <td>Photography</td>
                            <td class="amount">₹ 8,000</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td><strong>Corporate Gala 2025</strong></td>
                            <td>Jan 14, 2025</td>
                            <td>Catering</td>
                            <td class="amount">₹ 12,500</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td><strong>Birthday Bash - Rohit</strong></td>
                            <td>Jan 12, 2025</td>
                            <td>Decoration</td>
                            <td class="amount">₹ 5,800</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td><strong>Annual Company Dinner</strong></td>
                            <td>Jan 10, 2025</td>
                            <td>Event Planning</td>
                            <td class="amount">₹ 7,500</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td><strong>Johnson Family Anniversary</strong></td>
                            <td>Jan 8, 2025</td>
                            <td>Florist Services</td>
                            <td class="amount">₹ 4,200</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td><strong>Charity Gala Event</strong></td>
                            <td>Jan 5, 2025</td>
                            <td>Photography</td>
                            <td class="amount">₹ 7,800</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Payment History -->
            <div class="card">
                <h3>Recent Payments Received</h3>
                <p>Track your payout history and transfer confirmations</p>

                <table class="income-table">
                    <thead>
                        <tr>
                            <th>Payment Date</th>
                            <th>Amount</th>
                            <th>Transaction ID</th>
                            <th>Bank</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jan 10, 2025</td>
                            <td class="amount">₹ 15,300</td>
                            <td>#TXN-2025-001534</td>
                            <td>HDFC Bank</td>
                            <td><span class="status-badge status-completed">Success</span></td>
                        </tr>
                        <tr>
                            <td>Dec 28, 2024</td>
                            <td class="amount">₹ 10,200</td>
                            <td>#TXN-2025-001423</td>
                            <td>HDFC Bank</td>
                            <td><span class="status-badge status-completed">Success</span></td>
                        </tr>
                        <tr>
                            <td>Dec 15, 2024</td>
                            <td class="amount">₹ 7,800</td>
                            <td>#TXN-2024-001298</td>
                            <td>HDFC Bank</td>
                            <td><span class="status-badge status-completed">Success</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 2: PAYMENT DETAILS & SETUP -->
        <div id="payment-setup" class="tab-content">
            <!-- Bank Account Information -->
            <div class="card">
                <h3>💳 Bank Account Details</h3>
                <p>Update your bank information for payment transfers. Ensure all details are correct before requesting payment.</p>

                <div class="alert alert-info">
                    <div class="alert-icon">ℹ️</div>
                    <div class="alert-content">
                        <div class="alert-title">Bank Details Information</div>
                        <div class="alert-text">Your bank details are securely stored and only used for payment transfers. Verify all information is accurate to avoid payment delays.</div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Bank Name *</label>
                    <input type="text" placeholder="e.g., HDFC Bank, ICICI Bank, Axis Bank" value="HDFC Bank" id="bankName">
                </div>

                <div class="form-group">
                    <label>Account Holder Name *</label>
                    <input type="text" placeholder="Full name as per bank records" value="Rajesh Kumar Singh" id="accountHolder">
                </div>

                <div class="form-group">
                    <label>Account Number *</label>
                    <input type="text" placeholder="Your account number" value="1234567890123456" id="accountNumber">
                </div>

                <div class="form-group">
                    <label>IFSC Code *</label>
                    <input type="text" placeholder="e.g., HDFC0001234" value="HDFC0001234" id="ifscCode">
                </div>

                <div class="form-group">
                    <label>Account Branch Name *</label>
                    <input type="text" placeholder="e.g., Mumbai Main Branch" value="Mumbai Main Branch" id="branchName">
                </div>

                <div class="form-group">
                    <label>Account Type *</label>
                    <select id="accountType">
                        <option value="">-- Select Account Type --</option>
                        <option value="savings" selected>Savings Account</option>
                        <option value="current">Current Account</option>
                        <option value="business">Business Account</option>
                    </select>
                </div>

                <button class="btn btn-primary">💾 Save Bank Details</button>
            </div>

            <div class="divider"></div>

        </div>


        <!--TAB 3: pin enter and verify -->

        <div id="pin-enter" class="tab-content">
            
            <!-- Payment Request PIN Verification -->
            <div class="card">
                <h3>🔐 Request Payment Access</h3>
                <p>To initiate a payment request, you need to enter a security PIN. This PIN is provided by the platform admin and ensures payment security.</p>

                <div class="alert alert-warning">
                    <div class="alert-icon">⚠️</div>
                    <div class="alert-content">
                        <div class="alert-title">Important: PIN Requirement</div>
                        <div class="alert-text">You must obtain a 4-digit PIN from the Event Coordinator or Admin to process payment requests. This PIN prevents unauthorized payment requests and protects your account. Do not share this PIN with anyone.</div>
                    </div>
                </div>

                <div class="section-title">Enter PIN for Payment</div>

                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 12px; font-weight: 600; font-size: 14px; color: var(--text);">PIN Code</label>
                    <div class="pin-input-group" id="pinInputGroup">
                        <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="0">
                        <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="1">
                        <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="2">
                        <input type="text" class="pin-input" maxlength="1" placeholder="0" data-pin="3">
                    </div>
                    <p style="font-size: 12px; color: var(--muted); margin-top: 8px;">Enter the 4-digit PIN provided by your Event Coordinator</p>
                </div>

                <div id="pinAlert" style="display: none;"></div>

                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px; color: var(--text);">Confirm PIN</label>
                    <input type="password" placeholder="Re-enter your PIN for confirmation" id="pinConfirm" style="max-width: 300px;">
                </div>

                <div class="form-group">
                    <label>Payment Amount to Request *</label>
                    <input type="number" placeholder="₹ Enter amount (Pending: ₹12,500)" value="12500" id="paymentAmount">
                </div>

                <div class="alert alert-info">
                    <div class="alert-icon">ℹ️</div>
                    <div class="alert-content">
                        <div class="alert-title">PIN Source</div>
                        <div class="alert-text">Contact your Event Coordinator or the admin portal to request a payment PIN. This is a one-time security measure for your payment request.</div>
                    </div>
                </div>

                <div class="button-group">
                    <button class="btn btn-success" id="submitPaymentBtn">✅ Request Payment</button>
                    <button class="btn btn-secondary" id="resetPinBtn">🔄 Clear</button>
                </div>
            </div>

            <!-- Payment Instructions -->
            <div class="card">
                <h3>📋 Payment Process Guide</h3>
                <ol style="margin-left: 20px; color: var(--muted); line-height: 1.8; font-size: 14px;">
                    <li style="margin-bottom: 12px;">
                        <strong style="color: var(--text);">Verify Bank Details:</strong> Ensure your bank account information is accurate and up-to-date.
                    </li>
                    <li style="margin-bottom: 12px;">
                        <strong style="color: var(--text);">Obtain PIN:</strong> Contact your Event Coordinator to get your unique 4-digit payment PIN.
                    </li>
                    <li style="margin-bottom: 12px;">
                        <strong style="color: var(--text);">Enter PIN:</strong> Input the PIN in the payment request section above.
                    </li>
                    <li style="margin-bottom: 12px;">
                        <strong style="color: var(--text);">Request Payment:</strong> Click "Request Payment" to submit your payment request.
                    </li>
                    <li style="margin-bottom: 12px;">
                        <strong style="color: var(--text);">Confirmation:</strong> You'll receive an email confirmation within 2-4 hours.
                    </li>
                    <li style="margin-bottom: 0;">
                        <strong style="color: var(--text);">Payment Transfer:</strong> Funds will be transferred to your account within 1-3 business days.
                    </li>
                </ol>
            </div>

        </div>
    </div>

    <script>
        // Tab Switching
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');


        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabName = button.getAttribute('data-tab');
                
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked button and corresponding content
                button.classList.add('active');
                document.getElementById(tabName).classList.add('active');
            });
        });

        // PIN Input Logic
        const pinInputs = document.querySelectorAll('.pin-input');
        const pinConfirm = document.getElementById('pinConfirm');
        const pinAlert = document.getElementById('pinAlert');
        const submitPaymentBtn = document.getElementById('submitPaymentBtn');
        const resetPinBtn = document.getElementById('resetPinBtn');

        pinInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1) {
                    // Move to next input
                    if (index < pinInputs.length - 1) {
                        pinInputs[index + 1].focus();
                    }
                }
                updatePinState();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && e.target.value === '') {
                    if (index > 0) {
                        pinInputs[index - 1].focus();
                    }
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text');
                if (/^\d{4}$/.test(pasteData)) {
                    pasteData.split('').forEach((digit, i) => {
                        if (i < pinInputs.length) {
                            pinInputs[i].value = digit;
                            pinInputs[i].classList.add('filled');
                        }
                    });
                    pinInputs[pinInputs.length - 1].focus();
                    updatePinState();
                }
            });
        });

        function updatePinState() {
            pinInputs.forEach(input => {
                if (input.value) {
                    input.classList.add('filled');
                } else {
                    input.classList.remove('filled');
                }
            });
        }

        resetPinBtn.addEventListener('click', () => {
            pinInputs.forEach(input => {
                input.value = '';
                input.classList.remove('filled');
            });
            pinConfirm.value = '';
            pinAlert.style.display = 'none';
            pinInputs[0].focus();
        });

        submitPaymentBtn.addEventListener('click', () => {
            const pin = Array.from(pinInputs).map(input => input.value).join('');
            const bankName = document.getElementById('bankName').value;
            const accountNumber = document.getElementById('accountNumber').value;
            const branchName = document.getElementById('branchName').value;
            const paymentAmount = document.getElementById('paymentAmount').value;
            const pinConfirmValue = document.getElementById('pinConfirm').value;

            // Validation
            if (pin.length !== 4 || pin === '0000') {
                showAlert('Please enter a valid 4-digit PIN', 'danger');
                return;
            }

            if (pin !== pinConfirmValue) {
                showAlert('PIN and confirmation PIN do not match', 'danger');
                return;
            }

            if (!bankName || !accountNumber || !branchName) {
                showAlert('Please fill in all bank details first', 'danger');
                return;
            }

            if (!paymentAmount || parseFloat(paymentAmount) <= 0) {
                showAlert('Please enter a valid payment amount', 'danger');
                return;
            }

            // Success message
            showAlert(
                `✅ Payment request submitted successfully!<br>Amount: ₹${paymentAmount}<br>Bank: ${bankName}<br>You will receive confirmation within 2-4 hours.`,
                'success'
            );

            // Reset form
            setTimeout(() => {
                resetPinBtn.click();
                document.getElementById('paymentAmount').value = '';
            }, 2000);
        });

        function showAlert(message, type) {
            pinAlert.innerHTML = `
                <div class="alert alert-${type}">
                    <div class="alert-icon">${type === 'success' ? '✅' : type === 'danger' ? '❌' : 'ℹ️'}</div>
                    <div class="alert-content">
                        <div class="alert-text">${message}</div>
                    </div>
                </div>
            `;
            pinAlert.style.display = 'block';
            
            if (type === 'success') {
                setTimeout(() => {
                    pinAlert.style.display = 'none';
                }, 4000);
            }
        }

        // Initialize first PIN input focus
        pinInputs[0].focus();
    </script>
</div>
</body>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>