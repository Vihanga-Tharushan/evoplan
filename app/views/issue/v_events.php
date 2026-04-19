<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/eventswithissues.css" />
<style>
  /* Root Variables */
:root {
    --primary: #4B006E;
    --secondary: #6F1A8C;
    --lightSecondary: #7a6e83ff;
    --dark: #0b1026;
    --light: #f7f8fc;
    --text: #111827;
    --muted: #6b7280;
    --success: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --info: #3b82f6;
    --gray: #64748b;
    --border: #e2e8f0;
    --radius: 16px;
    --white: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: linear-gradient(135deg, var(--light) 0%, #e8e4f0 100%);
    color: var(--text);
    line-height: 1.6;
    min-height: 100vh;
}

.container {
    max-width: 1600px;
    margin-left: 270px;
    margin-top: 50px;
    padding: 20px;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: var(--white);
    padding: 40px;
    border-radius: var(--radius);
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(75, 0, 110, 0.2);
}

.header-content h1 {
    font-size: 2rem;
    margin-bottom: 8px;
}

.subtitle {
    opacity: 0.95;
    font-size: 1rem;
}

.header-stats {
    display: flex;
    gap: 20px;
    margin-top: 25px;
    flex-wrap: wrap;
}

.stat-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 20px 30px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    flex: 1;
    min-width: 150px;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
}

/* Filters Section */
.filters-section {
    background: var(--white);
    padding: 25px;
    border-radius: var(--radius);
    margin-bottom: 25px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    align-items: flex-end;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
    min-width: 200px;
}

.filter-group.search-group {
    flex: 2;
}

.filter-group label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-select,
.search-input {
    padding: 12px 16px;
    border: 2px solid var(--border);
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--text);
    background: var(--white);
    transition: all 0.3s ease;
}

.filter-select:hover,
.search-input:hover {
    border-color: var(--primary);
}

.filter-select:focus,
.search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
}

