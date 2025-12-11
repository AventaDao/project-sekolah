// Christmas Animation - Snowflake & Santa
document.addEventListener('DOMContentLoaded', function() {
    
    // ===== SNOWFLAKE ANIMATION =====
    function createSnowflakes() {
        const snowflakeContainer = document.querySelector('.snowflakes-container');
        if (!snowflakeContainer) return;

        // Create snowflakes
        for (let i = 0; i < 50; i++) {
            const snowflake = document.createElement('div');
            snowflake.classList.add('snowflake');
            snowflake.textContent = '❄';
            
            // Random properties
            snowflake.style.left = Math.random() * 100 + '%';
            snowflake.style.fontSize = Math.random() * 10 + 10 + 'px';
            snowflake.style.opacity = Math.random() * 0.5 + 0.5;
            snowflake.style.animationDuration = (Math.random() * 10 + 10) + 's';
            snowflake.style.animationDelay = Math.random() * 2 + 's';
            
            snowflakeContainer.appendChild(snowflake);
        }
    }

    // ===== SANTA ANIMATION =====
    function createSanta() {
        const santaContainer = document.querySelector('.santa-container');
        if (!santaContainer) return;

        const santa = document.createElement('div');
        santa.classList.add('santa');
        santa.innerHTML = '🎅';
        
        santaContainer.appendChild(santa);
    }

    // Initialize
    createSnowflakes();
    createSanta();

});
