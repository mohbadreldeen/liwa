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
}

function register_custom_addons() {
    // Register the container element using vc_lean_map
    vc_lean_map('liwa_slider', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-slider.php');
}

// Shortcode function for the container
function liwa_slider_shortcode($atts, $content = null) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'container_class' => '',
        'background_color' => '',
        'padding' => '',
        'margin' => '',
        'border_radius' => '',
        'min_height' => '',
        'el_class' => '',
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

// Register the shortcode
add_shortcode('liwa_slider', 'liwa_slider_shortcode');

// Optional: Add custom category for elements
add_filter('vc_load_default_templates', 'custom_wpbakery_templates');
function custom_wpbakery_templates($templates) {
    $templates[] = array(
        'name' => __('Liwa Slider Template', 'liwadates'),
        'template' => '[liwa_slider][vc_column_text]Add your content here...[/vc_column_text][/liwa_slider]'
    );
    return $templates;
}

// Enable container functionality for WPBakery backend editor
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_liwa_slider extends WPBakeryShortCodesContainer {}
}
