<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar5.php'; ?>

<link rel="stylesheet" href="../public/css/components/servicesP/s_messages.css">
<!-- Chat Component -->
<section class="chat-card" role="region" aria-label="Chat">
  <!-- Top bar -->
  <header class="chat-card__header">
    <div class="chat-card__brand">
      <div class="avatar avatar--sm" aria-hidden="true">C</div>
      <span class="chat-card__title">Chat</span>
    </div>

    <div class="chat-card__actions">
      <button class="btn btn--pill btn--primary">Clear chat</button>
      <button class="btn btn--text">More</button>
      <button class="btn btn--icon" aria-label="Close">
        <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
          <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>
    </div>
  </header>

  <div class="chat-card__content">
    <!-- Sidebar (threads) -->
    <aside class="chat-sidebar" aria-label="Conversations">
      <form class="chat-search" role="search">
        <span class="chat-search__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="18" height="18">
            <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" fill="none"/>
            <path d="M20 20l-3.2-3.2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </span>
        <input type="search" placeholder="Search" aria-label="Search conversations"/>
      </form>

      <ul class="thread-list" role="list">
        <li class="thread is-active" tabindex="0" aria-current="true">
          <div class="thread__avatar">
            <div class="avatar">L</div>
            <span class="presence is-online" aria-label="online"></span>
          </div>
          <div class="thread__body">
            <div class="thread__row">
              <span class="thread__name">Leslie Alexander</span>
              <time class="thread__time" datetime="2025-08-28T19:49">07:49 pm</time>
            </div>
            <div class="thread__snippet">Hi there, how are you?</div>
          </div>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar">A</div>
            <span class="presence is-online" aria-label="online"></span>
          </div>
          <div class="thread__body">
            <div class="thread__row">
              <span class="thread__name">Arlene McCoy</span>
              <time class="thread__time">04:02 am</time>
            </div>
            <div class="thread__snippet">(217) 555-0103</div>
          </div>
          <span class="badge badge--danger" aria-label="6 unread">6</span>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar">R</div>
          </div>
          <div class="thread__body">
            <div class="thread__row">
              <span class="thread__name">Ralph Edwards</span>
              <time class="thread__time">02:41 am</time>
            </div>
            <div class="thread__snippet">Wokingham, Thames</div>
          </div>
          <span class="badge badge--danger" aria-hidden="true">•</span>
        </li>

        <!-- Add more <li class="thread">…</li> items as needed -->
      </ul>
    </aside>

    <!-- Conversation panel -->
    <section class="chat-panel" aria-label="Conversation">
      <div class="messages" role="log" aria-live="polite">
        <div class="msg-row in">
          <time class="msg-time" datetime="01:49">01:49</time>
          <div class="msg">Hi there, How are you?</div>
        </div>

        <div class="msg-row in">
          <time class="msg-time" datetime="01:50">01:50</time>
          <div class="msg">Waiting for your reply. As we have fixed the date for all conventions this month, I have a long travel plan.</div>
        </div>

        <div class="msg-row out">
          <time class="msg-time" datetime="07:42">07:42</time>
          <div class="msg msg--out">Hi, I am sending all the receipts to you shortly, the network is terrible at my end.</div>
        </div>

        <div class="msg-row in">
          <time class="msg-time" datetime="07:49">07:49</time>
          <div class="msg">Thank you very much for the confirmation. I will verify when I get the receipts.</div>
        </div>
      </div>

      <form class="composer" action="#" onsubmit="return false;">
        <div class="composer__field">
          <input type="text" placeholder="Type a message" aria-label="Message" />
          <div class="composer__tools">
            <button class="btn btn--icon" type="button" aria-label="Emoji">
              <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                <circle cx="9" cy="10" r="1.2" fill="currentColor"/>
                <circle cx="15" cy="10" r="1.2" fill="currentColor"/>
                <path d="M8 14c1.2 1 2.4 1.5 4 1.5S14.8 15 16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none"/>
              </svg>
            </button>
            <button class="btn btn--icon" type="button" aria-label="Attach">
              <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                <path d="M8 12l6-6a4 4 0 115.6 5.6l-8.2 8.2a6 6 0 11-8.5-8.5l7.1-7.1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
            <button class="btn btn--icon btn--send" type="submit" aria-label="Send">
              <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                <path d="M4 12l16-8-5.5 8L20 20 4 12z" fill="currentColor"/>
              </svg>
            </button>
          </div>
        </div>
      </form>
    </section>
  </div>
</section>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>