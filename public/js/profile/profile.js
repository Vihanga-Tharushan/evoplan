document.addEventListener('DOMContentLoaded', function() {
    // Calendar state variables
    let currentDate = new Date();
    let selectedStartDate = null;
    let selectedEndDate = null;
    let isSelectingRange = false;
    // Reference 'today' (midnight) used to disable past dates selection
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    // Use the data passed from PHP
    let availabilityData = [];
    availabilityData = window.serverAvailabilityData || [];
    if (!Array.isArray(availabilityData)) {
        console.error('Invalid availability data format');
        availabilityData = [];
    }
    // DOM Elements
    const calendarGrid = document.getElementById('calendar-grid');
    const monthDisplay = document.querySelector('.cal__month');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const fromDateInput = document.getElementById('from-date');
    const toDateInput = document.getElementById('to-date');
    const availabilityForm = document.getElementById('availability-form');
    const rangeSummary = document.getElementById('range-summary');
    const rangeDates = document.getElementById('range-dates');
    const rangeCount = document.getElementById('range-count');
    const clearRangeBtn = document.getElementById('clear-range');
    const viewEventsBtn = document.getElementById('view-events');
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    // Initialize calendar
    function initCalendar() {
        renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
        setupEventListeners();
        updateFormDates();
    }

    // Setup event listeners
    function setupEventListeners() {
        prevMonthBtn.addEventListener('click', goToPreviousMonth);
        nextMonthBtn.addEventListener('click', goToNextMonth);
        
        // Tab switching
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');
                switchTab(tabId);
            });
        });

    }

    // Calendar navigation
    function goToPreviousMonth() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
    }

    function goToNextMonth() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
    }

    // Render calendar
    function renderCalendar(year, month) {
        calendarGrid.innerHTML = '';
        
        // Update month display
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        monthDisplay.textContent = `${monthNames[month]} ${year}`;

        // Get first day of month and number of days
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startingDay = firstDay.getDay(); // 0 = Sunday

        // Add empty cells for days before the first day of month
        for (let i = 0; i < startingDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'cal__day cal__day--empty';
            calendarGrid.appendChild(emptyCell);
        }

        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(year, month, day);
            const dateString = formatDate(date);
            
            const dayElement = document.createElement('div');
            dayElement.className = 'cal__day';
            dayElement.textContent = day;
            dayElement.setAttribute('data-date', dateString);

            // Mark today
            if (date.getTime() === today.getTime()) {
                dayElement.classList.add('cal__day--today');
            }

            // Check if in selected range
            if (isDateInSelectedRange(date)) {
                dayElement.classList.add('cal__day--selected');
            }

            // Check availability status from server data
            const status = getDateStatus(date);
            if (status) {
                dayElement.classList.add(`cal__day--${status}`);
                dayElement.title = `Marked as ${status}`;
            }

            // Disable past dates (strictly before today)
            if (date.getTime() < today.getTime()) {
                dayElement.classList.add('cal__day--past');
                dayElement.title = 'Cannot select a past date';
            } else {
                // Only attach click handler for today and future dates
                dayElement.addEventListener('click', () => handleDateClick(date));
            }

            calendarGrid.appendChild(dayElement);
        }
    }

    // Handle date click
    function handleDateClick(date) {
        // Prevent selecting past dates
        if (date.getTime() < today.getTime()) return;
        const dateString = formatDate(date);
        
        if (!selectedStartDate) {
            // Start new selection
            selectedStartDate = date;
            selectedEndDate = date;
            isSelectingRange = true;
        } else if (isSelectingRange && selectedStartDate && !selectedEndDate) {
            // Complete selection
            selectedEndDate = date;
            
            // Ensure start date is before end date
            if (selectedStartDate > selectedEndDate) {
                [selectedStartDate, selectedEndDate] = [selectedEndDate, selectedStartDate];
            }
            
            isSelectingRange = false;
        } else {
            // Start new selection
            selectedStartDate = date;
            selectedEndDate = null;
            isSelectingRange = true;
        }

        updateFormDates();
        updateRangeSummary();
        renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
    }

    // Update form date inputs
    function updateFormDates() {
        if (selectedStartDate) {
            fromDateInput.value = formatDate(selectedStartDate);
        }
        if (selectedEndDate) {
            toDateInput.value = formatDate(selectedEndDate);
        }
    }

    // Update calendar from form inputs
    function updateCalendarFromInputs() {
        if (fromDateInput.value) {
            selectedStartDate = new Date(fromDateInput.value);
        }
        if (toDateInput.value) {
            selectedEndDate = new Date(toDateInput.value);
        }
        
        updateRangeSummary();
        renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
    }

    // Update range summary display
    function updateRangeSummary() {
        if (selectedStartDate && selectedEndDate) {
            const startStr = formatDisplayDate(selectedStartDate);
            const endStr = formatDisplayDate(selectedEndDate);
            const daysCount = getDaysBetween(selectedStartDate, selectedEndDate);
            
            rangeDates.textContent = `${startStr} to ${endStr}`;
            rangeCount.textContent = `${daysCount} day${daysCount > 1 ? 's' : ''}`;
            rangeSummary.style.display = 'block';
        } else {
            rangeSummary.style.display = 'none';
        }
    }

    // Clear date range selection
    function clearDateRange() {
        selectedStartDate = null;
        selectedEndDate = null;
        isSelectingRange = false;
        
        fromDateInput.value = '';
        toDateInput.value = '';
        
        rangeSummary.style.display = 'none';
        renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
    }

    // Add this function to your availability.js
    function validateDateRange(startDate, endDate) {
        if (startDate > endDate) {
            alert('End date cannot be before start date');
            return false;
        }
        
        // Optional: Limit how far in advance they can book
        const maxDays = 365; // 1 year max
        const today = new Date();
        const maxDate = new Date();
        maxDate.setDate(today.getDate() + maxDays);
        
        if (endDate > maxDate) {
            alert(`Cannot set availability more than ${maxDays} days in advance`);
            return false;
        }
        
        return true;
    }

    // Handle form submission
    function handleFormSubmit(e) {
        e.preventDefault();
        
        if (!selectedStartDate || !selectedEndDate) {
            alert('Please select a date range first');
            return;
        }

        // Validate date range
    if (!validateDateRange(selectedStartDate, selectedEndDate)) {
        return;
    }


        // Form is already set up to submit via POST to the controller
        availabilityForm.submit();
    }

    // Tab switching
    function switchTab(tabName) {
        // Update tabs
        tabs.forEach(tab => {
            if (tab.getAttribute('data-tab') === tabName) {
                tab.classList.add('active');
            } else {
                tab.classList.remove('active');
            }
        });

        // Update tab content
        tabContents.forEach(content => {
            if (content.id === `${tabName}-tab`) {
                content.classList.add('active');
            } else {
                content.classList.remove('active');
            }
        });
    }

    // Check date status from server data
    function getDateStatus(date) {
        const dateString = formatDate(date);
        const dateTimestamp = date.getTime();
        
        for (const availability of serverAvailabilityData) {
            try {
                // Parse the date strings from database
                const startDate = new Date(availability.start_date);
                const endDate = new Date(availability.end_date);
                
                // Normalize dates to start of day for comparison
                startDate.setHours(0, 0, 0, 0);
                endDate.setHours(0, 0, 0, 0);
                
                // Check if current date falls within the availability range
                if (dateTimestamp >= startDate.getTime() && dateTimestamp <= endDate.getTime()) {
                    return availability.status;
                }
            } catch (error) {
                console.error('Error parsing date:', error);
            }
        }
        
        return null;
    }

    // Utility functions
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    function formatDisplayDate(date) {
        return date.toLocaleDateString('en-US', { 
            weekday: 'short', 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric' 
        });
    }

    function getDaysBetween(startDate, endDate) {
        const timeDiff = endDate.getTime() - startDate.getTime();
        return Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
    }

    function isDateInSelectedRange(date) {
        if (!selectedStartDate) return false;
        
        const dateTime = date.getTime();
        const startTime = selectedStartDate.getTime();
        
        if (selectedEndDate) {
            const endTime = selectedEndDate.getTime();
            return dateTime >= startTime && dateTime <= endTime;
        }
        
        return dateTime === startTime;
    }


    function initPostPopups() {
    // Close popups when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.btn--icon') && !e.target.closest('.popup-menu')) {
            document.querySelectorAll('.popup-menu').forEach(popup => {
                popup.style.display = 'none';
            });
        }
    });

    // Toggle popup on ... button click
    document.querySelectorAll('.btn--icon').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const post = this.closest('.post');
            const popup = post.querySelector('.popup-menu');
            
            // Close all other popups
            document.querySelectorAll('.popup-menu').forEach(p => {
                if (p !== popup) p.style.display = 'none';
            });
            
            // Toggle current popup
            popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
        });
    });

    // Handle popup menu actions
    document.addEventListener('click', function(e) {
        const button = e.target.closest('.popup-menu__item');
        if (!button) return;

        e.preventDefault();
        const eventId = button.getAttribute('data-event-id');
        const popup = button.closest('.popup-menu');

        if (button.classList.contains('edit-btn')) {
            window.location.href = `${URLROOT}/Posts/EditEventPost/${eventId}`;
        } else if (button.classList.contains('delete-btn')) {
            if (confirm('Are you sure you want to delete this post?')) {
                window.location.href = `${URLROOT}/Posts/DeleteEventPost/${eventId}`;
            }
        } else if (button.classList.contains('add-media-btn')) {
            window.location.href = `${URLROOT}/Posts/AddMediaToEvent/${eventId}`;
        }

        // Close the popup
        popup.style.display = 'none';
    });
    }

            // change colour of like icon on click — accepts the clicked element
            window.changecolour = function(imgEl) {
                if (!imgEl) return;

                //get post container (use closest to find ancestor, not querySelector)
                if (!imgEl) return; // ensure imgEl is defined
                const postEl = imgEl.closest('.post');
                if (!postEl) return;
                // event id might be on the post element or on the .post__media element
                const eventId = postEl.getAttribute('data-event-id') || postEl.querySelector('.post__media')?.dataset.eventId;
                //alert(eventId);

                const isLiking = !imgEl.classList.contains('liked');
                // toggle 'liked' class and swap src if needed
                imgEl.classList.toggle('liked');

                if (imgEl.classList.contains('liked')) {
                    imgEl.src = URLROOT + '/public/img/ServiceP/posts/liked.svg';
                } else {
                    imgEl.src = URLROOT + '/public/img/ServiceP/posts/like.svg';
                }

                // update count next to this icon
                const countEl = imgEl.closest('.action')?.querySelector('.like-count');
                if (countEl) {
                    let n = parseInt(countEl.textContent) || 0;
                    countEl.textContent = imgEl.classList.contains('liked') ? n + 1 : Math.max(0, n - 1);
                }

                //send AJAX request to server to update like status
                const xhr = new XMLHttpRequest();
                xhr.open('POST', `${URLROOT}/Posts/LikeEvent`, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if(xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (!response.success) {
                                // revert changes on failure
                                revertLikeState(imgEl, countEl, isLiking);
                                alert('Error updating like status: ' + response.message);
                            }
                        } catch (e) {
                            console.error('Error parsing response', e);
                            revertLikeState(imgEl, countEl, isLiking);
                        }
                    }else{
                        revertLikeState(imgEl, countEl, isLiking);
                        alert('Network error occurred');
                    }
                }

                xhr.onerror = function(){
                revertLikeState(imgEl, countEl, isLiking);
                alert('Network error occurred');
                };
                
                var data ={
                    event_id: eventId,
                    client_id: clientId
                }
                var datastring=JSON.stringify(data);
                xhr.send(datastring);
            };


            // Function to revert like state if AJAX fails
        function revertLikeState(imgEl, countEl, wasLiking) {
            imgEl.classList.toggle('liked');
            
            if (imgEl.classList.contains('liked')) {
                imgEl.src = URLROOT + '/public/img/ServiceP/posts/liked.svg';
            } else {
                imgEl.src = URLROOT + '/public/img/ServiceP/posts/like.svg';
            }
            
            if (countEl) {
                let n = parseInt(countEl.textContent) || 0;
                countEl.textContent = wasLiking ? Math.max(0, n - 1) : n + 1;
            }
        }

            

    // Media carousel functionality
