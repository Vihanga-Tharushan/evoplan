<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php 
$backUrl = URLROOT . '/Clients/packages';
require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_messages.css">
<main class="chat-shell" aria-label="Chat">
  <div class="chat-wrap">
    <!-- Left: conversation list -->
    <aside class="threads" aria-label="Conversations">
      <ul class="thread-list" role="list">
        
      <?php foreach( $data['conversationsList'] as $conversationList) : ?>
        <li class="thread <?php if ($conversationList->conversation_id == $data['messages'][0]->conversation_id) echo 'is-active'; ?>" data-conversation-id="<?php echo $conversationList->conversation_id; ?>" data-provider-id="<?php echo $conversationList->provider_id; ?>">
          <div class="thread__avatar">
            <div class="avatar" aria-hidden="true" role="img" <?php if($conversationList->conversation_id == $data['messages'][0]->conversation_id){ $img = $conversationList->profile_pic; } ?>style="background-image: url('<?php echo URLROOT; ?>/public/img/profilePics/<?php echo $conversationList->profile_pic; ?>')" alt="Avatar"></div>
            <span class="presence <?php if($_SESSION['service_id'] == $conversationList->provider_id) echo 'is-online'?>" aria-label="online"></span>
          </div>

          <div class="thread__body">
            <div class="thread__top">
              <div class="thread__name"><?php echo $conversationList->provider_name; ?></div>
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

    <section class="chat" id="chatsection" aria-label="Conversation">
      <div class="msgs" role="log" aria-live="polite">
       
        <!-- <div class="row out" id="rowin">
          <div class="bubble">
            <div class="bubble__text">Hi</div>
            <time class="bubble__time" datetime="01:49"></time>
          </div>
        </div>

        <div class="row in">
          <div class="who" aria-hidden="true" id="sample" ></div>
          <div class="bubble bubble--out">
            <div class="bubble__text">degrgegr</div>
            <time class="bubble__time" datetime="07:19"></time>
          </div>
        </div> -->
      </div>

      <!-- Composer -->
      <?php if(isset($data['conversation_id'])): ?>
      <form class="composer" id="message-form" method="post" >
        <div class="field">
          <input type="text" id="messageInput" name="message" placeholder="Type a message" aria-label="Message" required>
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
        <?php else: ?>
        <div class="composer">
          <div class="field">
            <input type="text" placeholder="Select a conversation to start messaging" aria-label="Message" disabled>
          </div>
        </div>
      <?php endif; ?>

    </section>
  </div>
</main>


<script>

  const URLROOT = '<?php echo URLROOT; ?>';
  const conversationID = '<?php echo addslashes($data['conversation_id'] ?? ''); ?>';
  const senderType = 'CLIENT'; 
  const senderID = '<?php echo addslashes($_SESSION['client_id'] ?? ''); ?>';
  const imgURL = '<?php echo URLROOT; ?>/public/img/profilePics/<?php echo $img ?? 'default.png'; ?>';
</script>

<script src="<?php echo URLROOT; ?>/js/message/messagesClient.js"></script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>