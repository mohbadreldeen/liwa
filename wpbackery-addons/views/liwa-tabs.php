<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Shortcode function for liwa_tabs
 */
function liwa_tabs_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        'tab_style' => 'default',
        'active_tab' => '1',
        'tab_alignment' => 'flex-start',
        'el_class' => '',
    ], $atts);

    // Generate unique ID
    $unique_id = 'liwa-tabs-' . uniqid();
    
    // Parse tab content - now that liwa_tab is a container
    $tabs = [];
    if ($content) {
        // First, process the content to execute all shortcodes
        $processed_content = do_shortcode($content);
        
        
        
        // Parse the processed tab items - improved regex to handle any order of attributes
        preg_match_all('/<div class="liwa-tab-item"([^>]*)>(.*?)<\/div>/s', $processed_content, $matches);
        
        if (!empty($matches[0])) {
            foreach ($matches[1] as $index => $attributes_string) {
                // Parse individual attributes
                preg_match('/data-title="([^"]*)"/', $attributes_string, $title_match);
                preg_match('/data-icon="([^"]*)"/', $attributes_string, $icon_match);
                preg_match('/data-display-type="([^"]*)"/', $attributes_string, $display_type_match);
                preg_match('/data-tab-image="([^"]*)"/', $attributes_string, $tab_image_match);
                preg_match('/data-icon-size="([^"]*)"/', $attributes_string, $icon_size_match);
                preg_match('/data-show-title="([^"]*)"/', $attributes_string, $show_title_match);
                
                $tabs[] = [
                    'title' => !empty($title_match[1]) ? $title_match[1] : 'Tab ' . ($index + 1),
                    'icon' => !empty($icon_match[1]) ? $icon_match[1] : '',
                    'display_type' => !empty($display_type_match[1]) ? $display_type_match[1] : 'none',
                    'tab_image' => !empty($tab_image_match[1]) ? $tab_image_match[1] : '',
                    'icon_size' => !empty($icon_size_match[1]) ? $icon_size_match[1] : '24',
                    'show_title' => !empty($show_title_match[1]) ? $show_title_match[1] : 'yes',
                    'content' => $matches[2][$index],
                ];
            }
        }
        
        // Fallback: if no processed tabs found, try the old regex pattern
        if (empty($tabs)) {
            preg_match_all('/\[liwa_tab([^\]]*)\](.*?)\[\/liwa_tab\]/s', $content, $fallback_matches);
            
            if (!empty($fallback_matches[0])) {
                foreach ($fallback_matches[0] as $index => $tab_shortcode) {
                    // Extract tab attributes
                    $tab_atts_string = $fallback_matches[1][$index];
                    $tab_content = $fallback_matches[2][$index];
                    
                    // Parse tab attributes
                    preg_match_all('/(\w+)="([^"]*)"/', $tab_atts_string, $attr_matches);
                    $tab_atts = [];
                    if (!empty($attr_matches[1])) {
                        foreach ($attr_matches[1] as $attr_index => $attr_name) {
                            $tab_atts[$attr_name] = $attr_matches[2][$attr_index];
                        }
                    }
                    
                    $tabs[] = [
                        'title' => isset($tab_atts['title']) ? $tab_atts['title'] : 'Tab ' . ($index + 1),
                        'icon' => isset($tab_atts['icon']) ? $tab_atts['icon'] : '',
                        'display_type' => isset($tab_atts['display_type']) ? $tab_atts['display_type'] : 'none',
                        'tab_image' => isset($tab_atts['tab_image']) ? $tab_atts['tab_image'] : '',
                        'icon_size' => isset($tab_atts['icon_size']) ? $tab_atts['icon_size'] : '24',
                        'show_title' => isset($tab_atts['show_title']) ? $tab_atts['show_title'] : 'yes',
                        'content' => do_shortcode(trim($tab_content)),
                    ];
                }
            }
        }
    }
    
    if (empty($tabs)) {
        return '<div class="liwa-tabs-error">No tabs found</div>';
    }
    
    // Build CSS classes
    $css_classes = ['liwa-tabs', 'liwa-tabs-' . $atts['tab_style']];
    if (!empty($atts['el_class'])) {
        $css_classes[] = sanitize_html_class($atts['el_class']);
    }
    
    $active_index = max(1, min(intval($atts['active_tab']), count($tabs))) - 1;
    
    ob_start();
    ?>
    <div class="liwa-tabs-container liwa-tabs-style-1 <?php echo esc_attr(implode(' ', $css_classes)); ?>" id="<?php echo esc_attr($unique_id); ?>">

        <div class="liwa-tabs-nav" style="justify-content: <?php echo esc_attr($atts['tab_alignment']); ?>;">
            <?php foreach ($tabs as $index => $tab): ?>
                <div class="liwa-tab-nav-item<?php echo $index === $active_index ? ' active' : ''; ?>" 
                     data-tab="<?php echo esc_attr($index); ?>">
                    <?php 
                    $display_type = isset($tab['display_type']) ? $tab['display_type'] : 'none';
                    $icon_size = isset($tab['icon_size']) ? intval($tab['icon_size']) : 24;
                    $show_title = isset($tab['show_title']) ? $tab['show_title'] : 'yes';
                    
                    if ($display_type === 'icon' && !empty($tab['icon'])): ?>
                        <i class="<?php echo esc_attr($tab['icon']); ?>" style="font-size: <?php echo esc_attr($icon_size); ?>px;"></i>
                    <?php elseif ($display_type === 'image' && !empty($tab['tab_image'])): 
                        $image_url = wp_get_attachment_url($tab['tab_image']);
					 
                        if ($image_url): ?>
                            <img src="<?php echo esc_url($image_url); ?>" 
                                 alt="<?php echo esc_attr($tab['title']); ?>" 
                                 style="width: <?php echo esc_attr($icon_size); ?>px; height: <?php echo esc_attr($icon_size); ?>px; object-fit: cover;" 
                                 class="liwa-tab-image" />
                        <?php endif;
                    endif; ?>
                    
                    <?php if ($show_title === 'yes'): ?>
                        <span>
                            <?php echo esc_html($tab['title']); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="liwa-tabs-content">
            <?php foreach ($tabs as $index => $tab): ?>
                <div class="liwa-tab-content-item<?php echo $index === $active_index ? ' active' : ''; ?>" 
                     data-tab="<?php echo esc_attr($index); ?>">
                    <?php echo $tab['content']; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <script>

    </script>
    
    <?php
    return ob_get_clean();
}

/**
 * Shortcode function for liwa_tab (individual tab)
 */
function liwa_tab_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        'title' => 'Tab',
        'icon' => '',
        'display_type' => 'none',
        'tab_image' => '',
        'icon_size' => '24',
        'show_title' => 'yes',
    ], $atts);
    
    // Process the content (which can now contain other shortcodes/elements)
    $processed_content = do_shortcode($content);
    
    // Return the content wrapped in a container for the parent to parse
    return sprintf(
        '<div class="liwa-tab-item" data-title="%s" data-icon="%s" data-display-type="%s" data-tab-image="%s" data-icon-size="%s" data-show-title="%s">%s</div>',
        esc_attr($atts['title']),
        esc_attr($atts['icon']),
        esc_attr($atts['display_type']),
        esc_attr($atts['tab_image']),
        esc_attr($atts['icon_size']),
        esc_attr($atts['show_title']),
        $processed_content
    );
}
 