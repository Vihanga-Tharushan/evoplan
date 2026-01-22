<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/replacementslist.css" />

<?php require_once APPROOT . '/views/issue/sidebar/sidebar2.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Service Provider Replacement</title>
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
      color: var(--text);
    }

    .alert-banner {
      background: #fffbeb;
      border: 1px solid var(--warning);
      border-radius: var(--radius);
      padding: 16px 20px;
      margin-bottom: 32px;
      display: flex;
      gap: 16px;
    }

    .alert-banner i {
      color: var(--warning);
      font-size: 24px;
      margin-top: 4px;
    }

    /* Event Summary Card */
    .event-card {
      background: var(--panel);
      border-radius: var(--radius);
      padding: 24px;
      box-shadow: var(--shadow);
      margin-bottom: 32px;
      border-left: 4px solid var(--danger);
    }

    .event-title {
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 12px;
      color: var(--danger);
    }

    .event-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
    }

    .detail-item {
      display: flex;
      flex-direction: column;
    }

    .detail-label {
      font-size: 13px;
      color: var(--muted);
      margin-bottom: 4px;
    }

    .detail-value {
      font-weight: 600;
    }

    /* Failed Provider */
    .failed-provider {
      background: var(--panel);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 20px;
      margin-bottom: 32px;
    }

    .failed-provider h3 {
      color: var(--danger);
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* Replacement Candidates */
    .candidates-section h2 {
      margin-bottom: 20px;
      font-size: 22px;
    }

    .candidate-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }

    .candidate-card {
      background: var(--panel);
      border: 2px solid var(--border);
      border-radius: var(--radius);
      padding: 20px;
      transition: all 0.2s;
    }

    .candidate-card:hover {
      border-color: var(--primary-light);
      box-shadow: 0 4px 12px rgba(109, 40, 217, 0.15);
    }

    .candidate-header {
      display: flex;
      justify-content: space-between;
      align-items: start;
      margin-bottom: 16px;
    }

    .candidate-name {
      font-weight: 700;
      font-size: 18px;
    }

    .rating {
      color: #fbbf24;
      font-weight: 600;
    }

    .candidate-stats {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-bottom: 16px;
    }

    .stat-row {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
    }

    .stat-label {
      color: var(--muted);
    }

    .stat-value {
      font-weight: 600;
    }

    .btn {
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      transition: opacity 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-primary { 
      background: var(--primary); 
      color: white; 
    }

    .btn-outline { 
      border: 1px solid var(--border); 
      color: var(--text); 
    }

    .btn-success {
      background: var(--success);
      color: white;
    }

    .approval-flow {
      background: var(--muted-surface);
      border-radius: var(--radius);
      padding: 24px;
      margin-top: 32px;
    }

    .flow-steps {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin-bottom: 24px;
    }

    .flow-steps::before {
      content: '';
      position: absolute;
      top: 20px;
      left: 0;
      right: 0;
      height: 2px;
      background: var(--border);
      z-index: 1;
    }

    .step {
      background: var(--panel);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      z-index: 2;
      border: 2px solid var(--primary);
      color: var(--primary);
    }

    .step.completed {
      background: var(--primary);
      color: white;
    }

    .step-label {
      text-align: center;
      margin-top: 8px;
      font-size: 14px;
      color: var(--muted);
    }

    .step.active .step-label {
      color: var(--primary);
      font-weight: 600;
    }

    .actions {
      display: flex;
      gap: 12px;
      justify-content: flex-end;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <!-- Alert Banner -->
  <div class="alert-banner">
    <i class="fas fa-triangle-exclamation"></i>
    <div>
      <strong>Emergency Replacement Required</strong><br>
      Provider cancelled less than 24h before event. Act quickly to maintain service quality.
    </div>
  </div>

  <!-- Event Summary -->
  <div class="event-card">
    <div class="event-title">Event #E-7892 • Corporate Team Building</div>
    <div class="event-details">
      <div class="detail-item">
        <span class="detail-label">Date & Time</span>
        <span class="detail-value">Jan 14, 2026 • 14:00 – 17:00</span>
      </div>
      <div class="detail-item">
        <span class="detail-label">Location</span>
        <span class="detail-value">Downtown Conference Center, NYC</span>
      </div>
      <div class="detail-item">
        <span class="detail-label">Client</span>
        <span class="detail-value">TechNova Inc.</span>
      </div>
      <div class="detail-item">
        <span class="detail-label">Service Type</span>
        <span class="detail-value">Team Facilitation</span>
      </div>
    </div>
  </div>

  <!-- Failed Provider -->
  <div class="failed-provider">
    <h3><i class="fas fa-user-times"></i> Original Provider Cancelled</h3>
    <p><strong>Alex Rivera</strong> • ⭐ 4.7 (128 reviews)<br>
       Reason: "Vehicle breakdown — cannot attend"<br>
       Cancelled: Jan 13, 2026 at 12:30 UTC
    </p>
  </div>

  <!-- Replacement Candidates -->
  <div class="candidates-section">
    <h2>Recommended Replacements</h2>
    <p style="color: var(--muted); margin-bottom: 20px;">
      Matched by service type, location, and availability on Jan 14, 2026
    </p>

    <div class="candidate-grid">
      <!-- Candidate 1 -->
      <div class="candidate-card">
        <div class="candidate-header">
          <div>
            <div class="candidate-name">Maria Chen</div>
            <div class="rating">⭐ 4.9 (203 reviews)</div>
          </div>
        </div>
        <div class="candidate-stats">
          <div class="stat-row">
            <span class="stat-label">Price</span>
            <span class="stat-value">$420</span>
          </div>
          <div class="stat-row">
            <span class="stat-label">Distance</span>
            <span class="stat-value">1.2 mi</span>
          </div>
          <div class="stat-row">
            <span class="stat-label">Response Time</span>
            <span class="stat-value">15 min</span>
          </div>
          <div class="stat-row">
            <span class="stat-label">Availability</span>
            <span class="stat-value" style="color: var(--success);">✅ Free</span>
          </div>
        </div>
        <button class="btn btn-primary" style="width: 100%;">
          <i class="fas fa-check"></i> Assign Maria
        </button>
      </div>

      <!-- Candidate 2 -->
      <div class="candidate-card">
        <div class="candidate-header">
          <div>
            <div class="candidate-name">James Thompson</div>
            <div class="rating">⭐ 4.8 (94 reviews)</div>
          </div>
        </div>
        <div class="candidate-stats">
          <div class="stat-row">
            <span class="stat-label">Price</span>
            <span class="stat-value">$395</span>
          </div>
          <div class="stat-row">
            <span class="stat-label">Distance</span>
            <span class="stat-value">0.8 mi</span>
          </div>
          <div class="stat-row">
            <span class="stat-label">Response Time</span>
            <span class="stat-value">5 min</span>
          </div>
          <div class="stat-row">
            <span class="stat-label">Availability</span>
            <span class="stat-value" style="color: var(--success);">✅ Free</span>
          </div>
        </div>
        <button class="btn btn-outline" style="width: 100%;">
          <i class="fas fa-check"></i> Assign James
        </button>
      </div>
    </div>
  </div>

  <!-- Approval Flow -->
  <div class="approval-flow">
    <h3>Replacement Approval Workflow</h3>
    
    <div class="flow-steps">
      <div class="step completed">1</div>
      <div class="step active">2</div>
      <div class="step">3</div>
    </div>
    
    <div style="display: flex; justify-content: space-between; text-align: center;">
      <div class="step-label">IC Initiates<br><small style="color: var(--success);">Done</small></div>
      <div class="step-label">Client Approval<br><small>Optional</small></div>
      <div class="step-label">Admin Notification<br><small>Mandatory</small></div>
    </div>

    <div class="actions">
      <button class="btn btn-outline">
        <i class="fas fa-envelope"></i> Request Client Approval
      </button>
      <button class="btn btn-success">
        <i class="fas fa-paper-plane"></i> Approve & Notify Admin
      </button>
    </div>
  </div>

</body>
</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>