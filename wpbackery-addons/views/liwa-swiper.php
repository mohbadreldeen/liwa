<?php
/**
 * Common Swiper Slider View
 * 
 * This is a reusable Swiper slider component that can be used across all slider addons.
 * 
 * Required Variables:
 * @var string $unique_id - Unique identifier for the slider
 * @var array $css_classes - Array of CSS classes
 * @var array $swiper_config - Swiper configuration array
 * @var string $slider_content - HTML content for slides (slides wrapper content)
 * @var bool $show_navigation - Whether to show navigation arrows
 * @var bool $show_pagination - Whether to show pagination dots
 * @var string $theme - Slider theme (light/dark)
 * @var string $no_content_message - Message to show when no content (optional)
 * 
 * Example Usage:
 * 
 * // Set up required variables
 * $unique_id = 'my-slider-' . uniqid();
 * $css_classes = array('my-slider', 'swiper');
 * $show_navigation = true;
 * $show_pagination = true;
 * $theme = 'light';
 * 
 * // Build swiper config
 * $swiper_config = array(
 *     'slidesPerView' => 1,
 *     'spaceBetween' => 30,
 *     'speed' => 300,
 * );
 * 
 * // Build slider content
 * $slider_content = '';
 * // Generate your slides here...
 * $slider_content .= '<div class="swiper-slide">Slide 1</div>';
 * $slider_content .= '<div class="swiper-slide">Slide 2</div>';
 * 
 * // Include this file
 * include LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-swiper.php';
 */

// Set default values for optional variables
$no_content_message = isset($no_content_message) ? $no_content_message : __('No content found.', 'liwadates');
$theme = isset($theme) ? $theme : 'light';

	// Ensure required variables are set
	if (!isset($unique_id) || !isset($css_classes) || !isset($swiper_config) || !isset($slider_content)) {
		echo '<div class="liwa-swiper-error">Error: Missing required variables for Swiper slider.</div>';
		return;
	}

	// Add theme class if not already present
	if (!in_array('liwa-slider-theme-' . $theme, $css_classes)) {
		$css_classes[] = 'liwa-slider-theme-' . $theme;
	}

	// Add base swiper classes if not present
	if (!in_array('swiper', $css_classes)) {
		$css_classes[] = 'swiper';
	}
?>

<?php if (!empty($slider_content)): ?>

<div 
  class="<?php echo esc_attr(implode(' ', $css_classes)); ?>"
  id="<?php echo esc_attr($unique_id); ?>"
  data-swiper-config="<?php echo esc_attr(json_encode($swiper_config)); ?>"
>
  <div class="swiper-wrapper">
    <?php 
	wp_log($slider_content);
	echo $slider_content; ?>
  </div>

  <center>
  <div class="swiper-navigation-box">
	
		<?php if ($show_navigation): ?>
			<div class="swiper-button-prev"></div>
		<?php endif; ?>
		<?php if ($show_pagination): ?>
			<div class="swiper-pagination"></div>
		<?php endif; ?>
		<?php if ($show_navigation): ?>
			<div class="swiper-button-next"></div>
		<?php endif; ?>
	</div>
	</center>
  
</div>

<?php else: ?>
  <div class="liwa-swiper-no-content">
    <p><?php echo esc_html($no_content_message); ?></p>
  </div>
<?php endif; ?>
