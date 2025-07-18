<?php
/**
 * WPBakery Container Addon
 * 
 * Main file for registering custom WPBakery elements
 */

if (!defined('ABSPATH')) {
    exit;
}

// Hook into Visual Composer
add_action('vc_before_init', 'custom_wpbakery_addon_integration');

function custom_wpbakery_addon_integration() {
    // Check if WPBakery is active
    if (!defined('WPB_VC_VERSION')) {
        return;
    }
    
    // Register our addons
    register_custom_addons();
    
    // Register shortcodes
    add_shortcode('liwa_slider', 'liwa_slider_shortcode');
    add_shortcode('liwa_flex_box', 'liwa_flex_box_shortcode');
    add_shortcode('liwa_flex_box_inner', 'liwa_flex_box_inner_shortcode');
}

function register_custom_addons() {
    // Register the container element using vc_lean_map
    vc_lean_map('liwa_slider', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-slider.php');
    vc_lean_map('liwa_flex_box', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-flex-box.php');
    vc_lean_map('liwa_flex_box_inner', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-flex-box-inner.php');
}

// Shortcode function for the container
function liwa_slider_shortcode($atts, $content = null) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        // Legacy container attributes
        'container_class' => '',
        'background_color' => '',
        'padding' => '',
        'margin' => '',
        'border_radius' => '',
        'min_height' => '',
        'el_class' => '',
        // New slider settings
        'items_per_slide_desktop' => '3',
        'items_per_slide_tablet' => '2',
        'items_per_slide_mobile' => '1',
        'space_between' => '30',
        'show_navigation' => '',
        'show_pagination' => '',
        'autoplay' => '',
        'autoplay_delay' => '3000',
        'loop' => '',
        'speed' => '300',
        'theme' => 'light',
    ), $atts);
    
    // Process child content (this makes it work as a container)
    $child_content = do_shortcode($content);
    
    // Build CSS classes
    $css_classes = array('liwa-slider');
    if (!empty($atts['container_class'])) {
        $css_classes[] = sanitize_html_class($atts['container_class']);
    }
    if (!empty($atts['el_class'])) {
        $css_classes[] = sanitize_html_class($atts['el_class']);
    }
    
    // Generate unique ID for styling
    $unique_id = 'liwa-slider-' . uniqid();
    
    // Build inline styles
    $inline_styles = array();
    if (!empty($atts['background_color'])) {
        $inline_styles[] = 'background-color: ' . esc_attr($atts['background_color']);
    }
    if (!empty($atts['padding'])) {
        $inline_styles[] = 'padding: ' . esc_attr($atts['padding']);
    }
    if (!empty($atts['margin'])) {
        $inline_styles[] = 'margin: ' . esc_attr($atts['margin']);
    }
    if (!empty($atts['border_radius'])) {
        $inline_styles[] = 'border-radius: ' . esc_attr($atts['border_radius']);
    }
    if (!empty($atts['min_height'])) {
        $inline_styles[] = 'min-height: ' . esc_attr($atts['min_height']);
    }
    
    $style_attr = !empty($inline_styles) ? ' style="' . implode('; ', $inline_styles) . '"' : '';
    
    // Start output buffering
    ob_start();
    
    // Include the view file
    include LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-slider.php';
    
    return ob_get_clean();
}

// Shortcode function for the flex box
function liwa_flex_box_shortcode($atts, $content = null) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'flex_direction' => 'row',
        'gap' => '20',
        'justify_content' => 'flex-start',
        'align_items' => 'stretch',
        'flex_wrap' => 'nowrap',
        'min_height' => '',
        'padding' => '',
        'margin' => '',
        'background_color' => '',
        'border_radius' => '',
        'el_class' => '',
    ), $atts);
    
    // Process child content (this makes it work as a container)
    $child_content = do_shortcode($content);
    
    // Start output buffering
    ob_start();
    
    // Include the view file
    include LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-flex-box.php';
    
    return ob_get_clean();
}

// Shortcode function for the flex box inner
function liwa_flex_box_inner_shortcode($atts, $content = null) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'flex_direction' => 'row',
        'gap' => '20',
        'justify_content' => 'flex-start',
        'align_items' => 'stretch',
        'flex_wrap' => 'nowrap',
        'min_height' => '',
        'padding' => '',
        'margin' => '',
        'background_color' => '',
        'border_radius' => '',
        'el_class' => '',
    ), $atts);
    
    // Process child content (this makes it work as a container)
    $child_content = do_shortcode($content);
    
    // Start output buffering
    ob_start();
    
    // Include the view file
    include LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-flex-box-inner.php';
    
    return ob_get_clean();
}

// Optional: Add custom category for elements
add_filter('vc_load_default_templates', 'custom_wpbakery_templates');
function custom_wpbakery_templates($templates) {
    $templates[] = array(
        'name' => __('Liwa Slider Template', 'liwadates'),
        'template' => '[liwa_slider][vc_column_text]Add your content here...[/vc_column_text][/liwa_slider]'
    );
    $templates[] = array(
        'name' => __('Liwa Flex Box Template', 'liwadates'),
        'template' => '[liwa_flex_box][vc_column_text]Add your content here...[/vc_column_text][/liwa_flex_box]'
    );
    $templates[] = array(
        'name' => __('Liwa Flex Box Inner Template', 'liwadates'),
        'template' => '[liwa_flex_box_inner][vc_column_text]Add your content here...[/vc_column_text][/liwa_flex_box_inner]'
    );
    return $templates;
}

// Enable container functionality for WPBakery backend editor
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_liwa_slider extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_liwa_flex_box extends WPBakeryShortCodesContainer { }
    class WPBakeryShortCode_liwa_flex_box_inner extends WPBakeryShortCodesContainer {
        
    }
}
