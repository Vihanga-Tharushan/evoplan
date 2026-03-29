<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>
<link rel="stylesheet" href="../public/css/components/servicesP/s_messages.css">
<main class="chat-shell" aria-label="Chat">
  <!-- Top search -->
  <header class="chat-top">
    <form class="search" role="search" aria-label="Search conversations">
      <input type="search" placeholder="Search" aria-label="Search conversations">
    </form>
  </header>

  <div class="chat-wrap">
    <!-- Left: conversation list -->
    <aside class="threads" aria-label="Conversations">
      <ul class="thread-list" role="list">
        <li class="thread is-active" tabindex="0" aria-current="true">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true"></div>
            <span class="presence is-online" aria-label="online"></span>
          </div>
          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name">Leslie Alexander</div>
              <time class="thread__time" datetime="19:49">07:49 pm</time>
            </div>
            <div class="thread__snippet">Hi there, How are you doing?</div>
          </div>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true"></div>
            <span class="presence is-online" aria-label="online"></span>
          </div>
          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name">Arlene McCoy</div>
              <time class="thread__time" datetime="04:02">04:02 am</time>
            </div>
            <div class="thread__snippet">(217) 555-0113</div>
          </div>
          <span class="badge" aria-label="6 unread">6</span>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true"></div>
          </div>
          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name">Ralph Edwards</div>
              <time class="thread__time" datetime="14:41">02:41 pm</time>
            </div>
            <div class="thread__snippet">Working now, Thanks</div>
          </div>
          <span class="badge">3</span>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true"></div>
          </div>
          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name">Marvin McKinney</div>
              <time class="thread__time">05:02 am</time>
            </div>
            <div class="thread__snippet">Big Kahuna Burger Ltd.</div>
          </div>
          <span class="badge">6</span>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true"></div>
          </div>
          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name">Bessie Cooper</div>
              <time class="thread__time">05:01 pm</time>
            </div>
            <div class="thread__snippet">http://www.zotware.com</div>
          </div>
          <span class="badge">7</span>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true"></div>
          </div>
          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name">Guy Hawkins</div>
              <time class="thread__time">04:54 pm</time>
            </div>
            <div class="thread__snippet">tienlapspktnd@gmail.com</div>
          </div>
          <span class="badge">21</span>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true"></div>
          </div>
          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name">Devon Lane</div>
              <time class="thread__time">—</time>
            </div>
            <div class="thread__snippet">Dec 7, 2019 23:26</div>
          </div>
          <span class="badge">4</span>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true"></div>
          </div>
          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name">Savannah Nguyen</div>
              <time class="thread__time">03:41 pm</time>
            </div>
            <div class="thread__snippet">The long barrow was built on land previously</div>
          </div>
        </li>

        <li class="thread">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true"></div>
          </div>
          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name">Devon Lane</div>
              <time class="thread__time">02:41 pm</time>
            </div>
            <div class="thread__snippet">inhabited in the Mesolithic period…</div>
          </div>
        </li>
      </ul>
    </aside>

    <!-- Right: chat panel -->
    <section class="chat" aria-label="Conversation">
      <div class="msgs" role="log" aria-live="polite">
        <div class="row in">
          <div class="who"></div>
          <time class="t">01:49</time>
          <div class="bubble">Hi there, How are you?</div>
        </div>

        <div class="row in">
          <div class="who"></div>
          <time class="t">01:49</time>
          <div class="bubble">Waiting for your reply. As we have fixed the date for all conventions this month, I have a long travel plan.</div>
        </div>

        <div class="row out">
          <time class="t">07:19</time>
          <div class="bubble bubble--out">Hi, I am sending all the receipts to you shortly; the network is terrible at my end.</div>
        </div>

        <div class="row in">
          <div class="who"></div>
          <time class="t">07:49</time>
          <div class="bubble">Thank you very much for the confirmation. I will verify when I get the receipts.</div>
        </div>
      </div>

      <!-- Composer -->
      <form class="composer" action="#" method="post">
        <div class="field">
          <input type="text" placeholder="Type a message" aria-label="Message">
          <div class="tools">
            <!-- Emoji -->
            <button class="icon" type="button" aria-label="Emoji">
              <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
                <circle cx="9" cy="10" r="1.3" fill="currentColor"/>
                <circle cx="15" cy="10" r="1.3" fill="currentColor"/>
                <path d="M8 14c1.3 1.1 2.6 1.7 4 1.7s2.7-.6 4-1.7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </button>
            <!-- Attach -->
            <label class="icon" aria-label="Attach">
              <input type="file" hidden>
              <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                <path d="M8 12l6-6a4 4 0 115.6 5.6l-8.2 8.2a6 6 0 11-8.5-8.5l7.1-7.1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </label>
            <!-- Send -->
            <button class="send" type="submit" aria-label="Send">
              <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                <path d="M4 12l16-8-6 8 6 8-16-8z" fill="currentColor"/>
              </svg>
            </button>
          </div>
        </div>
      </form>
    </section>
  </div>
</main>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>