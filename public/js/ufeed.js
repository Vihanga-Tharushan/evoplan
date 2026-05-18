// Tab Switching
function switchTab(tab) {
    const tabs = document.querySelectorAll('.nav-tab');
    const contents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(t => t.classList.remove('active'));
    contents.forEach(c => c.classList.remove('active'));
    
    if (tab === 'form') {
        tabs[0].classList.add('active');
        document.getElementById('form-tab').classList.add('active');
    } else {
        tabs[1].classList.add('active');
        document.getElementById('submitted-tab').classList.add('active');
    }
}

// Star Rating System
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingInput');
    const ratingLabel = document.getElementById('ratingLabel');
    let selectedRating = parseInt(ratingInput.value) || 0;
    
    const ratingLabels = {
        0: 'Click to rate',
        1: 'Poor',
        2: 'Fair',
        3: 'Good',
        4: 'Very Good',
        5: 'Excellent'
    };

    // Initialize stars based on current rating
    updateStars(selectedRating);

    stars.forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.getAttribute('data-rating'));
            updateStars(selectedRating);
            ratingInput.value = selectedRating;
            
            if (ratingLabel) {
                ratingLabel.textContent = ratingLabels[selectedRating];
            }
        });

        star.addEventListener('mouseenter', function() {
            const rating = parseInt(this.getAttribute('data-rating'));
            updateStars(rating);
            if (ratingLabel) {
                ratingLabel.textContent = ratingLabels[rating];
            }
        });
    });

    const starRating = document.getElementById('starRating');
    if (starRating) {
        starRating.addEventListener('mouseleave', function() {
            updateStars(selectedRating);
            if (ratingLabel) {
                ratingLabel.textContent = ratingLabels[selectedRating];
            }
        });
    }

    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }
});

// Submitted feedback priority filter
document.addEventListener('DOMContentLoaded', function() {
    const filter = document.getElementById('priority-filter');
    if (!filter) return;

    const applyFilter = () => {
        const value = filter.value;
        document.querySelectorAll('.review-card').forEach(card => {
            const cardPriority = (card.getAttribute('data-priority') || '').toUpperCase();
            if (!value || cardPriority === value) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    };

    filter.addEventListener('change', applyFilter);
});

// Character Counter
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('feedbackText');
    const counter = document.getElementById('charCounter');

    if (textarea && counter) {
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = `${length} / 500`;
            
            // Change color when approaching limit
            if (length > 450) {
                counter.style.color = '#ef4444';
            } else if (length > 400) {
                counter.style.color = '#f59e0b';
            } else {
                counter.style.color = '#9ca3af';
            }
        });
    }
});

