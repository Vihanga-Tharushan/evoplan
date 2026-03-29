<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>

<style>
  :root {
      --success: #10b981;
      --danger: #ef4444;
      --warning: #f59e0b;
      --light: #f8fafc;
      --dark: #1e293b;
      --gray: #64748b;
      --available: #dbeafe;
      --booked: #fecaca;
      --unavailable: #f1f5f9;
      --primary: #4B006E;
      --secondary: #6F1A8C;
      --bg-dark: #0b1026;
      --bg-light: #f7f8fc;
      --text: #111827;
      --muted: #6b7280;
  }

  /* Reset and Base Styles */
  * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
  }

  body {
      background-color: var(--bg-light);
      color: var(--text);
      line-height: 1.6;
  }

  .container {
      max-width: 1400px;
      margin-left: 270px;
      margin-top: 50px;
      padding: 24px;
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

  .tab-icon {
      width: 20px;
      height: 20px;
  }

  .badge {
      display: inline-block;
      padding: 2px 10px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 600;
      color: white;
  }

  .badge-danger {
      background-color: var(--danger);
  }

  .badge-warning {
      background-color: var(--warning);
  }

  .badge-secondary {
      background-color: var(--secondary);
  }

  .badge-success {
      background-color: var(--success);
  }

  /* Complaints Table */
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
      color: var(--muted);
      font-size: 0.8rem;
      white-space: nowrap;
  }

  /* Complaint Card */
  .complaint-card {
      background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.04);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
      position: relative;
      backdrop-filter: blur(10px);
  }

  .complaint-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 50%, var(--primary) 100%);
      opacity: 0;
      transition: opacity 0.3s ease;
  }

  .complaint-card:hover {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-color: var(--primary);
  }

  .complaint-card:hover::before {
      opacity: 1;
  }

  .card-header {
      padding: 18px 24px;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
      border-bottom: 1px solid #e2e8f0;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 16px;
      position: relative;
      overflow: hidden;
  }

  .card-header::after {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(75, 0, 110, 0.03) 0%, transparent 70%);
      pointer-events: none;
  }

  .card-info {
      flex: 1;
      position: relative;
      z-index: 1;
  }

  .card-badges {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 12px;
      flex-wrap: wrap;
  }

  .priority-badge, .status-badge, .id-badge {
      padding: 6px 12px;
      border-radius: 12px;
      font-size: 0.7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
  }

  .priority-badge:hover, .status-badge:hover, .id-badge:hover {
      transform: scale(1.05);
  }

  /* Priority Badges */
  .priority-critical {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fca5a5;
  }

  .priority-high {
      background: #fef3c7;
      color: #92400e;
      border: 1px solid #fcd34d;
  }

  .priority-medium {
      background: #ede9fe;
      color: #5b21b6;
      border: 1px solid #c4b5fd;
  }

  .priority-low {
      background: #dcfce7;
      color: #15803d;
      border: 1px solid #86efac;
  }

  /* Status Badges */
  .status-open {
      background: #dbeafe;
      color: #0c4a6e;
      border: 1px solid #7dd3fc;
  }

  .status-in_progress {
      background: #fef3c7;
      color: #78350f;
      border: 1px solid #fcd34d;
  }

  .status-resolved {
      background: #d1fae5;
      color: #065f46;
      border: 1px solid #6ee7b7;
  }

  .status-rejected {
      background: #fee2e2;
      color: #7f1d1d;
      border: 1px solid #fca5a5;
  }

  .status-escalated {
      background: #fecaca;
      color: #7f1d1d;
      border: 1px solid #f87171;
  }

  .id-badge {
      background: #f3f4f6;
      color: #4b5563;
      border: 1px solid #d1d5db;
      font-family: 'Monaco', 'Menlo', monospace;
  }

  .card-title {
      font-size: 1.15rem;
      font-weight: 800;
      color: var(--text);
      margin-bottom: 8px;
      line-height: 1.3;
      background: linear-gradient(135deg, var(--text) 0%, var(--primary) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      position: relative;
  }

  .card-title::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 40px;
      height: 3px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
  }

  .card-description {
      color: var(--muted);
      font-size: 0.9rem;
      line-height: 1.6;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      margin-bottom: 4px;
      position: relative;
  }

  .open-btn {
      padding: 12px 24px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--primary) 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-weight: 700;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      white-space: nowrap;
      box-shadow: 0 4px 16px rgba(75, 0, 110, 0.3);
      position: relative;
      overflow: hidden;
      z-index: 1;
  }

  .open-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
  }

  .open-btn:hover::before {
      left: 100%;
  }

  .open-btn:hover {
      box-shadow: 0 6px 16px rgba(75, 0, 110, 0.3);
  }

  .open-btn:active {
      transform: scale(0.98);
  }

  .card-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 0;
      padding: 0;
      border-top: none;
      margin-top: 0;
      background: rgba(248, 250, 252, 0.5);
  }

  .detail-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 16px 24px;
      border-right: 1px solid rgba(226, 232, 240, 0.5);
      border-bottom: 1px solid rgba(226, 232, 240, 0.5);
      transition: all 0.3s ease;
      position: relative;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(248, 250, 252, 0.6) 100%);
  }

  .detail-item:hover {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(241, 245, 249, 0.8) 100%);
  }

  .detail-item:last-child {
      border-right: none;
  }

  @media (max-width: 768px) {
      .detail-item {
          border-right: none;
          border-bottom: 1px solid rgba(226, 232, 240, 0.5);
      }

      .detail-item:last-child {
          border-bottom: none;
      }
  }

  .detail-icon {
      width: 24px;
      height: 24px;
      color: white;
      flex-shrink: 0;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(75, 0, 110, 0.2);
      transition: all 0.3s ease;
  }

  .detail-card:hover .detail-icon {
      transform: scale(1.1) rotate(5deg);
      box-shadow: 0 6px 16px rgba(75, 0, 110, 0.3);
  }

  .detail-content label {
      display: block;
      font-size: 0.75rem;
      color: var(--muted);
      margin-bottom: 6px;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 800;
      opacity: 0.8;
  }

  .detail-content p {
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
      line-height: 1.4;
      margin: 0;
  }

  .card-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
      border-top: 1px solid #e2e8f0;
      margin-top: auto;
  }

  .footer-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.8rem;
      color: var(--muted);
      font-weight: 600;
      transition: all 0.3s ease;
  }

  .footer-item:hover {
      color: var(--primary);
  }

  .footer-item i {
      width: 18px;
      height: 18px;
      color: var(--primary);
      filter: drop-shadow(0 1px 2px rgba(75, 0, 110, 0.15));
      transition: all 0.3s ease;
  }

  .footer-item:hover i {
      transform: scale(1.1);
      color: var(--secondary);
  }

  /* Empty State */
  .empty-state {
      background: white;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      padding: 64px 48px;
      text-align: center;
  }

  .empty-icon {
      width: 64px;
      height: 64px;
      color: var(--success);
      margin: 0 auto 16px;
  }

  .empty-state h3 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 8px;
  }

  .empty-state p {
      color: var(--muted);
  }

  /* Modal */
  .modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      padding: 24px;
  }

  .modal-content {
      background: white;
      border-radius: 8px;
      max-width: 1000px;
      width: 100%;
      max-height: 90vh;
      display: flex;
      flex-direction: column;
      overflow: hidden;
  }

  .modal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 24px;
      border-bottom: 1px solid #e5e7eb;
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
  }

  .close-btn:hover {
      background-color: #f3f4f6;
  }

  .close-btn svg {
      width: 24px;
      height: 24px;
      color: var(--muted);
  }

  .modal-body {
      flex: 1;
      overflow-y: auto;
      padding: 24px;
  }

  /* Sections */
  .section {
      margin-bottom: 32px;
  }

  .section:first-child {
      margin-top: 0;
      padding-bottom: 32px;
      border-bottom: 2px solid #e2e8f0;
  }

  .section-header {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 20px;
  }

  .section-icon {
      width: 32px;
      height: 32px;
      color: var(--primary);
      font-size: 28px;
      filter: drop-shadow(0 2px 8px rgba(75, 0, 110, 0.15));
      flex-shrink: 0;
  }

  .section-header h3 {
      font-size: 1.5rem;
      font-weight: 800;
      color: var(--text);
      letter-spacing: -0.5px;
      background: linear-gradient(135deg, var(--text) 0%, var(--primary) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin: 0;
  }

  .description-box {
      background: linear-gradient(135deg, #fffbf0 0%, #fef9f3 100%);
      border: 2px solid #fde68a;
      border-radius: 12px;
      padding: 28px 24px;
      box-shadow: 0 4px 20px rgba(75, 0, 110, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.8);
      transition: all 0.3s ease;
      
      overflow: hidden;
  }

  .description-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 50%, var(--primary) 100%);
      
  }

  .description-box p {
      color: var(--text);
      line-height: 1.8;
      font-size: 1.05rem;
      font-weight: 500;
      margin: 0;
      position: relative;
      z-index: 1;
      letter-spacing: 0.3px;
  }

  .description-box:hover {
    
      box-shadow: 0 6px 24px rgba(75, 0, 110, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.6);
  }

  /* Details Grid */
  .details-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px;
      margin-bottom: 24px;
      margin-top: 32px;
      padding-top: 0;
      background: linear-gradient(135deg, #f9f3fb 0%, #f5ecf8 100%);
      border-radius: 3%;
  }

  .detail-card {
      background-color: #ffffff;
      padding: 24px;
      border-radius: 12px;
      border: 1px solid #e9d5ff;
      box-shadow: 0 2px 12px rgba(111, 26, 140, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.7);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
  }

  .detail-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
      opacity: 0;
      transition: opacity 0.3s ease;
  }

  .detail-card:hover {
      border-color: var(--primary);
      box-shadow: 0 8px 24px rgba(75, 0, 110, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8);
      transform: translateY(-2px);
  }

  .detail-card:hover::before {
      opacity: 1;
  }

  .detail-header {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 18px;
      padding-bottom: 12px;
      border-bottom: 2px solid #f1f5f9;
  }

  .detail-header h4 {
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
      letter-spacing: -0.3px;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
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
      opacity: 0.75;
      margin: 0;
  }

  .detail-content label::after {
      content: ':';
      margin-right: 8px;
  }

  .detail-content label:not(:first-child) {
      margin-top: 0;
  }

  .detail-content p {
      font-size: 1rem;
      font-weight: 600;
      color: var(--text);
      line-height: 1.5;
      margin: 0;
      word-break: break-word;
      display: inline;
  }

  /* Resolution Section */
  .resolution-section {
      background-color: #d1fae5;
      border: 1px solid var(--success);
      padding: 16px;
      border-radius: 6px;
      margin-bottom: 24px;
  }

  .resolution-header {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 12px;
  }

  .resolution-icon {
      width: 20px;
      height: 20px;
      color: #065f46;
  }

  .resolution-header h4 {
      font-size: 1rem;
      font-weight: 600;
      color: #065f46;
  }

  .resolution-section p {
      font-size: 0.875rem;
      color: #065f46;
      margin-bottom: 8px;
  }

  /* Status Update Section */
  .status-update-section {
      background-color: var(--bg-light);
      padding: 16px;
      border-radius: 6px;
      margin-bottom: 24px;
  }

  .status-update-section h4 {
      font-size: 1rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 12px;
  }

  .status-buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 16px;
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

  .table-view-btn i {
      font-size: 12px;
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

  .system-description i {
      color: var(--primary);
      font-size: 18px;
      margin-top: 2px;
      flex-shrink: 0;
  }

  .status-btn {
      padding: 8px 16px;
      border: 1px solid #d1d5db;
      background-color: white;
      color: var(--text);
      border-radius: 6px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
  }

  .status-btn:hover {
      background-color: #f3f4f6;
  }

  .status-btn.active {
      background-color: var(--primary);
      color: white;
      border-color: var(--primary);
  }

  /* Priority and Type Selection Sections */
  .priority-section, .complaint-type-section {
      margin-top: 20px;
      padding-top: 16px;
      border-top: 1px solid #e2e8f0;
  }

  .priority-section h4, .complaint-type-section h4 {
      font-size: 1rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 12px;
  }

  /* Form Groups */
  .form-group {
      margin-bottom: 16px;
  }

  .form-group label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
  }

  .form-group .form-select {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-family: inherit;
      font-size: 0.875rem;
      font-weight: 500;
      background-color: white;
      color: var(--text);
      transition: all 0.3s ease;
      cursor: pointer;
  }

  .form-group .form-select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
  }

  .form-group .form-select:hover {
      border-color: var(--secondary);
  }

  .save-changes-section {
      margin-top: 20px;
      padding-top: 16px;
      border-top: 2px solid var(--primary);
      text-align: center;
  }

  .save-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 32px;
      background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
      text-transform: uppercase;
      letter-spacing: 0.5px;
  }

  .save-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
  }

  .save-btn:active {
      transform: translateY(0);
  }

  .save-btn i {
      font-size: 14px;
  }

  .tab-icon{
        width: 20px;
        height: 20px;
        margin-top: 5px;
  }
  /* Resolution Input */
  .resolution-input {
      margin-top: 16px;
  }

  .resolution-input label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--text);
      margin-bottom: 8px;
      margin-top: 12px;
  }

  .resolution-input label:first-child {
      margin-top: 0;
  }

  .form-select, .form-textarea {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-family: inherit;
      font-size: 0.875rem;
      transition: all 0.3s;
  }

  .form-select:focus, .form-textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
  }

  .form-textarea {
      resize: vertical;
  }

  /* Start Conversation Section */
  .conversation-section {
      margin-top: 20px;
      padding-top: 16px;
      border-top: 1px solid #e2e8f0;
  }

  .start-conversation-btn {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 16px 24px;
      background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(111, 26, 140, 0.3);
      text-transform: uppercase;
      letter-spacing: 0.5px;
  }

  .start-conversation-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(111, 26, 140, 0.4);
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
  }

  .start-conversation-btn:active {
      transform: translateY(0);
  }

  .start-conversation-btn i:first-child {
      font-size: 18px;
  }

  .start-conversation-btn i:last-child {
      font-size: 14px;
      opacity: 0.8;
  }

  /* Modal Footer */
  .modal-footer {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 12px;
      padding: 24px;
      border-top: 1px solid #e5e7eb;
      background-color: var(--bg-light);
  }

  .btn {
      padding: 10px 24px;
      border: none;
      border-radius: 6px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
  }

  .btn-secondary {
      background-color: white;
      color: var(--text);
      border: 1px solid #d1d5db;
  }

  .btn-secondary:hover {
      background-color: #f3f4f6;
  }

  .btn-warning {
      background-color: var(--warning);
      color: white;
  }

  .btn-warning:hover {
      background-color: #d97706;
  }

  .btn-success {
      background-color: var(--success);
      color: white;
  }

  .btn-success:hover {
      background-color: #059669;
  }

  .btn-save-changes{
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #ffffff;
        font-weight: 600;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
      .container {
          margin-left: 0;
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

      .table-container {
          overflow-x: auto;
          border-radius: 8px;
      }

      .complaints-table {
          min-width: 800px;
      }

      .complaints-table thead th {
          padding: 12px 8px;
          font-size: 0.8rem;
      }

      .complaints-table td {
          padding: 12px 8px;
          font-size: 0.8rem;
      }

      .table-client, .table-provider, .table-event {
          max-width: 120px;
      }

      .table-view-btn {
          padding: 6px 12px;
          font-size: 0.75rem;
      }

      .details-grid {
          grid-template-columns: 1fr;
      }

      .form-group .form-select {
          font-size: 16px; /* Prevents zoom on iOS */
      }

      .modal-footer {
          flex-direction: column;
      }

      .btn {
          width: 100%;
      }
  }

  @media (max-width: 480px) {
      .container {
          padding: 12px;
      }

      .complaints-table {
          min-width: 700px;
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
          padding: 4px 8px;
          font-size: 0.7rem;
          gap: 4px;
      }

      .table-view-btn span {
          display: none;
      }

      .priority-badge, .status-badge {
          font-size: 0.65rem;
          padding: 4px 8px;
      }
  }

  /* Scrollbar Styling */
  .modal-body::-webkit-scrollbar {
      width: 8px;
  }

  .modal-body::-webkit-scrollbar-track {
      background: #f1f5f9;
  }

  .modal-body::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 4px;
  }

  .modal-body::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
  }

