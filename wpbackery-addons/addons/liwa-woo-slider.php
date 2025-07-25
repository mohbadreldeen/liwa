<?php

if (!defined('ABSPATH'))
    die('-1');

 

return [
    'name' => __('Liwa WooCommerce Slider', 'liwadates'),
    'description' => __('A product slider that displays WooCommerce products from selected categories', 'liwadates'),
    'base' => 'liwa_woo_slider',
    'icon' => 'icon-wpb-ui-separator',
    'content_element' => true,
    'is_container' => false,
    'show_settings_on_create' => false,
    'category' => 'Liwa Addons',
    'params' => [
        [
            'type' => 'dropdown',
            'heading' => __('Category Selection Mode', 'liwadates'),
            'param_name' => 'category_mode',
            'value' => [
                __('All Categories', 'liwadates') => 'all',
                __('Single Category', 'liwadates') => 'single',
                __('Multiple Categories', 'liwadates') => 'multiple',
            ],
            'std' => 'all',
            'description' => __('Choose how to select categories', 'liwadates'),
            'group' => __('Product Settings', 'liwadates'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Product Category', 'liwadates'),
            'param_name' => 'product_categories',
            'value' => liwa_get_product_categories_for_dropdown(),
            'std' => '',
            'description' => __('Select a product category to display', 'liwadates'),
            'dependency' => [
                'element' => 'category_mode',
                'value' => 'single',
            ],
            'group' => __('Product Settings', 'liwadates'),
        ],
        [
            'type' => 'checkbox',
            'heading' => __('Select Categories', 'liwadates'),
            'param_name' => 'selected_categories',
            'value' => liwa_get_product_categories_for_checkbox(),
            'description' => __('Check the categories you want to include in the slider', 'liwadates'),
            'dependency' => [
                'element' => 'category_mode',
                'value' => 'multiple',
            ],
            'group' => __('Product Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Number of Products', 'liwadates'),
            'param_name' => 'products_count',
            'value' => '12',
            'description' => __('Number of products to display (default: 12)', 'liwadates'),
            'group' => __('Product Settings', 'liwadates'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Order By', 'liwadates'),
            'param_name' => 'orderby',
            'value' => [
                __('Date', 'liwadates') => 'date',
                __('Title', 'liwadates') => 'title',
                __('Menu Order', 'liwadates') => 'menu_order',
                __('Random', 'liwadates') => 'rand',
                __('Price', 'liwadates') => 'price',
                __('Popularity', 'liwadates') => 'popularity',
                __('Rating', 'liwadates') => 'rating',
            ],
            'std' => 'date',
            'description' => __('Choose how to order the products', 'liwadates'),
            'group' => __('Product Settings', 'liwadates'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Order', 'liwadates'),
            'param_name' => 'order',
            'value' => [
                __('Descending', 'liwadates') => 'DESC',
                __('Ascending', 'liwadates') => 'ASC',
            ],
            'std' => 'DESC',
            'description' => __('Choose the order direction', 'liwadates'),
            'group' => __('Product Settings', 'liwadates'),
        ],
        [
            'type' => 'checkbox',
            'heading' => __('Show Only Featured Products', 'liwadates'),
            'param_name' => 'featured_only',
            'value' => ['yes' => __('Yes', 'liwadates')],
            'description' => __('Show only featured products', 'liwadates'),
            'group' => __('Product Settings', 'liwadates'),
        ],
        [
            'type' => 'checkbox',
            'heading' => __('Show Only Sale Products', 'liwadates'),
            'param_name' => 'sale_only',
            'value' => ['yes' => __('Yes', 'liwadates')],
            'description' => __('Show only products on sale', 'liwadates'),
            'group' => __('Product Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Items Per Slide (Desktop)', 'liwadates'),
            'param_name' => 'items_per_slide_desktop',
            'value' => '4',
            'description' => __('Number of items to show per slide on desktop (default: 4)', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Items Per Slide (Tablet)', 'liwadates'),
            'param_name' => 'items_per_slide_tablet',
            'value' => '3',
            'description' => __('Number of items to show per slide on tablet (default: 3)', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Items Per Slide (Mobile)', 'liwadates'),
            'param_name' => 'items_per_slide_mobile',
            'value' => '2',
            'description' => __('Number of items to show per slide on mobile (default: 2)', 'liwadates'),
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
            'heading' => __('Show Navigation', 'liwadates'),
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
            'heading' => __('Enable Autoplay', 'liwadates'),
            'param_name' => 'autoplay',
            'value' => ['yes' => __('Yes', 'liwadates')],
            'description' => __('Enable automatic slide transitions', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Autoplay Delay', 'liwadates'),
            'param_name' => 'autoplay_delay',
            'value' => '3000',
            'description' => __('Delay between slide transitions in milliseconds (default: 3000)', 'liwadates'),
            'dependency' => [
                'element' => 'autoplay',
                'not_empty' => true,
            ],
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'checkbox',
            'heading' => __('Enable Loop', 'liwadates'),
            'param_name' => 'loop',
            'value' => ['yes' => __('Yes', 'liwadates')],
            'description' => __('Enable infinite loop mode', 'liwadates'),
            'group' => __('Slider Settings', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Transition Speed', 'liwadates'),
            'param_name' => 'speed',
            'value' => '300',
            'description' => __('Transition speed in milliseconds (default: 300)', 'liwadates'),
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
            'description' => __('Choose slider theme', 'liwadates'),
            'group' => __('Appearance', 'liwadates'),
        ],
        [
            'type' => 'dropdown',
            'heading' => __('Product Item Style', 'liwadates'),
            'param_name' => 'product_style',
            'value' => [
                __('Style 1', 'liwadates') => 'style-1',
                __('Style 2', 'liwadates') => 'style-2',
            ],
            'std' => 'style-1',
            'description' => __('Choose the visual style for product items', 'liwadates'),
            'group' => __('Appearance', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Description Word Limit', 'liwadates'),
            'param_name' => 'description_word_limit',
            'value' => '7',
            'description' => __('Maximum number of words to show in product description (default: 7)', 'liwadates'),
            'group' => __('Appearance', 'liwadates'),
        ],
        [
            'type' => 'textfield',
            'heading' => __('Custom CSS Class', 'liwadates'),
            'param_name' => 'el_class',
            'value' => '',
            'description' => __('Add custom CSS class for styling', 'liwadates'),
            'group' => __('Appearance', 'liwadates'),
        ],
    ],
];
