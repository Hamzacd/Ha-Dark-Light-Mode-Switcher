<?php

function wpdlms_enqueue_styles() {
    wp_enqueue_style('wpdlms-toggle-style', plugin_dir_url(__FILE__) . '../assets/style.css');
  
    wp_localize_script('wpdlms-toggle-script', 'wpdlmsData', array(
        'elementorSelector' => '.elementor-kit-7',
    ));
    $button_style = get_option('ha_dark_light_mode_colors_switch_button'); 

    // $light_mode_bg = get_option('wpdlms_light_mode_bg', '#ff8c42'); 


    $custom_styles = "
    .toggle-container {
        background-color: {$button_style['dark_mode_bg_button']};
    }
    .toggle-container.light {
        background-color: {$button_style['light_mode_bg_button']};
    }
    .toggle-btn {
        background-color: {$button_style['toggle_btn']};
    }
";
    
    wp_add_inline_style('wpdlms-toggle-style', $custom_styles);
}
add_action('wp_enqueue_scripts', 'wpdlms_enqueue_styles');
function wpdlms_mode_switch_button() {
    wpdlms_enqueue_styles();
    
    ob_start();
    ?>
    <div id="theme-toggle-button" class="toggle-container">
        <div class="toggle-icon moon">

        </div>
        <div class="toggle-icon sun">

        </div>
        <div class="toggle-btn"></div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mode_switch_button', 'wpdlms_mode_switch_button');
