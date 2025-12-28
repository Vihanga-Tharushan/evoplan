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

      <!-- Simple inline SVG area chart (no libraries) -->
      <div class="chart">
        <svg viewBox="0 0 640 300" aria-hidden="true">
          <!-- grid -->
          <g stroke="#eaeaea" stroke-width="1">
            <line x1="60" y1="250" x2="600" y2="250"/>
            <line x1="60" y1="200" x2="600" y2="200"/>
            <line x1="60" y1="150" x2="600" y2="150"/>
            <line x1="60" y1="100" x2="600" y2="100"/>
            <line x1="60" y1="50"  x2="600" y2="50"/>
            <line x1="60" y1="250" x2="60"  y2="40"/>
          </g>

          <!-- gradient fill -->
          <defs>
            <linearGradient id="areaFill" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#7848F4"/>
              <stop offset="100%" stop-color="#fcdda4ff"/>
            </linearGradient>
          </defs>

          <!-- area path -->
          <path d="
            M60,240
            L120,230
            L180,180
            L240,120
            L300,70
            L360,160
            L420,90
            L480,150
            L540,60
            L600,80
            L600,250 L60,250 Z"
            fill="url(#areaFill)" opacity="0.9"></path>

          <!-- x labels -->
          <g font-size="12" fill="#001326ff">
            <text x="80"  y="270">2016</text>
            <text x="140" y="270">2017</text>
            <text x="200" y="270">2018</text>
            <text x="260" y="270">2019</text>
            <text x="320" y="270">2020</text>
            <text x="380" y="270">2021</text>
            <text x="440" y="270">2022</text>
            <text x="500" y="270">2023</text>
            <text x="580" y="270">Year</text>
          </g>

          <!-- y labels -->
          <g font-size="14" fill="#000912ff">
            <text x="20" y="250">0</text>
            <text x="16" y="200">10k</text>
            <text x="16" y="150">20k</text>
            <text x="16" y="100">50k</text>
            <text x="12" y="50">100k</text>
            <text x="12" y="0">Rupees</text>

          </g>
        </svg>
      </div>
    </article>
    <br>
    <br>
    
</section>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>