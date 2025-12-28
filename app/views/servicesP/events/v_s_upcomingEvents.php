<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/events';
require_once APPROOT . '/views/inc/components/taskbar/taskbar_back.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/events/s_upcomingEvents.css">

<main class="events-page">
  <section class="events-wrap">
    <h1 class="events-title">Up Coming Events</h1>

    <div class="events-card">
      <!-- Header row -->
      <div class="events-head">
        <div>Customer</div>
        <div>Event Type</div>
        <div>Date</div>
        <div>Start time</div>
        <div>End time</div>
        <div>Venue</div>
        <div>Confirmation</div>
      </div>

      <!-- Row 1 -->
      <a class="events-row" href="<?php echo URLROOT; ?>/Service/oneUpcomingEvent">
        <div class="cell cell--customer">
          <img class="avatar" src="https://i.pravatar.cc/40?img=12" alt="">
          <div>
            <div class="name">Chris Friedkly</div>
            <div class="org">Supermarket Villanova</div>
          </div>
        </div>
        <div class="cell">Birthday Party</div>
        <div class="cell">2025/08/21</div>
        <div class="cell">7.00 P.M</div>
        <div class="cell">11.00 P.M</div>
        <div class="cell">No.123,Main Street,Kandy..</div>
        <div class="cell">
          <span class="pill pill--ok">Send</span>
        </div>
      </a>

      <!-- Row 2 -->
      <a class="events-row" href="<?php echo URLROOT; ?>/Clients/event/4257">
        <div class="cell cell--customer">
          <img class="avatar" src="https://i.pravatar.cc/40?img=5" alt="">
          <div>
            <div class="name">Gael Harry</div>
            <div class="org">New York Finest Fruits</div>
          </div>
        </div>
        <div class="cell">Get-together</div>
        <div class="cell">2025/08/23</div>
        <div class="cell">3.00 P.M</div>
        <div class="cell">6.00 P.M</div>
        <div class="cell">Hilton Hotel</div>
        <div class="cell">
          <span class="pill pill--warn">Not Yet</span>
        </div>
      </a>

      <!-- Row 3 -->
      <a class="events-row" href="<?php echo URLROOT; ?>/Clients/event/4258">
        <div class="cell cell--customer">
          <img class="avatar" src="https://i.pravatar.cc/40?img=8" alt="">
          <div>
            <div class="name">Jenna Sullivan</div>
            <div class="org">Walmart</div>
          </div>
        </div>
        <div class="cell">Wedding Pre-shoot</div>
        <div class="cell">2025/08/24</div>
        <div class="cell">9.00 A.M</div>
        <div class="cell">11.30 A.M</div>
        <div class="cell">Kandy City Center</div>
        <div class="cell">
          <span class="pill pill--ok">Send</span>
        </div>
      </a>

      <!-- Row 4 -->
      <a class="events-row" href="<?php echo URLROOT; ?>/Clients/event/4259">
        <div class="cell cell--customer">
          <img class="avatar" src="https://i.pravatar.cc/40?img=13" alt="">
          <div>
            <div class="name">Chris Friedkly</div>
            <div class="org">Supermarket Villanova</div>
          </div>
        </div>
        <div class="cell">Birthday Party</div>
        <div class="cell">2025/08/25</div>
        <div class="cell">7.00 P.M</div>
        <div class="cell">11.00 P.M</div>
        <div class="cell">No.123,Main Street,Galle..</div>
        <div class="cell">
          <span class="pill pill--ok">Send</span>
        </div>
      </a>

      <!-- Row 5 -->
      <a class="events-row" href="<?php echo URLROOT; ?>/Clients/event/4260">
        <div class="cell cell--customer">
          <img class="avatar" src="https://i.pravatar.cc/40?img=3" alt="">
          <div>
            <div class="name">Gael Harry</div>
            <div class="org">New York Finest Fruits</div>
          </div>
        </div>
        <div class="cell">Get-together</div>
        <div class="cell">2025/08/29</div>
        <div class="cell">3.00 P.M</div>
        <div class="cell">6.00 P.M</div>
        <div class="cell">Hilton Hotel</div>
        <div class="cell">
          <span class="pill pill--warn">Not Yet</span>
        </div>
      </a>

      <!-- Row 6 -->
      <a class="events-row" href="<?php echo URLROOT; ?>/Clients/event/4261">
        <div class="cell cell--customer">
          <img class="avatar" src="https://i.pravatar.cc/40?img=9" alt="">
          <div>
            <div class="name">Jenna Sullivan</div>
            <div class="org">Walmart</div>
          </div>
        </div>
        <div class="cell">Wedding Pre-shoot</div>
        <div class="cell">2025/08/30</div>
        <div class="cell">9.00 A.M</div>
        <div class="cell">11.30 A.M</div>
        <div class="cell">Kandy</div>
        <div class="cell">
          <span class="pill pill--ok">Send</span>
        </div>
      </a>
    </div>
  </section>
</main>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>