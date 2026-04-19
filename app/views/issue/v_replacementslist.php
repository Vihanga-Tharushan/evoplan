<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>

<link rel="stylesheet" href="../public/css/components/issueC/replacementslist.css" />

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Replacement Management</title>
    <link rel="stylesheet" href="styles/replacement.css">
</head>
<style>
  /* Root Variables */
:root {
    --primary: #4B006E;
    --secondary: #6F1A8C;
    --lightSecondary: #7a6e83ff;
    --dark: #0b1026;
    --light: #f7f8fc;
    --white: #ffffff;
    --danger: #dc3545;
    --warning: #ffc107;
    --success: #28a745;
    --info: #17a2b8;
    --border: #e0e0e0;
    --shadow: rgba(75, 0, 110, 0.1);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: linear-gradient(135deg, var(--light) 0%, #e8e4f0 100%);
    color: var(--dark);
    line-height: 1.6;
    min-height: 100vh;
}

.container {
    max-width: 1400px;
    margin-left: 270px;
    margin-top: 50px;
    padding: 20px;
}

/* Header */
.page-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: var(--white);
    padding: 40px;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px var(--shadow);
}

.page-header h1 {
    margin-bottom: 8px;
}

.subtitle {
    opacity: 0.9;
    font-size: 0.95rem;
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
    color: #6b7280;
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

.badge {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
}

.badge-danger {
    background-color: #ef4444;
}

.badge-warning {
    background-color: #f59e0b;
}

.badge-secondary {
    background-color: #6F1A8C;
}

.tab.active .badge {
    background-color: white;
    color: var(--primary);
}

/* Tab Content */
.tab-content {
    background: var(--white);
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 10px var(--shadow);
    
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
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 20px;
}

.content-header h2 {
    color: var(--primary);
    font-size: 1.5rem;
}

/* Filters */


/* Complaints List */
.complaints-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
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
    color: var(--muted);
    font-size: 0.8rem;
    white-space: nowrap;
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

.complaint-card:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 15px var(--shadow);
}

.complaint-card.priority-CRITICAL {
    border-left-color: var(--danger);
}

.complaint-card.priority-HIGH {
    border-left-color: var(--warning);
}

.complaint-card.priority-MEDIUM {
    border-left-color: var(--info);
}

.complaint-card.priority-LOW {
    border-left-color: var(--success);
}

.complaint-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
    flex-wrap: wrap;
    gap: 10px;
}

.complaint-title {
    flex: 1;
}

.complaint-title h3 {
    color: var(--dark);
    margin-bottom: 5px;
    font-size: 1.1rem;
}

.complaint-meta {
    font-size: 0.85rem;
    color: var(--lightSecondary);
}

.complaint-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

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

.priority-badge.CRITICAL {
    background: var(--danger);
}

.priority-badge.HIGH {
    background: var(--warning);
    color: var(--dark);
}

.priority-badge.MEDIUM {
    background: var(--info);
}

.priority-badge.LOW {
    background: var(--success);
}

.status-badge {
    background: var(--secondary);
    color: var(--white);
}

.type-badge {
    background: var(--lightSecondary);
    color: var(--white);
}

.complaint-body {
    margin-bottom: 15px;
}

.complaint-description {
    color: var(--dark);
    margin-bottom: 15px;
    line-height: 1.5;
}

.complaint-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.detail-item {
    display: flex;
    flex-direction: column;
}

.detail-label {
    font-size: 0.8rem;
    color: var(--lightSecondary);
    margin-bottom: 4px;
    font-weight: 600;
}

.detail-value {
    font-size: 0.95rem;
    color: var(--dark);
}

.complaint-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid var(--border);
}

/* Buttons */
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background: var(--primary);
    color: var(--white);
}

.btn-primary:hover {
    background: var(--secondary);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px var(--shadow);
}

.btn-secondary {
    background: var(--lightSecondary);
    color: var(--white);
}

.btn-secondary:hover {
    background: var(--secondary);
}

.btn-danger {
    background: var(--danger);
    color: var(--white);
}

.btn-danger:hover {
    background: #c82333;
}

