<?php
// Extract flex box settings from atts
$flex_direction = !empty($atts['flex_direction']) ? $atts['flex_direction'] : 'row';
$gap = !empty($atts['gap']) ? intval($atts['gap']) : 20;
$justify_content = !empty($atts['justify_content']) ? $atts['justify_content'] : 'flex-start';
$align_items = !empty($atts['align_items']) ? $atts['align_items'] : 'stretch';
$flex_wrap = !empty($atts['flex_wrap']) ? $atts['flex_wrap'] : 'nowrap';
$min_height = !empty($atts['min_height']) ? $atts['min_height'] : '';
$padding = !empty($atts['padding']) ? $atts['padding'] : '';
$margin = !empty($atts['margin']) ? $atts['margin'] : '';
$background_color = !empty($atts['background_color']) ? $atts['background_color'] : '';
$border_radius = !empty($atts['border_radius']) ? $atts['border_radius'] : '';
$el_class = !empty($atts['el_class']) ? $atts['el_class'] : '';

// Build CSS classes
$css_classes = array('liwa-flex-box', 'wpb_content_element', 'vc_element');
if (!empty($el_class)) {
    $css_classes[] = sanitize_html_class($el_class);
}

if ($flex_direction === 'row') {
	$css_classes[] = 'liwa-flex-box--row';
} elseif ($flex_direction === 'column') {
	$css_classes[] = 'liwa-flex-box--column';
}

// Generate unique ID for styling
$unique_id = 'liwa-flex-box-' . uniqid();

// Add container-specific data attributes
$container_data = ' data-element_type="liwa_flex_box" data-vc-container=".liwa-flex-box"';

// Build inline styles
$inline_styles = array();

// Flexbox properties
$inline_styles[] = 'display: flex';
$inline_styles[] = 'flex-direction: ' . esc_attr($flex_direction);
$inline_styles[] = 'gap: ' . esc_attr($gap) . 'px';
$inline_styles[] = 'justify-content: ' . esc_attr($justify_content);
$inline_styles[] = 'align-items: ' . esc_attr($align_items);
$inline_styles[] = 'flex-wrap: ' . esc_attr($flex_wrap);

// Container styling
if (!empty($min_height)) {
    $inline_styles[] = 'min-height: ' . esc_attr($min_height);
}
if (!empty($padding)) {
    $inline_styles[] = 'padding: ' . esc_attr($padding);
}
if (!empty($margin)) {
    $inline_styles[] = 'margin: ' . esc_attr($margin);
}
if (!empty($background_color)) {
    $inline_styles[] = 'background-color: ' . esc_attr($background_color);
}
if (!empty($border_radius)) {
    $inline_styles[] = 'border-radius: ' . esc_attr($border_radius);
}

$style_attr = !empty($inline_styles) ? ' style="' . implode('; ', $inline_styles) . '"' : '';
?>

<div 
  class="<?php echo esc_attr(implode(' ', $css_classes)); ?>" 
  id="<?php echo esc_attr($unique_id); ?>" <?php echo $style_attr; ?><?php echo $container_data; ?>
>
    <?php echo $child_content; ?>
</div>

 
