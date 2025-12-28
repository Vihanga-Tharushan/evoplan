<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar5.php'; ?>
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
      <ul class="thread-list" role="list">
        <?php foreach( $data['conversationsList'] as $conversationList) : ?>
        <li class="thread <?php echo isset($data['conversation_id']) && $data['conversation_id'] == $conversationList->conversation_id ? 'is-active' : ''; ?>" data-conversation-id="<?php echo $conversationList->conversation_id; ?>" data-client-id ="<?php echo $conversationList->client_id; ?>"  >
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true" role="img" <?php //if ($conversationList->conversation_id == $data['messages'][0]->conversation_id){ $img = $conversationList->profile_pic; } ?>style="background-image: url('<?php echo URLROOT; ?>/public/img/profilePics/<?php echo $conversationList->profile_pic; ?>')" alt="Avatar"></div>
            <span class="presence <?php if($_SESSION['client_id'] == $conversationList->client_id) echo 'is-online'?>" aria-label="online"></span>
          </div>

          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name"><?php echo $conversationList->name; ?></div>
              <time class="thread__time" datetime="14:41"><?php echo $conversationList->last_message_time; ?></time>
            </div>
            <div class="thread__snippet"><?php echo $conversationList->last_message; ?></div>
          </div>
          <!-- <span class="badge">3</span> -->
        </li>
      <?php endforeach; ?>
      </ul>
    </aside>

    <!-- Right: chat panel -->
    <section class="chat" aria-label="Conversation">
      <div class="msgs" role="log" aria-live="polite">
        <!-- <div class="row in">
          <div class="who" aria-hidden="true"  style="background-image: url('https://i.pravatar.cc/150?img=9')"></div>
          <div class="bubble">
            <div class="bubble__text">Hi there, how are you?</div>
            <time class="bubble__time" datetime="01:49">01:49</time>
          </div>
        </div>

        <div class="row out">
          <div class="bubble bubble--out">
            <div class="bubble__text">Hi, I am sending all the receipts to you shortly; the network is terrible at my end.</div>
            <time class="bubble__time" datetime="07:19">07:19</time>
          </div>
        </div> -->

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
        const senderType = 'PROVIDER';
        const senderID = '<?php echo ($_SESSION['service_id']); ?>';
        const imgURL = '<?php echo URLROOT; ?>/public/img/profilePics/<?php echo isset($img) ? $img : 'default.png'; ?>';

        
</script>


<script src="<?php echo URLROOT; ?>/js/message/messagesSP.js"></script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>