</style>

<body>
    <div class="container">
    
        <!-- Tabs Navigation -->
        <div class="tabs-container">
            <div class="tabs">
                <button class="tab active" data-tab="client" onclick="switchTab('client')">
                    <i class="fa fa-user tab-icon"></i>
                    Client Complaints
                    <span class="badge badge-danger" id="client-count">0</span>
                </button>
                <button class="tab" data-tab="provider" onclick="switchTab('provider')">
                    <i class="fa fa-briefcase tab-icon" ></i>
                    Service Provider Complaints
                    <span class="badge badge-warning" id="provider-count">0</span>
                </button>
                <button class="tab" data-tab="system" onclick="switchTab('system')">
                    <i class="fa fa-cogs tab-icon"></i>
                    System
                    <span class="badge badge-secondary" id="system-count">0</span>
                </button>
                <button class="tab" data-tab="solved" onclick="switchTab('solved')">
                    <i class="fa fa-check-circle tab-icon"></i>
                    Solved
                    <span class="badge badge-success" id="solved-count">0</span>
                </button>
            </div>
        </div>

        <!-- Complaints Tables -->
        <div class="table-container">
            <!-- Client Complaints Table -->
            <table id="client-complaints-table" class="complaints-table" style="display: none;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Issue Type</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Client Name</th>
                        <th>Service Provider</th>
                        <th>Event</th>
                        <th>Reported</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="client-complaints-tbody">
                    <!-- Complaints will be dynamically inserted here -->
                </tbody>
            </table>

            <!-- Provider Complaints Table -->
            <table id="provider-complaints-table" class="complaints-table" style="display: none;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dispute Type</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Service Provider</th>
                        <th>Client Name</th>
                        <th>Event</th>
                        <th>Reported</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="provider-complaints-tbody">
                    <!-- Complaints will be dynamically inserted here -->
                </tbody>
            </table>

            <!-- System Complaints Table -->
            <table id="system-complaints-table" class="complaints-table" style="display: none;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>System Issue</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Service Provider</th>
                        <th>Affected Event</th>
                        <th>Detected</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="system-complaints-tbody">
                    <!-- Complaints will be dynamically inserted here -->
                </tbody>
            </table>

            <!-- Solved Complaints Table -->
            <table id="solved-complaints-table" class="complaints-table" style="display: none;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Issue Type</th>
                        <th>Complainant</th>
                        <th>Resolution Type</th>
                        <th>Service Provider</th>
                        <th>Resolved Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="solved-complaints-tbody">
                    <!-- Complaints will be dynamically inserted here -->
                </tbody>
            </table>
        </div>

        <!-- System Description -->
        <div class="system-description">
            <p><i class="fa fa-info-circle"></i> Our system displays all complaints organized by category. Click "View" to open any complaint and review its details. You can mark complaints as "In Progress" when actively working on them, then update them to "Solved" once resolved. For critical system failures or complex issues requiring administrative intervention, use the "Escalate" option to forward the complaint to the admin team for specialized handling.</p>
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="empty-state" style="display: none;">
            <i class="fa fa-info-circle empty-icon"></i>
            <h3>No Complaints Found</h3>
            <p id="empty-message">All clear! No pending complaints in this category</p>
        </div>
    </div>

    <!-- Modal for Complaint Details -->
    <div id="complaint-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title-section">
                    <h2 id="modal-title">Complaint #</h2>
                    <span id="modal-priority" class="priority-badge">MEDIUM</span>
                    <span id="modal-status" class="status-badge">OPEN</span>
                </div>
                <button class="close-btn" onclick="closeModal()">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Complaint Type & Description -->
                <div class="section">
                    <div class="section-header">
                        <i class="fa fa-exclamation-triangle section-icon"></i>
                        <h3 id="modal-complaint-type">Complaint Type</h3>
                    </div>
                    <div class="description-box">
                        <p id="modal-description">Complaint description will appear here...</p>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="details-grid">
                    <!-- Client Info -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fa fa-user detail-icon"></i>
                            <h4>Client Information</h4>
                        </div>
                        <div class="detail-content">
                            <label>Name</label>
                            <p id="client-name">N/A</p>
                            <label>Complaint Raised By</label>
                            <p id="complainant-type">N/A</p>
                        </div>
                    </div>

                    <!-- Provider Info -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fa fa-briefcase detail-icon"></i>
                            <h4>Provider Information</h4>
                        </div>
                        <div class="detail-content">
                            <label>Provider Name</label>
                            <p id="provider-name">N/A</p>
                            <label>Service ID</label>
                            <p id="service-id">N/A</p>
                        </div>
                    </div>

                    <!-- Event Info -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fa fa-calendar detail-icon"></i>
                            <h4>Event Information</h4>
                        </div>
                        <div class="detail-content">
                            <label>Event Name</label>
                            <p id="event-name">N/A</p>
                            <label>Event ID</label>
                            <p id="event-id">N/A</p>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fa fa-clock detail-icon"></i>
                            <h4>Timeline</h4>
                        </div>
                        <div class="detail-content">
                            <label>Created At</label>
                            <p id="created-at">N/A</p>
                            <label>Last Updated</label>
                            <p id="updated-at">N/A</p>
                        </div>
                    </div>
                </div>

                <!-- Resolution Section (for resolved complaints) -->
                <div id="resolution-section" class="resolution-section" style="display: none;">
                    <div class="resolution-header">
                        <i class="fa fa-check-circle resolution-icon"></i>
                        <h4>Resolution</h4>
                    </div>
                    <p><strong>Type:</strong> <span id="resolution-type">N/A</span></p>
                    <p><strong>Resolved At:</strong> <span id="resolved-at">N/A</span></p>
                    <p><strong>Note:</strong> <span id="resolution-note">N/A</span></p>
                </div>

                <!-- Status Update Section -->
                <div id="status-update-section" class="status-update-section">
                    <h4>Update Status</h4>
                    <div class="form-group">
                        <label for="status-select">Current Status</label>
                        <select id="status-select" class="form-select" onchange="updateStatus(this.value)">
                            <option value="OPEN">Open</option>
                            <option value="IN_PROGRESS">In Progress</option>
                            <option value="RESOLVED">Resolved</option>
                        </select>
                    </div>

                    <!-- Priority Level Selection -->
                    <div class="priority-section">
                        <h4>Update Priority Level</h4>
                        <div class="form-group">
                            <label for="priority-select">Priority Level</label>
                            <select id="priority-select" class="form-select" onchange="updatePriority(this.value)">
                                <option value="LOW">Low</option>
                                <option value="MEDIUM">Medium</option>
                                <option value="HIGH">High</option>
                                <option value="CRITICAL">Critical</option>
                            </select>
                        </div>
                    </div>

                    <div id="resolution-input" class="resolution-input" style="display: none;">
                        <label>Resolution Type</label>
                        <select id="resolution-type-select" class="form-select">
                            <option value="">Select resolution type...</option>
                            <option value="PROVIDER_REPLACED">Provider Replaced</option>
                            <option value="REFUND_ISSUED">Refund Issued</option>
                            <option value="WARNING_GIVEN">Warning Given</option>
                            <option value="NO_ACTION">No Action</option>
                            <option value="OTHER">Other</option>
                        </select>
                        <label>Resolution Note</label>
                        <textarea id="resolution-note-input" class="form-textarea" rows="4" placeholder="Enter resolution details..."></textarea>
                    </div>
                </div>

                <!-- Start Conversation Section -->
                <div id="conversation-section" class="conversation-section">
                    <button class="start-conversation-btn" onclick="startConversation()">
                        <i class="fa fa-comments"></i>
                        <span id="conversation-text">Start Conversation with Client</span>
                        <i class="fa fa-external-link"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Footer -->
            <div id="modal-footer" class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                <button class="btn btn-warning" onclick="escalateComplaint()">Escalate</button>
                <button class="btn btn-save-changes" onclick="saveComplaintChanges()"><i class="fa fa-save"></i>Save Changes</button>
                <button id="resolve-btn" class="btn btn-success" style="display: none;" onclick="resolveComplaint()">Mark as Resolved</button>
            </div>
        </div>
    </div>

    <script>
      // Get Issue Coordinator ID from session
