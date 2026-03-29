<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/packages.css">

<div class="container">
    <!-- Filters Section -->
    <div class="filters-section">
        <div class="filters-row">

             
            <div class="filter-group">
                <label class="filter-label">Price Range</label>
                <div class="price-range-slider">
                    <div class="price-input">
                        <div class="field">
                            <span>Min</span>
                            <input type="number" class="input-min" value="0" min="0" max="10000">
                        </div>
                        <div class="separator">-</div>
                        <div class="field">
                            <span>Max</span>
                            <input type="number" class="input-max" value="7000" min="0" max="1000000">
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <input type="range" class="range-min" min="0" max="10000" value="0" step="100">
                            <input type="range" class="range-max" min="0" max="100000" value="7000" step="100">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Sort By</label><br>
                <select class="filter-select" id="sort-by">
                    <option>Highest Rating</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Most Popular</option>
                </select>
            </div>
           
            <div class="filter-group">
                <label class="filter-label">Rating</label><br>
                <select class="filter-select" id="min-rating">
                    <option>All Ratings</option>
                    <option>4.5+ Stars</option>
                    <option>4.0+ Stars</option>
                    <option>3.5+ Stars</option>
                    <option>3.0+ Stars</option>
                    
                </select>
            </div>
        </div>
        <button class="reset-filters">Reset Filters</button>
    </div>

    <!-- Category Navigation -->
    <div class="category-nav">
        <button class="category-btn active" data-category="recommendation">Recommendation</button>
        <button class="category-btn" data-category="all">All Services</button>
        <button class="category-btn" data-category="your-favourites">Your Favourites</button>
        <button class="category-btn" data-category="catering">Catering</button>
        <button class="category-btn" data-category="photography">Photography</button>
        <button class="category-btn" data-category="music">Music</button>
        <button class="category-btn" data-category="entertainers">Entertainers</button>
        <button class="category-btn" data-category="decorations">Decorations</button>
        <button class="category-btn" data-category="venue">Venue</button>
        <button class="category-btn" data-category="transportation">Transportation</button>
        <button class="category-btn" data-category="florist">Florist</button>
        <button class="category-btn" data-category="cake designing">Cake Designing</button>
        <button class="category-btn" data-category="event equipment">Event Equipment</button>
        
    </div>

    <!-- Packages Grid -->
    <div class="packages-grid">
        <!-- Package cards will be dynamically inserted here -->
    </div>

    


    <!--pop up view package details-->
    <div class="package-popup-overlay" id="package-popup-overlay">
        <div class="package-popup" id="package-popup">
            <span class="close-popup" id="close-popup">&times;</span>
            <div class="popup-content" id="popup-content">
                <div class="popup-header">
                    <h2></h2>
                    <span ></span>
                </div>
                    
                    <div class="popup-body">
                        <div class="popup-details">
                                <p class="package-description"></p>
                                <a href="" class="provider-info">
                                    <div class="provider-avatar">
                                        <img src="" alt="Provider">
                                    </div>
                                    <div class="provider-details">
                                        <span class="provider-name"></span>
                                        <span class="provider-badge">Verified Provider</span>
                                    </div>
                                </a>
                            <div class="rating">
                                <div class="stars">★★★★★</div>
                                <span class="rating-value"></span>
                                <span class="rating-count"></span>
                            </div>
                            
                            <span class="popup-price-label">Price: </span>
                            <span class="popup-price"></span>
                        </div>

                        <div class="extra-details">
                        <p>If you want to know anything more about the package, please contact the provider. You can do that by simply clicking on the provider's name or avatar above. and go to the message</p>
                        </div>
                    </div>

                    
            </div>
        </div>
    </div>
</div>
<script>
    const URLROOT = '<?php echo URLROOT; ?>';
   
</script>

<script src="<?php echo URLROOT; ?>/js/packages/clientPackages.js"></script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>

