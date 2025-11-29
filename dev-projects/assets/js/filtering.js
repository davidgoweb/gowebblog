document.addEventListener('DOMContentLoaded', function() {
    const filterTags = document.querySelectorAll('.filter-tag');
    const projectsContainer = document.getElementById('projects-container');
    const difficultyFilter = document.getElementById('difficulty-filter');
    const searchForm = document.querySelector('.search-form');
    const searchInput = document.querySelector('.search-field');
    
    // Handle tag filtering
    if (filterTags.length > 0) {
        filterTags.forEach(tag => {
            tag.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tags
                filterTags.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tag
                this.classList.add('active');
                
                // Get the tag value
                const selectedTag = this.getAttribute('data-tag');
                
                // Update URL without page reload
                const url = new URL(window.location);
                if (selectedTag === 'all') {
                    url.searchParams.delete('project_tag');
                } else {
                    url.searchParams.set('project_tag', selectedTag);
                }
                
                // Reset to page 1
                url.searchParams.delete('paged');
                
                // Navigate to new URL
                window.location.href = url.toString();
            });
        });
    }
    
    // Handle difficulty filtering
    if (difficultyFilter) {
        difficultyFilter.addEventListener('change', function() {
            const selectedDifficulty = this.value;
            
            // Update URL
            const url = new URL(window.location);
            if (selectedDifficulty === '') {
                url.searchParams.delete('difficulty');
            } else {
                url.searchParams.set('difficulty', selectedDifficulty);
            }
            
            // Reset to page 1
            url.searchParams.delete('paged');
            
            // Navigate to new URL
            window.location.href = url.toString();
        });
    }
    
    // Handle search form
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            // Allow normal form submission for server-side search
            // The form will handle the search properly
        });
    }
    
    // Handle live search with AJAX (optional enhancement)
    if (searchInput) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const searchTerm = this.value.trim();
            
            // Only trigger search after user stops typing
            searchTimeout = setTimeout(function() {
                if (searchTerm.length >= 3) {
                    performLiveSearch(searchTerm);
                } else if (searchTerm.length === 0) {
                    // If search is cleared, reload the page
                    const url = new URL(window.location);
                    url.searchParams.delete('s');
                    url.searchParams.delete('paged');
                    window.location.href = url.toString();
                }
            }, 500);
        });
    }
    
    // Live search function
    function performLiveSearch(searchTerm) {
        // Show loading state
        if (projectsContainer) {
            projectsContainer.style.opacity = '0.5';
        }
        
        // Make AJAX request
        fetch(devProjects.ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'dev_projects_filter_projects',
                search: searchTerm,
                nonce: devProjects.nonce
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update projects container with new content
                if (projectsContainer) {
                    projectsContainer.innerHTML = data.html;
                    projectsContainer.style.opacity = '1';
                    
                    // Re-initialize event listeners for new content
                    initializeNewContent();
                }
            } else {
                console.error('Search failed:', data);
                // Fallback to full page reload
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Search error:', error);
            // Fallback to full page reload
            window.location.reload();
        });
    }
    
    // Initialize event listeners for dynamically loaded content
    function initializeNewContent() {
        // Re-attach event listeners to new filter tags if any
        const newFilterTags = document.querySelectorAll('.filter-tag');
        newFilterTags.forEach(tag => {
            tag.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = this.querySelector('a').href;
            });
        });
    }
    
    // Set initial active states based on current URL
    function setActiveStates() {
        const urlParams = new URLSearchParams(window.location.search);
        const currentTag = urlParams.get('project_tag');
        const currentDifficulty = urlParams.get('difficulty');
        
        // Set active tag
        filterTags.forEach(tag => {
            const tagValue = tag.getAttribute('data-tag');
            if ((currentTag === null && tagValue === 'all') || 
                (currentTag !== null && tagValue === currentTag)) {
                tag.classList.add('active');
            } else {
                tag.classList.remove('active');
            }
        });
        
        // Set active difficulty
        if (difficultyFilter) {
            difficultyFilter.value = currentDifficulty || '';
        }
    }
    
    // Initialize active states
    setActiveStates();
});