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
    add_shortcode('liwa_woo_slider', 'liwa_woo_slider_shortcode');
    add_shortcode('liwa_tilt_image', 'liwa_tilt_image_shortcode');
    add_shortcode('liwa_tabs', 'liwa_tabs_shortcode');
    // add_shortcode('liwa_tab', 'liwa_tab_shortcode');
    add_shortcode('liwa_advanced_tabs', 'liwa_advanced_tabs_shortcode');
}

function register_custom_addons() {
    // Register the container element using vc_lean_map
    vc_lean_map('liwa_slider', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-slider.php');
    vc_lean_map('liwa_flex_box', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-flex-box.php');
    vc_lean_map('liwa_flex_box_inner', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-flex-box-inner.php');
    vc_lean_map('liwa_woo_slider', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-woo-slider.php');
    vc_lean_map('liwa_tilt_image', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-tilt-image.php');
    
    // Register simple tabs elements (like native WPBakery tabs)
    vc_lean_map('liwa_tabs', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-tabs-simple.php');
    vc_lean_map('liwa_tab', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-tab-simple.php');
    
    // Register advanced tabs elements
    // vc_lean_map('liwa_advanced_tabs', null, LIWA_THEME_PATH . 'wpbackery-addons/addons/liwa-tabs.php');
    
    // Include tabs view functions
    // require_once LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-tabs.php';
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

// Shortcode function for the WooCommerce slider
function liwa_woo_slider_shortcode($atts, $content = null) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'category_mode' => 'all',
        'product_categories' => '',
        'selected_categories' => '',
        'products_count' => '12',
        'orderby' => 'date',
        'order' => 'DESC',
        'featured_only' => '',
        'sale_only' => '',
        'items_per_slide_desktop' => '4',
        'items_per_slide_tablet' => '3',
        'items_per_slide_mobile' => '2',
        'space_between' => '30',
        'show_navigation' => '',
        'show_pagination' => '',
        'autoplay' => '',
        'autoplay_delay' => '3000',
        'loop' => '',
        'speed' => '300',
        'theme' => 'light',
        'el_class' => '',
    ), $atts);
    
    // Start output buffering
    ob_start();
    
    // Include the view file
    include LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-woo-slider.php';
    
    return ob_get_clean();
}

// Shortcode function for the Tilt Image
function liwa_tilt_image_shortcode($atts, $content = null) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'image' => '',
        'image_size' => 'large',
        'alt_text' => '',
        'image_link' => '',
        'tilt_intensity' => 'normal',
        'tilt_scale' => '1.05',
        'max_tilt' => '15',
        'enable_glow' => '',
        'enable_shadow' => '',
        'border_radius' => 'small',
        'theme' => 'default',
        'width' => '',
        'height' => '',
        'alignment' => 'center',
        'animate_on_scroll' => '',
        'el_class' => '',
    ), $atts);
    
    // Start output buffering
    ob_start();
    
    // Include the view file
    include LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-tilt-image.php';
    
    return ob_get_clean();
}

// Enqueue styles and scripts for the addons
add_action('wp_enqueue_scripts', 'liwa_wpbakery_addons_enqueue_assets');

function liwa_wpbakery_addons_enqueue_assets() {
    // Enqueue WooCommerce slider CSS
    wp_enqueue_style('liwa-woo-slider', LIWA_THEME_URL . 'wpbackery-addons/assets/liwa-woo-slider.css', array(), '1.0.0');
    
    // Enqueue simple tabs CSS
    wp_enqueue_style('liwa-tabs', LIWA_THEME_URL . 'wpbackery-addons/assets/liwa-tabs.css', array(), '1.0.0');
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
    $templates[] = array(
        'name' => __('Liwa WooCommerce Slider Template', 'liwadates'),
        'template' => '[liwa_woo_slider category_mode="all" products_count="12"]'
    );
    $templates[] = array(
        'name' => __('Liwa Tilt Image Template', 'liwadates'),
        'template' => '[liwa_tilt_image tilt_intensity="normal" enable_glow="yes"]'
    );
    $templates[] = array(
        'name' => __('Tabs with Images Template', 'liwadates'),
        'template' => '[liwa_tabs tab_style="default" image_position="left"][liwa_tab title="Tab 1"][vc_column_text]Content for tab 1...[/vc_column_text][/liwa_tab][liwa_tab title="Tab 2"][vc_column_text]Content for tab 2...[/vc_column_text][/liwa_tab][liwa_tab title="Tab 3"][vc_column_text]Content for tab 3...[/vc_column_text][/liwa_tab][/liwa_tabs]'
    );
    $templates[] = array(
        'name' => __('Liwa Advanced Tabs Template', 'liwadates'),
        'template' => '[liwa_advanced_tabs tab_style="Style_1" disp_icon="Enable"][liwa_advanced_tab_item title="Tab 1" icon="fa fa-home"][vc_column_text]Content for tab 1...[/vc_column_text][/liwa_advanced_tab_item][liwa_advanced_tab_item title="Tab 2" icon="fa fa-user"][vc_column_text]Content for tab 2...[/vc_column_text][/liwa_advanced_tab_item][liwa_advanced_tab_item title="Tab 3" icon="fa fa-cog"][vc_column_text]Content for tab 3...[/vc_column_text][/liwa_advanced_tab_item][/liwa_advanced_tabs]'
    );
    return $templates;
}

// Enable container functionality for WPBakery backend editor
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_liwa_slider extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_liwa_flex_box extends WPBakeryShortCodesContainer { }
    class WPBakeryShortCode_liwa_flex_box_inner extends WPBakeryShortCodesContainer {}
}

 

// Helper function to get product categories for dropdown
function liwa_get_product_categories_for_dropdown() {
    $categories = array();
    
    // Add "All Categories" option
    $categories['All Categories'] = '';
    
    // Check if WooCommerce is active
    if (class_exists('WooCommerce')) {
        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC'
        ));
        
        if (!is_wp_error($terms) && !empty($terms)) {
            foreach ($terms as $term) {
                $categories[$term->name] = $term->slug;
            }
        }
    } else {
        // WooCommerce is not active, provide some default placeholder options
        $categories['Please install WooCommerce'] = 'woocommerce-required';
    }
    
    return $categories;
}

// Helper function to get product categories for checkbox selection
function liwa_get_product_categories_for_checkbox() {
    $categories = array();
    
    // Check if WooCommerce is active
    if (class_exists('WooCommerce')) {
        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC'
        ));
        
        if (!is_wp_error($terms) && !empty($terms)) {
            foreach ($terms as $term) {
                $categories[$term->name] = $term->slug;
            }
        }
    }
    
    return $categories;
}

// WPBakery container and element classes for simple tabs
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_liwa_tabs extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_liwa_tab extends WPBakeryShortCodesContainer {}
}

// Include shortcode functions for advanced tabs
require_once LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-tabs.php';
