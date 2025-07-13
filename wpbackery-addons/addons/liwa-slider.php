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
    '' => false,
    'categorshow_settings_on_createy' => 'Liwa Addons',
    'js_view' => 'VcColumnView' 
];
