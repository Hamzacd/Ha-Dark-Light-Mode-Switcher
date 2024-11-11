<?php
/**
 * Plugin Name: HA Dark/Light Mode Switcher
 * Description: A plugin to switch between dark and light modes on the site.
 * Version: 1.0
 * Author: Hamza Badaouy
 */

if (!defined('ABSPATH')) {
    exit; 
}

define('WPDLMS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPDLMS_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include required files
require_once WPDLMS_PLUGIN_DIR . 'admin/admin.php';
require_once WPDLMS_PLUGIN_DIR . 'switch-button/frontend.php';

function wpdlms_init() {
    add_action('wp_enqueue_scripts', 'wpdlms_enqueue_scripts');
}
add_action('plugins_loaded', 'wpdlms_init');

function wpdlms_enqueue_scripts(): void {
    // Enqueue JavaScript for the mode switch
    wp_enqueue_script('wpdlms-mode-switch', plugin_dir_url(__FILE__) . 'assets/color-changer.js', ['jquery'], null, true);

    $default_mode = get_option('ha_dark_light_default_mode', 'light'); 
    $dark_mode_colors = get_option('ha_dark_light_mode_colors', []);
    $elementor_kit_selector = get_option('ha_dark_light_mode_selector', '.elementor-kit-7');

    $ha_dark_light_mode_selector_h1 = get_option('ha_dark_light_mode_selector_h1', '#ffffff');
    $ha_dark_light_mode_selector_h2 = get_option('ha_dark_light_mode_selector_h2', '#ffffff');
    $ha_dark_light_mode_sticky_header = get_option('ha_dark_light_mode_sticky_header', 'grey');
    $ha_dark_light_mode_body_color = get_option('ha_dark_light_mode_body_color', 'grey');
    $ha_dark_light_mode_ti_widget_color = get_option('ha_dark_light_mode_ti_widget_color', '#161B17');
    $ha_dark_light_mode_back_to_top_color = get_option('ha_dark_light_mode_back_to_top_color', '#161B17');


    $ha_dark_light_mode_depicter_background = get_option('ha_dark_light_mode_depicter_background', 'grey');
    $ha_dark_light_mode_depicter_title = get_option('ha_dark_light_mode_depicter_title', '#161B17');
    $ha_dark_light_mode_depicter_text = get_option('ha_dark_light_mode_depicter_text', '#161B17');
    $ha_dark_light_mode_colors_depicter = get_option('ha_dark_light_mode_colors_depicter', []);
    


    // Ensure that the colors array is not empty
    if (!empty($dark_mode_colors) && is_array($dark_mode_colors)) {
        // Localize script with colors data
        wp_localize_script('wpdlms-mode-switch', 'wpdlmsColors', [
            'default_mode' => $default_mode,
            'colors' => $dark_mode_colors,
            'selector' => $elementor_kit_selector,
            'ha_dark_light_mode_selector_h1' => $ha_dark_light_mode_selector_h1,
            'ha_dark_light_mode_selector_h2' => $ha_dark_light_mode_selector_h2,
            'ha_dark_light_mode_sticky_header' => $ha_dark_light_mode_sticky_header,
            'ha_dark_light_mode_body_color' => $ha_dark_light_mode_body_color,
            'ha_dark_light_mode_ti_widget_color' => $ha_dark_light_mode_ti_widget_color,
            'ha_dark_light_mode_back_to_top_color' => $ha_dark_light_mode_back_to_top_color,
            'ha_dark_light_mode_depicter_background' => $ha_dark_light_mode_depicter_background,
            'ha_dark_light_mode_depicter_title' => $ha_dark_light_mode_depicter_title,
            'ha_dark_light_mode_depicter_text' => $ha_dark_light_mode_depicter_text,
            'ha_dark_light_mode_colors_depicter' => $ha_dark_light_mode_colors_depicter
        ]);
    } else {
        // Fallback to default colors if no colors are set
        $dark_mode_colors = [
            '--e-global-color-primary' => '#a67c42',
            '--e-global-color-secondary' => '#2b2b2b',
            '--e-global-color-text' => '#e0e0e0',
            '--e-global-color-accent' => '#a67c42',
            '--e-global-color-color_1' => '#a67c42',
            '--e-global-color-color_2' => '#d4b89b',
            '--e-global-color-color_3' => '#323232',
            '--e-global-color-color_4' => '#8b5d2e',
            '--e-global-color-color_5' => '#8b5d2e',
            '--e-global-color-color_white' => '#161B17',
            '--e-global-color-color_black' => '#000000',
            '--e-global-color-color_grey' => '#a3a3a3',
            '--e-global-color-color_error' => '#ff6b6b',
            '--e-global-color-color_success' => '#4caf50',
            '--e-global-color-color_alert' => '#ff8c42',
        ];

        wp_localize_script('wpdlms-mode-switch', 'wpdlmsColors', [
            'default_mode' => $default_mode,
            'colors' => $dark_mode_colors,
            'selector' => $elementor_kit_selector,
            'ha_dark_light_mode_selector_h1' => $ha_dark_light_mode_selector_h1,
            'ha_dark_light_mode_selector_h2' => $ha_dark_light_mode_selector_h2,
            'ha_dark_light_mode_sticky_header' => $ha_dark_light_mode_sticky_header,
            'ha_dark_light_mode_body_color' => $ha_dark_light_mode_body_color,
            'ha_dark_light_mode_ti_widget_color' => $ha_dark_light_mode_ti_widget_color,
            'ha_dark_light_mode_back_to_top_color' => $ha_dark_light_mode_back_to_top_color,
            'ha_dark_light_mode_depicter_background' => $ha_dark_light_mode_depicter_background,
            'ha_dark_light_mode_depicter_title' => $ha_dark_light_mode_depicter_title,
            'ha_dark_light_mode_depicter_text' => $ha_dark_light_mode_depicter_text,
            'ha_dark_light_mode_colors_depicter' => $ha_dark_light_mode_colors_depicter
        ]);
    } 
}
add_action('wp_enqueue_scripts', 'wpdlms_enqueue_scripts');


