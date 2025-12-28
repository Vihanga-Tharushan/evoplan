<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_profile.css">

    <div class="profile-card">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-background">
                <div class="hero-mask"></div>
            </div>
            
            <!-- Hero Content -->
            <div class="hero-content">
                <h1 class="studio-name">Akcrev Studio</h1>
                <div class="studio-tags">
                    <span class="tag">Photographer</span>
                    <div class="tag-separator"></div>
                    <span class="tag">Brand Identity</span>
                    <div class="tag-separator"></div>
                    <div class="tag-separator"></div>
                    <span class="tag">Development</span>
                </div>
            </div>
        </div>
        
        <!-- Profile Section -->
        <div class="profile-section">
            <!-- Profile Image -->
            <div class="profile-image-container">
                <img src="" alt="Akli Hakiki Hasibuan" class="profile-image">
                <div class="edit-photo-button">
                    
                </div>
            </div>
            
            <!-- Profile Info -->
            <div class="profile-info">
                <div class="profile-details">
                    <h2 class="profile-name">Akli Hakiki Hasibuan</h2>
                    <p class="profile-stats">4,8K friends</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="profile-actions">
                    <button class="action-button edit-button">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M11.25 1.5L16.5 6.75L6 17.25H1.5V12.75L11.25 1.5Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.25 4.5L13.5 9.75" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Book Now</span>
                    </button>
                    <button class="action-button edit-button">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M11.25 1.5L16.5 6.75L6 17.25H1.5V12.75L11.25 1.5Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.25 4.5L13.5 9.75" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Edit Profile</span>
                    </button>
                    
                    <button class="action-button dropdown-button">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M6 7.5L9 10.5L12 7.5" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>