<?php

if (!defined('ABSPATH'))
    die('-1');

return [
    'name' => __('Liwa Flex Box Inner', 'liwadates'),
    'description' => __('An inner flexible container specifically designed for nesting inside Liwa Flex Box', 'liwadates'),
    'base' => 'liwa_flex_box_inner',
    'icon' => 'icon-wpb-ui-accordion',
    'content_element' => true,
    'is_container' => true,
    'as_parent' => ['except' => []],
    'as_child' => ['only' => 'liwa_flex_box'],
    'show_settings_on_create' => false,
    'category' => 'Liwa Addons',
    'js_view' => 'VcColumnView',



 
    'params' => [
        [
            'type' => 'dropdown',
            'heading' => __('Flex Direction', 'liwadates'),
            'param_name' => 'flex_direction',
            'value' => [
                __('Row (Horizontal)', 'liwadates') => 'row',
                __('Column (Vertical)', 'liwadates') => 'column',
                __('Row Reverse', 'liwadates') => 'row-reverse',
                __('Column Reverse', 'liwadates') => 'column-reverse',
            ],
            'std' => 'row',
            'description' => __('Choose the direction of the flex items (default: row)', 'liwadates'),
            'group' => __('Flex Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Gap', 'liwadates'),
            'param_name' => 'gap',
            'value' => '15',
            'description' => __('Space between flex items in pixels (default: 15)', 'liwadates'),
            'group' => __('Flex Settings', 'liwadates'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Justify Content', 'liwadates'),
            'param_name' => 'justify_content',
            'value' => [
                __('Flex Start', 'liwadates') => 'flex-start',
                __('Center', 'liwadates') => 'center',
                __('Flex End', 'liwadates') => 'flex-end',
                __('Space Between', 'liwadates') => 'space-between',
                __('Space Around', 'liwadates') => 'space-around',
                __('Space Evenly', 'liwadates') => 'space-evenly',
            ],
            'std' => 'flex-start',
            'description' => __('How to align items along the main axis (default: flex-start)', 'liwadates'),
            'group' => __('Flex Settings', 'liwadates'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Align Items', 'liwadates'),
            'param_name' => 'align_items',
            'value' => [
                __('Stretch', 'liwadates') => 'stretch',
                __('Flex Start', 'liwadates') => 'flex-start',
                __('Center', 'liwadates') => 'center',
                __('Flex End', 'liwadates') => 'flex-end',
                __('Baseline', 'liwadates') => 'baseline',
            ],
            'std' => 'stretch',
            'description' => __('How to align items along the cross axis (default: stretch)', 'liwadates'),
            'group' => __('Flex Settings', 'liwadates'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Flex Wrap', 'liwadates'),
            'param_name' => 'flex_wrap',
            'value' => [
                __('No Wrap', 'liwadates') => 'nowrap',
                __('Wrap', 'liwadates') => 'wrap',
                __('Wrap Reverse', 'liwadates') => 'wrap-reverse',
            ],
            'std' => 'nowrap',
            'description' => __('Whether flex items should wrap to new lines (default: nowrap)', 'liwadates'),
            'group' => __('Flex Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Min Height', 'liwadates'),
            'param_name' => 'min_height',
            'value' => '',
            'description' => __('Minimum height of the flex container (e.g., 200px, 50vh)', 'liwadates'),
            'group' => __('Container Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Padding', 'liwadates'),
            'param_name' => 'padding',
            'value' => '',
            'description' => __('Padding around the flex container (e.g., 20px, 10px 20px)', 'liwadates'),
            'group' => __('Container Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Margin', 'liwadates'),
            'param_name' => 'margin',
            'value' => '',
            'description' => __('Margin around the flex container (e.g., 20px, 10px 20px)', 'liwadates'),
            'group' => __('Container Settings', 'liwadates'),
        ],
        [
            'type' => 'colorpicker',
            'heading' => __('Background Color', 'liwadates'),
            'param_name' => 'background_color',
            'value' => '',
            'description' => __('Background color of the flex container', 'liwadates'),
            'group' => __('Container Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Border Radius', 'liwadates'),
            'param_name' => 'border_radius',
            'value' => '',
            'description' => __('Border radius of the flex container (e.g., 10px, 50%)', 'liwadates'),
            'group' => __('Container Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Custom CSS Class', 'liwadates'),
            'param_name' => 'el_class',
            'value' => '',
            'description' => __('Additional CSS class names for custom styling', 'liwadates'),
            'group' => __('Container Settings', 'liwadates'),
        ],
    ]
];
