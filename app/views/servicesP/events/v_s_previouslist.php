<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/events';
require_once APPROOT . '/views/inc/components/taskbar/taskbar_back.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/events/s_previouslist.css">
<main class="pe-page" aria-label="Previous events">
  <section class="pe-wrap">
    <h1 class="pe-title">Previous Events</h1>

    <div class="pe-card">
      <!-- Header -->
      <div class="pe-head" role="row">
        <div class="col col--customer" role="columnheader">Customer</div>
        <div class="col" role="columnheader">Event Type</div>
        <div class="col" role="columnheader">Date</div>
        <div class="col" role="columnheader">Time</div>
        <div class="col" role="columnheader">Venue</div>
        <div class="col" role="columnheader">Payment</div>
      </div>

      <!-- Rows -->
      <ul class="pe-list">
        <li class="item" role="row">
          <a class="pe-row" href="<?php echo URLROOT; ?>/Service/onePreviousEvent" aria-label="Open event Chris Friedkly">
            <div class="cell cell--customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=12" alt="">
              <div>
                <div class="name">Chris Friedkly</div>
                <div class="meta">Supermarket Villanova</div>
              </div>
            </div>
            <div class="cell">Birthday Party</div>
            <div class="cell">2025/07/21</div>
            <div class="cell">7.00 P.M</div>
            <div class="cell">Home</div>
            <div class="cell"><span class="pill pill--done">Done</span></div>
          </a>
        </li>

        <li class="item" role="row">
          <a class="pe-row" href="#event-2" aria-label="Open event Gael Harry">
            <div class="cell cell--customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=5" alt="">
              <div>
                <div class="name">Gael Harry</div>
                <div class="meta">New York Finest Fruits</div>
              </div>
            </div>
            <div class="cell">Get-together</div>
            <div class="cell">2025/07/23</div>
            <div class="cell">3.00 P.M</div>
            <div class="cell">Hilton Hotel</div>
            <div class="cell"><span class="pill pill--done">Done</span></div>
          </a>
        </li>

        <li class="item" role="row">
          <a class="pe-row" href="#event-3" aria-label="Open event Jenna Sullivan">
            <div class="cell cell--customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=8" alt="">
              <div>
                <div class="name">Jenna Sullivan</div>
                <div class="meta">Walmart</div>
              </div>
            </div>
            <div class="cell">Wedding Pre-shoot</div>
            <div class="cell">2025/07/24</div>
            <div class="cell">9.00 A.M</div>
            <div class="cell">Kandy</div>
            <div class="cell"><span class="pill pill--done">Done</span></div>
          </a>
        </li>

        <!-- Rows -->
      <ul class="pe-list">
        <li class="item" role="row">
          <a class="pe-row" href="#event-1" aria-label="Open event Chris Friedkly">
            <div class="cell cell--customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=12" alt="">
              <div>
                <div class="name">Chris Friedkly</div>
                <div class="meta">Supermarket Villanova</div>
              </div>
            </div>
            <div class="cell">Birthday Party</div>
            <div class="cell">2025/08/21</div>
            <div class="cell">7.00 P.M</div>
            <div class="cell">Home</div>
            <div class="cell"><span class="pill pill--done">Done</span></div>
          </a>
        </li>
        
      </ul>
    </div>
  </section>
</main>










<?php require_once APPROOT . '/views/inc/footer.php'; ?>