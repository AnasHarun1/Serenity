/**
 * Earth Tone UI Interactions
 */

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Initialize Chart.js Defaults
    if (typeof Chart !== 'undefined') {
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.color = document.documentElement.classList.contains('dark') ? '#a3968c' : '#8A7E72';
        Chart.defaults.scale.grid.color = 'transparent';
    }

    // 2. Add Ripple Effect to Buttons
    const buttons = document.querySelectorAll('button, .btn-earth');
    buttons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            let x = e.clientX - e.target.offsetLeft;
            let y = e.clientY - e.target.offsetTop;
            
            let ripples = document.createElement('span');
            ripples.style.left = x + 'px';
            ripples.style.top = y + 'px';
            ripples.classList.add('ripple');
            this.appendChild(ripples);

            setTimeout(() => {
                ripples.remove()
            }, 1000);
        });
    });

    // 3. Smooth Page Transitions
    document.body.classList.add('opacity-100');
    
    document.querySelectorAll('a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            if (this.hostname === window.location.hostname && this.getAttribute('href').startsWith('/')) {
                // e.preventDefault(); // Optional: if we want full SPA feel (requires more work)
                // document.body.style.opacity = 0;
                // setTimeout(() => {
                //     window.location = this.href;
                // }, 300);
            }
        });
    });
});
