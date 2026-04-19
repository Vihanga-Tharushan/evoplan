<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar1.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="dashboard-container">
    
    <!-- Main Content -->
    <div class="main-content">
        

        <!-- Dashboard Content -->
        <main class="dashboard-grid">
            <!-- KPI Section -->
            <div class="card" style="grid-column: span 4; height: fit-content;">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-bolt"></i> Business Overview</h2>
                   
                </div>
                <div class="card-body">
                    <div class="kpi-grid">
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <div class="kpi-title">Total Events</div>
                                <div class="kpi-icon primary">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                            <div class="kpi-value"><?php echo $data['totalEvents']; ?></div>
                            
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <div class="kpi-title">Upcoming Events</div>
                                <div class="kpi-icon warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="kpi-value"><?php echo $data['upcomingEventsCount']; ?></div>
                            
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <div class="kpi-title">Average Rating</div>
                                <div class="kpi-icon success">
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="kpi-value"><?php echo $data['Rating']->average_rating; ?></div>
                           
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <div class="kpi-title">Total Earnings</div>
                                <div class="kpi-icon primary">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                            <div class="kpi-value"><?php echo isset($data['totalEarnings']) ? 'RS.' . $data['totalEarnings'] : '-'; ?></div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
           

            <!-- Financial Overview -->
            <div class="card" style="grid-column: span 2;">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-chart-bar"></i> Financial Overview</h2>
                    <div class="year-selector">
                        <select id="yearSelector" class="year-dropdown">
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="financialChart"></canvas>
                    </div>
                    <div class="flex justify-between items-center mt-16">
                       
                        
                        
                    </div>
                </div>
                
            </div>

            <!-- Event Status Chart -->
            <div class="card" style="grid-column: span 2;">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-chart-pie"></i> Event Status</h2>
                    <span class="status-indicator yellow">
                        <i class="fas fa-exclamation-circle"></i> 2 pending confirmation
                    </span>
                </div>
                <div class="card-body">
                    <div class="chart-legend-wrapper">
                        <div class="chart-container">
                            <canvas id="eventStatusChart"></canvas>
                        </div>
                        <div class="legend-section">
                            <ul class="chart-legend">
                                <li>
                                    <span class="legend-color" style="background: rgba(16, 185, 129, 0.8);"></span>
                                    <span class="legend-label">Accepted</span>
                                    <span class="legend-count">0</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(245, 158, 11, 0.8);"></span>
                                    <span class="legend-label">Pending</span>
                                    <span class="legend-count">0</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(239, 68, 68, 0.8);"></span>
                                    <span class="legend-label">Rejected</span>
                                    <span class="legend-count">0</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(59, 130, 246, 0.8);"></span>
                                    <span class="legend-label">Completed</span>
                                    <span class="legend-count">0</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- Event Reviews Chart -->
            <div class="card" style="grid-column: span 2;">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-star"></i> Total Reviews</h2>
                    <span class="status-indicator green">
                        <i class="fas fa-thumbs-up"></i> 4.8 average rating
                    </span>
                </div>
                <div class="card-body">
                    <div class="chart-legend-wrapper">
                        <div class="chart-container">
                            <canvas id="eventReviewsChart"></canvas>
                        </div>
                        <div class="legend-section">
                            <ul class="chart-legend">
                                <li>
                                    <span class="legend-color" style="background: rgba(16, 185, 129, 0.8);"></span>
                                    <span class="legend-label">5 Stars</span>
                                    <span class="legend-count">0</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(59, 130, 246, 0.8);"></span>
                                    <span class="legend-label">4 Stars</span>
                                    <span class="legend-count">0</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(245, 158, 11, 0.8);"></span>
                                    <span class="legend-label">3 Stars</span>
                                    <span class="legend-count">0</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(239, 68, 68, 0.8);"></span>
                                    <span class="legend-label">2 Stars</span>
                                    <span class="legend-count">0</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(156, 163, 175, 0.8);"></span>
                                    <span class="legend-label">1 Star</span>
                                    <span class="legend-count">0</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            

            <!-- Package Performance -->
            <div class="card" style="grid-column: span 2;">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-box-open"></i> Package Performance</h2>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="packageChart"></canvas>
                    </div>
                </div>
                   
            </div>
            
        </main>
    </div>
