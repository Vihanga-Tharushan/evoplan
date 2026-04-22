<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Feedbacks).css">

<div class="feedbacks-container">
  <!-- Header -->
  <div class="feedbacks-header">
    <h1>Customer Feedbacks</h1>
    <p>View and manage all customer feedback and reviews</p>
  </div>

  <!-- Rating Filter Tabs -->
  <div class="rating-tabs">
    <button class="rating-btn active" data-rating="all" onclick="filterRating('all')">
      <i class="fas fa-star"></i>
      <span>All</span>
      <span class="count">0</span>
    </button>
    <button class="rating-btn" data-rating="5" onclick="filterRating('5')">
      <i class="fas fa-star"></i>
      <span>5 Stars</span>
      <span class="count">0</span>
    </button>
    <button class="rating-btn" data-rating="4" onclick="filterRating('4')">
      <i class="fas fa-star"></i>
      <span>4 Stars</span>
      <span class="count">0</span>
    </button>
    <button class="rating-btn" data-rating="lessthan3" onclick="filterRating('lessthan3')">
      <i class="fas fa-star-half-alt"></i>
      <span>3 or less</span>
      <span class="count">0</span>
    </button>
  </div>

  <!-- Feedbacks List -->
  <div class="feedbacks-list" id="feedbacksList"></div>
</div>

<script>
  // Feedbacks data from database
  const feedbacksData = [
    <?php
      if (!empty($data['feedbacks'])) {
        foreach ($data['feedbacks'] as $feedback) {
          echo "{
            id: {$feedback->review_id},
            name: '{$feedback->reviewer_name}',
            providerName: '{$feedback->provider_name}',
            userType: 'Client',
            date: '{$feedback->created_at}',
            rating: {$feedback->rating},
            feedback: '" . addslashes($feedback->review_text) . "',
            avatar: ''
          },";
        }
      }
    ?>
  ];

  let currentRating = 'all';

  // Initialize
  function initFeedbacks() {
    renderFeedbacks();
    updateCounts();
  }

  // Render feedbacks
  function renderFeedbacks() {
    const container = document.getElementById('feedbacksList');
    let filteredFeedbacks = feedbacksData;

    if (currentRating !== 'all') {
      if (currentRating === '5') {
        filteredFeedbacks = feedbacksData.filter(f => f.rating === 5);
      } else if (currentRating === '4') {
        filteredFeedbacks = feedbacksData.filter(f => f.rating === 4);
      } else if (currentRating === 'lessthan3') {
        filteredFeedbacks = feedbacksData.filter(f => f.rating <= 3);
      }
    }

    if (filteredFeedbacks.length === 0) {
      container.innerHTML = '<div class="empty-state"><p>No feedbacks found</p></div>';
      return;
    }

    container.innerHTML = filteredFeedbacks.map(feedback => {
      const stars = Array(feedback.rating).fill('★').join('');
      return `
        <div class="feedback-item" data-searchable="${(feedback.name + ' ' + feedback.feedback).toLowerCase()}">
          <div class="feedback-header">
            <div class="feedback-user">
              <!-- <img class="feedback-avatar" src="${feedback.avatar}" alt="${feedback.name}" /> -->
              <div class="feedback-info">
                <h3>${feedback.name}</h3>
                <p class="feedback-meta">For: ${feedback.providerName} • ${feedback.date}</p>
              </div>
            </div>
            <div class="feedback-rating">
              <span class="stars">${stars}</span>
            </div>
          </div>
          <div class="feedback-content">
            <p>${feedback.feedback}</p>
          </div>
          <div class="feedback-actions">
            <button class="btn-icon danger" title="Delete" onclick="deleteFeedback(${feedback.id})">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      `;
    }).join('');
  }

  // Filter by rating
  function filterRating(rating) {
    currentRating = rating;
    document.querySelectorAll('.rating-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`[data-rating="${rating}"]`).classList.add('active');
    renderFeedbacks();
  }

  // Update counts with actual feedback data
  function updateCounts() {
    if (feedbacksData.length === 0) {
      // If no feedbacks, set all counts to 0
      document.querySelectorAll('.rating-btn .count').forEach(el => el.textContent = '0');
      return;
    }

    const counts = {
      all: feedbacksData.length,
      5: feedbacksData.filter(f => f.rating === 5).length,
      4: feedbacksData.filter(f => f.rating === 4).length,
      lessthan3: feedbacksData.filter(f => f.rating <= 3).length
    };

    Object.keys(counts).forEach(key => {
      const btn = document.querySelector(`[data-rating="${key}"]`);
      if (btn) {
        btn.querySelector('.count').textContent = counts[key];
      }
    });
  }

  // Delete feedback function
  function deleteFeedback(feedbackId) {
    if (confirm('Are you sure you want to delete this feedback?')) {
      window.location.href = '<?php echo URLROOT; ?>/Admin/delete_feedback/' + feedbackId;
    }
  }

  // Initialize on page load
  window.addEventListener('DOMContentLoaded', initFeedbacks);
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>