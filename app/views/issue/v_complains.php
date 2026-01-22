<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar6.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/message.css" />
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Issues & Complaints</title>
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
      margin-left: 200px;
      margin-top: 70px;
      background-color: var(--bg);
      color: var(--text);
      padding: 24px;
    }

    .page-header {
      margin-bottom: 32px;
    }

    .page-header h1 {
      font-size: 28px;
      font-weight: 700;
    }

    /* Tabs */
    .tabs {
      display: flex;
      gap: 24px;
      border-bottom: 1px solid var(--border);
      padding-bottom: 12px;
      margin-bottom: 24px;
    }

    .tab {
      padding: 8px 0;
      cursor: pointer;
      color: var(--muted);
      font-weight: 600;
      position: relative;
    }

    .tab.active {
      color: var(--primary);
    }

    .tab.active::after {
      content: '';
      position: absolute;
      bottom: -13px;
      left: 0;
      width: 100%;
      height: 3px;
      background: var(--primary);
      border-radius: 3px;
    }

    /* Issue Card */
    .issue-list {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .issue-card {
      background: var(--panel);
      border-radius: var(--radius);
      padding: 20px;
      box-shadow: var(--shadow);
      border-left: 4px solid var(--primary);
      transition: box-shadow 0.2s;
    }

    .issue-card:hover {
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }

    .issue-card.system-failure {
      border-left-color: var(--danger);
    }

    .issue-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
    }

    .issue-id {
      font-weight: 700;
      font-size: 18px;
    }

    .priority-badge {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .priority-low { background: var(--available); color: var(--secondary); }
    .priority-medium { background: var(--warning); color: white; }
    .priority-high { background: var(--primary-light); color: white; }
    .priority-critical { background: var(--danger); color: white; }

    .issue-meta {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 12px;
      margin-bottom: 16px;
    }

    .meta-item {
      display: flex;
      flex-direction: column;
    }

    .meta-label {
      font-size: 12px;
      color: var(--muted);
    }

    .meta-value {
      font-weight: 600;
    }

    .status-badge {
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
    }

    .status-open { background: var(--warning); color: white; }
    .status-in-progress { background: var(--primary-light); color: white; }
    .status-resolved { background: var(--success); color: white; }

    .actions {
      display: flex;
      gap: 10px;
      margin-top: 16px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 6px 12px;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      border: 1px solid var(--border);
      font-size: 13px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-primary { 
      background: var(--primary); 
      color: white; 
      border: none;
    }

    .btn-outline { 
      background: transparent;
      color: var(--text);
    }

    .btn-danger {
      background: var(--danger);
      color: white;
      border: none;
    }

    .admin-alert {
      background: #fef2f2;
      border: 1px solid var(--danger);
      border-radius: 8px;
      padding: 12px;
      margin-top: 12px;
      display: flex;
      gap: 12px;
    }

    .admin-alert i {
      color: var(--danger);
      margin-top: 4px;
    }
  </style>
</head>
<body>

  <div class="page-header">
    <h1>Issues & Complaints</h1>
    <p style="color: var(--muted); margin-top: 8px;">Central hub for all reported issues — assigned to you</p>
  </div>

  <!-- Tabs -->
  <div class="tabs">
    <div class="tab active" data-tab="client">Client Complaints</div>
    <div class="tab" data-tab="provider">Service Provider Complaints</div>
    <div class="tab" data-tab="system">System / Payment Issues</div>
  </div>

  <!-- Issue List -->
  <div class="issue-list">
    <!-- Client Complaint -->
    <div class="issue-card">
      <div class="issue-header">
        <div class="issue-id">Complaint #C-204</div>
        <span class="priority-badge priority-high">High</span>
      </div>
      
      <div class="issue-meta">
        <div class="meta-item">
          <span class="meta-label">Type</span>
          <span class="meta-value">Service Quality</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Event</span>
          <span class="meta-value">#E-7801</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Reported By</span>
          <span class="meta-value">GreenLeaf Co. (Client)</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Status</span>
          <span class="status-badge status-open">Open</span>
        </div>
      </div>

      <p style="margin-bottom: 16px;">
        "Provider arrived 45 minutes late and was unprepared for workshop."
      </p>

      <div class="actions">
        <button class="btn btn-outline"><i class="fas fa-phone"></i> Contact Client</button>
        <button class="btn btn-outline"><i class="fas fa-user"></i> Contact Provider</button>
        <button class="btn btn-primary"><i class="fas fa-random"></i> Start Replacement</button>
      </div>
    </div>

    <!-- Provider Complaint -->
    <div class="issue-card">
      <div class="issue-header">
        <div class="issue-id">Complaint #P-118</div>
        <span class="priority-badge priority-medium">Medium</span>
      </div>
      
      <div class="issue-meta">
        <div class="meta-item">
          <span class="meta-label">Type</span>
          <span class="meta-value">Provider Unavailable</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Event</span>
          <span class="meta-value">#E-7892</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Reported By</span>
          <span class="meta-value">Alex Rivera (Provider)</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Status</span>
          <span class="status-badge status-in-progress">In Progress</span>
        </div>
      </div>

      <p style="margin-bottom: 16px;">
        "Vehicle breakdown — cannot attend event today at 14:00."
      </p>

      <div class="actions">
        <button class="btn btn-outline"><i class="fas fa-phone"></i> Call Provider</button>
        <button class="btn btn-primary"><i class="fas fa-random"></i> Assign Replacement</button>
      </div>
    </div>

    <!-- System Failure (Admin Alert) -->
    <div class="issue-card system-failure">
      <div class="issue-header">
        <div class="issue-id">System Alert #S-042</div>
        <span class="priority-badge priority-critical">Critical</span>
      </div>
      
      <div class="issue-meta">
        <div class="meta-item">
          <span class="meta-label">Type</span>
          <span class="meta-value">System Error</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Event</span>
          <span class="meta-value">#E-7905</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Detected</span>
          <span class="meta-value">Jan 13, 2026 • 16:42 UTC</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Status</span>
          <span class="status-badge status-open">Open</span>
        </div>
      </div>

      <p style="margin-bottom: 16px;">
        Payment gateway timeout during client checkout. Transaction ID: TXN-88921.
      </p>

      <div class="admin-alert">
        <i class="fas fa-exclamation-triangle"></i>
        <div>
          <strong>Requires Admin Attention</strong><br>
          This is a system-level failure. Please escalate immediately.
        </div>
      </div>

      <div class="actions">
        <button class="btn btn-outline"><i class="fas fa-bug"></i> View Logs</button>
        <button class="btn btn-danger"><i class="fas fa-paper-plane"></i> Escalate to Admin</button>
      </div>
    </div>

    <!-- Payment Issue -->
    <div class="issue-card">
      <div class="issue-header">
        <div class="issue-id">Complaint #PAY-089</div>
        <span class="priority-badge priority-medium">Medium</span>
      </div>
      
      <div class="issue-meta">
        <div class="meta-item">
          <span class="meta-label">Type</span>
          <span class="meta-value">Payment Failure</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Event</span>
          <span class="meta-value">#E-7801</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Client</span>
          <span class="meta-value">GreenLeaf Co.</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Status</span>
          <span class="status-badge status-open">Open</span>
        </div>
      </div>

      <p style="margin-bottom: 16px;">
        Credit card declined during final payment capture.
      </p>

      <div class="actions">
        <button class="btn btn-outline"><i class="fas fa-credit-card"></i> Retry Payment</button>
        <button class="btn btn-outline"><i class="fas fa-money-bill"></i> Request Refund</button>
        <button class="btn btn-danger"><i class="fas fa-flag"></i> Escalate Payment Issue</button>
      </div>
    </div>
  </div>

  <script>
    // Simple tab switching (in real app, load data per tab)
    document.querySelectorAll('.tab').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        // In production: filter issue list or fetch new data
      });
    });
  </script>
</body>
</html>

  <?php require APPROOT . '/views/inc/footer.php'; ?>