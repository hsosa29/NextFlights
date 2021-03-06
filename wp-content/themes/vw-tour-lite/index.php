<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package VW Tour Lite
 */

get_header();?>

<?php do_action( 'vw_tour_lite_index_top' ); ?>

<div class="main-container">
  <section class="services">
    <div class="container">
        <?php
          $left_right = get_theme_mod( 'vw_tour_lite_theme_options','One Column');
          if($left_right == 'Left Sidebar'){ ?>
          <div class="col-md-4"><?php get_sidebar(); ?></div>
          <section id="blog_tour" class="hospi-blog flipInX col-md-8">
              <?php if ( have_posts() ) :
              /* Start the Loop */
                
                  while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content' ); 
                
                  endwhile;
                  wp_reset_postdata();
                  else :

                    get_template_part( 'no-results', 'archive' ); 

                  endif; 
              ?>
              <div class="navigation">
                <?php
                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( 'Previous page', 'vw-tour-lite' ),
                        'next_text'          => __( 'Next page', 'vw-tour-lite' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-tour-lite' ) . ' </span>',
                    ) );
                ?>
                  <div class="clearfix"></div>
              </div>
          </section>
          <div class="clearfix"></div>
        <?php }else if($left_right == 'Right Sidebar'){ ?>
          <section id="blog_tour" class="hospi-blog flipInX col-md-8">
            <?php if ( have_posts() ) :
                /* Start the Loop */
                  
                while ( have_posts() ) : the_post();

                  get_template_part( 'template-parts/content' ); 
                  
                endwhile;
                wp_reset_postdata();
                else :

                    get_template_part( 'no-results', 'archive' ); 

                endif; 
            ?>
              <div class="navigation">
                <?php
                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( 'Previous page', 'vw-tour-lite' ),
                        'next_text'          => __( 'Next page', 'vw-tour-lite' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-tour-lite' ) . ' </span>',
                    ) );
                ?>
                  <div class="clearfix"></div>
              </div>
          </section>
          <div class="col-md-4"><?php get_sidebar(); ?></div>
        <?php }else if($left_right == 'One Column'){ ?>
          <section id="blog_tour" class="hospi-blog flipInX col-md-12">
              <?php if ( have_posts() ) :
                /* Start the Loop */
                  
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content' ); 
                  
                endwhile;
                wp_reset_postdata();
                else :

                    get_template_part( 'no-results', 'archive' ); 

                endif; 
              ?>
              <div class="navigation">
                <?php
                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( 'Previous page', 'vw-tour-lite' ),
                        'next_text'          => __( 'Next page', 'vw-tour-lite' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-tour-lite' ) . ' </span>',
                    ) );
                ?>
                <div class="clearfix"></div>
              </div>
          </section>
      <?php }else if($left_right == 'Three Columns'){ ?>
          <div id="sidebar" class="col-md-3"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
          <section id="blog_tour" class="hospi-blog flipInX col-md-6">
            <?php if ( have_posts() ) :
                /* Start the Loop */
                  
                while ( have_posts() ) : the_post();

                  get_template_part( 'template-parts/content' ); 
                  
                endwhile;
                wp_reset_postdata();
                else :

                    get_template_part( 'no-results', 'archive' ); 

                endif; 
            ?>
              <div class="navigation">
                <?php
                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( 'Previous page', 'vw-tour-lite' ),
                        'next_text'          => __( 'Next page', 'vw-tour-lite' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-tour-lite' ) . ' </span>',
                    ) );
                ?>
                  <div class="clearfix"></div>
              </div>
          </section>
          <div id="sidebar" class="col-md-3"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
        <?php }else if($left_right == 'Four Columns'){ ?>
        <div id="sidebar" class="col-md-3"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
          <section id="blog_tour" class="hospi-blog flipInX col-md-3">
            <?php if ( have_posts() ) :
                /* Start the Loop */
                  
                while ( have_posts() ) : the_post();

                  get_template_part( 'template-parts/content' ); 
                  
                endwhile;
                wp_reset_postdata();
                else :

                    get_template_part( 'no-results', 'archive' ); 

                endif; 
            ?>
              <div class="navigation">
                <?php
                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( 'Previous page', 'vw-tour-lite' ),
                        'next_text'          => __( 'Next page', 'vw-tour-lite' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-tour-lite' ) . ' </span>',
                    ) );
                ?>
                  <div class="clearfix"></div>
              </div>
          </section>
          <div id="sidebar" class="col-md-3"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
          <div id="sidebar" class="col-md-3"><?php dynamic_sidebar( 'sidebar-3' ); ?></div>
        <?php }else if($left_right == 'Grid Layout'){ ?>        
          <section id="blog_tour" class="hospi-blog flipInX col-md-12">
            <?php if ( have_posts() ) :
                /* Start the Loop */
                  
                while ( have_posts() ) : the_post();

                  get_template_part( 'template-parts/grid-layout' ); 
                  
                endwhile;
                wp_reset_postdata();
                else :

                    get_template_part( 'no-results', 'archive' ); 

                endif; 
            ?>
              <div class="navigation">
                <?php
                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( 'Previous page', 'vw-tour-lite' ),
                        'next_text'          => __( 'Next page', 'vw-tour-lite' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-tour-lite' ) . ' </span>',
                    ) );
                ?>
                  <div class="clearfix"></div>
              </div>
          </section>
        <?php } ?>
    </div>
    <div class="clear"></div>
  </section>
</div>

<?php do_action( 'vw_tour_lite_index_bottom' ); ?>

<?php get_footer(); ?>