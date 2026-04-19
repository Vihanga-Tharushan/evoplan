<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
$totalEvents = (int)($data['total_events'] ?? 0);
$upcomingEvents = (int)($data['upcoming_events'] ?? 0);
$totalPayments = (float)($data['total_payments'] ?? 0);
$financialOverview = $data['financial_overview'] ?? ['years' => [], 'series' => [], 'growth' => []];
$financialYears = $financialOverview['years'] ?? [];
$financialSeries = $financialOverview['series'] ?? [];
$financialGrowth = $financialOverview['growth'] ?? [];

if (empty($financialYears)) {
    $fallbackYear = date('Y');
    $financialYears = [$fallbackYear];
    $financialSeries = [$fallbackYear => array_fill(0, 12, 0)];
    $financialGrowth = [$fallbackYear => '0%'];
}
?>

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
                            <div class="kpi-value"><?php echo $totalEvents; ?></div>
                            <div class="kpi-change">
                                <i class="fas fa-database"></i> From event records
                            </div>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <div class="kpi-title">Upcoming Events</div>
                                <div class="kpi-icon warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="kpi-value"><?php echo $upcomingEvents; ?></div>
                            <div class="kpi-change">
                                <i class="fas fa-calendar"></i> Upcoming from now
                            </div>
                        </div>
                        <!--<div class="kpi-card">
                            <div class="kpi-header">
                                <div class="kpi-title">Average Rating</div>
                                <div class="kpi-icon success">
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="kpi-value"></div>
                            <div class="kpi-change positive">
                                <i class="fas fa-arrow-up"></i> 0.2 increase
                            </div>
                        </div>-->
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <div class="kpi-title">Total Payments</div>
                                <div class="kpi-icon primary">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                            <div class="kpi-value">LKR <?php echo number_format($totalPayments, 2); ?></div>
                            <div class="kpi-change">
                                <i class="fas fa-credit-card"></i> Sum of paid payments
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Financial Overview -->
            <div class="card financial-overview-card" style="grid-column: span 4;">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-chart-bar"></i> Financial Overview</h2>
                    <div class="year-selector">
                        <select id="yearSelector" class="year-dropdown">
                            <?php foreach ($financialYears as $year): ?>
                                <option value="<?php echo htmlspecialchars((string)$year); ?>"><?php echo htmlspecialchars((string)$year); ?></option>
                            <?php endforeach; ?>
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
            <!--<div class="card" style="grid-column: span 2; height: fit-content;">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-chart-pie"></i> Event Status</h2>
                    <span class="status-indicator yellow">
                        <i class="fas fa-exclamation-circle"></i> 2 pending confirmation
                    </span>
                </div>
                <div class="card-body">
                    <div style="display: flex; gap: 30px; align-items: center;">
                        <div class="chart-container" style="flex: 0 0 300px; max-width:300px;">
                            <canvas id="eventStatusChart"></canvas>
                        </div>
                        <div style="flex:1; margin-left: 20px;">
                            <ul class="chart-legend">
                                <li>
                                    <span class="legend-color" style="background: rgba(16, 185, 129, 0.8);"></span>
                                    <span class="legend-label">Accepted</span>
                                    <span class="legend-count">32</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(245, 158, 11, 0.8);"></span>
                                    <span class="legend-label">Pending</span>
                                    <span class="legend-count">5</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(239, 68, 68, 0.8);"></span>
                                    <span class="legend-label">Rejected</span>
                                    <span class="legend-count">3</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(59, 130, 246, 0.8);"></span>
                                    <span class="legend-label">Completed</span>
                                    <span class="legend-count">2</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>-->

            <!-- Event Reviews Chart -->
            <!--<div class="card" style="grid-column: span 2; height: fit-content;">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-star"></i> Event Reviews</h2>
                    <span class="status-indicator green">
                        <i class="fas fa-thumbs-up"></i> 4.8 average rating
                    </span>
                </div>
                <div class="card-body">
                    <div style="display: flex; gap: 30px; align-items: center;">
                        <div class="chart-container" style="flex: 0 0 300px; max-width:300px;">
                            <canvas id="eventReviewsChart"></canvas>
                        </div>
                        <div style="flex:1; margin-left: 20px;">
                            <ul class="chart-legend">
                                <li>
                                    <span class="legend-color" style="background: rgba(16, 185, 129, 0.8);"></span>
                                    <span class="legend-label">5 Stars</span>
                                    <span class="legend-count">28</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(59, 130, 246, 0.8);"></span>
                                    <span class="legend-label">4 Stars</span>
                                    <span class="legend-count">7</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(245, 158, 11, 0.8);"></span>
                                    <span class="legend-label">3 Stars</span>
                                    <span class="legend-count">2</span>
                                </li>
                                <li>
                                    <span class="legend-color" style="background: rgba(239, 68, 68, 0.8);"></span>
                                    <span class="legend-label">2 Stars</span>
                                    <span class="legend-count">1</span>
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
                
            </div>-->

            

            <!-- Package Performance -->
            <!--<div class="card" style="grid-column: span 2; height: fit-content;">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-box-open"></i> Package Performance</h2>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="packageChart"></canvas>
                    </div>
                </div>
                   
            </div>-->
            
        </main>
    </div>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const financialData = <?php echo json_encode([
                'series' => $financialSeries,
                'growth' => $financialGrowth,
                'years' => $financialYears
            ]); ?>;

            let financialChart;
            const financialCtx = document.getElementById('financialChart').getContext('2d');

            function createFinancialChart(year) {
                const yearSeries = financialData.series[year] || Array(12).fill(0);
                const yearGrowth = financialData.growth[year] || '0%';
                
                if (financialChart) {
                    financialChart.destroy();
                }

                financialChart = new Chart(financialCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Earnings (RS.)',
                            data: yearSeries,
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
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                title: {
                                    display: true,
                                    text: 'Spend (LKR)',
                                    font: {
                                        size: 14,
                                        weight: 'bold'
                                    },
                                    color: '#4B006E'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Month',
                                    font: {
                                        size: 14,
                                        weight: 'bold'
                                    },
                                    color: '#4B006E'
                                }
                            }
                        }
                    }
                });

                // Update growth rate display
                document.getElementById('growthRate').textContent = yearGrowth;
            }

            const defaultYear = String(financialData.years[0] || new Date().getFullYear());
            document.getElementById('yearSelector').value = defaultYear;
            createFinancialChart(defaultYear);

            // Year selector functionality
            document.getElementById('yearSelector').addEventListener('change', function() {
                const selectedYear = this.value;
                createFinancialChart(selectedYear);
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

        // // get data from AJAX
        // function fetchEventData(serviceId) {
            
        //     data = { service_id: serviceId };

        //     const xhr = new XMLHttpRequest();
        //     xhr.onload = function() {
        //         if (this.status === 200) {
        //             const response = JSON.parse(this.responseText);
        //             console.log('Event data fetched:', response);
    
        //             // Process and update charts with the fetched data
        //             updateEventStatusChart(response);
        //         }
        //     };

        //     xhr.onerror = function() {
        //         console.error('Error fetching event status data');
        //     };

        //     xhr.open('POST', '<?php echo URLROOT; ?>/Service/getEventStatus/', true);
        //     stringifiedData = JSON.stringify(data);
        //     xhr.setRequestHeader('Content-Type', 'application/json');
        //     xhr.send(stringifiedData);
        // }

        // // Event Status Chart - Update with real data from database
        // function updateEventStatusChart(eventData) {
        //     // eventData format: { ACCEPTED: 32, PENDING: 5, REJECTED: 3, COMPLETED: 2 }
            
        //     const accepted = eventData.ACCEPTED || 0;
        //     const pending = eventData.PENDING || 0;
        //     const rejected = eventData.REJECTED || 0;
        //     const completed = eventData.COMPLETED || 0;
            
        //     // Destroy existing chart if it exists
        //     if(window.eventStatusChartInstance) {
        //         window.eventStatusChartInstance.destroy();
        //     }
            
        //     // Create new chart with fetched data
        //     const eventCtx = document.getElementById('eventStatusChart').getContext('2d');
        //     window.eventStatusChartInstance = new Chart(eventCtx, {
        //         type: 'doughnut',
        //         data: {
        //             labels: ['Accepted', 'Pending', 'Rejected', 'Completed'],
        //             datasets: [{
        //                 data: [accepted, pending, rejected, completed],
        //                 backgroundColor: [
        //                     'rgba(16, 185, 129, 0.8)', // Success green
        //                     'rgba(245, 158, 11, 0.8)', // Warning amber
        //                     'rgba(239, 68, 68, 0.8)',  // Danger red
        //                     'rgba(59, 130, 246, 0.8)'  // Info blue
        //                 ],
        //                 borderWidth: 0
        //             }]
        //         },
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //             cutout: '70%',
        //             plugins: {
        //                 legend: {
        //                     display: false
        //                 },
        //                 tooltip: {
        //                     backgroundColor: 'rgba(11, 16, 38, 0.9)',
        //                     titleColor: '#fff',
        //                     bodyColor: '#fff',
        //                     borderColor: 'rgba(255,255,255,0.1)',
        //                     borderWidth: 1
        //                 }
        //             }
        //         }
        //     });
            
        //     // Update legend counts
        //     document.querySelectorAll('.chart-legend li').forEach((li, index) => {
        //         const counts = [accepted, pending, rejected, completed];
        //         li.querySelector('.legend-count').textContent = counts[index];
        //     });
        // }

        // //get review data from AJAX and update reviews chart
        // function updateReviewsChart(serviceId) {
        //     data = { service_id: serviceId };
        //     const xhr = new XMLHttpRequest();
        //     xhr.onload = function() {
        //         if (this.status === 200) {
        //             const response = JSON.parse(this.responseText);
        //             console.log('Review data fetched:', response);
    
        //             // Process and update reviews chart with the fetched data
        //             updateEventReviewsChart(response);
        //         }
        //     };
        //     xhr.onerror = function() {
        //         console.error('Error fetching review data');
        //     };
        //     xhr.open('POST', '<?php echo URLROOT; ?>/Service/getReviewData/', true);
        //     xhr.setRequestHeader('Content-Type', 'application/json');
        //     xhr.send(JSON.stringify(data));
        // }

        // function updateEventReviewsChart(reviewData) {
        //     // reviewData format: { '5': 28, '4': 7, '3': 2, '2': 1, '1': 0 }
        //     const fiveStars = reviewData['5'] || 0;
        //     const fourStars = reviewData['4'] || 0;
        //     const threeStars = reviewData['3'] || 0;
        //     const twoStars = reviewData['2'] || 0;
        //     const oneStar = reviewData['1'] || 0;

        //     // Destroy existing chart if it exists
        //     if(window.eventReviewsChartInstance) {
        //         window.eventReviewsChartInstance.destroy();
        //     }

        //     // Create new chart with fetched data
        //     const reviewsCtx = document.getElementById('eventReviewsChart').getContext('2d');
        //     window.eventReviewsChartInstance = new Chart(reviewsCtx, {
        //         type: 'pie',
        //         data: {
        //             labels: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Star'],
        //             datasets: [{
        //                 data: [fiveStars, fourStars, threeStars, twoStars, oneStar],
        //                 backgroundColor: [
        //                     'rgba(16, 185, 129, 0.8)', // Success green
        //                     'rgba(59, 130, 246, 0.8)', // Info blue
        //                     'rgba(245, 158, 11, 0.8)', // Warning amber
        //                     'rgba(239, 68, 68, 0.8)',  // Danger red
        //                     'rgba(156, 163, 175, 0.8)' // Gray
        //                 ],
        //                 borderWidth: 0
        //             }]
        //         },
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //             plugins: {
        //                 legend: {
        //                     display: false
        //                 },
        //                 tooltip: {
        //                     backgroundColor: 'rgba(11, 16, 38, 0.9)',
        //                     titleColor: '#fff',
        //                     bodyColor: '#fff',
        //                     borderColor: 'rgba(255,255,255,0.1)',
        //                     borderWidth: 1
        //                 }
        //             }
        //         }
        //     });

        //     // Update legend counts
        //     document.querySelectorAll('.chart-legend li').forEach((li, index) => {
        //         const counts = [fiveStars, fourStars, threeStars, twoStars, oneStar];
        //         li.querySelector('.legend-count').textContent = counts[index];
        //     });
        // }

    </script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>