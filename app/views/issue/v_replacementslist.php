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
.filters {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-select,
.filter-input,
.search-input {
    padding: 10px 15px;
    border: 2px solid var(--border);
    border-radius: 8px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: var(--white);
}

.filter-select:focus,
.filter-input:focus,
.search-input:focus {
    outline: none;
    border-color: var(--primary);
}

.search-input {
    min-width: 250px;
}

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
    background: linear-gradient(135deg, #f9f3fb 0%, #f5ecf8 100%);
    border: 1px solid #e9d5ff;
    border-radius: 12px;
    padding: 28px;
    box-shadow: 0 2px 16px rgba(111, 26, 140, 0.08);
}

.filter-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e9d5ff;
}

.filter-icon {
    font-size: 28px;
    color: var(--primary);
    margin-top: 2px;
}

.filter-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 8px 0;
}

.filter-subtitle {
    color: var(--muted);
    font-size: 0.9rem;
    margin: 0;
}

.filter-controls {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.filter-group label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-select {
    padding: 12px 16px;
    border: 2px solid #e9d5ff;
    background: white;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text);
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-select:hover {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
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
                <div class="content-header">
                    <div class="filters">
                        <select id="priorityFilter" class="filter-select">
                            <option value="">All Priorities</option>
                            <option value="CRITICAL">Critical</option>
                            <option value="HIGH">High</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="LOW">Low</option>
                        </select>
                        <select id="complaintTypeFilter" class="filter-select">
                            <option value="">All Types</option>
                            <option value="NO_SHOW">No Show</option>
                            <option value="POOR_SERVICE">Poor Service</option>
                            <option value="UNPROFESSIONAL">Unprofessional</option>
                            <option value="EQUIPMENT_ISSUE">Equipment Issue</option>
                        </select>
                        <input type="text" id="searchInput" class="search-input" placeholder="Search by event or provider...">
                    </div>
                </div>

                <div class="table-container">
                    <table id="needs-replacement-table" class="complaints-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Provider</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Type</th>
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
                <div class="content-header">
                    <h2>Replacement History</h2>
                    <div class="filters">
                        <input type="date" id="dateFromFilter" class="filter-input">
                        <input type="date" id="dateToFilter" class="filter-input">
                        <select id="resolutionFilter" class="filter-select">
                            <option value="">All Resolutions</option>
                            <option value="PROVIDER_REPLACED">Provider Replaced</option>
                            <option value="REFUND_ISSUED">Refund Issued</option>
                            <option value="WARNING_GIVEN">Warning Given</option>
                            <option value="NO_ACTION">No Action</option>
                        </select>
                    </div>
                </div>

                <div class="table-container">
                    <table id="replacement-history-table" class="complaints-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Original Provider</th>
                                <th>Replacement Provider</th>
                                <th>Priority</th>
                                <th>Type</th>
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
      // Mock Data - Simulating database records
const mockComplaints = [
    {
        complaint_id: 1,
        service_id: 101,
        event_id: 201,
        provider_name: "John Smith",
        event_name: "Corporate Annual Gala 2026",
        event_date: "2026-02-15",
        complainant_type: "CLIENT",
        complaint_type: "NO_SHOW",
        description: "Provider did not show up for the event. Client had to find last-minute replacement.",
        priority: "CRITICAL",
        status: "OPEN",
        assigned_ic_id: 1,
        resolution_type: null,
        resolution_note: null,
        resolved_at: null,
        created_at: "2026-02-03T08:30:00",
        updated_at: "2026-02-03T08:30:00"
    },
    {
        complaint_id: 2,
        service_id: 102,
        event_id: 202,
        provider_name: "Sarah Johnson",
        event_name: "Wedding Reception - Miller",
        event_date: "2026-02-20",
        complainant_type: "IC",
        complaint_type: "LATE_CANCELLATION",
        description: "Provider cancelled 2 days before the event due to family emergency. Need urgent replacement.",
        priority: "HIGH",
        status: "IN_PROGRESS",
        assigned_ic_id: 1,
        resolution_type: null,
        resolution_note: null,
        resolved_at: null,
        created_at: "2026-02-01T14:20:00",
        updated_at: "2026-02-02T10:15:00"
    },
    {
        complaint_id: 3,
        service_id: 103,
        event_id: 203,
        provider_name: "Michael Chen",
        event_name: "Tech Conference 2026",
        event_date: "2026-02-25",
        complainant_type: "SYSTEM",
        complaint_type: "OTHER",
        description: "Provider marked event as 'need replacement' due to scheduling conflict with another commitment.",
        priority: "MEDIUM",
        status: "OPEN",
        assigned_ic_id: 2,
        resolution_type: null,
        resolution_note: null,
        resolved_at: null,
        created_at: "2026-01-30T16:45:00",
        updated_at: "2026-01-30T16:45:00"
    },
    {
        complaint_id: 4,
        service_id: 104,
        event_id: 204,
        provider_name: "Emily Davis",
        event_name: "Birthday Party - Anderson",
        event_date: "2026-02-10",
        complainant_type: "CLIENT",
        complaint_type: "QUALITY_ISSUE",
        description: "Provider's equipment malfunctioned. Client requests different provider for future events.",
        priority: "LOW",
        status: "OPEN",
        assigned_ic_id: 1,
        resolution_type: null,
        resolution_note: null,
        resolved_at: null,
        created_at: "2026-01-28T11:00:00",
        updated_at: "2026-01-28T11:00:00"
    }
];

const mockResolvedComplaints = [
    {
        complaint_id: 5,
        service_id: 105,
        event_id: 205,
        provider_name: "David Wilson",
        event_name: "Corporate Team Building",
        event_date: "2026-01-25",
        complainant_type: "IC",
        complaint_type: "NO_SHOW",
        description: "Provider had transportation issues and couldn't attend.",
        priority: "HIGH",
        status: "RESOLVED",
        assigned_ic_id: 1,
        resolution_type: "PROVIDER_REPLACED",
        resolution_note: "Replaced with Maria Garcia. Event completed successfully.",
        resolved_at: "2026-01-24T15:30:00",
        replacement_provider: "Maria Garcia",
        created_at: "2026-01-24T09:00:00",
        updated_at: "2026-01-24T15:30:00"
    },
    {
        complaint_id: 6,
        service_id: 106,
        event_id: 206,
        provider_name: "Lisa Anderson",
        event_name: "Charity Fundraiser",
        event_date: "2026-01-20",
        complainant_type: "CLIENT",
        complaint_type: "LATE_CANCELLATION",
        description: "Provider cancelled due to illness.",
        priority: "MEDIUM",
        status: "RESOLVED",
        assigned_ic_id: 2,
        resolution_type: "PROVIDER_REPLACED",
        resolution_note: "Replaced with Tom Jackson. Client satisfied with replacement.",
        resolved_at: "2026-01-19T12:00:00",
        replacement_provider: "Tom Jackson",
        created_at: "2026-01-18T16:00:00",
        updated_at: "2026-01-19T12:00:00"
    },
    {
        complaint_id: 7,
        service_id: 107,
        event_id: 207,
        provider_name: "Robert Lee",
        event_name: "Product Launch Event",
        event_date: "2026-01-15",
        complainant_type: "IC",
        complaint_type: "QUALITY_ISSUE",
        description: "Previous performance did not meet standards.",
        priority: "LOW",
        status: "RESOLVED",
        assigned_ic_id: 1,
        resolution_type: "WARNING_GIVEN",
        resolution_note: "Issued warning to provider. Training provided. No replacement needed.",
        resolved_at: "2026-01-16T10:00:00",
        created_at: "2026-01-15T14:00:00",
        updated_at: "2026-01-16T10:00:00"
    }
];

// State Management
let currentTab = 'needs-replacement';
let selectedComplaint = null;
let selectedProvider = null;
let filteredComplaints = [...mockComplaints];
let filteredHistory = [...mockResolvedComplaints];

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
    const needsCount = mockComplaints.filter(c => c.status !== 'PROVIDER_REPLACED').length;
    const historyCount = mockResolvedComplaints.filter(c => c.status === 'PROVIDER_REPLACED').length;
    
    document.getElementById('needs-count').textContent = needsCount;
    document.getElementById('history-count').textContent = historyCount;
}

// Render Needs Replacement List
function renderNeedsReplacementList() {
    const tableBody = document.getElementById('needs-replacement-container');
    
    if (filteredComplaints.length === 0) {
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

    tableBody.innerHTML = filteredComplaints.map(complaint => `
        <tr class="complaint-row">
            <td class="table-id">#${complaint.complaint_id}</td>
            <td class="table-event" title="${complaint.event_name}">${complaint.event_name}</td>
            <td class="table-provider" title="${complaint.provider_name}">${complaint.provider_name}</td>
            <td>
                <span class="priority-badge ${complaint.priority}">${complaint.priority}</span>
            </td>
            <td>
                <span class="status-badge">${complaint.status.replace('_', ' ')}</span>
            </td>
            <td class="table-type">${formatComplaintType(complaint.complaint_type)}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${getTimeSince(complaint.created_at)}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${formatDate(complaint.event_date)}</div>
            </td>
            <td>
                <button class="table-view-btn" onclick="selectForReplacement(${complaint.complaint_id})" title="Select for Replacement">
                    <i class="fa fa-exchange"></i>
                    <span>Replace</span>
                </button>
            </td>
        </tr>
    `).join('');

    // Update badge count
    document.getElementById('needs-count').textContent = filteredComplaints.length;
}

// Render Replacement History
function renderReplacementHistory() {
    const tableBody = document.getElementById('replacement-history-container');
    
    if (filteredHistory.length === 0) {
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

    tableBody.innerHTML = filteredHistory.map(complaint => `
        <tr class="complaint-row">
            <td class="table-id">#${complaint.complaint_id}</td>
            <td class="table-event" title="${complaint.event_name}">${complaint.event_name}</td>
            <td class="table-provider" title="${complaint.provider_name}">${complaint.provider_name}</td>
            <td class="table-provider" title="${complaint.replacement_provider || 'N/A'}">${complaint.replacement_provider || 'N/A'}</td>
            <td>
                <span class="priority-badge ${complaint.priority}">${complaint.priority}</span>
            </td>
            <td class="table-type">${formatComplaintType(complaint.complaint_type)}</td>
            <td class="table-created">
                <div style="font-weight: 600;">${getTimeSince(complaint.resolved_at)}</div>
                <div style="color: var(--muted); font-size: 0.75rem;">${formatDate(complaint.resolved_at)}</div>
            </td>
        </tr>
    `).join('');

    // Update badge count
    document.getElementById('history-count').textContent = filteredHistory.length;
}

// Select Complaint for Replacement
function selectForReplacement(complaintId) {
    selectedComplaint = mockComplaints.find(c => c.complaint_id === complaintId);
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

    // Populate current provider details
    document.getElementById('currentProviderName').textContent = selectedComplaint.provider_name || 'N/A';
    document.getElementById('currentServiceType').textContent = formatComplaintType(selectedComplaint.complaint_type);
    document.getElementById('currentEventName').textContent = selectedComplaint.event_name || 'N/A';
    document.getElementById('currentEventDate').textContent = formatDate(selectedComplaint.event_date);

    // Reset filters
    document.getElementById('ratingFilter').value = '';
    document.getElementById('availabilityFilter').value = '';
    document.getElementById('priceFilter').value = '';

    // Load and display available providers
    applyProviderFilters();
}

// Mock available providers database
const mockAvailableProviders = [
    {
        provider_id: 201,
        provider_name: 'Elite Service Providers',
        rating: 4.8,
        reviews: 245,
        availability: 'available',
        price_range: 'premium',
        specialization: 'NO_SHOW'
    },
    {
        provider_id: 202,
        provider_name: 'Quality Events Co',
        rating: 4.6,
        reviews: 180,
        availability: 'available',
        price_range: 'moderate',
        specialization: 'QUALITY_ISSUE'
    },
    {
        provider_id: 203,
        provider_name: 'Professional Services',
        rating: 4.9,
        reviews: 320,
        availability: 'soon',
        price_range: 'premium',
        specialization: 'NO_SHOW'
    },
    {
        provider_id: 204,
        provider_name: 'Budget Friendly Events',
        rating: 4.2,
        reviews: 95,
        availability: 'available',
        price_range: 'budget',
        specialization: 'QUALITY_ISSUE'
    },
    {
        provider_id: 205,
        provider_name: 'Premium Event Solutions',
        rating: 4.7,
        reviews: 210,
        availability: 'available',
        price_range: 'premium',
        specialization: 'MISCONDUCT'
    },
    {
        provider_id: 206,
        provider_name: 'Reliable Services Ltd',
        rating: 4.5,
        reviews: 150,
        availability: 'soon',
        price_range: 'moderate',
        specialization: 'PAYMENT_DISPUTE'
    }
];

// Apply provider filters
function applyProviderFilters() {
    const ratingFilter = parseFloat(document.getElementById('ratingFilter').value) || 0;
    const availabilityFilter = document.getElementById('availabilityFilter').value;
    const priceFilter = document.getElementById('priceFilter').value;

    let filtered = mockAvailableProviders.filter(provider => {
        const matchesRating = provider.rating >= ratingFilter;
        const matchesAvailability = !availabilityFilter || provider.availability === availabilityFilter;
        const matchesPrice = !priceFilter || provider.price_range === priceFilter;

        return matchesRating && matchesAvailability && matchesPrice;
    });

    renderProvidersList(filtered);
}

// Render providers list
function renderProvidersList(providers) {
    const container = document.getElementById('providersList');
    const countBadge = document.getElementById('providerCount');

    countBadge.textContent = providers.length;

    if (providers.length === 0) {
        container.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1; padding: 60px 40px;">
                <i class="fa fa-search empty-icon"></i>
                <h3>No Providers Found</h3>
                <p>Try adjusting your filters to find available replacement providers</p>
            </div>
        `;
        return;
    }

    container.innerHTML = providers.map(provider => `
        <div class="provider-card">
            <div class="provider-card-header">
                <div class="provider-avatar">
                    <i class="fa fa-briefcase"></i>
                </div>
                <div class="provider-info">
                    <h4>${provider.provider_name}</h4>
                    <p>${formatComplaintType(provider.specialization)}</p>
                    <div class="provider-rating">
                        <i class="fa fa-star"></i>
                        <span>${provider.rating.toFixed(1)}</span>
                        <span style="color: var(--muted); font-weight: normal;">(${provider.reviews} reviews)</span>
                    </div>
                </div>
            </div>

            <div class="provider-card-body">
                <div class="provider-stat">
                    <span class="provider-stat-label">Price Range</span>
                    <span class="provider-stat-value">${formatPriceRange(provider.price_range)}</span>
                </div>
                <div class="provider-stat">
                    <span class="provider-stat-label">Availability</span>
                    <span class="availability-badge ${provider.availability}">${formatAvailability(provider.availability)}</span>
                </div>
                <div class="provider-stat">
                    <span class="provider-stat-label">Specialization</span>
                    <span class="provider-stat-value">${formatComplaintType(provider.specialization)}</span>
                </div>
            </div>

            <div class="provider-card-footer">
                <button class="select-provider-btn" onclick="confirmProviderReplacement(${provider.provider_id}, '${provider.provider_name}')">
                    <i class="fa fa-check" style="margin-right: 6px;"></i>
                    Select
                </button>
            </div>
        </div>
    `).join('');
}

// Helper functions for formatting
function formatPriceRange(range) {
    const ranges = {
        'budget': '💰 Budget Friendly',
        'moderate': '💰💰 Moderate',
        'premium': '💰💰💰 Premium'
    };
    return ranges[range] || 'N/A';
}

function formatAvailability(availability) {
    const statuses = {
        'available': 'Available Now',
        'soon': 'Available Soon'
    };
    return statuses[availability] || 'N/A';
}

// Confirm provider replacement
function confirmProviderReplacement(providerId, providerName) {
    if (confirm(`Replace "${selectedComplaint.provider_name}" with "${providerName}"?`)) {
        // Update complaint with replacement
        selectedComplaint.replacement_provider = providerName;
        selectedComplaint.replacement_provider_id = providerId;
        selectedComplaint.status = 'PROVIDER_REPLACED';
        selectedComplaint.updated_at = new Date().toISOString();

        alert(`✓ ${providerName} has been selected as the replacement provider!`);
        
        // Switch to history tab and refresh
        switchTab('replacement-history');
        renderReplacementHistory();
        updateReplacementStats();
    }
}

// Select Provider
function selectProvider(providerId) {
    selectedProvider = mockAvailableProviders.find(p => p.service_id === providerId);
    
    // Update UI
    document.querySelectorAll('.provider-card').forEach(card => {
        card.classList.remove('selected');
        if (card.getAttribute('data-provider-id') == providerId) {
            card.classList.add('selected');
        }
    });
}

// Submit Replacement
function submitReplacement() {
    if (!selectedProvider) {
        alert('Please select a replacement provider');
        return;
    }

    const resolutionType = document.getElementById('resolutionType').value;
    const resolutionNotes = document.getElementById('resolutionNotes').value;

    if (!resolutionNotes.trim()) {
        alert('Please provide resolution notes');
        return;
    }

    const message = `
        <strong>Confirm Replacement</strong><br><br>
        <strong>Event:</strong> ${selectedComplaint.event_name}<br>
        <strong>Original Provider:</strong> ${selectedComplaint.provider_name}<br>
        <strong>New Provider:</strong> ${selectedProvider.name}<br>
        <strong>Resolution:</strong> ${formatResolutionType(resolutionType)}<br><br>
        Are you sure you want to proceed with this replacement?
    `;

    showConfirmModal(message, () => {
        processReplacement(resolutionType, resolutionNotes);
    });
}

// Process Replacement
function processReplacement(resolutionType, resolutionNotes) {
    // Remove from needs list
    const index = mockComplaints.findIndex(c => c.complaint_id === selectedComplaint.complaint_id);
    if (index > -1) {
        const resolved = {
            ...mockComplaints[index],
            status: 'RESOLVED',
            resolution_type: resolutionType,
            resolution_note: resolutionNotes,
            resolved_at: new Date().toISOString(),
            replacement_provider: selectedProvider ? selectedProvider.name : null
        };
        
        mockComplaints.splice(index, 1);
        mockResolvedComplaints.unshift(resolved);
    }

    // Reset state
    selectedComplaint = null;
    selectedProvider = null;

    // Update UI
    filteredComplaints = [...mockComplaints];
    filteredHistory = [...mockResolvedComplaints];
    renderNeedsReplacementList();
    renderReplacementHistory();

    // Switch to history tab
    switchTab('replacement-history');

    // Show success message
    alert('Replacement processed successfully!');
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

// Filter Functions
function applyFilters() {
    const priority = document.getElementById('priorityFilter').value;
    const complaintType = document.getElementById('complaintTypeFilter').value;
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();

    filteredComplaints = mockComplaints.filter(complaint => {
        const matchesPriority = !priority || complaint.priority === priority;
        const matchesType = !complaintType || complaint.complaint_type === complaintType;
        const matchesSearch = !searchTerm || 
            complaint.event_name.toLowerCase().includes(searchTerm) ||
            complaint.provider_name.toLowerCase().includes(searchTerm) ||
            complaint.description.toLowerCase().includes(searchTerm);

        return matchesPriority && matchesType && matchesSearch;
    });

    renderNeedsReplacementList();
}

function applyHistoryFilters() {
    const dateFrom = document.getElementById('dateFromFilter').value;
    const dateTo = document.getElementById('dateToFilter').value;
    const resolution = document.getElementById('resolutionFilter').value;

    filteredHistory = mockResolvedComplaints.filter(complaint => {
        const matchesDateFrom = !dateFrom || new Date(complaint.resolved_at) >= new Date(dateFrom);
        const matchesDateTo = !dateTo || new Date(complaint.resolved_at) <= new Date(dateTo);
        const matchesResolution = !resolution || complaint.resolution_type === resolution;

        return matchesDateFrom && matchesDateTo && matchesResolution;
    });

    renderReplacementHistory();
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

    // Setup filter listeners
    document.getElementById('priorityFilter').addEventListener('change', applyFilters);
    document.getElementById('complaintTypeFilter').addEventListener('change', applyFilters);
    document.getElementById('searchInput').addEventListener('input', applyFilters);
    
    document.getElementById('dateFromFilter').addEventListener('change', applyHistoryFilters);
    document.getElementById('dateToFilter').addEventListener('change', applyHistoryFilters);
    document.getElementById('resolutionFilter').addEventListener('change', applyHistoryFilters);

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