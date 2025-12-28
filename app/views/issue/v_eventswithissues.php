<?php require APPROOT . '/views/inc/header.php'; ?>
<?php 
$backUrl = URLROOT . '/IssueC/dashboard';
require_once APPROOT . '/views/issue/taskbar/taskbar_back.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/eventswithissues.css" />
   <!-- <style>
   a,
   button,
   input,
   select,
   h1,
   h2,
   h3,
   h4,
   h5,
   * {
       box-sizing: border-box;
       margin: 0;
       padding: 0;
       border: none;
       text-decoration: none;
       background: none;
   
       -webkit-font-smoothing: antialiased;
   }
   
   menu, ol, ul {
       list-style-type: none;
       margin: 0;
       padding: 0;
   }
   </style>
  <title>Document</title>
</head>
<body>
  <div class="events-with-issues">
    <div class="frame"></div>
    <div class="frame-32">
      <form method="post" action="<?php //echo URLROOT; ?>/IssueC/issuecprofile">
      <button class = btn btn--light>
      <img class="rectangle-21" src="../public/img/Issue/eventswithissues/rectangle-210.png" />
      </button>
      </form>
      <img class="vector" src="../public/img/Issue/eventswithissues/vector0.svg" />
      <img
        class="phosphor-icons-chats-circle"
        src="../public/img/Issue/eventswithissues/phosphor-icons-chats-circle0.svg"
      />
      <img class="vector2" src="../public/img/Issue/eventswithissues/vector1.svg" />
      <div class="frame-48096275">
        <img class="group-40" src="../public/img/Issue/eventswithissues/group-400.svg" />
      </div>
      <div class="frame-280">
        <div class="home">Home</div>
      </div>
      <img
        class="evo-plan-logo-new-removebg-preview-2"
        src="../public/img/Issue/eventswithissues/evo-plan-logo-new-removebg-preview-20.png"
      />

      <div class="frame-48096276">
        <form method="post" action="<?php echo URLROOT; ?>/IssueC/dashboard">
						<button class="btn btn--light">Back</button>
  </form>-->
        <!--div class="back">Back</div-->
      

    
    <main class="upcoming" aria-label="Upcoming events">
  <div class="upcoming__frame">
    <h2 class="upcoming__title">events-with-Issues</h2>

    <!-- Header -->
    <div class="upcoming__header" role="row">
      <div class="col col--customer" role="columnheader">Customer</div>
      <div class="col" role="columnheader">Event Type</div>
      <div class="col" role="columnheader">Date</div>
      <div class="col" role="columnheader">Start time</div>
      <div class="col" role="columnheader">End time</div>
      <div class="col" role="columnheader">Venue</div>
      <div class="col" role="columnheader">Confirmation</div>
    </div>

    <!-- Rows -->
    <ul class="upcoming__list">
      <li class="row" role="row">
        <a class="row__hit" href="<?php echo URLROOT; ?>/IssueC/issueInvestigation" aria-label="View event for Chris Friedkly">
          <div class="cell cell--customer">
            <img class="avatar" src="https://i.pravatar.cc/40?img=13" alt="">
            <div class="person">
              <div class="name">Chris Friedkly</div>
            </div>
          </div>
          <div class="cell">Birthday Party</div>
          <div class="cell">2025/08/21</div>
          <div class="cell">7.00 P.M</div>
          <div class="cell">11.00 P.M</div>
          <div class="cell">No:123,Main Street,Colombo</div>
          <div class="cell"><span class="status status--sent">Send</span></div>
        </a>
      </li>

      <li class="row" role="row">
        <a class="row__hit" href="<?php echo URLROOT;?>/IssueC/issueInvestigation" aria-label="View event for Gael Harry">
          <div class="cell cell--customer">
            <img class="avatar" src="https://i.pravatar.cc/40?img=14" alt="">
            <div class="person">
              <div class="name">Gael Harry</div>
            </div>
          </div>
          <div class="cell">Get-together</div>
          <div class="cell">2025/08/23</div>
          <div class="cell">3.00 P.M</div>
          <div class="cell">6.00 P.M</div>
          <div class="cell">Hilton Hotel</div>
          <div class="cell"><span class="status status--pending">Not Yet</span></div>
        </a>
      </li>

      <li class="row" role="row">
        <a class="row__hit" href="<?php echo URLROOT; ?>/IssueC/issueInvestigation" aria-label="View event for Jenna Sullivan">
          <div class="cell cell--customer">
            <img class="avatar" src="https://i.pravatar.cc/40?img=15" alt="">
            <div class="person">
              <div class="name">Jenna Sullivan</div>
            </div>
          </div>
          <div class="cell">Wedding Pre-shoot</div>
          <div class="cell">2025/08/24</div>
          <div class="cell">9.00 A.M</div>
          <div class="cell">11.30 A.M</div>
          <div class="cell">Kandy City Center</div>
          <div class="cell"><span class="status status--sent">Send</span></div>
        </a>
      </li>
    </ul>

    
    
  </div>
</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>