function initMediaCarousel() {
  const mediaWrappers = document.querySelectorAll('.post__media-wrapper');

  mediaWrappers.forEach(wrapper => {
    const mediaContainer = wrapper.querySelector('.post__media');
    const eventId = mediaContainer.getAttribute('data-event-id');
    const images = wrapper.querySelectorAll('.post__image, .post__video');
    const dots = wrapper.querySelectorAll('.media__dot');
    const prevBtn = wrapper.querySelector('.media__nav--left');
    const nextBtn = wrapper.querySelector('.media__nav--right');

    if (images.length <= 1) return; // Skip if only one or no media

    let currentIndex = 0;

    // Show media at index
    function showMedia(index) {
      images.forEach((img, i) => {
        img.classList.toggle('active', i === index);
      });

      dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
      });

      currentIndex = index;
    }

    // Next button
    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        const nextIndex = (currentIndex + 1) % images.length;
        showMedia(nextIndex);
      });
    }

    // Previous button
    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        const prevIndex = (currentIndex - 1 + images.length) % images.length;
        showMedia(prevIndex);
      });
    }

    // Dots
    dots.forEach(dot => {
      dot.addEventListener('click', () => {
        const index = parseInt(dot.getAttribute('data-index'));
        showMedia(index);
      });
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
      // Only if this media is visible
      const activeMedia = document.querySelector('.post__media-wrapper:hover');
      if (!activeMedia || activeMedia !== wrapper) return;

      if (e.key === 'ArrowLeft') prevBtn?.click();
      if (e.key === 'ArrowRight') nextBtn?.click();
    });

    // Initialize
    showMedia(0);
  });
}

