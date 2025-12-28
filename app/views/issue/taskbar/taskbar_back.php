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
  <!-- Back -->
  <div class="bar-container">
    <a class="bar-frame" href="<?= htmlspecialchars($finalBackUrl, ENT_QUOTES) ?>" aria-label="Go back">
      <div class="bar-icon">
        <img src="<?= URLROOT; ?>/public/img/taskbar/back_Arrow.svg" alt="" class="bar-image" aria-hidden="true" >
      </div>
    </a>
  </div>

  <!-- Logo (clickable home) -->
  <a class="evo-plan-logo" href="<?= URLROOT; ?>/" aria-label="EvoPlan home">
    <img src="<?= URLROOT; ?>/public/img/taskbar/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlan Logo" class="evo-plan-image" onclick="window.location.href='<?php echo URLROOT; ?>/Evo/evoplan'">
  </a>

  <!-- Chat -->
  <a class="chat-icon" href="<?= URLROOT; ?>/IssueC/chats" aria-label="Messages">
    <div class="chat-circle">
      <img src="<?= URLROOT; ?>/public/img/taskbar/ChatsCircle.svg" alt="" class="chat-image" aria-hidden="true" onclick="window.location.href='<?php echo URLROOT; ?>/IssueC/chats'">
    </div>
  </a>

  <!-- Notifications -->
  <a class="notification-icon" href="<?= URLROOT; ?>/IssueC/notifications" aria-label="Notifications">
    <img src="<?= URLROOT; ?>/public/img/taskbar/notification.svg" alt="" class="notification-image">
  </a>

  <!-- Profile -->
  <a class="profile-picture" href="<?= URLROOT; ?>/Service/accountSettings" aria-label="Profile">
    <img src="<?= URLROOT; ?>/public/img/taskbar/profile.svg" alt="" class="profile-image">
  </a>
</div>