const ISSUE_COORDINATOR_ID = <?php echo isset($_SESSION['ic_id']) ? (int)$_SESSION['ic_id'] : 'null'; ?>;

// Separate Complaints Data stores for each section
let clientComplaints = [];
let providerComplaints = [];
let systemComplaints = [];
let solvedComplaints = [];

// Load Service Provider Complaints
function loadProviderComplaints() {
    const URLROOT = '<?php echo URLROOT; ?>';
    
    fetch(`${URLROOT}/IssueC/getServiceProviderComplaints`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success && result.data) {
            providerComplaints = result.data;
            updateComplaintCounts();
            renderComplaints();
        } else {
            console.error('Failed to load provider complaints:', result.error);
        }
    })
    .catch(error => {
        console.error('Error fetching provider complaints:', error);
    });
}

// Load Client Complaints (to be implemented)
function loadClientComplaints() {
    const URLROOT = '<?php echo URLROOT; ?>';
    
    // TODO: Implement client complaints API endpoint
    // fetch(`${URLROOT}/IssueC/getClientComplaints`, ...)
}

// Load System Complaints (to be implemented)
function loadSystemComplaints() {
    const URLROOT = '<?php echo URLROOT; ?>';
    
    // TODO: Implement system complaints API endpoint
    // fetch(`${URLROOT}/IssueC/getSystemComplaints`, ...)
}