.btn-success {
    background: var(--success);
    color: var(--white);
}

.btn-success:hover {
    background: #218838;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 40px;
    color: var(--lightSecondary);
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    opacity: 0.3;
    stroke-width: 1.5;
}

.empty-state p {
    font-size: 1.1rem;
}

/* Replacement Form */
.replacement-form {
    max-width: 800px;
    margin: 0 auto;
}

.form-section {
    background: var(--light);
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 25px;
}

.form-section h3 {
    color: var(--primary);
    margin-bottom: 20px;
    font-size: 1.2rem;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--dark);
}

.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 12px 15px;
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
}

.form-textarea {
    min-height: 100px;
    resize: vertical;
}

.provider-selection {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.provider-card {
    background: var(--white);
    padding: 20px;
    border-radius: 10px;
    border: 2px solid var(--border);
    cursor: pointer;
    transition: all 0.3s ease;
}

.provider-card:hover {
    border-color: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px var(--shadow);
}

.provider-card.selected {
    border-color: var(--primary);
    background: linear-gradient(135deg, rgba(75, 0, 110, 0.05) 0%, rgba(111, 26, 140, 0.05) 100%);
}

.provider-card h4 {
    color: var(--primary);
    margin-bottom: 10px;
}

.provider-info {
    font-size: 0.85rem;
    color: var(--lightSecondary);
    margin-bottom: 5px;
}

.provider-rating {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 10px;
    color: var(--warning);
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 30px;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    animation: fadeIn 0.3s ease;
}

.modal.active {
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: var(--white);
    border-radius: 12px;
    max-width: 500px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    border-bottom: 1px solid var(--border);
}

.modal-header h3 {
    color: var(--primary);
}

.close-btn {
    background: none;
    border: none;
    font-size: 2rem;
    color: var(--lightSecondary);
    cursor: pointer;
    transition: color 0.3s ease;
    line-height: 1;
}

.close-btn:hover {
    color: var(--danger);
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px 25px;
    border-top: 1px solid var(--border);
}

/* Info Box */
.info-box {
    background: linear-gradient(135deg, rgba(75, 0, 110, 0.05) 0%, rgba(111, 26, 140, 0.05) 100%);
    border-left: 4px solid var(--primary);
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.info-box-title {
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 5px;
}

.info-box-content {
    color: var(--dark);
    font-size: 0.9rem;
}

/* Replacement Provider Section */
.replacement-section {
    margin-bottom: 32px;
}

.current-provider-card {
    background: linear-gradient(135deg, #fff8f3 0%, #fff5eb 100%);
    border: 2px solid #fed7aa;
    border-radius: 12px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(75, 0, 110, 0.08);
    transition: all 0.3s ease;
}

.current-provider-card:hover {
    box-shadow: 0 6px 28px rgba(75, 0, 110, 0.12);
    transform: translateY(-2px);
}

.provider-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #fed7aa;
}

.provider-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.provider-title h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text);
    margin: 0;
}

.section-icon {
    width: 28px;
    height: 28px;
    color: var(--primary);
    font-size: 24px;
    filter: drop-shadow(0 2px 8px rgba(75, 0, 110, 0.15));
}

.provider-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.provider-detail-item {
    padding: 16px;
    background: white;
    border-radius: 10px;
    border: 1px solid #fed7aa;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
}

.provider-detail-item:hover {
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.1);
    transform: translateY(-1px);
}

.provider-detail-item label {
    display: block;
    font-size: 0.75rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700;
    margin-bottom: 8px;
}

.provider-detail-item p {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text);
    margin: 0;
}

/* Filter Card */
.filter-card {
    background: linear-gradient(135deg, #f0f4ff 0%, #f5f0ff 100%);
    border: 2px solid #e0d4f7;
    border-radius: 12px;
    padding: 28px;
    box-shadow: 0 2px 12px rgba(75, 0, 110, 0.08);
    transition: all 0.3s ease;
}

.filter-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #e0d4f7;
}

.filter-icon {
    font-size: 24px;
    color: var(--primary);
}

