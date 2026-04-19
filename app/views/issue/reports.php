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
        --primary: #4B006E;
        --secondary: #6F1A8C;
        --bg-light: #f7f8fc;
        --text: #111827;
        --muted: #6b7280;
    }

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

    .report-container {
        max-width: 1400px;
        margin-left: 270px;
        margin-top: 50px;
        padding: 24px;
    }

    /* Report Header */
    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        background: white;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .report-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text);
    }

    .report-header-actions {
        display: flex;
        gap: 12px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--secondary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(75, 0, 110, 0.3);
    }

    .btn-secondary {
        background: var(--light);
        color: var(--text);
        border: 1px solid #e5e7eb;
    }

    .btn-secondary:hover {
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Metric Cards */
    .metrics-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }

    .metric-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .metric-label {
        font-size: 0.875rem;
        color: var(--muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text);
    }

    /* Tables */
    .table-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .table-header {
        padding: 16px 24px;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
    }

    .table-header h2 {
        font-size: 1.25rem;
        font-weight: 700;
    }

    .section-table {
        width: 100%;
        border-collapse: collapse;
    }

    .section-table thead {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
    }

    .section-table thead th {
        padding: 16px 12px;
        text-align: left;
        font-weight: 700;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    }

    .section-table tbody tr {
        border-bottom: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .section-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(248, 250, 252, 0.8) 0%, rgba(241, 245, 249, 0.6) 100%);
        transform: translateX(4px);
        box-shadow: 4px 0 12px rgba(75, 0, 110, 0.1);
    }

    .section-table tbody tr:last-child {
        border-bottom: none;
    }

    .section-table td {
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
    .table-provider,
    .table-client {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-weight: 500;
    }

    .table-amount {
        font-weight: 700;
        color: var(--text);
        text-align: right;
    }

    .table-amount.positive {
        color: var(--success);
    }

    .table-created {
        color: var(--muted);
        font-size: 0.8rem;
        white-space: nowrap;
    }

    /* Progress Bar */
    .progress-container {
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-width: 140px;
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

    /* Table Container */
    .table-container {
        overflow-x: auto;
    }

    .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
    }

    .badge-pending {
        background-color: var(--warning);
    }

    .badge-completed {
        background-color: var(--success);
    }

    .badge-failed {
        background-color: var(--danger);
    }

    .badge-resolved {
        background-color: var(--success);
    }

    .badge-open {
        background-color: var(--warning);
    }

    .badge-escalated {
        background-color: var(--danger);
    }

    /* Toast */
    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: white;
        padding: 16px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 12px;
        border-left: 4px solid var(--success);
        transform: translateY(150%);
        transition: transform 0.3s ease;
    }

    .toast.show {
        transform: translateY(0);
    }

    .toast-icon {
        color: var(--success);
        font-size: 1.25rem;
    }

    @media (max-width: 768px) {
        .report-container {
            margin-left: 0;
            padding: 12px;
        }

        .report-header {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }

        .report-header-actions {
            width: 100%;
            flex-direction: column;
        }

        .metrics-container {
            grid-template-columns: 1fr;
        }

        .charts-container {
            grid-template-columns: 1fr;
        }

        .section-table {
            font-size: 0.8rem;
        }

        .section-table th, .section-table td {
            padding: 12px 8px;
        }
    }
</style>

