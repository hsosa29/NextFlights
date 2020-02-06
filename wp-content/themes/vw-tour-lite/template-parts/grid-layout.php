<?php
/**
 * The template part for displaying slider
 *
 * @package VW Tours Lite 
 * @subpackage vw_tours_lite
 * @since 1.0
 */
?>
<div class="col-md-4">
  <div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>    
    <div class="services-box">
        <div class="service-image">
          <?php 
            if(has_post_thumbnail()) { 
              the_post_thumbnail(); 
            }
          ?>
        </div>
        <div class="service-text">
          <header class="entry-header">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>  
          </header>
          <?php the_excerpt(); ?>
          <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html_e('Read More','vw-tour-lite'); ?></a>
         <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>