.filter-header h3 {
    margin: 0;
    font-size: 1.2rem;
    color: var(--primary);
}

.filter-subtitle {
    margin: 0;
    font-size: 0.85rem;
    color: var(--lightSecondary);
}

.filter-controls {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-group label {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.filter-select {
    padding: 10px 12px;
    border: 2px solid #e0d4f7;
    border-radius: 8px;
    background: white;
    color: var(--dark);
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
}

.filter-select:hover {
    border-color: var(--primary);
}

/* Providers List */
.providers-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #e0e0e0;
}

.providers-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text);
    margin: 0;
}

.provider-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    border-radius: 50%;
    font-weight: 700;
    font-size: 0.9rem;
}

.providers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
}

.provider-card {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 24px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.provider-card::before {
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

.provider-card:hover {
    border-color: var(--primary);
    box-shadow: 0 8px 32px rgba(75, 0, 110, 0.15);
    transform: translateY(-4px);
}

.provider-card:hover::before {
    opacity: 1;
}

.provider-card-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
}

.provider-avatar {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    flex-shrink: 0;
}

.provider-info h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 4px 0;
}

.provider-info p {
    font-size: 0.85rem;
    color: var(--muted);
    margin: 0;
}

.provider-rating {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.9rem;
    color: #f59e0b;
    font-weight: 600;
}

.provider-card-body {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 16px;
}

.provider-stat {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f5f5f5;
}

.provider-stat:last-child {
    border-bottom: none;
}

.provider-stat-label {
    font-size: 0.85rem;
    color: var(--muted);
    font-weight: 500;
}

.provider-stat-value {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--text);
}

.availability-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.availability-badge.available {
    background: #d1fae5;
    color: #065f46;
}

.availability-badge.soon {
    background: #fef3c7;
    color: #78350f;
}

.provider-card-footer {
    display: flex;
    gap: 10px;
    padding-top: 16px;
    border-top: 1px solid #f0f0f0;
}

.select-provider-btn {
    flex: 1;
    padding: 12px 16px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(75, 0, 110, 0.2);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.select-provider-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.3);
}

