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



<?php require_once APPROOT . '/views/inc/footer.php'; ?>