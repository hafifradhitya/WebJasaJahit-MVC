// ======================================================
// WAIT FOR DOM TO BE FULLY LOADED
// ======================================================
document.addEventListener('DOMContentLoaded', function() {
  
  // ======================================================
  // HERO SLIDER FUNCTIONALITY
  // ======================================================
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');
  const indicators = document.querySelectorAll('.indicator');
  const totalSlides = slides.length;
  let slideInterval;

  function showSlide(index) {
    // Remove active class from all slides and indicators
    slides.forEach(slide => slide.classList.remove('active'));
    indicators.forEach(indicator => indicator.classList.remove('active'));
    
    // Add active class to current slide and indicator
    slides[index].classList.add('active');
    indicators[index].classList.add('active');
  }

  window.nextSlide = function() {
    currentSlide = (currentSlide + 1) % totalSlides;
    showSlide(currentSlide);
    resetInterval();
  }

  window.previousSlide = function() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    showSlide(currentSlide);
    resetInterval();
  }

  window.currentSlide = function(n) {
    currentSlide = n - 1;
    showSlide(currentSlide);
    resetInterval();
  }

  // Auto slide every 5 seconds
  function startInterval() {
    slideInterval = setInterval(() => {
      window.nextSlide();
    }, 5000);
  }

  function resetInterval() {
    clearInterval(slideInterval);
    startInterval();
  }

  // Start auto-sliding when page loads
  if (slides.length > 0) {
    startInterval();
  }

  // ======================================================
  // FILTER LAYANAN JAHIT (SERVICE CARDS)
  // ======================================================
  const filterButtons = document.querySelectorAll('.tp-filter');
  const cards = document.querySelectorAll('.tp-card');

  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      // Remove active class from all buttons
      filterButtons.forEach(btn => {
        btn.classList.remove('active');
        btn.setAttribute('aria-selected', 'false');
      });
      
      // Add active class to clicked button
      button.classList.add('active');
      button.setAttribute('aria-selected', 'true');
      
      // Get filter value
      const filterValue = button.getAttribute('data-filter');
      
      // Filter cards with animation
      cards.forEach(card => {
        const category = card.getAttribute('data-category');
        
        if (filterValue === 'all' || category === filterValue) {
          card.classList.remove('hidden');
          // Add animation
          card.style.animation = 'fadeInUp 0.5s ease forwards';
        } else {
          card.classList.add('hidden');
        }
      });
    });
  });

  // Add CSS animation for cards
  const style = document.createElement('style');
  style.textContent = `
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  `;
  document.head.appendChild(style);

  // ======================================================
  // BURGER MENU FUNCTIONALITY - FIXED VERSION
  // ======================================================
  const burgerMenu = document.getElementById('burgerMenu');
  const mobileMenu = document.getElementById('mobileMenu');
  const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
  const mobileMenuClose = document.getElementById('mobileMenuClose');
  const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');

  // Debug: Check if elements exist
  console.log('🍔 Burger Menu Elements Check:');
  console.log('burgerMenu:', burgerMenu);
  console.log('mobileMenu:', mobileMenu);
  console.log('mobileMenuOverlay:', mobileMenuOverlay);
  console.log('mobileMenuClose:', mobileMenuClose);

  // Function to open mobile menu
  function openMobileMenu() {
    console.log('📱 Opening mobile menu...');
    if (mobileMenu && mobileMenuOverlay && burgerMenu) {
      mobileMenu.classList.add('active');
      mobileMenuOverlay.classList.add('active');
      burgerMenu.classList.add('active');
      document.body.classList.add('menu-open');
      console.log('✅ Mobile menu opened!');
    } else {
      console.error('❌ Missing elements for opening menu!');
    }
  }

  // Function to close mobile menu
  function closeMobileMenu() {
    console.log('📱 Closing mobile menu...');
    if (mobileMenu && mobileMenuOverlay && burgerMenu) {
      mobileMenu.classList.remove('active');
      mobileMenuOverlay.classList.remove('active');
      burgerMenu.classList.remove('active');
      document.body.classList.remove('menu-open');
      console.log('✅ Mobile menu closed!');
    }
  }

  // Burger menu click event
  if (burgerMenu) {
    burgerMenu.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      console.log('🍔 Burger clicked!');
      
      if (mobileMenu.classList.contains('active')) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });
    console.log('✅ Burger menu event listener attached!');
  } else {
    console.error('❌ Burger menu element not found!');
  }

  // Close button click event
  if (mobileMenuClose) {
    mobileMenuClose.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      console.log('❌ Close button clicked!');
      closeMobileMenu();
    });
  }

  // Overlay click event
  if (mobileMenuOverlay) {
    mobileMenuOverlay.addEventListener('click', function(e) {
      console.log('🖱️ Overlay clicked!');
      closeMobileMenu();
    });
  }

  // Close menu when clicking a link
  mobileMenuLinks.forEach(link => {
    link.addEventListener('click', () => {
      console.log('🔗 Menu link clicked!');
      closeMobileMenu();
    });
  });

  // Close menu on ESC key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
      console.log('⌨️ ESC pressed!');
      closeMobileMenu();
    }
  });

  // ======================================================
  // SMOOTH SCROLL FOR ANCHOR LINKS
  // ======================================================
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      
      // Skip if href is just "#"
      if (href === '#') return;
      
      e.preventDefault();
      const target = document.querySelector(href);
      
      if (target) {
        const headerOffset = 80; // Adjust based on your header height
        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        
        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // ======================================================
  // HEADER SCROLL EFFECT
  // ======================================================
  const mainHeader = document.querySelector('.main-header');
  let lastScroll = 0;

  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    // Add shadow on scroll
    if (currentScroll > 50) {
      mainHeader.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.3)';
    } else {
      mainHeader.style.boxShadow = 'none';
    }
    
    lastScroll = currentScroll;
  });

  // ======================================================
  // CARD HOVER EFFECT ENHANCEMENT
  // ======================================================
  const tpCards = document.querySelectorAll('.tp-card');

  tpCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-10px)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });

  // ======================================================
  // IMAGE LAZY LOAD OPTIMIZATION
  // ======================================================
  if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src || img.src;
          img.classList.add('loaded');
          observer.unobserve(img);
        }
      });
    });
    
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => imageObserver.observe(img));
  }

  // ======================================================
  // WINDOW RESIZE HANDLER
  // ======================================================
  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      // Close mobile menu on resize to desktop
      if (window.innerWidth > 768 && mobileMenu && mobileMenu.classList.contains('active')) {
        closeMobileMenu();
      }
      
      // Update timeline progress
      updateTimelineProgress();
    }, 250);
  });

  // ======================================================
  // PAGE LOAD ANIMATIONS
  // ======================================================
  // Add loaded class to body for CSS animations
  document.body.classList.add('page-loaded');
  
  // Animate elements on load
  const animateOnLoad = document.querySelectorAll('.feature-item, .tp-card, .km-item');
  animateOnLoad.forEach((el, index) => {
    setTimeout(() => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = 'all 0.6s ease';
      
      setTimeout(() => {
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
      }, 50);
    }, index * 50);
  });

  // ======================================================
  // ACCESSIBILITY IMPROVEMENTS
  // ======================================================
  // Add keyboard navigation for filter buttons
  filterButtons.forEach((button, index) => {
    button.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowRight') {
        e.preventDefault();
        const nextButton = filterButtons[index + 1] || filterButtons[0];
        nextButton.focus();
      }
      if (e.key === 'ArrowLeft') {
        e.preventDefault();
        const prevButton = filterButtons[index - 1] || filterButtons[filterButtons.length - 1];
        prevButton.focus();
      }
    });
  });

}); // END DOMContentLoaded

// ======================================================
// END OF JAVASCRIPT
// ======================================================