.select-provider-btn:active {
    transform: translateY(0);
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .page-header {
        padding: 25px;
    }

    .tab-content {
        padding: 20px;
    }

    .content-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .filters {
        width: 100%;
    }

    .filter-select,
    .filter-input,
    .search-input {
        width: 100%;
    }

    .complaint-header {
        flex-direction: column;
    }

    .complaint-details {
        grid-template-columns: 1fr;
    }

    .tabs {
        flex-direction: column;
    }

    .tab {
        min-width: 100%;
    }

    .provider-selection {
        grid-template-columns: 1fr;
    }

    .table-container {
        overflow-x: auto;
        border-radius: 8px;
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
}

</style>
<body>
    <div class="container">
        

        <!-- Tabs Navigation -->
        <div class="tabs-container">
            <div class="tabs">
                <button class="tab active" data-tab="needs-replacement" onclick="switchTab('needs-replacement')">
                    <i class="fa fa-exclamation-circle tab-icon"></i>
                    Needs Replacement
                    <span class="badge badge-danger" id="needs-count">0</span>
                </button>
                <button class="tab" data-tab="replace-provider" onclick="switchTab('replace-provider')">
                    <i class="fa fa-exchange tab-icon"></i>
                    Replace Provider
                </button>
                <button class="tab" data-tab="replacement-history" onclick="switchTab('replacement-history')">
                    <i class="fa fa-history tab-icon"></i>
                    Replacement History
                    <span class="badge badge-secondary" id="history-count">0</span>
                </button>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Tab 1: Needs Replacement -->
            <div id="needs-replacement" class="tab-pane active">

                <div class="table-container">
                    <table id="needs-replacement-table" class="complaints-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Provider</th>
                                <th>Client Name</th>
                                <th>Event Date</th>
                                <th>Submitted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="needs-replacement-container">
                            <!-- Complaints will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab 2: Replace Provider -->
            <div id="replace-provider" class="tab-pane">
                <div id="replacementFormContainer">
                    <!-- Initially empty, populated when selecting from needs list -->
                    <div class="empty-state">
                        <i class="fa fa-handshake-o empty-icon"></i>
                        <h3>No Selection</h3>
                        <p>Select a complaint from "Needs Replacement" to begin the replacement process</p>
                    </div>
                </div>

                <!-- Current Provider Section -->
                <div id="currentProviderSection" class="replacement-section" style="display: none;">
                    <div class="current-provider-card">
                        <div class="provider-header">
                            <div class="provider-title">
                                <i class="fa fa-exclamation-circle section-icon"></i>
                                <h3>Current Provider (To Replace)</h3>
                            </div>
                        </div>
                        <div class="provider-details-grid">
                            <div class="provider-detail-item">
                                <label>Provider Name</label>
                                <p id="currentProviderName">N/A</p>
                            </div>
                            <div class="provider-detail-item">
                                <label>Service Type</label>
                                <p id="currentServiceType">N/A</p>
                            </div>
                            <div class="provider-detail-item">
                                <label>Event Name</label>
                                <p id="currentEventName">N/A</p>
                            </div>
                            <div class="provider-detail-item">
                                <label>Event Date</label>
                                <p id="currentEventDate">N/A</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div id="filterSection" class="replacement-section filter-card" style="display: none;">
                    <div class="filter-header">
                        <i class="fa fa-filter filter-icon"></i>
                        <h3>Find Replacement Provider</h3>
                        <p class="filter-subtitle">Filter by rating and availability to find the best match</p>
                    </div>
                    <div class="filter-controls">
                        <div class="filter-group">
                            <label for="ratingFilter">Minimum Rating</label>
                            <select id="ratingFilter" class="filter-select" onchange="applyProviderFilters()">
                                <option value="">All Ratings</option>
                                <option value="5">⭐ 5.0 Stars</option>
                                <option value="4.5">⭐ 4.5+ Stars</option>
                                <option value="4">⭐ 4.0+ Stars</option>
                                <option value="3.5">⭐ 3.5+ Stars</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="availabilityFilter">Availability</label>
                            <select id="availabilityFilter" class="filter-select" onchange="applyProviderFilters()">
                                <option value="">All Availability</option>
                                <option value="available">Available Now</option>
                                <option value="soon">Available Soon</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="priceFilter">Budget Range</label>
                            <select id="priceFilter" class="filter-select" onchange="applyProviderFilters()">
                                <option value="">Any Price</option>
                                <option value="budget">Budget Friendly</option>
                                <option value="moderate">Moderate</option>
                                <option value="premium">Premium</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Available Providers List -->
                <div id="providersSection" class="replacement-section" style="display: none;">
                    <div class="providers-header">
                        <h3>Available Replacement Providers</h3>
                        <span id="providerCount" class="provider-badge">0</span>
                    </div>
                    <div id="providersList" class="providers-grid">
                        <!-- Providers will be populated here -->
                    </div>
                </div>
            </div>

            <!-- Tab 3: Replacement History -->
            <div id="replacement-history" class="tab-pane">

                <div class="table-container">
                    <table id="replacement-history-table" class="complaints-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Original Provider</th>
                                <th>Replacement Provider</th>
                                <th>Client Name</th>
                                <th>Event Date</th>
                                <th>Resolved</th>
                            </tr>
                        </thead>
                        <tbody id="replacement-history-container">
                            <!-- Complaints will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Confirmation -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirm Replacement</h3>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                <button class="btn btn-primary" id="confirmBtn">Confirm</button>
            </div>
        </div>
    </div>

    <script>
// Database Records
let pendingReplacements = [];
let replacementHistory = [];
const URLROOT = '<?php echo URLROOT; ?>';
const ISSUE_COORDINATOR_ID = <?php echo isset($_SESSION['ic_id']) ? (int)$_SESSION['ic_id'] : 'null'; ?>;


// State Management
let currentTab = 'needs-replacement';
let selectedComplaint = null;
let selectedProvider = null;

// Load pending replacements from backend
function loadPendingReplacements() {
    var xml = new XMLHttpRequest();
    xml.onload = function(){
        try{
            var response = JSON.parse(this.responseText);
            console.log("Received replacement data:", response);
            
            if (response.success && response.data) {
                // Populate pending replacements from backend
                pendingReplacements = response.data;
                renderNeedsReplacementList();
                updateReplacementStats();
            } else {
                console.error("Error fetching pending replacements:", response.error || "Unknown error");
            }
        }
        catch(err){
            console.error("Error parsing replacement data:", err);
        }
    }

    xml.onerror = function(){
        console.error("Error fetching replacement data");
    }

    xml.open("GET", URLROOT + "/IssueC/getPendingReplacements", true);
    xml.send();
}

// Load replacement history from backend
function loadReplacementHistory() {
    var xml = new XMLHttpRequest();
    xml.onload = function(){
        try{
            var response = JSON.parse(this.responseText);
            console.log("Received replacement history:", response);
            
            if (response.success && response.data) {
                // Populate replacement history from backend
                replacementHistory = response.data;
                renderReplacementHistory();
                updateReplacementStats();
            } else {
                console.error("Error fetching replacement history:", response.error || "Unknown error");
            }
        }
        catch(err){
            console.error("Error parsing replacement history:", err);
        }
    }

    xml.onerror = function(){
        console.error("Error fetching replacement history");
    }

    xml.open("GET", URLROOT + "/IssueC/getReplacementHistory", true);
    xml.send();
}

// Tab Management
function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab');
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            switchTab(tabName);
        });
    });
}

