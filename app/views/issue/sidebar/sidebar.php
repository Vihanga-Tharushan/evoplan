<!-- Coding by CodingNepal || www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>
  <style>
   
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

/* Scope resets and font to the sidebar only (avoid affecting entire page) */
.sidebar, .sidebar * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.sidebar {
  font-family: "Poppins", sans-serif;
}

  :root{
    --primary: #4B006E;     /* Dark purple */
    --secondary: #6F1A8C;   /* Accent violet */
    --lightSecondary: #7a6e83ff; /* Light violet */
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

.logo_name img {
  height: 60px;
  width: auto;
  object-fit: cover;
  margin-top: 9px;
}
/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 270px;
  background: #fff;
  padding: 15px 10px;
  box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
  transition: all 0.4s ease;
}
.sidebar.close {
  width: calc(55px + 20px);
}
.logo_items {
  gap: 8px;
}
.logo_name {
  font-size: 22px;
  color: #333;
  font-weight: 500px;
  transition: all 0.3s ease;
}
.sidebar.close .logo_name,
.sidebar.close #lock-icon,
.sidebar.close #sidebar-close {
  opacity: 0;
  pointer-events: none;
}
#lock-icon,
#sidebar-close {
  padding: 10px;
  color:var(--lightSecondary);
  font-size: 20px;
  cursor: pointer;
  margin-left: -1px;
  transition: all 0.3s ease;
}
#sidebar-close {
  display: none;
  color: #333;
}
.menu_container {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-top: 20px;
  overflow-y: auto;
  height: calc(100% - 82px);
}
.menu_container::-webkit-scrollbar {
  display: none;
}
.menu_title {
  position: relative;
  height: 50px;
  width: 55px;
}
.menu_title .title {
  margin-left: 15px;
  transition: all 0.3s ease;
}
.sidebar.close .title {
  opacity: 0;
}
.menu_title .line {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  height: 3px;
  width: 20px;
  border-radius: 25px;
  background: #aaa;
  transition: all 0.3s ease;
}
.menu_title .line {
  opacity: 0;
}
.sidebar.close .line {
  opacity: 1;
}
.item {
  list-style: none;
}

.link {
  text-decoration: none;
  border-radius: 8px;
  margin-bottom: 8px;
  color: var(--lightSecondary);
  display: flex;
  align-items: center;
  /* smooth transitions for hover and active states */
  transition: background-color 200ms ease, color 200ms ease, transform 180ms ease;
  will-change: background-color, color, transform;
}
.link:hover {
  color: #fff;
  background-color: var(--primary);
  transform: translateY(-2px);
}
.link span {
  white-space: nowrap;
}
.link i {
  height: 50px;
  min-width: 55px;
  display: flex;
  font-size: 22px;
  align-items: center;
  justify-content: center;
  border-radius: 4px;
  transition: color 200ms ease, transform 180ms ease;
}

.link.active,
.link.active:hover {
  background-color: var(--primary);
  color: #fff;
}

