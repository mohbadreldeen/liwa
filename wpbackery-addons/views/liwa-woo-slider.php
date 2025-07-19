<?php
/**
 * WooCommerce Slider View
 * 
 * Displays a swiper-based product slider using WooCommerce products.
 * This view uses modular components:
 * - product-item.php: Individual product markup
 * - liwa-swiper.php: Common swiper slider wrapper
 * 
 * @since 1.0.0
 */

// Check if WooCommerce is active
if (!class_exists('WooCommerce')) {
    echo '<div class="liwa-woo-slider-error">WooCommerce is not active. Please install and activate WooCommerce to use this slider.</div>';
    return;
}

// Extract WooCommerce product settings from atts
$category_mode = !empty($atts['category_mode']) ? $atts['category_mode'] : 'all';
$product_categories = !empty($atts['product_categories']) ? $atts['product_categories'] : '';
$selected_categories = !empty($atts['selected_categories']) ? $atts['selected_categories'] : '';
$products_count = !empty($atts['products_count']) ? intval($atts['products_count']) : 12;
$orderby = !empty($atts['orderby']) ? $atts['orderby'] : 'date';
$order = !empty($atts['order']) ? $atts['order'] : 'DESC';
$featured_only = !empty($atts['featured_only']);
$sale_only = !empty($atts['sale_only']);
$el_class = !empty($atts['el_class']) ? $atts['el_class'] : '';

// Extract slider settings from atts
$items_per_slide_desktop = !empty($atts['items_per_slide_desktop']) ? intval($atts['items_per_slide_desktop']) : 4;
$items_per_slide_tablet = !empty($atts['items_per_slide_tablet']) ? intval($atts['items_per_slide_tablet']) : 3;
$items_per_slide_mobile = !empty($atts['items_per_slide_mobile']) ? intval($atts['items_per_slide_mobile']) : 2;
$space_between = !empty($atts['space_between']) ? intval($atts['space_between']) : 30;
$show_navigation = !empty($atts['show_navigation']);
$show_pagination = !empty($atts['show_pagination']);
$autoplay = !empty($atts['autoplay']);
$autoplay_delay = !empty($atts['autoplay_delay']) ? intval($atts['autoplay_delay']) : 3000;
$loop = !empty($atts['loop']);
$speed = !empty($atts['speed']) ? intval($atts['speed']) : 300;
$theme = !empty($atts['theme']) ? $atts['theme'] : 'light';

// Build CSS classes
$css_classes = array('liwa-woo-slider', 'swiper');
if (!empty($el_class)) {
    $css_classes[] = sanitize_html_class($el_class);
}

// Generate unique ID for styling
$unique_id = 'liwa-woo-slider-' . uniqid();

// Build WooCommerce query arguments
$args = array(
    'post_type' => 'product',
    'posts_per_page' => $products_count,
    'post_status' => 'publish',
    'orderby' => $orderby,
    'order' => $order 
     
);

// Add category filter based on mode
$categories_to_filter = array();

if ($category_mode === 'single' && !empty($product_categories)) {
    // Single category mode
    $categories_to_filter = array($product_categories);
} elseif ($category_mode === 'multiple' && !empty($selected_categories)) {
    // Multiple categories mode - selected_categories comes as comma-separated values from checkbox
    if (is_string($selected_categories)) {
        $categories_to_filter = array_map('trim', explode(',', $selected_categories));
    } elseif (is_array($selected_categories)) {
        $categories_to_filter = $selected_categories;
    }
}
// If mode is 'all', we don't add any category filter

// Apply category filter if we have categories to filter
if (!empty($categories_to_filter)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $categories_to_filter,
            'operator' => 'IN'
        )
    );
}

// Add featured products filter
if ($featured_only) {
    $args['meta_query'][] = array(
        'key' => '_featured',
        'value' => 'yes',
        'compare' => '='
    );
}

// Add sale products filter
if ($sale_only) {
    $args['meta_query'][] = array(
        'key' => '_sale_price',
        'value' => '',
        'compare' => '!='
    );
}

// Handle special orderby cases
if ($orderby === 'popularity') {
    $args['meta_key'] = 'total_sales';
    $args['orderby'] = 'meta_value_num';
} elseif ($orderby === 'rating') {
    $args['meta_key'] = '_wc_average_rating';
    $args['orderby'] = 'meta_value_num';
} elseif ($orderby === 'price') {
    $args['meta_key'] = '_price';
    $args['orderby'] = 'meta_value_num';
}

// Execute the query
$products = new WP_Query($args);


wp_log("products");
wp_log('Number of products found: ' . $products->found_posts);

// Build Swiper configuration
$swiper_config = array(
    'slidesPerView' => $items_per_slide_mobile,
    'spaceBetween' => $space_between,
    'speed' => $speed,
    'breakpoints' => array(
        768 => array(
            'slidesPerView' => $items_per_slide_tablet,
        ),
        1024 => array(
            'slidesPerView' => $items_per_slide_desktop,
        ),
    ),
);

if ($show_navigation) {
    $swiper_config['navigation'] = array(
        'nextEl' => '#' . $unique_id . ' .swiper-button-next',
        'prevEl' => '#' . $unique_id . ' .swiper-button-prev',
    );
}

if ($show_pagination) {
    $swiper_config['pagination'] = array(
        'el' => '#' . $unique_id . ' .swiper-pagination',
        'clickable' => true,
    );
}

if ($autoplay) {
    $swiper_config['autoplay'] = array(
        'delay' => $autoplay_delay,
        'disableOnInteraction' => false,
    );
}

if ($loop) {
    $swiper_config['loop'] = true;
}

// Build slider content (slides)
$slider_content = '';
if ($products->have_posts()) {
    while ($products->have_posts()) {
        $products->the_post();
        global $product;
        
        ob_start();
        ?>
        <div class="swiper-slide">
            <?php
            // Include the product item template
            include LIWA_THEME_PATH . 'wpbackery-addons/views/product-item.php';
            ?>
        </div>
        <?php
        $slider_content .= ob_get_clean();
        
    }
    wp_reset_postdata();
}

// Set up variables for the common swiper view
$no_content_message = __('No products found.', 'liwadates');

// Include the common swiper view
include LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-swiper.php';
