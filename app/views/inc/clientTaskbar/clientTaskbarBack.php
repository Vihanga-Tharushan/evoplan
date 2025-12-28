<?php
// Compute a safe back URL.
// 1) Use $backUrl if the page sets it before require
// 2) else use ?return_to
// 3) else HTTP_REFERER
// 4) else fallback to home (change if you like)
$defaultBack = URLROOT . '/';
$rawBack = $backUrl ?? ($_GET['return_to'] ?? ($_SERVER['HTTP_REFERER'] ?? $defaultBack));

// Normalize root-relative paths (e.g., "/Clients/events")
if (is_string($rawBack) && $rawBack !== '' && $rawBack[0] === '/') {
  $rawBack = rtrim(URLROOT, '/') . $rawBack;
}

// Enforce same-origin so nobody can inject external redirects
$baseHost = parse_url(URLROOT, PHP_URL_HOST) ?: ($_SERVER['HTTP_HOST'] ?? '');
if (!filter_var($rawBack, FILTER_VALIDATE_URL) || parse_url($rawBack, PHP_URL_HOST) !== $baseHost) {
  $rawBack = $defaultBack;
}
$finalBackUrl = $rawBack;
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/taskbar.css">

<div class="taskbar">
        <!-- Logo container -->
        <div class="bar-container">
    <a class="bar-frame" href="<?= htmlspecialchars($finalBackUrl, ENT_QUOTES) ?>" aria-label="Go back">
      <div class="bar-icon">
        <img src="<?= URLROOT; ?>/public/img/taskbar/back_Arrow.svg" alt="" class="bar-image" aria-hidden="true">
      </div>
    </a>
        </div>
        
        <!-- EvoPlan Logo -->
        <div class="evo-plan-logo">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlan Logo" class="evo-plan-image">
        </div>

         <div class="chat-icon">
            <div class="chat-circle">
                <button style="background: none; border: none; cursor: pointer; font-size: 1.17em;  font-color: #333;" onclick="location.href='<?php echo URLROOT; ?>/clients/chats';"> Chat </button>
            </div>
        </div>
        
        <!-- Chat icon -->
        <div class="chat-icon">
            <div class="chat-circle">
                <button style="background: none; border: none; cursor: pointer; font-size: 1.17em;  font-color: #333;" onclick="location.href='<?php echo URLROOT; ?>/clients/home';"> Home </button>
            </div>
        </div>
        
        <!-- Notification icon -->
        <div class="notification-icon">
            <button style="background: none; border: none; cursor: pointer; font-size: 1.17em;  font-color: #333;" onclick="location.href='<?php echo URLROOT; ?>/clients/finaleventview';"> MyEvents </button>
        </div>
        
        <!-- Profile picture -->
        <div class="profile-picture">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/profile.svg" alt="Profile Picture" class="profile-image" onclick="location.href='<?php echo URLROOT; ?>/clients/profile';" >
        </div>
</div>