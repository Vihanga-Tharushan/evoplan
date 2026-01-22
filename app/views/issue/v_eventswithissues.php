<?php require APPROOT . '/views/inc/header.php'; ?>
<?php 
$backUrl = URLROOT . '/IssueC/dashboard';
require_once APPROOT . '/views/issue/taskbar/taskbar_back.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar3.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/eventswithissues.css" />
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Assigned Events</title>
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

    

    body {
      background-color: var(--bg);
      color: var(--text);
      padding: 24px;
      margin-top: 70px;
      margin-left: 200px;
    }

    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 32px;
    }

    .page-header h1 {
      font-size: 28px;
      font-weight: 700;
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

    /* Event List */
    .event-list {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .event-card {
      background: var(--panel);
      border-radius: var(--radius);
      padding: 20px;
      box-shadow: var(--shadow);
      cursor: pointer;
      transition: box-shadow 0.2s;
    }

    .event-card:hover {
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }

    .event-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
    }

    .event-id {
      font-weight: 700;
      font-size: 18px;
    }

    .status-badge {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .status-active { background: var(--available); color: var(--secondary); }
    .status-at-risk { background: var(--warning); color: white; }
    .status-issue { background: var(--danger); color: white; }
    .status-completed { background: var(--success); color: white; }

    .event-meta {
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

    /* Progress Bar */
    .progress-container {
      margin-top: 12px;
    }

    .progress-bar {
      height: 8px;
      background: var(--muted-surface);
      border-radius: 4px;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: var(--primary);
      border-radius: 4px;
    }

    .progress-text {
      font-size: 13px;
      color: var(--muted);
      margin-top: 6px;
    }

    /* Providers */
    .providers {
      margin-top: 12px;
      font-size: 14px;
    }

    .provider-tag {
      display: inline-block;
      background: var(--muted-surface);
      padding: 4px 10px;
      border-radius: 20px;
      margin-right: 8px;
      margin-top: 4px;
    }

    /* Sub-view (hidden by default) */
    .sub-view {
      margin-top: 20px;
      padding-top: 20px;
      border-top: 1px solid var(--border);
      display: none;
    }

    .sub-view.active {
      display: block;
    }

    .sub-section {
      margin-bottom: 24px;
    }

    .sub-section h3 {
      margin-bottom: 16px;
      font-size: 18px;
      color: var(--primary);
    }

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
    }

    .timeline {
      position: relative;
      padding-left: 24px;
    }

    .timeline::before {
      content: '';
      position: absolute;
      left: 8px;
      top: 0;
      bottom: 0;
      width: 2px;
      background: var(--border);
    }

    .timeline-item {
      position: relative;
      padding: 12px 0;
      margin-left: 8px;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: -16px;
      top: 16px;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: var(--primary);
    }

    .timeline-time {
      font-size: 12px;
      color: var(--muted);
    }

    .timeline-text {
      margin-top: 4px;
    }

    .conflict-warning {
      background: #fffbeb;
      border: 1px solid var(--warning);
      border-radius: 8px;
      padding: 12px;
      margin-top: 12px;
      display: flex;
      gap: 12px;
    }

    .conflict-warning i {
      color: var(--warning);
      margin-top: 4px;
    }
  </style>
</head>
<body>

  <div class="page-header">
    <h1>Assigned Events</h1>
    <button class="btn btn-outline">
      <i class="fas fa-download"></i> Export All
    </button>
  </div>

  <div class="event-list">
    <!-- Event 1 -->
    <div class="event-card" onclick="toggleSubView('event-1')">
      <div class="event-header">
        <div class="event-id">Event #E-7892</div>
        <span class="status-badge status-at-risk">At Risk</span>
      </div>
      
      <div class="event-meta">
        <div class="meta-item">
          <span class="meta-label">Client</span>
          <span class="meta-value">TechNova Inc.</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Date & Time</span>
          <span class="meta-value">Jan 14, 2026 • 14:00</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Progress</span>
          <div class="progress-container">
            <div class="progress-bar">
              <div class="progress-fill" style="width: 66%;"></div>
            </div>
            <div class="progress-text">66% — Provider Confirmed</div>
          </div>
        </div>
      </div>

      <div class="providers">
        <span class="provider-tag">Alex Rivera (Facilitator)</span>
        <span class="provider-tag">Maria Chen (Photographer)</span>
      </div>
    </div>

    <!-- Sub-view for Event 1 -->
    <div id="event-1" class="sub-view">
      <div class="sub-section">
        <h3>Event Details</h3>
        <div class="detail-grid">
          <div>
            <strong>Location:</strong> Downtown Conference Center, NYC
          </div>
          <div>
            <strong>Attendees:</strong> 24 people
          </div>
          <div>
            <strong>Special Requests:</strong> Vegan catering, AV setup
          </div>
        </div>
      </div>

      <div class="sub-section">
        <h3>Selected Packages</h3>
        <ul style="padding-left: 20px;">
          <li>Team Building Workshop ($420)</li>
          <li>Event Photography ($180)</li>
          <li>Premium Catering ($320)</li>
        </ul>
      </div>

      <div class="sub-section">
        <h3>Provider Confirmation Status</h3>
        <div style="display: flex; gap: 16px; flex-wrap: wrap;">
          <div style="background: var(--available); padding: 10px; border-radius: 8px; flex: 1; min-width: 200px;">
            <div style="font-weight: 600;">Alex Rivera</div>
            <div style="color: var(--success); margin-top: 4px;">
              <i class="fas fa-check-circle"></i> Confirmed on Jan 10
            </div>
          </div>
          <div style="background: var(--booked); padding: 10px; border-radius: 8px; flex: 1; min-width: 200px;">
            <div style="font-weight: 600;">Maria Chen</div>
            <div style="color: var(--warning); margin-top: 4px;">
              <i class="fas fa-exclamation-triangle"></i> Pending confirmation
            </div>
          </div>
        </div>
      </div>

      <div class="sub-section">
        <h3>Availability Conflicts</h3>
        <div class="conflict-warning">
          <i class="fas fa-triangle-exclamation"></i>
          <div>
            <strong>Maria Chen has overlapping booking</strong><br>
            She is scheduled for another event ending at 13:45 nearby.
          </div>
        </div>
      </div>

      <div class="sub-section">
        <h3>Event Timeline</h3>
        <div class="timeline">
          <div class="timeline-item">
            <div class="timeline-time">Jan 10, 14:30</div>
            <div class="timeline-text">Event created and assigned to IC</div>
          </div>
          <div class="timeline-item">
            <div class="timeline-time">Jan 11, 09:15</div>
            <div class="timeline-text">Alex Rivera confirmed participation</div>
          </div>
          <div class="timeline-item">
            <div class="timeline-time">Jan 12, 16:40</div>
            <div class="timeline-text">Client requested vegan catering upgrade</div>
          </div>
          <div class="timeline-item">
            <div class="timeline-time">Jan 13, 12:30</div>
            <div class="timeline-text">Maria Chen notified of potential conflict</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Event 2 -->
    <div class="event-card" onclick="toggleSubView('event-2')">
      <div class="event-header">
        <div class="event-id">Event #E-7801</div>
        <span class="status-badge status-issue">Issue Open</span>
      </div>
      
      <div class="event-meta">
        <div class="meta-item">
          <span class="meta-label">Client</span>
          <span class="meta-value">GreenLeaf Co.</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Date & Time</span>
          <span class="meta-value">Jan 15, 2026 • 10:30</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Progress</span>
          <div class="progress-container">
            <div class="progress-bar">
              <div class="progress-fill" style="width: 33%;"></div>
            </div>
            <div class="progress-text">33% — Payment Failed</div>
          </div>
        </div>
      </div>

      <div class="providers">
        <span class="provider-tag">James Thompson (Consultant)</span>
      </div>
    </div>

    <div id="event-2" class="sub-view">
      <div class="sub-section">
        <h3>Event Details</h3>
        <div class="detail-grid">
          <div>
            <strong>Location:</strong> GreenLeaf HQ, Boston
          </div>
          <div>
            <strong>Attendees:</strong> 8 people
          </div>
          <div>
            <strong>Special Requests:</strong> Whiteboard, projector
          </div>
        </div>
      </div>
      <!-- Add more sub-sections as needed -->
    </div>

    <!-- Event 3 -->
    <div class="event-card" onclick="toggleSubView('event-3')">
      <div class="event-header">
        <div class="event-id">Event #E-7755</div>
        <span class="status-badge status-completed">Completed</span>
      </div>
      
      <div class="event-meta">
        <div class="meta-item">
          <span class="meta-label">Client</span>
          <span class="meta-value">Summit Labs</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Date & Time</span>
          <span class="meta-value">Jan 13, 2026 • 09:00</span>
        </div>
        <div class="meta-item">
          <span class="meta-label">Progress</span>
          <div class="progress-container">
            <div class="progress-bar">
              <div class="progress-fill" style="width: 100%; background: var(--success);"></div>
            </div>
            <div class="progress-text">100% — Successfully Completed</div>
          </div>
        </div>
      </div>

      <div class="providers">
        <span class="provider-tag">Sarah Kim (Trainer)</span>
      </div>
    </div>

    <div id="event-3" class="sub-view">
      <!-- Sub-view content -->
    </div>
  </div>

  <script>
    function toggleSubView(id) {
      const subView = document.getElementById(id);
      const isActive = subView.classList.contains('active');
      
      // Close all
      document.querySelectorAll('.sub-view').forEach(el => el.classList.remove('active'));
      
      // Toggle clicked
      if (!isActive) {
        subView.classList.add('active');
      }
    }
  </script>
</body>
</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>