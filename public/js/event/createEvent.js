 document.addEventListener('DOMContentLoaded', function() {
        // Current step
        let currentStep = 1;
        
        // DOM Elements
        const stepElements = {
            1: document.getElementById('step1'),
            2: document.getElementById('step2'),
            3: document.getElementById('step3')
        };
        
        const contentElements = {
            1: document.getElementById('content1'),
            2: document.getElementById('content2'),
            3: document.getElementById('content3')
        };
        
        // Form inputs
        const eventNameInput = document.getElementById('eventName');
        const eventTypeInput = document.getElementById('eventType');
        const eventDescriptionInput = document.getElementById('eventDescription');
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const guestCountInput = document.getElementById('guestCount');
        const venueAddressInput = document.getElementById('venueAddress');
        const haveVenueRadio = document.getElementById('haveVenue');
        const needVenueRadio = document.getElementById('needVenue');
        const serviceCheckboxes = document.querySelectorAll('.service-item input[type="checkbox"]');
        
        // Summary elements
        const summaryEventName = document.getElementById('summary-eventName');
        const summaryEventType = document.getElementById('summary-eventType');
        const summaryDate = document.getElementById('summary-date');
        const summaryGuests = document.getElementById('summary-guests');
        const summaryLocation = document.getElementById('summary-location');
        const summaryServices = document.getElementById('summary-services');
        
        // Toggle venue address field
        haveVenueRadio.addEventListener('change', toggleVenueAddress);
        needVenueRadio.addEventListener('change', toggleVenueAddress);
        
        function toggleVenueAddress() {
            const group = document.getElementById('venueAddressGroup');
            if (haveVenueRadio.checked) {
                group.style.display = 'block';
                venueAddressInput.setAttribute('required', 'required');
            } else {
                group.style.display = 'none';
                venueAddressInput.removeAttribute('required');
            }
        }
        
        // Initialize venue address visibility
        toggleVenueAddress();
        
        // Update summary when form changes
        function updateSummary() {
            // Event name
            summaryEventName.textContent = eventNameInput.value || 'Not set';
            
            // Event type
            const eventTypeText = eventTypeInput.options[eventTypeInput.selectedIndex]?.text || 'Not set';
            summaryEventType.textContent = eventTypeText;
            
            // Date
            if (startDateInput.value) {
                const startDate = new Date(startDateInput.value);
                const options = { month: 'short', day: 'numeric', year: 'numeric' };
                summaryDate.textContent = startDate.toLocaleDateString('en-US', options);
            } else {
                summaryDate.textContent = 'Not set';
            }
            
            // Guests
            summaryGuests.textContent = guestCountInput.value ? `${guestCountInput.value} guests` : 'Not set';
            
            // Location
            if (haveVenueRadio.checked && venueAddressInput.value) {
                summaryLocation.textContent = venueAddressInput.value.length > 30 
                    ? venueAddressInput.value.substring(0, 30) + '...' 
                    : venueAddressInput.value;
            } else if (needVenueRadio.checked) {
                summaryLocation.textContent = 'Need to find venue';
            } else {
                summaryLocation.textContent = 'Not set';
            }
            
            // Services
            const selectedServices = Array.from(serviceCheckboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.nextElementSibling.textContent);
            
            if (selectedServices.length > 0) {
                summaryServices.textContent = selectedServices.join(', ');
            } else {
                summaryServices.textContent = 'None selected';
            }
        }
        
        // Add event listeners to form inputs
        eventNameInput.addEventListener('input', updateSummary);
        eventTypeInput.addEventListener('change', updateSummary);
        startDateInput.addEventListener('change', updateSummary);
        endDateInput.addEventListener('change', updateSummary);
        guestCountInput.addEventListener('input', updateSummary);
        venueAddressInput.addEventListener('input', updateSummary);
        haveVenueRadio.addEventListener('change', updateSummary);
        needVenueRadio.addEventListener('change', updateSummary);
        
        serviceCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSummary);
        });
        
        
        // Button event listeners
        const submitBtn = document.querySelector('.btn-submit');
        submitBtn.addEventListener('click', function() {
            // Simple form validation
            if (!eventNameInput.value.trim()) {
                //write to span
                document.getElementById('eventName-span').textContent = 'Please enter an event name';
                eventNameInput.focus();
                return;
            }
            
            if (!eventTypeInput.value) {
                alert('Please select an event type');
                eventTypeInput.focus();
                return;
            }
            
            if (!startDateInput.value || !endDateInput.value) {
                alert('Please select both start and end dates');
                return;
            }
            
            if (!guestCountInput.value || parseInt(guestCountInput.value) < 1) {
                alert('Please enter a valid number of guests');
                guestCountInput.focus();
                return;
            }
            
            if (haveVenueRadio.checked && !venueAddressInput.value.trim()) {
                alert('Please enter your venue address');
                venueAddressInput.focus();
                return;
            }
            
            // If validation passes, submit the form
            submitForm();
            
        });
        
        
        
        // Initialize with current date/time for date inputs
        const now = new Date();
        const tomorrow = new Date(now);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        // Format for datetime-local input (YYYY-MM-DDTHH:MM)
        const formatForInput = (date) => {
            return date.toISOString().slice(0, 16);
        };
        
        startDateInput.value = formatForInput(now);
        endDateInput.value = formatForInput(tomorrow);
        
        // Initialize summary
        updateSummary();
        
        // Form submission
        function submitForm() {
            
            //send JSON data to server or process it as needed
            var xml = new XMLHttpRequest();

            xml.onload = function() {
                if (this.status == 200 || this.readyState == 4) {
                    var response = JSON.parse(this.responseText);
                    console.log(response);
                    alert(response.error || 'Event created successfully!');

                    //redirect to find services page
                    if(response.eventId == undefined){
                        window.location.href = URLROOT + "/Clients/createEvent";
                    }else{
                        window.location.href = URLROOT + "/Clients/findServices/" + response.eventId;
                    }
                    
}                
            };

            

            var data = setData();
           
            xml.open("POST", URLROOT + "/Clients/createEvent", true);
            xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xml.send(JSON.stringify(data));

        }


        function setData(){

            var data = {
                eventName: eventNameInput.value,
                eventType: eventTypeInput.value,
                eventDescription: eventDescriptionInput.value,
                startDate: startDateInput.value,
                endDate: endDateInput.value,
                guestCount: guestCountInput.value,
                venueAddress: venueAddressInput.value || '',
                haveVenue: (haveVenueRadio.checked)? "HAS_VENUE" : "NEED_VENUE",
                services: Array.from(serviceCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.getAttribute('id-number'))
            };

            return data;
        }
        
    });