<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/previousEvents';
require_once APPROOT . '/views/inc/components/taskbar/taskbar_back.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/events/s_oneprevious.css">

<main class="vpe-page" aria-label="View past event">
  <div class="vpe-frame">
    <h1 class="vpe-title">View Past Event</h1>

    <section class="vpe-card">
      <!-- Owner, Title, Venue -->
      <div class="vpe-grid">
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

        <div class="f-label">Event Title/Type</div>
        <div class="f-value"><div class="chip">Birthday Party</div></div>

        <div class="f-label">Event Venue</div>
        <div class="f-value"><div class="chip chip--wide">120/B, Hanthana Road, Kandy.</div></div>
      </div>

      <!-- Time pair -->
      <div class="vpe-pair">
        <div class="f-label">Start time</div>
        <div class="f-value"><div class="chip">3 P.M</div></div>
        <div class="f-label">End time</div>
        <div class="f-value"><div class="chip">11 P.M</div></div>
      </div>

      <!-- Date pair -->
      <div class="vpe-pair">
        <div class="f-label">Start date</div>
        <div class="f-value"><div class="chip">2025/05/05</div></div>
        <div class="f-label">End date</div>
        <div class="f-value"><div class="chip">2025/05/05</div></div>
      </div>

      <!-- Package + Payment -->
      <div class="vpe-grid vpe-grid--compact">
        <div class="f-label">Package Type</div>
        <div class="f-value"><div class="chip">Silver Package</div></div>

        <div class="f-label">Package Price</div>
        <div class="f-value"><div class="chip">RS. 25,000</div></div>

        <div class="f-label">Payment State</div>
        <div class="f-value"><span class="pill pill--paid">Paid</span></div>
      </div>

            <!-- Event images -->
        <div class="vpe-grid vpe-grid--full">
        <div class="f-label">Event Images</div>
        <div class="f-value">
            <div class="gallery">
            <!-- Image 1 -->
            <figure class="gallery__item">
                <img
                src="<?php echo URLROOT; ?>/Public/img/ServiceP/events/3d-birthday-celebration-cartoon-illustration 1.svg"
                alt="Family birthday celebration">
                <!-- Download button (HTML download attribute) -->
                <a
                class="gallery__dl"
                href="/assets/events/4256/img-01.jpg"
                download="event-4256-photo-01.jpg"
                aria-label="Download image 1">
                <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                    <path d="M12 4v10m0 0l4-4m-4 4l-4-4M4 20h16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </a>
            </figure>

            <!-- Image 2 -->
            <figure class="gallery__item">
                <img
                src="<?php echo URLROOT; ?>/Public/img/ServiceP/events/image 13.svg"
                alt="Friends around a birthday cake">
                <a
                class="gallery__dl"
                href="/assets/events/4256/img-02.jpg"
                download="event-4256-photo-02.jpg"
                aria-label="Download image 2">
                <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                    <path d="M12 4v10m0 0l4-4m-4 4l-4-4M4 20h16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </a>
            </figure>
            <!-- Duplicate figure blocks for more images -->
            </div>

            <!-- Optional: download all -->
            <div class="gallery__actions">
            <a class="btn btn--ghost btn--sm" href="/assets/events/4256/event-4256-images.zip" download>Download all (.zip)</a>
            </div>
        </div>
        </div>
      <!-- Notes -->
      <div class="vpe-grid vpe-grid--full">
        <div class="f-label">Special Notes</div>
        <div class="f-value">
          <textarea class="notes" rows="6" readonly placeholder="No special notes"></textarea>
        </div>
      </div>
    </section>
  </div>
</main>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>