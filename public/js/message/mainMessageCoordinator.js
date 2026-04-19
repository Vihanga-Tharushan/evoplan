var conversationID = null;
var conversationsLoaded = false;

//store current editing message ID
var editingMessageId = null;

//========= Load conversations on page load =========
document.addEventListener('DOMContentLoaded', function() {
    loadConversations();
    
    // Check if there's a specific conversation to load from URL
    const urlParams = new URLSearchParams(window.location.search);
    const conversationId = urlParams.get('conversation_id');
    
    if (conversationId) {
        // Wait for conversations to load, then select the specified one
        var maxAttempts = 20; // 2 seconds max wait
        var attempts = 0;
        
        var checkLoaded = setInterval(function() {
            if (conversationsLoaded) {
                selectConversation(parseInt(conversationId));
                // Highlight the correct thread
                const thread = document.querySelector(`[data-conversation-id="${conversationId}"]`);
                if (thread) {
                    document.querySelectorAll('.thread').forEach(t => t.classList.remove('is-active'));
                    thread.classList.add('is-active');
                }
                clearInterval(checkLoaded);
            }
            attempts++;
            if (attempts >= maxAttempts) {
                clearInterval(checkLoaded);
                console.warn('Timeout waiting for conversations to load');
            }
        }, 100);
    }
});

function loadConversations() {
    var xml = new XMLHttpRequest();
    
    xml.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (response.status === 'success') {
                // Merge clients and providers conversations into a single array
                var conversations = [];
                
                if (response.data) {
                    // Handle both old flat array format and new separated format
                    if (Array.isArray(response.data)) {
                        // Old format: response.data is already an array
                        conversations = response.data;
                    } else if (response.data.clients || response.data.providers) {
                        // New format: response.data has clients and providers arrays
                        if (Array.isArray(response.data.clients)) {
                            conversations = conversations.concat(response.data.clients);
                        }
                        if (Array.isArray(response.data.providers)) {
                            conversations = conversations.concat(response.data.providers);
                        }
                    }
                }
                
                renderConversations(conversations);
            }
        }
    };

    xml.onerror = function() {
        console.error('Failed to load conversations');
    };

    xml.open("GET", URLROOT + "/IssueC/getCoordinatorConversations", true);
    xml.send();
}

function renderConversations(conversations) {
    var threadList = document.getElementById('conversationsList');
    threadList.innerHTML = '';

    if (!conversations || conversations.length === 0) {
        threadList.innerHTML = '<li style="padding: 20px; text-align: center; color: #999;">No conversations yet</li>';
        conversationsLoaded = true;
        return;
    }

    conversations.forEach(function(conv, index) {
        var li = document.createElement('li');
        li.className = 'thread' + (index === 0 ? ' is-active' : '');
        li.setAttribute('data-conversation-id', conv.conversation_id);
        li.setAttribute('data-client-id', conv.client_id);
        li.setAttribute('data-provider-id', conv.provider_id);

        var avatarDiv = document.createElement('div');
        avatarDiv.className = 'thread__avatar';
        
        var avatar = document.createElement('div');
        avatar.className = 'avatar';
        avatar.setAttribute('aria-hidden', 'true');
        avatar.setAttribute('role', 'img');
        avatar.style.backgroundImage = "url('" + URLROOT + "/public/img/profilePics/" + (conv.profile_pic || 'default.png') + "')";
        
        var presence = document.createElement('span');
        presence.className = 'presence';
        presence.setAttribute('aria-label', 'status');
        
        avatarDiv.appendChild(avatar);
        avatarDiv.appendChild(presence);

        var bodyDiv = document.createElement('div');
        bodyDiv.className = 'thread__body';
        
        var topDiv = document.createElement('div');
        topDiv.className = 'thread__top';
        
        var nameDiv = document.createElement('div');
        nameDiv.className = 'thread__name';
        nameDiv.textContent = conv.name || 'Unknown User';
        
        var timeSpan = document.createElement('time');
        timeSpan.className = 'thread__time';
        timeSpan.setAttribute('datetime', conv.last_message_time || '');
        timeSpan.textContent = formatMessageTime(conv.last_message_time);
        
        topDiv.appendChild(nameDiv);
        topDiv.appendChild(timeSpan);

        var snippetDiv = document.createElement('div');
        snippetDiv.className = 'thread__snippet';
        snippetDiv.textContent = truncateText(conv.last_message || 'No messages yet', 50);

        bodyDiv.appendChild(topDiv);
        bodyDiv.appendChild(snippetDiv);

        li.appendChild(avatarDiv);
        li.appendChild(bodyDiv);

        threadList.appendChild(li);
    });

    // Attach click handlers
    attachThreadClickHandlers();

    // Load first conversation's messages if no specific one is selected
    if (conversations.length > 0 && !window.location.search) {
        selectConversation(conversations[0].conversation_id);
    }
    
    conversationsLoaded = true;
}