.link.active i,
.link.active span {
  color: #fff;
}
.sidebar_profile {
  padding-top: 15px;
  margin-top: 15px;
  gap: 15px;
  border-top: 2px solid rgba(0, 0, 0, 0.1);
}
.sidebar_profile .name {
  font-size: 18px;
  color: #333;
}
.sidebar_profile .email {
  font-size: 15px;
  color: #333;
}
/* Navbar: make full-page width minus the sidebar, and adapt when sidebar collapses */
.navbar {
  position: fixed;
  top: 0;
  left: 270px; /* sidebar full width */
  width: calc(100% - 270px);
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

/* When the sidebar is collapsed, shrink the navbar accordingly */
.sidebar.close + .navbar {
  left: calc(55px + 20px); /* match .sidebar.close width */
  width: calc(100% - (55px + 20px));
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
   margin-right: 50px;
}

.navbar .btn-icon{
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 8px 10px;
  border-radius: 8px;
  font-size: 18px;
  color: var(--lightSecondary);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 200ms ease;
  position: relative;
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
#sidebar-open {
  font-size: 30px;
  color: #333;
  cursor: pointer;
  margin-right: 20px;
  display: none;
}
.search_box {
  height: 46px;
  max-width: 500px;
  width: 100%;
  border: 1px solid #aaa;
  outline: none;
  border-radius: 8px;
  padding: 0 15px;
  font-size: 18px;
  color: #333;
}
.navbar img {
  height: 40px;
  width: 40px;
  margin-left: 20px;
}
/* Responsive */
@media screen and (max-width: 1100px) {
  .navbar {
    left: 65%;
  }
}
@media screen and (max-width: 800px) {
  .sidebar {
    left: 0;
    z-index: 1000;
  }
  .sidebar.close {
    left: -100%;
  }
  #sidebar-close {
    display: block;
  }
  #lock-icon {
    display: none;
  }
  .navbar {
    left: 0;
    max-width: 100%;
    transform: translateX(0%);
    padding: 8px 12px;

  }
  #sidebar-open {
    display: block;
  }
  #back-btn {
    display: none;
  }
  .nav-right .nav_image img {
    height: 32px;
    width: 32px;
  }
}
  </style>
  <body>
    
    <nav class="sidebar locked">
      <div class="logo_items flex">
        <span class="nav_image">
          <img src="<?php echo URLROOT; ?>/public/img/sidebar/EvoplanCircle.png" alt="logo_img" />
        </span>
        <div class="logo_name">
        <img src="<?php echo URLROOT; ?>/public/img/sidebar/Evoplan_name.png" alt="logo_img" />
        </div>
       
        <!-- <i class="fa-solid fa-xmark" id="sidebar-close" title="Close Sidebar"></i>
        <i class="fa-solid fa-lock" id="lock-icon" title="Unlock Sidebar"></i> -->
      </div>
      <div class="menu_container">
        <div class="menu_items">
          <ul class="menu_item">
            <li class="item">
              <a href="<?php echo URLROOT; ?>/IssueC/dashboard" class="link flex">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
              </a>
            </li>
           
         
            <li class="item">
              <a href="<?php echo URLROOT; ?>/IssueC/complaints" class="link flex">
                <i class="fas fa-exclamation-circle"></i>
                <span>Complaints</span>
              </a>
            </li>
          
             <li class="item">
              <a href="<?php echo URLROOT; ?>/IssueC/replacement" class="link flex">
                <i class="fa-solid fa-recycle"></i>
                <span>Replacement</span>
              </a>
            </li>
            
            <li class="item">
              <a href="<?php echo URLROOT; ?>/IssueC/events" class="link flex">
                <i class="fa-solid fa-cake-candles"></i>
                <span>Events</span>
              </a>
            </li>

            <li class="item">
              <a href="<?php echo URLROOT; ?>/IssueC/payments" class="link flex">
                <i class="fas fa-credit-card"></i>
                <span>Refund</span>
              </a>
            </li>

            <li class="item">
              <a href="<?php echo URLROOT; ?>/IssueC/messages" class="link flex">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
              </a>
            </li>
            

            <li class="item">
              <a href="<?php echo URLROOT; ?>/IssueC/reports" class="link flex">
                <i class="fa-solid fa-address-book"></i>
                <span>Reports</span>
              </a>
            </li>

            <li class="item">
              <a href="<?php echo URLROOT; ?>/IssueC/myaccount" class="link flex">
                <i class="fa-solid fa-user-cog"></i>
                <span>My Account
                </span>
              </a>
            </li>

          </ul>
        </div>
        <!-- <div class="sidebar_profile flex">
          <span class="nav_image">
            <img src="images/profile.jpg" alt="logo_img" />
          </span>
          <div class="data_text">
            <span class="name">David Oliva</span>
            <span class="email">david@gmail.com</span>
          </div>
        </div> -->
      </div>
    </nav>
    <!-- Navbar -->
    <nav class="navbar flex">
      <div class="nav-left flex">
        <button id="sidebar-open" class="btn-icon" title="Open Sidebar" style="display: none;">
          <i class="fa-solid fa-bars"></i>
        </button>
        <!-- <button id="back-btn" class="btn-icon" title="Go Back">
          <i class="fa-solid fa-arrow-left"></i>
        </button> -->
      </div>

      <div class="nav-right flex">
        <div style="position:relative;">
          <button id="notif-btn" class="btn-icon" title="Notifications">
            <i class="fa-solid fa-bell"></i>
          </button>
          <span class="notif-badge" id="notif-count">0</span>
        </div>

        
      </div>
    </nav>
  </body>
  
  <script>
    // Selecting the sidebar and buttons
