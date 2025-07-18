<?php

if (!defined('ABSPATH'))
    die('-1');

return [
    'name' => __('Liwa Slider', 'liwadates'),
    'description' => __('A flexible container that can hold any WPBakery elements', 'liwadates'),
    'base' => 'liwa_slider',
    'icon' => 'icon-wpb-layout_sidebar',
    'content_element' => true,
    'is_container' => true,
    'as_parent' => ['except' => []],
    'show_settings_on_create' => false,
    'category' => 'Liwa Addons',
    'js_view' => 'VcColumnView',
    'params' => [
        [
            'type' => 'textfield',
            'heading' => __('Items Per Slide (Desktop)', 'liwadates'),
            'param_name' => 'items_per_slide_desktop',
            'value' => '3',
            'description' => __('Number of items to show per slide on desktop (default: 3)', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Items Per Slide (Tablet)', 'liwadates'),
            'param_name' => 'items_per_slide_tablet',
            'value' => '2',
            'description' => __('Number of items to show per slide on tablet (default: 2)', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Items Per Slide (Mobile)', 'liwadates'),
            'param_name' => 'items_per_slide_mobile',
            'value' => '1',
            'description' => __('Number of items to show per slide on mobile (default: 1)', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Space Between Slides', 'liwadates'),
            'param_name' => 'space_between',
            'value' => '30',
            'description' => __('Space between slides in pixels (default: 30)', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'checkbox',
            'heading' => __('Show Navigation Arrows', 'liwadates'),
            'param_name' => 'show_navigation',
            'value' => ['yes' => __('Yes', 'liwadates')],
            'description' => __('Show previous/next navigation arrows', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'checkbox',
            'heading' => __('Show Pagination', 'liwadates'),
            'param_name' => 'show_pagination',
            'value' => ['yes' => __('Yes', 'liwadates')],
            'description' => __('Show pagination dots', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'checkbox',
            'heading' => __('Autoplay', 'liwadates'),
            'param_name' => 'autoplay',
            'description' => __('Enable automatic sliding', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Autoplay Delay', 'liwadates'),
            'param_name' => 'autoplay_delay',
            'value' => '3000',
            'description' => __('Delay between slides in milliseconds (default: 3000)', 'liwadates'),
            'dependency' => [
                'element' => 'autoplay',
                'not_empty' => true,
            ],
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'checkbox',
            'heading' => __('Loop', 'liwadates'),
            'param_name' => 'loop',
            'value' => ['yes' => __('Yes', 'liwadates')],
            'description' => __('Enable continuous loop mode', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Slider Speed', 'liwadates'),
            'param_name' => 'speed',
            'value' => '300',
            'description' => __('Duration of transition between slides in milliseconds (default: 300)', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Theme', 'liwadates'),
            'param_name' => 'theme',
            'value' => [
                __('Light', 'liwadates') => 'light',
                __('Dark', 'liwadates') => 'dark',
            ],
            'std' => 'light',
            'description' => __('Choose the theme for the slider (default: light)', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
    ]
];
