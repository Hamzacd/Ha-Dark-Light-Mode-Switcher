
    const darkModeColors = {
        '--e-global-color-primary': '#a67c42',
        '--e-global-color-secondary': '#2b2b2b',
        '--e-global-color-text': '#e0e0e0',
        '--e-global-color-accent': '#a67c42',
        '--e-global-color-color_1': '#a67c42',
        '--e-global-color-color_2': '#d4b89b',
        '--e-global-color-color_3': '#323232',
        '--e-global-color-color_4': '#8b5d2e',
        '--e-global-color-color_white': '#161B17',
        '--e-global-color-color_black': '#000000',
        '--e-global-color-color_grey': '#a3a3a3',
        '--e-global-color-color_error': '#ff6b6b',
        '--e-global-color-color_success': '#4caf50',
        '--e-global-color-color_alert': '#ff8c42',
    };

    function toggleDarkMode(isDark) {
        const root = document.querySelector('.elementor-kit-7');
        const stickyHeader = document.querySelector(".sticky-active");
        const rootH1 = document.querySelectorAll(".elementor-kit-7 h1");
        const rootH2 = document.querySelectorAll(".elementor-kit-7 h2"); 
        const ti_widget = document.querySelector(".ti-widget");
        console.log(ti_widget)
        if (isDark) {
            for (const [variable, value] of Object.entries(darkModeColors)) {
                root.style.setProperty(variable, value);
            }
            for (const item of Object.entries(rootH1)) {
                item[1].style.color= "#ffffff";
            }
            for (const item of Object.entries(rootH2)) {
                item[1].style.color= "#ffffff";
            }
            if (ti_widget) ti_widget.style.background = '#161B17';
   
            // rootH1.style.color = "#ffffff";
            // rootH2.style.color = "#ffffff";
            document.body.style.backgroundColor = "grey";
            if (stickyHeader) stickyHeader.style.background = 'grey';
            localStorage.setItem('themeMode', 'dark');
        } else {
            root.style.cssText = ''; // Reset all inline styles on .elementor-kit-7
            document.body.style.backgroundColor = "";
            for (const item of Object.entries(rootH1)) {
                item[1].style.color= "";
            }
            for (const item of Object.entries(rootH2)) {
                item[1].style.color= "";
            }
            if (ti_widget) ti_widget.style.background = '';
            if (stickyHeader) stickyHeader.style.background = '';
            localStorage.setItem('themeMode', 'light');
        }
    }

    // Scroll event listener to handle sticky header background
    window.addEventListener("scroll", () => {
        const stickyHeader = document.querySelector(".sticky-active");
        const isDark = localStorage.getItem('themeMode') === 'dark';
        if (stickyHeader) stickyHeader.style.background = isDark ? 'grey' : '';
    });

    // Check stored preference on page load
    const storedMode = localStorage.getItem('themeMode');
    if (storedMode === 'dark') {
        toggleDarkMode(true);
    }

    // Event listener for toggle button
    document.getElementById('theme-toggle-button').addEventListener('click', () => {
        const isDark = localStorage.getItem('themeMode') !== 'dark';
        toggleDarkMode(isDark);
        document.getElementById('theme-toggle-button').classList.toggle('light', !isDark);
    });

