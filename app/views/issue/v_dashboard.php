<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/issueC/dashboard-new.css" />

<div class="dashboard">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1>Situation Awareness</h1>
            <p>Quick overview of issues, events, and actions requiring attention</p>
        </div>
        <div class="header-timestamp">
            <i class="fas fa-clock"></i>
            <span>Updated: <span id="lastUpdate">Just now</span></span>
        </div>
    </div>

    <!-- Status Indicator -->
    <div class="status-section">
        <div class="status-dot"></div>
        <div class="status-text">
            <strong>Active Monitoring:</strong> <span id="activeEventCount">0</span> events under watch
        </div>
    </div>

    <!-- Key Metrics Grid -->
    <div class="metrics-grid">
        <!-- Open Issues -->
        <a href="<?php echo URLROOT; ?>/IssueC/issues" class="metric-card urgent">
            <div class="metric-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
                <div class="metric-value" id="openIssuesCount">0</div>
                <div class="metric-title">Open Issues</div>
                <div class="metric-subtitle">Immediate attention</div>
            </div>
        </a>

        <!-- High Priority Issues -->
        <a href="<?php echo URLROOT; ?>/IssueC/issues?priority=high" class="metric-card warning">
            <div class="metric-icon">
                <i class="fas fa-fire"></i>
            </div>
            <div>
                <div class="metric-value" id="highPriorityCount">0</div>
                <div class="metric-title">High Priority</div>
                <div class="metric-subtitle">Last 48 hours</div>
            </div>
        </a>

        <!-- Total Assigned Events -->
        <a href="<?php echo URLROOT; ?>/IssueC/events" class="metric-card info">
            <div class="metric-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div>
                <div class="metric-value" id="assignedEventsCount">0</div>
                <div class="metric-title">Assigned Events</div>
                <div class="metric-subtitle">Active monitoring</div>
            </div>
        </a>

        <!-- Pending Confirmations -->
        <a href="<?php echo URLROOT; ?>/IssueC/confirmations" class="metric-card">
            <div class="metric-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div class="metric-value" id="pendingConfirmCount">0</div>
                <div class="metric-title">Pending Confirmations</div>
                <div class="metric-subtitle">Awaiting response</div>
            </div>
        </a>

        <!-- Payment Issues -->
        <a href="<?php echo URLROOT; ?>/IssueC/payments" class="metric-card danger">
            <div class="metric-icon">
                <i class="fas fa-credit-card"></i>
            </div>
            <div>
                <div class="metric-value" id="paymentIssuesCount">0</div>
                <div class="metric-title">Payment Issues</div>
                <div class="metric-subtitle">Requires resolution</div>
            </div>
        </a>

        <!-- Events Today -->
        <a href="<?php echo URLROOT; ?>/IssueC/events?filter=today" class="metric-card success">
            <div class="metric-icon">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div>
                <div class="metric-value" id="todayEventsCount">0</div>
                <div class="metric-title">Events Today</div>
                <div class="metric-subtitle">In progress</div>
            </div>
        </a>

        <!-- Events Tomorrow -->
        <a href="<?php echo URLROOT; ?>/IssueC/events?filter=tomorrow" class="metric-card">
            <div class="metric-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div>
                <div class="metric-value" id="tomorrowEventsCount">0</div>
                <div class="metric-title">Events Tomorrow</div>
                <div class="metric-subtitle">Scheduled confirmations</div>
            </div>
        </a>

        <!-- Response Time -->
        <a href="<?php echo URLROOT; ?>/IssueC/performance" class="metric-card">
            <div class="metric-icon">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            <div>
                <div class="metric-value" id="responseTimeValue">--</div>
                <div class="metric-title">Response Time</div>
                <div class="metric-subtitle">Target: < 3h</div>
            </div>
        </a>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions-section">
        <div class="section-header">
            <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
        </div>
        <div class="actions-grid">
            <a href="<?php echo URLROOT; ?>/IssueC/issues/new" class="action-button">
                <div class="action-icon critical">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="action-content">
                    <h4>Log New Issue</h4>
                    <p>Report client or provider issue</p>
                </div>
            </a>

            <a href="<?php echo URLROOT; ?>/IssueC/confirmations/pending" class="action-button">
                <div class="action-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="action-content">
                    <h4>Follow Up Confirmations</h4>
                    <p>Pending provider responses</p>
                </div>
            </a>

            <a href="<?php echo URLROOT; ?>/IssueC/payments/resolve" class="action-button">
                <div class="action-icon warning">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="action-content">
                    <h4>Resolve Payment Issues</h4>
                    <p>Outstanding payment problems</p>
                </div>
            </a>

            <a href="<?php echo URLROOT; ?>/IssueC/escalations" class="action-button">
                <div class="action-icon urgent">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="action-content">
                    <h4>View Escalations</h4>
                    <p>High-priority issues needing escalation</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Today's Critical Events -->
    <div class="critical-events-section">
        <div class="section-header">
            <h2><i class="fas fa-exclamation-triangle"></i> Critical Events Today</h2>
            <span class="timestamp-small" id="eventTimestamp">Updated just now</span>
        </div>
        <div class="events-list" id="criticalEventsList">
            <div class="empty-state">
                <i class="fas fa-check-circle"></i>
                <p>No critical events requiring immediate attention</p>
            </div>
        </div>
    </div>

    <!-- Active Issues Summary -->
    <div class="issues-summary-section">
        <div class="section-header">
            <h2><i class="fas fa-list"></i> Active Issues Summary</h2>
        </div>
        <div class="summary-grid">
            <div class="summary-card">
                <div class="summary-icon unresolved">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="summary-content">
                    <div class="summary-value" id="unresolvedIssuesCount">0</div>
                    <div class="summary-label">Unresolved Issues</div>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon escalated">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="summary-content">
                    <div class="summary-value" id="escalatedIssuesCount">0</div>
                    <div class="summary-label">Escalated Cases</div>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon critical">
                    <i class="fas fa-fire"></i>
                </div>
                <div class="summary-content">
                    <div class="summary-value" id="criticalIssuesCount">0</div>
                    <div class="summary-label">Critical Issues</div>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon awaiting">
                    <i class="fas fa-hourglass-end"></i>
                </div>
                <div class="summary-content">
                    <div class="summary-value" id="awaitingResponseCount">0</div>
                    <div class="summary-label">Awaiting Response</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update timestamp
    function updateTimestamp() {
        const now = new Date();
        const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        document.getElementById('lastUpdate').textContent = timeString;
        document.getElementById('eventTimestamp').textContent = `Updated ${timeString}`;
    }

    // Initialize data (in real app, these would come from API)
    function initializeDashboard() {
        // Sample data - replace with API calls
        const dashboardData = {
            openIssues: 7,
            highPriority: 3,
            assignedEvents: 18,
            pendingConfirmations: 5,
            paymentIssues: 2,
            eventsToday: 6,
            eventsTomorrow: 8,
            responseTime: '2.4h',
            unresolved: 7,
            escalated: 2,
            critical: 3,
            awaitingResponse: 5,
            activeEvents: 18
        };

        // Update metrics
        document.getElementById('openIssuesCount').textContent = dashboardData.openIssues;
        document.getElementById('highPriorityCount').textContent = dashboardData.highPriority;
        document.getElementById('assignedEventsCount').textContent = dashboardData.assignedEvents;
        document.getElementById('pendingConfirmCount').textContent = dashboardData.pendingConfirmations;
        document.getElementById('paymentIssuesCount').textContent = dashboardData.paymentIssues;
        document.getElementById('todayEventsCount').textContent = dashboardData.eventsToday;
        document.getElementById('tomorrowEventsCount').textContent = dashboardData.eventsTomorrow;
        document.getElementById('responseTimeValue').textContent = dashboardData.responseTime;
        document.getElementById('activeEventCount').textContent = dashboardData.activeEvents;

        // Update summary
        document.getElementById('unresolvedIssuesCount').textContent = dashboardData.unresolved;
        document.getElementById('escalatedIssuesCount').textContent = dashboardData.escalated;
        document.getElementById('criticalIssuesCount').textContent = dashboardData.critical;
        document.getElementById('awaitingResponseCount').textContent = dashboardData.awaitingResponse;

        // Populate critical events
        populateCriticalEvents();
    }

    function populateCriticalEvents() {
        const eventsList = document.getElementById('criticalEventsList');
        // Sample critical events
        const criticalEvents = [
            {
                name: 'TechCorp Product Launch',
                time: '2:00 PM',
                location: 'Convention Center',
                issue: 'Provider delayed by 30 minutes',
                priority: 'urgent'
            },
            {
                name: 'Johnson Anniversary',
                time: '2:00 PM',
                location: 'Private Residence',
                issue: 'Awaiting final confirmation',
                priority: 'warning'
            }
        ];

        if (criticalEvents.length > 0) {
            eventsList.innerHTML = criticalEvents.map(event => `
                <div class="event-item ${event.priority}">
                    <div class="event-header">
                        <h4>${event.name}</h4>
                        <span class="event-time"><i class="fas fa-clock"></i> ${event.time}</span>
                    </div>
                    <div class="event-details">
                        <p><i class="fas fa-map-marker-alt"></i> ${event.location}</p>
                        <p class="event-issue"><i class="fas fa-exclamation-circle"></i> ${event.issue}</p>
                    </div>
                </div>
            `).join('');
        }
    }

    // Auto-update
    updateTimestamp();
    initializeDashboard();
    
    // Update timestamp every minute
    setInterval(updateTimestamp, 60000);

    // Auto-refresh dashboard data every 5 minutes
    setInterval(initializeDashboard, 300000);

    // Add click animation to metric cards
    document.querySelectorAll('.metric-card').forEach(card => {
        card.addEventListener('click', function(e) {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>