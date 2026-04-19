<?php
// Compute a safe back URL.
// 1) Use $finalBackUrl if already set (for includes like serviceProviderprofile)
// 2) Use $backUrl if the page sets it before require
// 3) else use ?return_to
// 4) else HTTP_REFERER
// 5) else fallback to home (change if you like)
$defaultBack = URLROOT . '/IssueC/events';
$rawBack = $finalBackUrl ?? ($backUrl ?? ($_GET['return_to'] ?? ($_SERVER['HTTP_REFERER'] ?? $defaultBack)));

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

<style>
  :root {
    --primary: #4B006E;
    --secondary: #6F1A8C;
    --lightSecondary: #7a6e83ff;
    --dark: #0b1026;
    --light: #f7f8fc;
    --text: #111827;
    --muted: #6b7280;
    --border: #e5e7eb;
  }

  .nav-taskbar-back {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 50px;
    background: #ffffff;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 0 20px;
    z-index: 800;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }

  .back-button-wrapper {
    display: flex;
    align-items: center;
  }

  .back-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: transparent;
    border: none;
    cursor: pointer;
    color: var(--lightSecondary);
    font-size: 20px;
    transition: all 0.3s ease;
    text-decoration: none;
  }

  .back-button:hover {
    background-color: rgba(75, 0, 110, 0.08);
    color: var(--primary);
    transform: translateY(-2px);
  }

  .back-button:active {
    transform: translateY(0);
  }

  .back-button i {
    font-size: 20px;
  }

  .breadcrumb-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--text);
    margin-left: 10px;
  }

  @media screen and (max-width: 800px) {
    .nav-taskbar-back {
      left: 0;
      padding: 0 15px;
    }

    .nav-taskbar-back.sidebar-closed {
      left: 0;
    }

    .breadcrumb-title {
      display: none;
    }
  }
</style>

<div class="nav-taskbar-back" id="navTaskbarBack">
  <div class="back-button-wrapper">
    <a href="<?= htmlspecialchars($finalBackUrl, ENT_QUOTES) ?>" class="back-button" title="Go Back" aria-label="Go back">
      <i class="fas fa-arrow-left"></i>
    </a>
   
  </div>
</div>

<script>
  // Sync taskbar position with sidebar state
  const sidebar = document.querySelector('.sidebar');
  const navTaskbar = document.getElementById('navTaskbarBack');

  if (sidebar && navTaskbar) {
    const observer = new MutationObserver(() => {
      if (sidebar.classList.contains('close')) {
        navTaskbar.classList.add('sidebar-closed');
      } else {
        navTaskbar.classList.remove('sidebar-closed');
      }
    });

    observer.observe(sidebar, { attributes: true, attributeFilter: ['class'] });
  }
</script>