<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar1.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="../public/css/components/servicesP/s_dashboard.css">

<section class="dash">
  <div class="dash-grid">
  
    <article class="card card--metric span-4">
      <header class="card__head">
        <h2>Next Event</h2>
      </header>
      <div class="metric">
        <div class="metric__value">In 3 days</div>
        <div accesskey="">Welcome <?php echo $_SESSION['service_name']; ?></div>
        <p class="metric__note">Event on 2025/07/21 at 7.00 P.M</p>
        <footer>
        <a href="../Service/oneUpcomingEvent" class="card__link">View details →</a>
      </footer>
      </div>
      
    </article>

    <!-- Lost deals -->
    <article class="card card--metric span-4">
      <header class="card__head">
        <h2>Rejected Events</h2>
      </header>
      <div class="metric">
        <div class="metric__value">4%</div>
        <p class="metric__note">You closed 96 out of 100 deals</p>
      </div>
    </article>
    <!-- Revenues -->
    <article class="card card--metric span-4">
      <header class="card__head">
        <h2>Revenues</h2>
      </header>
      <div class="metric">
        <div class="metric__value">
          15% <span class="trend trend--up" aria-label="up">↗</span>
        </div>
        <p class="metric__note">Increase compared to last week</p>
      </div>
      
    </article>

    <!-- Customers -->
    <article class="card span-7">
      <header class="card__head">
        <h3>Customers</h3>
        <button class="sort-btn" type="button">Sort by Newest ▾</button>
      </header>

      <ul class="list">
        <li class="list__row">
          <img class="avatar" src="https://i.pravatar.cc/40?img=12" alt="">
          <div class="list__meta">
            <div class="list__title">Chris Friedkly</div>
            
          </div>
        </li>

        <li class="list__row is-active" aria-current="true">
          <img class="avatar" src="https://i.pravatar.cc/40?img=5" alt="">
          <div class="list__meta">
            <div class="list__title">Maggie Johnson</div>
            
          </div>

          <div class="row-actions">
            <button class="icon-btn" aria-label="Chat">💬</button>
            <button class="icon-btn" aria-label="Star">⭐</button>
            <button class="icon-btn" aria-label="Edit">✏️</button>
            <button class="icon-btn" aria-label="More">⋯</button>
          </div>
        </li>

        <li class="list__row">
          <img class="avatar" src="https://i.pravatar.cc/40?img=3" alt="">
          <div class="list__meta">
            <div class="list__title">Gael Harry</div>
         
          </div>
        </li>

        <li class="list__row">
          <img class="avatar" src="https://i.pravatar.cc/40?img=8" alt="">
          <div class="list__meta">
            <div class="list__title">Jenna Sullivan</div>
           
          </div>
        </li>
      </ul>

      <footer class="card__foot">
        <a href="#" class="card__link">All customers →</a>
      </footer>
    </article>
    <br>
    
    <!-- Growth -->
    <article class="card span-5">
      <header class="card__head">
        <h2>Income</h2>
      </header>

        <!-- Chart.js donut chart -->
        <div class="chart">
          <canvas id="incomeDonut" width="400" height="300" aria-label="Income donut chart" role="img"></canvas>
        </div>

        <!-- Chart.js CDN and initialization -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
          (function(){
            const ctx = document.getElementById('incomeDonut').getContext('2d');
            const data = {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
              datasets: [{
                label: 'Income',
                //y axis for Rs.in thousands
                label: 'Income (in thousands)',
                data: [45, 25, 20, 10, 30, 50, 40, 60, 70, 80, 90, 100],
                backgroundColor: ['#7848E4', '#f6f282ff','#7848E4', '#f6f282ff','#7848E4', '#f6f282ff','#7848E4', '#f6f282ff','#7848E4', '#f6f282ff','#7848E4', '#f6f282ff'],
                hoverOffset: 8
              }]
            };

            const config = {
              type: 'bar',
              data: data,
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  legend: { position: 'bottom' },
                  tooltip: { enabled: true }
                }
              }
            };

            // create chart
            new Chart(ctx, config);
          })();
        </script>
    </article>
    <br>
    <br>
    
</section>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>