// Load Solved Complaints (to be implemented)
function loadSolvedComplaints() {
    const URLROOT = '<?php echo URLROOT; ?>';
     
    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if (xml.status === 200) {
            var result = JSON.parse(xml.responseText);
            if (result.success && result.data) {
                solvedComplaints = result.data;
                updateComplaintCounts();
                renderComplaints();
            } else {
                console.error('Failed to load solved complaints:', result.error);
            }
        } else {
            console.error('Error fetching solved complaints:', xml.statusText);
        }
    };

    data = {
        ic_id: ISSUE_COORDINATOR_ID
    };
    stringifydata = JSON.stringify(data);
    xml.open("POST", `${URLROOT}/IssueC/getSolvedComplaints`, true);
    xml.setRequestHeader("Content-Type", "application/json");
    xml.send(stringifydata);
}

// Global State
let currentTab = 'client';
let currentComplaint = null;
let selectedStatus = null;
let selectedPriority = null;
let selectedComplaintType = null;

// Helper function to format complaint type labels
function formatComplaintType(typeStr) {
    const typeMap = {
        'QUALITY_ISSUE': 'Quality Issue',
        'NO_SHOW': 'No Show',
        'PAYMENT_DISPUTE': 'Payment Dispute',
        'LATE_CANCELLATION': 'Late Cancellation',
        'MISCONDUCT': 'Misconduct',
        'OTHER': 'Other',
        'PROVIDER_REPLACED': 'Provider Replaced',
        'REFUND_ISSUED': 'Refund Issued',
        'WARNING_GIVEN': 'Warning Given',
        'NO_ACTION': 'No Action'
    };
    return typeMap[typeStr] || typeStr;
}

