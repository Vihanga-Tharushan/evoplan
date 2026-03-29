<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>

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
      --primary: #4B006E;     /* Dark purple */
      --secondary: #6F1A8C;   /* Accent violet */
      --dark: #0b1026;         /* Background dark */
      --light: #f7f8fc;        /* Light section background */
      --text: #111827;         /* Main text */
      --muted: #6b7280;        /* Subtext / secondary text */
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: var(--bg);
      color: var(--text);
      padding: 24px;
    }

    .reports{
        margin-left: 270px;
        margin-top: 70px;
    }
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 32px;
      flex-wrap: wrap;
      gap: 16px;
    }

    .page-header h1 {
      font-size: 28px;
      font-weight: 700;
    }

    .date-selector {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
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

    .btn-outline {
      border: 1px solid var(--border);
      color: var(--text);
    }

    .btn-primary {
      background: var(--primary);
      color: white;
    }

    /* Summary Cards */
    .summary-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 24px;
      margin-bottom: 32px;
    }

    .summary-card {
      background: var(--panel);
      border-radius: var(--radius);
      padding: 24px;
      box-shadow: var(--shadow);
      text-align: center;
    }

    .summary-value {
      font-size: 32px;
      font-weight: 800;
      margin: 12px 0;
      line-height: 1;
    }

    .summary-label {
      color: var(--muted);
      font-size: 14px;
    }

    .trend-up { color: var(--success); }
    .trend-down { color: var(--danger); }

    /* Charts Placeholder */
    .chart-container {
      background: var(--panel);
      border-radius: var(--radius);
      padding: 24px;
      box-shadow: var(--shadow);
      margin-bottom: 32px;
    }

    .chart-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .chart-placeholder {
      height: 200px;
      background: var(--muted-surface);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--muted);
      font-style: italic;
    }

    /* Detailed Tables */
    .report-section {
      background: var(--panel);
      border-radius: var(--radius);
      padding: 24px;
      box-shadow: var(--shadow);
      margin-bottom: 32px;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
      align-items: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 14px;
      text-align: left;
      border-bottom: 1px solid var(--border);
    }

    th {
      color: var(--muted);
      font-weight: 600;
    }

    tr:last-child td {
      border-bottom: none;
    }

    .badge {
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-success { background: var(--success); color: white; }
    .badge-warning { background: var(--warning); color: white; }
    .badge-danger { background: var(--danger); color: white; }

    .actions a {
      color: var(--primary);
      text-decoration: none;
      margin-right: 12px;
    }

    .actions a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<div class="reports">
  <div class="page-header">
    <h1>Reports & Logs</h1>
    <div class="date-selector">
      <select class="btn-outline">
        <option>Weekly (Jan 6–13, 2026)</option>
        <option>Monthly (January 2026)</option>
        <option>Quarterly (Q1 2026)</option>
      </select>
      <button class="btn btn-outline">
        <i class="fas fa-download"></i> Export CSV
      </button>
      <button class="btn btn-primary">
        <i class="fas fa-paper-plane"></i> Send to Admin
      </button>
    </div>
  </div>

  <!-- Summary Metrics -->
  <div class="summary-grid">
    <div class="summary-card">
      <div class="summary-label">Issues Handled</div>
      <div class="summary-value">24</div>
      <div><span class="trend-up">↑ 12%</span> vs last week</div>
    </div>
    <div class="summary-card">
      <div class="summary-label">Provider Cancellations</div>
      <div class="summary-value">5</div>
      <div><span class="trend-down">↓ 20%</span> vs last week</div>
    </div>
    <div class="summary-card">
      <div class="summary-label">Replacement Success Rate</div>
      <div class="summary-value">92%</div>
      <div><span class="trend-up">↑ 5%</span> vs last week</div>
    </div>
    <div class="summary-card">
      <div class="summary-label">Payment Issues Resolved</div>
      <div class="summary-value">8 / 9</div>
      <div><span class="trend-up">89% resolution</span></div>
    </div>
  </div>

  <!-- SLA Response Times Chart -->
  <div class="chart-container">
    <div class="chart-header">
      <h2>SLA Compliance: Issue Response Time</h2>
      <div style="color: var(--success); font-weight: 600;">
        <i class="fas fa-check-circle"></i> 94% within 2 hours
      </div>
    </div>
    <div class="chart-placeholder">
      [Bar chart: Avg response time per issue type]
    </div>
  </div>

  <!-- Provider Reliability Table -->
  <div class="report-section">
    <div class="section-header">
      <h2>Unreliable Providers (Top 5)</h2>
      <span style="color: var(--muted); font-size: 14px;">Based on cancellations in last 30 days</span>
    </div>
    <table>
      <thead>
        <tr>
          <th>Provider</th>
          <th>Service Type</th>
          <th>Cancellations</th>
          <th>Last Cancellation</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Alex Rivera</td>
          <td>Team Facilitation</td>
          <td>3</td>
          <td>Jan 13, 2026</td>
          <td><span class="badge badge-warning">At Risk</span></td>
          <td class="actions">
            <a href="#"><i class="fas fa-envelope"></i> Warn</a>
            <a href="#"><i class="fas fa-ban"></i> Suspend</a>
          </td>
        </tr>
        <tr>
          <td>Lisa Morgan</td>
          <td>Photography</td>
          <td>2</td>
          <td>Jan 10, 2026</td>
          <td><span class="badge badge-danger">Flagged</span></td>
          <td class="actions">
            <a href="#"><i class="fas fa-envelope"></i> Warn</a>
            <a href="#"><i class="fas fa-ban"></i> Suspend</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- IC Performance Table -->
  <div class="report-section">
    <div class="section-header">
      <h2>Issue Coordinator Performance</h2>
      <span style="color: var(--muted); font-size: 14px;">Week of Jan 6–13, 2026</span>
    </div>
    <table>
      <thead>
        <tr>
          <th>IC Name</th>
          <th>Events Managed</th>
          <th>Issues Resolved</th>
          <th>Avg. Response Time</th>
          <th>Client Satisfaction</th>
          <th>SLA Compliance</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>You (Current IC)</td>
          <td>14</td>
          <td>24</td>
          <td>1h 12m</td>
          <td>⭐ 4.8</td>
          <td><span class="badge badge-success">94%</span></td>
        </tr>
        <tr>
          <td>Sarah Kim</td>
          <td>16</td>
          <td>28</td>
          <td>1h 45m</td>
          <td>⭐ 4.6</td>
          <td><span class="badge badge-success">91%</span></td>
        </tr>
        <tr>
          <td>James Thompson</td>
          <td>12</td>
          <td>19</td>
          <td>2h 30m</td>
          <td>⭐ 4.3</td>
          <td><span class="badge badge-warning">82%</span></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- System Improvement Suggestions -->
  <div class="report-section">
    <div class="section-header">
      <h2>Recommended System Improvements</h2>
    </div>
    <ul style="padding-left: 20px; line-height: 1.6;">
      <li><strong>Auto-suspend rule:</strong> Providers with >2 cancellations in 30 days should be auto-flagged.</li>
      <li><strong>SLA threshold:</strong> Reduce max response time from 4h → 2h for high-priority issues.</li>
      <li><strong>Backup pool:</strong> Require all facilitators to confirm availability 72h before event.</li>
    </ul>
  </div>
</div>
</body>
</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>
