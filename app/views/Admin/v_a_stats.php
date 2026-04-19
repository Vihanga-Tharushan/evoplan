<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Stats).css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="dashboard-stats">
  <div class="stats-header">
    <h1>Dashboard Overview</h1>
  </div>

  <!-- Top Stats Cards -->
  <div class="stats-cards-container">
    <div class="stat-card">
      <div class="stat-icon income-icon">
        <i class="fas fa-chart-line"></i>
      </div>
      <div class="stat-content">
        <div class="stat-label">Total Income</div>
        <div class="stat-value">Rs. <?php echo isset($totalIncome) ? number_format($totalIncome, 2) : '0.00'; ?></div>
        <!-- <div class="stat-change positive">↑ 12.5% from last month</div> -->
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon users-icon">
        <i class="fas fa-users"></i>
      </div>
      <div class="stat-content">
        <div class="stat-label">Total Users</div>
        <div class="stat-value"><?php echo isset($totalUsers) ? number_format($totalUsers) : '0'; ?></div>
        <!-- <div class="stat-change positive">↑ 8.2% from last month</div> -->
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon events-icon">
        <i class="fas fa-calendar-check"></i>
      </div>
      <div class="stat-content">
        <div class="stat-label">Total Events</div>
        <div class="stat-value"><?php echo isset($totalEvents) ? number_format($totalEvents) : '0'; ?></div>
        <!-- <div class="stat-change positive">↑ 5.1% from last month</div> -->
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon services-icon">
        <i class="fas fa-handshake"></i>
      </div>
      <div class="stat-content">
        <div class="stat-label">Service Providers</div>
        <div class="stat-value"><?php echo isset($serviceProviders) ? number_format($serviceProviders) : '0'; ?></div>
        <!-- <div class="stat-change positive">↑ 3.7% from last month</div> -->
      </div>
    </div>
  </div>

  <!-- Charts Row 1 -->
  <div class="charts-grid">
    <div class="chart-card">
      <div class="chart-header">
        <h2>Income Overview</h2>
        <div class="year-selector-container-inline">
          <label for="incomeYearDropdown">Year:</label>
          <select id="incomeYearDropdown" class="year-dropdown-inline">
            <option value="2026">2026</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
          </select>
        </div>
      </div>
      <div class="chart-wrapper">
        <canvas id="incomeChart"></canvas>
      </div>
    </div>

    <div class="chart-card">
      <div class="chart-header">
        <h2>User Growth Summary</h2>
        <div class="year-selector-container-inline">
          <label for="userGrowthYearDropdown">Year:</label>
          <select id="userGrowthYearDropdown" class="year-dropdown-inline">
            <option value="2026">2026</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
          </select>
        </div>
      </div>
      <div class="chart-wrapper">
        <canvas id="userGrowthChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Charts Row 2 -->
  <div class="charts-grid">
    <div class="chart-card">
      <div class="chart-header">
        <h2>Events by Progress Status</h2>
      </div>
      <div class="chart-wrapper pie-wrapper">
        <canvas id="eventProgressChart"></canvas>
      </div>
    </div>

    <div class="chart-card">
      <div class="chart-header">
        <h2>Service Providers by Approval Status</h2>
      </div>
      <div class="chart-wrapper pie-wrapper">
        <canvas id="approvalChart"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
  // Chart.js default options
  Chart.defaults.font.family = "'Inter', 'Segoe UI', sans-serif";
  Chart.defaults.color = '#7d7d7d';

  // Chart instances
  let incomeChart = null;
  let userGrowthChart = null;

  // Income Chart function
  function createIncomeChart(year = '2026') {
    const incomeCtx = document.getElementById('incomeChart').getContext('2d');
    
    const incomeDataByYear = <?php 
      if(isset($monthlyIncomeData) && is_array($monthlyIncomeData)){
        $jsData = [];
        foreach($monthlyIncomeData as $year => $data){
          $jsData[$year] = array_map(function($val){ return round($val, 2); }, $data);
        }
        echo json_encode($jsData);
      } else {
        echo json_encode([]);
      }
    ?>;

    if (incomeChart) {
      incomeChart.destroy();
    }
    
    incomeChart = new Chart(incomeCtx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          label: 'Monthly Income',
          data: incomeDataByYear[year],
          backgroundColor: 'rgba(16, 185, 129, 0.8)',
          borderColor: 'rgba(16, 185, 129, 1)',
          borderWidth: 1,
          borderRadius: 6,
          borderSkipped: false
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: true,
            position: 'top',
            labels: {
              usePointStyle: true,
              padding: 20,
              font: { size: 13, weight: 'bold' }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            },
            title: {
              display: true,
              text: 'Income'
            },
            ticks: {
              callback: function(value) {
                return 'Rs. ' + value.toLocaleString();
              }
            }
          },
          x: {
            grid: {
              display: false
            },
            title: {
              display: true,
              text: 'Month'
            }
          }
        }
      }
    });
  }

  // User Growth Chart function
  function createUserGrowthChart(year = '2026') {
    const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
    
    const userDataByYear = <?php 
      if(isset($monthlyUserGrowthData) && is_array($monthlyUserGrowthData)){
        $jsData = [];
        foreach($monthlyUserGrowthData as $year => $data){
          $jsData[$year] = [
            'providers' => array_map('intval', $data['providers'] ?? []),
            'clients' => array_map('intval', $data['clients'] ?? [])
          ];
        }
        echo json_encode($jsData);
      } else {
        echo json_encode([]);
      }
    ?>;

    if (userGrowthChart) {
      userGrowthChart.destroy();
    }
    
    userGrowthChart = new Chart(userGrowthCtx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
          {
            label: 'Service Providers',
            data: userDataByYear[year].providers,
            backgroundColor: 'rgba(75, 0, 110, 0.8)',
            borderColor: 'rgba(75, 0, 110, 1)',
            borderWidth: 1,
            borderRadius: 6,
            borderSkipped: false
          },
          {
            label: 'Clients',
            data: userDataByYear[year].clients,
            backgroundColor: 'rgba(168, 85, 247, 0.6)',
            borderColor: 'rgba(168, 85, 247, 1)',
            borderWidth: 1,
            borderRadius: 6,
            borderSkipped: false
          }
        ]
      },
      options: {
        indexAxis: undefined,
        responsive: true,
        maintainAspectRatio: true,
        scales: {
          x: {
            stacked: true,
            grid: {
              display: false
            },
            title: {
              display: true,
              text: 'Month'
            }
          },
          y: {
            stacked: true,
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            },
            title: {
              display: true,
              text: 'User count'
            }
          }
        },
        plugins: {
          legend: {
            display: true,
            position: 'top',
            labels: {
              usePointStyle: true,
              padding: 20,
              font: { size: 13, weight: 'bold' }
            }
          }
        }
      }
    });
  }

  // Event Progress Pie Chart
  const eventProgressCtx = document.getElementById('eventProgressChart').getContext('2d');
  new Chart(eventProgressCtx, {
    type: 'doughnut',
    data: {
      labels: ['Basic Details Only (33%)', 'Waiting for Confirmations (66%)', 'Completed (100%)'],
      datasets: [{
        data: [<?php echo isset($eventProgressData) ? implode(',', $eventProgressData) : '5,8,12'; ?>],
        backgroundColor: [
          'rgba(245, 158, 11, 0.8)',    // Orange/Amber for 33%
          'rgba(251, 191, 36, 0.8)',    // Yellow for 66%
          'rgba(16, 185, 129, 0.8)'     // Green for 100% (Completed)
        ],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            padding: 20,
            font: { size: 12, weight: '500' }
          }
        }
      }
    }
  });

  // Service Provider Approval Status Pie Chart
  const approvalCtx = document.getElementById('approvalChart').getContext('2d');
  new Chart(approvalCtx, {
    type: 'doughnut',
    data: {
      labels: ['Approved', 'Pending', 'Rejected'],
      datasets: [{
        data: [<?php echo isset($approvalData) ? implode(',', $approvalData) : '15,8,2'; ?>],
        backgroundColor: [
          'rgba(16, 185, 129, 0.8)',    // Green for Approved
          'rgba(245, 158, 11, 0.8)',    // Orange for Pending
          'rgba(239, 68, 68, 0.8)'      // Red for Rejected
        ],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            padding: 20,
            font: { size: 12, weight: '500' }
          }
        }
      }
    }
  });

  // Year dropdown event listeners
  document.addEventListener('DOMContentLoaded', function() {
    const incomeYearDropdown = document.getElementById('incomeYearDropdown');
    const userGrowthYearDropdown = document.getElementById('userGrowthYearDropdown');
    
    // Initialize charts
    createIncomeChart('2026');
    createUserGrowthChart('2026');
    
    // Income chart year change listener
    incomeYearDropdown.addEventListener('change', function(e) {
      const selectedYear = e.target.value;
      createIncomeChart(selectedYear);
    });
    
    // User growth chart year change listener
    userGrowthYearDropdown.addEventListener('change', function(e) {
      const selectedYear = e.target.value;
      createUserGrowthChart(selectedYear);
    });
  });
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>