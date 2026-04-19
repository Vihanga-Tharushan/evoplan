<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/issueC/dashboard.css" />

<style>
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
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: #111827;
    }
</style>

<div class="dashboard">
    <div class="dashboard-header">
        <div class="header-top">
            <div class="header-content">
                <h1>Hello, John! </h1>
            </div>
            <div class="latest-updated-wrapper">
                <div class="header-timestamp">
                    <i class="fas fa-clock"></i>
                    <span>Latest Updated: <span id="lastUpdate">just now</span></span>
                </div>
            </div>
        </div>

        <!-- Metrics Cards -->
        <div class="metrics-container">
            <div class="metric-card">
                <div class="metric-label">Total Events</div>
                <div class="metric-value"><?php echo isset($data['totalevents']) ? $data['totalevents'] : '0'; ?></div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Total Complaints</div>
                <div class="metric-value"><?php echo isset($data['totalComplaints']) ? $data['totalComplaints'] : '0'; ?></div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Needed Replacements</div>
                <div class="metric-value"><?php echo isset($data['pending']) ? $data['pending'] : '0'; ?></div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Total Refunds</div>
                <div class="metric-value"><?php echo isset($data['totalRefunds']) ? $data['totalRefunds'] : '0'; ?></div>
            </div>
        </div>
    </div>

    <!-- Trends & breakdown (2 columns) -->
    <div class="charts-row two-col">
        <div class="chart-card">
            <div class="card-header">
                <h2>Issues Raised vs Resolved (Last 6 months)</h2>
            </div>
            <div class="chart-content">
                <div class="chart-wrap" style="position:relative;height:300px;flex:1;">
                    <canvas id="issuesTrendChart"></canvas>
                </div>
                <div class="chart-legend" id="issuesTrendLegend"></div>
            </div>
        </div>

        <div class="chart-card">
            <div class="card-header">
                <h2>Issues by Category</h2>
            </div>
            <div class="chart-content">
                <div class="chart-wrap" style="position:relative;height:300px;flex:1;">
                    <canvas id="categoryChart"></canvas>
                </div>
                <div class="chart-legend" id="categoryLegend"></div>
            </div>
        </div>
    </div>

    

        

        
    </div>
    

    
</div>

<!-- Chart.js and frontend script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    window.URLROOT_PATH = '<?php echo URLROOT; ?>';
    console.log('URLROOT_PATH set to:', window.URLROOT_PATH);
</script>
<script src="<?php echo URLROOT; ?>/public/js/issue/dashboard.js"></script>

<?php require APPROOT . '/views/inc/footer.php'; ?>