function switchTab(tabName) {
    // Update button states
    document.querySelectorAll('.tab').forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('data-tab') === tabName) {
            btn.classList.add('active');
        }
    });

    // Update pane visibility
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    document.getElementById(tabName).classList.add('active');

    currentTab = tabName;
}

// Update replacement statistics
function updateReplacementStats() {
    const needsCount = pendingReplacements.length;
    const historyCount = replacementHistory.length;
    
    document.getElementById('needs-count').textContent = needsCount;
    document.getElementById('history-count').textContent = historyCount;
}

// Render Needs Replacement List
function renderNeedsReplacementList() {
    const tableBody = document.getElementById('needs-replacement-container');
    
    if (pendingReplacements.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="8" style="padding: 0;">
                    <div class="empty-state" style="margin: 40px 0;">
                        <i class="fa fa-check-circle empty-icon"></i>
                        <h3>No Replacements Needed</h3>
                        <p>All service providers are performing excellently!</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    tableBody.innerHTML = pendingReplacements.map(complaint => `
        <tr class="complaint-row">
            <td class="table-id">#${complaint.replacement_id}</td>
            <td class="table-event" title="${complaint.event_name}">${complaint.event_name}</td>
            <td class="table-provider" title="${complaint.provider_name}">${complaint.provider_name}</td>
            <td class="table-client" title="${complaint.client_name || 'N/A'}">${complaint.client_name || 'N/A'}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${formatDate(complaint.event_date)}</div>
            </td>
            <td class="table-created">
                <div style="font-weight: 600;">${getTimeSince(complaint.submitted_at)}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${formatDate(complaint.submitted_at)}</div>
            </td>
            <td style="display: flex; gap: 8px;">
                <button class="table-view-btn" onclick="selectForReplacement(${complaint.replacement_id})" title="Select for Replacement">
                    <i class="fa fa-exchange"></i>
                    <span>Replace</span>
                </button>
                <button class="table-view-btn" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); flex: 1;" onclick="removeProviderPackageFromList(${complaint.replacement_id})" title="Remove Package">
                    <i class="fa fa-trash"></i>
                    <span>Remove</span>
                </button>
            </td>
        </tr>
    `).join('');

    // Update badge count
    document.getElementById('needs-count').textContent = pendingReplacements.length;
}

// Render Replacement History
function renderReplacementHistory() {
    const tableBody = document.getElementById('replacement-history-container');
    
    if (replacementHistory.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="7" style="padding: 0;">
                    <div class="empty-state" style="margin: 40px 0;">
                        <i class="fa fa-history empty-icon"></i>
                        <h3>No Replacement History</h3>
                        <p>No replacements have been made yet</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    tableBody.innerHTML = replacementHistory.map(complaint => `
        <tr class="complaint-row">
            <td class="table-id">#${complaint.replacement_id}</td>
            <td class="table-event" title="${complaint.event_name}">${complaint.event_name}</td>
            <td class="table-provider" title="${complaint.provider_name}">${complaint.provider_name}</td>
            <td class="table-provider" title="${complaint.replacement_provider || 'N/A'}">${complaint.replacement_provider || 'N/A'}</td>
            <td class="table-client" title="${complaint.client_name || 'N/A'}">${complaint.client_name || 'N/A'}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${formatDate(complaint.event_date)}</div>
            </td>
            <td class="table-created">
                <div style="font-weight: 600;">${getTimeSince(complaint.resolved_at)}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${formatDate(complaint.resolved_at)}</div>
            </td>
        </tr>
    `).join('');

    // Update badge count
    document.getElementById('history-count').textContent = replacementHistory.length;
}

// Select Complaint for Replacement
function selectForReplacement(replacementId) {
    selectedComplaint = pendingReplacements.find(c => c.replacement_id === replacementId);
    if (selectedComplaint) {
        switchTab('replace-provider');
        renderReplacementForm();
    }
}

// Render Replacement Form
function renderReplacementForm() {
    if (!selectedComplaint) {
        document.getElementById('replacementFormContainer').style.display = 'block';
        document.getElementById('currentProviderSection').style.display = 'none';
        document.getElementById('filterSection').style.display = 'none';
        document.getElementById('providersSection').style.display = 'none';
        return;
    }

    // Hide empty state
    document.getElementById('replacementFormContainer').style.display = 'none';
    
    // Show sections
    document.getElementById('currentProviderSection').style.display = 'block';
    document.getElementById('filterSection').style.display = 'block';
    document.getElementById('providersSection').style.display = 'block';

    // Populate current provider details from database
    document.getElementById('currentProviderName').textContent = selectedComplaint.provider_name || 'N/A';
    document.getElementById('currentServiceType').textContent = selectedComplaint.service_type || 'N/A';
    document.getElementById('currentEventName').textContent = selectedComplaint.event_name || 'N/A';
    document.getElementById('currentEventDate').textContent = formatDate(selectedComplaint.event_date);

    // Reset filters
    document.getElementById('ratingFilter').value = '';
    document.getElementById('availabilityFilter').value = '';
    document.getElementById('priceFilter').value = '';

    // Load and display available packages
    loadPackagesByServiceType();
}

// Load Packages by Service Type from API
function loadPackagesByServiceType() {
    if (!selectedComplaint || !selectedComplaint.service_type) {
        console.error("Service type not found");
        alert('Error: Service type not found');
        return;
    }

    var xml = new XMLHttpRequest();
    xml.onload = function(){
        try{
            var response = JSON.parse(this.responseText);
            console.log("Received packages:", response);
            
            if (response.success && response.data) {
                renderPackagesList(response.data);
            } else {
                console.error("Error fetching packages:", response.error || "Unknown error");
                alert('Error fetching packages: ' + (response.error || "Unknown error"));
            }
        }
        catch(err){
            console.error("Error parsing packages data:", err);
            alert('Error parsing packages data');
        }
    }

    xml.onerror = function(){
        console.error("Error fetching packages");
        alert('Error fetching packages');
    }

    const serviceType = selectedComplaint.service_type;
    const excludeServiceId = selectedComplaint.old_service_id;
    xml.open("GET", URLROOT + "/IssueC/getPackagesByServiceType?serviceType=" + encodeURIComponent(serviceType) + "&excludeServiceId=" + excludeServiceId, true);
    xml.send();
}

// Apply provider filters
function applyProviderFilters() {
    const ratingFilter = parseFloat(document.getElementById('ratingFilter').value) || 0;
    
    // Filter packages by rating
    let filtered = [].filter(provider => {
        const matchesRating = provider.avg_rating >= ratingFilter;
        return matchesRating;
    });

    renderPackagesList(filtered);
}

// Render packages list
function renderPackagesList(packages) {
    const container = document.getElementById('providersList');
    const countBadge = document.getElementById('providerCount');

    if (!packages || packages.length === 0) {
        countBadge.textContent = '0';
        container.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1; padding: 60px 40px;">
                <i class="fa fa-search empty-icon"></i>
                <h3>No Packages Available</h3>
                <p>No alternative packages found for ${selectedComplaint.service_type}</p>
            </div>
        `;
        return;
    }

    countBadge.textContent = packages.length;

    container.innerHTML = packages.map(pkg => `
        <div class="provider-card" data-package-id="${pkg.package_id}" data-service-id="${pkg.service_id}">
            <div class="provider-card-header">
                <div class="provider-avatar">
                    ${pkg.profile_pic ? `<img src="${URLROOT}/public/img/profilePics/${pkg.profile_pic}" alt="${pkg.provider_name}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">` : `<i class="fa fa-briefcase"></i>`}
                </div>
                <div class="provider-info">
                    <h4>${pkg.provider_name || 'N/A'}</h4>
                    <p>${pkg.businessName || 'N/A'}</p>
                    <div class="provider-rating">
                        <i class="fa fa-star"></i>
                        <span>${parseFloat(pkg.avg_rating || 0).toFixed(1)}</span>
                        <span style="color: var(--muted); font-weight: normal;">(${pkg.total_reviews || 0} reviews)</span>
                    </div>
                </div>
            </div>

            <div class="provider-card-body">
                <div class="provider-stat">
                    <span class="provider-stat-label">Package</span>
                    <span class="provider-stat-value">${pkg.title || 'N/A'}</span>
                </div>
                <div class="provider-stat">
                    <span class="provider-stat-label">Price</span>
                    <span class="provider-stat-value">Rs. ${formatPrice(pkg.price)}</span>
                </div>
                <div class="provider-stat">
                    <span class="provider-stat-label">Location</span>
                    <span class="provider-stat-value">${pkg.district || 'N/A'}</span>
                </div>
            </div>

            <div class="provider-card-footer">
                <button class="select-provider-btn" onclick="selectPackage(${pkg.package_id}, ${pkg.service_id}, '${pkg.provider_name}')">
                    <i class="fa fa-check" style="margin-right: 6px;"></i>
                    Select
                </button>
            </div>
        </div>
    `).join('');
}

// Format price with commas
function formatPrice(price) {
    return parseFloat(price).toLocaleString('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 0});
}

// Select Package and Assign to Event
function selectPackage(packageId, serviceId, providerName) {
    if (!selectedComplaint) {
        alert('No replacement selected');
        return;
    }

    if (confirm(`Replace "${selectedComplaint.provider_name}" with package from "${providerName}"?`)) {
        var xml = new XMLHttpRequest();
        xml.onload = function(){
            try{
                var response = JSON.parse(this.responseText);
                console.log("Assignment response:", response);
                
                if (response.success) {
                    alert('✓ Package assigned successfully!');
                    
                    // Update pending replacements list
                    const index = pendingReplacements.findIndex(r => r.replacement_id === selectedComplaint.replacement_id);
                    if (index > -1) {
                        pendingReplacements[index].status = 'ASSIGNED';
                        pendingReplacements[index].replacement_provider = providerName;
                    }
                    
                    // Refresh UI
                    loadPendingReplacements();
                    renderNeedsReplacementList();
                    renderReplacementHistory();
                    updateReplacementStats();
                    
                    // Switch to history tab
                    switchTab('replacement-history');
                    
                    // Clear selected complaint
                    selectedComplaint = null;
                } else {
                    alert('Error: ' + (response.error || 'Failed to assign package'));
                }
            }
            catch(err){
                
                console.error("Error parsing response:", err);
                alert('Error processing request');
            }
        }

        xml.onerror = function(){
            console.error("Error assigning package");
            alert('Error assigning package');
        }

        xml.open("POST", URLROOT + "/IssueC/assignProviderPackageToEvent", true);
        xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xml.send('replacement_id=' + selectedComplaint.replacement_id + 
                 '&event_id=' + selectedComplaint.event_id + 
                 '&package_id=' + packageId + 
                 '&new_service_id=' + serviceId +
                 '&client_id=' + selectedComplaint.client_id);
    }
}

// Select Provider (deprecated - kept for compatibility)
function selectProvider(providerId) {
    selectedProvider = [].find(p => p.service_id === providerId);
    
    // Update UI
    document.querySelectorAll('.provider-card').forEach(card => {
        card.classList.remove('selected');
        if (card.getAttribute('data-service-id') == providerId) {
            card.classList.add('selected');
        }
    });
}

// Submit Replacement (deprecated - package selection is now direct)
function submitReplacement() {
    alert('Please select a package to proceed with the replacement');
}

// Process Replacement (deprecated - replaced with API call)
function processReplacement(resolutionType, resolutionNotes) {
    alert('Package assignment is now done through the API. Please select a package from the Replace Provider tab.');
}

// Remove provider package from event (from Needs Replacement tab)
function removeProviderPackageFromList(replacementId) {
    const complaint = pendingReplacements.find(c => c.replacement_id === replacementId);
    if (!complaint) {
        alert('Replacement not found');
        return;
    }

    if (confirm(`Are you sure you want to remove ${complaint.provider_name}'s package from this event?`)) {
        var xml = new XMLHttpRequest();
        xml.onload = function() {
            try {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    alert('✓ Provider package has been removed successfully!');
                    // Refresh the list
                    loadPendingReplacements();
                    renderNeedsReplacementList();
                } else {
                    alert('Error: ' + (response.error || 'Failed to remove package'));
                }
            } catch (err) {
                console.error("Error parsing response:", err);
                alert('Error processing request');
            }
        };

        xml.onerror = function() {
            console.error("Error removing provider package");
            alert('Error removing provider package');
        };

        xml.open("POST", URLROOT + "/IssueC/removeProviderPackage", true);
        xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xml.send('event_id=' + complaint.event_id + '&service_id=' + complaint.old_service_id + '&replacement_id=' + complaint.replacement_id);
    }
}

// Cancel Replacement
function cancelReplacement() {
    selectedComplaint = null;
    selectedProvider = null;
    const container = document.getElementById('replacementFormContainer');
    container.innerHTML = `
        <div class="empty-state">
            <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <p>Select a complaint from "Needs Replacement" to begin the replacement process</p>
        </div>
    `;
}

// Modal Functions
function showConfirmModal(message, onConfirm) {
    const modal = document.getElementById('confirmModal');
    const messageElement = document.getElementById('confirmMessage');
    const confirmBtn = document.getElementById('confirmBtn');

    messageElement.innerHTML = message;
    modal.classList.add('active');

    // Remove previous listeners
    const newConfirmBtn = confirmBtn.cloneNode(true);
    confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);

    document.getElementById('confirmBtn').addEventListener('click', () => {
        onConfirm();
        closeModal();
    });
}

function closeModal() {
    document.getElementById('confirmModal').classList.remove('active');
}



// Utility Functions
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
}

function formatDateTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

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
    
    return 'Just now';
}

function formatComplaintType(type) {
    return type.replace(/_/g, ' ').toLowerCase().replace(/\b\w/g, l => l.toUpperCase());
}

function formatResolutionType(type) {
    if (!type) return 'N/A';
    return type.replace(/_/g, ' ').toLowerCase().replace(/\b\w/g, l => l.toUpperCase());
}

// Initialize Application
document.addEventListener('DOMContentLoaded', () => {
    initializeTabs();
    renderNeedsReplacementList();
    renderReplacementHistory();
    loadPendingReplacements();
    loadReplacementHistory();

    // Close modal on background click
    document.getElementById('confirmModal').addEventListener('click', (e) => {
        if (e.target.id === 'confirmModal') {
            closeModal();
        }
    });
});

    </script>
</body>
</html>


<?php require APPROOT . '/views/inc/footer.php'; ?>