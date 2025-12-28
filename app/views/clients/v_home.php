<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbar.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar1.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/home.css">

<!-- Main Content Area (compatible with existing sidebar and taskbar) -->
<main class="main-content">
    <!-- Hero Section -->
    <section class="hero">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        
        <div class="hero-content">
            <h1>From Idea to Action<br>Plan Your Event Seamlessly</h1>
            <p>Create unforgettable events with our all-in-one platform that connects you with top service providers and simplifies every step of the planning process.</p>
            <button class="cta-button">Get Started</button>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="section-header">
            <h2>Everything You Need to Plan Perfect Events</h2>
            <p>Our platform provides all the tools you need to create, manage, and execute your events with confidence</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <div class="feature-content">
                    <h3>Create & Manage Events</h3>
                    <p>Set up your event details, timeline, and requirements in minutes with our intuitive event builder.</p>
                    <span class="feature-tag">Event Creation</span>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📦</div>
                <div class="feature-content">
                    <h3>Book Service Packages</h3>
                    <p>Choose from curated packages across all service categories and customize them to your needs.</p>
                    <span class="feature-tag">Package Booking</span>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🔍</div>
                <div class="feature-content">
                    <h3>View Provider Portfolios</h3>
                    <p>Review previous work, ratings, and client feedback before booking any service provider.</p>
                    <span class="feature-tag">Portfolio Review</span>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">💬</div>
                <div class="feature-content">
                    <h3>Direct Messaging</h3>
                    <p>Communicate seamlessly with service providers through our built-in messaging system.</p>
                    <span class="feature-tag">Real-time Chat</span>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🚨</div>
                <div class="feature-content">
                    <h3>Issue Resolution</h3>
                    <p>Connect with our dedicated issue coordinators for any challenges during your event planning.</p>
                    <span class="feature-tag">24/7 Support</span>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">⭐</div>
                <div class="feature-content">
                    <h3>Feedback System</h3>
                    <p>Rate and review service providers after your event to help others make informed decisions.</p>
                    <span class="feature-tag">Community Reviews</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Providers Section -->
    <section class="providers-section">
        <div class="section-header">
            <h2>Service Providers Available</h2>
            <p>Access a curated network of professional service providers across all event categories</p>
        </div>
        
        <div class="providers-grid">
            <div class="provider-card">
                <div class="provider-icon">🕌</div>
                <h3>Venues and Halls</h3>
                <p>Find the perfect location for your event with our extensive venue database.</p>
            </div>
            
            <div class="provider-card">
                <div class="provider-icon">📸</div>
                <h3>Photographers and Videographers</h3>
                <p>Capture every moment with skilled visual storytellers for your special day.</p>
            </div>
            
            <div class="provider-card">
                <div class="provider-icon">🎵</div>
                <h3>Music and DJ Services</h3>
                <p>Set the perfect atmosphere with professional music and entertainment.</p>
            </div>
            
            <div class="provider-card">
                <div class="provider-icon">🌸</div>
                <h3>Florists and Cake Designers</h3>
                <p>Beautiful floral arrangements and custom cakes to delight your guests.</p>
            </div>
            
            <div class="provider-card">
                <div class="provider-icon">🎨</div>
                <h3>Decorators and Event Stylists</h3>
                <p>Create stunning visual experiences with professional event design services.</p>
            </div>
            
            <div class="provider-card">
                <div class="provider-icon">🪑</div>
                <h3>Event Equipment and Rentals</h3>
                <p>Access all necessary equipment and furnishings for your event needs.</p>
            </div>
            
            <div class="provider-card">
                <div class="provider-icon">🎤</div>
                <h3>Hosts, MCs and Entertainers</h3>
                <p>Engaging hosts and performers to keep your event lively and memorable.</p>
            </div>
            
            <div class="provider-card">
                <div class="provider-icon">🚚</div>
                <h3>Transport and Logistics Services</h3>
                <p>Seamless transportation and logistics solutions for your event.</p>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="process-section">
        <div class="section-header">
            <h2>How EvoPlan Works</h2>
            <p>Simple steps to plan your perfect event</p>
        </div>
        
        <div class="process-steps">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Create Your Event</h3>
                <p>Set up your event details, date, location, and requirements in our intuitive event builder.</p>
            </div>
            
            <div class="step">
                <div class="step-number">2</div>
                <h3>Browse & Book Packages</h3>
                <p>Explore service providers, view portfolios, and book packages that fit your needs and budget.</p>
            </div>
            
            <div class="step">
                <div class="step-number">3</div>
                <h3>Confirm & Communicate</h3>
                <p>Service providers confirm bookings, and you can message them directly for any adjustments.</p>
            </div>
            
            <div class="step">
                <div class="step-number">4</div>
                <h3>Issue Resolution</h3>
                <p>Our issue coordinators are available to resolve any challenges that may arise during planning.</p>
            </div>
            
            <div class="step">
                <div class="step-number">5</div>
                <h3>Leave Feedback</h3>
                <p>After your event, rate providers to help build our community of trusted professionals.</p>
            </div>
        </div>
    </section>

    
    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container">
            <h2>Ready to Plan Your Next Event?</h2>
            <p>Join thousands of event planners who trust EvoPlan for seamless event management.</p>
            <button class="cta-button">Start Planning Today</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>EvoPlan</h3>
                <p>The all-in-one platform for event planning and management, connecting you with the best service providers.</p>
            </div>
            
            <div class="footer-column">
                <h3>Features</h3>
                <ul>
                    <li><a href="#">Event Creation</a></li>
                    <li><a href="#">Service Booking</a></li>
                    <li><a href="#">Portfolio Review</a></li>
                    <li><a href="#">Direct Messaging</a></li>
                    <li><a href="#">Issue Resolution</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Service Categories</h3>
                <ul>
                    <li><a href="#">Venues and Halls</a></li>
                    <li><a href="#">Photographers</a></li>
                    <li><a href="#">Music and DJ Services</a></li>
                    <li><a href="#">Florists and Cake Designers</a></li>
                    <li><a href="#">Event Equipment</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Issue Resolution</a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; 2025 EvoPlan. All rights reserved.</p>
        </div>
    </footer>
</main>

    <script>
        // Simple animation for feature cards on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const featureCards = document.querySelectorAll('.feature-card, .provider-card, .step');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });
            
            featureCards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
            
            // CTA button animation
            const ctaButtons = document.querySelectorAll('.cta-button');
            ctaButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 1px 2px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.06)';
                });
            });
        });
    </script>
</body>
</html>
<?php require APPROOT . '/views/inc/footer.php';?>