// Provider Selection
document.addEventListener('DOMContentLoaded', function() {
    const providerButtons = document.querySelectorAll('.provider-card');
    const providerInput = document.getElementById('providerInput');
    const categoryInput = document.getElementById('categoryInput');
    const providerNameEl = document.getElementById('providerName');
    const providerCategoryEl = document.getElementById('providerCategory');

    function wireProviderButtons() {
        const buttons = document.querySelectorAll('.provider-card');
        
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove selected class from all buttons
                buttons.forEach(btn => btn.classList.remove('selected'));
                
                // Add selected class to clicked button
                this.classList.add('selected');
                
                // Get data from button
                const name = this.dataset.providerName || '';
                const serviceType = this.dataset.serviceType || this.dataset.serviceType || this.dataset.category || '';
                const packageName = this.dataset.packageName || '';
                
                // Update hidden inputs
                if (providerInput) providerInput.value = name;
                if (categoryInput) categoryInput.value = serviceType;
                
                // Update display
                if (providerNameEl) providerNameEl.textContent = name || 'Provider';
                if (providerCategoryEl) providerCategoryEl.textContent = serviceType || packageName || '';
                // Update avatar image if provider has profile picture
                const providerAvatar = document.getElementById('providerAvatar');
                if (providerAvatar) {
                    const pic = this.dataset.profilePic || '';
                    if (pic) {
                        providerAvatar.src = URLROOT + '/public/img/profilePics/' + pic;
                        providerAvatar.alt = name || 'Provider';
                    } else {
                        providerAvatar.src = URLROOT + '/public/img/default-avatar.png';
                        providerAvatar.alt = name || 'Provider';
                    }
                }
            });
        });

        // Auto-select first provider if none selected
        if (buttons.length > 0 && !document.querySelector('.provider-card.selected')) {
            buttons[0].click();
        }
    }

    // Wire existing provider buttons
    if (providerButtons.length > 0) {
        wireProviderButtons();
    }

    // Fetch providers via AJAX if needed
    const eventId = window.eventId || null;
    if ((!providerButtons || providerButtons.length === 0) && eventId) {
        fetch(URLROOT + '/Clients/getEventProviders/' + encodeURIComponent(eventId), { 
            credentials: 'same-origin' 
        })
        .then(r => r.json())
        .then(resp => {
            if (resp.providers && resp.providers.length > 0) {
                const container = document.querySelector('.providers-grid');
                
                resp.providers.forEach(p => {
                    const card = document.createElement('button');
                    card.type = 'button';
                    card.className = 'provider-card';
                    card.dataset.providerName = p.service_provider_name || '';
                    card.dataset.serviceType = p.service_type || p.serviceType || '';
                    card.dataset.packageName = p.package_name || '';
                    card.dataset.profilePic = p.profile_pic || '';
                    let avatarHtml = '';
                    if (p.profile_pic) {
                        avatarHtml = `<img class="provider-avatar-img" src="${URLROOT}/public/img/profilePics/${p.profile_pic}" alt="${(p.service_provider_name||'Provider')}">`;
                    } else {
                        avatarHtml = `<div class="provider-avatar-letter">${(p.service_provider_name || ' ')[0].toUpperCase()}</div>`;
                    }

                    card.innerHTML = `
                        <div class="provider-avatar-wrapper">
                            ${avatarHtml}
                        </div>
                        <div class="provider-details">
                            <h4 class="provider-card-name">${p.service_provider_name}</h4>
                            <p class="provider-card-package">${p.service_type || p.serviceType || p.package_name || ''}</p>
                        </div>
                        <div class="provider-check">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                    `;
                    
                    container.appendChild(card);
                });
                
                // Wire the newly added buttons
                wireProviderButtons();
            }
        })
        .catch(err => console.error('Error fetching providers:', err));
    }
});

// Dropdown Menu Toggle
function toggleMenu(button) {
    const menu = button.closest('.review-actions-menu');
    const isActive = menu.classList.contains('active');
    
    // Close all other menus
    document.querySelectorAll('.review-actions-menu').forEach(m => {
        m.classList.remove('active');
    });
    
    // Toggle current menu
    if (!isActive) {
        menu.classList.add('active');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.review-actions-menu')) {
        document.querySelectorAll('.review-actions-menu').forEach(menu => {
            menu.classList.remove('active');
        });
    }
});

// Reset Form Function
function resetForm() {
    if (confirm('Are you sure you want to reset the form? All your input will be lost.')) {
        // Reset rating
        const stars = document.querySelectorAll('.star');
        stars.forEach(star => star.classList.remove('active'));
        document.getElementById('ratingInput').value = '0';
        
        const ratingLabel = document.getElementById('ratingLabel');
        if (ratingLabel) {
            ratingLabel.textContent = 'Click to rate';
        }
        
        // Reset textarea
        const textarea = document.getElementById('feedbackText');
        if (textarea) {
            textarea.value = '';
        }
        
        // Reset counter
        const counter = document.getElementById('charCounter');
        if (counter) {
            counter.textContent = '0 / 500';
            counter.style.color = '#9ca3af';
        }
        
        // Reset provider selection
        document.querySelectorAll('.provider-card').forEach(btn => {
            btn.classList.remove('selected');
        });
        
        // Auto-select first provider
        const firstProvider = document.querySelector('.provider-card');
        if (firstProvider) {
            firstProvider.click();
        }
    }
}

