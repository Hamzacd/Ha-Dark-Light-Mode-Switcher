

const default_mode = wpdlmsColors.default_mode;
// const mode = default_mode === 'light' ? 'dark' : 'light';
const darkModeColors = wpdlmsColors.colors;
const elementorKitSelector = wpdlmsColors.selector;

const ha_dark_light_mode_selector_h1 = wpdlmsColors.ha_dark_light_mode_selector_h1;
const ha_dark_light_mode_selector_h2 = wpdlmsColors.ha_dark_light_mode_selector_h2;
const ha_dark_light_mode_sticky_header = wpdlmsColors.ha_dark_light_mode_sticky_header;
const ha_dark_light_mode_body_color = wpdlmsColors.ha_dark_light_mode_body_color;
const ha_dark_light_mode_ti_widget_color = wpdlmsColors.ha_dark_light_mode_ti_widget_color;
const ha_dark_light_mode_back_to_top_color = wpdlmsColors.ha_dark_light_mode_back_to_top_color;

const ha_dark_light_mode_depicter_background = wpdlmsColors.ha_dark_light_mode_depicter_background;
const ha_dark_light_mode_depicter_title = wpdlmsColors.ha_dark_light_mode_depicter_title;
const ha_dark_light_mode_depicter_text = wpdlmsColors.ha_dark_light_mode_depicter_text;
const ha_dark_light_mode_colors_depicter = wpdlmsColors.ha_dark_light_mode_colors_depicter;

const darkDefault = default_mode === 'dark';
// console.log(elementorKitSelector);
console.log(wpdlmsColors);


window.addEventListener("scroll", () => {
    const stickyHeader = document.querySelector(".sticky-active");
    const isDark = localStorage.getItem('themeMode') === 'dark';
    if (stickyHeader) stickyHeader.style.background = isDark ? ha_dark_light_mode_sticky_header : '';

});

const storedMode = localStorage.getItem('themeMode');
if (default_mode === 'dark') {
    if (darkDefault) {
        document.getElementById('theme-toggle-button').classList.toggle('light', storedMode === 'dark');
        
        toggleDarkMode(storedMode === 'dark');
    } else {
        document.getElementById('theme-toggle-button').classList.toggle('light', storedMode !== 'dark');
        toggleDarkMode(storedMode !== 'dark');
    }
    document.getElementById('theme-toggle-button').addEventListener('click', () => {
        const isDark = localStorage.getItem('themeMode') !== 'dark';
        if (darkDefault) {
            localStorage.setItem('themeMode', isDark ? 'dark' : 'light');
            toggleDarkMode(isDark);
            document.getElementById('theme-toggle-button').classList.toggle('light', isDark);
        } else {
            localStorage.setItem('themeMode', 'light');
            toggleDarkMode(!isDark);
            document.getElementById('theme-toggle-button').classList.remove('light', !isDark);
        }
    });
} else {
    document.getElementById('theme-toggle-button').classList.toggle('light', storedMode !== 'dark');
    if (storedMode === 'dark') {
        toggleDarkMode(true);
    }
    document.getElementById('theme-toggle-button').addEventListener('click', () => {
        const isDark = localStorage.getItem('themeMode') !== 'dark';
        localStorage.setItem('themeMode', !isDark ? 'light': 'dark');
        toggleDarkMode(isDark);
        document.getElementById('theme-toggle-button').classList.toggle('light', !isDark);
    });
}


