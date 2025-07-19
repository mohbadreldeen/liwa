<?php
/**
 * Tilt Image View
 * 
 * Displays an image with interactive tilt effects on mouse hover.
 * 
 * @since 1.0.0
 */

// Extract settings from atts
$image = !empty($atts['image']) ? $atts['image'] : '';
$image_size = !empty($atts['image_size']) ? $atts['image_size'] : 'large';
$alt_text = !empty($atts['alt_text']) ? $atts['alt_text'] : '';
$image_link = !empty($atts['image_link']) ? $atts['image_link'] : '';
$tilt_intensity = !empty($atts['tilt_intensity']) ? $atts['tilt_intensity'] : 'normal';
$tilt_scale = !empty($atts['tilt_scale']) ? floatval($atts['tilt_scale']) : 1.05;
$max_tilt = !empty($atts['max_tilt']) ? intval($atts['max_tilt']) : 15;
$enable_glow = !empty($atts['enable_glow']);
$enable_shadow = !empty($atts['enable_shadow']);
$border_radius = !empty($atts['border_radius']) ? $atts['border_radius'] : 'small';
$theme = !empty($atts['theme']) ? $atts['theme'] : 'default';
$width = !empty($atts['width']) ? $atts['width'] : '';
$height = !empty($atts['height']) ? $atts['height'] : '';
$alignment = !empty($atts['alignment']) ? $atts['alignment'] : 'center';
$animate_on_scroll = !empty($atts['animate_on_scroll']);
$el_class = !empty($atts['el_class']) ? $atts['el_class'] : '';

// Return early if no image
if (empty($image)) {
    echo '<div class="liwa-tilt-image-error">Please select an image to display.</div>';
    return;
}

// Build CSS classes
$css_classes = array('liwa-tilt-image');

// Add intensity class
if ($tilt_intensity === 'subtle') {
    $css_classes[] = 'tilt-subtle';
} elseif ($tilt_intensity === 'strong') {
    $css_classes[] = 'tilt-strong';
}

// Add effect classes
if ($enable_glow) {
    $css_classes[] = 'tilt-glow';
}
if ($enable_shadow) {
    $css_classes[] = 'tilt-shadow';
}

// Add border radius class
if ($border_radius === 'rounded') {
    $css_classes[] = 'tilt-rounded';
} elseif ($border_radius === 'circle') {
    $css_classes[] = 'tilt-circle';
}

// Add theme class
if ($theme !== 'default') {
    $css_classes[] = 'tilt-theme-' . $theme;
}

// Add alignment class
$css_classes[] = 'tilt-align-' . $alignment;

// Add animation class
if ($animate_on_scroll) {
    $css_classes[] = 'tilt-animate-in';
}

// Add custom class
if (!empty($el_class)) {
    $css_classes[] = sanitize_html_class($el_class);
}

// Generate unique ID
$unique_id = 'liwa-tilt-image-' . uniqid();

// Build inline styles
$inline_styles = array();
if (!empty($width)) {
    $inline_styles[] = 'width: ' . esc_attr($width);
}
if (!empty($height)) {
    $inline_styles[] = 'height: ' . esc_attr($height);
}

// Add text alignment for image alignment
if ($alignment === 'center') {
    $inline_styles[] = 'text-align: center';
} elseif ($alignment === 'right') {
    $inline_styles[] = 'text-align: right';
} else {
    $inline_styles[] = 'text-align: left';
}

$style_attr = !empty($inline_styles) ? ' style="' . implode('; ', $inline_styles) . '"' : '';

// Get image source
$image_src = wp_get_attachment_image_src($image, $image_size);
if (!$image_src) {
    echo '<div class="liwa-tilt-image-error">Image not found.</div>';
    return;
}

// Get alt text
if (empty($alt_text)) {
    $alt_text = get_post_meta($image, '_wp_attachment_image_alt', true);
    if (empty($alt_text)) {
        $alt_text = get_the_title($image);
    }
}

// Parse link
$link_url = '';
$link_target = '';
$link_title = '';
if (!empty($image_link)) {
    $link = vc_build_link($image_link);
    $link_url = $link['url'];
    $link_target = $link['target'] ? $link['target'] : '_self';
    $link_title = $link['title'];
}

// Ensure max tilt is within reasonable bounds
$max_tilt = max(1, min(30, $max_tilt));