const sidebar = document.querySelector(".sidebar");
const sidebarOpenBtn = document.querySelector("#sidebar-open");
const sidebarCloseBtn = document.querySelector("#sidebar-close");
const sidebarLockBtn = document.querySelector("#lock-icon");
const links = document.querySelectorAll(".link");

//function to set active link based on PHP variable
links.forEach(link => {
  if(link.href === window.location.href){
    link.classList.add("active");
  }
});

// Fetch unread notification count on page load
function fetchUnreadNotificationCount() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function() {
    if(this.status === 200) {
      try {
        const response = JSON.parse(this.responseText);
        if(response.success) {
          const notifCount = document.getElementById('notif-count');
          if(notifCount) {
            notifCount.textContent = response.unreadCount;
            // Hide badge if count is 0
            if(response.unreadCount === 0) {
              notifCount.style.display = 'none';
            } else {
              notifCount.style.display = 'block';
            }
          }
        }
      } catch(e) {
        console.error('Error parsing notification response:', e);
      }
    }
  };
  xhr.onerror = function() {
    console.error('Error fetching unread notification count');
  };
  
  xhr.open('POST', '<?php echo URLROOT; ?>/IssueC/getUnreadNotificationCount', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send();
}

// Load notification count when page loads
document.addEventListener('DOMContentLoaded', function() {
  fetchUnreadNotificationCount();
});

// Function to toggle the lock state of the sidebar
const toggleLock = () => {
  const isNowLocked = sidebar.classList.toggle("locked");
  if (!isNowLocked) {
    // sidebar unlocked -> enable hover behavior and show open-lock icon
    sidebar.classList.add("hoverable");
    sidebarLockBtn.classList.remove('fa-lock');
    sidebarLockBtn.classList.add('fa-lock-open');
    sidebarLockBtn.title = 'Lock Sidebar';
  } else {
    // sidebar locked -> disable hover behavior and show closed-lock icon
    sidebar.classList.remove("hoverable");
    sidebarLockBtn.classList.remove('fa-lock-open');
    sidebarLockBtn.classList.add('fa-lock');
    sidebarLockBtn.title = 'Unlock Sidebar';
  }
};
// Function to hide the sidebar when the mouse leaves
const hideSidebar = () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.add("close");
  }
};
// Function to show the sidebar when the mouse enter
const showSidebar = () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
  }
};
// Function to show and hide the sidebar
const toggleSidebar = () => {
  sidebar.classList.toggle("close");
};
// If the window width is less than 800px, close the sidebar and remove hoverability and lock
if (window.innerWidth < 800) {
  sidebar.classList.add("close");
  sidebar.classList.remove("locked");
  sidebar.classList.remove("hoverable");
}
// Adding event listeners to buttons and sidebar for the corresponding actions

sidebar.addEventListener("mouseleave", hideSidebar);
sidebar.addEventListener("mouseenter", showSidebar);
sidebarOpenBtn.addEventListener("click", toggleSidebar);



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
    window.location.href = '<?php echo URLROOT; ?>/IssueC/notifications';
  });
}
  </script>
</html>