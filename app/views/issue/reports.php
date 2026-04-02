<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <style>
      :root {
          --primary: #4B006E;
          --secondary: #6F1A8C;
          --dark: #1e293b;
          --darkprimary: #15001e;
          --light: #f8fafc;
          --text: #111827;
          --muted: #6b7280;
          --success: #10b981;
          --danger: #ef4444;
          --warning: #f59e0b;
          --gray: #64748b;
          --border: #e2e8f0;
          --card-bg: #eae6f1;
      }

      * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
      }

      body {
          font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
          background-color: var(--light);
          color: var(--text);
          line-height: 1.6;
          padding: 24px;
          margin-top: 40px;
          margin-left: 270px;
          max-width: calc(100% - 270px);
          width: 100%;
          box-sizing: border-box;
      }

      /* Header Styles */
      .header {
          display: flex;
          justify-content: space-between;
          align-items: flex-start;
          margin-bottom: 32px;
          padding-bottom: 24px;
          border-bottom: 1px solid var(--border);
      }

      .logo-section {
          display: flex;
          flex-direction: column;
      }

      .logo {
          font-size: 28px;
          font-weight: 700;
          color: var(--primary);
          display: flex;
          align-items: center;
          margin-bottom: 8px;
      }

      .logo i {
          margin-right: 12px;
          font-size: 32px;
      }

      .page-title {
          font-size: 24px;
          font-weight: 600;
          color: var(--text);
          margin-top: 4px;
      }

      .coordinator-info {
          text-align: right;
      }

      .coordinator-name {
          font-size: 20px;
          font-weight: 700;
          color: var(--primary);
          margin-bottom: 4px;
      }

      .event-count {
          font-size: 15px;
          color: var(--muted);
          margin-bottom: 4px;
      }

      .report-period {
          font-size: 16px;
          font-weight: 500;
          color: var(--text);
      }

      .pdf-button {
          background: var(--primary);
          color: white;
          border: none;
          padding: 12px 24px;
          border-radius: 10px;
          font-family: 'Inter', sans-serif;
          font-weight: 600;
          font-size: 16px;
          cursor: pointer;
          display: flex;
          align-items: center;
          transition: all 0.3s ease;
          margin-top: 24px;
          box-shadow: 0 4px 12px rgba(75, 0, 110, 0.25);
      }

      .pdf-button:hover {
          background: #3a0056;
          transform: translateY(-2px);
          box-shadow: 0 6px 15px rgba(75, 0, 110, 0.35);
      }

      .pdf-button i {
          margin-right: 10px;
          font-size: 18px;
      }

      .pdf-button:active {
          transform: translateY(0);
      }

      .button-container {
          display: flex;
          gap: 12px;
          margin-top: 24px;
          flex-wrap: wrap;
      }

      .send-button {
          background: var(--success);
          color: white;
          border: none;
          padding: 12px 24px;
          border-radius: 10px;
          font-family: 'Inter', sans-serif;
          font-weight: 600;
          font-size: 16px;
          cursor: pointer;
          display: flex;
          align-items: center;
          transition: all 0.3s ease;
          box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
      }

      .send-button:hover {
          background: #059669;
          transform: translateY(-2px);
          box-shadow: 0 6px 15px rgba(16, 185, 129, 0.35);
      }

      .send-button i {
          margin-right: 10px;
          font-size: 18px;
      }

      .send-button:active {
          transform: translateY(0);
      }

      /* Report Content */
      #report-content {
          background: white;
          border-radius: 16px;
          box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
          padding: 40px;
          max-width: 1400px;
          margin: 0 auto;
      }

      .section {
          margin-bottom: 48px;
      }

      .section-header {
          font-size: 16px;
          font-weight: 600;
          color: var(--primary);
          margin-bottom: 24px;
          padding-bottom: 12px;
          border-bottom: 2px solid var(--card-bg);
          display: flex;
          align-items: center;
      }

      .section-header i {
          margin-right: 12px;
          font-size: 20px;
      }

      .section-intro {
          color: var(--muted);
          font-size: 14px;
          line-height: 1.7;
          margin-bottom: 24px;
          padding: 16px;
          background: rgba(75, 0, 110, 0.03);
          border-radius: 10px;
          border-left: 3px solid var(--primary);
      }

      /* Metric Cards */
      .metrics-grid {
          display: grid;
          grid-template-columns: repeat(4, 1fr);
          gap: 24px;
          margin-bottom: 36px;
      }

      .metric-card {
          background: white;
          border-left: 4px solid var(--primary);
          border-radius: 12px;
          padding: 20px;
          box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
          transition: transform 0.3s ease;
      }

      .metric-card:hover {
          transform: translateY(-3px);
      }

      .metric-label {
          font-size: 14px;
          color: var(--muted);
          margin-bottom: 8px;
      }

      .metric-value {
          font-size: 32px;
          font-weight: 700;
          color: var(--text);
          margin-bottom: 4px;
      }

      .metric-delta {
          font-size: 14px;
          font-weight: 600;
      }

      .metric-delta.positive {
          color: var(--success);
      }

      .metric-delta.negative {
          color: var(--danger);
      }

      /* Charts */
      .chart-container {
          background: white;
          border-radius: 12px;
          padding: 24px;
          box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
          margin-bottom: 24px;
      }

      .chart-title {
          font-size: 16px;
          font-weight: 600;
          color: var(--text);
          margin-bottom: 20px;
          text-align: center;
      }

      .chart-wrapper {
          position: relative;
          height: 320px;
          width: 100%;
      }

      .chart-legend {
          display: flex;
          justify-content: center;
          flex-wrap: wrap;
          gap: 24px;
          margin-top: 20px;
          padding-top: 16px;
          border-top: 1px solid var(--border);
      }

      .legend-item {
          display: flex;
          align-items: center;
          font-size: 14px;
          font-weight: 500;
      }

      .legend-color {
          width: 16px;
          height: 16px;
          border-radius: 4px;
          margin-right: 8px;
      }

      /* Tables */
      .table-container {
          overflow-x: auto;
          border-radius: 12px;
          box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
          margin-bottom: 24px;
      }

      table {
          width: 100%;
          border-collapse: collapse;
          min-width: 800px;
      }

      thead {
          background-color: var(--card-bg);
          color: var(--dark);
      }

      th {
          padding: 14px 16px;
          text-align: left;
          font-size: 12px;
          font-weight: 600;
          text-transform: uppercase;
          letter-spacing: 0.5px;
      }

      tbody tr {
          border-bottom: 1px solid var(--border);
      }

      tbody tr:nth-child(even) {
          background-color: var(--light);
      }

      tbody tr:hover {
          background-color: rgba(75, 0, 110, 0.03);
      }

      td {
          padding: 14px 16px;
          font-size: 14px;
      }

      /* Badges */
      .badge {
          display: inline-block;
          padding: 4px 10px;
          border-radius: 20px;
          font-size: 11px;
          font-weight: 600;
          text-transform: uppercase;
          letter-spacing: 0.5px;
      }

      .badge.resolved {
          background-color: #d1fae5;
          color: #065f46;
      }

      .badge.in-progress {
          background-color: #dbeafe;
          color: #1e40af;
      }

      .badge.escalated {
          background-color: #fee2e2;
          color: #991b1b;
      }

      .badge.cancelled {
          background-color: #f1f5f9;
          color: #475569;
      }

      .badge.refunded {
          background-color: #fef3c7;
          color: #92400e;
      }

      .badge.high {
          background-color: #fee2e2;
          color: #991b1b;
      }

      .badge.medium {
          background-color: #ffedd5;
          color: #9a3412;
      }

      .badge.low {
          background-color: #d1fae5;
          color: #065f46;
      }

      .badge.critical {
          background-color: #fecaca;
          color: #991b1b;
          font-weight: 700;
      }

      .badge.high-priority {
          background-color: #ffedd5;
          color: #9a3412;
      }

      .badge.medium-priority {
          background-color: #dbeafe;
          color: #1e40af;
      }

      /* Summary Text */
      .summary-text {
          background: rgba(16, 185, 129, 0.05);
          border-left: 3px solid var(--success);
          padding: 20px;
          border-radius: 0 8px 8px 0;
          margin: 24px 0;
          font-style: italic;
          line-height: 1.7;
      }

      /* Two-column layout for complaints section */
      .two-column {
          display: grid;
          grid-template-columns: 1fr;
          gap: 32px;
          margin-bottom: 32px;
          width: 100%;
      }

      .two-column > div {
          min-width: 0;
      }

      .column-title {
          font-size: 16px;
          font-weight: 600;
          color: var(--primary);
          margin-bottom: 16px;
          padding-bottom: 10px;
          border-bottom: 1px solid var(--border);
      }

      /* Stats row */
      .stats-row {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          gap: 20px;
          margin: 24px 0;
      }

      .stat-box {
          background: white;
          border-radius: 12px;
          padding: 20px;
          text-align: center;
          box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      }

      .stat-label {
          font-size: 14px;
          color: var(--muted);
          margin-bottom: 8px;
      }

      .stat-value {
          font-size: 24px;
          font-weight: 700;
          color: var(--primary);
      }

      /* Sign-off section */
      .sign-off {
          background: var(--card-bg);
          border-radius: 16px;
          padding: 32px;
          margin-top: 24px;
          text-align: center;
          border: 1px solid var(--border);
      }

      .sign-off p {
          margin-bottom: 12px;
          font-size: 16px;
          font-weight: 500;
      }

      .signature-line {
          width: 250px;
          height: 2px;
          background: var(--text);
          margin: 24px auto;
          position: relative;
      }

      .signature-line::after {
          content: "Digital Signature";
          position: absolute;
          bottom: -24px;
          left: 50%;
          transform: translateX(-50%);
          font-size: 13px;
          color: var(--muted);
          font-style: italic;
      }

      .submitted-date {
          font-weight: 600;
          color: var(--primary);
          margin-top: 8px;
          font-size: 16px;
      }

      /* Responsive adjustments */
      @media (max-width: 1200px) {
          .metrics-grid {
              grid-template-columns: repeat(2, 1fr);
          }
          
          .two-column {
              grid-template-columns: 1fr;
          }
          
          .stats-row {
              grid-template-columns: 1fr;
          }
          
          #report-content {
              padding: 30px;
          }
      }

      @media (max-width: 1024px) {
          body {
              margin-left: 0;
              margin-top: 70px;
              max-width: 100%;
          }
      }

      @media (max-width: 768px) {
          body {
              margin-left: 0;
              margin-top: 70px;
              padding: 16px;
              max-width: 100%;
          }
          
          .header {
              flex-direction: column;
              align-items: flex-start;
          }
          
          .coordinator-info {
              text-align: left;
              margin-top: 20px;
          }
          
          .metrics-grid {
              grid-template-columns: 1fr;
          }
          
          #report-content {
              padding: 24px;
          }
          
          .chart-wrapper {
              height: 280px;
          }
          
          .pdf-button {
              width: 100%;
              margin-top: 16px;
          }
          
          .button-container {
              flex-direction: column;
          }
          
          .send-button {
              width: 100%;
          }
      }

      @media (max-width: 480px) {
          body {
              padding: 16px;
              margin-left: 0;
              margin-top: 70px;
              max-width: 100%;
          }
          
          #report-content {
              padding: 20px;
              border-radius: 12px;
          }
          
          .section-header {
              font-size: 15px;
          }
          
          .metric-value {
              font-size: 28px;
          }
          
          .chart-wrapper {
              height: 240px;
          }
          
          table {
              min-width: 600px;
          }
          
          td, th {
              padding: 10px 12px;
              font-size: 13px;
          }
      }

      /* Loading state for PDF generation */
      .pdf-loading {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(255, 255, 255, 0.9);
          z-index: 1000;
          flex-direction: column;
          justify-content: center;
          align-items: center;
      }

      .pdf-loading.active {
          display: flex;
      }

      .pdf-spinner {
          width: 60px;
          height: 60px;
          border: 5px solid rgba(75, 0, 110, 0.2);
          border-top: 5px solid var(--primary);
          border-radius: 50%;
          animation: spin 1s linear infinite;
          margin-bottom: 24px;
      }

      .pdf-message {
          font-size: 18px;
          font-weight: 600;
          color: var(--primary);
      }

      @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
      }
  </style>
