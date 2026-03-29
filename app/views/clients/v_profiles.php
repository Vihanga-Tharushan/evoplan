<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
         --accent: #4B006E;
        --accent-2: #8a7cfb;
        --bg: #f7f7fb;
        --panel: #ffffff;
        --muted-surface: #f3f4f6;
        --text: #0f172a;
        --muted: #6b7280;
        --border: #e5e7eb;
        --radius: 16px;
        --shadow: 0 1px 2px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.06);
        --header-h: 90px;
        --frame: 1400px;
        --primary: #4B006E;     /* Dark purple */
        --primary-light: #7C3AED; /* Lighter purple for hover effects */
        --secondary: #6F1A8C;   /* Accent violet */
        --lightSecondary: #7a6e83ff; /* Light violet */
        --dark: #0b1026;         /* Background dark */
        --light: #f7f8fc;        /* Light section background */
        --text: #111827;         /* Main text */
        --muted: #6b7280ff;        /* Subtext / secondary text */
        --darkprimary: #15001eff; /* Darker purple */
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
        
        /* Main content area - adjusted for sidebar */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding-top: var(--header-h);
            min-height: 100vh;
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
            width: 100%;
        }
        
        #my-favourites .profiles-container {
            padding: 2rem;
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
            width: 100%;
        }
        
        #favourites-grid {
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
            min-height: 280px;
            max-height:450px;
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
            padding: 1.25rem;
            flex-grow: 1;
            max-height: 280px;
        }

        .profile-title {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
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
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-category-label {
            background-color: rgba(75, 0, 110, 0.1);
            color: var(--primary);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid rgba(75, 0, 110, 0.2);
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
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .profile-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
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

        /* Tab Navigation */
        .tabs-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
            margin-left: 40px;
            margin-top: -20px;
            margin-right: 20px;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
        }

        .tab {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 16px 24px;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            color: var(--muted);
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            font-size: 16px;
        }

        .tab:hover {
            color: var(--text);
        }

        .tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .tab i {
            font-size: 20px;
        }

        .badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
        }

        .badge-success {
            background-color: var(--success);
        }

        /* Section Management */
        .complaint-section {
            display: none;
            opacity: 0;
            visibility: hidden;
            background: var(--panel);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .complaint-section.active {
            display: block;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.3s ease;
        }

        .section-header {
            padding: 10px 24px;
            border-bottom: 1px solid var(--border);
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(109, 40, 217, 0.05) 0%, rgba(138, 124, 251, 0.05) 100%);
        }

        .section-header span {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
        }

        /* Enhanced Empty State Styling */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background-color: var(--panel);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            grid-column: 1 / -1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 400px;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--muted);
            margin-bottom: 1.5rem;
            opacity: 0.6;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            color: var(--dark);
        }

        .empty-state p {
            color: var(--gray);
            max-width: 500px;
            margin: 0 auto;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
           
            .main-content {
                margin-left: 220px;
            }
           
        }

        @media (max-width: 1100px) {
            .profiles-grid {
                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            }
        }

        @media (max-width: 992px) {
            
            .main-content {
                margin-left: 70px;
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
          
            
            .main-content {
                margin-left: 0;
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
        
        <!-- Main Content -->
        <main class="main-content">
            
            <!-- Tab Navigation -->
            <div class="tabs-container"> 
                <div class="tabs">
                    <button class="tab active" data-tab="service-providers">
                        <i class="fas fa-users"></i>
                        Service Providers
                    </button>
                    <button class="tab" data-tab="my-favourites">
                        <i class="fas fa-heart"></i>
                        My Favourites
                    </button>
                </div>
            </div>
            
            <!-- Service Providers Section -->
            <div class="complaint-section active" id="service-providers">
               
                
                <!-- Profiles Container -->
                <div class="profiles-container">
                <!-- Controls Bar -->
                <div class="controls-bar">
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
                    <!-- Dynamic profile cards will be loaded here -->
                </div>
                </div>
            </div>
            
            <!-- My Favourites Section -->
            <div class="complaint-section" id="my-favourites">
                
                
                <!-- Favourites Container -->
                <div class="profiles-container">
                    <!-- Favourites Grid -->
                    <div class="profiles-grid" id="favourites-grid">
                        <!-- Favourited profiles will be loaded here by JavaScript -->
                       
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script> const URLROOT = '<?php echo URLROOT; ?>'; </script>

    <script>
        
        // Global ratings data storage
        let ratingsData = {};
        let favoriteProviderIds = new Set();

        document.addEventListener('DOMContentLoaded', function() {
            
            // Load ratings first, then load favorites, then providers
            getServiceProvidersRattings().then(() => {
                return loadFavoritesData();
            }).then(() => {
                getAllServiceProviders();
            }).catch(() => {
                // If ratings or favorites fail, still load providers
                getAllServiceProviders();
            });

            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    const currentActiveSection = document.querySelector('.complaint-section.active');
                    const tabId = tab.getAttribute('data-tab');
                    const newSection = document.getElementById(tabId);
                    
                    if (currentActiveSection && currentActiveSection !== newSection) {
                        // Hide current section with transition
                        hideSection(currentActiveSection);
                        
                        // After current section fades out, show new section
                        setTimeout(() => {
                            // Update tab states
                            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                            tab.classList.add('active');
                            
                            // Show new section
                            showSection(newSection);
                            
                            // Load favourites if switching to "My Favourites" tab
                            if (tabId === 'my-favourites') {
                                displayFavourites();
                            }
                        }, 300);

                    } else if (!currentActiveSection) {
                        // No active section, just show the new one
                        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                        tab.classList.add('active');
                        showSection(newSection);
                        
                        // Load favourites if "My Favourites" tab is active
                        if (tabId === 'my-favourites') {
                            displayFavourites();
                        }
                    }
                });
            });
            


            // Category tab switching
            const categoryBtns = document.querySelectorAll('.category-btn');
            const ratingSelect = document.getElementById('rating-select');
            
            // Favorite button functionality with event delegation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.favorite-btn')) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const btn = e.target.closest('.favorite-btn');
                    const profileId = btn.getAttribute('data-id');
                    const isActive = btn.classList.contains('active');
                    const icon = btn.querySelector('i');
                    
                    if (isActive) {
                        // Remove from favorites
                        btn.classList.remove('active');
                        icon.className = 'far fa-star';
                        removeFavoriteFromDatabase(profileId);
                    } else {
                        // Add to favorites
                        btn.classList.add('active');
                        icon.className = 'fas fa-star';
                        addFavoriteToDatabase(profileId);
                    }
                    
                    // Refresh favorites display if currently viewing favorites tab
                    if (document.getElementById('my-favourites').classList.contains('active')) {
                        displayFavourites();
                    }
                }
            });

            
            // View Profile button and card click functionality with event delegation for dynamic content
            document.addEventListener('click', function(e) {
                if (e.target.closest('.view-packages-btn')) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const btn = e.target.closest('.view-packages-btn');
                    const card = btn.closest('.profile-card');
                    const providerName = card.querySelector('.profile-name').textContent;
                    const providerId = btn.getAttribute('data-provider-id');
                    
                    
                    // In a real implementation, this would navigate to the packages page
                     window.location.href = `${URLROOT}/Clients/viewProvider/${providerId}`;
                } else if (e.target.closest('.profile-card') && 
                          !e.target.closest('.favorite-btn') && 
                          !e.target.closest('.view-packages-btn')) {
                    
                    const card = e.target.closest('.profile-card');
                    const providerName = card.querySelector('.profile-name').textContent;
                    alert(`Opening ${providerName} profile...`);
                    // In a real implementation, this would navigate to the provider's detail page
                }
            });
            


            // Category filter function
            function filterByCategory(category) {
                const cardsInSection = document.querySelectorAll('#service-providers .profile-card');
                cardsInSection.forEach(card => {
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
                const cardsInSection = document.querySelectorAll('#service-providers .profile-card');
                cardsInSection.forEach(card => {
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
            
        });

        function addFavoriteToDatabase(profileId) {
            const xml = new XMLHttpRequest();
            xml.open('POST', `${URLROOT}/clients/addFavoriteProviders`, true);
            xml.setRequestHeader('Content-Type', 'application/json');
            xml.onload = function() {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.success || response.status === 'success') {
                        console.log('Added to favorites');
                    } else {
                        console.error('Failed to add to favorites:', response.message);
                    }
                } else {
                    console.error('Failed to add favorite');
                }
            };
            xml.onerror = () => console.error('Network error adding favorite');
            const jsonData = JSON.stringify({profileId: profileId});
            xml.send(jsonData);
        }

        function removeFavoriteFromDatabase(profileId) {
            const xml = new XMLHttpRequest();
            xml.open('POST', `${URLROOT}/clients/removeFavoriteProviders`, true);
            xml.setRequestHeader('Content-Type', 'application/json');
            xml.onload = function() {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.success || response.status === 'success') {
                        console.log('Removed from favorites');
                    } else {
                        console.error('Failed to remove from favorites:', response.message);
                    }
                } else {
                    console.error('Failed to remove favorite');
                }
            };
            xml.onerror = () => console.error('Network error removing favorite');
            const jsonData = JSON.stringify({profileId: profileId});
            xml.send(jsonData);
        }

        function loadFavoritesData() {
            return new Promise((resolve, reject) => {
                const xml = new XMLHttpRequest();
                xml.open('GET', `${URLROOT}/clients/getFavoriteProviders`, true);
                xml.onload = function() {
                    if (this.status === 200) {
                        const providers = JSON.parse(this.responseText);
                        favoriteProviderIds.clear();
                        providers.forEach(provider => {
                            favoriteProviderIds.add(provider.service_id.toString());
                        });
                        console.log('Favorites loaded:', Array.from(favoriteProviderIds));
                        resolve(providers);
                    } else {
                        reject(new Error('Failed to fetch favorites'));
                    }
                };
                xml.onerror = () => reject(new Error('Network error'));
                xml.send();
            });
        }

        function displayFavourites() {
            const favouritesGrid = document.getElementById('favourites-grid');
            favouritesGrid.innerHTML = '<div class="empty-state"><p>Loading...</p></div>';
            
            const xml = new XMLHttpRequest();
            xml.open('GET', `${URLROOT}/clients/getFavoriteProviders`, true);
            xml.onload = function() {
                try {
                    if (this.status === 200) {
                        const providers = JSON.parse(this.responseText);
                        console.log('Favorites API response:', providers);
                        console.log('Favorites count:', providers.length);
                        console.log('Favorites data:', JSON.stringify(providers, null, 2));
                        
                        favouritesGrid.innerHTML = '';
                        
                        // Update global favorites set
                        favoriteProviderIds.clear();
                        providers.forEach(provider => {
                            favoriteProviderIds.add(provider.service_id.toString());
                        });
                        console.log('Updated favoriteProviderIds after displayFavourites:', Array.from(favoriteProviderIds));
                        
                        if (providers.length === 0) {
                            console.log('No providers returned from API');
                            favouritesGrid.innerHTML = `
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <h3>No Favourites Yet</h3>
                                    <p>Start exploring service providers and add them to your favourites!</p>
                                </div>
                            `;
                            return;
                        }
                        
                        console.log('Creating cards for', providers.length, 'providers');
                        providers.forEach((provider, index) => {
                            console.log(`Creating card ${index} for provider:`, provider.service_id, provider.business_name);
                            
                            const categoryIcon = getCategoryIcon(provider.serviceType || 'Service');
                            const ratingInfo = ratingsData[provider.service_id] || { avg_rating: 0, total_reviews: 0 };
                            const starsHtml = generateStarRating(ratingInfo.avg_rating);
                            const profileImage = `${URLROOT}/public/img/profilePics/${provider.profile_pic}`;

                            const profileCard = document.createElement('div');
                            profileCard.classList.add('profile-card');
                            profileCard.setAttribute('data-category', getCategorySlug(provider.serviceType || 'other'));
                            profileCard.setAttribute('data-rating', ratingInfo.avg_rating || 0);
                            profileCard.setAttribute('data-id', provider.service_id);
                            
                            profileCard.innerHTML = `
                                <div class="profile-header">
                                    <img src="${profileImage}" alt="${provider.business_name}" class="profile-image">
                                    <button class="favorite-btn active" data-id="${provider.service_id}">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </div>
                                <div class="profile-body">
                                    <div class="profile-title">
                                        <h2 class="profile-name">${provider.business_name}</h2>
                                    </div>
                                    
                                    <p class="profile-description">${(provider.intro || provider.description || 'Professional service provider ready to make your event memorable.').substring(0, 80)}${(provider.intro || provider.description || '').length > 100 ? '...' : ''}</p>
                                    
                                     <div class="profile-category">
                                        <span class="profile-category-label">
                                            <i class="${categoryIcon}"></i> ${provider.serviceType || 'Service Provider'}
                                        </span>
                                    </div>
                                    <div class="profile-rating">
                                        <div class="stars">
                                            ${starsHtml}
                                        </div>
                                        <span class="rating-text">${ratingInfo.avg_rating > 0 ? ratingInfo.avg_rating.toFixed(1) : 'N/A'}</span>
                                        <span class="review-count">(${ratingInfo.total_reviews} reviews)</span>

                                    </div>
                                    
                                    <button class="view-packages-btn" data-provider-id="${provider.service_id}">
                                        <i class="fas fa-eye"></i> View Profile
                                    </button>

                                </div>
                            `;
                            favouritesGrid.appendChild(profileCard);
                            console.log(`Card ${index} appended to grid`);
                        });
                        console.log('Total cards in favorites grid:', favouritesGrid.children.length);
                    } else {
                        console.error('Failed to fetch favorite providers, status:', this.status, 'Response:', this.responseText);
                        favouritesGrid.innerHTML = `
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h3>Error Loading Favorites</h3>
                                <p>Failed to load your favorite providers (Status: ${this.status}). Please try again later.</p>
                            </div>
                        `;
                    }
                } catch (error) {
                    console.error('Error parsing favorites response:', error, 'Response text:', this.responseText);
                    favouritesGrid.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3>Error Loading Favorites</h3>
                            <p>An error occurred while loading favorites. Check console for details.</p>
                        </div>
                    `;
                }
            };
            xml.onerror = () => {
                console.error('Network error fetching favorites');
                favouritesGrid.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3>Network Error</h3>
                        <p>Failed to connect to the server. Please check your internet connection.</p>
                    </div>
                `;
            };
            xml.send();
        }

        function getServiceProvidersRattings(){
            return new Promise((resolve, reject) => {
                var xml = new XMLHttpRequest();
                xml.open('GET', `${URLROOT}/clients/getServiceProvidersRattings`, true);
                xml.onload = function() {
                    if (this.status === 200) {
                        const ratings = JSON.parse(this.responseText);
                        // Store ratings by service_id for easy lookup
                        ratings.forEach(rating => {
                            ratingsData[rating.service_id] = {
                                avg_rating: rating.avg_rating ? parseFloat(rating.avg_rating) : 0,
                                total_reviews: rating.total_reviews || 0
                            };
                        });
                        console.log('Ratings loaded:', ratingsData);
                        resolve(ratingsData);
                    } else {
                        console.error('Failed to fetch service providers ratings');
                        reject(new Error('Failed to fetch ratings'));
                    }
                };
                xml.onerror = () => reject(new Error('Network error'));
                xml.send();
            });
        }

        function getAllServiceProviders() {

            var xml = new XMLHttpRequest();
            xml.open('GET', `${URLROOT}/clients/getAllServiceProviders`, true);
            xml.onload = function() {
                if (this.status === 200) {
                    const providers = JSON.parse(this.responseText);
                    displayServiceProviders(providers);
                } else {
                    console.error('Failed to fetch service providers');
                }
            };
            xml.send();
        }

        function displayServiceProviders(providers) {
            const profilesGrid = document.getElementById('profiles-grid');
            profilesGrid.innerHTML = ''; // Clear existing profiles

            providers.forEach(provider => {
                const providerId = provider.service_id;
                const isFavorited = favoriteProviderIds.has(providerId.toString());
                
                // Get category icon (use default if category not available)
                const categoryIcon = getCategoryIcon(provider.serviceType || 'Service');
                
                // Get rating from ratingsData or use default
                const ratingInfo = ratingsData[providerId] || { avg_rating: 0, total_reviews: 0 };
                const starsHtml = generateStarRating(ratingInfo.avg_rating);
                
                // Handle profile image with fallback
                const profileImage = `${URLROOT}/public/img/profilePics/${provider.profile_pic}`;

                const profileCard = document.createElement('div');
                profileCard.classList.add('profile-card');
                profileCard.setAttribute('data-category', getCategorySlug(provider.serviceType || 'other'));
                profileCard.setAttribute('data-rating', ratingInfo.avg_rating || 0);
                
                profileCard.innerHTML = `
                    <div class="profile-header">
                        <img src="${profileImage}" alt="${provider.business_name}" class="profile-image">
                        <button class="favorite-btn ${isFavorited ? 'active' : ''}" data-id="${providerId}">
                            <i class="${isFavorited ? 'fas' : 'far'} fa-star"></i>
                        </button>
                    </div>
                    <div class="profile-body">
                        <div class="profile-title">
                            <h2 class="profile-name">${provider.business_name}</h2>
                        </div>
                        
                        <p class="profile-description">${(provider.intro || provider.description || 'Professional service provider ready to make your event memorable.').substring(0, 80)}${(provider.intro || provider.description || '').length > 100 ? '...' : ''}</p>
                        
                         <div class="profile-category">
                            <span class="profile-category-label">
                                <i class="${categoryIcon}"></i> ${provider.serviceType || 'Service Provider'}
                            </span>
                        </div>
                        <div class="profile-rating">
                            <div class="stars">
                                ${starsHtml}
                            </div>
                            <span class="rating-text">${ratingInfo.avg_rating > 0 ? ratingInfo.avg_rating.toFixed(1) : 'N/A'}</span>
                            <span class="review-count">(${ratingInfo.total_reviews} reviews)</span>

                        </div>
                        
                        <button class="view-packages-btn" data-provider-id="${providerId}">
                            <i class="fas fa-eye"></i> View Profile
                        </button>

                    </div>
                `;
                profilesGrid.appendChild(profileCard);
            });
        }
        
        function getCategoryIcon(category) {
            const categoryIcons = {
                'Photography': 'fas fa-camera',
                'Music': 'fas fa-music',
                'DJ': 'fas fa-music',
                'Venue': 'fas fa-building',
                'Catering': 'fas fa-utensils',
                'Decorators': 'fas fa-palette',
                'Florists': 'fas fa-leaf',
                'Transportation': 'fas fa-truck',
                'Event Equipment': 'fas fa-tools',
                'Entertainers': 'fas fa-microphone'
            };
            
            // Try to match category with icons, default to camera
            const matchedIcon = Object.keys(categoryIcons).find(key => 
                category.toLowerCase().includes(key.toLowerCase())
            );
            
            return matchedIcon ? categoryIcons[matchedIcon] : 'fas fa-camera';
        }
        
        function getCategorySlug(category) {
            const categoryMap = {
                'Photography': 'photographers',
                'Music': 'music',
                'DJ': 'music',
                'Venue': 'venues',
                'Catering': 'catering',
                'Decorators': 'decorators',
                'Florists': 'florists',
                'Transportation': 'transport',
                'Event Equipment': 'equipment',
                'Entertainers': 'hosts'
            };
            
            const matchedSlug = Object.keys(categoryMap).find(key => 
                category.toLowerCase().includes(key.toLowerCase())
            );
            
            return matchedSlug ? categoryMap[matchedSlug] : 'other';
        }
        
        function generateStarRating(rating) {
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 >= 0.5;
            const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
            
            let starsHtml = '';
            
            // Full stars
            for (let i = 0; i < fullStars; i++) {
                starsHtml += '<i class="fas fa-star"></i>';
            }
            
            // Half star
            if (hasHalfStar) {
                starsHtml += '<i class="fas fa-star-half-alt"></i>';
            }
            
            // Empty stars
            for (let i = 0; i < emptyStars; i++) {
                starsHtml += '<i class="far fa-star"></i>';
            }
            
            return starsHtml;
        }

        function showSection(section){
            section.style.display = 'block';
            // Force reflow to ensure display change takes effect
            section.offsetHeight;
            section.classList.add('active');
        }

        function hideSection(section) {
            section.classList.remove('active');
            setTimeout(() => {
                section.style.display = 'none';
            }, 300); // Match transition duration
        }

    </script>
</body>
</html>