function toggleDarkMode(isDark) {
    const root = document.querySelector(elementorKitSelector);
    const stickyHeader = document.querySelector(".sticky-active");
    const rootH1 = document.querySelectorAll(elementorKitSelector + ' h1');
    const rootH2 = document.querySelectorAll(elementorKitSelector + ' h2');
    const ti_widget = document.querySelector(".ti-widget");
    const backToTop = document.querySelector(".back-to-top");

    depicter_colors(isDark);
    // console.log(backToTop);

    if (isDark) {
        for (const [variable, value] of Object.entries(darkModeColors)) {
            root.style.setProperty(variable, value);
        }
        for (const item of Object.entries(rootH1)) {
            item[1].style.color = ha_dark_light_mode_selector_h1;
        }
        for (const item of Object.entries(rootH2)) {
            item[1].style.color = ha_dark_light_mode_selector_h2;
        }
        if (ti_widget) ti_widget.style.background = ha_dark_light_mode_ti_widget_color;

        if (backToTop) backToTop.style.backgroundColor = ha_dark_light_mode_back_to_top_color;

        document.body.style.backgroundColor = ha_dark_light_mode_body_color;
        if (stickyHeader) stickyHeader.style.background = ha_dark_light_mode_sticky_header;
        
    } else {
        root.style.cssText = '';
        document.body.style.backgroundColor = "";
        for (const item of Object.entries(rootH1)) {
            item[1].style.color = "";
        }
        for (const item of Object.entries(rootH2)) {
            item[1].style.color = "";
        }
        if (ti_widget) ti_widget.style.background = '';
        if (stickyHeader) stickyHeader.style.background = '';
        if (backToTop) backToTop.style.backgroundColor = '';
        
    }
}
function depicter_colors(isDark) {
    const depicter = document.querySelector(".depicter-section-background");

    waitForElementVisible('.depicter-section-background')
        .then((element) => {
            // console.log('Element is visible:', element);
            const parent = document.querySelector('.depicter-revert');
            // const child = parent.querySelectorAll('.depicter-element');
            const p = parent.querySelectorAll('p');
            const arrows = parent.querySelectorAll('[data-type="symbol"]');
            const titles = parent.querySelectorAll('div[data-type="text"]');
            const buttons = parent.querySelectorAll('div[data-type="button"]');
            // const symbol = arrows.querySelector('.depicter-symbol-container');
            // console.log(buttons)
            // symbol.style.fill = '#FFC697';
            if (isDark) {

                for (const item of Object.entries(p)) {
                    item[1].style.color = ha_dark_light_mode_depicter_text;
                }
                for (const item of Object.entries(arrows)) {
                    item[1].style.backgroundColor = "#ffffff";
                }
                for (const item of Object.entries(titles)) {
                    item[1].style.color = ha_dark_light_mode_depicter_title;
                }
                for (const item of Object.entries(element)) {
                    item[1].style.backgroundColor = ha_dark_light_mode_depicter_background;
                }

                for (const [index, button] of Object.entries(buttons)) {
                    const buttonIndex = parseInt(index);

                    if ((buttonIndex + 1) % 2 !== 0) {
                        button.style.backgroundColor = ha_dark_light_mode_colors_depicter.button_1_bg_color;
                        button.style.color = ha_dark_light_mode_colors_depicter.button_1_color;
                    } else {
                        button.style.backgroundColor = ha_dark_light_mode_colors_depicter.button_2_bg_color;
                        button.style.color = ha_dark_light_mode_colors_depicter.button_2_color;
                    }

                    button.addEventListener('mouseenter', () => {
                        if ((buttonIndex + 1) % 2 !== 0) {
                            button.style.backgroundColor = ha_dark_light_mode_colors_depicter.button_1_bg_hover;
                            button.style.color = ha_dark_light_mode_colors_depicter.button_1_color_hover;
                        } else {
                            button.style.backgroundColor = ha_dark_light_mode_colors_depicter.button_2_bg_hover;
                            button.style.color = ha_dark_light_mode_colors_depicter.button_2_color_hover;
                        }
                    });

                    button.addEventListener('mouseleave', () => {
                        if ((buttonIndex + 1) % 2 !== 0) {
                            button.style.backgroundColor = ha_dark_light_mode_colors_depicter.button_1_bg_color;
                            button.style.color = ha_dark_light_mode_colors_depicter.button_1_color;
                        } else {
                            button.style.backgroundColor = ha_dark_light_mode_colors_depicter.button_2_bg_color;
                            button.style.color = ha_dark_light_mode_colors_depicter.button_2_color;
                        }
                    });
                }




                arrows.forEach(element => {
                    elm = element.querySelectorAll('.depicter-symbol-container');
                    for (const item of Object.entries(elm)) {
                        item.style.fill = "#FFC697";
                        item.addEventListener('mouseover', () => {
                            item.style.fill = '#ffffff';
                        });
                    }

                });


            } else {
                for (const item of Object.entries(element)) {
                    item[1].style.backgroundColor = '';
                }
                for (const item of Object.entries(p)) {
                    item[1].style.color = "";
                }
                for (const item of Object.entries(arrows)) {
                    item[1].style.backgroundColor = "";
                }
                for (const item of Object.entries(titles)) {

                    item[1].style.color = "";
                }


                for (const [index, button] of Object.entries(buttons)) {
                    const buttonIndex = parseInt(index);

                    if ((buttonIndex + 1) % 2 !== 0) {
                        button.style.backgroundColor = '';
                        button.style.color = '';
                    } else {
                        button.style.backgroundColor = '';
                        button.style.color = '';
                    }

                    button.addEventListener('mouseenter', () => {
                        if ((buttonIndex + 1) % 2 !== 0) {
                            button.style.backgroundColor = '';
                            button.style.color = '';
                        } else {
                            button.style.backgroundColor = '';
                            button.style.color = '';
                        }
                    });

                    button.addEventListener('mouseleave', () => {
                        if ((buttonIndex + 1) % 2 !== 0) {
                            button.style.backgroundColor = '';
                            button.style.color = '';
                        } else {
                            button.style.backgroundColor = '';
                            button.style.color = '';
                        }
                    });
                }
                arrows.forEach(element => {
                    elm = element.querySelectorAll('.depicter-symbol-container');
                    for (const item of Object.entries(elm)) {
                        item.style.fill = "";
                        item.addEventListener('mouseover', () => {
                            item.style.fill = '';
                        });
                    }
                });
            }
        });
}

function waitForElementVisible(selector, timeout = 5000) {
    return new Promise((resolve, reject) => {
        const intervalTime = 100;
        let timeElapsed = 0;

        const interval = setInterval(() => {
            const element = document.querySelectorAll(selector);

            if (element.length > 1 && element[1] !== null) {
                clearInterval(interval);
                resolve(element);
            }

            timeElapsed += intervalTime;
            if (timeElapsed >= timeout) {
                clearInterval(interval);
                reject(new Error('Element not visible within timeout.'));
            }
        }, intervalTime);
    });
}



