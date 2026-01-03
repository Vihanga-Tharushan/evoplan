// Initialize notification system
document.addEventListener('DOMContentLoaded', function() {
    const markAllBtn = document.getElementById('mark-all-read');
    const filterTabs = document.querySelectorAll('.filter-tab');
    
    // Mark all as read functionality
    if(markAllBtn) {
        markAllBtn.addEventListener('click', function() {
            const unreadNotifications = document.querySelectorAll('.notification-item.unread');
            
            if (unreadNotifications.length === 0) {
                showToast('No unread notifications to mark', 'info');
                return;
            }
            
            // Send AJAX request to mark all as read
            fetch(`${window.location.origin}/evoplan/Service/markAllNotificationsAsRead`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    unreadNotifications.forEach(notification => {
                        notification.classList.remove('unread');
                        notification.classList.add('read');
                        
                        // Hide unread indicator
                        const indicator = notification.querySelector('.unread-indicator');
                        if (indicator) indicator.remove();
                        
                        // Hide mark as read button
                        const markReadBtn = notification.querySelector('.btn-mark-read');
                        if (markReadBtn) markReadBtn.style.display = 'none';
                    });
                    
                    // Update badge count
                    updateBadgeCount(0);
                    // Hide the button after all marked
                    markAllBtn.style.display = 'none';
                    
                    showToast('All notifications marked as read', 'success');
                } else {
                    showToast('Failed to mark all as read', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred', 'error');
            });
        });
    }
    
    // Filter tabs functionality
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            filterTabs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            const filter = this.textContent.toLowerCase();
            filterNotifications(filter);
        });
    });
    
    // Update badge count on page load
    updateBadgeCount();
});

// Mark as read function
function markAsRead(button) {
    const notificationItem = button.closest('.notification-item');
    const notificationId = notificationItem.dataset.id;
    
    // Send AJAX request to mark as read
    fetch(`${window.location.origin}/evoplan/Service/markNotificationAsRead`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            notificationId: notificationId
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Mark as read
            notificationItem.classList.remove('unread');
            notificationItem.classList.add('read');
            
            // Hide unread indicator
            const indicator = notificationItem.querySelector('.unread-indicator');
            if (indicator) indicator.remove();
            
            // Hide the mark as read button
            button.style.display = 'none';
            
            // Update badge count
            updateBadgeCount();
            
            showToast('Notification marked as read', 'success');
        } else {
            showToast('Failed to mark as read', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred', 'error');
    });
}

// Delete notification function
function deleteNotification(button) {
    const notificationItem = button.closest('.notification-item');
    const notificationList = document.getElementById('notifications-list');
    const notificationId = notificationItem.dataset.id;
    
    // Send AJAX request to delete
    fetch(`${window.location.origin}/evoplan/Service/deleteNotification`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            notificationId: notificationId
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Add exit animation
            notificationItem.style.opacity = '0';
            notificationItem.style.transform = 'translateX(-20px)';
            
            // Remove after animation
            setTimeout(() => {
                notificationItem.remove();
                
                // Check if list is empty
                const remainingNotifications = notificationList.querySelectorAll('.notification-item');
                if (remainingNotifications.length === 0) {
                    document.getElementById('empty-state').style.display = 'block';
                    notificationList.style.display = 'none';
                }
                
                // Update badge count
                updateBadgeCount();
                
                showToast('Notification deleted', 'success');
            }, 300);
        } else {
            showToast('Failed to delete notification', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred', 'error');
    });
}

// Filter notifications by type
function filterNotifications(filter) {
    const notifications = document.querySelectorAll('.notification-item');
    const emptyState = document.getElementById('empty-state');
    const notificationList = document.getElementById('notifications-list');
    
    let visibleCount = 0;
    
    notifications.forEach(notification => {
        const type = notification.dataset.type;
        
        if (filter === 'all notifications' || 
            filter === 'unread' && notification.classList.contains('unread') ||
            filter.includes(type)) {
            notification.style.display = 'flex';
            visibleCount++;
        } else {
            notification.style.display = 'none';
        }
    });
    
    // Show/hide empty state
    if (visibleCount === 0) {
        emptyState.style.display = 'block';
        notificationList.style.display = 'none';
    } else {
        emptyState.style.display = 'none';
        notificationList.style.display = 'block';
    }
}

// Update badge count
function updateBadgeCount(count = null) {
    const badge = document.querySelector('.badge-count');
    
    if (!badge) return;
    
    if (count === null) {
        // Count current unread notifications
        const unreadCount = document.querySelectorAll('.notification-item.unread').length;
        badge.textContent = `${unreadCount} new`;
        
        // Hide badge if no unread
        if (unreadCount === 0) {
            badge.style.display = 'none';
            const markAllBtn = document.getElementById('mark-all-read');
            if(markAllBtn) markAllBtn.style.display = 'none';
        } else {
            badge.style.display = 'inline-block';
        }
    } else {
        badge.textContent = `${count} new`;
        if (count === 0) {
            badge.style.display = 'none';
        } else {
            badge.style.display = 'inline-block';
        }
    }
    
    // Update document title
    const unreadCount = parseInt(badge.textContent);
    document.title = unreadCount > 0 ? `(${unreadCount}) Notifications - Evoplan` : 'Notifications - Evoplan';
}

// Show toast notification
function showToast(message, type = 'info') {
    const toastContainer = document.getElementById('toast-container');
    
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
        <div class="toast-icon">
            ${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}
        </div>
        <div class="toast-message">${message}</div>
        <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
    `;
    
    toastContainer.appendChild(toast);
    
    // Auto remove after 4 seconds
    setTimeout(() => {
        if (toast.parentNode) {
            toast.remove();
        }
    }, 4000);
}

// Keyboard shortcut to refresh page and get new notifications
document.addEventListener('keydown', function(e) {
    // Alt + R to refresh notifications
    if (e.altKey && e.key === 'r') {
        location.reload();
    }
});
