<!-- Coding by CodingNepal || www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <title>Hoverable Sidebar Menu HTML CSS & JavaScript</title> -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>
  
  <style>
    /* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

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
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
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
  z-index: 1000;
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
/* Navbar */
.navbar {
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
  background: #fff;
  padding: 10px 20px;
  justify-content: space-between;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  z-index: 500;
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
    left: 0;
    width: 100%;
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
              <a href="<?php echo URLROOT; ?>/Admin/Stats" class="link flex">
                <i class="fas fa-chart-bar"></i>
                <span>Analytics</span>
              </a>
            </li>
            <li class="item">
              <a href="<?php echo URLROOT; ?>/Admin/Payments" class="link flex">
                <i class="fas fa-credit-card"></i>
                <span>Payments</span>
              </a>
            </li>
            <li class="item">
              <a href="<?php echo URLROOT; ?>/Admin/Applications" class="link flex">
                <i class="fa-solid fa-book"></i>
                <span>Applications</span>
              </a>
            </li>
            <li class="item">
              <a href="<?php echo URLROOT; ?>/Admin/Complaints" class="link flex">
                <i class="fas fa-exclamation-circle"></i>
                <span>Complaints</span>
              </a>
            </li>
            <li class="item">
              <a href="<?php echo URLROOT; ?>/Admin/Profiles" class="link flex">
                <i class="fa-solid fa-users"></i>
                <span>Profiles</span>
              </a>
            </li>
            <li class="item">
              <a href="<?php echo URLROOT; ?>/Admin/Events" class="link flex">
                <i class="fa-regular fa-calendar-days"></i>
                <span>Events</span>
              </a>
            </li> 
            <li class="item">
              <a href="<?php echo URLROOT; ?>/Admin/Feedbacks" class="link flex">
                <i class="fa-regular fa-comment-dots"></i>
                <span>Feedbacks</span>
              </a>
            </li>
            <li class="item">
              <a href="<?php echo URLROOT; ?>/Admin/Admins" class="link flex">
                <i class="fa-solid fa-user-plus"></i>
                <span>Admins</span>
              </a>
            </li>
            <li class="item">
              <a href="<?php echo URLROOT; ?>/Admin/Features" class="link flex">
                <i class="fa-solid fa-puzzle-piece"></i>
                <span>Features</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar --> <nav class="navbar flex">
      <div class="nav-left flex">
        <button id="back-btn" class="btn-icon" title="Go Back">
          <i class="fa-solid fa-arrow-left"></i>
        </button>
      </div>

      <div class="nav-right flex">
        <div style="position:relative;">
          <button id="notif-btn" class="btn-icon" title="Notifications">
            <i class="fa-solid fa-bell"></i>
          </button>
          <span class="notif-badge" id="notif-count">3</span>
        </div>

        <span class="nav_image">
          <img src="<?php echo URLROOT; ?>/public/img/sidebar/profile.jpg" alt="profile" />
        </span>
      </div>
    </nav>
  </body>
  
  <script>
    // Selecting the sidebar and buttons
const sidebar = document.querySelector(".sidebar");
const links = document.querySelectorAll(".link");

//function to set active link based on PHP variable
links.forEach(link => {
  if(link.href === window.location.href){
    link.classList.add("active");
  }
});


// Function to toggle the lock state of the sidebar
// const toggleLock = () => {
//   const isNowLocked = sidebar.classList.toggle("locked");
//   if (!isNowLocked) {
//     // sidebar unlocked -> enable hover behavior and show open-lock icon
//     sidebar.classList.add("hoverable");
//     sidebarLockBtn.classList.remove('fa-lock');
//     sidebarLockBtn.classList.add('fa-lock-open');
//     sidebarLockBtn.title = 'Lock Sidebar';
//   } else {
//     // sidebar locked -> disable hover behavior and show closed-lock icon
//     sidebar.classList.remove("hoverable");
//     sidebarLockBtn.classList.remove('fa-lock-open');
//     sidebarLockBtn.classList.add('fa-lock');
//     sidebarLockBtn.title = 'Unlock Sidebar';
//   }
// };

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
// Back button handler
const backBtn = document.querySelector('#back-btn');
if (backBtn) {
  backBtn.addEventListener('click', () => {
    window.history.back();
  });
}

// Notification button handler
const notifBtn = document.querySelector('#notif-btn');
const notifCount = document.querySelector('#notif-count');
if (notifBtn) {
  notifBtn.addEventListener('click', () => {
    // Toggle notification panel or navigate to notifications page
    console.log('Notifications clicked');
    // Example: hide badge after click
    if (notifCount && notifCount.textContent !== '0') {
      notifCount.style.opacity = '0.5';
    }
    // Add your notification panel logic here
    // window.location.href = '<?php echo URLROOT; ?>/notifications';
  });
}
  </script>
</html>