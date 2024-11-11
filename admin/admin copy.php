<?php 

function wpdlms_add_admin_menu() {
    add_menu_page(
        'Dark/Light Mode Switcher',       // Page title
        'Mode Switcher',                  // Menu title
        'manage_options',                 // Capability
        'wpdlms_settings',                // Menu slug
        'wpdlms_settings_page_content',   // Callback function
        'dashicons-lightbulb',            // Icon
        100                               // Position
    );
}
add_action('admin_menu', 'wpdlms_add_admin_menu');

function wpdlms_settings_page_content() {
    // Handle saving reverse colors
    if (isset($_POST['reverse_colors'])) {
        foreach ($_POST['reverse_colors'] as $color => $reverse_color) {
            update_option('reverse_color_' . sanitize_title($color), sanitize_text_field($reverse_color));
        }
        echo '<div class="updated"><p>Reverse colors saved successfully.</p></div>';
    }

    // Handle adding a custom color
    if (isset($_POST['add_custom_color']) && !empty($_POST['custom_color_key']) && !empty($_POST['custom_color_value'])) {
        $customColorKey = sanitize_text_field($_POST['custom_color_key']);
        $customColorValue = sanitize_text_field($_POST['custom_color_value']);
        
        update_option('reverse_color_' . sanitize_title($customColorKey), $customColorValue);
        echo '<div class="updated"><p>Custom color added successfully.</p></div>';
    }

    // Retrieve all stored custom colors
    global $wpdb;
    $custom_colors = [];
    $options = $wpdb->get_results("SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE 'reverse_color_%'");
    foreach ($options as $option) {
        $color_key = str_replace('reverse_color_', '', $option->option_name);
        $custom_colors[$color_key] = $option->option_value;
    }

    ?>
    <div class="wrap">
        <h1>Dark/Light Mode Switcher Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wpdlms_settings_group');
            do_settings_sections('wpdlms_settings');
            submit_button();
            ?>
        </form>

        <h3>Custom Colors:</h3>
        <?php if (!empty($custom_colors)): ?>
            <form method="post">
                <ul>
                    <?php foreach ($custom_colors as $color => $reverse_color): ?>
                        <li>
                            <span style="color: <?php echo esc_attr($color); ?>"><?php echo esc_html($color); ?></span>
                            <input type="text" name="reverse_colors[<?php echo esc_attr($color); ?>]" 
                                   placeholder="Set reverse color" 
                                   value="<?php echo esc_attr($reverse_color); ?>" 
                                   style="margin-left: 10px;"/>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <button type="submit" class="button button-primary">Save Reverse Colors</button>
            </form>
        <?php else: ?>
            <p>No custom colors have been added yet.</p>
        <?php endif; ?>

        <!-- Section for adding custom colors -->
        <h2>Manually Add Custom Color</h2>
        <form method="post">
            <label for="custom_color_key">Color:</label>
            <input type="text" id="custom_color_key" name="custom_color_key" placeholder="#000000 or rgb(0, 0, 0)" />

            <label for="custom_color_value">Reverse Color:</label>
            <input type="text" id="custom_color_value" name="custom_color_value" placeholder="#ffffff or rgb(255, 255, 255)" />

            <button type="submit" name="add_custom_color" class="button button-primary">Add Custom Color</button>
        </form>
    </div>
    <?php
}

