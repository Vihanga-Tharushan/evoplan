<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar4.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Providers - EvoPlan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
          --accent: #7c3aed;
          --accent-2: #8a7cfb;
          --bg: #f7f7fb;
          --panel: #ffffff;
          --muted-surface: #f3f4f6;
          --text: #0f172a;
          --muted: #6b7280;
          --border: #e5e7eb;
          --radius: 16px;
          --shadow: 0 1px 2px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.06);
          --header-h: 64px;
          --frame: 1200px;
          --primary: #6d28d9;
          --primary-light: #8b5cf6;
          --secondary: #4c1d95;
          --success: #10b981;
          --danger: #ef4444;
          --warning: #f59e0b;
          --light: #f8fafc;
          --dark: #1e293b;
          --gray: #64748b;
          --border: #e2e8f0;
          --available: #dbeafe;
          --booked: #fecaca;
          --unavailable: #f1f5f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Layout to work with existing sidebar and navbar */
        .main-container {
            display: flex;
            min-height: 100vh;
        }

        /* Assuming sidebar width is 250px */
        .sidebar {
            width: 250px;
            background-color: var(--panel);
            box-shadow: var(--shadow);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
        }

        /* Main content area - adjusted for sidebar */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding-top: var(--header-h);
            min-height: 100vh;
        }

        /* Top navbar placeholder - assuming it's fixed */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: var(--header-h);
            background-color: var(--panel);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            z-index: 99;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            justify-content: space-between;
        }

        .top-navbar .logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .top-navbar .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Page Header */
        .page-header {
            padding: 2rem 2rem 1.5rem;
            background-color: var(--panel);
            border-bottom: 1px solid var(--border);
            margin-bottom: 2rem;
        }

        .page-header-content {
            max-width: var(--frame);
            margin: 0 auto;
        }

        .page-header h1 {
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .page-header p {
            color: var(--gray);
            font-size: 1rem;
        }

        /* Main Content Area */
        .profiles-container {
            max-width: var(--frame);
            margin: 0 auto;
            padding: 0 2rem 3rem;
        }

        /* Controls Bar */
        .controls-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        /* Category Tabs */
        .category-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            flex: 1;
        }

        .category-btn {
            padding: 0.7rem 1.2rem;
            background: var(--muted-surface);
            border: 1px solid var(--border);
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .category-btn:hover {
            background-color: var(--light);
            border-color: var(--primary);
            color: var(--primary);
        }

        .category-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .category-btn i {
            font-size: 1rem;
        }

        /* Rating Filter */
        .rating-filter {
            display: flex;
            align-items: center;
            gap: 1rem;
            background-color: var(--panel);
            padding: 0.7rem 1.2rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .rating-filter label {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .rating-select {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            background-color: var(--panel);
            color: var(--dark);
            font-weight: 500;
            cursor: pointer;
            min-width: 140px;
        }

        .rating-select:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* Profiles Grid */
        .profiles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        /* Profile Card */
        .profile-card {
            background-color: var(--panel);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--border);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .profile-header {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .profile-card:hover .profile-image {
            transform: scale(1.05);
        }

        .profile-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: var(--panel);
            color: var(--dark);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .profile-badge.premium {
            background-color: var(--warning);
            color: white;
        }

        .profile-badge.fast {
            background-color: var(--success);
            color: white;
        }

        .favorite-btn {
            position: absolute;
            top: 1rem;
            left: 1rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--panel);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
            font-size: 1.2rem;
            color: var(--gray);
        }

        .favorite-btn:hover {
            background-color: var(--light);
            color: var(--warning);
        }

        .favorite-btn.active {
            color: var(--warning);
            background-color: rgba(245, 158, 11, 0.1);
        }

        .profile-body {
            padding: 1.5rem;
            flex-grow: 1;
        }

        .profile-title {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            letter-spacing: 1px;
        }

        .profile-category {
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-tagline {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .profile-description {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .profile-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .stars {
            display: flex;
            gap: 0.1rem;
            color: var(--warning);
        }

        .rating-text {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .review-count {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .profile-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .tag {
            padding: 0.4rem 0.8rem;
            background-color: var(--muted-surface);
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--dark);
        }

        .profile-footer {
            padding: 1.5rem;
            background-color: var(--muted-surface);
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price-section {
            display: flex;
            flex-direction: column;
        }

        .price-label {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 0.3rem;
        }

        .price-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        .view-packages-btn {
            padding: 0.8rem 1.5rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .view-packages-btn:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.2);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background-color: var(--panel);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            grid-column: 1 / -1;
        }

        .empty-state-icon {
            font-size: 3.5rem;
            color: var(--muted);
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.8rem;
            color: var(--dark);
        }

        .empty-state p {
            color: var(--gray);
            max-width: 500px;
            margin: 0 auto 2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .sidebar {
                width: 220px;
            }
            
            .main-content {
                margin-left: 220px;
            }
            
            .top-navbar {
                left: 220px;
            }
        }

        @media (max-width: 1100px) {
            .profiles-grid {
                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .top-navbar {
                left: 70px;
            }
            
            .controls-bar {
                flex-direction: column;
                align-items: stretch;
            }
            
            .category-tabs {
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
            
            .profiles-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .profiles-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-footer {
                flex-direction: column;
                gap: 1.5rem;
                align-items: stretch;
            }
            
            .view-packages-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                display: none;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .top-navbar {
                left: 0;
            }
            
            .page-header, .profiles-container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
            
            .profile-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .profile-name {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Sidebar (simulated) -->
        <div class="sidebar">
            <!-- Sidebar content would be here -->
        </div>
        
        <!-- Top Navbar (simulated) -->
        <div class="top-navbar">
            <div class="logo">EvoPlan</div>
            <div class="user-menu">
                <span>Welcome, Alex!</span>
                <div class="user-avatar">
                    <i class="fas fa-user-circle" style="font-size: 2rem; color: var(--primary);"></i>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Page Header -->
            <header class="page-header">
                <div class="page-header-content">
                    <h1>Service Providers</h1>
                    <p>Browse and connect with professional event service providers</p>
                </div>
            </header>
            
            <!-- Profiles Container -->
            <div class="profiles-container">
                <!-- Controls Bar -->
                <div class="controls-bar">
                    <!-- Category Tabs -->
                    <div class="category-tabs">
                        <button class="category-btn active" data-category="all">
                            <i class="fas fa-th-large"></i> All Providers
                        </button>
                        <button class="category-btn" data-category="venues">
                            <i class="fas fa-building"></i> Venues & Halls
                        </button>
                        <button class="category-btn" data-category="photographers">
                            <i class="fas fa-camera"></i> Photographers & Videographers
                        </button>
                        <button class="category-btn" data-category="music">
                            <i class="fas fa-music"></i> Music & DJ Services
                        </button>
                        <button class="category-btn" data-category="florists">
                            <i class="fas fa-palette"></i> Florists & Cake Designers
                        </button>
                        <button class="category-btn" data-category="decorators">
                            <i class="fas fa-couch"></i> Decorators & Event Stylists
                        </button>
                        <button class="category-btn" data-category="equipment">
                            <i class="fas fa-tools"></i> Event Equipment & Rentals
                        </button>
                        <button class="category-btn" data-category="hosts">
                            <i class="fas fa-microphone"></i> Hosts, MCs & Entertainers
                        </button>
                        <button class="category-btn" data-category="transport">
                            <i class="fas fa-truck"></i> Transport & Logistics
                        </button>
                    </div>
                    
                    <!-- Rating Filter -->
                    <div class="rating-filter">
                        <label for="rating-select"><i class="fas fa-filter"></i> Filter by Rating:</label>
                        <select id="rating-select" class="rating-select">
                            <option value="all">All Ratings</option>
                            <option value="5">5 Stars Only</option>
                            <option value="4.5">4.5+ Stars</option>
                            <option value="4">4+ Stars</option>
                            <option value="3.5">3.5+ Stars</option>
                        </select>
                    </div>
                </div>
                
                <!-- Profiles Grid -->
                <div class="profiles-grid" id="profiles-grid">
                    <!-- Profile Card 1: Photographer -->
                    <div class="profile-card" data-category="photographers" data-rating="4.8">
                        <div class="profile-header">
                            <img src="https://images.unsplash.com/photo-1554048612-b6a482bc67e5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Lens Photography" class="profile-image">
                            <button class="favorite-btn" data-id="1">
                                <i class="far fa-star"></i>
                            </button>
                            <div class="profile-badge premium">
                                <i class="fas fa-crown"></i> Premium
                            </div>
                        </div>
                        <div class="profile-body">
                            <div class="profile-category">
                                <i class="fas fa-camera"></i> Photographers & Videographers
                            </div>
                            <div class="profile-title">
                                <h2 class="profile-name">L E N S</h2>
                            </div>
                            <h3 class="profile-tagline">Elite Photography</h3>
                            <p class="profile-description">Specializing in wedding and corporate portrait photography with unmatched clarity. Over 10 years of experience capturing life's most precious moments.</p>
                            
                            <div class="profile-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="rating-text">4.8</span>
                                <span class="review-count">(120 reviews)</span>
                            </div>
                            
                            <div class="profile-tags">
                                <span class="tag">Premium</span>
                                <span class="tag">Fast Response</span>
                                <span class="tag">Award Winning</span>
                                <span class="tag">Free Preview</span>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <div class="price-section">
                                <span class="price-label">Starting from</span>
                                <span class="price-amount">$1,500</span>
                            </div>
                            <button class="view-packages-btn">
                                <i class="fas fa-eye"></i> View Packages
                            </button>
                        </div>
                    </div>
                    
                    <!-- Profile Card 2: Venue -->
                    <div class="profile-card" data-category="venues" data-rating="4.6">
                        <div class="profile-header">
                            <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1194&q=80" alt="Grand Palace Hotel" class="profile-image">
                            <button class="favorite-btn" data-id="2">
                                <i class="far fa-star"></i>
                            </button>
                            <div class="profile-badge premium">
                                <i class="fas fa-crown"></i> Premium
                            </div>
                        </div>
                        <div class="profile-body">
                            <div class="profile-category">
                                <i class="fas fa-building"></i> Venues & Halls
                            </div>
                            <div class="profile-title">
                                <h2 class="profile-name">GRAND PALACE</h2>
                            </div>
                            <h3 class="profile-tagline">Luxury Event Venue</h3>
                            <p class="profile-description">Elegant venue with ballroom capacity for up to 500 guests. Perfect for weddings, corporate events, and gala dinners with exceptional catering services.</p>
                            
                            <div class="profile-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="rating-text">4.6</span>
                                <span class="review-count">(89 reviews)</span>
                            </div>
                            
                            <div class="profile-tags">
                                <span class="tag">Luxury</span>
                                <span class="tag">In-house Catering</span>
                                <span class="tag">500+ Capacity</span>
                                <span class="tag">Central Location</span>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <div class="price-section">
                                <span class="price-label">Starting from</span>
                                <span class="price-amount">$3,200</span>
                            </div>
                            <button class="view-packages-btn">
                                <i class="fas fa-eye"></i> View Packages
                            </button>
                        </div>
                    </div>
                    
                    <!-- Profile Card 3: Music & DJ -->
                    <div class="profile-card" data-category="music" data-rating="4.9">
                        <div class="profile-header">
                            <img src="https://images.unsplash.com/photo-1511379938547-c1f69419868d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Sound Waves DJ" class="profile-image">
                            <button class="favorite-btn active" data-id="3">
                                <i class="fas fa-star"></i>
                            </button>
                            <div class="profile-badge fast">
                                <i class="fas fa-bolt"></i> Fast Response
                            </div>
                        </div>
                        <div class="profile-body">
                            <div class="profile-category">
                                <i class="fas fa-music"></i> Music & DJ Services
                            </div>
                            <div class="profile-title">
                                <h2 class="profile-name">BEAT MASTERS</h2>
                            </div>
                            <h3 class="profile-tagline">Premier DJ Entertainment</h3>
                            <p class="profile-description">Professional DJs with vast music libraries for any event. Specializing in weddings, corporate parties, and club events with state-of-the-art sound systems.</p>
                            
                            <div class="profile-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="rating-text">4.9</span>
                                <span class="review-count">(156 reviews)</span>
                            </div>
                            
                            <div class="profile-tags">
                                <span class="tag">Custom Playlists</span>
                                <span class="tag">Lighting Included</span>
                                <span class="tag">MC Services</span>
                                <span class="tag">Fast Response</span>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <div class="price-section">
                                <span class="price-label">Starting from</span>
                                <span class="price-amount">$850</span>
                            </div>
                            <button class="view-packages-btn">
                                <i class="fas fa-eye"></i> View Packages
                            </button>
                        </div>
                    </div>
                    
                    <!-- Profile Card 4: Florist -->
                    <div class="profile-card" data-category="florists" data-rating="4.7">
                        <div class="profile-header">
                            <img src="https://images.unsplash.com/photo-1464207687429-7505649dae38?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1173&q=80" alt="Bloom Designs" class="profile-image">
                            <button class="favorite-btn" data-id="4">
                                <i class="far fa-star"></i>
                            </button>
                            <div class="profile-badge premium">
                                <i class="fas fa-crown"></i> Premium
                            </div>
                        </div>
                        <div class="profile-body">
                            <div class="profile-category">
                                <i class="fas fa-palette"></i> Florists & Cake Designers
                            </div>
                            <div class="profile-title">
                                <h2 class="profile-name">BLOOM & FLOUR</h2>
                            </div>
                            <h3 class="profile-tagline">Floral & Cake Artistry</h3>
                            <p class="profile-description">Creating breathtaking floral arrangements and custom-designed cakes for weddings and special events. Fresh flowers sourced daily from local growers.</p>
                            
                            <div class="profile-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="rating-text">4.7</span>
                                <span class="review-count">(74 reviews)</span>
                            </div>
                            
                            <div class="profile-tags">
                                <span class="tag">Custom Designs</span>
                                <span class="tag">Fresh Daily</span>
                                <span class="tag">Wedding Specialist</span>
                                <span class="tag">Cake Artistry</span>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <div class="price-section">
                                <span class="price-label">Starting from</span>
                                <span class="price-amount">$1,200</span>
                            </div>
                            <button class="view-packages-btn">
                                <i class="fas fa-eye"></i> View Packages
                            </button>
                        </div>
                    </div>
                    
                    <!-- Profile Card 5: Decorator -->
                    <div class="profile-card" data-category="decorators" data-rating="4.5">
                        <div class="profile-header">
                            <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Elegant Designs" class="profile-image">
                            <button class="favorite-btn" data-id="5">
                                <i class="far fa-star"></i>
                            </button>
                            <div class="profile-badge fast">
                                <i class="fas fa-bolt"></i> Fast Response
                            </div>
                        </div>
                        <div class="profile-body">
                            <div class="profile-category">
                                <i class="fas fa-couch"></i> Decorators & Event Stylists
                            </div>
                            <div class="profile-title">
                                <h2 class="profile-name">ELEGANT STYLE</h2>
                            </div>
                            <h3 class="profile-tagline">Event Design & Styling</h3>
                            <p class="profile-description">Transforming venues into magical spaces with custom decor, lighting, and styling. Specializing in thematic events and luxury wedding decorations.</p>
                            
                            <div class="profile-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="rating-text">4.5</span>
                                <span class="review-count">(63 reviews)</span>
                            </div>
                            
                            <div class="profile-tags">
                                <span class="tag">Thematic Design</span>
                                <span class="tag">Lighting Experts</span>
                                <span class="tag">Fast Setup</span>
                                <span class="tag">Custom Props</span>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <div class="price-section">
                                <span class="price-label">Starting from</span>
                                <span class="price-amount">$2,100</span>
                            </div>
                            <button class="view-packages-btn">
                                <i class="fas fa-eye"></i> View Packages
                            </button>
                        </div>
                    </div>
                    
                    <!-- Profile Card 6: Equipment Rental -->
                    <div class="profile-card" data-category="equipment" data-rating="4.4">
                        <div class="profile-header">
                            <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1112&q=80" alt="Event Gear Pro" class="profile-image">
                            <button class="favorite-btn" data-id="6">
                                <i class="far fa-star"></i>
                            </button>
                            <div class="profile-badge fast">
                                <i class="fas fa-bolt"></i> Fast Response
                            </div>
                        </div>
                        <div class="profile-body">
                            <div class="profile-category">
                                <i class="fas fa-tools"></i> Event Equipment & Rentals
                            </div>
                            <div class="profile-title">
                                <h2 class="profile-name">EVENT GEAR PRO</h2>
                            </div>
                            <h3 class="profile-tagline">Complete Event Rentals</h3>
                            <p class="profile-description">Providing high-quality event equipment including chairs, tables, tents, sound systems, and staging. Delivery and setup services available.</p>
                            
                            <div class="profile-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="rating-text">4.4</span>
                                <span class="review-count">(52 reviews)</span>
                            </div>
                            
                            <div class="profile-tags">
                                <span class="tag">Wide Selection</span>
                                <span class="tag">Delivery & Setup</span>
                                <span class="tag">Affordable</span>
                                <span class="tag">Same-Day Service</span>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <div class="price-section">
                                <span class="price-label">Starting from</span>
                                <span class="price-amount">$450</span>
                            </div>
                            <button class="view-packages-btn">
                                <i class="fas fa-eye"></i> View Packages
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category tab switching
            const categoryBtns = document.querySelectorAll('.category-btn');
            const profileCards = document.querySelectorAll('.profile-card');
            const ratingSelect = document.getElementById('rating-select');
            
            // Favorite button functionality
            const favoriteBtns = document.querySelectorAll('.favorite-btn');
            favoriteBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isActive = this.classList.contains('active');
                    const icon = this.querySelector('i');
                    
                    if (isActive) {
                        this.classList.remove('active');
                        icon.className = 'far fa-star';
                        alert('Removed from favorites');
                    } else {
                        this.classList.add('active');
                        icon.className = 'fas fa-star';
                        alert('Added to favorites');
                    }
                });
            });
            
            // View Packages button
            const viewPackageBtns = document.querySelectorAll('.view-packages-btn');
            viewPackageBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const card = this.closest('.profile-card');
                    const providerName = card.querySelector('.profile-name').textContent;
                    alert(`Redirecting to packages for ${providerName}...`);
                    // In a real implementation, this would navigate to the packages page
                    // window.location.href = `/providers/${providerId}/packages`;
                });
            });
            
            // Category filter function
            function filterByCategory(category) {
                profileCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    
                    if (category === 'all' || cardCategory === category) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
            
            // Rating filter function
            function filterByRating(ratingValue) {
                profileCards.forEach(card => {
                    const cardRating = parseFloat(card.getAttribute('data-rating'));
                    
                    if (ratingValue === 'all' || cardRating >= parseFloat(ratingValue)) {
                        // Only show if also passes category filter
                        const activeCategory = document.querySelector('.category-btn.active').getAttribute('data-category');
                        const cardCategory = card.getAttribute('data-category');
                        
                        if (activeCategory === 'all' || cardCategory === activeCategory) {
                            card.style.display = 'flex';
                        }
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
            
            // Category button event listeners
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active button
                    categoryBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Filter by category
                    const category = this.getAttribute('data-category');
                    filterByCategory(category);
                    
                    // Also apply rating filter if set
                    const ratingValue = ratingSelect.value;
                    if (ratingValue !== 'all') {
                        filterByRating(ratingValue);
                    }
                });
            });
            
            // Rating filter event listener
            ratingSelect.addEventListener('change', function() {
                const ratingValue = this.value;
                filterByRating(ratingValue);
            });
            
            // Profile card click (excluding buttons)
            profileCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Only trigger if not clicking on a button inside the card
                    if (!e.target.closest('.favorite-btn') && !e.target.closest('.view-packages-btn')) {
                        const providerName = this.querySelector('.profile-name').textContent;
                        alert(`Opening ${providerName} profile...`);
                        // In a real implementation, this would navigate to the provider's detail page
                        // window.location.href = `/providers/${providerId}`;
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbar.php'; ?>