</head>
<body>
    <!-- PDF Generation Loading Overlay -->
    <div class="pdf-loading" id="pdf-loading">
        <div class="pdf-spinner"></div>
        <div class="pdf-message">Generating PDF Report... Please wait</div>
    </div>

    <!-- Header with PDF button outside report-content -->
    <div class="header">
        <div class="logo-section">
            
            <div class="page-title">Weekly Report</div>
        </div>
        <div class="coordinator-info">
            <div class="coordinator-name">Nimal Perera</div>
            <div class="event-count">Managing 12 Assigned Events</div>
            <div class="report-period">Week of 23 Jun – 29 Jun 2025</div>
        </div>
    </div>
    
    <div class="button-container">
        <button class="pdf-button" id="download-pdf">
            <i class="fas fa-download"></i> Download PDF Report
        </button>
        <button class="send-button" id="send-report">
            <i class="fas fa-paper-plane"></i> Send to Admin
        </button>
    </div>

    <!-- Report Content (will be captured for PDF) -->
    <div id="report-content">
        <!-- Section 1: Summary Overview -->
        <div class="section">
            <h2 class="section-header">
                <i class="fas fa-chart-line"></i> Summary Overview
            </h2>
            
            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-label">Total Issues Handled</div>
                    <div class="metric-value">24</div>
                    <div class="metric-delta positive">
                        <i class="fas fa-arrow-up"></i> +8 vs previous week
                    </div>
                </div>
                <div class="metric-card">
                    <div class="metric-label">Complaints Resolved</div>
                    <div class="metric-value">19</div>
                    <div class="metric-delta positive">
                        <i class="fas fa-arrow-up"></i> +5 vs previous week
                    </div>
                </div>
                <div class="metric-card">
                    <div class="metric-label">Replacements Made</div>
                    <div class="metric-value">3</div>
                    <div class="metric-delta negative">
                        <i class="fas fa-arrow-up"></i> +1 vs previous week
                    </div>
                </div>
                <div class="metric-card">
                    <div class="metric-label">Escalations to Admin</div>
                    <div class="metric-value">2</div>
                    <div class="metric-delta negative">
                        <i class="fas fa-arrow-up"></i> +2 vs previous week
                    </div>
                </div>
            </div>
            
            <div class="chart-container">
                <div class="chart-title">Weekly Activity Breakdown</div>
                <div class="chart-wrapper">
                    <canvas id="activityChart"></canvas>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #4B006E;"></div>
                        <span>Issues Raised</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #10b981;"></div>
                        <span>Issues Resolved</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #ef4444;"></div>
                        <span>Escalations</span>
                    </div>
                </div>
            </div>
            
            <div class="summary-text">
                This week, Nimal Perera handled 24 issues across 12 events. Resolution rate stood at 79%. 2 issues were escalated to the admin due to complexity beyond coordinator authority, including a major venue cancellation and a payment dispute exceeding LKR 150,000.
            </div>
        </div>
        
        <!-- Section 2: Event Monitoring -->
        <div class="section">
            <h2 class="section-header">
                <i class="fas fa-exclamation-triangle"></i> Event Monitoring & Threat Identification
            </h2>
            
            <div class="section-intro">
                Each issue coordinator monitors 10–15 assigned events for potential risks including vendor conflicts, scheduling gaps, and client dissatisfaction signals.
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Date</th>
                            <th>Venue</th>
                            <th>Threat Level</th>
                            <th>Threat Type</th>
                            <th>Action Taken</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Colombo Tech Summit</td>
                            <td>25 Jun 2025</td>
                            <td>Battaramulla Convention Center</td>
                            <td><span class="badge high">High</span></td>
                            <td>Vendor Conflict</td>
                            <td>Mediated between AV provider and venue management</td>
                            <td><span class="badge resolved">Resolved</span></td>
                        </tr>
                        <tr>
                            <td>Kandy Wedding Expo</td>
                            <td>27 Jun 2025</td>
                            <td>Mahaweli Reach Hotel</td>
                            <td><span class="badge medium">Medium</span></td>
                            <td>Scheduling Gap</td>
                            <td>Rescheduled catering setup time</td>
                            <td><span class="badge resolved">Resolved</span></td>
                        </tr>
                        <tr>
                            <td>Galle Food Festival</td>
                            <td>28 Jun 2025</td>
                            <td>Galle Face Green</td>
                            <td><span class="badge high">High</span></td>
                            <td>Weather Risk</td>
                            <td>Secured backup indoor venue option</td>
                            <td><span class="badge in-progress">In Progress</span></td>
                        </tr>
                        <tr>
                            <td>Nuwara Eliya Corporate Retreat</td>
                            <td>26 Jun 2025</td>
                            <td>Grand Hotel</td>
                            <td><span class="badge low">Low</span></td>
                            <td>Client Dissatisfaction</td>
                            <td>Arranged complimentary upgrade</td>
                            <td><span class="badge resolved">Resolved</span></td>
                        </tr>
                        <tr>
                            <td>Jaffna Cultural Night</td>
                            <td>29 Jun 2025</td>
                            <td>Jaffna Public Library</td>
                            <td><span class="badge medium">Medium</span></td>
                            <td>Permit Issue</td>
                            <td>Contacted local authorities for expedited approval</td>
                            <td><span class="badge in-progress">In Progress</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="summary-text">
                5 events were flagged this week. 3 were resolved at coordinator level. 2 remain under active monitoring and may require admin review if weather conditions deteriorate for the Galle Food Festival.
            </div>
        </div>
        
        <!-- Section 3: Service Provider Replacements -->
        <div class="section">
            <h2 class="section-header">
                <i class="fas fa-exchange-alt"></i> Service Provider Replacements
            </h2>
            
            <div class="section-intro">
                Replacements are initiated when a service provider fails to meet quality standards, is unresponsive, or cancels last minute.
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Original Provider</th>
                            <th>Replacement Provider</th>
                            <th>Reason</th>
                            <th>Replacement Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Colombo Tech Summit</td>
                            <td>Elite Audio Visual</td>
                            <td>SoundWave Solutions</td>
                            <td>No-show</td>
                            <td>24 Jun 2025</td>
                            <td><span class="badge resolved">Completed</span></td>
                        </tr>
                        <tr>
                            <td>Kandy Wedding Expo</td>
                            <td>Premier Catering Co.</td>
                            <td>Spice Garden Caterers</td>
                            <td>Quality issue</td>
                            <td>26 Jun 2025</td>
                            <td><span class="badge resolved">Completed</span></td>
                        </tr>
                        <tr>
                            <td>Galle Food Festival</td>
                            <td>Lanka Tent Masters</td>
                            <td>Ocean View Marquees</td>
                            <td>Cancellation</td>
                            <td>27 Jun 2025</td>
                            <td><span class="badge in-progress">In Progress</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="chart-container">
                <div class="chart-title">Replacement Reasons Breakdown</div>
                <div class="chart-wrapper">
                    <canvas id="replacementsChart"></canvas>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #ef4444;"></div>
                        <span>No-show</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #f59e0b;"></div>
                        <span>Quality issue</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #4B006E;"></div>
                        <span>Cancellation</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #64748b;"></div>
                        <span>Unresponsive</span>
                    </div>
                </div>
            </div>
            
            <div class="summary-text">
                3 provider replacements were completed this week. The most common reason was no-show (33%). All replacements were confirmed before the event date with minimal disruption to client experience.
            </div>
        </div>
        
        <!-- Section 4: Complaints Handled -->
        <div class="section">
            <h2 class="section-header">
                <i class="fas fa-comment-dots"></i> Complaints Handled
            </h2>
            
            <div class="section-intro">
                Complaints from both clients and service providers are reviewed, investigated, and resolved or escalated by the issue coordinator.
            </div>
            
            <div class="two-column">
                <div>
                    <div class="column-title">Client Complaints</div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Client Name</th>
                                    <th>Event</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Resolution</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>COMP-7845</td>
                                    <td>Anjali Silva</td>
                                    <td>Colombo Tech Summit</td>
                                    <td>Service Quality</td>
                                    <td>24 Jun</td>
                                    <td>Partial refund issued</td>
                                    <td><span class="badge resolved">Resolved</span></td>
                                </tr>
                                <tr>
                                    <td>COMP-7851</td>
                                    <td>Rohan Fernando</td>
                                    <td>Kandy Wedding Expo</td>
                                    <td>Delay</td>
                                    <td>26 Jun</td>
                                    <td>Provider warning issued</td>
                                    <td><span class="badge resolved">Resolved</span></td>
                                </tr>
                                <tr>
                                    <td>COMP-7862</td>
                                    <td>Nadeesha Perera</td>
                                    <td>Galle Food Festival</td>
                                    <td>Communication</td>
                                    <td>27 Jun</td>
                                    <td>Escalated to admin</td>
                                    <td><span class="badge escalated">Escalated</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <div class="column-title">Service Provider Complaints</div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Provider Name</th>
                                    <th>Event</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Resolution</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>COMP-7848</td>
                                    <td>Elite Audio Visual</td>
                                    <td>Colombo Tech Summit</td>
                                    <td>Payment Issue</td>
                                    <td>24 Jun</td>
                                    <td>Payment processed</td>
                                    <td><span class="badge resolved">Resolved</span></td>
                                </tr>
                                <tr>
                                    <td>COMP-7855</td>
                                    <td>Premier Catering Co.</td>
                                    <td>Kandy Wedding Expo</td>
                                    <td>Client Behavior</td>
                                    <td>26 Jun</td>
                                    <td>Mediation completed</td>
                                    <td><span class="badge resolved">Resolved</span></td>
                                </tr>
                                <tr>
                                    <td>COMP-7867</td>
                                    <td>Lanka Tent Masters</td>
                                    <td>Galle Food Festival</td>
                                    <td>Contract Dispute</td>
                                    <td>28 Jun</td>
                                    <td>Under investigation</td>
                                    <td><span class="badge in-progress">In Progress</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="chart-container">
                <div class="chart-title">Complaints by Type</div>
                <div class="chart-wrapper">
                    <canvas id="complaintsChart"></canvas>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #6F1A8C;"></div>
                        <span>Service Quality</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #6F1A8C;"></div>
                        <span>Communication</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #6F1A8C;"></div>
                        <span>Delay</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #6F1A8C;"></div>
                        <span>Payment Issue</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #6F1A8C;"></div>
                        <span>Other</span>
                    </div>
                </div>
            </div>
            
            <div class="summary-text">
                6 client complaints and 3 provider complaints were handled this week. 78% were fully resolved. 2 were escalated to admin due to complexity and financial implications exceeding coordinator authority limits.
            </div>
        </div>
        
        <!-- Section 5: Payment Refunds & Cancellations -->
        <div class="section">
            <h2 class="section-header">
                <i class="fas fa-credit-card"></i> Payment Refunds & Cancellations
            </h2>
            
            <div class="section-intro">
                The coordinator reviews flagged transactions and processes refunds or cancellations where applicable.
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Client Name</th>
                            <th>Event</th>
                            <th>Amount (LKR)</th>
                            <th>Type</th>
                            <th>Reason</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TXN-45678</td>
                            <td>Anjali Silva</td>
                            <td>Colombo Tech Summit</td>
                            <td>28,500</td>
                            <td>Refund</td>
                            <td>Service quality below standard</td>
                            <td>24 Jun</td>
                            <td><span class="badge refunded">Refunded</span></td>
                        </tr>
                        <tr>
                            <td>TXN-45682</td>
                            <td>Rohan Fernando</td>
                            <td>Kandy Wedding Expo</td>
                            <td>15,750</td>
                            <td>Refund</td>
                            <td>Vendor delay exceeding 60 mins</td>
                            <td>26 Jun</td>
                            <td><span class="badge refunded">Refunded</span></td>
                        </tr>
                        <tr>
                            <td>TXN-45691</td>
                            <td>Nadeesha Perera</td>
                            <td>Galle Food Festival</td>
                            <td>42,300</td>
                            <td>Cancellation</td>
                            <td>Client-initiated (medical emergency)</td>
                            <td>27 Jun</td>
                            <td><span class="badge cancelled">Cancelled</span></td>
                        </tr>
                        <tr>
                            <td>TXN-45695</td>
                            <td>Dinesh Jayawardena</td>
                            <td>Nuwara Eliya Retreat</td>
                            <td>68,900</td>
                            <td>Refund</td>
                            <td>Partial service delivery</td>
                            <td>28 Jun</td>
                            <td><span class="badge pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>TXN-45701</td>
                            <td>Chamari Abeywickrama</td>
                            <td>Jaffna Cultural Night</td>
                            <td>35,200</td>
                            <td>Cancellation</td>
                            <td>Permit denial by authorities</td>
                            <td>29 Jun</td>
                            <td><span class="badge escalated">Escalated</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-label">Total Refunded</div>
                    <div class="stat-value">LKR 44,250</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Cancelled</div>
                    <div class="stat-value">LKR 77,500</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Pending Review</div>
                    <div class="stat-value">2 transactions</div>
                </div>
            </div>
            
            <div class="summary-text">
                5 transactions were reviewed this week. LKR 44,250 was refunded to clients. 2 cancellations were processed totaling LKR 77,500. 2 transactions remain under review pending additional documentation from clients.
            </div>
        </div>
        
        <!-- Section 6: Event Cancellations -->
        <div class="section">
            <h2 class="section-header">
                <i class="fas fa-times-circle"></i> Event Cancellations
            </h2>
            
            <div class="section-intro">
                Event cancellations are processed by the coordinator upon client or organiser request, following the platform's cancellation policy.
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Client</th>
                            <th>Scheduled Date</th>
                            <th>Cancellation Date</th>
                            <th>Reason</th>
                            <th>Refund Status</th>
                            <th>Handled By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Galle Food Festival (Sat)</td>
                            <td>Nadeesha Perera</td>
                            <td>28 Jun 2025</td>
                            <td>27 Jun 2025</td>
                            <td>Medical emergency</td>
                            <td>Full refund approved</td>
                            <td>Nimal Perera</td>
                        </tr>
                        <tr>
                            <td>Jaffna Cultural Night</td>
                            <td>Chamari Abeywickrama</td>
                            <td>29 Jun 2025</td>
                            <td>29 Jun 2025</td>
                            <td>Permit denial</td>
                            <td>Partial refund (70%)</td>
                            <td>Nimal Perera</td>
                        </tr>
                        <tr>
                            <td>Bentota Beach Wedding</td>
                            <td>Kasun Rajapaksa</td>
                            <td>05 Jul 2025</td>
                            <td>28 Jun 2025</td>
                            <td>Provider unavailability</td>
                            <td>Full refund approved</td>
                            <td>Nimal Perera</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="summary-text">
                3 events were cancelled this week. 2 were client-initiated and 1 was due to provider unavailability. All cancellations followed the EvoPlan cancellation policy with appropriate refunds processed according to timing and circumstances.
            </div>
        </div>
        
        <!-- Section 7: Escalations to Admin -->
        <div class="section">
            <h2 class="section-header">
                <i class="fas fa-level-up-alt"></i> Escalations to Admin
            </h2>
            
            <div class="section-intro">
                Issues beyond the coordinator's authority are formally escalated to the admin with full context and recommended actions.
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Escalation ID</th>
                            <th>Issue Type</th>
                            <th>Related Event</th>
                            <th>Description</th>
                            <th>Date Raised</th>
                            <th>Priority</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ESC-1124</td>
                            <td>Payment Dispute</td>
                            <td>Galle Food Festival</td>
                            <td>Client demanding full refund despite partial service delivery; amount exceeds LKR 40,000 threshold</td>
                            <td>27 Jun 2025</td>
                            <td><span class="badge critical">Critical</span></td>
                            <td><span class="badge escalated">Pending Review</span></td>
                        </tr>
                        <tr>
                            <td>ESC-1125</td>
                            <td>Venue Cancellation</td>
                            <td>Colombo Tech Summit</td>
                            <td>Venue owner cancelled 48hrs before event due to structural concerns; requires emergency relocation</td>
                            <td>23 Jun 2025</td>
                            <td><span class="badge high-priority">High</span></td>
                            <td><span class="badge resolved">Resolved</span></td>
                        </tr>
                        <tr>
                            <td>ESC-1126</td>
                            <td>Contract Dispute</td>
                            <td>Jaffna Cultural Night</td>
                            <td>Provider demanding additional payment not in original contract; client refuses to pay</td>
                            <td>29 Jun 2025</td>
                            <td><span class="badge medium-priority">Medium</span></td>
                            <td><span class="badge in-progress">Under Review</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="summary-text">
                3 issues were escalated to admin this week. 1 is marked critical requiring immediate attention. The coordinator recommends establishing a special contingency fund for emergency venue relocations to prevent future disruptions to major events.
            </div>
        </div>
        
        <!-- Footer: Coordinator Sign-off -->
        <div class="sign-off">
            <p>Report prepared by: <strong>Nimal Perera</strong></p>
            <p>Report Period: <strong>Week of 23 Jun – 29 Jun 2025</strong></p>
            <p>Submitted to: <strong>Admin Team</strong></p>
            <div class="signature-line"></div>
            <p class="submitted-date" id="submission-date">Date Submitted: June 30, 2025</p>
        </div>
    </div>

    <script>
        // Set URLROOT for API calls
        window.URLROOT_PATH = '<?php echo URLROOT; ?>';
        
        // Set current date for submission
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('submission-date').textContent = `Date Submitted: ${today.toLocaleDateString('en-US', options)}`;
            
            // Initialize all charts
            initActivityChart();
            initReplacementsChart();
            initComplaintsChart();
            
            // Setup buttons
            document.getElementById('download-pdf').addEventListener('click', generatePDF);
            document.getElementById('send-report').addEventListener('click', sendReport);
        });
        
        function initActivityChart() {
            const ctx = document.getElementById('activityChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [
                        {
                            label: 'Issues Raised',
                            data: [4, 3, 5, 2, 6, 3, 1],
                            backgroundColor: '#4B006E',
                            borderColor: '#4B006E',
                            borderWidth: 1,
                            borderRadius: 6,
                            borderSkipped: false
                        },
                        {
                            label: 'Issues Resolved',
                            data: [3, 4, 4, 3, 5, 2, 2],
                            backgroundColor: '#10b981',
                            borderColor: '#10b981',
                            borderWidth: 1,
                            borderRadius: 6,
                            borderSkipped: false
                        },
                        {
                            label: 'Escalations',
                            data: [0, 0, 1, 0, 1, 0, 0],
                            backgroundColor: '#ef4444',
                            borderColor: '#ef4444',
                            borderWidth: 1,
                            borderRadius: 6,
                            borderSkipped: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                stepSize: 2
                            }
                        }
                    },
                    interaction: {
                        mode: 'index'
                    },
                    barPercentage: 0.7,
                    categoryPercentage: 0.8
                }
            });
        }
        
        function initReplacementsChart() {
            const ctx = document.getElementById('replacementsChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['No-show', 'Quality issue', 'Cancellation', 'Unresponsive'],
                    datasets: [{
                        data: [1, 1, 1, 0],
                        backgroundColor: [
                            '#ef4444', // No-show
                            '#f59e0b', // Quality issue
                            '#4B006E', // Cancellation
                            '#64748b'  // Unresponsive
                        ],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    return `${label}: ${value} (${Math.round(value / 3 * 100)}%)`;
                                }
                            }
                        }
                    },
                    cutout: '70%',
                    rotation: -90,
                    circumference: 360
                }
            });
        }
        
        function initComplaintsChart() {
            const ctx = document.getElementById('complaintsChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Service Quality', 'Communication', 'Delay', 'Payment Issue', 'Other'],
                    datasets: [{
                        label: 'Complaint Count',
                        data: [4, 2, 3, 2, 1],
                        backgroundColor: '#6F1A8C',
                        borderColor: '#6F1A8C',
                        borderWidth: 1,
                        borderRadius: 6,
                        borderSkipped: false
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            }
                        }
                    },
                    barPercentage: 0.8,
                    categoryPercentage: 0.9
                }
            });
        }
        
        // PDF Generation Function
        function generatePDF() {
            const loadingOverlay = document.getElementById('pdf-loading');
            loadingOverlay.classList.add('active');
            
            // Get the report content element
            const reportContent = document.getElementById('report-content');
            
            // Temporarily adjust styles for PDF
            const originalPadding = reportContent.style.padding;
            reportContent.style.padding = '30px';
            
            // Capture the element as image
            html2canvas(reportContent, {
                scale: 2,
                useCORS: true,
                logging: false,
                onclone: (document) => {
                    // Fix any rendering issues in the cloned document
                }
            }).then(canvas => {
                // Restore original padding
                reportContent.style.padding = originalPadding;
                
                // Create PDF
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jspdf.jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });
                
                // Calculate dimensions to fit content
                const imgWidth = 210; // A4 width in mm
                const pageHeight = 297; // A4 height in mm
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;
                
                // Add first page
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
                
                // Add additional pages if needed
                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                
                // Save PDF
                pdf.save(`EvoPlan_Weekly_Report_Nimal_Perera_${new Date().toISOString().slice(0,10)}.pdf`);
                
                // Hide loading overlay
                loadingOverlay.classList.remove('active');
                
                // Show success feedback
                alert('PDF report successfully generated and downloaded!');
            }).catch(error => {
                console.error('PDF generation error:', error);
                loadingOverlay.classList.remove('active');
                alert('Error generating PDF. Please try again or contact support.');
            });
        }

        // Send Report Function
        function sendReport() {
            const coordinatorName = 'Nimal Perera';
            const reportPeriod = 'Week of 23 Jun – 29 Jun 2025';
            
            // Prepare report data
            const reportData = {
                coordinator_name: coordinatorName,
                report_period: reportPeriod,
                submission_date: new Date().toISOString(),
                content: document.getElementById('report-content').innerHTML
            };

            // Show loading overlay
            const loadingOverlay = document.getElementById('pdf-loading');
            loadingOverlay.classList.add('active');
            
            // Update message
            const message = loadingOverlay.querySelector('.pdf-message');
            message.textContent = 'Sending report to Admin... Please wait';

            // Send report via AJAX
            fetch(window.URLROOT_PATH + '/api/report/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(reportData)
            })
            .then(response => {
                if(!response.ok) throw new Error(`HTTP ${response.status}`);
                return response.json();
            })
            .then(data => {
                loadingOverlay.classList.remove('active');
                message.textContent = 'Generating PDF Report... Please wait';
                
                if(data.success || data.submission_id) {
                    const submissionId = data.submission_id || 'REP-' + new Date().toISOString().slice(0,10);
                    alert(`✓ Report successfully sent to Admin!\n\nSubmission ID: ${submissionId}\nTime: ${new Date().toLocaleString()}\n\nThe admin will review and process this report shortly.`);
                } else {
                    throw new Error(data.message || 'Unknown error occurred');
                }
            })
            .catch(error => {
                console.error('Send report error:', error);
                loadingOverlay.classList.remove('active');
                message.textContent = 'Generating PDF Report... Please wait';
                
                // Provide helpful message even if API fails
                alert(`⚠ Report submission encountered an issue.\n\nError: ${error.message}\n\nYou can:\n1. Try sending again\n2. Download as PDF and send manually\n3. Contact support if the issue persists`);
            });
        }
    </script>
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        // Fallback for Font Awesome if kit fails
        if (!window.FontAwesome) {
            document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">');
        }
    </script>
</body>
</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>
