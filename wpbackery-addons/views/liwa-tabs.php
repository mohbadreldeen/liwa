<?php
/**
 * Liwa Tabs View - Simple Version
 * 
 * This view renders simple tabs simil        <div class="liwa-tabs-nav">
            <?php foreach ($tabs as $index => $tab): ?>
                <a href="#" class="liwa-tab-nav-item<?php echo $index === $active_index ? ' active' : ''; ?>" 
                     data-tab="<?php echo esc_attr($index); ?>">
                    <?php 
                    $display_type = isset($tab['display_type']) ? $tab['display_type'] : 'none';
                    $icon_size = isset($tab['icon_size']) ? intval($tab['icon_size']) : 24;
                    
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
                    <span><?php echo esc_html($tab['title']); ?></span>
                </a>
            <?php endforeach; ?>
        </div>e WPBakery tabs
 */

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
        
        // Parse the processed tab items
        preg_match_all('/<div class="liwa-tab-item"[^>]*data-title="([^"]*)"[^>]*data-icon="([^"]*)"[^>]*data-display-type="([^"]*)"[^>]*data-tab-image="([^"]*)"[^>]*data-icon-size="([^"]*)"[^>]*data-show-title="([^"]*)"[^>]*>(.*?)<\/div>/s', $processed_content, $matches);
        
        if (!empty($matches[0])) {
            foreach ($matches[1] as $index => $title) {
                $tabs[] = [
                    'title' => !empty($title) ? $title : 'Tab ' . ($index + 1),
                    'icon' => $matches[2][$index],
                    'display_type' => $matches[3][$index],
                    'tab_image' => $matches[4][$index],
                    'icon_size' => $matches[5][$index],
                    'show_title' => $matches[6][$index],
                    'content' => $matches[7][$index],
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
                    endif; 
                    
                    if ($show_title === 'yes'): ?>
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
 