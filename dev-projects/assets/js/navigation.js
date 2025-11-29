document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const primaryNav = document.querySelector('.main-navigation');
    
    if (menuToggle && primaryNav) {
        menuToggle.addEventListener('click', function() {
            primaryNav.classList.toggle('nav-open');
            menuToggle.classList.toggle('active');
            
            // Toggle aria-expanded for accessibility
            const isExpanded = primaryNav.classList.contains('nav-open');
            menuToggle.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        });
    }
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (primaryNav && primaryNav.classList.contains('nav-open') && 
            !primaryNav.contains(event.target) && 
            !menuToggle.contains(event.target)) {
            primaryNav.classList.remove('nav-open');
            menuToggle.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });
    
    // Handle keyboard navigation
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && primaryNav && primaryNav.classList.contains('nav-open')) {
            primaryNav.classList.remove('nav-open');
            menuToggle.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });
});