<?php
    
    function sendPackageNotification($serviceProviderId, $eventData, $packageData, $clientData) {
        
        // Prepare notification message
        $message = "New package request from {$clientData->name} for event: {$eventData->event_name}";
        $notificationData = [
            'sender_type' => 'CLIENT',
            'sender_id' => $clientData->client_id,
            'receiver_type' => 'PROVIDER',
            'receiver_id' => $serviceProviderId,
            'title' => 'New Package Request',
            'message' => $message,
            'event_id' => $eventData->event_id,
            'package_id' => $packageData->package_id,
            'is_read' => 'OFF',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $notificationModel = new M_notification();
        
        // Send email notification (optional)
       // sendEmailNotification($serviceProviderId, $eventData, $packageData, $clientData);
        
       // Save notification to database
        return $notificationModel->createNotification($notificationData);
    }
    
    // Send email notification to service provider
    function sendEmailNotification($serviceProviderId, $eventData, $packageData, $clientData) {
        
        // Get service provider email from database
        // $serviceProviderEmail = getServiceProviderEmail($serviceProviderId);
        
        $subject = "New Package Request - {$eventData->event_name}";
        $emailBody = "
            <h2>New Package Request</h2>
            <p>You have received a new package request from <strong>{$clientData->name}</strong></p>
            <h3>Event Details:</h3>
            <ul>
                <li>Event Name: {$eventData->event_name}</li>
                <li>Event Type: {$eventData->event_type}</li>
                <li>Start Date: {$eventData->start_datetime}</li>
                <li>Guest Count: {$eventData->guest_count}</li>
            </ul>
            <h3>Package Details:</h3>
            <ul>
                <li>Package Name: {$packageData->package_name}</li>
                <li>Price: {$packageData->price}</li>
            </ul>
            <p>Please log in to your account to view and respond to this request.</p>
        ";
        
        // TODO: Implement actual email sending
        // mail($serviceProviderEmail, $subject, $emailBody, $headers);
        
        return true;
    }

    
function getNotificationIcon($title, $message) {
    $lowerTitle = strtolower($title);
    $lowerMessage = strtolower($message);
    
    if (strpos($lowerTitle, 'booking') !== false || strpos($lowerMessage, 'booking') !== false) {
        return ['icon' => '<i class="fa-solid fa-calendar-check"></i>', 'type' => 'booking'];
    } elseif (strpos($lowerTitle, 'message') !== false || strpos($lowerMessage, 'message') !== false) {
        return ['icon' => '<i class="fa-solid fa-comment"></i>', 'type' => 'message'];
    } elseif (strpos($lowerTitle, 'review') !== false || strpos($lowerTitle, 'rating') !== false) {
        return ['icon' => '<i class="fa-solid fa-star"></i>', 'type' => 'review'];
    } elseif (strpos($lowerTitle, 'payment') !== false || strpos($lowerMessage, 'payment') !== false) {
        return ['icon' => '<i class="fa-solid fa-money-bill"></i>', 'type' => 'payment'];
    } elseif (strpos($lowerTitle, 'package') !== false || strpos($lowerMessage, 'package') !== false) {
        return ['icon' => '<i class="fa-solid fa-box"></i>', 'type' => 'booking'];
    } elseif (strpos($lowerTitle, 'alert') !== false || strpos($lowerTitle, 'warning') !== false) {
        return ['icon' => '<i class="fa-solid fa-triangle-exclamation"></i>', 'type' => 'alert'];
    } else {
        return ['icon' => '<i class="fa-solid fa-info"></i>', 'type' => 'system'];
    }
}

function getTimeAgo($datetime) {
    $timestamp = strtotime($datetime);
    $diff = time() - $timestamp;
    
    if ($diff < 60) {
        return 'Just now';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } else {
        return date('M j, Y', $timestamp);
    }
}

function getNotificationContext($notification) {
    if ($notification->event_id) {
        return 'Event Related';
    } elseif ($notification->package_id) {
        return 'Package Request';
    } elseif ($notification->sender_type === 'CLIENT') {
        return 'Client';
    } elseif ($notification->sender_type === 'ADMIN') {
        return 'Admin';
    } else {
        return 'System';
    }
}
    
?>