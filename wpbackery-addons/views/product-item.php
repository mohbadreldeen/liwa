<?php
/**
 * Product Item Template
 * 
 * Displays a single WooCommerce product item for use in sliders and grids.
 * 
 * Required Variables:
 * @var WC_Product $product - The WooCommerce product object
 * 
 * Optional Variables:
 * @var string $wrapper_class - Additional CSS class for the wrapper (default: 'product-item')
 * @var bool $show_sale_badge - Whether to show sale badge (default: true)
 * @var bool $show_featured_badge - Whether to show featured badge (default: true)
 * @var bool $show_rating - Whether to show product rating (default: true)
 * @var bool $show_description - Whether to show product description (default: true)
 * @var int $description_word_limit - Maximum words for description (default: 7)
 * @var bool $show_add_to_cart - Whether to show add to cart button (default: true)
 * @var string $image_size - WordPress image size (default: 'woocommerce_thumbnail')
 * 
 * Example Usage:
 * 
 * // Set up required variables
 * global $product;
 * 
 * // Set optional variables (if needed)
 * $wrapper_class = 'my-custom-product-item';
 * $show_sale_badge = true;
 * $show_featured_badge = false;
 * $show_description = true;
 * $description_word_limit = 10; // Show 10 words instead of default 7
 * 
 * // Include this template
 * include LIWA_THEME_PATH . 'wpbackery-addons/views/product-item.php';
 */

// Ensure we have a product object
if (!isset($product) || !is_a($product, 'WC_Product')) {
    return;
}

// Set default values for optional variables
$wrapper_class = isset($wrapper_class) ? $wrapper_class : 'product-item';
$show_sale_badge = isset($show_sale_badge) ? $show_sale_badge : true;
$show_featured_badge = isset($show_featured_badge) ? $show_featured_badge : true;
$show_rating = isset($show_rating) ? $show_rating : true;
$show_description = isset($show_description) ? $show_description : true;
$description_word_limit = isset($description_word_limit) ? intval($description_word_limit) : 5;
$show_add_to_cart = isset($show_add_to_cart) ? $show_add_to_cart : true;
$image_size = isset($image_size) ? $image_size : 'woocommerce_thumbnail';
?>

<div class="<?php echo esc_attr($wrapper_class); ?>">
    <div class="product-image">
        <a href="<?php echo esc_url(get_permalink()); ?>">
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail($image_size, array('class' => 'product-thumb')); ?>
            <?php else: ?>
                <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="product-thumb">
            <?php endif; ?>
        </a>
        
        <?php if ($show_sale_badge && $product->is_on_sale()): ?>
            <span class="sale-badge"><?php esc_html_e('Sale', 'liwadates'); ?></span>
        <?php endif; ?>
        
        <?php if ($show_featured_badge && $product->is_featured()): ?>
            <span class="featured-badge"><?php esc_html_e('Featured', 'liwadates'); ?></span>
        <?php endif; ?>
    </div>
    
    <div class="product-info">
        <h3 class="product-title">
            <a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
        </h3>

		<?php if ($show_description): ?>
            <div class="product-description">
                <?php 
                // Get the product description (short description first, then full description as fallback)
                $description = $product->get_short_description();
                if (empty($description)) {
                    $description = $product->get_description();
                }
                
                if (!empty($description)) {
                    // Strip HTML tags and get plain text
                    $description = wp_strip_all_tags($description);
                    
                    // Split into words and limit to specified number
                    $words = explode(' ', $description);
                    if (count($words) > $description_word_limit) {
                        $description = implode(' ', array_slice($words, 0, $description_word_limit)) . '...';
                    }
                    
                    echo '<p>' . esc_html($description) . '</p>';
                }
                ?>
            </div>
        <?php endif; ?>
        
        <div class="product-price">
            <?php echo $product->get_price_html(); ?>
        </div>
        
        <?php if ($show_rating && wc_review_ratings_enabled()): ?>
            <div class="product-rating">
                <?php echo wc_get_rating_html($product->get_average_rating()); ?>
            </div>
        <?php endif; ?>
        
        
  
    </div>
</div>
