<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package VW Tour Lite
 */
?>

        <div class="footersec">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <?php dynamic_sidebar('footer-1');?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?php dynamic_sidebar('footer-2');?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?php dynamic_sidebar('footer-3');?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?php dynamic_sidebar('footer-4');?>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrapper">
        	<div class="container">
                <!--<div class="footer-menu">
                    <?php wp_nav_menu(array('theme_location' => 'footer')); ?>
                </div>--><!-- footer-menu -->
                <div class="clear"></div> 
                <div class="copyright">
                   <p><?php echo esc_html(get_theme_mod('vw_tour_lite_footer_copy',__('Professional WordPress Themes By','vw-tour-lite'))); ?> <?php echo esc_html(vw_tour_lite_credit(),'vw-tour-lite'); ?></p>
                </div><!-- copyright -->
            </div><!-- inner -->
        </div>
<?php wp_footer(); ?>

</body>
</html>