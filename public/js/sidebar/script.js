(function(){   
    function setupSidebar() {
        const toggle = document.querySelector('.collapse');
        const sidebar = document.getElementById('component');
        
        if (!toggle || !sidebar) {
            console.error('Sidebar elements not found');
            return;
        }

        // Check if sidebar was previously collapsed (localStorage)
        const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (wasCollapsed) {
            sidebar.classList.add('collapsed');
        }

        toggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            
            // Save state to localStorage
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
            
            // Add visual feedback
            toggle.style.transform = isCollapsed ? 'rotate(180deg)' : 'rotate(0deg)';
        });

        // Add keyboard support
        toggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggle.click();
            }
        });

        // Add hover effects for better UX
        const menuItems = document.querySelectorAll('.frame-default a');
        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                if (sidebar.classList.contains('collapsed')) {
                    // Show tooltip or expand slightly on hover
                    this.style.transform = 'scale(1.05)';
                }
            });
            
            item.addEventListener('mouseleave', function() {
                if (sidebar.classList.contains('collapsed')) {
                    this.style.transform = 'scale(1)';
                }
            });
        });
    }

    window.addEventListener('DOMContentLoaded', function() {
        setupSidebar();
    });
})();
