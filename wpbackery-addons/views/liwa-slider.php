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

// Use child content as slider content (this comes from the container)
$slider_content = $child_content;

// Set up variables for the common swiper view
$no_content_message = __('No content found. Please add content to the slider.', 'liwadates');

// Include the common swiper view
include LIWA_THEME_PATH . 'wpbackery-addons/views/liwa-swiper.php';
