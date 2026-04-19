<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php $finalBackUrl = URLROOT . '/Clients/profiles'; ?>
<?php require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbarBack.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_profile.css">

<style>
  .packages-horizontal-scroll {
    overflow-x: auto;
    overflow-y: hidden;
    padding: 10px 0;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: smooth;
  }

  .packages-horizontal-scroll::-webkit-scrollbar {
    height: 8px;
  }

  .packages-horizontal-scroll::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }

  .packages-horizontal-scroll::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
  }

  .packages-horizontal-scroll::-webkit-scrollbar-thumb:hover {
    background: #555;
  }

  .packages-grid-horizontal {
    display: flex;
    gap: 20px;
    min-width: min-content;
    padding: 10px 5px;
  }

  .package-card {
    flex: 0 0 250px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: white;
    position: relative;
  }

  .package-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
  }

  .package-card:hover::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 100%);
    z-index: 1;
    opacity: 1;
    transition: opacity 0.3s ease;
  }

  .package-card__image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    background: #f0f0f0;
    transition: transform 0.3s ease;
  }

  .package-card:hover .package-card__image {
    transform: scale(1.05);
  }

  .package-card__body {
    padding: 15px;
    position: relative;
    z-index: 2;
  }

  .package-card__name {
    font-weight: 700;
    font-size: 22px;
    margin: 0 0 8px 0;
    color: #333;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    transition: color 0.3s ease;
  }

  .package-card:hover .package-card__name {
    color: white;
  }

  .package-card__price {
    font-size: 20px;
    font-weight: 600;
    color:var(--primary);
    margin: 8px 0;
    transition: color 0.3s ease;
  }

  .package-card:hover .package-card__price {
    color: white;
  }

  .package-card__rating {
    font-size: 14px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: color 0.3s ease;
  }

  .package-card:hover .package-card__rating {
    color: white;
  }

  .package-card__stars {
    color: #ffc107;
  }

  .package-card:hover .package-card__stars {
    color: #ffd700;
  }

  /* View Package Button */
  .package-card__button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: var(--primary, #2196F3);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 3;
  }

  .package-card:hover .package-card__button {
    opacity: 1;
  }

  /* Popup Styles */
  .package-popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
  }

  .package-popup-overlay {
    display: none !important;
  }

  .package-popup-overlay.show {
    display: flex !important;
  }

  .package-popup {
    background: white;
    border-radius: 12px;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
  }

  .popup-content {
    position: relative;
  }

  .close-popup {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    color: #666;
    z-index: 1001;
    transition: color 0.3s ease;
    border: none;
    background: none;
  }

  .close-popup:hover {
    color: #333;
  }

  .popup-title {
    margin: 0;
    padding: 20px 20px 0 20px;
    font-size: 22px;
    font-weight: 700;
    color: #333;
  }

  .popup-body {
    padding: 20px;
  }

  .popup-image {
    width: 100%;
    height: 180px;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 20px;
    background: #f0f0f0;
  }

  .popup-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .popup-details {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  #popup-package-title {
    margin: 0;
    padding: 20px 20px 15px 20px;
    font-size: 24px;
    font-weight: 700;
    color:var(--primary);
    text-align: center;
    border-bottom: 1px solid #eee;
  }

  #popup-description {
    font-size: 17px;
    line-height: 1.8;
    color: #000;
    margin: 0;
    word-wrap: break-word;
    padding-left: 0;
  }

  #popup-description li {
    margin-bottom: 17px;
    font-weight: 500;
  }

  .details-list {
    list-style-type: disc;
    color: #000;
    padding-left: 20px;
    margin: 0;
  }

  .details-list li {
    margin-bottom: 17px;
    font-size: 14px;
    line-height: 1.6;
    color: #000;
    font-weight: 500;
  }

  .popup-price {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    color: var(--primary, #2196F3);
    font-size: 20px;
  }

  .popup-price-label {
    font-weight: 700;
    color: #333;
  }

  /* Comments Panel Styles */
  .comments-panel {
    position: fixed;
    right: -400px;
    top: 0;
    width: 400px;
    height: 100vh;
    background: white;
    box-shadow: -2px 0 10px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    z-index: 999;
    transition: right 0.3s ease;
  }

  .comments-panel.active {
    right: 0;
  }

  .comments-panel__header {
    padding: 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .comments-panel__header h2 {
    margin: 0;
    font-size: 18px;
    color: #333;
  }

  .comments-panel__close {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 24px;
    color: #666;
    transition: color 0.3s;
  }

  .comments-panel__close:hover {
    color: #333;
  }

  .comments-panel__body {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
  }

  .comments-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .comment {
    display: flex;
    gap: 10px;
  }

  .comment__avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
  }

  .comment__avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .comment__body {
    flex: 1;
  }

  .comment__author {
    font-weight: 600;
    font-size: 14px;
    color: #333;
  }

  .comment__text {
    font-size: 14px;
    color: #555;
    margin: 5px 0;
    word-wrap: break-word;
  }

  .comment__time {
    font-size: 12px;
    color: #999;
  }

  .comments-panel__footer {
    padding: 15px;
    border-top: 1px solid #eee;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .comment-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
  }

  .comment-input:focus {
    outline: none;
    border-color: #2196F3;
    box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
  }

  .comments-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.3);
    z-index: 998;
  }

  .comments-overlay.active {
    display: block;
  }

  .comments-panel-open {
    overflow: hidden;
  }

  /* Message Button Styles */
  

  .sp-message-btn:hover {
    background-color: var(--secondary, #1976D2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
  }

  .sp-message-btn:active {
    transform: translateY(0);
  }

  .sp-profilebar {
    display: flex;
    align-items: center;
    gap: 10px; 
  }

  .sp-profilebar-left {
    display: flex;
    align-items: center;
    gap: 20px;
    flex: 1;
  }

  .sp-id {
    display: flex;
    align-items: center;
    gap: 60px;
    margin-top: 60px;
  }


  .sp-message-btn {
    background-color: var(--primary, #2196F3);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
    
    margin-left: 40px;  }
</style>

<main class="sp-page" aria-label="Service provider profile" service-id = "<?php echo $data['profile']->service_id; ?>">
  <!-- HERO (cover) -->
  <header class="sp-hero">
    <div class="sp-cover">
      <?php
        // Collect all available background images
        $backgroundImages = [];
        if (!empty($data['profile']->background_image)) {
            $backgroundImages[] = $data['profile']->background_image;
        }
        if (!empty($data['profile']->background_img_2)) {
            $backgroundImages[] = $data['profile']->background_img_2;
        }
        if (!empty($data['profile']->background_img_3)) {
            $backgroundImages[] = $data['profile']->background_img_3;
        }
        if (!empty($data['profile']->background_img_4)) {
            $backgroundImages[] = $data['profile']->background_img_4;
        }
      ?>
      <div class="background-slideshow" id="background-slideshow">
        <?php foreach($backgroundImages as $index => $image): ?>
          <img class="sp-cover__img <?php echo $index === 0 ? 'active' : ''; ?>"
               src="<?php echo URLROOT;?>/public/img/coverPhotos/<?php echo $image; ?>"
               alt="Background <?php echo $index + 1; ?>">
        <?php endforeach; ?>
      </div>
      <div class="sp-hero__content">

      </div>
      
    </div>

    <!-- Profile bar -->
    <div class="sp-profilebar">
      <div class="sp-profilebar-left">
        <figure class="sp-avatar">
          <img src="<?php echo URLROOT; ?>/public/img/profilePics/<?php echo $data['profile']->profile_pic; ?>" alt="Profile photo">
          <!-- <a class="sp-avatar__edit" href="#edit-photo" aria-label="Change profile photo">✎</a> -->
        </figure>

        <div class="sp-id">
          <div class="sp-name"><?php echo $data['profileV']->business_name;?></div>
          <button class="sp-message-btn" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/message/<?php echo $data['profile']->service_id; ?>'">
            <i class="fas fa-envelope"></i>  Message
          </button>
        </div>
      </div>
    </div>
  </header>

  <div>
    
  </div>


  <div class="sp-frame">
    <!-- INTRO -->
    <section class="card">
      <header class="card__head">
        <h2 class="card__title">Intro</h2>
        
      </header>

      <div class="intro">
        <p class="intro__bio">
         <?php echo $data['profile']->intro;?>
        </p>

        <div class="intro__tags" aria-label="Tags">
        </div>
      </div>
    </section>

    <!-- REVIEWS (read-only) -->
    <section class="card">
      <header class="card__head">
        <h2 class="card__title">Overall Reviews</h2>
      </header>

      <div class="reviews">
        <div class="reviews__bars">
          <!-- 1 to 5 bars -->
          <div class="bar"><span class="bar__label">1</span><span class="bar__track"><span class="bar__fill" style="--w:<?php echo $data['rating']->one_star_percentage; ?>%"></span></span></div>
          <div class="bar"><span class="bar__label">2</span><span class="bar__track"><span class="bar__fill" style="--w:<?php echo $data['rating']->two_star_percentage; ?>%"></span></span></div>
          <div class="bar"><span class="bar__label">3</span><span class="bar__track"><span class="bar__fill" style="--w:<?php echo $data['rating']->three_star_percentage; ?>%"></span></span></div>
          <div class="bar"><span class="bar__label">4</span><span class="bar__track"><span class="bar__fill" style="--w:<?php echo $data['rating']->four_star_percentage; ?>%"></span></span></div>
          <div class="bar"><span class="bar__label">5</span><span class="bar__track"><span class="bar__fill" style="--w:<?php echo $data['rating']->five_star_percentage; ?>%"></span></span></div>
        </div>

        <div class="reviews__score">
          Average Rating
          <div class="score__big"><?php echo $data['rating']->average_rating; ?></div>
          <div class="score__count"><?php echo $data['rating']->total_reviews; ?> reviews</div>
        </div>
      </div>
      <p class="note">This section is client-controlled and cannot be edited by the provider.</p>
    </section>

      <!-- AVAILABILITY CALENDAR -->
     <article class="card">
                <header class="card__head">
                  <h2 class="card__title">Availability Calendar</h2>
                </header>

                <div class="card__body">
                    <div class="cal">
                        <div class="cal__header">
                            <div class="cal__month">September 2025</div>
                            <div class="cal__nav">
                                <button class="cal__nav-btn" id="prev-month">←</button>
                                <button class="cal__nav-btn" id="next-month">→</button>
                            </div>
                        </div>

                        <div class="cal__dow">
                            <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                        </div>

                        <div class="cal__grid" id="calendar-grid">
                            <!-- Calendar days will be generated by JavaScript -->
                        </div>
                        
                        <div class="legend">
                           
                            <div class="legend-item">
                                <div class="legend-color legend-booked"></div>
                                <span>Booked</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color legend-unavailable"></div>
                                <span>Available</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color legend-today"></div>
                                <span>Today</span>
                            </div>
                           


                        </div>
                    </div>
                </div>
     </article>

    <!-- package section -->
     <section class="card" id="packages-section" style="display: none;">
      <header class="card__head">
        <h2 class="card__title">Our Packages</h2>
      </header>
      <div class="packages-horizontal-scroll">
        <div class="packages-grid-horizontal" id="packages-container">
          <!-- Packages will be dynamically inserted here -->
        </div>
      </div>
     </section>

    <!-- Package Popup -->
    <section class="package-popup-overlay" id="package-popup-overlay">
      <div class="package-popup" id="package-popup">
        <div class="popup-content">
          <span class="close-popup" id="close-popup">&times;</span>
          <h4 id="popup-package-title"></h4>
          <div class="popup-body">
            <div class="popup-image">
              <img id="popup-image" src="" alt="Package Image">
            </div>
            <div class="popup-details">
             
              <p id="popup-description"></p>
              
              <div class="popup-price">
                <span id="popup-price"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- UPLOAD SHORTCUTS -->
    <section class="uploader">
      
     
    </section>

    <!-- FEED POST 1 -->
    <?php foreach($data['EventsPosts'] as $post): ?>
    <article class="post card" data-event-id="<?php echo $post->event_id; ?>">
      <header class="post__head">
        <div class="post__author">
          <img class="post__avatar" src="<?php echo URLROOT; ?>/public/img/profilePics/<?php echo $data['profile']->profile_pic; ?>" alt="">
          <div>
            <div class="post__name"><?php echo $_SESSION['service_name']; ?></div>
            
            <div class="post__meta"><?php echo date('j F Y \a\t H:i', strtotime($post->created_at)); ?></div>
          </div>
        </div>
        
      </header>

      <h3 class="post__title"><?php echo $post->title; ?></h3>

      <p class="post__description"><?php echo $post->description; ?></p>

      <!--media carousel-->
      <div class="post__media-wrapper">
      <div class="post__media" data-event-id="<?php echo $post->event_id; ?>">
        
       
        <?php 

          $mediaCount = 0;
          $mediaArray = [];
            foreach($data['EventMedia'] as $media){
                if($media->event_id == $post->event_id){
                    $filePath = URLROOT . '/uploads/postsMedia/' . $media->file_path;
                    $fileType = pathinfo($media->file_path, PATHINFO_EXTENSION);
                    $mediaArray[] =[
                      'path' => $filePath,
                      'type' => $fileType
                    ];
                }
            }

            foreach($mediaArray as $index => $media){
                $filePath = $media['path'];
                $fileType = $media['type'];
                    
                    if(in_array(strtolower($fileType), ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo '<img src="' . $filePath . '" alt="Event Media" class="post__image">'; 
                    } elseif(in_array(strtolower($fileType), ['mp4', 'mov'])) {
                        echo '<video controls class="post__video">
                                <source src="' . $filePath . '" type="video/' . strtolower($fileType) . '">
                                Your browser does not support the video tag.
                              </video>';
                    }
                }     
        ?>
         
      </div>

      <?php if(count($mediaArray) > 1): ?>
          <!-- Left / Right nav -->
          <button class="media__nav media__nav--left" aria-label="Previous media">
           <i class="fa-solid fa-chevron-left"></i>
          </button>

          <button class="media__nav media__nav--right" aria-label="Next media">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        <?php endif; ?>

      <!--media dots indicator-->
      <?php if(count($mediaArray) > 1): ?>
        <div class="media__dots">
          <?php for($i = 0; $i < count($mediaArray); $i++): ?>
            <button class="media__dot <?php echo $i === 0 ?'active' : ''; ?>"
                data-index = "<?php echo $i; ?>"
                aria-lable = "Go to media <?php echo $i + 1; ?>"
                data-event-id="<?php echo $post->event_id; ?>"
            >
            </button>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    
      <footer class="post__actions">
        <!--like,comment-->
        <a  class="action" onclick="changecolour(this.querySelector('.likeicon'));">
            <img class="likeicon" src="<?php echo URLROOT; ?>/public/img/ServiceP/posts/like.svg" alt="Like Icon">
            <span class="like-count"><?php echo $post->like_count ?></span>
        </a>
        <a class="action">
            <img class="commenticon" src="<?php echo URLROOT; ?>/public/img/ServiceP/posts/comment.svg" alt="Comment Icon">
            <span class="comment-count">0</span>
        </a>
      </footer>

      <!-- Popup menu -->
      <div class="popup-menu" id="popup-<?php echo $post->event_id; ?>" style="display: none;">
        <div class="popup-menu__content">
          <button class="popup-menu__item edit-btn" data-event-id="<?php echo $post->event_id; ?>">Edit post</button>
          <button class="popup-menu__item delete-btn" data-event-id="<?php echo $post->event_id; ?>">Delete post</button>
          <button class="popup-menu__item add-media-btn" data-event-id="<?php echo $post->event_id; ?>">Add media</button>
          
        </div>
      </div>
    </article>
    <?php endforeach; ?>


  <!--comment section -->

  <!-- Comment section (side panel) -->
<aside class="comments-panel" id="comments-panel">
  <div class="comments-panel__header">
    <h2>Comments</h2>
    <button class="comments-panel__close" id="close-comments" aria-label="Close comments">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
      </svg>
    </button>
  </div>

  <div class="comments-panel__body">
    <div class="comments-container" id="comments-container">
      <!-- Comments will be dynamically loaded here -->
    </div>
  </div>
  <form class="comments-panel__footer" id="comment-form">
      <textarea 
        id="comment-input" 
        class="comment-input" 
        placeholder="Write a comment..." 
        rows="3"
      ></textarea>
      <button type="submit" class="btn btn--primary">Post Comment</button>
    </form>
  
</aside>

<!-- Overlay for side panel -->
<div class="comments-overlay" id="comments-overlay"></div>
</main>


<script>

    // Make PHP data available to JavaScript
    const URLROOT = '<?php echo URLROOT; ?>';
    const serverAvailabilityData = <?php echo json_encode($data['availability'] ?? []); ?>;
    const clientId = '<?php echo $_SESSION['client_id'] ?? ''; ?>';
    const providerId = '<?php echo $data['profile']->service_id ?? ''; ?>';

    let packages = []; // Global variable to store packages
   
    // Load packages
    function displayPackages(packagesData) {
        packages = packagesData; // Store packages globally
        const container = document.getElementById('packages-container');
        const packagesSection = document.getElementById('packages-section');
        
        // Hide section if no packages
        if (!packagesData || packagesData.length === 0) {
            if (packagesSection) {
                packagesSection.style.display = 'none';
            }
            return;
        }
        
        // Show section if there are packages
        if (packagesSection) {
            packagesSection.style.display = 'block';
        }
        
        if (!container) return;

        container.innerHTML = packages.map(pkg => `
            <div class="package-card" data-package-id="${pkg.id}">
                <img src="${URLROOT + '/img/packageImg/' + pkg.bg_image_name}" class="package-card__image" onerror="this.src='<?php echo URLROOT; ?>/public/img/ServiceP/posts/like.svg'">
                <div class="package-card__body">
                    <h3 class="package-card__name">${pkg.title}</h3>
                    <div class="package-card__price">₨${pkg.price}</div>
                    
                </div>
                <button class="package-card__button" onclick="event.stopPropagation(); showPackagePopup('${pkg.package_id}'); return false;">View Package</button>
            </div>
        `).join('');

        // Add click event listeners to entire card
        setTimeout(() => {
            document.querySelectorAll('.package-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't trigger if button was clicked
                    if (e.target.classList.contains('package-card__button')) {
                        return;
                    }
                    const packageId = this.dataset.packageId;
                    console.log('Card clicked, opening package:', packageId);
                    showPackagePopup(packageId);
                });
            });
        }, 100);
    }

    // Show package popup
    function showPackagePopup(packageId) {
        console.log('showPackagePopup called with ID:', packageId);
        
        // Find package by ID from the packages array
        const pkg = packages.find(p => p.package_id == packageId);
        console.log('Found package:', pkg);
        if (!pkg) {
            console.error('Package not found with ID:', packageId);
            return;
        }

        const overlay = document.getElementById('package-popup-overlay');
        const popup = document.getElementById('package-popup');

        if (!overlay || !popup) {
            console.error('Popup overlay or popup not found in DOM');
            return;
        }

        // Update popup content
        document.getElementById('popup-package-title').textContent = pkg.title;
        
        // Format details as bullet points
        const descriptionElement = document.getElementById('popup-description');
        const detailsText = pkg.details || 'No description available.';
        
        // Split by newlines and create bullet list
        const detailsArray = detailsText.split('\n').filter(item => item.trim().length > 0);
        if (detailsArray.length > 1) {
            const listHTML = '<ul class="details-list">' + 
                detailsArray.map(item => `<li>${item.trim()}</li>`).join('') + 
                '</ul>';
            descriptionElement.innerHTML = listHTML;
        } else {
            descriptionElement.textContent = detailsText;
        }
        
        document.getElementById('popup-image').src = URLROOT + '/img/packageImg/' + pkg.bg_image_name;
        document.getElementById('popup-image').alt = pkg.title;
        document.getElementById('popup-price').textContent = '₨' + pkg.price;

        overlay.classList.add('show');
        console.log('Popup displayed');
    }

    // Close popup
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('package-popup-overlay');
        const closeBtn = document.getElementById('close-popup');

        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                overlay.classList.remove('show');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    overlay.classList.remove('show');
                }
            });
        }

        // Load packages on page load
        getPackages();
    });


    //get package from database
function getPackages(){

    var xml = new XMLHttpRequest();

    xml.onload = function(){

        if(this.readyState == 4 && this.status == 200){
            var response = JSON.parse(this.responseText);
            console.log(response);
            displayPackages(response);
        }

    };

    xml.open("GET", URLROOT + "/Clients/getPackagesByProvider?service_id=" + providerId, true);
    xml.send();
}
</script>

<script src="<?php echo URLROOT; ?>/js/profile/profile.js"></script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>