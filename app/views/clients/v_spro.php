<?php require_once APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/client/spro.css">


<main class="sp-page" aria-label="Service provider profile">
  <!-- HERO (cover) -->
  <header class="sp-hero">
    <div class="sp-cover">
      
      <img class="sp-cover__img" src="https://images.unsplash.com/photo-1484712401471-05c7215830eb?q=80&w=1600&auto=format&fit=crop" alt="">
      <div class="sp-hero__content">
        <ul class="sp-hero__tags" aria-label="Specialties">
        </ul>
      </div>
    </div>

    <!-- Profile bar -->
    <div class="sp-profilebar">
      <figure class="sp-avatar">
        <img src="https://i.pravatar.cc/160?img=11" alt="Profile photo">
        <a class="sp-avatar__edit" href="#edit-photo" aria-label="Change profile photo">✎</a>
      </figure>

      <div class="sp-id">
        <div class="sp-name">Bathiya dahanayake</div>
        <div class="sp-meta">4,8K friends</div>
      </div>
    </div>
  </header>

  <div class="sp-frame">
    <!-- INTRO -->
    <section class="card">
      <header class="card__head">
        <h2 class="card__title">Intro</h2>
      </header>

      <div class="intro">
        <p class="intro__bio">
          I’m a professional photographer. You can easily connect with me and save your memories with you forever.
        </p>

        <div class="intro__tags" aria-label="Tags">
          <span class="tag">---------</span>
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
          <div class="bar"><span class="bar_label">1</span><span class="bartrack"><span class="bar_fill" style="--w:65%"></span></span></div>
          <div class="bar"><span class="bar_label">2</span><span class="bartrack"><span class="bar_fill" style="--w:42%"></span></span></div>
          <div class="bar"><span class="bar_label">3</span><span class="bartrack"><span class="bar_fill" style="--w:28%"></span></span></div>
          <div class="bar"><span class="bar_label">4</span><span class="bartrack"><span class="bar_fill" style="--w:60%"></span></span></div>
          <div class="bar"><span class="bar_label">5</span><span class="bartrack"><span class="bar_fill" style="--w:80%"></span></span></div>
        </div>

        <div class="reviews__score">
          <div class="score__big">4.0</div>
          <div class="score__stars" aria-label="4 out of 5 stars">
            <span class="star star--on">★</span><span class="star star--on">★</span><span class="star star--on">★</span><span class="star star--on">★</span><span class="star">★</span>
          </div>
          <div class="score__count">500 reviews</div>
        </div>
      </div>
      <p class="note">This section is client-controlled and cannot be edited by the provider.</p>
    </section>

    <!-- AVAILABILITY -->
    <section class="grid-2">
      <!-- Calendar -->
      <article class="card">
        <header class="card__head">
          <h2 class="card__title">Available Days</h2>
        </header>
        <div class="cal">
          <div class="cal_row cal_row--head">
            <div class="cal__month">September, 2022</div>
            <div class="cal__caret">▾</div>
          </div>

          <div class="cal__dow">
            <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
          </div>

          <div class="cal__grid">
            <!-- leading blanks for Sep 2022 (Thu start) -->
            <span class="cal_day cal_day--pad"></span>
            <span class="cal_day cal_day--pad"></span>
            <span class="cal_day cal_day--pad"></span>
            <span class="cal__day">1</span>
            <span class="cal__day">2</span>
            <span class="cal__day">3</span>
            <span class="cal__day">4</span>
            <span class="cal__day">5</span>
            <span class="cal__day">6</span>
            <span class="cal__day">7</span>
            <span class="cal__day">8</span>
            <span class="cal__day">9</span>
            <span class="cal__day">10</span>
            <span class="cal__day">11</span>
            <span class="cal__day">12</span>
            <span class="cal__day">13</span>
            <span class="cal__day">14</span>
            <span class="cal__day">15</span>
            <span class="cal__day">16</span>
            <span class="cal__day">17</span>
            <span class="cal__day">18</span>
            <span class="cal_day cal_day--avail">19</span>
            <span class="cal_day calday--avail cal_day--current">20</span>
            <span class="cal__day">21</span>
            <span class="cal_day cal_day--avail">22</span>
            <span class="cal__day">23</span>
            <span class="cal__day">24</span>
            <span class="cal__day">25</span>
            <span class="cal__day">26</span>
            <span class="cal__day">27</span>
            <span class="cal_day cal_day--avail">28</span>
            <span class="cal_day cal_day--outline">29</span>
            <span class="cal__day">30</span>
          </div>
        </div>
      </article>

      <!-- Add Date -->
      <aside class="card">
        <header class="card__head">
          <h2 class="card__title">Add Date</h2>
        </header>

        <form class="adddate" method="post" action="#">
          <label class="field">
            <span class="field__label">From</span>
            <input class="input" type="date" required>
          </label>

          <label class="field">
            <span class="field__label">To</span>
            <input class="input" type="date" required>
          </label>

          <div class="row-actions">
            <button type="submit" class="btn btn--primary">Marks as Available</button>
            <a class="btn btn--light" href="#">View Events</a>
          </div>
        </form>
      </aside>
    </section>


    <!-- FEED POST 1 -->
    <article class="post card">
      <header class="post__head">
        <div class="post__author">
          <img class="post__avatar" src="https://i.pravatar.cc/40?img=11" alt="">
          <div>
            <div class="post__name"></div>
            <div class="post__meta">7 September 2024 · 14:28 · •</div>
          </div>
        </div>
        <button class="btn btn--icon" aria-label="More">⋯</button>
      </header>

      <h3 class="post__title">Eli’s Birthday</h3>

      <div class="post__media">
        <img src="https://images.unsplash.com/photo-1582771498000-8afe5166fbd8?q=80&w=800&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1487412912498-0447578fcca8?q=80&w=800&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1567958451986-2de427a4a4dc?q=80&w=800&auto=format&fit=crop" alt="">
      </div>

      
    </article>

    <!-- FEED POST 2 -->
    <article class="post card">
      <header class="post__head">
        <div class="post__author">
          <img class="post__avatar" src="https://i.pravatar.cc/40?img=11" alt="">
          <div>
            <div class="post__name">Bathiya dahanayake</div>
            <div class="post__meta">7 September 2024 · 14:28 · •</div>
          </div>
        </div>
        <button class="btn btn--icon" aria-label="More">⋯</button>
      </header>

      <h3 class="post__title">Jack and Rose</h3>

      <div class="post__media">
        <img src="https://images.unsplash.com/photo-1542037104857-ffbb0b9155fb?q=80&w=800&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=800&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?q=80&w=800&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1487412912498-0447578fcca8?q=80&w=800&auto=format&fit=crop" alt="">
      </div>

      
    </article>
  </div>

  <!-- CSS-only Edit Bio modal -->
  <div id="edit-bio" class="modal" role="dialog" aria-modal="true" aria-labelledby="bio-title">
    <a href="#" class="modal__scrim" aria-hidden="true"></a>
    <form class="modal__panel" method="post" action="#">
      <header class="modal__head">
        <h3 id="bio-title">Edit Bio</h3>
        <a class="modal__close" href="#" aria-label="Close">×</a>
      </header>
      <textarea class="input input--area" rows="5" placeholder="Write your bio...">I’m a professional photographer. You can easily connect with me and save your memories with you forever.</textarea>
      <div class="modal__actions">
        <a class="btn btn--light" href="#">Cancel</a>
        <button class="btn btn--primary" type="submit">Save</button>
      </div>
    </form>
  </div>

  <!-- CSS-only Edit Tags modal -->
  <div id="edit-tags" class="modal" role="dialog" aria-modal="true" aria-labelledby="tags-title">
    <a href="#" class="modal__scrim" aria-hidden="true"></a>
    <form class="modal__panel" method="post" action="#">
      <header class="modal__head">
        <h3 id="tags-title">Edit Tags</h3>
        <a class="modal__close" href="#" aria-label="Close">×</a>
      </header>
      <div class="tags-editor">
        <input class="input" type="text" placeholder="e.g. Photography, Portraits" value="Photography">
      </div>
      <div class="modal__actions">
        <a class="btn btn--light" href="#">Cancel</a>
        <button class="btn btn--primary" type="submit">Save</button>
      </div>
    </form>
  </div>
</main>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>