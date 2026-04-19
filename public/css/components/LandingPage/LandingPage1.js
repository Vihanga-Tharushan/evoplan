

// Card icon rotation function
function rotateIcon(element) {
  // Remove rotating class if it exists
  element.classList.remove("rotating");
  
  // Trigger reflow to restart animation
  void element.offsetWidth;
  
  // Add rotating class to start animation
  element.classList.add("rotating");
}

// Slideshow functionality
let currentSlideIndex = 0;
let slideTimer;

// Initialize slideshow
function initSlideshow() {
  showSlide(currentSlideIndex);
  autoSlide();
}

// Auto-play slideshow
function autoSlide() {
  slideTimer = setInterval(() => {
    currentSlideIndex = (currentSlideIndex + 1) % 6;
    showSlide(currentSlideIndex);
    updateDots();
  }, 5000); // Change slide every 5 seconds
}

// Manual slide navigation
function changeSlide(n) {
  clearInterval(slideTimer);
  currentSlideIndex = (currentSlideIndex + n + 6) % 6;
  showSlide(currentSlideIndex);
  updateDots();
  autoSlide(); // Restart auto-play
}

// Jump to specific slide
function currentSlide(n) {
  clearInterval(slideTimer);
  currentSlideIndex = n;
  showSlide(currentSlideIndex);
  updateDots();
  autoSlide(); // Restart auto-play
}

// Display slide
function showSlide(n) {
  const slides = document.querySelectorAll(".slide");
  
  // Handle negative index
  if (n < 0) {
    currentSlideIndex = slides.length - 1;
  } else if (n >= slides.length) {
    currentSlideIndex = 0;
  }
  
  // Remove active class from all slides
  slides.forEach(slide => slide.classList.remove("active"));
  
  // Add active class to current slide
  if (slides[currentSlideIndex]) {
    slides[currentSlideIndex].classList.add("active");
  }
}

// Update dot indicators
function updateDots() {
  const dots = document.querySelectorAll(".dot");
  dots.forEach((dot, index) => {
    dot.classList.remove("active");
    if (index === currentSlideIndex) {
      dot.classList.add("active");
    }
  });
}

// Initialize slideshow when DOM is ready
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initSlideshow);
} else {
  initSlideshow();
}

// Navbar opacity adjustment based on scroll position
function updateNavbarStyle() {
  const navbar = document.querySelector('.navbar');
  const heroSection = document.querySelector('.hero');
  const sections = document.querySelectorAll('section');
  
  let isOverLightSection = false;
  
  sections.forEach(section => {
    const sectionRect = section.getBoundingClientRect();
    // Check if navbar area overlaps with a light-background section
    if (sectionRect.top < 80 && sectionRect.bottom > 0) {
      if (section.classList.contains('light') || window.getComputedStyle(section).backgroundColor === 'rgb(255, 255, 255)') {
        isOverLightSection = true;
      }
    }
  });
  
  if (isOverLightSection) {
    navbar.style.background = 'rgba(11,16,38,0.15)';
    navbar.style.backdropFilter = 'blur(20px)';
  } else {
    navbar.style.background = 'rgba(11,16,38,0.4)';
    navbar.style.backdropFilter = 'blur(25px)';
  }
}

// Listen to scroll events
window.addEventListener('scroll', updateNavbarStyle);
