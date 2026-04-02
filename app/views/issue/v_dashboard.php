<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/issueC/dashboard.css" />

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

        <!-- KPI cards inside header -->
        <div class="kpi-row">
            <div class="kpi-card">
                <div class="kpi-title">Complaints (this month)</div>
                <div class="kpi-value" id="kpiOpen">8</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-title">Resolved This Month</div>
                <div class="kpi-value" id="kpiResolved">5</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-title">Pending Replacements</div>
                <div class="kpi-value" id="kpiPending">3</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-title">Number of Events</div>
                <div class="kpi-value" id="kpiAvgRes">11</div>
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

    <!-- Bottom detail row (3 charts) -->
    <div class="charts-row three-col">
        <div class="chart-card">
            <div class="card-header"><h2>This Month's Complaint Status Breakdown</h2></div>
            <div class="chart-content">
                <div class="chart-wrap" style="position:relative;height:250px;flex:1;">
                    <canvas id="statusChart"></canvas>
                </div>
                <div class="chart-legend" id="statusLegend"></div>
            </div>
        </div>

        <div class="chart-card">
            <div class="card-header"><h2>Events Supervised (Last 6 months)</h2></div>
            <div class="chart-content">
                <div class="chart-wrap" style="position:relative;height:250px;flex:1;">
                    <canvas id="eventsTrendChart"></canvas>
                </div>
                <div class="chart-legend" id="eventsLegend"></div>
            </div>
        </div>

    </div>
    

    
</div>

<!-- Chart.js and frontend script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    window.URLROOT_PATH = '<?php echo URLROOT; ?>';
</script>
<script src="<?php echo URLROOT; ?>/public/js/issue/dashboard.js"></script>

<?php require APPROOT . '/views/inc/footer.php'; ?>

