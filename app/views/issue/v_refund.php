<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar4.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/refund.css" />
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment Issues</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    :root {
      --accent: #7c3aed;
      --accent-2: #8a7cfb;
      --bg: #f7f7fb;
      --panel: #ffffff;
      --muted-surface: #f3f4f6;
      --text: #0f172a;
      --muted: #6b7280;
      --border: #e2e8f0;
      --radius: 16px;
      --shadow: 0 1px 2px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.06);
      --header-h: 90px;
      --frame: 1400px;
      --primary: #6d28d9;
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
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    body {
      background-color: var(--bg);
      color: var(--text);
      padding: 24px;
    }

    .payment{
      margin-left: 200px;
      margin-top: 70px;
    }
    .page-header {
      margin-bottom: 32px;
    }

    .page-header h1 {
      font-size: 28px;
      font-weight: 700;
    }

    /* Issue Card */
    .payment-issue-list {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .issue-card {
      background: var(--panel);
      border-radius: var(--radius);
      padding: 24px;
      box-shadow: var(--shadow);
      border-left: 4px solid var(--secondary);
    }

    .issue-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 16px;
    }

    .issue-id {
      font-weight: 700;
      font-size: 18px;
    }

    .status-badge {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .status-pending { background: var(--warning); color: white; }
    .status-resolved { background: var(--success); color: white; }
    .status-escalated { background: var(--danger); color: white; }

    .issue-meta {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
      margin-bottom: 20px;
    }

    .meta-item {
      display: flex;
      flex-direction: column;
    }

    .meta-label {
      font-size: 13px;
      color: var(--muted);
    }

    .meta-value {
      font-weight: 600;
    }

    .issue-type {
      display: inline-block;
      background: var(--muted-surface);
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 13px;
      margin-bottom: 12px;
    }

    /* Payment Details Card */
    .payment-details {
      background: var(--light);
      border-radius: 12px;
      padding: 16px;
      margin: 20px 0;
    }

    .payment-row {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px dashed var(--border);
    }

    .payment-row:last-child {
      border-bottom: none;
    }

    .payment-label {
      color: var(--muted);
    }

    .payment-value {
      font-weight: 600;
    }

    /* Provider Bank/Card Info (Secure Display) */
    .provider-financial {
      background: #fffbeb;
      border: 1px solid var(--warning);
      border-radius: 12px;
      padding: 16px;
      margin: 20px 0;
    }

    .provider-financial h4 {
      color: var(--warning);
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .card-info, .bank-info {
      font-family: monospace;
      font-size: 14px;
      background: white;
      padding: 10px;
      border-radius: 8px;
      margin-top: 8px;
    }

    /* Actions */
    .actions {
      display: flex;
      gap: 12px;
      margin-top: 20px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-outline {
      border: 1px solid var(--border);
      color: var(--text);
    }

    .btn-primary {
      background: var(--primary);
      color: white;
    }

    .btn-success {
      background: var(--success);
      color: white;
    }

    .btn-danger {
      background: var(--danger);
      color: white;
    }

    .admin-note {
      margin-top: 16px;
      padding: 12px;
      background: var(--muted-surface);
      border-radius: 8px;
      font-size: 14px;
    }

    .admin-note label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
    }

    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-family: inherit;
      resize: vertical;
      min-height: 80px;
    }
  </style>
</head>
<body>
<div class="payment">
  <div class="page-header">
    <h1>Payment Issues</h1>
    <p style="color: var(--muted); margin-top: 8px;">Resolve financial conflicts and coordinate payouts</p>
  </div>

  <div class="payment-issue-list">
    <!-- Issue 1: Failed Transaction -->
    <div class="issue-card">
      <div class="issue-header">
        <div class="issue-id">Payment Issue #PAY-089</div>
        <span class="status-badge status-pending">Pending Review</span>
      </div>

      <span class="issue-type">Failed Transaction</span>

      <div class="issue-meta">
        <div class="meta-item">
          <span class="meta-label">Event</span>
          <span class="meta-value">#E-7801</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Client</span>
          <span class="meta-value">GreenLeaf Co.</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Amount</span>
          <span class="meta-value">$420.00</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Reported</span>
          <span class="meta-value">Jan 13, 2026 • 11:30 UTC</span>
        </div>
      </div>

      <div class="payment-details">
        <div class="payment-row">
          <span class="payment-label">Original Charge</span>
          <span class="payment-value">$420.00</span>
        </div>
        <div class="payment-row">
          <span class="payment-label">Gateway Response</span>
          <span class="payment-value" style="color: var(--danger);">Declined: Insufficient Funds</span>
        </div>
        <div class="payment-row">
          <span class="payment-label">Attempts</span>
          <span class="payment-value">2 failed</span>
        </div>
      </div>

      <div class="actions">
        <button class="btn btn-outline"><i class="fas fa-credit-card"></i> Retry Payment</button>
        <button class="btn btn-outline"><i class="fas fa-envelope"></i> Notify Client</button>
        <button class="btn btn-danger"><i class="fas fa-flag"></i> Escalate to Admin</button>
      </div>
    </div>

    <!-- Issue 2: Price Mismatch After Replacement -->
    <div class="issue-card">
      <div class="issue-header">
        <div class="issue-id">Payment Issue #PAY-092</div>
        <span class="status-badge status-pending">Pending Review</span>
      </div>

      <span class="issue-type">Price Mismatch (Post-Replacement)</span>

      <div class="issue-meta">
        <div class="meta-item">
          <span class="meta-label">Event</span>
          <span class="meta-value">#E-7892</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Client</span>
          <span class="meta-value">TechNova Inc.</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Original Price</span>
          <span class="meta-value">$420.00</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">New Price</span>
          <span class="meta-value">$395.00</span>
        </div>
      </div>

      <p style="margin: 16px 0; color: var(--muted);">
        Provider replaced due to cancellation. New provider charges less. Refund $25 required.
      </p>

      <!-- Provider Financial Info (for manual payout) -->
      <div class="provider-financial">
        <h4><i class="fas fa-exclamation-triangle"></i> Provider Payout Details (For Admin)</h4>
        <div class="card-info">
          • Card ending in <strong>•••• 4821</strong><br>
          • Holder: Maria Chen<br>
          • Network: Visa
        </div>
        <div class="bank-info" style="margin-top: 12px;">
          • IBAN: DE89 3704 0044 0532 0130 00<br>
          • BIC: COBADEFFXXX
        </div>
      </div>

      <div class="admin-note">
        <label>Resolution Note for Admin</label>
        <textarea placeholder="Explain why manual transfer is needed...">Provider swap resulted in $25 credit. Please refund client and pay new provider $395 via manual transfer using details above.</textarea>
      </div>

      <div class="actions">
        <button class="btn btn-outline"><i class="fas fa-envelope"></i> Notify Client</button>
        <button class="btn btn-success"><i class="fas fa-check"></i> Mark as Resolved</button>
        <button class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send to Admin for Manual Payout</button>
      </div>
    </div>
  </div>


</div>
</body>
</html>
  <?php require APPROOT . '/views/inc/footer.php'; ?>