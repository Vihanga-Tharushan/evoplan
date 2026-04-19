<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>

<style>
        :root {
            --primary: #4B006E;
            --secondary: #6F1A8C;
            --dark: #0b1026;
            --light: #f7f8fc;
            --text: #111827;
            --muted: #6b7280;
            --sidebar-width: 270px;   /* left sidebar (match sidebar.php width) */
            --taskbar-height: 64px;
            --header-h: 64px; /* fixed header height */
            --hero-extra: 124px; /* extra height to extend hero downward */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden;
            background: var(--light);
        }

        /* Hero Section */
        .hero {
            position: relative;
            /* sit under fixed header */
            margin-top: calc(-1 * var(--header-h));
            padding-top: var(--header-h);
            /* fill viewport and extend further down to cover extra space */
            min-height: calc(100vh - var(--taskbar-height) + var(--hero-extra));
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            /* make background taller so bottom edge reaches further down */
            height: calc(100% + var(--hero-extra));
            object-fit: cover;
            object-position: center top;
            z-index: 1;
            filter: brightness(0.7);
            animation: slideShow 15s infinite;
        }

        @keyframes slideShow {
            0%, 33% {
                opacity: 1;
            }
            35%, 98% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .hero-bg:nth-child(2) {
            animation-delay: 5s;
        }

        .hero-bg:nth-child(3) {
            animation-delay: 10s;
        }

        .page {
            max-width: 1600px;
    margin-right: auto;
    margin-left: var(--sidebar-width);       /* move page right */
    width: calc(100vw - var(--sidebar-width));
    min-height: calc(100vh - var(--taskbar-height));
    padding-bottom: var(--taskbar-height);   /* space for bottom bar */
    overflow-x: hidden;
}


        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg,
        rgba(52, 54, 65, 0.8) 0%,
        rgba(75, 0, 110, 0.7) 100%);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            text-align: center;
            padding: 0 20px;
            max-width: 1200px;
            animation: fadeInUp 1s ease-out;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.5);
            line-height: 1.2;
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: brightness(1.5);
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 2.5vw, 1.5rem);
            color: rgba(255, 255, 255, 0.95);
            max-width: 800px;
            margin: 0 auto 2.5rem;
            line-height: 1.6;
            text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
        }

        .cta-button {
            display: inline-block;
            padding: 18px 48px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(75, 0, 110, 0.4);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 20px rgba(111, 26, 140, 0.6), 0 15px 40px rgba(75, 0, 110, 0.5);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            animation: bounce 2s infinite;
        }

        .scroll-indicator.hidden {
            opacity: 0;
            transform: translateX(-50%) translateY(10px);
            pointer-events: none;
            transition: opacity 200ms ease, transform 200ms ease;
        }

        .scroll-indicator svg {
            width: 30px;
            height: 30px;
            stroke: white;
        }

        /* How It Works Section */
        .how-it-works {
            background: linear-gradient(180deg, var(--light) 0%, #ffffff 50%, var(--light) 100%);
            padding: 120px 20px;
            position: relative;
        }

        .how-it-works::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--secondary), transparent);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
            animation: fadeInUp 0.8s ease-out;
        }

        .section-header h2 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: clamp(1.1rem, 2vw, 1.4rem);
            color: var(--muted);
        }

        .steps-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .step-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s ease;
            animation: fadeInUp 0.8s ease-out backwards;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
            flex: 1 1 320px; /* allow cards to wrap and center; minimum width ~320px */
            max-width: 420px;
        }

        .step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .step-card:hover::before {
            transform: scaleX(1);
        }

        .step-card:nth-child(1) { animation-delay: 0.1s; }
        .step-card:nth-child(2) { animation-delay: 0.2s; }
        .step-card:nth-child(3) { animation-delay: 0.3s; }
        .step-card:nth-child(4) { animation-delay: 0.4s; }
        .step-card:nth-child(5) { animation-delay: 0.5s; }

        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 20px rgba(111, 26, 140, 0.3), 0 20px 40px rgba(75, 0, 110, 0.2);
            border-color: var(--secondary);
        }

        .step-number {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            color: white;
            margin: 0 auto 25px;
            box-shadow: 0 10px 25px rgba(75, 0, 110, 0.3);
            transition: all 0.3s ease;
        }

        .step-card:hover .step-number {
            transform: scale(1.1) rotate(360deg);
            box-shadow: 0 15px 35px rgba(111, 26, 140, 0.5);
        }

        .step-card h3 {
            font-size: 1.4rem;
            color: var(--text);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .step-card p {
            font-size: 1rem;
            color: var(--muted);
            line-height: 1.7;
            /* highlight the description */
            background: linear-gradient(90deg, rgba(111,26,140,0.06), rgba(75,0,110,0.04));
            padding: 14px 16px;
            border-radius: 12px;
            margin: 0 auto;
            max-width: 95%;
            box-shadow: 0 6px 18px rgba(75,0,110,0.04);
            border-left: 4px solid rgba(111,26,140,0.9);
            color: var(--dark);
            font-weight: 600;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            50% {
                transform: translateX(-50%) translateY(10px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {

            :root {
        --sidebar-width: 0px;
    }

    .page {
        width: 100vw;
        margin-left: 0;
    }
            .hero {
                height: 90vh;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .how-it-works {
                padding: 80px 20px;
            }

            .steps-container {
                gap: 20px;
            }

            .step-card {
                margin: 0 auto;
                max-width: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
    <!-- Hero Section -->
    <section class="hero">
        <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=1920&q=80" alt="Event Stage" class="hero-bg">
        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=1920&q=80" alt="Event Celebration" class="hero-bg">
        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=1920&q=80" alt="Event Venue" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>From Idea to Action<br>Plan Your Event Seamlessly</h1>
            <p class="hero-subtitle">Create unforgettable events with our all-in-one platform that connects you with top service providers and simplifies every step of the planning process</p>
            <a href="#how-it-works" class="cta-button">Get Started</a>
        </div>
        <div class="scroll-indicator">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2>How EvoPlan Works</h2>
                <p>Simple steps to plan your perfect event</p>
            </div>

            <div class="steps-container">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3>Create Your Event</h3>
                    <p>Set up your event details, date, location, and requirements in our intuitive event builder.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3>Browse & Book Packages</h3>
                    <p>Explore service providers, view portfolios, and book packages that fit your needs and budget.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Confirm & Communicate</h3>
                    <p>Service providers confirm bookings, and you can message them directly for any adjustments.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">4</div>
                    <h3>Issue Resolution</h3>
                    <p>Our issue coordinators are available to resolve any challenges that may arise during planning.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">5</div>
                    <h3>Leave Feedback</h3>
                    <p>After your event, rate providers to help build our community of trusted professionals.</p>
                </div>
            </div>
        </div>
    </div>
    </section>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.step-card').forEach(card => {
            observer.observe(card);
        });

        // Hide the scroll indicator arrow when the page is scrolled down
        (function() {
            const scrollIndicator = document.querySelector('.scroll-indicator');
            if (!scrollIndicator) return;

            const check = () => {
                if (window.pageYOffset > 10) {
                    scrollIndicator.classList.add('hidden');
                } else {
                    scrollIndicator.classList.remove('hidden');
                }
            };

            // initial state
            check();

            let debounceTimer = null;
            window.addEventListener('scroll', () => {
                if (debounceTimer) clearTimeout(debounceTimer);
                // debounce to avoid too-frequent DOM updates
                debounceTimer = setTimeout(check, 50);
            }, { passive: true });
        })();
    </script>
</body>
</html>
<?php require APPROOT . '/views/inc/footer.php';?>