<div class="report-container">
    <!-- Report Header -->
    <div class="report-header">
        <div>
            <h1>Weekly Report</h1>
            <p id="submission-date" style="color: var(--muted); font-size: 0.875rem;">Date Submitted: </p>
        </div>
        <div class="report-header-actions">
            <button class="btn btn-secondary" id="download-pdf">
                <i class="fas fa-download"></i> Download PDF
            </button>
        </div>
    </div>

    <!-- Metrics -->
    <div class="metrics-container">
        <div class="metric-card">
            <div class="metric-label">Total Events</div>
            <div class="metric-value">0</div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Total Complaints</div>
            <div class="metric-value">0</div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Total Replacements</div>
            <div class="metric-value">0</div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Total Refunds</div>
            <div class="metric-value">0</div>
        </div>
    </div>

    <!-- Events Table -->
    <div class="table-section">
        <div class="table-header">
            <h2>Events Monitoring</h2>
        </div>
        <div class="table-container">
            <table class="section-table">
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Progress</th>
                        <th>Client</th>
                    </tr>
                </thead>
                <tbody id="events-tbody">
                    <tr><td colspan="5" style="text-align: center; color: var(--muted);">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Replacements Table -->
    <div class="table-section">
        <div class="table-header">
            <h2>Service Provider Replacements</h2>
        </div>
        <div class="table-container">
            <table class="section-table">
                <thead>
                    <tr>
                        <th>Replacement ID</th>
                        <th>Event Name</th>
                        <th>Previous Service Provider</th>
                        <th>Current Provider</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="replacements-tbody">
                    <tr><td colspan="6" style="text-align: center; color: var(--muted);">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Resolved Complaints Table -->
    <div class="table-section">
        <div class="table-header">
            <h2>Resolved Complaints</h2>
        </div>
        <table class="section-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Complaint Came From</th>
                    <th>Issue/Dispute</th>
                    <th>Client Name</th>
                    <th>Solution Type</th>
                    <th>Resolved Date</th>
                </tr>
            </thead>
            <tbody id="complaints-tbody">
                <tr><td colspan="6" style="text-align: center; color: var(--muted);">Loading...</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Refunds Table -->
    <div class="table-section">
        <div class="table-header">
            <h2>Refunds Processed</h2>
        </div>
        <div class="table-container">
            <table class="section-table">
                <thead>
                    <tr>
                        <th>Refund ID</th>
                        <th>Event Name</th>
                        <th>Client Name</th>
                        <th>Original Amount</th>
                        <th>Refund Amount</th>
                        <th>Status</th>
                        <th>Refund Date</th>
                    </tr>
                </thead>
                <tbody id="refunds-tbody">
                    <tr><td colspan="7" style="text-align: center; color: var(--muted);">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast" id="successToast">
    <i class="fas fa-check-circle toast-icon"></i>
    <span id="toastMessage">Report successfully sent!</span>
</div>

<!-- PDF Loading Overlay -->
<div id="pdf-loading" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 5000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 32px; border-radius: 12px; text-align: center;">
        <div style="font-size: 3rem; margin-bottom: 16px;"><i class="fas fa-spinner fa-spin"></i></div>
        <p class="pdf-message">Generating PDF... Please wait</p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
const URLROOT = "<?php echo URLROOT; ?>";
window.URLROOT_PATH = URLROOT;


function loadSolvedComplaints() {
    const URLROOT = '<?php echo URLROOT; ?>';
     
    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if (xml.status === 200) {
            var result = JSON.parse(xml.responseText);
            if (result.success && result.data) {
                solvedProviderComplaints = result.data;
                refreshSolvedComplaints();
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

// Load Solved Complaints for client complaints
function loadClientSolvedComplaints() {
    const URLROOT = '<?php echo URLROOT; ?>';
     
    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if (xml.status === 200) {
            var result = JSON.parse(xml.responseText);
            if (result.success && result.data) {
                solvedClientComplaints = result.data;
                refreshSolvedComplaints();
            } else {
                console.error('Failed to load solved client complaints:', result.error);
            }
        } else {
            console.error('Error fetching solved client complaints:', xml.statusText);
        }
    };

    data = {
        ic_id: ISSUE_COORDINATOR_ID
    };
    stringifydata = JSON.stringify(data);
    xml.open("POST", `${URLROOT}/IssueC/getSolvedClientComplaints`, true);
    xml.setRequestHeader("Content-Type", "application/json");
    xml.send(stringifydata);
}


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


// Helper function to format time
function formatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
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

// Initialize page and load all data
document.addEventListener('DOMContentLoaded', function() {
    const ISSUE_COORDINATOR_ID = <?php echo isset($_SESSION['ic_id']) ? (int)$_SESSION['ic_id'] : 0; ?>;
    
    // Set submission date
    document.getElementById('submission-date').textContent = 'Date Submitted: ' + formatDate(new Date().toISOString());
    
    // Load all data
    loadAllData();
});

// Main function to load all data
function loadAllData() {
    loadEvents();
    loadReplacements();
    loadComplaints();
    loadRefunds();
}

// Load Events with Issues
function loadEvents() {
    const URLROOT = window.URLROOT_PATH;
    
    fetch(`${URLROOT}/IssueC/getEventsWithIssues`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success && result.data) {
            populateEventsTable(result.data);
        } else {
            console.error('Failed to load events:', result.error || 'Unknown error');
        }
    })
    .catch(error => {
        console.error('Error fetching events:', error);
    });
}

