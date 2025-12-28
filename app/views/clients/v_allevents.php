<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Clients/home';
require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbarBack.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/allevents.css">

<form method="POST" action="<?php echo URLROOT; ?>/Clients/allevents">
        
    <div class="container">
        <div class="header" style="margin-top: 70px;">
            <h1>Pick the <span class="highlight">Event</span> You're Planning</h1>
        </div>
        
        <div class="events-grid">
            <div class="event-card birthday" style="background-image: url('<?php echo URLROOT; ?>/img/home/3d-birthday-celebration-cartoon-illustration 1.svg')" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/birthday'">
                <h3>Birthday<br>Parties</h3>
            </div>
            
            <div class="event-card weddings" style="background-image: url('<?php echo URLROOT; ?>/img/home/9652663 2.svg')" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/w'">
                <h3>Weddings</h3>
            </div>
            
            <div class="event-card university" style="background-image: url('<?php echo URLROOT; ?>/img/home/problem-solving-concept-with-books 2.svg')" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/u'">
                <h3>University<br>Functions</h3>
            </div>
            
            <div class="event-card musicals" style="background-image: url('<?php echo URLROOT; ?>/img/home/3d-music-related-scene 1.svg')" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/m'">
                <h3>Musicals</h3>
            </div>
            
            <div class="event-card family" style="background-image: url('<?php echo URLROOT; ?>/img/home/3d-people-enjoying-reunion-dinner-chinese-new-year-celebration 1.svg')" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/f'">
                <h3>Family<br>gatherings</h3>
            </div>
            
            <div class="event-card promotional" style="background-image: url('<?php echo URLROOT; ?>/img/home/9928017 2.svg')" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/p'">
                <h3>Promotional<br>&<br>Launch events</h3>
            </div>
            
            <div class="event-card corporate" style="background-image: url('<?php echo URLROOT; ?>/img/home/29991 1.svg')" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/c'">
                <h3>Corporate<br>events</h3>
            </div>
            
            <div class="event-card cultural" style="background-image: url('<?php echo URLROOT; ?>/img/home/10500922 1.svg')" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/cr'">
                <h3>Cultural<br>&<br>Religious<br>Events</h3>
            </div>
            
            <div class="event-card graduation" style="background-image: url('<?php echo URLROOT; ?>/img/home/10473220 1.svg')" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/g'">
                <h3>Graduation<br>Parties</h3>
            </div>
            
            
        </div>
    </div>
    </form>
<?php require APPROOT . '/views/inc/footer.php';?>