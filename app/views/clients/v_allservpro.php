<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Clients/home';
require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbarBack.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/allservpro.css">
 

  <main>
    <br> <br> <br>
    <!-- HERO / SLIDER (pure CSS radios) -->
    <section class="container hero">
      <!-- slides toggles -->
      <input type="radio" name="hero" id="s1" checked>
      <input type="radio" name="hero" id="s2">
      <input type="radio" name="hero" id="s3">

      <div class="hero-track">
        <!-- Slide 1 -->
        <article class="hero-slide"
          style="--bg:url('https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=1600&auto=format&fit=crop');">
          <div class="hero-content">
            <h1 class="hero-title">Mavisuru Ragasoba</h1>
            <p class="hero-sub">Wonder Girls 2010 Wonder Girls World Tour – San Francisco</p>
          </div>
        </article>

        <!-- Slide 2 -->
        <article class="hero-slide"
          style="--bg:url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1600&auto=format&fit=crop');">
          <div class="hero-content">
            <h1 class="hero-title">Summer Gala</h1>
            <p class="hero-sub">Plan elegant evenings with curated service providers.</p>
            <a href="#" class="btn primary">Learn More</a>
          </div>
        </article>

        <!-- Slide 3 -->
        <article class="hero-slide"
          style="--bg:url('https://images.unsplash.com/photo-1489515217757-5fd1be406fef?q=80&w=1600&auto=format&fit=crop');">
          <div class="hero-content">
            <h1 class="hero-title">Concert Nights</h1>
            <p class="hero-sub">From sound to lights—book everything in one place.</p>
            <a href="#" class="btn primary">Learn More</a>
          </div>
        </article>
      </div>

      <!-- arrows -->
      <div class="hero-arrows">
        <label for="s1" class="arrow a1" aria-label="Slide 1">‹</label>
        <label for="s2" class="arrow a2" aria-label="Slide 2">›</label>

        <label for="s2" class="arrow a3" aria-label="Slide 2">‹</label>
        <label for="s3" class="arrow a4" aria-label="Slide 3">›</label>

        <label for="s3" class="arrow a5" aria-label="Slide 3">‹</label>
        <label for="s1" class="arrow a6" aria-label="Slide 1">›</label>
      </div>

      <!-- dots -->
      <div class="hero-dots" role="tablist" aria-label="Slide selector">
        <label for="s1" role="tab" aria-selected="true"></label>
        <label for="s2" role="tab"></label>
        <label for="s3" role="tab"></label>
      </div>
    </section>

    <!-- Featured providers header -->
    <section class="container featured-head">
      <h2>Featured Service Providers</h2>
      <p>Discover amazing Service Providers on our platform ready to make your dream event true.</p>
    </section>

    <!-- Venues and Halls -->
    <section class="container section-block">
      <h3 class="section-title">Venues and Halls</h3>

      <div class="card-grid">
        <!-- Card 1 -->
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1519167758481-83f550bb49a0?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1524156868115-9914f3c0e21f?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>
      </div>

      <div class="section-cta">
        <a href="#" class="btn outline" onclick="location.href='<?php echo URLROOT; ?>/clients/allvenuep';">Explore All Venue Providers <span aria-hidden="true">→</span></a>
      </div>
    </section>

    <!-- Photographers and Videographers -->
    <section class="container section-block">
      <h3 class="section-title">Photographers and Videographers</h3>

      <div class="card-grid">
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1519677100203-a0e668c92439?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro'; ">View Portfolio</a>
          </div>
        </article>
      </div>

      <div class="section-cta">
        <a href="#" class="btn outline" onclick="location.href='<?php echo URLROOT; ?>/clients/allphotographyp';">Explore All Photographers <span aria-hidden="true">→</span></a>
      </div>
    </section>
    <!-- Music and DJ Services -->
    <section class="container section-block">
      <h3 class="section-title">Music and Dj Services</h3>

      <div class="card-grid">
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1519677100203-a0e668c92439?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>
      </div>

      <div class="section-cta">
        <a href="#" class="btn outline" onclick="location.href='<?php echo URLROOT; ?>/clients/musics';">Explore All Musicians <span aria-hidden="true">→</span></a>
      </div>
    </section>
    <!-- Florists and Cake Designers -->
    <section class="container section-block">
      <h3 class="section-title">Florists and Cake Designers</h3>

      <div class="card-grid">
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1519677100203-a0e668c92439?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>
      </div>

      <div class="section-cta">
        <a href="#" class="btn outline" onclick="location.href='<?php echo URLROOT; ?>/clients/allcakes';">Explore All Cake Designers <span aria-hidden="true">→</span></a>
      </div>
    </section>
    <!-- Decorators and Event Stylists -->
    <section class="container section-block">
      <h3 class="section-title">Decorators and Event Stylists</h3>

      <div class="card-grid">
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1519677100203-a0e668c92439?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>
      </div>

      <div class="section-cta">
        <a href="#" class="btn outline" onclick="location.href='<?php echo URLROOT; ?>/clients/alldecoratorsp';">Explore All Decorators <span aria-hidden="true">→</span></a>
      </div>
    </section>
    <!-- Event Equipment and Rentals -->
    <section class="container section-block">
      <h3 class="section-title">Event Equipment and Rentals</h3>

      <div class="card-grid">
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1519677100203-a0e668c92439?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>
      </div>
      <div class="section-cta">
        <a href="#" class="btn outline" onclick="location.href='<?php echo URLROOT; ?>/clients/allequipmentsp';">Explore All Equipment Suppliers <span aria-hidden="true">→</span></a>
      </div>
    </section>
    <!-- Hosts, MCs and Entertainers -->
    <section class="container section-block">
      <h3 class="section-title">Hosts, MCs and Entertainers</h3>

      <div class="card-grid">
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1519677100203-a0e668c92439?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>
      </div>

      <div class="section-cta">
        <a href="#" class="btn outline" onclick="location.href='<?php echo URLROOT; ?>/clients/allhosts';">Explore All Entertainers <span aria-hidden="true">→</span></a>
      </div>
    </section>
    <!-- Transport and Logistics Services -->
    <section class="container section-block">
      <h3 class="section-title">Transport and Logistics Services</h3>

      <div class="card-grid">
        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1519677100203-a0e668c92439?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>

        <article class="provider-card" style="--img:url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&auto=format&fit=crop');">
          <button class="plus" aria-label="Add to list">+</button>
          <div class="card-overlay">
            <a href="#" class="btn ghost" onclick="location.href='<?php echo URLROOT; ?>/clients/spro';">View Portfolio</a>
          </div>
        </article>
      </div>

      <div class="section-cta">
        <a href="#" class="btn outline" onclick="location.href='<?php echo URLROOT; ?>/clients/alltransportp';">Explore All Services <span aria-hidden="true">→</span></a>
      </div>
    </section>
  </main>
</body>
</html>
<?php require APPROOT . '/views/inc/footer.php';?>