// Populate Events Table with Progress Bars
function populateEventsTable(events) {
    const tbody = document.getElementById('events-tbody');
    
    if (!events || events.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: var(--muted);">No events found</td></tr>';
        updateMetricCard(0, null, null, null, null);
        return;
    }
    
    // Sort events by progress - show low progress (33%) and medium progress (66%) at top
    const sortedEvents = [...events].sort((a, b) => {
        const progressA = normalizeProgress(a.progress_precent);
        const progressB = normalizeProgress(b.progress_precent);
        return progressA - progressB; // Low progress first
    });
    
    tbody.innerHTML = sortedEvents.map(event => {
        const progressValue = normalizeProgress(event.progress_precent);
        const progressClass = progressValue <= 33 ? 'low' : progressValue <= 66 ? 'medium' : 'high';
        const eventDate = event.date || event.event_date || event.start_datetime || '';
        const formattedDate = eventDate ? formatDate(eventDate) : 'N/A';
        
        return `
            <tr>
                <td class="table-id">#${event.event_id}</td>
                <td class="table-event">${event.event_name || 'N/A'}</td>
                <td>${formattedDate}</td>
                <td>
                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress-fill ${progressClass}" style="width: ${progressValue}%"></div>
                        </div>
                        <div class="progress-text">${Math.round(progressValue)}% Complete</div>
                    </div>
                </td>
                <td>${event.client_name || 'N/A'}</td>
            </tr>
        `;
    }).join('');
    
    // Update total events metric
    updateMetricCard(events.length, null, null, null, null);
}

// Normalize progress value to percentage
function normalizeProgress(value) {
    const raw = Number(value);
    const normalized = Number.isFinite(raw)
        ? (raw <= 1 ? raw * 100 : raw)
        : 0;
    return Math.max(0, Math.min(100, Math.round(normalized)));
}

// Load Replacements
function loadReplacements() {
    const URLROOT = window.URLROOT_PATH;
    
    fetch(`${URLROOT}/IssueC/getReplacementHistory`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success && result.data) {
            populateReplacementsTable(result.data);
        } else {
            console.error('Failed to load replacements:', result.error || 'Unknown error');
        }
    })
    .catch(error => {
        console.error('Error fetching replacements:', error);
    });
}

