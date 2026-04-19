<?php
if (!isset($finalBackUrl) || $finalBackUrl === '') {
  $finalBackUrl = URLROOT . '/Clients/home';
}
?>

<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hoverable Sidebar Menu HTML CSS & JavaScript</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
</head>
 
  <style>
    /* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

  :root{
    --primary: #4B006E;     /* Dark purple */
    --secondary: #6F1A8C;   /* Accent violet */
    --lightSecondary: rgb(86, 78, 93); /* Light violet */
    --dark: #0b1026;         /* Background dark */
    --light: #f7f8fc;        /* Light section background */
    --text: #111827;         /* Main text */
    --muted: #6b7280ff;        /* Subtext / secondary text */
    --darkprimary: #15001eff; /* Darker purple */
  }

/* Pre css */
.flex {
  display: flex;
  align-items: center;
}
.nav_image {
  display: flex;
  min-width: 55px;
  justify-content: center;
  margin-top: -10px;
}
.nav_image img {
  height: 40px;
  width: 40px;
  object-fit: cover;
}

/* Navbar */
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  max-width: none;
  background: #fff;
  padding: 10px 20px;
  border-radius: 0 0 8px 8px;
  justify-content: space-between;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  z-index: 900;
  display: flex;
  align-items: center;
}

/* Navbar helpers */
.nav-left { 
  display: flex; 
  align-items: center; 
  gap: 8px; 
}

.nav-right { 
  display: flex; 
  align-items: center; 
  gap: 12px; 
  margin-right: 40px;
}

.navbar .btn-icon{
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 8px 10px;
  border-radius: 8px;
  font-size: 18px;
  color: rgb(86, 78, 93);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 200ms ease;
  position: relative;
  text-decoration: none;
}

.navbar .btn-icon:hover{ 
  background: rgba(75, 0, 110, 0.08);
  color: var(--primary);
  transform: translateY(-2px);
}

.navbar .btn-icon:active{
  transform: translateY(0);
}

.notif-badge{
  position: absolute;
  top: 4px;
  right: 4px;
  background: #ef4444;
  color: #fff;
  font-size: 10px;
  font-weight: 600;
  padding: 2px 5px;
  border-radius: 10px;
  line-height: 1;
  pointer-events: none;
  box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
}

.navbar img {
  height: 40px;
  width: 40px;
  margin-left: 20px;
  cursor: pointer;
}
  </style>

<!-- Navbar -->
    <nav class="navbar flex">
      <div class="nav-left flex">
        <a id="back-btn" class="btn-icon" title="Go Back" href="<?= htmlspecialchars($finalBackUrl, ENT_QUOTES) ?>">
          <i class="fa-solid fa-arrow-left"></i>
        </a>
      </div>

      <div class="nav-right flex">
        
    </nav>

<script>
// Notification button handler
const notifBtn = document.getElementById('notif-btn');
const notifCount = document.getElementById('notif-count');
if (notifBtn) {
  notifBtn.addEventListener('click', () => {
    console.log('Notification button clicked');
    // Optionally, reduce badge opacity if count is not 0
    if (notifCount && notifCount.textContent !== '0') {
      notifCount.style.opacity = '0.5';
    }
    // Redirect to notifications page
    window.location.href = '<?php echo URLROOT; ?>/Client/notifications';
  });
}
</script>

</html>