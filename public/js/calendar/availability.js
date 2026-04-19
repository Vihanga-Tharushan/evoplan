// availability.js - CLEAN PRODUCTION VERSION
document.addEventListener('DOMContentLoaded', function() {
    // Calendar state variables
    let currentDate = new Date();
    let selectedStartDate = null;
    let selectedEndDate = null;
    let isSelectingRange = false;
    
    // Use the data passed from PHP
    let availabilityData = [];
    document.addEventListener('DOMContentLoaded', function() {
    availabilityData = window.serverAvailabilityData || [];
    if (!Array.isArray(availabilityData)) {
        console.error('Invalid availability data format');
        availabilityData = [];
    }
    initCalendar();
});
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

        // Form submission
        availabilityForm.addEventListener('submit', handleFormSubmit);
        
        // Clear range button
        clearRangeBtn.addEventListener('click', clearDateRange);
        
        // View events button
        viewEventsBtn.addEventListener('click', () => switchTab('availability'));

        // Date input changes
        fromDateInput.addEventListener('change', updateCalendarFromInputs);
        toDateInput.addEventListener('change', updateCalendarFromInputs);
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
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(year, month, day);
            const dateString = formatDate(date);
            
            const dayElement = document.createElement('div');
            dayElement.className = 'cal__day';
            dayElement.textContent = day;
            dayElement.setAttribute('data-date', dateString);

            // Check if today
            if (date.toDateString() === today.toDateString()) {
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
                // Add tooltip with status
                dayElement.title = `Marked as ${status}`;
            }

            // Disable past dates (strictly before today)
            if (date.getTime() < today.getTime()) {
                dayElement.classList.add('cal__day--past');
                dayElement.title = 'Cannot select a past date as unavailable';
                dayElement.style.opacity = '0.5';
                dayElement.style.cursor = 'not-allowed';
                dayElement.style.backgroundColor = '#f5f5f5';
                dayElement.style.color = '#999';
            } else {
                // Only attach click event for today and future dates
                dayElement.addEventListener('click', () => handleDateClick(date));
            }

            calendarGrid.appendChild(dayElement);
        }
    }

    // Handle date click
    function handleDateClick(date) {
        // Get today's date at midnight for accurate comparison
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        // Prevent selecting past dates
        if (date.getTime() < today.getTime()) {
            alert('Cannot select past dates as unavailable. Please select future dates only.');
            return;
        }
        
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
        // Get today's date at midnight for accurate comparison
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        // Prevent selecting past dates as unavailable
        if (startDate.getTime() < today.getTime()) {
            alert('Cannot mark past dates as unavailable. Please select future dates only.');
            return false;
        }
        
        if (startDate > endDate) {
            alert('End date cannot be before start date');
            return false;
        }
        
        // Optional: Limit how far in advance they can book
        const maxDays = 365; // 1 year max
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
    document.addEventListener('click', function(e) {
        // Handle ... button click
        if (e.target.closest('.popup-trigger')) {
            const button = e.target.closest('.popup-trigger');
            const post = button.closest('.post');
            const popup = post.querySelector('.popup-menu');
            const allPopups = document.querySelectorAll('.popup-menu');
            
            // Close all other popups
            allPopups.forEach(p => {
                if (p !== popup) p.style.display = 'none';
            });
            
            // Toggle current popup
            popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
            
            // Prevent the click from immediately closing the popup
            e.stopPropagation();
        } 
        // Handle clicks outside popups to close them
        else if (!e.target.closest('.popup-menu') && !e.target.closest('.popup-trigger')) {
            document.querySelectorAll('.popup-menu').forEach(popup => {
                popup.style.display = 'none';
            });
        }
    });

    // Handle popup menu item clicks
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('edit-btn')) {
            const eventId = e.target.getAttribute('data-event-id');
            console.log('Edit post:', eventId);
            editPost(eventId);
            // Close popup
            e.target.closest('.popup-menu').style.display = 'none';
        }
        if (e.target.classList.contains('delete-btn')) {
            const eventId = e.target.getAttribute('data-event-id');
            console.log('Delete post:', eventId);
            deletePost(eventId);
            e.target.closest('.popup-menu').style.display = 'none';
        }
        if (e.target.classList.contains('add-media-btn')) {
            const eventId = e.target.getAttribute('data-event-id');
            console.log('Add media to post:', eventId);
            addMediaToPost(eventId);
            e.target.closest('.popup-menu').style.display = 'none';
        }
    });
    }

    // Delete availability event (handle all delete buttons)
    document.addEventListener('click', function(e) {

        const deleteBtn = e.target.closest('button.btn--danger[data-id]');
        if(!deleteBtn) return;

        const availabilityId = deleteBtn.getAttribute('data-id');

        if(deleteBtn.classList.contains('delete-availability')){
            const confirmDelete = confirm('Are you sure you want to delete this availability?');
            if(confirmDelete){
                // Redirect to delete URL
                window.location.href = `${URLROOT}/Service/deleteAvailability/${availabilityId}`;
            }
        }
    });

    // Initialize the calendar
    initCalendar();

    // Initialize post popups
    initPostPopups();

    
});

