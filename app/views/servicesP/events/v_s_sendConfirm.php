<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar_back.php'; ?>
<link accesskey="" rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/events/s_sendConfirm.css">


<!-- Success toast (CSS-only :target) -->
<div id="confirm-toast" class="toast toast--success" role="status" aria-live="polite" aria-atomic="true">
  <span class="toast__icon" aria-hidden="true">
    <svg viewBox="0 0 24 24" width="18" height="18">
      <circle cx="12" cy="12" r="10" fill="#10b981"></circle>
      <path d="M7 12l3 3 7-7" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </span>
  <span class="toast__text">Confirmation sent successfully</span>
  <a class="toast__close" href="#" aria-label="Dismiss">×</a>
</div>


<main class="sb-page" aria-label="Service Booking Confirmation">
  <div class="sb-frame">
    <h1 class="sb-title">Service Booking Confirmation</h1>

    <section class="sb-card">
      <p class="sb-lead">
        Dear Customer,<br><br>
        We are pleased to confirm your booking for [Service Name] on [Event Date] at [Event Location] through Evoplan.
      </p>

      <p class="sb-lead sb-lead--center">Your booking details are as follows:</p>

      <div class="sb-grid">
        <!-- Owner -->
        <div class="f-label">Event Owner</div>
        <div class="f-value">
          <div class="owner">
            <img class="owner__avatar" src="https://i.pravatar.cc/40?img=12" alt="">
            <div>
              <div class="owner__name">Chris Friedkly</div>
              <div class="owner__meta">Supermarket Villanova</div>
            </div>
          </div>
        </div>

        <!-- Title/Type -->
        <div class="f-label">Event Title/Type</div>
        <div class="f-value">
          <div class="chip">Birthday Party</div>
        </div>

        <!-- Venue -->
        <div class="f-label">Event Venue</div>
        <div class="f-value">
          <div class="chip chip--wide">120/B, Hanthana Road, Kandy.</div>
        </div>

        <!-- Time -->
        <div class="f-label">Start time</div>
        <div class="f-value"><div class="chip">3 P.M</div></div>

        <div class="f-label">End time</div>
        <div class="f-value"><div class="chip">11 P.M</div></div>

        <!-- Date -->
        <div class="f-label">Start date</div>
        <div class="f-value"><div class="chip">2025/05/05</div></div>

        <div class="f-label">End date</div>
        <div class="f-value"><div class="chip">2025/05/05</div></div>

        <!-- Package -->
        <div class="f-label">Package Type</div>
        <div class="f-value"><div class="chip">Silver Package</div></div>

        <div class="f-label">Package Price</div>
        <div class="f-value"><div class="chip">RS. 25,000</div></div>

        <!-- Notes -->
        <div class="f-label">Special Notes</div>
        <div class="f-value">
          <textarea class="notes" rows="5" placeholder="Add any special notes to include with this confirmation..."></textarea>
        </div>
      </div>

      <div class="sb-textblock">
        <p>We appreciate your trust in our services and look forward to making your event a success.</p>
        <p>If you have any questions, changes, or additional requests, please contact us directly through the Evoplan messaging system.</p>
      </div>

      <div class="sb-actions">
        <button class="btn btn--primary" onclick="location.hash='confirm-toast'" role="button">Send Confirmation</button>
      </div>
    </section>

    <footer class="sb-footnotes">
      <p>If you have any questions or need to make changes, please contact us at
        <a class="sb-link" href="mailto:support@evoplan">support@evoplan</a>
      </p>
      <p>Thank you for being part of the EvoPlan community!</p>
    </footer>
  </div>
</main>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>