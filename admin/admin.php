<?php
// admin.php

function ha_dark_light_mode_add_admin_menu() {
    add_options_page('Dark Light Mode Settings', 'HA Dark Light Mode', 'manage_options', 'ha_dark_light_mode', 'ha_dark_light_mode_options_page');
}

function ha_dark_light_mode_settings_init() {

    add_settings_section(
        'ha_dark_light_mode_site_default',
        __('Set your Site site default Mode', 'ha-dark-light-mode-switcher'),
        null,
        'haDarkLightMode'
    );
    add_settings_field(
        'ha_dark_light_default_mode',
        __('Select Default Mode', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_default_mode_render',
        'haDarkLightMode',
        'ha_dark_light_mode_site_default'
    );
    register_setting('haDarkLightMode', 'ha_dark_light_default_mode');


    add_settings_section(
        'ha_dark_light_mode_section',
        __('Set your dark mode colors', 'ha-dark-light-mode-switcher'),
        null,
        'haDarkLightMode'
    );

    $colors = [
        '--e-global-color-primary',
        '--e-global-color-secondary',
        '--e-global-color-text',
        '--e-global-color-accent',
        '--e-global-color-color_1',
        '--e-global-color-color_2',
        '--e-global-color-color_3',
        '--e-global-color-color_4',
        '--e-global-color-color_5',
        '--e-global-color-color_6',
        '--e-global-color-color_white',
        '--e-global-color-color_black',
        '--e-global-color-color_grey',
        '--e-global-color-color_error',
        '--e-global-color-color_success',
        '--e-global-color-color_alert',
    ];

    foreach ($colors as $color) {
        add_settings_field(
            $color,
            __($color, 'ha-dark-light-mode-switcher'),
            function() use ($color) {
                $options = get_option('ha_dark_light_mode_colors');
                echo "<div class='color-section'>
                        <label for='{$color}'></label>
                        <div class='color-picker'>
                            <div class='color-display' id='{$color}Display' style='background-color: " . esc_attr($options[$color] ?? '#ffffff') . ";'></div>
                            <input type='color' id='{$color}' class='color-input' name='ha_dark_light_mode_colors[{$color}]' value='" . esc_attr($options[$color] ?? '#ffffff') . "' onchange='updateColor(\"{$color}\")'>
                        </div>
                    </div>";
            },
            'haDarkLightMode',
            'ha_dark_light_mode_section'
        );
    }
    
    register_setting('haDarkLightMode', 'ha_dark_light_mode_colors');


    add_settings_field(
        'ha_dark_light_mode_selector_h1',
        __('Elementor Kit Selector H1', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_selector_h1_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section'
    );
    
    add_settings_field(
        'ha_dark_light_mode_selector_h2',
        __('Elementor Kit Selector H2', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_selector_h2_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section'
    );
    
    add_settings_field(
        'ha_dark_light_mode_sticky_header',
        __('Sticky Header Selector', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_sticky_header_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section'
    );
    
    add_settings_field(
        'ha_dark_light_mode_body_color',
        __('Body Background Color', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_body_color_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section'
    );
    add_settings_field(
        'ha_dark_light_mode_ti_widget_color',
        __('Ti Widget Color', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_ti_widget_color_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section'
    );

    add_settings_field(
        'ha_dark_light_mode_back_to_top_color',
        __('Back to top Color', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_back_to_top_color_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section'
    );
    
    add_settings_field(
        'ha_dark_light_mode_selector',
        __('Elementor Kit Selector', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_selector_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section'
    );




    register_setting('haDarkLightMode', 'ha_dark_light_mode_selector_h1');
    register_setting('haDarkLightMode', 'ha_dark_light_mode_selector_h2');
    register_setting('haDarkLightMode', 'ha_dark_light_mode_sticky_header');
    register_setting('haDarkLightMode', 'ha_dark_light_mode_body_color');
    register_setting('haDarkLightMode', 'ha_dark_light_mode_ti_widget_color');
    register_setting('haDarkLightMode', 'ha_dark_light_mode_back_to_top_color');
    register_setting('haDarkLightMode', 'ha_dark_light_mode_selector');


    add_settings_section(
        'ha_dark_light_mode_section_depicter',
        __('Set your dark mode colors for Depicter', 'ha-dark-light-mode-switcher'),
        null,
        'haDarkLightMode'
    );

    add_settings_field(
        'ha_dark_light_mode_depicter_background',
        __('Depicter Background Color', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_depicter_background_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section_depicter'
    );
    
    add_settings_field(
        'ha_dark_light_mode_depicter_title',
        __('Depicter Title', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_depicter_title_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section_depicter'
    );

    add_settings_field(
        'ha_dark_light_mode_depicter_text',
        __('Depicter text', 'ha-dark-light-mode-switcher'),
        'ha_dark_light_mode_depicter_text_render',
        'haDarkLightMode',
        'ha_dark_light_mode_section_depicter'
    );
    $colors_depicter = [
        'button_1_bg_color',
        'button_1_color',
        'button_1_bg_hover',
        'button_1_color_hover',
        'button_2_bg_color',
        'button_2_color',
        'button_2_bg_hover',
        'button_2_color_hover',
 
    ];

    foreach ($colors_depicter as $dp_color) {
        add_settings_field(
            $dp_color,
            __($dp_color, 'ha-dark-light-mode-switcher'),
            function() use ($dp_color) {
                $options = get_option('ha_dark_light_mode_colors_depicter');
                echo "<div class='color-section'>
                        <label for='{$dp_color}'></label>
                        <div class='color-picker'>
                            <div class='color-display' id='{$dp_color}Display' style='background-color: " . esc_attr($options[$dp_color] ?? '#ffffff') . ";'></div>
                            <input type='color' id='{$dp_color}' class='color-input' name='ha_dark_light_mode_colors_depicter[{$dp_color}]' value='" . esc_attr($options[$dp_color] ?? '#ffffff') . "' onchange='updateColor(\"{$dp_color}\")'>
                        </div>
                    </div>";
            },
            'haDarkLightMode',
            'ha_dark_light_mode_section_depicter'
        );
    }


    register_setting('haDarkLightMode', 'ha_dark_light_mode_depicter_background');
    register_setting('haDarkLightMode', 'ha_dark_light_mode_depicter_title');
    register_setting('haDarkLightMode', 'ha_dark_light_mode_depicter_text');
    register_setting('haDarkLightMode', 'ha_dark_light_mode_colors_depicter');

    add_settings_section(
        'ha_dark_light_mode_switch_button',
        __('Set your dark mode colors for Switch Button', 'ha-dark-light-mode-switcher'),
        null,
        'haDarkLightMode'
    );

    $colors_button_switch = [
        'dark_mode_bg_button',
        'light_mode_bg_button',
        'toggle_btn'
 
    ];

    foreach ($colors_button_switch as $bs_color) {
        add_settings_field(
            $bs_color,
            __($bs_color, 'ha-dark-light-mode-switcher'),
            function() use ($bs_color) {
                $options = get_option('ha_dark_light_mode_colors_switch_button');
                echo "<div class='color-section'>
                        <label for='{$bs_color}'></label>
                        <div class='color-picker'>
                            <div class='color-display' id='{$bs_color}Display' style='background-color: " . esc_attr($options[$bs_color] ?? '#ffffff') . ";'></div>
                            <input type='color' id='{$bs_color}' class='color-input' name='ha_dark_light_mode_colors_switch_button[{$bs_color}]' value='" . esc_attr($options[$bs_color] ?? '#ffffff') . "' onchange='updateColor(\"{$bs_color}\")'>
                        </div>
                    </div>";
            },
            'haDarkLightMode',
            'ha_dark_light_mode_switch_button'
        );
    }
    register_setting('haDarkLightMode', 'ha_dark_light_mode_colors_switch_button');
}
function ha_dark_light_mode_selector_render() {
    $options = get_option('ha_dark_light_mode_selector');
    echo "<input type='text' name='ha_dark_light_mode_selector' value='" . esc_attr($options) . "' placeholder='.elementor-kit-X' />";
}

function ha_dark_light_default_mode_render() {
    $options = get_option('ha_dark_light_default_mode', 'light'); 

    $modes = array(
        'dark' => 'Dark Mode',
        'light' => 'Light Mode'
    );

    echo "<select name='ha_dark_light_default_mode'>";
    foreach ($modes as $value => $label) {
        $selected = selected($options, $value, false);
        echo "<option value='" . esc_attr($value) . "' $selected>" . esc_html($label) . "</option>";
    }
    echo "</select>";
}

function ha_dark_light_mode_options_page() {
    ?>
    <style>
 
        .wrap {
            max-width: 600px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
        }
 
        .color-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .color-section label {
            font-size: 16px;
            color: #333;
        }
        .color-picker {
            display: flex;
            align-items: center;
        }
        .color-display {
            width: 40px;
            height: 40px;
            border: 1px solid #ddd;
            margin-right: 10px;
            border-radius: 4px;
        }
        .color-input {
            border: 1px solid #007bff;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

    <form action="options.php" method="post" class="wrap">
        <h2><?php _e('Dark Light Mode Settings', 'ha-dark-light-mode-switcher'); ?></h2>
        <?php
        settings_fields('haDarkLightMode');
        do_settings_sections('haDarkLightMode');
        submit_button();
        ?>
    </form>

    <script>
        function updateColor(colorId) {
            const colorInput = document.getElementById(colorId);
            const colorDisplay = document.getElementById(colorId + 'Display');
            colorDisplay.style.backgroundColor = colorInput.value;
        }
    </script>
    <?php
}

add_action('admin_menu', 'ha_dark_light_mode_add_admin_menu');
add_action('admin_init', 'ha_dark_light_mode_settings_init');




function ha_dark_light_mode_selector_h1_render() {
    $options = get_option('ha_dark_light_mode_selector_h1');
    uiColor($options,'ha_dark_light_mode_selector_h1');
   
}

function ha_dark_light_mode_selector_h2_render() {
    $options = get_option('ha_dark_light_mode_selector_h2');
    uiColor($options,'ha_dark_light_mode_selector_h2');
    // echo "<input type='text' name='ha_dark_light_mode_selector_h2' value='" . esc_attr($options) . "' placeholder='.elementor-kit-h2' />";
}

function ha_dark_light_mode_sticky_header_render() {
    $options = get_option('ha_dark_light_mode_sticky_header');
    uiColor($options,"ha_dark_light_mode_sticky_header");
    // echo "<input type='text' name='ha_dark_light_mode_sticky_header' value='" . esc_attr($options) . "' placeholder='.sticky-header' />";
}

function ha_dark_light_mode_body_color_render() {
    $options = get_option('ha_dark_light_mode_body_color');
    uiColor($options,"ha_dark_light_mode_body_color");
    
}

function ha_dark_light_mode_ti_widget_color_render() {
    $options = get_option('ha_dark_light_mode_ti_widget_color');
    uiColor($options,"ha_dark_light_mode_ti_widget_color");
    
}

function ha_dark_light_mode_back_to_top_color_render() {
    $options = get_option('ha_dark_light_mode_back_to_top_color');
    uiColor($options,"ha_dark_light_mode_back_to_top_color");
    
}

function ha_dark_light_mode_depicter_background_render() {
    $options = get_option('ha_dark_light_mode_depicter_background');
    uiColor($options,"ha_dark_light_mode_depicter_background");
    
}

function ha_dark_light_mode_depicter_title_render() {
    $options = get_option('ha_dark_light_mode_depicter_title');
    uiColor($options,"ha_dark_light_mode_depicter_title");
    
}

function ha_dark_light_mode_depicter_text_render() {
    $options = get_option('ha_dark_light_mode_depicter_text');
    uiColor($options,"ha_dark_light_mode_depicter_text");
    
}

function uiColor($options,$id){
    echo "<div class='color-section'>
                        <label for='{$options}'></label>
                        <div class='color-picker'>
                            <div class='color-display' id='{$id}Display' style='background-color: " . esc_attr($options ?? '#ffffff') . ";'></div>
                            <input type='color' id='{$id}' class='color-input' name='{$id}' value='" . esc_attr($options ?? '#ffffff') . "' onchange='updateColor(\"{$id}\")'>
                        </div>
                    </div>";
}