/* Table Container */
.table-container {
    background: white;
    border-radius: var(--radius);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.events-table {
    width: 100%;
    border-collapse: collapse;
}

.events-table thead {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
}

.events-table thead th {
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

.events-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid var(--border);
    cursor: pointer;
}

.events-table tbody tr:hover {
    background: linear-gradient(135deg, rgba(248, 250, 252, 0.8) 0%, rgba(241, 245, 249, 0.6) 100%);
    transform: translateX(4px);
    box-shadow: 4px 0 12px rgba(75, 0, 110, 0.1);
}

.events-table tbody tr:last-child {
    border-bottom: none;
}

.events-table td {
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

.table-event,
.table-client {
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight: 600;
}

.table-date {
    white-space: nowrap;
}

.table-date-main {
    font-weight: 600;
    color: var(--text);
}

.table-date-sub {
    font-size: 0.75rem;
    color: var(--muted);
}

/* Status Badges */
.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.active {
    background: #d1fae5;
    color: #065f46;
}

.status-badge.at-risk {
    background: #fed7aa;
    color: #92400e;
}

.status-badge.issue-open {
    background: #fecaca;
    color: #991b1b;
}

.status-badge.completed {
    background: #dbeafe;
    color: #1e40af;
}

/* Progress Bar */
.progress-container {
    display: flex;
    flex-direction: column;
    gap: 6px;
    min-width: 120px;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    transition: width 0.3s ease;
}

.progress-fill.low {
    background: linear-gradient(90deg, var(--danger) 0%, #ef5350 100%) !important;
}

.progress-fill.medium {
    background: linear-gradient(90deg, var(--warning) 0%, #fbc02d 100%) !important;
}

.progress-fill.high {
    background: linear-gradient(90deg, var(--success) 0%, #34d399 100%) !important;
}

.progress-text {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--muted);
}

/* Providers Pills */
.providers-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    max-width: 180px;
}

.provider-pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    background: var(--light);
    border: 1px solid var(--border);
    border-radius: 12px;
    font-size: 0.75rem;
    color: var(--text);
}

.provider-pill i {
    font-size: 0.7rem;
    color: var(--primary);
}

/* Table Action Buttons */
.table-actions {
    display: flex;
    gap: 8px;
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

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    z-index: 1000;
    animation: fadeIn 0.3s ease;
    overflow-y: auto;
    padding: 20px;
}

.modal.active {
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.modal-dialog {
    width: 100%;
    max-width: 1200px;
    margin: 40px auto;
}

.modal-dialog.modal-sm {
    max-width: 600px;
}

.modal-content {
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: slideUp 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px;
    border-bottom: 2px solid var(--border);
    background: linear-gradient(135deg, rgba(75, 0, 110, 0.03) 0%, rgba(111, 26, 140, 0.03) 100%);
}

.modal-header h2 {
    color: var(--primary);
    font-size: 1.75rem;
    margin: 0;
}

.close-btn {
    background: none;
    border: none;
    font-size: 2rem;
    color: var(--muted);
    cursor: pointer;
    transition: all 0.3s ease;
    line-height: 1;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

.close-btn:hover {
    color: var(--danger);
    background: rgba(239, 68, 68, 0.1);
}

.modal-body {
    padding: 30px;
    max-height: calc(90vh - 200px);
    overflow-y: auto;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 25px 30px;
    border-top: 2px solid var(--border);
    background: var(--light);
}

/* Modal Sections */
.modal-section {
    margin-bottom: 35px;
}

.modal-section:last-child {
    margin-bottom: 0;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--border);
}

.section-title i {
    font-size: 1.1rem;
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.info-item.full-width {
    grid-column: 1 / -1;
}

.info-item label {
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-item p {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text);
    margin: 0;
}

/* Client Info Card */
.client-info-card {
    background: var(--light);
    padding: 25px;
    border-radius: 12px;
    border: 2px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.client-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    flex: 1;
}

/* Packages List */
.packages-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

.package-card {
    background: var(--light);
    padding: 20px;
    border-radius: 12px;
    border: 2px solid var(--border);
    transition: all 0.3s ease;
}

.package-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.1);
}

.package-card h4 {
    color: var(--primary);
    margin-bottom: 12px;
    font-size: 1.1rem;
}

.package-details {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.package-detail {
    display: flex;
    justify-content: space-between;
    font-size: 0.875rem;
}

.package-detail-label {
    color: var(--muted);
}

.package-detail-value {
    font-weight: 600;
    color: var(--text);
}

/* Providers List */
.providers-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.provider-card-modal {
    background: var(--light);
    padding: 20px;
    border-radius: 12px;
    border: 2px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    transition: all 0.3s ease;
}

.provider-card-modal:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.1);
}

.provider-info-modal {
    flex: 1;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 12px;
}

.provider-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.confirmation-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
}

.confirmation-badge.confirmed {
    background: #d1fae5;
    color: #065f46;
}

.confirmation-badge.pending {
    background: #fef3c7;
    color: #78350f;
}

.confirmation-badge.declined {
    background: #fecaca;
    color: #991b1b;
}

