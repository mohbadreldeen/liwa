<?php
/**
 * Liwa Tabs Element - Simple Version
 * Similar to native WPBakery tabs but with custom styling
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

return [
    'name' => __('Liwa Tabs', 'liwa'),
    'description' => __('Create simple tabbed content similar to native WPBakery tabs', 'liwa'),
    'base' => 'liwa_tabs',
    'icon' => 'icon-wpb-ui-tab-content',
    'content_element' => true,
    'is_container' => true,
    'as_parent' => [
        'only' => 'liwa_tab'
    ],
    'show_settings_on_create' => false,
    'category' => 'Liwa Elements',
    'js_view' => 'VcColumnView',
    'params' => [
        [
            'type' => 'dropdown',
            'heading' => __('Tab Style', 'liwa'),
            'param_name' => 'tab_style',
            'value' => [
                __('Default', 'liwa') => 'default',
                __('Modern', 'liwa') => 'modern',
                __('Minimal', 'liwa') => 'minimal',
            ],
            'std' => 'default',
            'description' => __('Select the visual style for your tabs', 'liwa'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Active Tab', 'liwa'),
            'param_name' => 'active_tab',
            'value' => '1',
            'description' => __('Enter which tab should be active by default (1 for first tab)', 'liwa'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Tab Alignment', 'liwa'),
            'param_name' => 'tab_alignment',
            'value' => [
                __('Left', 'liwa') => 'flex-start',
                __('Center', 'liwa') => 'center',
                __('Right', 'liwa') => 'flex-end',
                __('Space Between', 'liwa') => 'space-between',
                __('Space Around', 'liwa') => 'space-around',
                __('Space Evenly', 'liwa') => 'space-evenly',
            ],
            'std' => 'flex-start',
            'description' => __('Horizontal alignment of tabs using flexbox justify-content', 'liwa'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Extra CSS Class', 'liwa'),
            'param_name' => 'el_class',
            'description' => __('Add extra CSS class for custom styling', 'liwa'),
        ],
    ],
    'default_content' => '[liwa_tab title="' . __('Tab 1', 'liwa') . '"][/liwa_tab][liwa_tab title="' . __('Tab 2', 'liwa') . '"][/liwa_tab]',
    'custom_markup' => '',
];