function commentSecton(){
    
}

// Initialize the calendar
    initCalendar();

    // Initialize post popups
    initPostPopups();

    // Initialize media carousels
    initMediaCarousel();

    // Initialize background slideshow
    initBackgroundSlideshow();
});

// Comment section DOM elements (outside DOMContentLoaded)
const commentsPanel = document.getElementById('comments-panel');
const commentsOverlay = document.getElementById('comments-overlay');
const closeCommentsBtn = document.getElementById('close-comments');
const commentForm = document.getElementById('comment-form');

function openCommentsPanel(eventId) {
  commentsPanel.classList.add('active');
  commentsOverlay.classList.add('active');
  document.body.classList.add('comments-panel-open'); // PREVENT SCROLL
  
  // Store event ID for form submission
  commentsPanel.setAttribute('data-event-id', eventId);
  
  // Load comments for this post
  loadComments(eventId);
}

function closeCommentsPanel() {
  commentsPanel.classList.remove('active');
  commentsOverlay.classList.remove('active');
  document.body.classList.remove('comments-panel-open'); // ALLOW SCROLL
}

// Close panel when overlay or close button clicked
closeCommentsBtn.addEventListener('click', closeCommentsPanel);
commentsOverlay.addEventListener('click', closeCommentsPanel);

// Close panel on Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closeCommentsPanel();
});