/* Conflicts List */
.conflicts-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.conflict-item {
    background: #fef2f2;
    border: 2px solid #fecaca;
    border-left: 4px solid var(--danger);
    padding: 16px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.conflict-icon {
    color: var(--danger);
    font-size: 1.5rem;
}

.conflict-info {
    flex: 1;
}

.conflict-info h5 {
    color: var(--text);
    margin-bottom: 4px;
}

.conflict-info p {
    color: var(--muted);
    font-size: 0.875rem;
    margin: 0;
}

.no-conflicts {
    background: #f0fdf4;
    border: 2px solid #bbf7d0;
    border-left: 4px solid var(--success);
    padding: 20px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.no-conflicts i {
    color: var(--success);
    font-size: 1.5rem;
}

.no-conflicts p {
    color: var(--text);
    margin: 0;
}

/* Timeline */
.timeline {
    display: flex;
    flex-direction: column;
    gap: 0;
    position: relative;
    padding-left: 40px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--border);
}

.timeline-item {
    position: relative;
    padding: 20px 0 20px 20px;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -30px;
    top: 25px;
    width: 12px;
    height: 12px;
    background: var(--primary);
    border: 3px solid var(--white);
    border-radius: 50%;
    box-shadow: 0 0 0 3px var(--border);
}

.timeline-content {
    background: var(--light);
    padding: 16px;
    border-radius: 8px;
    border: 1px solid var(--border);
}

.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.timeline-title {
    font-weight: 700;
    color: var(--text);
}

.timeline-time {
    font-size: 0.75rem;
    color: var(--muted);
}

.timeline-description {
    color: var(--muted);
    font-size: 0.875rem;
    margin: 0;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: var(--white);
    box-shadow: 0 2px 8px rgba(75, 0, 110, 0.2);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(75, 0, 110, 0.3);
}

.btn-secondary {
    background: var(--gray);
    color: var(--white);
}

.btn-secondary:hover {
    background: var(--muted);
}

.btn-message {
    background: var(--info);
    color: var(--white);
}

.btn-message:hover {
    background: #2563eb;
}

.btn-view {
    background: var(--success);
    color: var(--white);
    font-size: 0.85rem;
    padding: 8px 16px;
}

.btn-view:hover {
    background: #059669;
}

/* Form Elements */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text);
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border);
    border-radius: 8px;
    font-size: 0.95rem;
    font-family: inherit;
    transition: all 0.3s ease;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
}

.form-textarea {
    resize: vertical;
}

.message-info {
    background: var(--light);
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    color: var(--text);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 40px;
    color: var(--muted);
}

.empty-state i {
    font-size: 4rem;
    opacity: 0.3;
    margin-bottom: 20px;
}

