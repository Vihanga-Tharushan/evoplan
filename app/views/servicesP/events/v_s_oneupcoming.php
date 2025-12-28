<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/upcomingEvents';
require_once APPROOT . '/views/inc/components/taskbar/taskbar_back.php';
?>
<link accesskey="" rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/events/s_oneupcoming.css">

<!-- Reject toast (CSS-only via :target) -->
<div id="reject-toast" class="toast-form" role="dialog" aria-modal="true" aria-labelledby="reject-title">
  <!-- Scrim that also closes on click -->
  <a href="#" class="toast-form__scrim" aria-hidden="true"></a>

  <form class="toast-form__panel" action="<?php echo URLROOT; ?>/Clients/reject" method="post">
    <input type="hidden" name="event_id" value="4256">

    <header class="toast-form__header">
      <div class="toast-form__icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="18" height="18">
          <circle cx="12" cy="12" r="10" fill="#ef4444"></circle>
          <path d="M8 8l8 8M16 8l-8 8" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </div>
      <h3 class="toast-form__title" id="reject-title">Reject booking</h3>
      <a href="#" class="toast-form__close" aria-label="Dismiss">×</a>
    </header>

    <label class="toast-form__label" for="reject_reason">Reason for rejection</label>
    <textarea id="reject_reason" name="reason" class="toast-form__textarea" rows="5" placeholder="Briefly explain the reason…" required></textarea>

    <div class="toast-form__actions">
      <a href="#" class="btn btn--ghost">Cancel</a>
      <button type="submit" class="btn btn--danger">Submit rejection</button>
    </div>
  </form>
</div>

<main class="vuc-page" aria-label="View upcoming event">
  <div class="vuc-frame">
    <h1 class="vuc-title">View Up Coming Event</h1>

    <section class="vuc-card">
      <!-- Grid rows -->
      <div class="vuc-grid">
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
        <div class="f-value"><div class="chip">Birthday Party</div></div>

        <!-- Venue -->
        <div class="f-label">Event Venue</div>
        <div class="f-value"><div class="chip chip--wide">120/B, Hanthana Road, Kandy.</div></div>
      </div>

      <!-- Time pair -->
      <div class="vuc-pair">
        <div class="f-label">Start time</div>
        <div class="f-value"><div class="chip">3 P.M</div></div>
        <div class="f-label">End time</div>
        <div class="f-value"><div class="chip">11 P.M</div></div>
      </div>

      <!-- Date pair -->
      <div class="vuc-pair">
        <div class="f-label">Start date</div>
        <div class="f-value"><div class="chip">2025/05/05</div></div>
        <div class="f-label">End date</div>
        <div class="f-value"><div class="chip">2025/05/05</div></div>
      </div>

      <!-- Package info -->
      <div class="vuc-grid vuc-grid--compact">
        <div class="f-label">Package Type</div>
        <div class="f-value"><div class="chip">Silver Package</div></div>

        <div class="f-label">Package Price</div>
        <div class="f-value"><div class="chip">RS. 25,000</div></div>

        <div class="f-label">Customer Note</div>
        <div class="f-value"><div class="chip">Can you Cover the Droneshots also</div></div>

        <div class="f-label">Special Notes</div>
        <div class="f-value"><textarea class="notes" rows="6" placeholder="Add additional notes..."></textarea></div>
      </div>

      <!-- Actions -->
      <div class="vuc-actions">
        <button type="button" class="btn btn--ghost" onclick="location.hash='reject-toast'">Reject</button>
        <!-- CSS-only toast trigger -->
        <a href="<?php echo URLROOT; ?>/Service/sendConfirmation" class="btn btn--primary">Send Confirmation</a>
      </div>
    </section>
  </div>
</main>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>