function wpdlms_settings_pageeeee_content() {

    // if (isset($_POST['detect_colors'])) {
    //     $detected_colors = wpdlms_detect_colors();
    //     update_option('wpdlms_detected_colors', $detected_colors); 
    // }

    if (isset($_POST['reverse_colors'])) {
        foreach ($_POST['reverse_colors'] as $color => $reverse_color) {
            update_option('reverse_color_' . sanitize_title($color), sanitize_text_field($reverse_color));
        }
        echo '<div class="updated"><p>Reverse colors saved successfully.</p></div>';
    }
    if (isset($_POST['add_custom_color']) && !empty($_POST['custom_color_key']) && !empty($_POST['custom_color_value'])) {
        $customColorKey = sanitize_text_field($_POST['custom_color_key']);
        $customColorValue = sanitize_text_field($_POST['custom_color_value']);
    

        update_option('reverse_color_' . sanitize_title($customColorKey), $customColorValue);
        echo '<div class="updated"><p>Custom color added successfully.</p></div>';
    }

    $stored_colors = get_option('wpdlms_detected_colors', []);
    ?>
 <div class="wrap">
    <h1>Dark/Light Mode Switcher Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('wpdlms_settings_group');
        do_settings_sections('wpdlms_settings');
        submit_button();
        ?>
    </form>

    <!-- <h2>Detected Colors</h2>
    <form method="post">
        <input type="hidden" name="detect_colors" value="1" />
        <button type="submit" class="button button-primary">Detect Colors</button>
    </form> -->

    <?php if (!empty($stored_colors)): ?>
        <h3>Detected Colors:</h3>
        <form method="post">
            <ul>
                <?php foreach ($stored_colors as $color): ?>
                    <li style="color: <?php echo esc_attr($color); ?>">
                        <?php echo esc_html($color); ?>
                        <input type="text" name="reverse_colors[<?php echo esc_attr($color); ?>]" 
                               placeholder="Set reverse color" 
                               value="<?php echo esc_attr(get_option('reverse_color_' . sanitize_title($color))); ?>" 
                               style="margin-left: 10px;"/>
                    </li>
                <?php endforeach; ?>
            </ul>
            <button type="submit" class="button button-primary">Save Reverse Colors</button>
        </form>
    <?php else: ?>
        <p>No colors detected yet. Click the button to detect colors.</p>
    <?php endif; ?>

    <!-- Section for adding custom colors -->
    <h2>Manually Add Custom Color</h2>
    <form method="post">
        <label for="custom_color_key">Color:</label>
        <input type="text" id="custom_color_key" name="custom_color_key" placeholder="#000000 or rgb(0, 0, 0)" />

        <label for="custom_color_value">Reverse Color:</label>
        <input type="text" id="custom_color_value" name="custom_color_value" placeholder="#ffffff or rgb(255, 255, 255)" />

        <button type="submit" name="add_custom_color" class="button button-primary">Add Custom Color</button>
    </form>
</div>

    <?php
}
// function wpdlms_detect_colors() {
//     $colors = [];
    
//     ob_start();
//     // get_header();
//     // the_content(); 
//     // get_footer();
//     include get_page_template();
//     $html_output = ob_get_clean();

//     preg_match_all('/#([a-f0-9]{3,6})|rgba?\((\d+),\s*(\d+),\s*(\d+)(,\s*\d*\.?\d+)?\)|rgb\((\d+),\s*(\d+),\s*(\d+)\)/i', $html_output, $matches);

//     foreach ($matches[0] as $color) {
//         if (!in_array($color, $colors)) {
//             $colors[] = $color; 
//         }
//     }

//     return $colors;
// }
function wpdlms_register_settings() {
    register_setting('wpdlms_settings_group', 'wpdlms_default_mode');
    add_settings_section('wpdlms_settings_section', 'General Settings', null, 'wpdlms_settings');

    add_settings_field(
        'wpdlms_default_mode',
        'Default Mode',
        'wpdlms_default_mode_callback',
        'wpdlms_settings',
        'wpdlms_settings_section'
    );
}
add_action('admin_init', 'wpdlms_register_settings');

function wpdlms_default_mode_callback() {
    $default_mode = get_option('wpdlms_default_mode', 'light');
    ?>
    <select name="wpdlms_default_mode">
        <option value="light" <?php selected($default_mode, 'light'); ?>>Light</option>
        <option value="dark" <?php selected($default_mode, 'dark'); ?>>Dark</option>
    </select>
    <?php
}


if (!function_exists('wpdlms_enqueue_scripts')) {
    function wpdlms_enqueue_scripts(): void {
        wp_enqueue_script('wpdlms-color-changer', plugin_dir_url(__FILE__) . 'assets/color-changer.js', array('jquery'), null, true);
        
        $reverse_colors = [];
        $stored_colors = get_option('wpdlms_detected_colors', []);
        foreach ($stored_colors as $color) {
            $reverse_colors[$color] = get_option('reverse_color_' . sanitize_title($color), '');
        }

        wp_localize_script('wpdlms-color-changer', 'wpdlmsColors', $reverse_colors);
    }
}
add_action('wp_enqueue_scripts', 'wpdlms_enqueue_scripts');



// function wpdlms_detect_colors() {
//     $colors = [];
//     $theme_dir = get_template_directory(); 
//     $css_files = glob($theme_dir . '/*.css'); 

//     if (empty($css_files)) {
//         error_log("No CSS files found in: " . $theme_dir);
//     }

//     foreach ($css_files as $file) {
        
//         error_log("Processing file: " . $file);
//         $content = file_get_contents($file);
//         preg_match_all('/#([a-f0-9]{3,6})|rgba?\((\d+),\s*(\d+),\s*(\d+)(,\s*\d*\.?\d+)?\)|rgb\((\d+),\s*(\d+),\s*(\d+)\)/i', $content, $matches); // Match hex and RGB/RGBA colors

//         foreach ($matches[0] as $color) {
//             if (!in_array($color, $colors)) {
//                 $colors[] = $color; 
//             }
//         }
//     }
    

//     error_log("Detected colors: " . implode(', ', $colors));

//     return $colors;
// }

