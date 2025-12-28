<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Clients/allevents';
require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbarBack.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/packages.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/allservpro.css">

<form method="POST" action="<?php echo URLROOT; ?>/Clients/packages">

<!-- Packages Grid -->
    <section class="packages">
        <h1 style="text-align: center; font-size: 30px; margin-top: 70px;">Family Gatherings</h1>
        <h1>Past Successful Events</h1>
        <div class="packages-grid">
            <!-- Package Card 1 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/events/OIP (6).jpeg?height=200&width=300');" onclick="location.href='<?php echo URLROOT; ?>/clients/dummy';">
                </div>
                <h1 style="text-align: center; font-size: 20px;">Piyawara</h1>
            </div>

            <!-- Package Card 2 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/events/OIP (7).jpeg?height=200&width=300');" onclick="location.href='<?php echo URLROOT; ?>/clients/dummy';">
                </div>
                <h1 style="text-align: center; font-size: 20px;">Sathsara Sandella</h1>
            </div>
            <!-- Package Card 3 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/home/OIP (1).jpeg');" onclick="location.href='<?php echo URLROOT; ?>/clients/dummy';">
                </div>
                        <h1 style="text-align: center; font-size: 20px;">Samagiya</h1>
            </div>
</section>

                        <section class="container section-block">
      <h3 class="section-title">Available Service Providers</h3>

      <div class="card-grid">
        <!-- Card 1 -->
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>


        <!-- Card 3 -->
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

      </div>

      <div class="section-cta">
        <a href="#" class="btn outline" onclick="location.href='<?php echo URLROOT; ?>/clients/allservpro';">See All<span aria-hidden="true">→</span></a>
      </div>
    </section>
<section class="packages">
        <h1>Our Packages</h1>
        <div class="packages-grid">
            <!-- Package Card 1 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/home/image 12.svg?height=200&width=300');">
                    
                    <div class="package-overlay">
                        <h3>Golden Package</h3>
                        <ul>
                            <li>Two Albums</li>
                        </ul>
                        <div class="price">200,000/=</div>
                    </div>
                </div>
                <div class="package-footer">
                    <div class="provider">
                        <img src="<?php echo URLROOT; ?>/img/home/profile.svg?height=32&width=32" alt="Jenna Sullivan">
                        <div>
                            <div class="provider-name">Jenna Sullivan</div>
                            
                        </div>
                    </div>
                    <button type="button" class="view-package" onclick="location.href='<?php echo URLROOT; ?>/clients/viewpackage';">View Package →</button>
                </div>
            </div>

            <!-- Package Card 2 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/home/image 12.svg?height=200&width=300');">
                    
                    <div class="package-overlay">
                        <h3>Diamond Package</h3>
                        <ul>
                            <li>Two Albums</li>
                        </ul>
                        <div class="price">250,000/=</div>
                    </div>
                </div>
                <div class="package-footer">
                    <div class="provider">
                        <img src="<?php echo URLROOT; ?>/img/home/profile.svg?height=32&width=32" alt="Martin James">
                        <div>
                            <div class="provider-name">Martin James</div>
                        </div>
                    </div>
                    <button type="button" class="view-package" onclick="location.href='<?php echo URLROOT; ?>/clients/viewpackage';">View Package →</button>
                </div>
            </div>
            <!-- Package Card 3 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/home/image 12.svg?height=200&width=300');">
                    
                    <div class="package-overlay">
                        <h3>Silver Package</h3>
                        <ul>
                            <li>Two Albums</li>
                        </ul>
                        <div class="price">100,000/=</div>
                    </div>
                </div>
                <div class="package-footer">
                    <div class="provider">
                        <img src="<?php echo URLROOT; ?>/img/home/profile.svg?height=32&width=32" alt="Pavan uthsara">
                        <div>
                            <div class="provider-name">Pavan uthsara</div>
                        </div>
                    </div>
                    <button type="button" class="view-package" onclick="location.href='<?php echo URLROOT; ?>/clients/viewpackage';">View Package →</button>
                </div>
            </div>
</section>
        
    
    </form>
    <?php require APPROOT . '/views/inc/footer.php';?>