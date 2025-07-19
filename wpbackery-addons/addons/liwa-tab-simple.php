<?php
/**
 * Liwa Tab Item Element - Individual Tab
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

return [
    'name' => __('Liwa Tab', 'liwa'),
    'description' => __('Individual tab content', 'liwa'),
    'base' => 'liwa_tab',
	 'icon' => 'icon-wpb-layout_sidebar',
    'content_element' => true,
    'is_container' => true,
	'as_parent' => ['except' => []],
    'show_settings_on_create' => false,
    'as_child' => [
        'only' => 'liwa_tabs'
    ],
    'category' => 'Liwa Addons',
    'js_view' => 'VcColumnView',



 


    'params' => [
        [
            'type' => 'textfield',
            'heading' => __('Tab Title', 'liwa'),
            'param_name' => 'title',
            'admin_label' => true,
            'description' => __('Enter tab title', 'liwa'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Tab Display Type', 'liwa'),
            'param_name' => 'display_type',
            'value' => [
                __('Icon', 'liwa') => 'icon',
                __('Image', 'liwa') => 'image',
                __('None', 'liwa') => 'none',
            ],
            'std' => 'none',
            'description' => __('Choose whether to display an icon or image above the tab title', 'liwa'),
        ],
        [
            'type' => 'iconpicker',
            'heading' => __('Tab Icon', 'liwa'),
            'param_name' => 'icon',
            'description' => __('Select icon for tab', 'liwa'),
            'settings' => [
                'emptyIcon' => false,
                'iconsPerPage' => 4000,
            ],
            'dependency' => [
                'element' => 'display_type',
                'value' => 'icon',
            ],
        ],
        [
            'type' => 'attach_image',
            'heading' => __('Tab Image', 'liwa'),
            'param_name' => 'tab_image',
            'description' => __('Upload an image to display above the tab title', 'liwa'),
            'dependency' => [
                'element' => 'display_type',
                'value' => 'image',
            ],
        ],
        [
            'type' => 'textfield',
            'heading' => __('Image/Icon Size', 'liwa'),
            'param_name' => 'icon_size',
            'value' => '24',
            'description' => __('Set the size in pixels (e.g., 24)', 'liwa'),
            'dependency' => [
                'element' => 'display_type',
                'value' => ['icon', 'image'],
            ],
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Show Tab Title', 'liwa'),
            'param_name' => 'show_title',
            'value' => [
                __('Yes', 'liwa') => 'yes',
                __('No', 'liwa') => 'no',
            ],
            'std' => 'yes',
            'description' => __('Choose whether to display the tab title text', 'liwa'),
        ],
    ]
];
