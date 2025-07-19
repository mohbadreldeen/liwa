<?php
/**
 * Liwa Advanced Tabs Element
 * A comprehensive tabs solution with icon support, multiple styles, and responsive behavior
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

return [
    'name' => __('Liwa Advanced Tabs', 'liwa'),
    'description' => __('Create advanced tabbed content with icons, multiple styles, and responsive options', 'liwa'),
    'base' => 'liwa_advanced_tabs',
    'icon' => 'icon-wpb-ui-tab-content',
    'content_element' => true,
    'is_container' => true,
    'as_parent' => [
        'only' => 'liwa_advanced_tab_item'
    ],
    'show_settings_on_create' => false,
    'category' => 'Liwa Elements',
    'js_view' => 'VcColumnView',
    'params' => [
        // Tab Style Group
        [
            'type' => 'dropdown',
            'heading' => __('Tab Style', 'liwa'),
            'param_name' => 'tab_style',
            'value' => [
                __('Style 1 - Classic', 'liwa') => 'Style_1',
                __('Style 2 - Modern', 'liwa') => 'Style_2',
                __('Style 3 - Minimal', 'liwa') => 'Style_3',
                __('Style 4 - Bordered', 'liwa') => 'Style_4',
                __('Style 5 - Pills', 'liwa') => 'Style_5',
                __('Style 6 - Underline', 'liwa') => 'Style_6',
            ],
            'std' => 'Style_1',
            'description' => __('Select the visual style for your tabs', 'liwa'),
            'group' => __('Tab Style', 'liwa'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Active Tab Index', 'liwa'),
            'param_name' => 'tabs_active_index',
            'value' => '1',
            'description' => __('Enter which tab should be active by default (1 for first tab)', 'liwa'),
            'group' => __('Tab Style', 'liwa'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Tab Animation', 'liwa'),
            'param_name' => 'tab_animation',
            'value' => [
                __('Slide', 'liwa') => 'Slide',
                __('Fade', 'liwa') => 'Fade',
                __('Slide-Zoom', 'liwa') => 'Slide-Zoom',
            ],
            'std' => 'Slide',
            'description' => __('Animation when switching between tabs', 'liwa'),
            'group' => __('Tab Style', 'liwa'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Border Radius', 'liwa'),
            'param_name' => 'tabs_border_radius',
            'value' => '8',
            'description' => __('Border radius for tab corners in pixels', 'liwa'),
            'group' => __('Tab Style', 'liwa'),
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
            'group' => __('Tab Style', 'liwa'),
        ],

        // Colors Group
        [
            'type' => 'colorpicker',
            'heading' => __('Tab Title Color', 'liwa'),
            'param_name' => 'tab_title_color',
            'value' => '#74777b',
            'description' => __('Color of tab titles in normal state', 'liwa'),
            'group' => __('Colors', 'liwa'),
        ],
        [
            'type' => 'colorpicker',
            'heading' => __('Tab Hover Title Color', 'liwa'),
            'param_name' => 'tab_hover_title_color',
            'value' => '#ffffff',
            'description' => __('Color of tab titles on hover/active state', 'liwa'),
            'group' => __('Colors', 'liwa'),
        ],
        [
            'type' => 'colorpicker',
            'heading' => __('Tab Background Color', 'liwa'),
            'param_name' => 'tab_background_color',
            'value' => '#e7ecea',
            'description' => __('Background color of tabs in normal state', 'liwa'),
            'group' => __('Colors', 'liwa'),
        ],
        [
            'type' => 'colorpicker',
            'heading' => __('Tab Hover Background Color', 'liwa'),
            'param_name' => 'tab_hover_background_color',
            'value' => '#4f90d1',
            'description' => __('Background color of tabs on hover/active state', 'liwa'),
            'group' => __('Colors', 'liwa'),
        ],
        [
            'type' => 'colorpicker',
            'heading' => __('Content Text Color', 'liwa'),
            'param_name' => 'tab_describe_color',
            'value' => '#74777b',
            'description' => __('Color of content text inside tabs', 'liwa'),
            'group' => __('Colors', 'liwa'),
        ],
        [
            'type' => 'colorpicker',
            'heading' => __('Content Background Color', 'liwa'),
            'param_name' => 'enable_bg_color',
            'value' => '',
            'description' => __('Background color for tab content area', 'liwa'),
            'group' => __('Colors', 'liwa'),
        ],

        // Border Settings Group
        [
            'type' => 'dropdown',
            'heading' => __('Tab Bottom Border', 'liwa'),
            'param_name' => 'tab_bottom_border',
            'value' => [
                __('Enable', 'liwa') => 'Enable',
                __('Disable', 'liwa') => 'Disable',
            ],
            'std' => 'Disable',
            'description' => __('Show border below tab navigation', 'liwa'),
            'group' => __('Border', 'liwa'),
        ],
        [
            'type' => 'colorpicker',
            'heading' => __('Border Color', 'liwa'),
            'param_name' => 'border_color',
            'value' => '#1e73be',
            'description' => __('Color of tab borders', 'liwa'),
            'group' => __('Border', 'liwa'),
            'dependency' => [
                'element' => 'tab_bottom_border',
                'value' => 'Enable'
            ],
        ],
        [
            'type' => 'textfield',
            'heading' => __('Border Thickness', 'liwa'),
            'param_name' => 'border_thickness',
            'value' => '2',
            'description' => __('Thickness of tab borders in pixels', 'liwa'),
            'group' => __('Border', 'liwa'),
            'dependency' => [
                'element' => 'tab_bottom_border',
                'value' => 'Enable'
            ],
        ],

        // Icon Settings Group
        [
            'type' => 'dropdown',
            'heading' => __('Display Icons', 'liwa'),
            'param_name' => 'disp_icon',
            'value' => [
                __('Enable', 'liwa') => 'Enable',
                __('Disable', 'liwa') => 'Disables',
            ],
            'std' => 'Enable',
            'description' => __('Show icons in tab titles (configure in individual tab settings)', 'liwa'),
            'group' => __('Icons', 'liwa'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Icon Position', 'liwa'),
            'param_name' => 'font_icons_position',
            'value' => [
                __('Left', 'liwa') => 'Left',
                __('Right', 'liwa') => 'Right',
                __('Top', 'liwa') => 'Top',
            ],
            'std' => 'Right',
            'description' => __('Position of icons relative to tab titles', 'liwa'),
            'group' => __('Icons', 'liwa'),
            'dependency' => [
                'element' => 'disp_icon',
                'value' => 'Enable'
            ],
        ],
        [
            'type' => 'colorpicker',
            'heading' => __('Icon Color', 'liwa'),
            'param_name' => 'icon_color',
            'value' => '#74777b',
            'description' => __('Color of icons in normal state', 'liwa'),
            'group' => __('Icons', 'liwa'),
            'dependency' => [
                'element' => 'disp_icon',
                'value' => 'Enable'
            ],
        ],
        [
            'type' => 'colorpicker',
            'heading' => __('Icon Hover Color', 'liwa'),
            'param_name' => 'icon_hover_color',
            'value' => '#ffffff',
            'description' => __('Color of icons on hover/active state', 'liwa'),
            'group' => __('Icons', 'liwa'),
            'dependency' => [
                'element' => 'disp_icon',
                'value' => 'Enable'
            ],
        ],
        [
            'type' => 'textfield',
            'heading' => __('Icon Size', 'liwa'),
            'param_name' => 'icon_size',
            'value' => '15',
            'description' => __('Size of icons in pixels', 'liwa'),
            'group' => __('Icons', 'liwa'),
            'dependency' => [
                'element' => 'disp_icon',
                'value' => 'Enable'
            ],
        ],

        // Typography Group
        [
            'type' => 'textfield',
            'heading' => __('Title Font Size', 'liwa'),
            'param_name' => 'title_font_size',
            'value' => '15',
            'description' => __('Font size for tab titles in pixels', 'liwa'),
            'group' => __('Typography', 'liwa'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Content Font Size', 'liwa'),
            'param_name' => 'desc_font_size',
            'value' => '',
            'description' => __('Font size for tab content in pixels', 'liwa'),
            'group' => __('Typography', 'liwa'),
        ],

        // Responsive Group
        [
            'type' => 'dropdown',
            'heading' => __('Responsive Mode', 'liwa'),
            'param_name' => 'resp_type',
            'value' => [
                __('Tabs', 'liwa') => 'Tabs',
                __('Accordion', 'liwa') => 'Accordion',
            ],
            'std' => 'Tabs',
            'description' => __('How tabs should behave on smaller screens', 'liwa'),
            'group' => __('Responsive', 'liwa'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Responsive Breakpoint', 'liwa'),
            'param_name' => 'resp_width',
            'value' => '400',
            'description' => __('Screen width (px) below which responsive mode activates', 'liwa'),
            'group' => __('Responsive', 'liwa'),
        ],

        // Advanced Group
        [
            'type' => 'dropdown',
            'heading' => __('Auto Rotate', 'liwa'),
            'param_name' => 'auto_rotate',
            'value' => [
                __('Disable', 'liwa') => 'Disables',
                __('Enable', 'liwa') => 'Enable',
            ],
            'std' => 'Disables',
            'description' => __('Automatically rotate through tabs', 'liwa'),
            'group' => __('Advanced', 'liwa'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Auto Rotate Interval', 'liwa'),
            'param_name' => 'interval',
            'value' => '5000',
            'description' => __('Time between auto-rotations in milliseconds (5000 = 5 seconds)', 'liwa'),
            'group' => __('Advanced', 'liwa'),
            'dependency' => [
                'element' => 'auto_rotate',
                'value' => 'Enable'
            ],
        ],
        [
            'type' => 'textfield',
            'heading' => __('Container Max Width', 'liwa'),
            'param_name' => 'container_width',
            'value' => '',
            'description' => __('Maximum width of tab container in pixels', 'liwa'),
            'group' => __('Advanced', 'liwa'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Smooth Scroll', 'liwa'),
            'param_name' => 'smooth_scroll',
            'value' => [
                __('On', 'liwa') => 'on',
                __('Off', 'liwa') => 'off',
            ],
            'std' => 'on',
            'description' => __('Enable smooth scrolling when clicking tabs', 'liwa'),
            'group' => __('Advanced', 'liwa'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Extra Class Name', 'liwa'),
            'param_name' => 'el_class',
            'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS', 'liwa'),
            'group' => __('Advanced', 'liwa'),
        ],
    ],
    'default_content' => '[liwa_advanced_tab_item title="Tab 1"][/liwa_advanced_tab_item][liwa_advanced_tab_item title="Tab 2"][/liwa_advanced_tab_item][liwa_advanced_tab_item title="Tab 3"][/liwa_advanced_tab_item]',
    'custom_markup' => '<div class="wpb_tabs_holder wpb_holder clearfix vc_container_for_children">
        <ul class="tabs_controls">
        </ul>
        %content%
    </div>',
    'js_view' => 'VcBackendTtaTabsView',
];
