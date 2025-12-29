<?php
    
    // Send notification to service provider about package addition
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
        ];
        
        // TODO: Save notification to database
        // Example: $notificationModel->createNotification($notificationData);
        
        // Send email notification (optional)
       // sendEmailNotification($serviceProviderId, $eventData, $packageData, $clientData);
        
        return $notificationData;
    }
    
    // Send email notification to service provider
    function sendEmailNotification($serviceProviderId, $eventData, $packageData, $clientData) {
        
        // TODO: Get service provider email from database
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
    
?>