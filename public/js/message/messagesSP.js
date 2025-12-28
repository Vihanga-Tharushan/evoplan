var conversationID = null;

// Store current editing message ID
var editingMessageId = null;

//=========thread section =========

//change message threads to another conversation
var threads = document.querySelectorAll('.thread');
threads.forEach(function(thread) {
    thread.addEventListener('click', function(e) {
        
        e.preventDefault();

        var client_ID = this.getAttribute('data-client-id');
        var conv_ID = this.getAttribute('data-conversation-id');

        //remove active class from all threads
        threads.forEach(function(t) {
            t.classList.remove('is-active');
        });
        thread.classList.add('is-active');

        conversationID = conv_ID;

        //show composer
        document.getElementById("message-form").style.display = "block";
        document.getElementById("composerPlaceholder").style.display = "none";

        document.querySelector(".msgs").innerHTML = "";
        fetchMessages();
    }); 
});

// ========== MESSAGING UI ==========
var messageInput = document.getElementById("messageInput");
var submitbtn = document.getElementById("submitbtn");

if(submitbtn){
submitbtn.addEventListener("click", sendMessage);
}
DOMcintentLoaded = document.addEventListener("DOMContentLoaded", fetchMessages);

function sendMessage(event) {
  if (event) event.preventDefault();
  var message = messageInput.value;
  
  if (message.trim() === "") {
      alert("Message cannot be empty.");
      return;

  }
  if(editingMessageId){
      // Edit existing message
      updateMessage(editingMessageId, message);
  }
  else{
     var data = {
          conversation_id: conversationID,
          sender_type: senderType,
          sender_id: senderID,
          message: message,
          status : "sent"
      };
      send_data(data);
  }
  //CLEAR INPUT FIELD
    messageInput.value = "";
    
    //clear existing messages to avoid duplication
    document.querySelector(".msgs").innerHTML = "";
    //display new message immediately
    fetchMessages();
   
}


function send_data(data){
    var xml = new XMLHttpRequest();
    
    xml.onload = function() {
        if (this.readyState == 4 || this.status == 200) {
            //alert(xml.responseText);
        }
    };

    var datastring = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Message/sendMessage", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(datastring);
}

function fetchMessages(){
   
    if(!conversationID){
        return;
    }

    var xml = new XMLHttpRequest();

    xml.onload = function() {
        if (this.readyState == 4 || this.status == 200) {
            var response = JSON.parse(xml.responseText);
            
            // console.log(response.messages);
            // console.log(typeof(response.messages));
            showMessages(response.messages);
        }
    };

    xml.open("GET", URLROOT + "/Message/fetchMessagesbyID/" + conversationID, true);
    xml.send();
}

function showMessages(messages){
   
    for(var i=0; i<messages.length; i++){
        var msg_id = messages[i].message_id;
        var msg_text = messages[i].message_text;
        var msg_sender_type = messages[i].sender_type;
        var msg_timestamp = messages[i].created_at;
        var is_seen = messages[i].is_seen;
        var sender_deleted = messages[i].sender_deleted;
        var receiver_deleted = messages[i].receiver_deleted;
        

        //console.log(msg_id + " | " + msg_text + " | " + msg_sender_type + " | " + msg_timestamp + " | " + is_seen + " | " + sender_deleted + " | " + receiver_deleted);
        displayMessage(msg_id, msg_text, msg_sender_type, msg_timestamp, is_seen, sender_deleted, receiver_deleted);
  
    }
}



