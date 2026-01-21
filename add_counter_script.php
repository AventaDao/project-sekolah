<?php

$file = 'c:/project-sekolah/resources/views/admin/dashboard.blade.php';
$content = file_get_contents($file);

$script = <<<'SCRIPT'


<script>
// Counter Animation
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count')) || 0;
        const duration = 1500; // Animation duration in milliseconds
        const increment = target / (duration / 16); // 60 FPS
        let current = 0;
        
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        
        // Start animation when element is in viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(counter);
    });
});
</script>
SCRIPT;

// Replace </style> with </style> + script
$content = str_replace('</style>', '</style>' . $script, $content);

file_put_contents($file, $content);

echo "Counter animation script added successfully!\n";