// Populate Replacements Table
function populateReplacementsTable(replacements) {
    const tbody = document.getElementById('replacements-tbody');
    
    if (!replacements || replacements.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: var(--muted);">
                    <div style="font-size: 48px; margin-bottom: 10px;">📦</div>
                    <p style="margin: 0; font-weight: 600;">No replacement history found</p>
                    <p style="margin: 5px 0 0 0; font-size: 0.9rem;">Service provider replacements will appear here</p>
                </td>
            </tr>
        `;
        updateMetricCard(null, null, null, 0, null);
        return;
    }
    
    // Update total replacements metric
    updateMetricCard(null, null, null, replacements.length, null);
    
    tbody.innerHTML = replacements.map(replacement => {
        // Get replacement ID
        const replacementId = replacement.replacement_id || replacement.id || 'N/A';
        
        // Get event information
        const eventName = replacement.event_name || 'N/A';
        
        // Get previous provider (old provider) - multiple field options
        const previousProvider = replacement.previous_provider_name || 
                               replacement.previous_service_provider ||
                               replacement.old_provider_name ||
                               replacement.provider_name ||
                               'N/A';
        
        // Get current provider (new provider) - multiple field options
        const currentProvider = replacement.new_provider_name || 
                              replacement.new_service_provider ||
                              replacement.current_provider_name ||
                              replacement.replacement_provider ||
                              'N/A';
        
        // Get status with proper formatting
        const status = (replacement.status || 'COMPLETED').toUpperCase();
        const statusBadgeClass = status === 'COMPLETED' ? 'badge-completed' : 
                                status === 'PENDING' ? 'badge-pending' : 
                                status === 'FAILED' ? 'badge-failed' : 'badge-completed';
        
        // Get date - try multiple field options
        const replacementDate = replacement.resolved_at || 
                              replacement.created_at || 
                              replacement.replacement_date || 
                              replacement.updated_at || 
                              '';
        const formattedDate = replacementDate ? formatDate(replacementDate) : 'N/A';
        
        // Additional info for debugging/display
        const serviceType = replacement.service_type ? ` (${replacement.service_type})` : '';
        
        return `
            <tr>
                <td class="table-id">#${replacementId}</td>
                <td class="table-event">${eventName}</td>
                <td class="table-provider">${previousProvider}${serviceType}</td>
                <td class="table-provider">${currentProvider}</td>
                <td>
                    <span class="badge ${statusBadgeClass}">${status}</span>
                </td>
                <td class="table-created">${formattedDate}</td>
            </tr>
        `;
    }).join('');
}

// Load Complaints (Both Provider and Client)
function loadComplaints() {
    const URLROOT = window.URLROOT_PATH;
    const ISSUE_COORDINATOR_ID = <?php echo isset($_SESSION['ic_id']) ? (int)$_SESSION['ic_id'] : 0; ?>;
    
    // Load provider complaints
    fetch(`${URLROOT}/IssueC/getSolvedComplaints`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            ic_id: ISSUE_COORDINATOR_ID
        })
    })
    .then(response => response.json())
    .then(result => {
        const providerComplaints = (result.success && result.data) ? result.data : [];
        
        // Load client complaints
        return fetch(`${URLROOT}/IssueC/getSolvedClientComplaints`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                ic_id: ISSUE_COORDINATOR_ID
            })
        })
        .then(response => response.json())
        .then(result => {
            const clientComplaints = (result.success && result.data) ? result.data : [];
            
            // Combine both types of complaints
            const allComplaints = [...providerComplaints, ...clientComplaints];
            populateComplaintsTable(allComplaints);
        });
    })
    .catch(error => {
        console.error('Error fetching complaints:', error);
    });
}

// Populate Complaints Table
function populateComplaintsTable(complaints) {
    const tbody = document.getElementById('complaints-tbody');
    
    if (!complaints || complaints.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; color: var(--muted);">No complaints found</td></tr>';
        updateMetricCard(null, null, 0, null, null); // Update total complaints metric
        return;
    }
    
    tbody.innerHTML = complaints.map(complaint => {
        // Determine complaint source
        const complaintSource = complaint.complaint_source || 
            (complaint.complainant_type === 'CLIENT' ? 'SERVICE_PROVIDER' : 'CLIENT') ||
            'Unknown';
        const sourceLabel = complaintSource === 'CLIENT' ? 'Client' : 'Service Provider';
        
        // Get complaint type
        const complaintType = complaint.issue_type || complaint.complaint_type || 'OTHER';
        const complaintTypeLabel = formatComplaintType(complaintType);
        
        // Get client/provider name
        const clientName = complaint.client_name || complaint.provider_name || 'Unknown';
        
        // Get resolution type
        const resolutionType = complaint.resolution_type ? formatComplaintType(complaint.resolution_type) : 'N/A';
        
        // Get resolved date
        const resolvedDate = complaint.resolved_at ? formatDate(complaint.resolved_at) : 'N/A';
        
        return `
            <tr>
                <td class="table-id">#${complaint.complaint_id || complaint.id}</td>
                <td>${sourceLabel}</td>
                <td>${complaintTypeLabel}</td>
                <td>${clientName}</td>
                <td><span class="badge badge-resolved">${resolutionType}</span></td>
                <td>${resolvedDate}</td>
            </tr>
        `;
    }).join('');
    
    // Update total complaints metric
    updateMetricCard(null, 1, complaints.length, null, null);
}

// Load Refunds
function loadRefunds() {
    const URLROOT = window.URLROOT_PATH;
    
    fetch(`${URLROOT}/IssueC/getResolvedRefunds`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success && result.data) {
            populateRefundsTable(result.data);
        } else {
            console.error('Failed to load refunds:', result.error || 'Unknown error');
        }
    })
    .catch(error => {
        console.error('Error fetching refunds:', error);
    });
}

// Populate Refunds Table
function populateRefundsTable(refunds) {
    const tbody = document.getElementById('refunds-tbody');
    
    if (!refunds || refunds.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; color: var(--muted);">No refunds found</td></tr>';
        updateMetricCard(null, null, null, null, 0); // Update total refunds metric
        return;
    }
    
    tbody.innerHTML = refunds.map(refund => {
        // Get refund ID
        const refundId = refund.refund_id || refund.id || refund.event_id || 'N/A';
        
        // Get event name
        const eventName = refund.event_name || 'N/A';
        
        // Get client name
        const clientName = refund.client_name || 'N/A';
        
        // Get original amount - try original_amount first (from getResolvedRefunds API)
        const originalAmountValue = parseFloat(refund.total_cost);
        const originalAmount = `Rs. ${originalAmountValue.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        
        // Get refund amount - if not available, calculate as 85% of original (15% provider fee deducted)
        let refundAmountValue = parseFloat(refund.refund_amount || 0);
        if (refundAmountValue === 0 && originalAmountValue > 0) {
            refundAmountValue = originalAmountValue * 0.85;
        }
        const refundAmount = `Rs. ${refundAmountValue.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        
        // Get status with proper formatting
        const status = (refund.status || refund.issue_type || 'REFUNDED').toUpperCase();
        const statusBadgeClass = status === 'REFUNDED' ? 'badge-completed' : 
                                status === 'COMPLETED' ? 'badge-completed' : 
                                status === 'PENDING' ? 'badge-pending' : 
                                status === 'REJECTED' ? 'badge-failed' : 'badge-completed';
        
        // Get refund date with time
        const refundDate = refund.refund_date || refund.resolved_at || refund.resolved_date || refund.updated_at || '';
        const formattedDate = refundDate ? `
            <div style="font-weight: 600;">${formatDate(refundDate)}</div>
            <div style="color: var(--muted); font-size: 0.75rem;">${formatTime(refundDate)}</div>
        ` : 'N/A';
        
        return `
            <tr>
                <td class="table-id">#${refundId}</td>
                <td class="table-event">${eventName}</td>
                <td class="table-client">${clientName}</td>
                <td class="table-amount">${originalAmount}</td>
                <td class="table-amount positive">${refundAmount}</td>
                <td>
                    <span class="badge ${statusBadgeClass}">${status}</span>
                </td>
                <td class="table-created">${formattedDate}</td>
            </tr>
        `;
    }).join('');
    
    // Update total refunds metric
    updateMetricCard(null, null, null, null, refunds.length);
}

// Update individual metric cards
function updateMetricCard(totalEvents, complaintIndex, complaintCount, replacementCount, refundCount) {
    const metricCards = document.querySelectorAll('.metric-card');
    
    if (totalEvents !== null && metricCards[0]) {
        metricCards[0].querySelector('.metric-value').textContent = totalEvents;
    }
    
    if (complaintCount !== null && metricCards[1]) {
        metricCards[1].querySelector('.metric-value').textContent = complaintCount;
    }
    
    if (replacementCount !== null && metricCards[2]) {
        metricCards[2].querySelector('.metric-value').textContent = replacementCount;
    }
    
    if (refundCount !== null && metricCards[3]) {
        metricCards[3].querySelector('.metric-value').textContent = refundCount;
    }
}

// Download Report as PDF
document.addEventListener('DOMContentLoaded', function() {
    const downloadBtn = document.getElementById('download-pdf');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', downloadReportPDF);
    }
});

function downloadReportPDF() {
    const pdfLoading = document.getElementById('pdf-loading');
    const reportContainer = document.querySelector('.report-container');
    
    if (!reportContainer) {
        alert('Report container not found');
        return;
    }
    
    // Show loading indicator
    pdfLoading.style.display = 'flex';
    
    const options = {
        scale: 2,
        useCORS: true,
        logging: false,
        allowTaint: true,
        backgroundColor: '#ffffff',
        windowHeight: reportContainer.scrollHeight
    };
    
    html2canvas(reportContainer, options).then(canvas => {
        const { jsPDF } = window.jspdf;
        
        // PDF page dimensions
        const pageWidth = 210; // A4 width in mm
        const pageHeight = 297; // A4 height in mm
        const margin = 10; // mm
        const contentWidth = pageWidth - (margin * 2);
        
        // Calculate scale for canvas to PDF
        const scale = contentWidth / canvas.width * 25.4; // Convert to pixels (DPI conversion)
        const pdfImgWidth = contentWidth;
        const pdfImgHeight = (canvas.height * pdfImgWidth) / canvas.width;
        
        // Available height per page
        const availableHeight = pageHeight - (margin * 2);
        
        // Calculate pages needed
        const totalPages = Math.ceil(pdfImgHeight / availableHeight);
        
        // Create PDF with first page
        const pdf = new jsPDF('p', 'mm', 'A4');
        
        // Split canvas into sections and add to PDF
        const canvasHeight = canvas.height;
        const sectionHeight = Math.ceil(canvasHeight / totalPages);
        
        for (let pageNum = 0; pageNum < totalPages; pageNum++) {
            if (pageNum > 0) {
                pdf.addPage();
            }
            
            // Create canvas for this page section
            const pageCanvas = document.createElement('canvas');
            pageCanvas.width = canvas.width;
            pageCanvas.height = Math.min(sectionHeight, canvasHeight - (pageNum * sectionHeight));
            
            const ctx = pageCanvas.getContext('2d');
            const sourceY = pageNum * sectionHeight;
            
            // Copy the relevant portion from original canvas
            ctx.drawImage(
                canvas,
                0, sourceY,
                canvas.width, pageCanvas.height,
                0, 0,
                canvas.width, pageCanvas.height
            );
            
            // Convert to image and add to PDF
            const pageImgData = pageCanvas.toDataURL('image/png');
            pdf.addImage(
                pageImgData,
                'PNG',
                margin,
                margin,
                pdfImgWidth,
                (pageCanvas.height * pdfImgWidth) / canvas.width
            );
        }
        
        // Generate filename with current date
        const now = new Date();
        const dateStr = now.toISOString().split('T')[0];
        const filename = `Weekly_Report_${dateStr}.pdf`;
        
        // Download PDF
        pdf.save(filename);
        
        // Hide loading indicator
        pdfLoading.style.display = 'none';
    }).catch(error => {
        console.error('Error generating PDF:', error);
        alert('Failed to generate PDF. Please try again.');
        pdfLoading.style.display = 'none';
    });
}

</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