function displayMessage(msg_id, msg_text, msg_sender_type, msg_timestamp, is_seen, sender_deleted, receiver_deleted) {
    var messagesContainer = document.querySelector('.msgs');
    if(!messagesContainer) return;

    // Create the row div
    var row = document.createElement('div');
    row.className = msg_sender_type === 'PROVIDER' ? 'row out' : 'row in';
    row.id = 'msg_' + msg_id;
    
    // If incoming message, add avatar
    if (msg_sender_type !== 'PROVIDER') {
        var avatarDiv = document.createElement('div');
        avatarDiv.className = 'who';
        avatarDiv.setAttribute('aria-hidden', 'true');
        avatarDiv.style.backgroundImage = "url('" + imgURL + "')";
        row.appendChild(avatarDiv);
    }
    
    // Create bubble
    var bubble = document.createElement('div');
    bubble.className = msg_sender_type === 'PROVIDER' ? 'bubble' : 'bubble bubble--out';
    
    // Message text
    var textDiv = document.createElement('div');
    textDiv.className = 'bubble__text';
    
    // Handle deleted messages
    if (sender_deleted || receiver_deleted) {
        textDiv.textContent = '[Message deleted]';
        textDiv.style.fontStyle = 'italic';
        textDiv.style.opacity = '0.6';
    } else {
        textDiv.textContent = msg_text;
    }
    
    // Timestamp
    var timeSpan = document.createElement('time');
    timeSpan.className = 'bubble__time';
    timeSpan.setAttribute('datetime', formatTime(msg_timestamp));
    timeSpan.textContent = formatTime(msg_timestamp);
    
    // Add seen indicator for sent messages
    if (msg_sender_type === 'PROVIDER' && is_seen) {
        timeSpan.innerHTML += ' <span style="color: #0084ff;">✓✓</span>';
    }
    
    bubble.appendChild(textDiv);
    bubble.appendChild(timeSpan);
    row.appendChild(bubble);
    
    messagesContainer.appendChild(row);
    
    // Auto-scroll to bottom
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function formatTime(timestamp) {
    var date = new Date(timestamp);
    var hours = String(date.getHours()).padStart(2, '0');
    var minutes = String(date.getMinutes()).padStart(2, '0');
    return hours + ':' + minutes;
}

// ========== EDIT / DELETE (rest unchanged) ==========

function handleMessageRightClick(event) {
    var messageRow = event.target.closest('.row');
    if (!messageRow) return;
    
    event.preventDefault();
    
    var messageId = messageRow.id.replace('msg_', '');
    var messageText = messageRow.querySelector('.bubble__text').textContent;
    var senderType = messageRow.classList.contains('out') ? 'user' : 'other';
    
    // Only show menu for current user's messages
    if (senderType !== 'user') {
        return;
    }
    
    showMessageContextMenu(event.pageX, event.pageY, messageId, messageText);
}

function handleMessageClick(event) {
    var messageRow = event.target.closest('.row');
    if (!messageRow) return;
    
    var messageId = messageRow.id.replace('msg_', '');
    var messageText = messageRow.querySelector('.bubble__text').textContent;
    var senderType = messageRow.classList.contains('out') ? 'user' : 'other';
    
    // Only show menu for current user's messages
    if (senderType !== 'user') {
        return;
    }
    
    // Long press detection (hold for 500ms)
    var longPressTimer = setTimeout(function() {
        showMessageContextMenu(event.pageX, event.pageY, messageId, messageText);
    }, 500);
    
    event.target.addEventListener('mouseup', function() {
        clearTimeout(longPressTimer);
    }, { once: true });
}

function showMessageContextMenu(x, y, messageId, messageText) {
    // Remove existing menu if present
    var existingMenu = document.querySelector('.message-context-menu');
    if (existingMenu) {
        existingMenu.remove();
    }
    
    // Create context menu
    var menu = document.createElement('div');
    menu.className = 'message-context-menu';
    menu.style.cssText = `
        position: fixed;
        top: ${y}px;
        left: ${x}px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        z-index: 1000;
        min-width: 120px;
    `;
    
    // Edit button
    var editBtn = document.createElement('button');
    editBtn.textContent = '✏️ Edit';
    editBtn.style.cssText = `
        display: block;
        width: 100%;
        padding: 10px 15px;
        border: none;
        background: none;
        text-align: left;
        cursor: pointer;
        font-size: 14px;
        border-radius: 8px 8px 0 0;
    `;
    editBtn.onmouseover = function() { this.style.background = '#f0f0f0'; };
    editBtn.onmouseout = function() { this.style.background = 'none'; };
    editBtn.onclick = function() {
        loadMessageToEdit(messageId, messageText);
        menu.remove();
    };
    
    // Delete button
    var deleteBtn = document.createElement('button');
    deleteBtn.textContent = '🗑️ Delete';
    deleteBtn.style.cssText = `
        display: block;
        width: 100%;
        padding: 10px 15px;
        border: none;
        background: none;
        text-align: left;
        cursor: pointer;
        font-size: 14px;
        border-radius: 0 0 8px 8px;
        color: #d32f2f;
    `;
    deleteBtn.onmouseover = function() { this.style.background = '#ffebee'; };
    deleteBtn.onmouseout = function() { this.style.background = 'none'; };
    deleteBtn.onclick = function() {
        deleteMessage(messageId);
        menu.remove();
    };
    
    menu.appendChild(editBtn);
    menu.appendChild(deleteBtn);
    document.body.appendChild(menu);
    
    // Close menu when clicking elsewhere
    document.addEventListener('click', function closeMenu(e) {
        if (!menu.contains(e.target) && !e.target.closest('.row')) {
            menu.remove();
            document.removeEventListener('click', closeMenu);
        }
    });
}

function loadMessageToEdit(messageId, messageText) {
    var messageInput = document.getElementById('messageInput');
    messageInput.value = messageText;
    messageInput.focus();
    
    editingMessageId = messageId;
    
    // Add visual indicator that we're editing
    var form = document.getElementById('message-form');
    var existingLabel = form.querySelector('.editing-label');
    if (existingLabel) {
        existingLabel.remove();
    }
    
    var editingLabel = document.createElement('div');
    editingLabel.className = 'editing-label';
    editingLabel.style.cssText = `
        font-size: 12px;
        color: #666;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    `;
    editingLabel.innerHTML = `
        <span>✏️ Editing message...</span>
        <button type="button" class="cancel-edit" style="background: none; border: none; color: #0084ff; cursor: pointer; font-size: 12px; text-decoration: underline;">Cancel</button>
    `;
    
    form.insertBefore(editingLabel, form.querySelector('.field'));
    
    // Cancel edit button handler
    editingLabel.querySelector('.cancel-edit').addEventListener('click', cancelEdit);
}

function cancelEdit() {
    editingMessageId = null;
    document.getElementById('messageInput').value = '';
    var editingLabel = document.querySelector('.editing-label');
    if (editingLabel) {
        editingLabel.remove();
    }
}



function updateMessage(messageId, newText) {
    var data = {
        message_id: messageId,
        message: newText,
        status: "edited"
    };
    
    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Message updated successfully");
            editingMessageId = null;
            fetchMessages();
        }
    };
    xml.onerror = function() {
        alert("Error updating message");
    };
    
    var datastring = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Message/updateMessage", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(datastring);
}

function deleteMessage(messageId) {
    if (!confirm("Are you sure you want to delete this message?")) {
        return;
    }
    
    var data = {
        message_id: messageId
    };
    
    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Message deleted successfully");
            fetchMessages();
        }
    };
    xml.onerror = function() {
        alert("Error deleting message");
    };
    
    var datastring = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Message/deleteMessage", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(datastring);
}

// message click/right-click handlers after DOM ready
document.addEventListener('DOMContentLoaded', function() {
    var msgsContainer = document.querySelector('.msgs');
    if (msgsContainer) {
        msgsContainer.addEventListener('contextmenu', handleMessageRightClick);
        msgsContainer.addEventListener('click', handleMessageClick);
    }
    
    // Also fetch initial messages if conversation already selected
    if (conversationID) {
        fetchMessages();
    }
});