// Attach to comment icon click
document.addEventListener('click', (e) => {
  const commentIcon = e.target.closest('.commenticon');
  if (commentIcon) {
    const post = commentIcon.closest('.post');
    const eventId = post.querySelector('.post__media')?.dataset.eventId;
    if (eventId) openCommentsPanel(eventId);
  }
});

// Handle comment form submission
commentForm.addEventListener('submit', function(e) {
  e.preventDefault();
  
  const eventId = commentsPanel.getAttribute('data-event-id');
  const commentText = document.getElementById('comment-input').value.trim();
  
  if (!commentText) {
    alert('Please write a comment');
    return;
  }
  
  const xhr = new XMLHttpRequest();
  xhr.open('POST', `${URLROOT}/Posts/AddComment`, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  xhr.onload = function() {
    if(xhr.readyState === 4 || xhr.status === 200) {
        
      var response = JSON.parse(xhr.responseText);
      console.log(response);
      document.getElementById('comment-input').value = '';
      loadComments(eventId); // Refresh comments

    } else {
      alert('Error posting comment');
    }
  };
  
  xhr.send(JSON.stringify({
    event_id: eventId,
    comment: commentText
  }));
});

function loadComments(eventId) {

  var xhr = new XMLHttpRequest();
  
  xhr.onload = function() {
    if (this.readyState === 4 || this.status === 200) {
    
        var response = JSON.parse(xhr.responseText);
        renderComments(response.comments || []);
    }
  };

  xhr.open("GET", URLROOT + "/Posts/GetComments/" + eventId, true);
  xhr.send();
}

function renderComments(comments) {
  const container = document.getElementById('comments-container');
  container.innerHTML = '';
  
  if (comments.length === 0) {
    container.innerHTML = '<p style="text-align: center; color: #999; padding: 20px 0;">No comments yet</p>';
    return;
  }
  
  comments.forEach(comment => {
    const commentEl = document.createElement('div');
    commentEl.className = 'comment';
    commentEl.innerHTML = `
      <div class="comment__avatar">
        <img src="${URLROOT}/public/img/profilePics/${comment.profile_pic || 'default.png'}" alt="">
      </div>
      <div class="comment__body">
        <div class="comment__author">${comment.client_name || 'Anonymous'}</div>
        <div class="comment__text">${escapeHtml(comment.comment_text)}</div>
        <div class="comment__time">${formatTimeAgo(comment.created_at)}</div>
      </div>
    `;
    container.appendChild(commentEl);
  });
}

function escapeHtml(text) {
  const div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}

function formatTimeAgo(timestamp) {
  const now = new Date();
  const commentDate = new Date(timestamp);
  const seconds = Math.floor((now - commentDate) / 1000);
  
  if (seconds < 60) return 'Just now';
  if (seconds < 3600) return `${Math.floor(seconds/60)}m ago`;
  if (seconds < 86400) return `${Math.floor(seconds/3600)}h ago`;
  return `${Math.floor(seconds/86400)}d ago`;
}

// Background slideshow functionality
function initBackgroundSlideshow() {
    const slideshow = document.getElementById('background-slideshow');
    if (!slideshow) {
        console.log('background-slideshow element not found');
        return;
    }

    const images = slideshow.querySelectorAll('.sp-cover__img');
    console.log('Images found:', images.length);
    
    if (images.length <= 1) {
        console.log('Only 1 or 0 images, slideshow not needed');
        return;
    }

    let currentIndex = 0;

    function showNextImage() {
        // Remove active class from current image
        images[currentIndex].classList.remove('active');

        // Move to next image
        currentIndex = (currentIndex + 1) % images.length;

        // Add active class to new image
        images[currentIndex].classList.add('active');
        console.log('Showing image:', currentIndex);
    }

    // Start slideshow - change image every 4.5 seconds
    setInterval(showNextImage, 4500);
    console.log('Slideshow started with', images.length, 'images');
}