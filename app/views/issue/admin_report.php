 <?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar_back.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/eventsdetails.css"/>

 
 <div class="chat-section card">
                    <div class="chat-header">
                        <div class="chat-avatar">CF</div>
                        <div>
                            <h3>Chat with Chris Friedkly</h3>
                            <div class="detail-label">Event Owner</div>
                        </div>
                    </div>

                    <div class="chat-messages">
                        <div class="message received">
                            <div>Hello, I noticed that the floral arrangements at our event yesterday were different from what we agreed upon.</div>
                            <div class="message-time">10:24 AM</div>
                        </div>
                        <div class="message sent">
                            <div>Hi Chris, I'm looking into this issue for you. Can you specify what was different about the flowers?</div>
                            <div class="message-time">10:30 AM</div>
                        </div>
                        <div class="message received">
                            <div>We ordered roses and lilies, but we received carnations and daisies instead. This was quite disappointing for our special event.</div>
                            <div class="message-time">10:35 AM</div>
                        </div>
                        <div class="message sent">
                            <div>I apologize for this error. I've confirmed with our vendor that there was a mix-up in the order. We will arrange for replacement floral arrangements to be delivered to you tomorrow morning.</div>
                            <div class="message-time">10:42 AM</div>
                        </div>
                        <div class="message received">
                            <div>Thank you for addressing this promptly. We appreciate the quick resolution.</div>
                            <div class="message-time">10:45 AM</div>
                        </div>
                    </div>

                    <div class="chat-input">
                        <input type="text" placeholder="Type your message...">
                        <button>➤</button>
                    </div>
                </div>
            <script>
            // Simple chat functionality
        const chatInput = document.querySelector('.chat-input input');
        const chatSendButton = document.querySelector('.chat-input button');
        const chatMessages = document.querySelector('.chat-messages');

        function sendMessage() {
            const message = chatInput.value.trim();
            if (message) {
                const messageElement = document.createElement('div');
                messageElement.className = 'message sent';
                messageElement.innerHTML = `
                    <div>${message}</div>
                    <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                `;
                chatMessages.appendChild(messageElement);
                chatInput.value = '';
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        chatSendButton.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
    