.empty-state p {
    font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .info-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .packages-list {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .page-header {
        padding: 25px;
    }

    .header-stats {
        flex-direction: column;
    }

    .filters-section {
        flex-direction: column;
    }

    .filter-group {
        min-width: 100%;
    }

    .table-container {
        overflow-x: auto;
    }

    .events-table {
        min-width: 900px;
    }

    .events-table thead th {
        padding: 10px 6px;
        font-size: 0.75rem;
    }

    .events-table td {
        padding: 10px 6px;
        font-size: 0.75rem;
    }

    .table-event,
    .table-client {
        max-width: 120px;
    }

    .table-view-btn {
        padding: 6px 12px;
        font-size: 0.75rem;
    }

    .modal {
        padding: 10px;
    }

    .modal-dialog {
        margin: 20px auto;
    }

    .modal-header,
    .modal-body,
    .modal-footer {
        padding: 20px;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .client-info-card {
        flex-direction: column;
        align-items: flex-start;
    }

    .client-details {
        grid-template-columns: 1fr;
        width: 100%;
    }

    .btn-message {
        width: 100%;
        justify-content: center;
    }

    .provider-card-modal {
        flex-direction: column;
        align-items: flex-start;
    }

    .provider-info-modal {
        grid-template-columns: 1fr;
        width: 100%;
    }

    .provider-actions {
        width: 100%;
    }

    .provider-actions .btn {
        flex: 1;
        justify-content: center;
    }

    .timeline {
        padding-left: 30px;
    }

    .timeline::before {
        left: 10px;
    }

    .timeline-item::before {
        left: -25px;
    }
}

</style>
<body>
    <div class="container">
        

        <!-- Filters -->
        <div class="filters-section">

            <div class="filter-group">
                <label for="progressFilter">Progress</label>
                <select id="progressFilter" class="filter-select">
                    <option value="">All Progress</option>
                    <option value="33">33% - Basic Info</option>
                    <option value="66">66% - Packages Selected</option>
                    <option value="100">100% - Payment Complete</option>
                </select>
            </div>
            <div class="filter-group search-group">
                <label for="searchInput">Search</label>
                <input type="text" id="searchInput" class="search-input" placeholder="Search by event or client...">
            </div>
        </div>

        <!-- Events Table -->
        <div class="table-container">
            <table class="events-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Event</th>
                        <th>Client</th>
                        <th>Date & Time</th>
                        <th>Progress</th>
                        <th>Providers</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="eventsTableBody">
                    <!-- Dynamically populated -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div id="eventModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modalEventName">Event Details</h2>
                    <button class="close-btn" onclick="closeEventModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Event Info Section -->
                    <div class="modal-section">
                        <h3 class="section-title">
                            <i class="fas fa-info-circle"></i>
                            Event Information
                        </h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Event Type</label>
                                <p id="modalEventType"></p>
                            </div>
                            <div class="info-item">
                                <label>Event Date</label>
                                <p id="modalEventDate"></p>
                            </div>
                            <div class="info-item">
                                <label>Start Time</label>
                                <p id="modalStartTime"></p>
                            </div>
                            <div class="info-item">
                                <label>End Time</label>
                                <p id="modalEndTime"></p>
                            </div>
                            <div class="info-item">
                                <label>Guest Count</label>
                                <p id="modalGuestCount"></p>
                            </div>
                            <div class="info-item">
                                <label>Total Cost</label>
                                <p id="modalTotalCost"></p>
                            </div>
                            <div class="info-item full-width">
                                <label>Venue</label>
                                <p id="modalVenue"></p>
                            </div>
                            <div class="info-item full-width">
                                <label>Description</label>
                                <p id="modalDescription"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Client Info Section -->
                    <div class="modal-section">
                        <h3 class="section-title">
                            <i class="fas fa-user"></i>
                            Client Information
                        </h3>
                        <div class="client-info-card">
                            <div class="client-details">
                                <div class="info-item">
                                    <label>Name</label>
                                    <p id="modalClientName"></p>
                                </div>
                                <div class="info-item">
                                    <label>Email</label>
                                    <p id="modalClientEmail"></p>
                                </div>
                                <div class="info-item">
                                    <label>Phone</label>
                                    <p id="modalClientPhone"></p>
                                </div>
                            </div>
                            <button class="btn btn-message" onclick="startClientConversation()">
                                <i class="fas fa-comments"></i>
                                Message Client
                            </button>
                        </div>
                    </div>

                    <!-- Packages Section -->
                    <div class="modal-section">
                        <h3 class="section-title">
                            <i class="fas fa-box"></i>
                            Selected Packages
                        </h3>
                        <div id="modalPackages" class="packages-list">
                            <!-- Dynamically populated -->
                        </div>
                    </div>

                    <!-- Service Providers Section -->
                    <div class="modal-section">
                        <h3 class="section-title">
                            <i class="fas fa-users"></i>
                            Service Providers
                        </h3>
                        <div id="modalProviders" class="providers-list">
                            <!-- Dynamically populated -->
                        </div>
                    </div>

                    <!-- Availability Conflicts Section -->
                    <div class="modal-section">
                        <h3 class="section-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            Availability Conflicts
                        </h3>
                        <div id="modalConflicts" class="conflicts-list">
                            <!-- Dynamically populated -->
                        </div>
                    </div>

                    <!-- Event Timeline Section -->
                    <div class="modal-section">
                        <h3 class="section-title">
                            <i class="fas fa-history"></i>
                            Event Timeline
                        </h3>
                        <div id="modalTimeline" class="timeline">
                            <!-- Dynamically populated -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeEventModal()">Close</button>
                    <button class="btn btn-primary" onclick="editEvent()">
                        <i class="fas fa-edit"></i>
                        Edit Event
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div id="messageModal" class="modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Message Client</h2>
                    <button class="close-btn" onclick="closeMessageModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="message-info">Start a conversation with <strong id="messageClientName"></strong></p>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" id="messageSubject" class="form-input" placeholder="Enter message subject...">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea id="messageContent" class="form-textarea" rows="6" placeholder="Type your message here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeMessageModal()">Cancel</button>
                    <button class="btn btn-primary" onclick="sendMessage()">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Real Data - Loaded from database
    let mockEvents = [];

// State
let filteredEvents = [...mockEvents];
let currentEvent = null;
const URLROOT = "<?php echo URLROOT; ?>";
// Initialize
document.addEventListener('DOMContentLoaded', () => {
    loadEventsWithIssues();
    setupFilters();
});

// Load Events from Database API
function loadEventsWithIssues() {
    var xml = new XMLHttpRequest();
    xml.onload = function(){
        try{
            var response = JSON.parse(this.responseText);
            console.log("Received events:", response);
            
            if (response.success && response.data) {
                mockEvents = response.data;
                filteredEvents = [...mockEvents];
                renderEventsTable();
                updateStats();
            } else {
                console.error("Error fetching events:", response.error || "Unknown error");
            }
        }
        catch(err){
            console.error("Error parsing events data:", err);
        }
    };

    xml.onerror = function(){
        console.error("Error fetching events");
    };

    xml.open("GET", URLROOT + "/IssueC/getEventsWithIssues", true);
    xml.send();
}

// Render Events Table
function renderEventsTable() {
    const tbody = document.getElementById('eventsTableBody');
    
    if (filteredEvents.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="empty-state">
                    <i class="fas fa-calendar-xmark"></i>
                    <p>No events found matching your filters</p>
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = filteredEvents.map(event => {
        const progressValue = normalizeProgress(event.progress_precent);
        const progressClass = progressValue <= 33 ? 'low' : progressValue <= 66 ? 'medium' : 'high';
        const providers = event.providers || [];
        
        return `
            <tr onclick="openEventModal(${event.event_id})">
                <td class="table-id">#${event.event_id}</td>
                <td class="table-event" title="${event.event_name}">${event.event_name}</td>
                <td class="table-client" title="${event.client_name}">${event.client_name}</td>
                <td class="table-date">
                    <div class="table-date-main">${formatDate(event.start_datetime)}</div>
                    <div class="table-date-sub">${formatTime(event.start_datetime)}</div>
                </td>
                <td>
                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress-fill ${progressClass}" style="width: ${progressValue}%"></div>
                        </div>
                        <span class="progress-text">${progressValue}% ${progressValue <= 33 ? 'Critical' : 'Complete'}</span>
                    </div>
                </td>
                <td>
                    <div class="providers-pills">
                        ${providers.slice(0, 3).map(p => `
                            <span class="provider-pill">
                                <i class="fas fa-user"></i>
                                ${p.name.split(' ')[0]}
                            </span>
                        `).join('')}
                        ${providers.length > 3 ? `<span class="provider-pill">+${providers.length - 3}</span>` : ''}
                    </div>
                </td>
                <td>
                    <div class="table-actions">
                        <button class="table-view-btn" onclick="event.stopPropagation(); openEventModal(${event.event_id})">
                            <i class="fas fa-eye"></i>
                            <span>View</span>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    }).join('');
}

function normalizeProgress(value) {
    const raw = Number(value);
    const normalized = Number.isFinite(raw)
        ? (raw <= 1 ? raw * 100 : raw)
        : 0;
    return Math.max(0, Math.min(100, Math.round(normalized)));
}

// Update Stats
function updateStats() {
    const total = mockEvents.length;
    const active = mockEvents.filter(e => e.status === 'Active').length;
    const atRisk = mockEvents.filter(e => e.status === 'At Risk').length;
    
    // document.getElementById('totalEvents').textContent = total;
    // document.getElementById('activeEvents').textContent = active;
    // document.getElementById('atRiskEvents').textContent = atRisk;
}

// Setup Filters
function setupFilters() {
    document.getElementById('progressFilter').addEventListener('change', applyFilters);
    document.getElementById('searchInput').addEventListener('input', applyFilters);
}

// Apply Filters
function applyFilters() {
    const progress = document.getElementById('progressFilter').value;
    const search = document.getElementById('searchInput').value.toLowerCase();

    filteredEvents = mockEvents.filter(event => {
        const progressValue = normalizeProgress(event.progress_precent);
        const matchesProgress = !progress ||
            (progress === '33' && progressValue <= 33) ||
            (progress === '66' && progressValue > 33 && progressValue <= 66) ||
            (progress === '100' && progressValue > 66);
        const matchesSearch = !search || 
            event.event_name.toLowerCase().includes(search) ||
            event.client_name.toLowerCase().includes(search) ||
            event.event_type.toLowerCase().includes(search);

        return matchesProgress && matchesSearch;
    });

    renderEventsTable();
}

// Open Event Modal
function openEventModal(eventId) {
    currentEvent = mockEvents.find(e => e.event_id === eventId);
    if (!currentEvent) return;

    // Populate event details
    document.getElementById('modalEventName').textContent = currentEvent.event_name;
    document.getElementById('modalEventType').textContent = currentEvent.event_type;
    document.getElementById('modalEventDate').textContent = formatDate(currentEvent.start_datetime);
    document.getElementById('modalStartTime').textContent = formatTime(currentEvent.start_datetime);
    document.getElementById('modalEndTime').textContent = formatTime(currentEvent.end_datetime);
    document.getElementById('modalGuestCount').textContent = `${currentEvent.guest_count} guests`;
    document.getElementById('modalTotalCost').textContent = `Rs. ${(currentEvent.total_cost || 0).toLocaleString()}`;
    document.getElementById('modalVenue').textContent = currentEvent.venue_address;
    document.getElementById('modalDescription').textContent = currentEvent.event_description;

    // Client info
    document.getElementById('modalClientName').textContent = currentEvent.client_name;
    document.getElementById('modalClientEmail').textContent = currentEvent.client_email;
    document.getElementById('modalClientPhone').textContent = currentEvent.client_phone;

    // Packages
    const packages = currentEvent.packages || [];
    const packagesHtml = packages.length > 0 
        ? packages.map(pkg => `
            <div class="package-card">
                <h4>${pkg.name}</h4>
                <div class="package-details">
                    <div class="package-detail">
                        <span class="package-detail-label">Cost:</span>
                        <span class="package-detail-value">Rs. ${(pkg.cost || 0).toLocaleString()}</span>
                    </div>
                    <div class="package-detail">
                        <span class="package-detail-label">Includes:</span>
                        <span class="package-detail-value">${pkg.items || 'N/A'}</span>
                    </div>
                </div>
            </div>
        `).join('')
        : '<p class="empty-state"><i class="fas fa-box-open"></i><p>No packages selected yet</p></p>';
    
    document.getElementById('modalPackages').innerHTML = packagesHtml;

    // Providers
    const providers = currentEvent.providers || [];
    const providersHtml = providers.length > 0 
        ? providers.map(provider => {
            const confirmationClass = provider.confirmation.toLowerCase();
            const serviceId = provider.service_id || provider.id; // Use service_id if available, fallback to id
            return `
                <div class="provider-card-modal">
                    <div class="provider-info-modal">
                        <div class="info-item">
                            <label>Provider Name</label>
                            <p>${provider.name}</p>
                        </div>
                        <div class="info-item">
                            <label>Role</label>
                            <p>${provider.role}</p>
                        </div>
                        <div class="info-item">
                            <label>Confirmation Status</label>
                            <p><span class="confirmation-badge ${confirmationClass}">${provider.confirmation}</span></p>
                        </div>
                    </div>
                    <div class="provider-actions">
                        <button class="btn btn-view" onclick="event.stopPropagation(); viewProvider(${serviceId})">
                            <i class="fas fa-user"></i>
                            View Provider
                        </button>
                    </div>
                </div>
            `;
        }).join('')
        : '<p class="empty-state"><i class="fas fa-users"></i><p>No providers assigned yet</p></p>';
    
    document.getElementById('modalProviders').innerHTML = providersHtml;

    // Conflicts
    const conflicts = currentEvent.conflicts || [];
    const conflictsHtml = conflicts.length > 0 
        ? conflicts.map(conflict => `
            <div class="conflict-item">
                <i class="fas fa-exclamation-triangle conflict-icon"></i>
                <div class="conflict-info">
                    <h5>${conflict.complaint_type || 'Issue'}</h5>
                    <p>${conflict.description || 'No description'} - Status: ${conflict.complaint_status || 'Unknown'}</p>
                </div>
            </div>
        `).join('')
        : `
            <div class="no-conflicts">
                <i class="fas fa-check-circle"></i>
                <p>No availability conflicts detected</p>
            </div>
        `;
    
    document.getElementById('modalConflicts').innerHTML = conflictsHtml;

    // Timeline
    const timeline = currentEvent.timeline || [];
    const timelineHtml = timeline.length > 0 
        ? timeline.map(item => `
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-header">
                        <span class="timeline-title">${item.title}</span>
                        <span class="timeline-time">${formatDateTime(item.created_at)}</span>
                    </div>
                </div>
            </div>
        `).join('')
        : '<p class="empty-state"><i class="fas fa-clock"></i><p>No timeline entries yet</p></p>';
    
    document.getElementById('modalTimeline').innerHTML = timelineHtml;

    // Show modal
    document.getElementById('eventModal').classList.add('active');
}

// Close Event Modal
function closeEventModal() {
    document.getElementById('eventModal').classList.remove('active');
    currentEvent = null;
}

// Start Client Conversation - Check if exists or create new
function startClientConversation() {
    if (!currentEvent) return;
    
    const clientId = currentEvent.client_id;
    
    // Call endpoint to check/create conversation
    var xml = new XMLHttpRequest();
    
    xml.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var response = JSON.parse(this.responseText);
                if (response.status === 'success' && response.conversation_id) {
                    // Navigate to messages page with the conversation selected
                    window.location.href = URLROOT + '/IssueC/messages?conversation_id=' + response.conversation_id;
                } else {
                    alert('Error: ' + (response.message || 'Failed to create conversation'));
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                alert('Error starting conversation');
            }
        } else {
            alert('Error starting conversation');
        }
    };
    
    xml.onerror = function() {
        alert('Error starting conversation');
    };
    
    var data = JSON.stringify({
        client_id: clientId
    });
    
    xml.open("POST", URLROOT + "/IssueC/checkOrCreateConversation", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(data);
}

// Close Message Modal
function closeMessageModal() {
    document.getElementById('messageModal').classList.remove('active');
}

// Send Message (removed - now using mainMessageCoordinator.js)
function sendMessage() {
    alert('Redirecting to messages...');
    closeMessageModal();
}

// View Provider
function viewProvider(providerId) {
    if (!providerId) {
        alert('Provider ID not found');
        return;
    }
    // Navigate to provider profile page
    window.location.href = URLROOT + '/IssueC/viewprovider/' + providerId;
}

// Edit Event
function editEvent() {
    if (!currentEvent) return;
    alert(`Opening event editor for: ${currentEvent.event_name}\n\n(This would open the event editing interface in a real application)`);
}

// Utility Functions
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
    });
}

function formatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
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

// Close modals when clicking outside
document.addEventListener('click', (e) => {
    if (e.target.id === 'eventModal') {
        closeEventModal();
    }
    if (e.target.id === 'messageModal') {
        closeMessageModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeEventModal();
        closeMessageModal();
    }
});

    </script>
</body>
</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>