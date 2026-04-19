<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/LandingPage/LandingPage1.css">

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EvoPlan – Plan Events Seamlessly</title>

  <!-- Inter Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- NAV -->
<header class="navbar">
  <div class="logo"><img src="<?php echo URLROOT; ?>/public/img/LandingPage/Logo.svg" alt="EvoPlan Logo" class="navbar-logo"></div>
</header>

<!-- HERO -->
<section class="hero">
  <div class="hero-glass">
    <h1>From Idea to Action<br>Plan Your Event Seamlessly</h1>
    <p>
      A complete platform where event service providers grow their business
      and clients connect with the best professionals effortlessly.
    </p>

    <div class="hero-actions">
      <button class="btn primary" onclick="window.location.href='<?php echo URLROOT ?>/Service/login'">I'm a Service Provider</button>
      <button class="btn primary" onclick="window.location.href='<?php echo URLROOT ?>/Clients/login'">I'm a Client</button>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="section">
  <h2>How It Works</h2>
  <p class="section-sub">
    Connecting event professionals with clients to create unforgettable moments.
  </p>

  <div class="card-grid">
    <div class="card">
      <div class="card-icon-header">
        <div class="card-icon" onclick="rotateIcon(this)">
          <i class="fas fa-briefcase"></i>
        </div>
      </div>
      <h3>For Service Providers</h3>
      <ul>
        <li><i class="fas fa-check"></i> Create professional portfolios</li>
        <li><i class="fas fa-check"></i> Manage bookings & clients</li>
        <li><i class="fas fa-check"></i> Send invoices securely</li>
        <li><i class="fas fa-check"></i> Deliver files safely</li>
      </ul>
    </div>

    <div class="card">
      <div class="card-icon-header">
        <div class="card-icon" onclick="rotateIcon(this)">
          <i class="fas fa-users"></i>
        </div>
      </div>
      <h3>For Clients</h3>
      <ul>
        <li><i class="fas fa-check"></i> Browse trusted providers</li>
        <li><i class="fas fa-check"></i> Compare portfolios</li>
        <li><i class="fas fa-check"></i> Book services instantly</li>
        <li><i class="fas fa-check"></i> Download files securely</li>
      </ul>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="section light">
  <h2>Platform Features</h2>
  <p class="section-sub">Everything you need to manage events professionally.</p>

  <div class="features">
    <div class="feature">
      <div class="feature-icon">
        <i class="fas fa-briefcase"></i>
      </div>
      <div class="feature-content">
        <h3>Portfolio Creation</h3>
      </div>
    </div>
    <div class="feature">
      <div class="feature-icon">
        <i class="fas fa-calendar-check"></i>
      </div>
      <div class="feature-content">
        <h3>Booking Management</h3>
      </div>
    </div>
    <div class="feature">
      <div class="feature-icon">
        <i class="fas fa-calculator"></i>
      </div>
      <div class="feature-content">
        <h3>Live Budget Calculation</h3>
      </div>
    </div>
    <div class="feature">
      <div class="feature-icon">
        <i class="fas fa-star"></i>
      </div>
      <div class="feature-content">
        <h3>Client Experience</h3>
      </div>
    </div>
    <div class="feature">
      <div class="feature-icon">
        <i class="fas fa-file-invoice"></i>
      </div>
      <div class="feature-content">
        <h3>Invoice Management</h3>
      </div>
    </div>
    <div class="feature">
      <div class="feature-icon">
        <i class="fas fa-box"></i>
      </div>
      <div class="feature-content">
        <h3>Full Packages</h3>
      </div>
    </div>
  </div>
</section>