// Helper function to get time since
function getTimeSince(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const seconds = Math.floor((now - date) / 1000);
    
    let interval = seconds / 31536000;
    if (interval > 1) return Math.floor(interval) + ' years ago';
    
    interval = seconds / 2592000;
    if (interval > 1) return Math.floor(interval) + ' months ago';
    
    interval = seconds / 86400;
    if (interval > 1) return Math.floor(interval) + ' days ago';
    
    interval = seconds / 3600;
    if (interval > 1) return Math.floor(interval) + ' hours ago';
    
    interval = seconds / 60;
    if (interval > 1) return Math.floor(interval) + ' minutes ago';
    
    return Math.floor(seconds) + ' seconds ago';
}

// Helper function to format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Initialize App
document.addEventListener('DOMContentLoaded', function() {
    loadProviderComplaints();
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
    
    // Load data for the selected tab if not already loaded
    switch(tab) {
        case 'client':
            if (clientComplaints.length === 0) loadClientComplaints();
            break;
        case 'provider':
            if (providerComplaints.length === 0) loadProviderComplaints();
            break;
        case 'system':
            if (systemComplaints.length === 0) loadSystemComplaints();
            break;
        case 'solved':
            if (solvedComplaints.length === 0) loadSolvedComplaints();
            break;
    }
    
    renderComplaints();
}

// Update Complaint Counts
function updateComplaintCounts() {
    const counts = {
        client: clientComplaints.length,
        provider: providerComplaints.length,
        system: systemComplaints.length,
        solved: solvedComplaints.length
    };
    
    document.getElementById('client-count').textContent = counts.client;
    document.getElementById('provider-count').textContent = counts.provider;
    document.getElementById('system-count').textContent = counts.system;
    document.getElementById('solved-count').textContent = counts.solved;
}

// Filter Complaints by Tab
function getFilteredComplaints() {
    switch(currentTab) {
        case 'client':
            return clientComplaints;
        case 'provider':
            return providerComplaints;
        case 'system':
            return systemComplaints;
        case 'solved':
            return solvedComplaints;
        default:
            return [];
    }
}

// Render Complaints
function renderComplaints() {
    const emptyState = document.getElementById('empty-state');
    const complaints = getFilteredComplaints();
    
    // Hide all tables
    document.getElementById('client-complaints-table').style.display = 'none';
    document.getElementById('provider-complaints-table').style.display = 'none';
    document.getElementById('system-complaints-table').style.display = 'none';
    document.getElementById('solved-complaints-table').style.display = 'none';
    
    // Select the appropriate table and tbody based on current tab
    let tableId = 'client-complaints-table';
    let tbodyId = 'client-complaints-tbody';
    let renderFunction = createClientComplaintRow;
    
    switch(currentTab) {
        case 'client':
            tableId = 'client-complaints-table';
            tbodyId = 'client-complaints-tbody';
            renderFunction = createClientComplaintRow;
            break;
        case 'provider':
            tableId = 'provider-complaints-table';
            tbodyId = 'provider-complaints-tbody';
            renderFunction = createProviderComplaintRow;
            break;
        case 'system':
            tableId = 'system-complaints-table';
            tbodyId = 'system-complaints-tbody';
            renderFunction = createSystemComplaintRow;
            break;
        case 'solved':
            tableId = 'solved-complaints-table';
            tbodyId = 'solved-complaints-tbody';
            renderFunction = createSolvedComplaintRow;
            break;
    }
    
    const table = document.getElementById(tableId);
    const tbody = document.getElementById(tbodyId);
    
    if (complaints.length === 0) {
        table.style.display = 'none';
        emptyState.style.display = 'block';
        
        const emptyMessage = document.getElementById('empty-message');
        emptyMessage.textContent = currentTab === 'solved' 
            ? 'No resolved complaints to display'
            : 'All clear! No pending complaints in this category';
    } else {
        table.style.display = 'table';
        emptyState.style.display = 'none';
        
        // Render appropriate rows based on tab
        tbody.innerHTML = complaints.map(complaint => renderFunction(complaint)).join('');
    }
}

// Create Client Complaint Table Row HTML
function createClientComplaintRow(complaint) {
    const priorityClass = `priority-${(complaint.priority || 'medium').toLowerCase()}`;
    const statusClass = `status-${(complaint.status || 'open').toLowerCase()}`;
    const complaintTypeLabel = formatComplaintType(complaint.complaint_type || 'OTHER');
    const timeSince = getTimeSince(complaint.created_at);
    const createdDate = new Date(complaint.created_at).toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
    });

    return `
        <tr class="complaint-row">
            <td class="table-id">#${complaint.complaint_id || 'N/A'}</td>
            <td class="table-type">${complaintTypeLabel}</td>
            <td>
                <span class="priority-badge ${priorityClass}">${complaint.priority || 'MEDIUM'}</span>
            </td>
            <td>
                <span class="status-badge ${statusClass}">${(complaint.status || 'OPEN').replace('_', ' ')}</span>
            </td>
            <td class="table-client" title="${complaint.client_name || 'N/A'}">${complaint.client_name || 'N/A'}</td>
            <td class="table-provider" title="${complaint.provider_name || 'N/A'}">${complaint.provider_name || 'N/A'}</td>
            <td class="table-event" title="${complaint.event_name || 'N/A'}">${complaint.event_name || 'N/A'}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${timeSince}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${createdDate}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="openComplaintModal(${complaint.complaint_id})" title="View Details">
                    <i class="fa fa-eye"></i>
                    <span>View</span>
                </button>
            </td>
        </tr>
    `;
}

