<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar1.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/dashboard.css" />
<div class="dashboard">

    <!-- Key Metrics -->
    <div class="stats-grid">
    <!-- Total Assigned Events -->
    <div class="stat-card">
        <div class="stat-title">
        <i class="fas fa-tasks"></i>
        Total Assigned Events
        </div>
        <div class="stat-value">14</div>
        <div class="stat-desc">of 20 max capacity • Active this week</div>
    </div>

    <!-- Open Issues Count -->
    <div class="stat-card">
        <div class="stat-title">
        <i class="fas fa-exclamation-triangle"></i>
        Open Issues
        </div>
        <div class="stat-value">7</div>
        <div class="stat-desc">Unresolved complaints & problems</div>
    </div>

    <!-- High-Priority Issues (Last 24–48h) -->
    <div class="stat-card high-priority">
        <div class="stat-title">
        <i class="fas fa-bolt"></i>
        High-Priority Issues
        </div>
        <div class="stat-value">3</div>
        <div class="stat-desc">Reported in last 24–48 hours</div>
    </div>

    <!-- Pending Confirmations -->
    <div class="stat-card pending-confirmation">
        <div class="stat-title">
        <i class="fas fa-clock"></i>
        Pending Confirmations
        </div>
        <div class="stat-value">5</div>
        <div class="stat-desc">Providers not responded post-assignment</div>
    </div>

    <!-- Payment Issues -->
    <div class="stat-card payment-issue">
        <div class="stat-title">
        <i class="fas fa-credit-card"></i>
        Payment Issues
        </div>
        <div class="stat-value">2</div>
        <div class="stat-desc">Failed charges, disputes, or refunds</div>
    </div>

    <!-- Events Today / Tomorrow -->
    <div class="stat-card today-tomorrow">
        <div class="stat-title">
        <i class="fas fa-calendar-day"></i>
        Events Today / Tomorrow
        </div>
        <div class="stat-value">6</div>
        <div class="stat-desc">Requiring preparation or monitoring</div>
    </div>
    </div>

    <!-- Urgent Actions Required -->
    <div class="urgent-banner">
    <i class="fas fa-exclamation-circle"></i>
    <div class="urgent-content">
        <h3>Urgent Actions Required</h3>
        <ul class="urgent-list">
        <li>
            <span>Event #E-7892: Provider cancelled 2h before start</span>
            <a href="#" class="action-link">Assign Swap</a>
        </li>
        <li>
            <span>Client "Acme Corp" complaint: Service quality issue</span>
            <a href="#" class="action-link">Review</a>
        </li>
        <li>
            <span>Payment failed for Event #E-7801 ($420)</span>
            <a href="#" class="action-link">Resolve</a>
        </li>
        </ul>
    </div>
    </div>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>