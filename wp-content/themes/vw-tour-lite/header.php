<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package VW Tour Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','vw-tour-lite'); ?></a></div>
  
  <div id="header">
    <div class="container">
    <div class="top-bar">
      <?php if(esc_html( get_theme_mod( 'vw_tour_lite_cont_phone','' ) ) != '') { ?>
        <i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( get_theme_mod('vw_tour_lite_cont_phone','') ); ?>
      <?php }
      if(esc_html( get_theme_mod( 'vw_tour_lite_cont_email','' ) ) != '') { ?>
          <i class="fa fa-envelope" aria-hidden="true"></i> <?php echo esc_html(get_theme_mod('vw_tour_lite_cont_email','')); ?>
      <?php } ?>
      <div class="socialmedia">
        <?php if(esc_url( get_theme_mod( 'vw_tour_lite_youtube_url','' ) ) != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'vw_tour_lite_youtube_url','' ) ); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        <?php } ?>
        <?php if(esc_url( get_theme_mod( 'vw_tour_lite_facebook_url','' ) ) != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'vw_tour_lite_facebook_url','' ) ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <?php } ?>
        <?php if(esc_url( get_theme_mod( 'vw_tour_lite_twitter_url','' ) ) != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'vw_tour_lite_twitter_url','' ) ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <?php } ?>
        <?php if(esc_url( get_theme_mod( 'vw_tour_lite_rss_url','' ) ) != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'vw_tour_lite_rss_url','' ) ); ?>"><i class="fa fa-rss" aria-hidden="true"></i></a>
        <?php } ?>
      </div>
    </div>
    </div><!-- top-bar -->
    <div class="container">
      <div class="logo col-md-3">
          <?php if( has_custom_logo() ){ vw_tour_lite_the_custom_logo();
           }else{ ?>
          <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_attr(bloginfo( 'name' )); ?></a></h1>
          <?php $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?> 
            <p class="site-description"><?php echo esc_html($description); ?></p>       
          <?php endif; }?>
      </div>
    
      <div class="nav col-md-9">
          <?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
      </div><!-- nav -->
      <div class="clearfix"></div>
    </div>                           
  </div>