// Create Provider Complaint Table Row HTML
function createProviderComplaintRow(complaint) {
    const priorityClass = `priority-${(complaint.priority || 'medium').toLowerCase()}`;
    const statusClass = `status-${(complaint.status || 'open').toLowerCase()}`;
    const complaintTypeLabel = formatComplaintType(complaint.complaint_type || 'OTHER');
    const timeSince = getTimeSince(complaint.created_at);
    const createdDate = new Date(complaint.created_at).toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
    });

    return `
        <tr class="complaint-row">
            <td class="table-id">#${complaint.complaint_id || 'N/A'}</td>
            <td class="table-type">${complaintTypeLabel}</td>
            <td>
                <span class="priority-badge ${priorityClass}">${complaint.priority || 'MEDIUM'}</span>
            </td>
            <td>
                <span class="status-badge ${statusClass}">${(complaint.status || 'OPEN').replace('_', ' ')}</span>
            </td>
            <td class="table-provider" title="${complaint.provider_name || 'N/A'}">${complaint.provider_name || 'N/A'}</td>
            <td class="table-client" title="${complaint.client_name || 'N/A'}">${complaint.client_name || 'N/A'}</td>
            <td class="table-event" title="${complaint.event_name || 'N/A'}">${complaint.event_name || 'N/A'}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${timeSince}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${createdDate}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="openComplaintModal(${complaint.complaint_id})" title="View Details">
                    <i class="fa fa-eye"></i>
                    <span>View</span>
                </button>
            </td>
        </tr>
    `;
}

// Create System Complaint Table Row HTML
function createSystemComplaintRow(complaint) {
    const priorityClass = `priority-${(complaint.priority || 'medium').toLowerCase()}`;
    const statusClass = `status-${(complaint.status || 'open').toLowerCase()}`;
    const complaintTypeLabel = formatComplaintType(complaint.complaint_type || 'OTHER');
    const timeSince = getTimeSince(complaint.created_at);
    const createdDate = new Date(complaint.created_at).toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
    });

    return `
        <tr class="complaint-row">
            <td class="table-id">#${complaint.complaint_id || 'N/A'}</td>
            <td class="table-type">${complaintTypeLabel}</td>
            <td>
                <span class="priority-badge ${priorityClass}">${complaint.priority || 'MEDIUM'}</span>
            </td>
            <td>
                <span class="status-badge ${statusClass}">${(complaint.status || 'OPEN').replace('_', ' ')}</span>
            </td>
            <td class="table-provider" title="${complaint.provider_name || 'N/A'}">${complaint.provider_name || 'N/A'}</td>
            <td class="table-event" title="${complaint.event_name || 'N/A'}">${complaint.event_name || 'N/A'}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${timeSince}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${createdDate}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="openComplaintModal(${complaint.complaint_id})" title="View Details">
                    <i class="fa fa-eye"></i>
                    <span>View</span>
                </button>
            </td>
        </tr>
    `;
}

// Create Solved Complaint Table Row HTML
function createSolvedComplaintRow(complaint) {
    const statusClass = `status-${(complaint.status || 'open').toLowerCase()}`;
    const complaintTypeLabel = formatComplaintType(complaint.complaint_type || 'OTHER');
    const resolutionTypeLabel = complaint.resolution_type ? formatComplaintType(complaint.resolution_type) : 'N/A';
    const resolvedDate = complaint.resolved_at ? new Date(complaint.resolved_at).toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
    }) : 'N/A';

    return `
        <tr class="complaint-row">
            <td class="table-id">#${complaint.complaint_id || 'N/A'}</td>
            <td class="table-type">${complaintTypeLabel}</td>
            <td class="table-client" title="${complaint.complainant_type || 'N/A'}">${complaint.complainant_type || 'N/A'}</td>
            <td>
                <span class="badge badge-success">${resolutionTypeLabel}</span>
            </td>
            <td class="table-provider" title="${complaint.provider_name || 'N/A'}">${complaint.provider_name || 'N/A'}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${resolvedDate}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="openComplaintModal(${complaint.complaint_id})" title="View Details">
                    <i class="fa fa-eye"></i>
                    <span>View</span>
                </button>
            </td>
        </tr>
    `;
}

// Create Complaint Table Row HTML (Legacy - kept for backwards compatibility)
function createComplaintRow(complaint) {
    const priorityClass = `priority-${(complaint.priority || 'medium').toLowerCase()}`;
    const statusClass = `status-${(complaint.status || 'open').toLowerCase()}`;
    const complaintTypeLabel = formatComplaintType(complaint.complaint_type || 'OTHER');
    const timeSince = getTimeSince(complaint.created_at);
    const createdDate = new Date(complaint.created_at).toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
    });

    return `
        <tr class="complaint-row">
            <td class="table-id">#${complaint.complaint_id || 'N/A'}</td>
            <td class="table-type">${complaintTypeLabel}</td>
            <td>
                <span class="priority-badge ${priorityClass}">${complaint.priority || 'MEDIUM'}</span>
            </td>
            <td>
                <span class="status-badge ${statusClass}">${(complaint.status || 'OPEN').replace('_', ' ')}</span>
            </td>
            <td class="table-client" title="${complaint.client_name || 'N/A'}">${complaint.client_name || 'N/A'}</td>
            <td class="table-provider" title="${complaint.provider_name || 'N/A'}">${complaint.provider_name || 'N/A'}</td>
            <td class="table-event" title="${complaint.event_name || 'N/A'}">${complaint.event_name || 'N/A'}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${timeSince}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${createdDate}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="openComplaintModal(${complaint.complaint_id})" title="View Details">
                    <i class="fa fa-eye"></i>
                    <span>View</span>
                </button>
            </td>
        </tr>
    `;
}

// Open Complaint Modal
function openComplaintModal(complaintId) {
    // Search for the complaint across all data arrays
    currentComplaint = 
        clientComplaints.find(c => c.complaint_id === complaintId) ||
        providerComplaints.find(c => c.complaint_id === complaintId) ||
        systemComplaints.find(c => c.complaint_id === complaintId) ||
        solvedComplaints.find(c => c.complaint_id === complaintId);
    
    if (!currentComplaint) {
        console.error('Complaint not found:', complaintId);
        return;
    }
    
    selectedStatus = currentComplaint.status;
    selectedPriority = currentComplaint.priority;
    selectedComplaintType = currentComplaint.complaint_type;
    
    // Populate modal
    populateModal(currentComplaint);
    
    // Show modal
    document.getElementById('complaint-modal').style.display = 'flex';
}