// Form Validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action*="feedback"]');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const rating = parseInt(document.getElementById('ratingInput').value);
            const provider = document.getElementById('providerInput').value;

            if (!provider) {
                e.preventDefault();
                alert('Please select a provider to review.');
                return false;
            }

            if (rating === 0) {
                e.preventDefault();
                alert('Please provide a rating for the provider.');
                return false;
            }

            // Submit via AJAX so the new feedback appears without a full page reload
            e.preventDefault();

            const fd = new FormData(form);

            fetch(URLROOT + '/clients/feedback', {
                method: 'POST',
                body: fd,
                credentials: 'same-origin',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(r => r.json())
            .then(resp => {
                if (!resp || resp.success !== true) {
                    alert(resp && resp.message ? resp.message : 'Failed to submit feedback');
                    return;
                }

                const fb = resp.feedback;
                if (!fb) return;

                // Build review-card element
                const reviewsList = document.querySelector('.reviews-list');
                if (reviewsList) {
                    const card = document.createElement('div');
                    card.className = 'review-card';

                    const profileImg = fb.profile_pic ? `<img src="${URLROOT}/public/img/profilePics/${fb.profile_pic}" alt="${fb.provider_name}">` : (fb.provider_name ? fb.provider_name.charAt(0).toUpperCase() : 'P');

                    // stars
                    let starsHtml = '';
                    const ratingVal = parseInt(fb.rating) || 0;
                    for (let i=1;i<=5;i++) {
                        const filled = i <= ratingVal ? 'filled' : '';
                        starsHtml += `<span class="review-star ${filled}"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></span>`;
                    }

                    const createdAt = fb.created_at ? (new Date(fb.created_at)).toLocaleDateString() : 'Just now';

                    card.innerHTML = `
                        <div class="review-header">
                            <div class="review-provider-info">
                                <div class="review-avatar">${profileImg}</div>
                                <div class="review-provider-details">
                                    <h4 class="review-provider-name">${fb.provider_name || ''}</h4>
                                    <div class="review-rating-display">
                                        <div class="review-stars">${starsHtml}</div>
                                        <span class="review-rating-number">${ratingVal}.0</span>
                                    </div>
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
                                    <a href="${URLROOT}/clients/editFeedback/${fb.feedback_id}" class="menu-item">Edit Feedback</a>
                                    <a href="${URLROOT}/clients/deleteFeedback/${fb.feedback_id}" class="menu-item delete" onclick="return confirm('Are you sure you want to delete this feedback? This action cannot be undone.')">Delete Feedback</a>
                                </div>
                            </div>
                        </div>
                        ${fb.feedback_text ? `<p class="review-text">${fb.feedback_text}</p>` : ''}
                        <div class="review-footer"><span class="review-date">${createdAt}</span></div>
                    `;

                    // prepend new feedback
                    reviewsList.insertBefore(card, reviewsList.firstChild);
                }

                // switch to submitted tab and reset form
                switchTab('submitted');
                resetForm();
            })
            .catch(err => {
                console.error('Feedback submit error', err);
                alert('Failed to submit feedback.');
            });

            return false;
        });
    }
});

// Smooth scroll to top when switching tabs
function switchTab(tab) {
    const tabs = document.querySelectorAll('.nav-tab');
    const contents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(t => t.classList.remove('active'));
    contents.forEach(c => c.classList.remove('active'));
    
    if (tab === 'form') {
        tabs[0].classList.add('active');
        document.getElementById('form-tab').classList.add('active');
    } else {
        tabs[1].classList.add('active');
        document.getElementById('submitted-tab').classList.add('active');
    }
    
    // Smooth scroll to top of content
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
