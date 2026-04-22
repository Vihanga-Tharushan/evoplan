
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
let totalSlides = 0;

// Initialize slideshow
function initSlideshow() {
  const slides = document.querySelectorAll(".slide");
  totalSlides = slides.length;
  
  // Only initialize if there are slides
  if (totalSlides > 0) {
    showSlide(currentSlideIndex);
    if (totalSlides > 1) {
      autoSlide();
    }
  }
}

// Auto-play slideshow
function autoSlide() {
  slideTimer = setInterval(() => {
    if (totalSlides > 0) {
      currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
      showSlide(currentSlideIndex);
      updateDots();
    }
  }, 5000); // Change slide every 5 seconds
}

// Manual slide navigation
function changeSlide(n) {
  if (totalSlides <= 1) return;
  clearInterval(slideTimer);
  currentSlideIndex = (currentSlideIndex + n + totalSlides) % totalSlides;
  showSlide(currentSlideIndex);
  updateDots();
  autoSlide(); // Restart auto-play
}

// Jump to specific slide
function currentSlide(n) {
  if (totalSlides <= 1) return;
  clearInterval(slideTimer);
  currentSlideIndex = n;
  showSlide(currentSlideIndex);
  updateDots();
  autoSlide(); // Restart auto-play
}

// Display slide
function showSlide(n) {
  const slides = document.querySelectorAll(".slide");
  
  if (slides.length === 0) return;
  
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
