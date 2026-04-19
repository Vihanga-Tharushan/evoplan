<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_messages.css">
<main class="chat-shell" aria-label="Chat">
  <!-- Top search -->
  <!-- <header class="chat-top">
    <form class="search" role="search" aria-label="Search conversations">
      <input type="search" placeholder="Search" aria-label="Search conversations">
    </form>
  </header> -->

  <div class="chat-wrap">
    <!-- Left: conversation list -->
    <aside class="threads" aria-label="Conversations">
      <ul class="thread-list" role="list" id="conversationsList">
        <!-- Conversations loaded dynamically -->
      </ul>
    </aside>

    <!-- Right: chat panel -->
    <section class="chat" aria-label="Conversation">
      <div class="msgs" role="log" aria-live="polite">
        <!-- Messages loaded dynamically -->
      </div>

      <!-- Composer(hidden by default)-->
      <form class="composer" id="message-form" method="post" style="display:none;" >
        <div class="field">
          <input type="text" id="messageInput" name="message" placeholder="Type a message" aria-label="Message" >
          <div class="tools">
            
            <!-- Send -->
            <button class="send" type="submit" id="submitbtn" aria-label="Send">
              <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                <path d="M4 12l16-8-6 8 6 8-16-8z" fill="currentColor"/>
              </svg>
            </button>
          </div>
        </div>
      </form> 
      <!-- If no conversation is selected -->
        <div class="composer-placeholder" id="composerPlaceholder">
          <div class="field">
            <input type="text" placeholder="Select a conversation to start messaging" aria-label="Message" disabled>
          </div>
        </div>
      
    </section>
  </div>
</main>


<script>

  const URLROOT = '<?php echo URLROOT; ?>';
  const senderType = 'ISSUE_COORDINATOR'; 
  const senderID = '<?php echo addslashes($_SESSION['ic_id'] ?? ''); ?>';
  const imgURL = '<?php echo URLROOT; ?>/public/img/profilePics/default.png';

</script>

<script src="<?php echo URLROOT; ?>/js/message/mainMessageCoordinator.js"></script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>