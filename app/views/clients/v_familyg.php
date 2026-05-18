<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/feedback.css">

<div class="feedback-container">
    <!-- Page Header -->
   <!-- <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Provider Feedback</h1>
            <p class="page-subtitle">Share your experience and help others make better decisions</p>
        </div>
    </div>-->

    <!-- Navigation Tabs -->
    <div class="nav-tabs">
        <button class="nav-tab active" onclick="switchTab('form')">
            <svg class="tab-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            Give Feedback
        </button>
        <button class="nav-tab" onclick="switchTab('submitted')">
            <svg class="tab-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            My Feedback
        </button>
    </div>

    <form method="post" action="<?php echo URLROOT; ?>/clients/feedback">
        <?php if (!empty($data['editFeedback'])): ?>
            <input type="hidden" name="feedback_id" value="<?= $data['editFeedback']->feedback_id ?>">
        <?php endif; ?>

        <!-- Feedback Form Tab -->
        <div id="form-tab" class="tab-content active">
            <!-- Provider Selection Section -->
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">Select Provider</h3>
                    <p class="section-description">Choose the service provider you want to review</p>
                </div>

                <div class="providers-grid">
                    <?php if (!empty($data['providers'])): ?>
                        <?php foreach($data['providers'] as $prov): ?>
                                        <button type="button" class="provider-card" 
                                            data-provider-name="<?= htmlspecialchars($prov->service_provider_name) ?>" 
                                            data-service-type="<?= htmlspecialchars(isset($prov->serviceType) ? $prov->serviceType : ($prov->service_type ?? '')) ?>"
                                            data-package-name="<?= htmlspecialchars($prov->package_name ?? '') ?>"
                                            data-profile-pic="<?= htmlspecialchars($prov->profile_pic ?? '') ?>">
                                <div class="provider-avatar-wrapper">
                                    <?php if (!empty($prov->profile_pic)): ?>
                                        <img class="provider-avatar-img" src="<?php echo URLROOT; ?>/public/img/profilePics/<?php echo htmlspecialchars($prov->profile_pic); ?>" alt="<?= htmlspecialchars($prov->service_provider_name) ?>">
                                    <?php else: ?>
                                        <div class="provider-avatar-letter">
                                            <?= strtoupper(substr($prov->service_provider_name, 0, 1)) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="provider-details">
                                    <h4 class="provider-card-name"><?= htmlspecialchars($prov->service_provider_name) ?></h4>
                                    <p class="provider-card-package"><?= htmlspecialchars(isset($prov->serviceType) ? $prov->serviceType : ($prov->package_name ?? ($prov->service_type ?? ''))) ?></p>
                                </div>
                                <div class="provider-check">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </div>
                            </button>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-providers">
                            <svg class="empty-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <p>No providers available to review</p>
                        </div>
                    <?php endif; ?>
                </div>

                <input type="hidden" name="provider_name" id="providerInput" value="<?= htmlspecialchars($data['editFeedback']->provider_name ?? '') ?>">
                <input type="hidden" name="category" id="categoryInput" value="<?= htmlspecialchars($data['editFeedback']->category ?? '') ?>">
            </div>

            <!-- Feedback Form Section -->
            <div class="section-card">
                <!-- Selected Provider Header -->
                <div class="selected-provider-header">
                    <div class="selected-provider-info">
                               <img id="providerAvatar"
                                   src="<?php echo URLROOT; ?>/public/img/default-avatar.png"
                                   alt="Provider"
                                   class="selected-avatar">
                        <div class="selected-details">
                            <h3 id="providerName" class="selected-name">
                                <?php echo htmlspecialchars($data['editFeedback']->provider_name ?? 'Select a provider above'); ?>
                            </h3>
                            <p id="providerCategory" class="selected-category">
                                <?php echo htmlspecialchars($data['editFeedback']->category ?? ''); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                        <label class="form-label">Priority</label>
                        <input type="text" class="form-input" name="priority" placeholder="Enter priority" required>
                        <br><span class="error" id="priority-error"></span>
                    </div>

                <!-- Rating Section -->
                <div class="rating-wrapper">
                    <label class="input-label">
                        <span class="label-text">Your Rating</span>
                        <span class="label-required">*</span>
                    </label>
                    <p class="input-helper">How would you rate your overall experience?</p>
                    <div class="star-rating" id="starRating">
                        <?php
                        $currentRating = $data['editFeedback']->rating ?? 0;
                        for ($i = 1; $i <= 5; $i++) {
                            $activeClass = ($i <= $currentRating) ? 'active' : '';
                            echo "<span class='star $activeClass' data-rating='$i'>
                                    <svg class='star-icon' viewBox='0 0 24 24' fill='currentColor'>
                                        <path d='M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z'/>
                                    </svg>
                                  </span>";
                        }
                        ?>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="<?= $currentRating ?>">
                    <p class="rating-label-text" id="ratingLabel">
                        <?php 
                        $labels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];
                        echo $currentRating > 0 ? $labels[$currentRating] : 'Click to rate';
                        ?>
                    </p>
                </div>

                <!-- Feedback Text Area -->
                <div class="feedback-wrapper">
                    <label class="input-label" for="feedbackText">
                        <span class="label-text">Your Feedback</span>
                        <span class="label-optional">(Optional)</span>
                    </label>
                    <p class="input-helper">Share details about your experience to help others</p>
                    <textarea 
                        class="feedback-textarea" 
                        id="feedbackText"
                        name="feedback_text" 
                        placeholder="What did you like? What could be improved? Tell us about the quality, professionalism, and overall experience..."
                        maxlength="500"><?= htmlspecialchars($data['editFeedback']->feedback_text ?? '') ?></textarea>
                    <div class="textarea-footer">
                        <div class="char-counter" id="charCounter">
                            <?= isset($data['editFeedback']->feedback_text) ? strlen($data['editFeedback']->feedback_text) : 0 ?> / 500
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        Submit Feedback
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                        </svg>
                        Reset Form
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Submitted Feedback Tab -->
    <div id="submitted-tab" class="tab-content">
        <div class="section-card">
            <div class="section-header">
                <div>
                    <h3 class="section-title">Your Submitted Feedback</h3>
                    <p class="section-description">View and manage all your provider reviews</p>

                    <div class="form-group" style="max-width: 260px; margin: 10px 0 16px;">
                        <label class="form-label" for="priority-filter">Filter by Priority</label>
                        <select class="form-input" id="priority-filter">
                            <option value="">All Priorities</option>
                            <option value="HIGH">High</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="LOW">Low</option>
                        </select>
                    </div>
                </div>
                <?php if (!empty($data['feedbacks'])): ?>
                    <div class="feedback-stats">
                        <span class="stats-badge"><?= count($data['feedbacks']) ?> Review<?= count($data['feedbacks']) != 1 ? 's' : '' ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="reviews-list">
                <?php if (!empty($data['feedbacks'])): ?>
                    <?php foreach ($data['feedbacks'] as $fb): ?>
                        <div class="review-card" data-priority="<?= htmlspecialchars(strtoupper($fb->priority ?? '')) ?>">
                            <div class="review-header">
                                <div class="review-provider-info">
                                    <div class="review-avatar">
                                        <?php if (!empty($fb->profile_pic)): ?>
                                            <img src="<?php echo URLROOT; ?>/public/img/profilePics/<?php echo htmlspecialchars($fb->profile_pic); ?>" alt="<?= htmlspecialchars($fb->provider_name) ?>">
                                        <?php else: ?>
                                            <?= strtoupper(substr($fb->provider_name, 0, 1)) ?>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="review-provider-details">
                                        <h4 class="review-provider-name"><?= htmlspecialchars($fb->provider_name) ?></h4>
                                        <div class="review-rating-display">
                                            <div class="review-stars">
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {
                                                    $filled = $i <= $fb->rating ? 'filled' : '';
                                                    echo "<span class='review-star $filled'>
                                                            <svg viewBox='0 0 24 24' fill='currentColor'>
                                                                <path d='M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z'/>
                                                            </svg>
                                                          </span>";
                                                }
                                                ?>
                                            </div>
                                            <span class="review-rating-number"><?= $fb->rating ?>.0</span>
                                        </div>
                                        <?php if (!empty($fb->priority)): ?>
                                            <span class="priority-badge priority-<?= strtolower($fb->priority) ?>">
                                                <?= htmlspecialchars(ucfirst(strtolower($fb->priority))) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="review-actions-menu">
                                    <button type="button" class="menu-trigger" onclick="toggleMenu(this)">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <circle cx="12" cy="12" r="2"></circle>
                                            <circle cx="12" cy="5" r="2"></circle>
                                            <circle cx="12" cy="19" r="2"></circle>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="<?= URLROOT ?>/clients/editFeedback/<?= $fb->feedback_id ?>" class="menu-item">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                            Edit Feedback
                                        </a>
                                        <a href="<?= URLROOT ?>/clients/deleteFeedback/<?= $fb->feedback_id ?>" 
                                           class="menu-item delete" 
                                           onclick="return confirm('Are you sure you want to delete this feedback? This action cannot be undone.')">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                            Delete Feedback
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($fb->feedback_text)): ?>
                                <p class="review-text"><?= htmlspecialchars($fb->feedback_text) ?></p>
                            <?php endif; ?>
                            <div class="review-footer">
                                <span class="review-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <?= isset($fb->created_at) ? date('M d, Y', strtotime($fb->created_at)) : 'Recently' ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <svg class="empty-icon" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M9 11l3 3L22 4"></path>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                        <h3 class="empty-title">No Feedback Yet</h3>
                        <p class="empty-description">You haven't submitted any feedback. Share your experience with providers to help others make informed decisions.</p>
                        <button class="btn btn-primary" onclick="switchTab('form')">Give Your First Feedback</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    const URLROOT = '<?php echo URLROOT; ?>';
    // expose event id (when arriving via /clients/feedback/{event_id}) for JS fallback loader
    window.eventId = '<?php echo isset($data['event_id']) ? $data['event_id'] : ''; ?>';
</script>
<script src="<?php echo URLROOT; ?>/js/feedback.js"></script>

<?php require APPROOT . '/views/inc/footer.php'; ?>


<!--this should change addfeedback,getclientfeedback,getfeedbackbyid,updatefeedback-->