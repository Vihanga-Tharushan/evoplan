<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbar.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar3.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/packages.css">

    <!-- Hero Section -->
     
    <!-- Categories -->
    <section class="categories">
        <div class="category-item">
            <img src="<?php echo URLROOT; ?>/img/home/camera.svg" alt="Photography" onclick="location.href='<?php echo URLROOT; ?>/clients/allphotography';">
            <i class="fas fa-camera"></i>
            <span>Photography</span>
        </div>
        <div class="category-item">
            <img src="<?php echo URLROOT; ?>/img/home/HouseLine.svg" alt="Venue" onclick="location.href='<?php echo URLROOT; ?>/clients/allvenues';">
            <i class="fas fa-building"></i>
            <span>Venue</span>
        </div>
        <div class="category-item">
            <img src="<?php echo URLROOT; ?>/img/home/MusicNotesPlus.svg" alt="Music" onclick="location.href='<?php echo URLROOT; ?>/clients/allmusic';">
            <i class="fas fa-music"></i>
            <span>Music</span>
        </div>
        <div class="category-item">
            <img src="<?php echo URLROOT; ?>/img/home/Cake.svg" alt="Birthday Cake" onclick="location.href='<?php echo URLROOT; ?>/clients/allcakedesigners';">
            <i class="fas fa-birthday-cake"></i>
            <span>Cake designers & Florist</span>
        </div>
        <div class="category-item">
            <img src="<?php echo URLROOT; ?>/img/home/Sparkle.svg" alt="Decorator" onclick="location.href='<?php echo URLROOT; ?>/clients/alldecorators';">
            <i class="fas fa-star"></i>
            <span>Decorators</span>
        </div>
        <div class="category-item">
            <img src="<?php echo URLROOT; ?>/img/home/Armchair.svg" alt="Event Equipments" onclick="location.href='<?php echo URLROOT; ?>/clients/allequipments';">
            <i class="fas fa-tools"></i>
            <span>Event Equipments</span>
        </div>
        <div class="category-item">
            <img src="<?php echo URLROOT; ?>/img/home/MicrophoneStage.svg" alt="Entertainers" onclick="location.href='<?php echo URLROOT; ?>/clients/allentertainers';">
            <i class="fas fa-masks-theater"></i>
            <span>Entertainers</span>
        </div>
        <div class="category-item">
            <img src="<?php echo URLROOT; ?>/img/home/truck.svg" alt="Transport" onclick="location.href='<?php echo URLROOT; ?>/clients/alltransport';">
            <i class="fas fa-palette"></i>
            <span>Transpot</span>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="packages">
     <div class="packages-grid">
    <?php foreach($data['packages'] as $package) : ?>
    <article class="pkg-card tier--diamond">
      <figure class="pkg-media">
        <img src="<?php echo URLROOT; ?>/Public/img/packageImg/<?php echo $package->bg_image_name; ?>" alt="Camera on table">
        <div class="pkg-overlay">
          <div class="pkg-top">
            <h3 class="pkg-title"><?php echo $package->title; ?></h3>
            <ul class="pkg-list">
              <li><?php echo $package->details; ?></li>
            </ul>
            <div class="pkg-price"><?php echo $package->price; ?></div>
          </div>

          <a class="pkg-author" href="<?php echo URLROOT;?>/Clients/viewprovider/<?php echo $package->service_id ?>">
            <div class="avatar"><img src="<?php echo URLROOT; ?>/img/profilePics/<?php echo $package->profile_pic?>" alt=""></div>
            <div class="author-text">
              <div class="author-name"><?php echo $package->provider_name; ?></div>
            </div>
          </a>
        </div>
      </figure>
      
      <a class="pkg-link" href="<?php echo URLROOT; ?>/Package/viewPackage/<?php echo $package->package_id?>">View&nbsp;Package →</a>
      
    </article>
    <?php endforeach; ?>
     </div>
    </section>
</form>

    
<script>

        const profilelink = document.getElementsByClassName('pkg-author');
        for(let i=0; i<profilelink.length; i++){
            profilelink[i].addEventListener('click', function(){
                const providerName = "<?php echo $package->provider_name; ?>";
                window.location.href = "<?php echo URLROOT; ?>/clients/viewprovider/" + providerName;
            });
        }

</script>
<?php require APPROOT . '/views/inc/footer.php';?>