// Populate Modal with Complaint Data
function populateModal(complaint) {
    const priorityClass = `priority-${complaint.priority.toLowerCase()}`;
    const statusClass = `status-${complaint.status.toLowerCase()}`;
    const complaintTypeLabel = formatComplaintType(complaint.complaint_type);
    
    // Header
    document.getElementById('modal-title').textContent = `Complaint #${complaint.complaint_id}`;
    document.getElementById('modal-priority').textContent = complaint.priority;
    document.getElementById('modal-priority').className = `priority-badge ${priorityClass}`;
    document.getElementById('modal-status').textContent = complaint.status.replace('_', ' ');
    document.getElementById('modal-status').className = `status-badge ${statusClass}`;
    
    // Complaint Type & Description
    document.getElementById('modal-complaint-type').textContent = complaintTypeLabel;
    document.getElementById('modal-description').textContent = complaint.description_text || complaint.description || 'No description provided';
    
    // Details
    document.getElementById('client-name').textContent = complaint.client_name || 'N/A';
    document.getElementById('complainant-type').textContent = complaint.complainant_type;
    document.getElementById('provider-name').textContent = complaint.provider_name || 'N/A';
    document.getElementById('service-id').textContent = complaint.service_id;
    document.getElementById('event-name').textContent = complaint.event_name || 'N/A';
    document.getElementById('event-id').textContent = complaint.event_id;
    document.getElementById('created-at').textContent = formatDate(complaint.created_at);
    document.getElementById('updated-at').textContent = formatDate(complaint.updated_at);
    
    // Resolution Section
    const resolutionSection = document.getElementById('resolution-section');
    if (complaint.status === 'RESOLVED' && complaint.resolution_note) {
        resolutionSection.style.display = 'block';
        document.getElementById('resolution-type').textContent = complaint.resolution_type ? formatComplaintType(complaint.resolution_type) : 'N/A';
        document.getElementById('resolved-at').textContent = complaint.resolved_at ? formatDate(complaint.resolved_at) : 'N/A';
        document.getElementById('resolution-note').textContent = complaint.resolution_note;
    } else {
        resolutionSection.style.display = 'none';
    }
    
    // Status Update Section
    const statusUpdateSection = document.getElementById('status-update-section');
    const conversationSection = document.getElementById('conversation-section');
    const modalFooter = document.getElementById('modal-footer');
    
    if (complaint.status === 'RESOLVED') {
        statusUpdateSection.style.display = 'none';
        conversationSection.style.display = 'none';
        modalFooter.style.display = 'none';
    } else {
        statusUpdateSection.style.display = 'block';
        conversationSection.style.display = 'block';
        modalFooter.style.display = 'flex';
        
        // Set the status and priority dropdowns to current values
        document.getElementById('status-select').value = complaint.status;
        document.getElementById('priority-select').value = complaint.priority;
        
        // Update status buttons
        updateStatusButtons(complaint.status);
        
        // Update priority and complaint type buttons
        updatePriorityButtons(complaint.priority);
        updateComplaintTypeButtons(complaint.complaint_type);
        
        // Set conversation text
        const recipientType = complaint.complainant_type === 'CLIENT' ? 'Client' : 'Service Provider';
        document.getElementById('conversation-text').textContent = `Start Conversation with ${recipientType}`;
    }
}

// Update Status Buttons
function updateStatusButtons(status) {
    const buttons = document.querySelectorAll('.status-btn');
    buttons.forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('data-status') === status) {
            btn.classList.add('active');
        }
    });
    
    // Show/hide resolution input
    const resolutionInput = document.getElementById('resolution-input');
    const resolveBtn = document.getElementById('resolve-btn');
    
    if (status === 'RESOLVED') {
        resolutionInput.style.display = 'block';
        resolveBtn.style.display = 'inline-block';
    } else {
        resolutionInput.style.display = 'none';
        resolveBtn.style.display = 'none';
    }
}

// Update Status
function updateStatus(status) {
    selectedStatus = status;
    updateStatusButtons(status);
}

// Update Priority
function updatePriority(priority) {
    selectedPriority = priority;
    updatePriorityButtons(priority);
}

// Update Complaint Type
function updateComplaintType(type) {
    selectedComplaintType = type;
    updateComplaintTypeButtons(type);
}

// Update Priority Buttons
function updatePriorityButtons(priority) {
    const buttons = document.querySelectorAll('.priority-btn');
    buttons.forEach(btn => {
        btn.classList.remove('active', 'priority-low', 'priority-medium', 'priority-high', 'priority-critical');
        if (btn.getAttribute('data-priority') === priority) {
            btn.classList.add('active', `priority-${priority.toLowerCase()}`);
        }
    });
}

// Update Complaint Type Buttons
function updateComplaintTypeButtons(type) {
    const buttons = document.querySelectorAll('.type-btn');
    buttons.forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('data-type') === type) {
            btn.classList.add('active');
        }
    });
}

// Save Complaint Changes
function saveComplaintChanges() {
    if (!currentComplaint) return;
    
    let hasChanges = false;
    let changesSummary = [];
    
    // Check for status changes
    if (selectedStatus && selectedStatus !== currentComplaint.status) {
        currentComplaint.status = selectedStatus;
        hasChanges = true;
        changesSummary.push(`Status: ${selectedStatus.replace('_', ' ')}`);
    }
    
    // Check for priority changes
    if (selectedPriority && selectedPriority !== currentComplaint.priority) {
        currentComplaint.priority = selectedPriority;
        hasChanges = true;
        changesSummary.push(`Priority: ${selectedPriority}`);
    }
    
    // Check for resolution if status is RESOLVED
    let resolutionType = '';
    let resolutionNote = '';
    
    if (selectedStatus === 'RESOLVED') {
        resolutionType = document.getElementById('resolution-type-select').value;
        resolutionNote = document.getElementById('resolution-note-input').value;
        
        if (!resolutionType || !resolutionNote) {
            alert('Please select a resolution type and add notes when marking as resolved.');
            return;
        }
        
        currentComplaint.resolution_type = resolutionType;
        currentComplaint.resolution_note = resolutionNote;
        changesSummary.push(`Resolution: ${formatComplaintType(resolutionType)}`);
    }
    
    if (!hasChanges) {
        alert('No changes to save.');
        return;
    }
    
    // Prepare data for API
    const finalStatus = selectedStatus || currentComplaint.status;
    const finalPriority = selectedPriority || currentComplaint.priority;
    
    const updateData = {
        complaint_id: currentComplaint.complaint_id,
        status: finalStatus,
        priority: finalPriority,
        resolution_type: resolutionType || null,
        resolution_note: resolutionNote || null
    };
    
    // Assign IC ID when status is or becomes IN_PROGRESS, OPEN, or RESOLVED and IC ID is set
    if ((finalStatus === 'IN_PROGRESS' || finalStatus === 'OPEN' || finalStatus === 'RESOLVED') && ISSUE_COORDINATOR_ID && ISSUE_COORDINATOR_ID !== null) {
        updateData.assigned_ic_id = ISSUE_COORDINATOR_ID;
        if (!currentComplaint.assigned_ic_id) {
            changesSummary.push(`Assigned to Issue Coordinator #${ISSUE_COORDINATOR_ID}`);
        }
    }
    
    // Send to server
    const URLROOT = '<?php echo URLROOT; ?>';
    
    fetch(`${URLROOT}/IssueC/updateComplaintStatus`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(updateData)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            // Update timestamps
            currentComplaint.updated_at = new Date().toISOString();
            
            // Show success message
            alert(`Changes saved successfully!\n\nUpdated:\n- ${changesSummary.join('\n- ')}`);
            
            // Update the modal display
            populateModal(currentComplaint);
            
            // Update the table
            updateComplaintCounts();
            renderComplaints();
        } else {
            alert('Error: ' + (result.error || 'Failed to save changes'));
        }
    })
    .catch(error => {
        console.error('Error saving complaint changes:', error);
        alert('An error occurred while saving changes. Please try again.');
    });
}