function attachThreadClickHandlers() {
    var threads = document.querySelectorAll('.thread');
    threads.forEach(function(thread) {
        thread.addEventListener('click', function(e) {
            e.preventDefault();

            var conv_ID = this.getAttribute('data-conversation-id');
            
            // Remove active class from all threads
            threads.forEach(function(t) {
                t.classList.remove('is-active');
            });
            this.classList.add('is-active');
            
            selectConversation(conv_ID);
        }); 
    });
}

function selectConversation(conv_ID) {
    conversationID = conv_ID;

    // Show composer
    document.getElementById("message-form").style.display = "block";
    document.getElementById("composerPlaceholder").style.display = "none";

    // Clear messages
    document.querySelector(".msgs").innerHTML = "";
    
    // Fetch messages
    fetchMessages();
}

//========= message section =========
var messageInput = document.getElementById("messageInput");
var submitbtn = document.getElementById("submitbtn");

if(submitbtn){
    submitbtn.addEventListener("click", sendMessage);
}

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
            status: "sent"
        };
        send_data(data);
    }

    // Clear input field
    messageInput.value = "";
    
    // Clear existing messages to avoid duplication
    document.querySelector(".msgs").innerHTML = "";
    
    // Display new message immediately
    fetchMessages();
}

function send_data(data){
    var xml = new XMLHttpRequest();
    
    xml.onload = function() {
        if (this.readyState == 4 || this.status == 200) {
            console.log('Message sent');
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
            var response = JSON.parse(this.responseText);
            if (response.status === 'success') {
                showMessages(response.messages);
            }
        }
    };

    // Pass is_ic_message flag to fetch IC messages instead of regular messages
    xml.open("GET", URLROOT + "/Message/fetchMessagesbyID/" + conversationID + "?is_ic_message=true", true);
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
        var sender_name = messages[i].sender_name || messages[i].name || '';

        displayMessage(msg_id, msg_text, msg_sender_type, msg_timestamp, is_seen, sender_deleted, receiver_deleted, sender_name);
    }
}