<!-- GALLERY -->
<section class="section">
  <h2>Events We Covered</h2>
  <p class="section-sub">Explore the amazing events and celebrations we've helped create.</p>

  <div class="slideshow-container">
    <div class="slideshow-wrapper">
      <div class="slides-track">
        <div class="slide fade">
          <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&h=600&fit=crop" alt="Wedding Event">
          <div class="slide-caption">Wedding Celebration</div>
        </div>
        <div class="slide fade">
          <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?w=800&h=600&fit=crop" alt="Birthday Party">
          <div class="slide-caption">Birthday Party</div>
        </div>
        <div class="slide fade">
          <img src="https://images.unsplash.com/photo-1540575467063-178f50002cbc?w=800&h=600&fit=crop" alt="Corporate Event">
          <div class="slide-caption">Corporate Gala</div>
        </div>
        <div class="slide fade">
          <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800&h=600&fit=crop" alt="Concert Event">
          <div class="slide-caption">Concert Night</div>
        </div>
        <div class="slide fade">
          <img src="https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=800&h=600&fit=crop" alt="Beach Event">
          <div class="slide-caption">Beach Party</div>
        </div>
        <div class="slide fade">
          <img src="https://images.unsplash.com/photo-1533900298318-6b8da08a523e?w=800&h=600&fit=crop" alt="Graduation Ceremony">
          <div class="slide-caption">Graduation Ceremony</div>
        </div>
      </div>
    </div>

    <!-- Dot Indicators -->
    <div class="dots-container">
      <span class="dot" onclick="currentSlide(0)"></span>
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
      <span class="dot" onclick="currentSlide(4)"></span>
      <span class="dot" onclick="currentSlide(5)"></span>
    </div>
  </div>
</section>

<!-- TESTIMONIALS
<section class="section light">
  <h2>What People Say</h2>

  <div class="testimonials">
    <div class="testimonial">
      “This platform helped grow my photography business massively.”
      <span>— Emily, Photographer</span>
    </div>

    <div class="testimonial">
      “Booking events became stress-free and professional.”
      <span>— Mark, Event Planner</span>
    </div>

    <div class="testimonial">
      “Found the perfect vendors for my wedding in minutes.”
      <span>— Jessica, Client</span>
    </div>
  </div>
</section> -->

<!-- CTA -->
<section class="cta">
  <h2>Ready to Get Started?</h2>
  <p>Join EvoPlan today and create unforgettable events.</p>
  <!-- <div class="cta-buttons">
    <button class="btn_mini primary_mini">Admin Login</button>
    <button class="btn_mini primary_mini">Issue Coordinator Login</button>
  </div> -->
</section>

<!-- <footer1>
  <div class="footer1_details">
  </div>
</footer1>   -->

<footer class="footer">
  <div class="footer-container">

    <!-- Brand -->
    <div class="footer-col1">
      <img class="img" src="../public/img/LandingPage/Logo.svg" >
      <p class="footer-desc">
        A complete platform where event service providers grow their business
        and clients easily connect with the best professionals to bring their
        events to life.
      </p>
    </div>

    <!-- Quick Links -->
    <div class="footer-col">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">How It Works</a></li>
        <li><a href="#">Features</a></li>
        <li><a href="#">Events</a></li>
      </ul>
    </div>

    <!-- Platform -->
    <div class="footer-col">
      <h4>Platform</h4>
      <ul>
        <li><a href="#">For Service Providers</a></li>
        <li><a href="#">For Clients</a></li>
        <li><a href="#">Pricing</a></li>
        <li><a href="#">FAQs</a></li>
      </ul>
    </div>

    <!-- Contact -->
    <div class="footer-col">
      <h4>Contact</h4>
      <ul class="footer-contact">
        <li>Email: support@evoplan.com</li>
        <li>Phone: +94 77 123 4567</li>
        <li>Location: Sri Lanka</li>
        <li><div class="social_icons">
            <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div></li>
      </ul>
    </div>
  </div>

  <div class="cta-buttons">
    <button class="btn_mini primary_mini" onclick="window.location.href='<?php echo URLROOT ?>/Admin/admin_login'">Admin Login</button>
    <button class="btn_mini primary_mini" onclick="window.location.href='<?php echo URLROOT ?>/Admin/coordinator_login'">Issue Coordinator Login</button>
  </div>

  <div class="footer-bottom">
    © 2026 EvoPlan. All rights reserved.
  </div>
</footer>

<script src="<?php echo URLROOT; ?>/public/css/components/LandingPage/LandingPage1.js"></script>
</body>
</html>




<?php require_once APPROOT . '/views/inc/footer.php'; ?>