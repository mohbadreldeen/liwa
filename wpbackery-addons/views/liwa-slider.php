<?php
// Extract slider settings from atts
$items_per_slide_desktop = !empty($atts['items_per_slide_desktop']) ? intval($atts['items_per_slide_desktop']) : 3;
$items_per_slide_tablet = !empty($atts['items_per_slide_tablet']) ? intval($atts['items_per_slide_tablet']) : 2;
$items_per_slide_mobile = !empty($atts['items_per_slide_mobile']) ? intval($atts['items_per_slide_mobile']) : 1;
$space_between = !empty($atts['space_between']) ? intval($atts['space_between']) : 30;
$show_navigation = !empty($atts['show_navigation']);
$show_pagination = !empty($atts['show_pagination']);
$autoplay = !empty($atts['autoplay']);
$autoplay_delay = !empty($atts['autoplay_delay']) ? intval($atts['autoplay_delay']) : 3000;
$loop = !empty($atts['loop']);
$speed = !empty($atts['speed']) ? intval($atts['speed']) : 300;
$theme = !empty($atts['theme']) ? $atts['theme'] : 'light';

// Add theme class to CSS classes
$css_classes[] = 'liwa-slider-theme-' . $theme;

// Create data attributes for Swiper configuration
$swiper_config = [
    'slidesPerView' => $items_per_slide_mobile,
    'spaceBetween' => $space_between,
    'speed' => $speed,
    'breakpoints' => [
        '768' => [
            'slidesPerView' => $items_per_slide_tablet,
            'spaceBetween' => $space_between
        ],
        '1024' => [
            'slidesPerView' => $items_per_slide_desktop,
            'spaceBetween' => $space_between
        ]
    ]
];

if ($autoplay) {
    $swiper_config['autoplay'] = [
        'delay' => $autoplay_delay,
        'disableOnInteraction' => false
    ];
}

if ($loop) {
    $swiper_config['loop'] = true;
}

if ($show_navigation) {
    $swiper_config['navigation'] = [
        'nextEl' => '.swiper-button-next',
        'prevEl' => '.swiper-button-prev'
    ];
}

if ($show_pagination) {
    $swiper_config['pagination'] = [
        'el' => '.swiper-pagination',
        'clickable' => true
    ];
}
?>

<div 
  class="swiper <?php echo esc_attr(implode(' ', $css_classes)); ?>" 
  id="<?php echo esc_attr($unique_id); ?>"
  data-swiper-config="<?php echo esc_attr(json_encode($swiper_config)); ?>"<?php echo $style_attr; ?>
>
  <div class="swiper-wrapper">
  
    <?php echo $child_content; ?>
  </div>
  
  <?php if ($show_navigation || $show_pagination): ?>
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
  <?php endif; ?>
</div>