// Close Modal
function closeModal() {
    document.getElementById('complaint-modal').style.display = 'none';
    currentComplaint = null;
    selectedStatus = null;
    selectedPriority = null;
    selectedComplaintType = null;
}

// Start Conversation
function startConversation() {
    if (!currentComplaint) return;
    
    // Determine the recipient based on complaint type
    let recipientId, recipientType;
    
    if (currentComplaint.complainant_type === 'CLIENT') {
        // If complaint is from client, start conversation with service provider
        recipientId = currentComplaint.service_id;
        recipientType = 'provider';
    } else {
        // If complaint is from IC or system, start conversation with client
        recipientId = currentComplaint.client_id || currentComplaint.event_id; // You might need to adjust this based on your data structure
        recipientType = 'client';
    }
    
    // Navigate to messages page with parameters
    const messagesUrl = `${window.location.origin}/evoplan/issue/messages?recipient_id=${recipientId}&recipient_type=${recipientType}&complaint_id=${currentComplaint.complaint_id}`;
    window.location.href = messagesUrl;
}

// Toggle Chat
function toggleChat() {
    chatOpen = !chatOpen;
    const chatInterface = document.getElementById('chat-interface');
    const toggleText = document.getElementById('chat-toggle-text');
    const recipientType = currentComplaint.complainant_type === 'CLIENT' ? 'Client' : 'Service Provider';
    
    if (chatOpen) {
        chatInterface.style.display = 'block';
        toggleText.textContent = `Hide Chat with ${recipientType}`;
        renderChatMessages();
    } else {
        chatInterface.style.display = 'none';
        toggleText.textContent = `Show Chat with ${recipientType}`;
    }
}

// Render Chat Messages
function renderChatMessages() {
    const chatContainer = document.getElementById('chat-messages');
    
    if (chatMessages.length === 0) {
        chatContainer.innerHTML = `
            <div class="chat-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <p>No messages yet. Start the conversation!</p>
            </div>
        `;
        return;
    }
    
    chatContainer.innerHTML = chatMessages.map(msg => createChatMessage(msg)).join('');
    
    // Scroll to bottom
    chatContainer.scrollTop = chatContainer.scrollHeight;
}

// Create Chat Message HTML
function createChatMessage(msg) {
    const isIC = msg.sender === 'IC';
    const messageClass = isIC ? 'ic' : 'other';
    const avatarClass = isIC ? 'avatar-ic' : (msg.sender === 'CLIENT' ? 'avatar-client' : 'avatar-provider');
    
    return `
        <div class="chat-message ${messageClass}">
            <div class="message-avatar ${avatarClass}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <div class="message-content">
                <div class="message-bubble ${messageClass}">
                    <p class="message-sender">${msg.sender_name}</p>
                    <p class="message-text">${msg.message}</p>
                </div>
                <p class="message-time">${formatTime(msg.timestamp)}</p>
            </div>
        </div>
    `;
}

// Send Message
function sendMessage() {
    const input = document.getElementById('chat-input');
    const message = input.value.trim();
    
    if (!message) return;
    
    const newMessage = {
        id: chatMessages.length + 1,
        sender: 'IC',
        sender_name: 'Issue Coordinator',
        message: message,
        timestamp: new Date().toISOString()
    };
    
    chatMessages.push(newMessage);
    
    // Save to chat data
    if (!chatMessagesData[currentComplaint.complaint_id]) {
        chatMessagesData[currentComplaint.complaint_id] = [];
    }
    chatMessagesData[currentComplaint.complaint_id].push(newMessage);
    
    input.value = '';
    renderChatMessages();
}

// Escalate Complaint
function escalateComplaint() {
    if (!currentComplaint) return;
    
    if (confirm('Are you sure you want to escalate this complaint to senior management?')) {
        currentComplaint.status = 'ESCALATED';
        currentComplaint.updated_at = new Date().toISOString();
        
        alert('Complaint escalated successfully!');
        closeModal();
        updateComplaintCounts();
        renderComplaints();
    }
}

// Resolve Complaint
function resolveComplaint() {
    if (!currentComplaint) return;
    
    const resolutionTypeSelect = document.getElementById('resolution-type-select');
    const resolutionNoteInput = document.getElementById('resolution-note-input');
    
    const resolutionType = resolutionTypeSelect.value;
    const resolutionNote = resolutionNoteInput.value.trim();
    
    if (!resolutionType) {
        alert('Please select a resolution type.');
        return;
    }
    
    if (!resolutionNote) {
        alert('Please provide resolution details.');
        return;
    }
    
    currentComplaint.status = 'RESOLVED';
    currentComplaint.resolution_type = resolutionType;
    currentComplaint.resolution_note = resolutionNote;
    currentComplaint.resolved_at = new Date().toISOString();
    currentComplaint.updated_at = new Date().toISOString();
    
    alert('Complaint resolved successfully!');
    closeModal();
    updateComplaintCounts();
    renderComplaints();
}

// Utility Functions
function formatComplaintType(type) {
    return type.split('_').map(word => 
        word.charAt(0) + word.slice(1).toLowerCase()
    ).join(' ');
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }).format(date);
}

function formatTime(timestamp) {
    const date = new Date(timestamp);
    return new Intl.DateTimeFormat('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        month: 'short',
        day: 'numeric'
    }).format(date);
}

function getTimeSince(dateString) {
    const created = new Date(dateString);
    const now = new Date();
    const diffMs = now - created;
    const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
    const diffDays = Math.floor(diffHours / 24);
    
    if (diffDays > 0) {
        return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
    } else if (diffHours > 0) {
        return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
    } else {
        const diffMinutes = Math.floor(diffMs / (1000 * 60));
        return `${diffMinutes} minute${diffMinutes > 1 ? 's' : ''} ago`;
    }
}

    </script>
</body>
</html>


  <?php require APPROOT . '/views/inc/footer.php'; ?>