function displayMessage(msg_id, msg_text, msg_sender_type, msg_timestamp, is_seen, sender_deleted, receiver_deleted, sender_name) {
    var messagesContainer = document.querySelector('.msgs');
    if(!messagesContainer) return;

    // Create the row div
    var row = document.createElement('div');
    row.className = msg_sender_type === 'ISSUE_COORDINATOR' ? 'row out' : 'row in';
    row.id = 'msg_' + msg_id;
    
    // If incoming message, add avatar
    if (msg_sender_type !== 'ISSUE_COORDINATOR') {
        var avatarDiv = document.createElement('div');
        avatarDiv.className = 'who';
        avatarDiv.setAttribute('aria-hidden', 'true');
        avatarDiv.style.backgroundImage = "url('" + URLROOT + "/public/img/profilePics/default.png')";
        row.appendChild(avatarDiv);
    }
    
    // Create bubble
    var bubble = document.createElement('div');
    bubble.className = msg_sender_type === 'ISSUE_COORDINATOR' ? 'bubble bubble--out' : 'bubble';
    
    // Add sender name for incoming messages
    if (msg_sender_type !== 'ISSUE_COORDINATOR') {
        var senderNameDiv = document.createElement('div');
        senderNameDiv.className = 'bubble__sender-name';
        senderNameDiv.style.cssText = `
            font-size: 0.75rem;
            font-weight: 700;
            color: #4B006E;
            margin-bottom: 4px;
            text-transform: capitalize;
        `;
        senderNameDiv.textContent = sender_name;
        bubble.appendChild(senderNameDiv);
    }
    
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
    if (msg_sender_type === 'ISSUE_COORDINATOR' && is_seen) {
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

function formatMessageTime(timestamp) {
    if (!timestamp) return '';
    var date = new Date(timestamp);
    var now = new Date();
    var diffMs = now - date;
    var diffMins = Math.floor(diffMs / 60000);
    var diffHours = Math.floor(diffMs / 3600000);
    var diffDays = Math.floor(diffMs / 86400000);

    if (diffMins < 1) return 'now';
    if (diffMins < 60) return diffMins + 'm';
    if (diffHours < 24) return diffHours + 'h';
    if (diffDays < 7) return diffDays + 'd';

    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return date.getDate() + ' ' + months[date.getMonth()];
}

function truncateText(text, length) {
    if (!text) return '';
    return text.length > length ? text.substring(0, length) + '...' : text;
}

// ========== EDIT / DELETE ==========

function handleMessageRightClick(event) {
    var messageRow = event.target.closest('.row');
    if (!messageRow) return;
    
    event.preventDefault();
    
    var messageId = messageRow.id.replace('msg_', '');
    var messageText = messageRow.querySelector('.bubble__text').textContent;
    var senderType = messageRow.classList.contains('out') ? 'user' : 'other';
    
    // Only show menu for current user's messages
    if (senderType !== 'user') return;
    
    showMessageContextMenu(event.pageX, event.pageY, messageId, messageText);
}

function handleMessageClick(event) {
    var messageRow = event.target.closest('.row');
    if (!messageRow) return;
    
    var messageId = messageRow.id.replace('msg_', '');
    var messageText = messageRow.querySelector('.bubble__text').textContent;
    var senderType = messageRow.classList.contains('out') ? 'user' : 'other';
    
    // Only show menu for current user's messages
    if (senderType !== 'user') return;
    
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
    editBtn.onmouseover = function() { this.style.backgroundColor = '#f0f0f0'; };
    editBtn.onmouseout = function() { this.style.backgroundColor = 'transparent'; };
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
    deleteBtn.onmouseover = function() { this.style.backgroundColor = '#f0f0f0'; };
    deleteBtn.onmouseout = function() { this.style.backgroundColor = 'transparent'; };
    deleteBtn.onclick = function() { 
        deleteMessage(messageId);
        menu.remove();
    };
    
    menu.appendChild(editBtn);
    menu.appendChild(deleteBtn);
    document.body.appendChild(menu);
    
    // Close menu when clicking elsewhere
    document.addEventListener('click', function closeMenu(e) {
        if (!menu.contains(e.target)) {
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
        is_ic_message: true,
        status: "edited"
    };
    
    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            cancelEdit();
            document.querySelector(".msgs").innerHTML = "";
            fetchMessages();
        }
    };
    xml.onerror = function() {
        console.error('Failed to update message');
    };
    
    var datastring = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Message/updateMessage", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(datastring);
}

function deleteMessage(messageId) {
    if (!confirm("Are you sure you want to delete this message?")) return;
    
    var data = {
        message_id: messageId,
        is_ic_message: true
    };
    
    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector(".msgs").innerHTML = "";
            fetchMessages();
        }
    };
    xml.onerror = function() {
        console.error('Failed to delete message');
    };
    
    var datastring = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Message/deleteMessage", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(datastring);
}

// Attach message click/right-click handlers after messages are loaded
function attachMessageHandlers() {
    var msgsContainer = document.querySelector('.msgs');
    if (msgsContainer) {
        msgsContainer.addEventListener('contextmenu', handleMessageRightClick);
        msgsContainer.addEventListener('mousedown', handleMessageClick);
    }
}

// Update message display function to attach handlers
var originalDisplayMessage = displayMessage;
displayMessage = function(msg_id, msg_text, msg_sender_type, msg_timestamp, is_seen, sender_deleted, receiver_deleted) {
    originalDisplayMessage(msg_id, msg_text, msg_sender_type, msg_timestamp, is_seen, sender_deleted, receiver_deleted);
    attachMessageHandlers();
};
