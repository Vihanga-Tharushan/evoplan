<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/profile';
require_once APPROOT . '/views/inc/components/taskbar/taskbar_back.php';
?>
<link rel="stylesheet" href="../public/css/components/servicesP/s_accountSettings.css">

<!-- Main content -->
<main class="content">
  <div class="grid">
    <!-- Right form card -->
    <section class="form-card">
      <header class="form-card__head">
        <h2>Profile Information</h2>
        <a class="undo" href="#" aria-label="Undo">
          <button id="logout">logout</button>
          <svg class="icon" viewBox="0 0 24 24"><path d="M9 9l-6 6 6 6" fill="none" stroke="currentColor" stroke-width="2"/><path d="M3 15h10a7 7 0 1 0-7-7" fill="none" stroke="currentColor" stroke-width="2"/></svg>
          Undo
        </a>
      </header>

      <div class="form-card__body">
        <form class="form">
          <div class="form__col">
            <label class="field">
              <span class="field__label">Name</span>
              <input class="input" type="text" value="Karen" />
            </label>

            <label class="field">
              <span class="field__label">Email</span>
              <input class="input" type="email" value="karen@example.com" />
            </label>

            <label class="field">
              <span class="field__label">Password</span>
              <div class="input-group">
                <input class="input" type="password" value="" />
                <button type="button" class="btn btn--light">Change</button>
              </div>
            </label>

            <label class="field">
              <span class="field__label">Phone Number</span>
              <input class="input" type="tel" placeholder="+94 7X XXX XXXX" />
            </label>

            <label class="field">
              <span class="field__label">Address</span>
              <input class="input" type="text" placeholder="Street, City" />
            </label>
          </div>

          <aside class="form__aside">
            <h3 class="aside__title">Profile Settings</h3>

            <div class="pill">
              <span class="dot"></span>
              Active Profile
            </div>

            <p class="muted">
              Your profile is currently active and visible to other users.
            </p>
          </aside>
        </form>
      </div>

      <footer class="form-card__foot">
        <button class="btn btn--light">Cancel</button>
        <button class="btn btn--dark">Save Changes</button>
      </footer>
    </section>
  </div>
</main>
</div>

