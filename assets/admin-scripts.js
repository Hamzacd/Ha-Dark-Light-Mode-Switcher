document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('ha_dark_light_mode');


    const storedMode = localStorage.getItem('themeMode');
    if (storedMode) {
        selectElement.value = storedMode;
    }

    selectElement.addEventListener('change', function () {
        const selectedValue = selectElement.value;
        localStorage.setItem('themeMode', selectedValue);
        console.log(`Theme mode set to: ${selectedValue}`);
    });
});
