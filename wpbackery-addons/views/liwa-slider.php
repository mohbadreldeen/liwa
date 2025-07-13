<div 
  class="swiper <?php echo esc_attr(implode(' ', $css_classes)); ?>" 
  id="<?php echo esc_attr($unique_id); ?>"<?php echo $style_attr; ?>
>
  <div class="swiper-wrapper">
    <?php
    if (!empty($child_content)) {
      // Add a specific class to every direct child .swiper-slide
      // Use DOMDocument to manipulate HTML safely
      $dom = new DOMDocument();
      // Suppress errors due to HTML5 tags
      libxml_use_internal_errors(true);
      $dom->loadHTML('<?xml encoding="utf-8" ?>' . $child_content);
      libxml_clear_errors();

      $slides = [];
      foreach ($dom->getElementsByTagName('div') as $div) {
        if ($div->hasAttribute('class') && strpos($div->getAttribute('class'), 'wpb_content_element') !== false) {
          $slides[] = $div;
        }
      }

       foreach ($slides as $slide) {
       
        if ($slide->hasAttribute('class') && !strpos($slide->getAttribute('class'), 'swiper-slide')) {
          $slide->setAttribute('class', $slide->getAttribute('class') . ' swiper-slide');
        }
      }

      // Extract only the inner HTML of the wrapper
      $body = $dom->getElementsByTagName('body')->item(0);
      $innerHTML = '';
      foreach ($body->childNodes as $child) {
        $innerHTML .= $dom->saveHTML($child);
      }
      echo $innerHTML;
    }
    ?>
    <?php // echo $child_content; ?>
  </div>
  
  <center>
    <div class="swiper-navigation-box">
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div> 
    </div>
  </center>
  


</div>

<?php if (!empty($inline_styles)): ?>
<style>
    #<?php echo esc_attr($unique_id); ?> {
        position: relative;
        box-sizing: border-box;
    }
    
    /* Add some basic responsive behavior */
    @media (max-width: 768px) {
        #<?php echo esc_attr($unique_id); ?> {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
    }
</style>
<?php endif; ?>