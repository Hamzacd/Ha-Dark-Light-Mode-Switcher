jQuery(document).ready(function ($) {


    let isDarkMode = false;

    const originalStyles = new Map();

    $('#wpdlms-switch-button').on('click', function () {
        if (isDarkMode) {
            revertToOriginal();
            $(this).text('Switch to Dark Mode');
    
        } else {
            applyDarkMode();
            $(this).text('Switch to Light Mode');
        }
        isDarkMode = !isDarkMode;
    });
    function isHexColor(color) {
        const hexRegex = /^#([A-Fa-f0-9]{3}){1,2}$/;
        return hexRegex.test(color);
    }
    function applyDarkMode() {
        for (let color in wpdlmsColors) {
            const elements = findElementsWithComputedColor(hexToRgb(color));
    
            elements.forEach(element => {
                // Store original styles if not already stored
                if (!originalStyles.has(element)) {
                    originalStyles.set(element, {
                        color: element.style.color,
                        backgroundColor: element.style.backgroundColor,
                        fill: element.style.fill,
                        hoverColor: getHoverColor(element) // Get current hover color
                    });
                }
    
                const computedStyle = window.getComputedStyle(element);
                document.body.style.backgroundColor = "grey"; // Setting body background color
    
                // Change background color
                if (computedStyle.backgroundColor === hexToRgb(color) || computedStyle.backgroundColor === color) {
                    element.style.backgroundColor = wpdlmsColors[color];
                }
    
                // Change text color
                if (computedStyle.color === hexToRgb(color) || computedStyle.color === color) {
                    element.style.color = wpdlmsColors[color];
                }
    
                // Change fill color
                if (computedStyle.fill === hexToRgb(color) || computedStyle.fill === color) {
                    element.style.fill = wpdlmsColors[color];
                }
    
                // Change hover color only if the element is suitable for hover styling
                if (isHoverableElement(element)) {
                    applyDarkModeHoverEffect(element,color, wpdlmsColors[color]);
                }
            });
        }
    }
    
    // Function to determine if the element is suitable for hover styling
    function isHoverableElement(element) {
        // Define your criteria for hoverable elements, for example:
        return element.matches('a, button, .elementor-button, .elementor-widget, [style*="cursor: pointer"]');
    }
    
    // Function to get the current hover color
    function getHoverColor(element) {
        const hoverStyle = window.getComputedStyle(element, ':hover');
        return hoverStyle.color || hoverStyle.backgroundColor || hoverStyle.fill || ''; 
    }
 
    function rgbaToHex(rgba) {
        const matches = rgba.match(/(\d+),\s*(\d+),\s*(\d+)/);
        if (!matches) return '#000000';
        return `#${parseInt(matches[1]).toString(16).padStart(2, '0')}${parseInt(matches[2]).toString(16).padStart(2, '0')}${parseInt(matches[3]).toString(16).padStart(2, '0')}`;
    }
    
    // Function to sanitize color input for valid class names
    function generateClassNameFromColor(color) {
        const sanitizedColor = color.startsWith('rgba') ? rgbaToHex(color) : color;
        return `dark-mode-hover-${sanitizedColor.replace(/[^a-zA-Z0-9_-]/g, '')}`; // Removes invalid characters
    }
    // Function to apply dark mode hover color
// Central map to hold styles so they're applied only once per color
const hoverStylesMap = new Map();

function applyDarkModeHoverEffect(element, originalColor, newColor) {
    const hoverColor = lightenColor(newColor, 10); // Adjust hover color as needed

    // Ensure original color is in hex format
    const sanitizedColor = originalColor.startsWith('rgba') ? rgbaToHex(originalColor) : originalColor;
    const uniqueClass = generateClassNameFromColor(sanitizedColor);

    // Apply the class to the element
    element.classList.add(uniqueClass);

    // Add hover style if it doesn’t already exist in document head
    if (!document.querySelector(`style[data-class="${uniqueClass}"]`)) {
        const style = document.createElement('style');
        style.type = 'text/css';
        style.setAttribute("data-class", uniqueClass);
        style.textContent = `
            .${uniqueClass}:hover {
                color: ${hoverColor} !important;
                background-color: ${hoverColor} !important;
                fill: ${hoverColor} !important;
            }
        `;

        // Append the style to the document head
        document.head.appendChild(style);
    }
}

    
    function lightenColor(color, percent) {
        let r = parseInt(color.slice(1, 3), 16);
        let g = parseInt(color.slice(3, 5), 16);
        let b = parseInt(color.slice(5, 7), 16);
    
        r = Math.min(255, Math.floor(r + (255 - r) * (percent / 100)));
        g = Math.min(255, Math.floor(g + (255 - g) * (percent / 100)));
        b = Math.min(255, Math.floor(b + (255 - b) * (percent / 100)));
    
        return `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1)}`;
    }
    
    function findElementsWithComputedColor(targetColor) {
        const elementsWithTargetColor = [];

        document.querySelectorAll('*').forEach(element => {
            const computedStyle = window.getComputedStyle(element);

            if (computedStyle.color === targetColor || computedStyle.backgroundColor === targetColor) {
                elementsWithTargetColor.push(element);
            }
        });

        return elementsWithTargetColor;
    }
    function hexToRgb(hex) {
        const bigint = parseInt(hex.slice(1), 16);
        const r = (bigint >> 16) & 255;
        const g = (bigint >> 8) & 255;
        const b = bigint & 255;
        return `rgb(${r}, ${g}, ${b})`;
    }
    function revertToOriginal() {
        originalStyles.forEach((styles, element) => {
            element.style.color = styles.color;
            element.style.backgroundColor = styles.backgroundColor;
            element.style.fill = styles.fill;
        });
        document.body.style.backgroundColor = "";
        originalStyles.clear();
    }

});