</div>
<Script>const serviceId = <?php echo $_SESSION['service_id']; ?>;</Script>

    <script>
        // Global variables for financial chart
        let financialData = {
            '2026': { data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], growth: '0%' },
            '2025': { data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], growth: '0%' },
            '2024': { data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], growth: '0%' },
            '2023': { data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], growth: '0%' }
        };

        let financialChart;
        const financialCtx = document.getElementById('financialChart').getContext('2d');

        function createFinancialChart(year) {
            const yearData = financialData[year];
            
            if (financialChart) {
                financialChart.destroy();
            }

            financialChart = new Chart(financialCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Earnings (RS.)',
                        data: yearData.data,
                        fill: true,
                        backgroundColor: '#4B006E',
                        borderColor: '#4B006E',
                        borderWidth: 2,
                        tension: 0.3,
                        pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6
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
                            backgroundColor: 'rgba(11, 16, 38, 0.9)',
                            titleColor: '#fff',
                            bodyColor: 'rgba(16, 185, 129, 1)',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'Earnings (RS.)',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Update growth rate display
            const growthElement = document.getElementById('growthRate');
            if (growthElement) {
                growthElement.textContent = yearData.growth;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {

            //fetch event status data and render chart
            fetchEventData(serviceId);

            //fetch review data and render chart
            updateReviewsChart(serviceId);

            //fetch package performance data and render chart
            updatePackagePerformanceChart(serviceId);

            //fetch financial data for current year
            const currentYear = new Date().getFullYear().toString();
            updateFinancialChart(currentYear);

            // Year selector functionality
            document.getElementById('yearSelector').addEventListener('change', function() {
                const selectedYear = this.value;
                updateFinancialChart(selectedYear);
            });

            // Notification badge animation
            setTimeout(() => {
                const badge = document.querySelector('.notification-badge');
                if (badge) {
                    badge.style.transform = 'scale(1.2)';
                    badge.style.transition = 'transform 0.3s ease';
                    setTimeout(() => {
                        badge.style.transform = 'scale(1)';
                    }, 300);
                }
            }, 1000);
        });


        //get financial data for selected year from AJAX and update financial chart
        function updateFinancialChart(year) {
            data = { year: year, service_id: serviceId };
            const xhr = new XMLHttpRequest();
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    console.log('Financial data fetched for year ' + year + ':', response);
    
                    // Update the financialData object with the fetched data
                    financialData[year] = response;
                    
                    // Recreate the chart with the new data
                    createFinancialChart(year);
                }
            };
            xhr.onerror = function() {
                console.error('Error fetching financial data for year ' + year);
            };
            xhr.open('POST', '<?php echo URLROOT; ?>/Service/getFinancialData/', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        }

        // get data from AJAX
        function fetchEventData(serviceId) {
            
            data = { service_id: serviceId };

            const xhr = new XMLHttpRequest();
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    console.log('Event data fetched:', response);
    
                    // Process and update charts with the fetched data
                    updateEventStatusChart(response);
                }
            };

            xhr.onerror = function() {
                console.error('Error fetching event status data');
            };

            xhr.open('POST', '<?php echo URLROOT; ?>/Service/getEventStatus/', true);
            stringifiedData = JSON.stringify(data);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(stringifiedData);
        }

        // Event Status Chart - Update with real data from database
        function updateEventStatusChart(eventData) {
            // eventData format: { ACCEPTED: 32, PENDING: 5, REJECTED: 3, COMPLETED: 2 }
            
            const accepted = eventData.ACCEPTED || 0;
            const pending = eventData.PENDING || 0;
            const rejected = eventData.REJECTED || 0;
            const completed = eventData.COMPLETED || 0;
            
            // Destroy existing chart if it exists
            if(window.eventStatusChartInstance) {
                window.eventStatusChartInstance.destroy();
            }
            
            // Create new chart with fetched data
            const eventCtx = document.getElementById('eventStatusChart').getContext('2d');
            window.eventStatusChartInstance = new Chart(eventCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Accepted', 'Pending', 'Rejected', 'Completed'],
                    datasets: [{
                        data: [accepted, pending, rejected, completed],
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.8)', // Success green
                            'rgba(245, 158, 11, 0.8)', // Warning amber
                            'rgba(239, 68, 68, 0.8)',  // Danger red
                            'rgba(59, 130, 246, 0.8)'  // Info blue
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(11, 16, 38, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1
                        }
                    }
                }
            });
            
            // Update legend counts - find the specific event status chart legend
            const statusContainer = document.getElementById('eventStatusChart').closest('.card');
            const statusLegendItems = statusContainer.querySelectorAll('.chart-legend li');
            statusLegendItems.forEach((li, index) => {
                const counts = [accepted, pending, rejected, completed];
                li.querySelector('.legend-count').textContent = counts[index];
            });
        }

        // Event Reviews Chart - Update with real data from database
        function updateEventReviewsChart(reviewData) {
            // reviewData format: { '5': 42, '4': 28, '3': 15, '2': 8, '1': 3 }
            
            const fiveStars = reviewData['5'] || 0;
            const fourStars = reviewData['4'] || 0;
            const threeStars = reviewData['3'] || 0;
            const twoStars = reviewData['2'] || 0;
            const oneStar = reviewData['1'] || 0;
            
            // Destroy existing chart if it exists
            if(window.eventReviewsChartInstance) {
                window.eventReviewsChartInstance.destroy();
            }
            
            // Create new chart with fetched data
            const reviewCtx = document.getElementById('eventReviewsChart').getContext('2d');
            window.eventReviewsChartInstance = new Chart(reviewCtx, {
                type: 'pie',
                data: {
                    labels: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Star'],
                    datasets: [{
                        label: 'Review Count',
                        data: [fiveStars, fourStars, threeStars, twoStars, oneStar],
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.8)', // 5 stars green
                            'rgba(59, 130, 246, 0.8)', // 4 stars blue
                            'rgba(245, 158, 11, 0.8)', // 3 stars amber
                            'rgba(239, 68, 68, 0.8)',  // 2 stars red
                            'rgba(156, 163, 175, 0.8)' // 1 star gray
                        ],
                        borderWidth: 0
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
                            backgroundColor: 'rgba(11, 16, 38, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1
                        }
                    }
                }
            });
            
            // Update legend counts - find the specific reviews chart legend
            const reviewsContainer = document.getElementById('eventReviewsChart').closest('.card');
            const reviewsLegendItems = reviewsContainer.querySelectorAll('.chart-legend li');
            const counts = [fiveStars, fourStars, threeStars, twoStars, oneStar];
            reviewsLegendItems.forEach((li, index) => {
                li.querySelector('.legend-count').textContent = counts[index];
            });
        }

        //get review data from AJAX and update reviews chart
        function updateReviewsChart(serviceId) {
            data = { service_id: serviceId };
            const xhr = new XMLHttpRequest();
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    console.log('Review data fetched:', response);
    
                    // Process and update reviews chart with the fetched data
                    updateEventReviewsChart(response);
                }
            };
            xhr.onerror = function() {
                console.error('Error fetching review data');
            };
            xhr.open('POST', '<?php echo URLROOT; ?>/Service/getReviewData/', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        }

       
        //get package performance data from AJAX and update package chart
        function updatePackagePerformanceChart(serviceId) {
                data = { service_id: serviceId };
                const xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    if (this.status === 200) {
                        const response = JSON.parse(this.responseText);
                        console.log('Package performance data fetched:', response);
        
                        // Process and update package performance chart with the fetched data
                        updatePackageChart(response);
                    }
                };
                xhr.onerror = function() {
                    console.error('Error fetching package performance data');
                };
                xhr.open('POST', '<?php echo URLROOT; ?>/Service/getPackagePerformanceData/', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(JSON.stringify(data));
        }

        // Update Package Performance Chart with actual usage data
        function updatePackageChart(performanceData) {
            // performanceData format: { labels: ['Premium', 'Standard', ...], data: [10, 5, 3, 2] }
            const labels = performanceData.labels || ['Premium', 'Standard', 'Basic', 'Add-ons'];
            const data = performanceData.data || [0, 0, 0, 0];

            // Destroy existing chart if it exists
            if(window.packageChartInstance) {
                window.packageChartInstance.destroy();
            }

            // Create new chart with fetched data
            const packageCtx = document.getElementById('packageChart').getContext('2d');
            window.packageChartInstance = new Chart(packageCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Usage Count',
                        data: data,
                        backgroundColor: 'rgba(75, 0, 110, 0.7)',
                        borderColor: 'rgba(75, 0, 110, 1)',
                        borderWidth: 1
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
                            backgroundColor: 'rgba(11, 16, 38, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Usage Count',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Package Type',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    </script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>