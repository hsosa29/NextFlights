<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<?php /** slider section **/ ?>
  <?php
    // Get pages set in the customizer (if any)
    $pages = array();
    for ( $count = 1; $count <= 5; $count++ ) {
    $mod = absint( get_theme_mod( 'vw_tour_lite_slidersettings-page-' . $count ));
    if ( 'page-none-selected' != $mod ) {
      $pages[] = $mod;
    }
    }
    if( !empty($pages) ) :
      $args = array(
        'posts_per_page' => 5,
        'post_type' => 'page',
        'post__in' => $pages,
        'orderby' => 'post__in'
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) :
        $count = 1;
        ?>
      <div class="slider-main">
          <div id="slider" class="nivoSlider">
            <?php
              $vw_tour_lite_n = 0;
          while ( $query->have_posts() ) : $query->the_post();
            
            $vw_tour_lite_n++;
            $vw_tour_lite_slideno[] = $vw_tour_lite_n;
            $vw_tour_lite_slidetitle[] = get_the_title();
            $vw_tour_lite_slidelink[] = esc_url(get_permalink());
            ?>
              <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $vw_tour_lite_n ); ?>" />
            <?php
          $count++;
          endwhile;
            ?>
          </div>

        <?php
        $vw_tour_lite_k = 0;
          foreach( $vw_tour_lite_slideno as $vw_tour_lite_sln ){ ?>
          <div id="slidecaption<?php echo esc_attr( $vw_tour_lite_sln ); ?>" class="nivo-html-caption">
            <div class="slide-cap  ">
              <div class="container">
                <h2><?php echo esc_html($vw_tour_lite_slidetitle[$vw_tour_lite_k] ); ?></h2>
                <a class="read-more" href="<?php echo esc_url($vw_tour_lite_slidelink[$vw_tour_lite_k] ); ?>"><?php esc_html_e( 'Learn More','vw-tour-lite' ); ?></a>
              </div>
            </div>
          </div>
            <?php $vw_tour_lite_k++;
          wp_reset_postdata();
        } ?>
      </div>
        <?php else : ?>
          <div class="header-no-slider"></div>
        <?php
      endif;
    endif;
  ?>

<?php do_action( 'vw_tour_lite_after_slider' ); ?>

<?php /*--OUR SERVICES--*/?>
<section id="our-services">  
    <div class="container">
      <div class="text-center innerlightbox">
        <?php if( get_theme_mod('vw_tour_lite_sec1_title') != ''){ ?>     
          <h3><?php echo esc_html(get_theme_mod('vw_tour_lite_sec1_title',__('Why Choose Us','vw-tour-lite'))); ?></h3>
          <div class="images_border">
              <img src="<?php echo esc_url( get_theme_mod('',get_template_directory_uri().'/images/img-border.png') ); ?>" alt="">
          </div>
      <?php }?>
    <?php $pages = array();
    for ( $count = 0; $count <= 2; $count++ ) {
      $mod = intval( get_theme_mod( 'vw_tour_lite_servicesettings-page-' . $count ));
      if ( 'page-none-selected' != $mod ) {
        $pages[] = $mod;
      }
    }
    if( !empty($pages) ) :
      $args = array(
        'post_type' => 'page',
        'post__in' => $pages,
        'orderby' => 'post__in'
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) :
        $count = 0;
        while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="col-md-4 col-sm-4">
            <div class="service-main-box">
                <div class="row box-image text-center">
                    <img src="<?php the_post_thumbnail_url('full'); ?>"/>
                </div>
                <div class="box-content text-center">
                    <h4><?php the_title(); ?></h4>
                    <p><?php the_excerpt(); ?></p>                  
                    <div class="clearfix"></div>                    
                </div>
            </div>
          </div>
        <?php $count++; endwhile; 
        wp_reset_postdata();?>
      <?php else : ?>
          <div class="no-postfound"></div>
      <?php endif;
    endif;?>
      <div class="clearfix"></div>
  </div> 
</section>

<?php do_action( 'vw_tour_lite_after_service' ); ?>

<?php get_footer(); ?>