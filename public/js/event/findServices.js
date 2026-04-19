document.addEventListener('DOMContentLoaded', function() {

    // Store required services for recommendation filtering
    let requiredServices = [];

    //get packages from database
    getPackages();

    // If the view provided an EVENT_ID, fetch required services for that event
    if (typeof EVENT_ID !== 'undefined' && EVENT_ID !== null) {
        fetchRequiredServices(EVENT_ID);
    }

    // Fetch and store required services
    function fetchRequiredServices(eventId) {
        var xml = new XMLHttpRequest();
        xml.onload = function(){
            if(this.readyState == 4 && this.status == 200){
                var response = JSON.parse(this.responseText);
                console.log('Required services:', response);
                requiredServices = response;
            }
        };
        xml.open("GET", URLROOT + "/Clients/getRequiredServices/" + encodeURIComponent(eventId), true);
        xml.send();
    }

    // Price Range Slider Functionality
    const rangeInput = document.querySelectorAll(".range-input input");
    const priceInput = document.querySelectorAll(".price-input input");
    const progress = document.querySelector(".slider .progress");
    let priceGap = 1000;

    priceInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minPrice = parseInt(priceInput[0].value),
                maxPrice = parseInt(priceInput[1].value);
                
            // Ensure min price is not greater than max price
            if (minPrice > maxPrice) {
                priceInput[0].value = maxPrice;
                minPrice = maxPrice;
            }
            
            // Ensure values stay within bounds
            if (minPrice < 0) priceInput[0].value = 0;
            if (maxPrice > 100000) priceInput[1].value = 100000;
            maxPrice = Math.min(maxPrice, 100000);
            
            if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                if (e.target.className === "input-min") {
                    rangeInput[0].value = minPrice;
                    progress.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                } else {
                    rangeInput[1].value = maxPrice;
                    progress.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                }
            }
            
            // Apply filtering
            applyFilters();
        });
    });

    rangeInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minVal = parseInt(rangeInput[0].value),
                maxVal = parseInt(rangeInput[1].value);

            if (maxVal - minVal < priceGap) {
                if (e.target.className === "range-min") {
                    rangeInput[0].value = maxVal - priceGap;
                    minVal = maxVal - priceGap;
                } else {
                    rangeInput[1].value = minVal + priceGap;
                    maxVal = minVal + priceGap;
                }
            }
            
            // Update input fields
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            
            // Update progress bar
            progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
            progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
            
            // Apply filtering
            applyFilters();
        });
    });

    // Apply filters to package cards
    function applyFilters() {


        const minPrice = parseInt(priceInput[0].value);
        const maxPrice = parseInt(priceInput[1].value);
        const minRating = document.getElementById('min-rating').value;
        const activeCategory = document.querySelector('.category-btn.active').dataset.category;
        
        document.querySelectorAll('.package-card').forEach(card => {
            const cardPrice = parseInt(card.dataset.price);
            const cardRating = parseFloat(card.dataset.rating);
            const cardCategory = card.dataset.category;
            
            // Check price filter
            const priceMatch = cardPrice >= minPrice && cardPrice <= maxPrice;
            
            // Check rating filter
            let ratingMatch = true;
            if (minRating.startsWith('4.5')) {
                ratingMatch = cardRating >= 4.5;
            } else if (minRating.startsWith('4.0')) {
                ratingMatch = cardRating >= 4.0;
            } else if (minRating.startsWith('3.5')) {
                ratingMatch = cardRating >= 3.5;
            } else if (minRating.startsWith('3.0')) {
                ratingMatch = cardRating >= 3.0;
            }
            
            // Check category filter - case insensitive comparison
            let categoryMatch = false;
            if (activeCategory === 'all') {
                // Show all packages
                categoryMatch = true;
            } else if (activeCategory === 'recommendation') {
                // Show only packages matching required service types
                if (requiredServices.length > 0) {
                    // Check if card category matches any required service type
                    categoryMatch = requiredServices.some(service => 
                        service.service_type.toLowerCase() === cardCategory.toLowerCase()
                    );
                } else {
                    // If no required services loaded yet, show all packages
                    categoryMatch = true;
                }
            } else if (activeCategory === 'your-favourites') {
                // TODO: Implement favourites logic when available
                categoryMatch = false;
            } else {
                // Case-insensitive comparison for other categories
                categoryMatch = cardCategory.toLowerCase() === activeCategory.toLowerCase();
            }
            
            // Show or hide card based on filters
            if (priceMatch && ratingMatch && categoryMatch) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Category navigation
    const categoryButtons = document.querySelectorAll('.category-btn');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active state
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            // Apply filters with new category
            applyFilters();
        });
    });
    
    // Rating filter change
    document.getElementById('min-rating').addEventListener('change', applyFilters);
    
    // Sort functionality
    document.getElementById('sort-by').addEventListener('change', function() {
        const sortBy = this.value;
        const cardsContainer = document.querySelector('.packages-grid');
        const cards = Array.from(document.querySelectorAll('.package-card'));
        
        // Only sort visible cards
        const visibleCards = cards.filter(card => card.style.display !== 'none');
        
        if (sortBy === 'Price: Low to High') {
            visibleCards.sort((a, b) => parseInt(a.dataset.price) - parseInt(b.dataset.price));
        } else if (sortBy === 'Price: High to Low') {
            visibleCards.sort((a, b) => parseInt(b.dataset.price) - parseInt(a.dataset.price));
        } else if (sortBy === 'Highest Rating') {
            visibleCards.sort((a, b) => parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating));
        } else if (sortBy === 'Most Popular') {
            // In a real app, we would have popularity data
            visibleCards.sort((a, b) => parseInt(b.dataset.rating) - parseInt(a.dataset.rating));
        }
        
        // Reorder the cards
        visibleCards.forEach(card => {
            cardsContainer.appendChild(card);
        });
    });

    // Reset filters
    document.querySelector('.reset-filters').addEventListener('click', function() {
        // Reset price range
        priceInput[0].value = '0';
        priceInput[1].value = '100000';
        rangeInput[0].value = '0';
        rangeInput[1].value = '100000';
        progress.style.left = '0%';
        progress.style.right = '80%';
        
        // Reset sort and rating
        document.getElementById('sort-by').value = 'Highest Rating';
        document.getElementById('min-rating').value = 'All Ratings';
        
        // Reset category
        categoryButtons.forEach(btn => btn.classList.remove('active'));
        document.querySelector('.category-btn[data-category="all"]').classList.add('active');
        
        // Apply filters to show all cards
        applyFilters();
    });
    
    // add Packages button functionality (using event delegation for dynamically loaded buttons)
    const packageList = document.getElementById('package-list');
    const packageCount = document.getElementById('package-count');
    const checkoutBtn = document.querySelector('.checkout-btn');
    const budgetValue = document.querySelector('.total-budget');
    
    let selectedCount = 0;
    let totalBudget = 0;
    let selectedPackageIds = []; // Array to store selected package IDs
    let selectedPackageOwnersIDs = []; // Array to store selected package owner IDs
    
    // Use event delegation on the packages grid
    document.querySelector('.packages-grid').addEventListener('click', function(e) {
        if (e.target.classList.contains('add-packages') || e.target.closest('.add-packages')) {
            const button = e.target.classList.contains('add-packages') ? e.target : e.target.closest('.add-packages');
            const card = button.closest('.package-card');
            const title = card.querySelector('.package-title').textContent;
            const packageId = card.querySelector('.package-title').getAttribute('package-id');
            const priceText = card.querySelector('.price').textContent;
            const category = card.getAttribute('data-category');

            // Add package ID to the array
            selectedPackageIds.push(packageId);
            selectedPackageOwnersIDs.push(card.querySelector('.package-title').getAttribute('service-id'));
            console.log('Selected Package IDs:', selectedPackageIds);

            //convert addpackage button unclickable after clicked
            button.disabled = true;
            button.textContent = "Added";
            button.style.cursor = "not-allowed";

            //store package data


            let priceValue = 0;
            priceValue = priceText.replace(/[^0-9-]+/g,"");
                // Remove non-numeric characters
            priceValue = parseFloat(priceValue/100);
            
            // Add to selected packages
            if (document.querySelector('.no-packages')) {
                document.querySelector('.no-packages').remove();
            }
            
            const packageItem = document.createElement('div');
            packageItem.className = 'package-item';
            packageItem.setAttribute('data-package-id', packageId);
            packageItem.innerHTML = `
                <div>
                    <span class="package-name">${title}</span>
                    <div class="package-category">${category.charAt(0).toUpperCase() + category.slice(1)}</div>
                </div>
                <span class="remove-package">Remove</span>
            `;
            
            packageList.appendChild(packageItem);
            
            // Update counts
            selectedCount++;
            packageCount.textContent = `${selectedCount} package${selectedCount === 1 ? '' : 's'} selected`;
            
            // Update budget
            totalBudget += priceValue;
            budgetValue.textContent = `Rs.${totalBudget.toFixed(2)}`;
            
            // Update other budget values
            document.querySelector('.budget-value.subtotal').textContent = `Rs.${totalBudget.toFixed(2)}`;
            document.querySelector('.budget-value.tax').textContent = `Rs.${(totalBudget * 0.00).toFixed(2)}`; // 5% tax
            document.querySelector('.budget-value.service-fee').textContent = `Rs.${(totalBudget * 0.0).toFixed(2)}`; // 10% service fee
            
            // Enable checkout button if at least one package is selected
            if (selectedCount > 0) {
                checkoutBtn.disabled = false;
                checkoutBtn.style.opacity = 1;
               
            }
            
            // Add remove functionality
            packageItem.querySelector('.remove-package').addEventListener('click', function() {
                // Remove package ID from the array
                const removedPackageId = packageItem.getAttribute('data-package-id');
                const index = selectedPackageIds.indexOf(removedPackageId);
                if (index > -1) {
                    selectedPackageIds.splice(index, 1);
                    selectedPackageOwnersIDs.splice(index, 1);
                }
                console.log('Selected Package IDs:', selectedPackageIds);
                
                packageItem.remove();
                
                // Re-enable the corresponding add button
                button.disabled = false;
                button.textContent = "Add";
                button.style.cursor = "pointer";


                // Update counts
                selectedCount--;
                packageCount.textContent = `${selectedCount} package${selectedCount === 1 ? '' : 's'} selected`;
                
                // Update budget
                totalBudget -= priceValue;
                budgetValue.textContent = `Rs.${totalBudget.toFixed(2)}`;
                
                document.querySelector('.budget-value.subtotal').textContent = `Rs.${totalBudget.toFixed(2)}`;
                document.querySelector('.budget-value.tax').textContent = `Rs.${(totalBudget * 0.00).toFixed(2)}`;
                document.querySelector('.budget-value.service-fee').textContent = `Rs.${(totalBudget * 0.0).toFixed(2)}`;
                
                // Disable checkout button if no packages selected
                if (selectedCount === 0) {
                    checkoutBtn.disabled = true;
                    checkoutBtn.style.opacity = 0.7;
            
                    // Show no packages message if needed
                    if (packageList.children.length === 0) {
                        const emptyMsg = document.createElement('div');
                        emptyMsg.className = 'no-packages';
                        emptyMsg.textContent = 'No packages selected yet';
                        packageList.appendChild(emptyMsg);
                    }
                }
            });
        }
    });

    //view package onclick popup
    document.querySelector('.packages-grid').addEventListener('click', function(e) {
        if (e.target.classList.contains('view-packages') || e.target.closest('.view-packages')) {
            const button = e.target.classList.contains('view-packages') ? e.target : e.target.closest('.view-packages');
            const card = button.closest('.package-card');
            const title = card.querySelector('.package-title').textContent;
            const packageId = card.querySelector('.package-title').getAttribute('package-id');
            const serviceId = card.querySelector('.package-title').getAttribute('service-id');
            const description = card.querySelector('.package-description').getAttribute('data');
            const priceText = card.querySelector('.price').textContent;
            const imageUrl = card.querySelector('.card-image img')?.src || URLROOT + '/img/default-package.jpg';
            const category = card.getAttribute('data-category');
            
            // Extract provider data
            const providerName = card.querySelector('.provider-name')?.textContent || 'Service Provider';
            const providerAvatar = card.querySelector('.provider-avatar img')?.src || URLROOT + '/img/default-avatar.png';
            const ratingValue = card.querySelector('.rating-value')?.textContent || '0.0';
            const reviewCountText = card.querySelector('.rating-count')?.textContent || '(0 reviews)';
            const reviewCount = reviewCountText.match(/\d+/)?.[0] || '0';
            
            const popupOverlay = document.getElementById('package-popup-overlay');
            const popupContent = document.getElementById('popup-content');

            //assign data to popup elements
            popupContent.querySelector('.popup-header h2').textContent = title;
            popupContent.querySelector('.popup-header span').textContent = category.charAt(0).toUpperCase() + category.slice(1);
            popupContent.querySelector('.popup-details .package-description').textContent = description;
            popupContent.querySelector('.popup-details .provider-avatar img').src = providerAvatar;
            popupContent.querySelector('.popup-details .provider-name').textContent = providerName;
            popupContent.querySelector('.popup-details .rating-value').textContent = ratingValue;
            popupContent.querySelector('.popup-details .rating-count').textContent = `(${reviewCount} reviews)`;
            popupContent.querySelector('.popup-details .popup-price').textContent = priceText;
            popupContent.querySelector('.popup-details .provider-info').href = URLROOT + '/clients/viewprovider/' + encodeURIComponent(serviceId);


            //add button functionality inside popup it activates card add button
            const addButton = popupContent.querySelector('.add-packages');
            addButton.onclick = function() {
                // Find the corresponding add button in the package card
                const correspondingAddButton = card.querySelector('.add-packages');
                if (correspondingAddButton && !correspondingAddButton.disabled) {
                    correspondingAddButton.click(); // Trigger click on the card's add button
                    closePopup(); // Close the popup after adding
                }

                //if already added
                else {
                    alert("Package already added.");
                }
            };

            

            
            
            popupOverlay.style.display = 'flex';
            // Prevent background scrolling
            document.body.style.overflow = 'hidden';
            
            // Close popup functionality
            document.getElementById('close-popup').onclick = function() {
                closePopup();
            }
        }
    });
    
    // Close popup when clicking outside the popup card
    document.getElementById('package-popup-overlay').addEventListener('click', function(e) {
        if (e.target === this) {
            closePopup();
        }
    });
    
    // Function to close popup and restore scrolling
    function closePopup() {
        document.getElementById('package-popup-overlay').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // close popup on Escape key (minimal, safe)
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // only close if overlay is visible
            const overlay = document.getElementById('package-popup-overlay');
            if (overlay && overlay.style.display === 'flex') {
                closePopup();
            }
        }
    });

    //submit package selections and proceed to checkout
    document.querySelector(".checkout-btn").addEventListener('click', function() {
        if (selectedPackageIds.length === 0) {
            alert("Please select at least one package to proceed to checkout.");
            return;
        }
        else{
            // Prepare data to send
            const data = {
                eventId: EVENT_ID,
                packageIds: selectedPackageIds,
                ownerIds: selectedPackageOwnersIDs
            };

            // Send data via POST
            proceedToCheckout(data);
        }
    });
});


