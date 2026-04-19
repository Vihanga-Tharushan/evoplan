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
        <div class="stat-value">$45,230</div>
        <div class="stat-change positive">↑ 12.5% from last month</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon users-icon">
        <i class="fas fa-users"></i>
      </div>
      <div class="stat-content">
        <div class="stat-label">Total Users</div>
        <div class="stat-value">1,240</div>
        <div class="stat-change positive">↑ 8.2% from last month</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon events-icon">
        <i class="fas fa-calendar-check"></i>
      </div>
      <div class="stat-content">
        <div class="stat-label">Active Events</div>
        <div class="stat-value">156</div>
        <div class="stat-change positive">↑ 5.1% from last month</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon services-icon">
        <i class="fas fa-handshake"></i>
      </div>
      <div class="stat-content">
        <div class="stat-label">Service Providers</div>
        <div class="stat-value">84</div>
        <div class="stat-change positive">↑ 3.7% from last month</div>
      </div>
    </div>
  </div>

  <!-- Charts Row 1 -->
  <div class="charts-grid">
    <div class="chart-card">
      <div class="chart-header">
        <h2>Income Overview (12 Months)</h2>
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
        <h2>Clients by Age Groups</h2>
      </div>
      <div class="chart-wrapper pie-wrapper">
        <canvas id="ageChart"></canvas>
      </div>
    </div>

    <div class="chart-card">
      <div class="chart-header">
        <h2>Clients by Gender</h2>
      </div>
      <div class="chart-wrapper pie-wrapper">
        <canvas id="genderChart"></canvas>
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
    
    const incomeDataByYear = {
      '2026': [3200, 3800, 3500, 4200, 4800, 5200, 4900, 5400, 5800, 6200, 6800, 7200],
      '2025': [2800, 3200, 3100, 3800, 4200, 4600, 4300, 4900, 5200, 5600, 6100, 6500],
      '2024': [2400, 2800, 2700, 3300, 3700, 4100, 3800, 4400, 4700, 5100, 5500, 5800],
      '2023': [2000, 2400, 2300, 2900, 3200, 3600, 3300, 3900, 4200, 4600, 5000, 5400],
      '2022': [1600, 2000, 1900, 2500, 2800, 3200, 2900, 3500, 3800, 4200, 4600, 5000]
    };

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
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        }
      }
    });
  }

  // User Growth Chart function
  function createUserGrowthChart(year = '2026') {
    const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
    
    const userDataByYear = {
      '2026': [65, 78, 90, 85, 95, 110, 105, 120, 135, 145, 155, 165],
      '2025': [55, 68, 78, 75, 82, 95, 92, 105, 118, 128, 138, 150],
      '2024': [45, 58, 68, 65, 72, 85, 82, 95, 108, 118, 128, 140],
      '2023': [35, 48, 58, 55, 62, 75, 72, 85, 98, 108, 118, 130],
      '2022': [25, 38, 48, 45, 52, 65, 62, 75, 88, 98, 108, 120]
    };

    if (userGrowthChart) {
      userGrowthChart.destroy();
    }
    
    userGrowthChart = new Chart(userGrowthCtx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          label: 'New Users',
          data: userDataByYear[year],
          backgroundColor: 'rgba(75, 0, 110, 0.8)',
          borderColor: 'rgba(75, 0, 110, 1)',
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
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        }
      }
    });
  }

  // Age Distribution Pie Chart
  const ageCtx = document.getElementById('ageChart').getContext('2d');
  new Chart(ageCtx, {
    type: 'doughnut',
    data: {
      labels: ['18-25', '26-35', '36-50', '50+'],
      datasets: [{
        data: [32, 38, 22, 8],
        backgroundColor: [
          'rgba(16, 185, 129, 0.8)',
          'rgba(59, 130, 246, 0.8)',
          'rgba(245, 158, 11, 0.8)',
          'rgba(156, 163, 175, 0.8)'
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

  // Gender Distribution Pie Chart
  const genderCtx = document.getElementById('genderChart').getContext('2d');
  new Chart(genderCtx, {
    type: 'doughnut',
    data: {
      labels: ['Female', 'Male', 'Others'],
      datasets: [{
        data: [57, 40, 3],
        backgroundColor: [
          'rgba(239, 68, 68, 0.8)',
          'rgba(16, 185, 129, 0.8)',
          'rgba(156, 163, 175, 0.8)'
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