// Ensure scale is within reasonable bounds
$tilt_scale = max(1.0, min(2.0, $tilt_scale));
?>

<div class="<?php echo esc_attr(implode(' ', $css_classes)); ?>" 
     id="<?php echo esc_attr($unique_id); ?>"<?php echo $style_attr; ?>>
    
    <?php if (!empty($link_url)): ?>
        <a href="<?php echo esc_url($link_url); ?>" 
           target="<?php echo esc_attr($link_target); ?>"
           <?php if (!empty($link_title)): ?>title="<?php echo esc_attr($link_title); ?>"<?php endif; ?>
           class="tilt-image-wrapper">
    <?php else: ?>
        <div class="tilt-image-wrapper">
    <?php endif; ?>
    
        <img src="<?php echo esc_url($image_src[0]); ?>" 
             alt="<?php echo esc_attr($alt_text); ?>"
             width="<?php echo esc_attr($image_src[1]); ?>"
             height="<?php echo esc_attr($image_src[2]); ?>">
        
        <div class="tilt-overlay"></div>
    
    <?php if (!empty($link_url)): ?>
        </a>
    <?php else: ?>
        </div>
    <?php endif; ?>
</div>

<script>
(function() {
    const tiltElement = document.getElementById('<?php echo esc_js($unique_id); ?>');
    const wrapper = tiltElement.querySelector('.tilt-image-wrapper');
    const overlay = tiltElement.querySelector('.tilt-overlay');
    let maxTilt = <?php echo esc_js($max_tilt); ?>;
    let scale = <?php echo esc_js($tilt_scale); ?>;
    
    if (!wrapper) return;
    
    // Adjust intensity based on CSS class
    if (tiltElement.classList.contains('tilt-subtle')) {
        maxTilt = Math.min(maxTilt, 8);
        scale = Math.min(scale, 1.02);
    } else if (tiltElement.classList.contains('tilt-strong')) {
        maxTilt = Math.max(maxTilt, 20);
        scale = Math.max(scale, 1.08);
    }
    
    let isHovering = false;
    let animationFrame = null;
    
    function handleMouseMove(e) {
        if (!isHovering) return;
        
        // Cancel any pending animation frame
        if (animationFrame) {
            cancelAnimationFrame(animationFrame);
        }
        
        // Use requestAnimationFrame for smooth 60fps animation
        animationFrame = requestAnimationFrame(() => {
            const rect = wrapper.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            // Calculate rotation with smooth easing
            const rotateX = ((y - centerY) / centerY) * -maxTilt;
            const rotateY = ((x - centerX) / centerX) * maxTilt;
            
            // Apply transform directly for immediate response
            wrapper.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(${scale})`;
        });
    }
    
    function handleMouseEnter() {
        isHovering = true;
        // Disable CSS transition during mouse movement
        wrapper.style.transition = 'none';
        wrapper.classList.add('tilt-hovering');
        
        // Show overlay
        if (overlay) {
            overlay.style.opacity = '1';
        }
    }
    
    function handleMouseLeave() {
        isHovering = false;
        
        // Cancel any pending animation frame
        if (animationFrame) {
            cancelAnimationFrame(animationFrame);
            animationFrame = null;
        }
        
        // Re-enable transition for smooth return to original state
        wrapper.style.transition = 'all 0.4s cubic-bezier(0.23, 1, 0.32, 1)';
        
        // Reset transform
        wrapper.style.transform = '';
        wrapper.classList.remove('tilt-hovering');
        
        // Hide overlay
        if (overlay) {
            overlay.style.opacity = '0';
        }
    }
    
    // Check if device supports hover (desktop)
    if (window.matchMedia('(hover: hover)').matches) {
        wrapper.addEventListener('mouseenter', handleMouseEnter);
        wrapper.addEventListener('mousemove', handleMouseMove);
        wrapper.addEventListener('mouseleave', handleMouseLeave);
        
        // Also handle mouse leave on the parent element for better UX
        tiltElement.addEventListener('mouseleave', handleMouseLeave);
    }
    
    // Intersection Observer for scroll animation
    <?php if ($animate_on_scroll): ?>
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('tilt-animate-in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        observer.observe(tiltElement);
    }
    <?php endif; ?>
})();
</script>