//get package from database
function getPackages(){

    var xml = new XMLHttpRequest();

    xml.onload = function(){

        if(this.readyState == 4 || this.status == 200){
            var response = JSON.parse(this.responseText);
            console.log(response);
            displayPackages(response);
        }

    };

    xml.open("GET", URLROOT + "/Clients/getPackages", true);
    xml.send();
}

function displayPackages(packages){
    console.log(packages.length);
    //display packages in the packages grid
    for(var i=0; i<packages.length; i++){
        //create package card element
        var packageCard = document.createElement("div");
        packageCard.className = "package-card";
        packageCard.setAttribute("data-category", packages[i].serviceType);
        packageCard.setAttribute("data-price", packages[i].price);
        packageCard.setAttribute("data-rating", packages[i].avg_rating);

        var package_description = packages[i].details.length > 100 ? packages[i].details.substring(0, 100) + "..." : packages[i].details;

        packageCard.innerHTML = `
            <div class="card-image">
                <img src="${URLROOT + '/img/packageImg/' + packages[i].bg_image_name}" alt="${packages[i].title}">
            </div>
            <div class="card-content">
                <h3 class="package-title" package-id="${packages[i].package_id}" service-id="${packages[i].service_id}">${packages[i].title}</h3>
                <p class="package-description" data="${packages[i].details}">${package_description}</p>
                <a href="${URLROOT + '/clients/viewprovider/' + encodeURIComponent(packages[i].service_id)}" class="provider-info">
                <div class="provider-avatar">
                    <img src="${URLROOT + '/img/profilePics/' + packages[i].profile_pic}" alt="Provider">
                </div>
                <div class="provider-details">
                    <span class="provider-name">${packages[i].provider_name}</span>
                    <span class="provider-badge">Verified Provider</span>
                </div>
                </a>
                <div class="rating">
                    <div class="stars">★★★★★</div>
                    <span class="rating-value">${packages[i].avg_rating}</span>
                    <span class="rating-count">(${packages[i].total_reviews} reviews)</span>
                </div>
                
                <!--<div class="tags">
                    <span class="tag">${packages[i].tag}</span>
                </div>-->
                <span class="price-label">Starting from</span>
                <span class="price">Rs.${packages[i].price}</span>
                <div class="card-actions">
                <button class="view-packages">View Package</button>
                <button class="add-packages">Add Package</button>
            </div>
            </div>
        `;

        // Append the package card to the packages grid
        document.querySelector(".packages-grid").appendChild(packageCard);
    }
}


function sendConfirmations(){
    //send confirmation to providers about the event booking


}


function proceedToCheckout(data){

    var xml = new XMLHttpRequest();
    
    xml.onload = function(){
        if(this.readyState == 4 && this.status == 200){
            var response = JSON.parse(this.responseText);
            
            window.location.href = URLROOT + "/clients/previewEvent/" + encodeURIComponent(EVENT_ID);
        }
    };
    xml.open("POST", URLROOT + "/clients/addPackageToEvent", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(JSON.stringify(data));
}


