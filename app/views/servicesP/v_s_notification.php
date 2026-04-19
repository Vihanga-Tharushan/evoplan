<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/profile';
require_once APPROOT . '/views/inc/components/taskbar/navbar.php';

$stats = $data['stats'];
$notifications = $data['notifications'];
$unreadCount = $stats->unread ?? 0;
$totalCount = $stats->total ?? 0;
$todayCount = $stats->today ?? 0;
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_notification.css">

    <div class="notifications-container">
        <!-- Header -->
        <header class="notifications-header">
            <div class="header-main">
                <div class="header-title">
                    <h1>Notifications</h1>
                    <?php if($unreadCount > 0): ?>
                    <span class="badge-count"><?php echo $unreadCount; ?> new</span>
                    <?php endif; ?>
                </div>
                <div class="header-actions">
                    <?php if($unreadCount > 0): ?>
                    <button class="btn btn--success" id="mark-all-read">
                        <i class="fa-regular fa-circle-check"></i>
                        Mark all as read
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                       <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $totalCount; ?></h3>
                        <p>Total Notifications</p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                          <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $todayCount; ?></h3>
                        <p>Today</p>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                         <i class="fa-regular fa-comment-dots"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $unreadCount; ?></h3>
                        <p>Unread</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-tab active">All Notifications</button>
            <button class="filter-tab">Unread</button>
            <button class="filter-tab">Bookings</button>
            <button class="filter-tab">Reviews</button>
        </div>

        <!-- Notifications List -->
        <div class="notifications-list" id="notifications-list">
            <?php if(!empty($notifications)): ?>
                <?php foreach($notifications as $notification): 
                    $iconData = getNotificationIcon($notification->title, $notification->message); //helper function
                    $isUnread = $notification->is_read === 'OFF';
                    $timeAgo = getTimeAgo($notification->created_at); //helper function
                    $context = getNotificationContext($notification); //helper function
                ?>
                <div class="notification-item <?php echo $isUnread ? 'unread' : 'read'; ?>" data-type="<?php echo $iconData['type']; ?>" data-id="<?php echo $notification->notification_id; ?>">
                    <div class="notification-badge">
                        <div class="badge-icon <?php echo $iconData['type']; ?>">
                            <?php echo $iconData['icon']; ?>
                        </div>
                        <?php if($isUnread): ?>
                        <span class="unread-indicator"></span>
                        <?php endif; ?>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">
                            <?php echo htmlspecialchars($notification->title); ?>
                        </div>
                        <div class="notification-message">
                            <?php echo htmlspecialchars($notification->message); ?>
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time"><?php echo $timeAgo; ?></span>
                            <span class="notification-context"><?php echo $context; ?></span>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <?php if($isUnread): ?>
                        <button class="btn btn-mark-read" onclick="markAsRead(this)">Mark as read</button>
                        <?php endif; ?>
                        <button class="btn btn-delete" onclick="deleteNotification(this)">Delete</button>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Empty State -->
        <div class="empty-state" id="empty-state" style="display: <?php echo empty($notifications) ? 'block' : 'none'; ?>;">
            <div class="empty-icon">📭</div>
            <h2 class="empty-title">No notifications yet</h2>
            <p class="empty-subtitle">When you get notifications, they'll appear here. You'll see updates about bookings, messages, and more.</p>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toast-container"></div>

    <script src="<?php echo URLROOT;?>/js/notification/notification.js"></script>
    
<?php require APPROOT . '/views/inc/footer.php'; ?>