<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="../public/css/components/servicesP/s_tempDashboard.css">

<section class="dialog">
    <div class="dialog-container">
        <h2 class="dialog-title">Please wait...</h2>
        <p class="dialog-message">One of our admins is reviewing your application right now. We'll notify you as soon as it's approved.</p>
        <p class="dialog-sub-message">Thanks for your patience!</p>
        <div class="clearfix">
            <button class="dialog-button" onclick="window.location.href='<?php echo URLROOT; ?>/Service/dashboard'">OK</button>
        </div>
    </div>

   </section>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>