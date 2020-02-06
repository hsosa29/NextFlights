<?php
/**
 * VW Tour Lite Theme Customizer
 *
 * @package VW Tour Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_tour_lite_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_tour_lite_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-tour-lite' ),
	    'description' => __( 'Description of what this panel does.', 'vw-tour-lite' ),
	) );

	//Layouts
	$wp_customize->add_section( 'vw_tour_lite_left_right', array(
    	'title'      => __( 'Theme Layout Settings', 'vw-tour-lite' ),
		'priority'   => 30,
		'panel' => 'vw_tour_lite_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_tour_lite_theme_options',array(
	        'default' => '',
	        'sanitize_callback' => 'vw_tour_lite_sanitize_choices'
	    )
    );

	$wp_customize->add_control('vw_tour_lite_theme_options',
	    array(
	        'type' => 'radio',
	        'label' => 'Do you want this section',
	        'section' => 'vw_tour_lite_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','vw-tour-lite'),
	            'Right Sidebar' => __('Right Sidebar','vw-tour-lite'),
	            'One Column' => __('One Column','vw-tour-lite'),
	            'Three Columns' => __('Three Columns','vw-tour-lite'),
	            'Four Columns' => __('Four Columns','vw-tour-lite'),
	            'Grid Layout' => __('Grid Layout','vw-tour-lite')
	        ),
	    )
    );

	//contact info
	$wp_customize->add_section('vw_tour_lite_headercont_section',array(
		'title'	=> __('Topbar Contact','vw-tour-lite'),
		'description'	=> __('Add topbar contact details here','vw-tour-lite'),
		'priority'	=> null,
		'panel' => 'vw_tour_lite_panel_id'
	));
	
	$wp_customize->add_setting('vw_tour_lite_cont_phone',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_tour_lite_cont_phone',array(
		'label'	=> __('Add Contact Number','vw-tour-lite'),
		'section'	=> 'vw_tour_lite_headercont_section',
		'setting'	=> 'vw_tour_lite_cont_phone',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('vw_tour_lite_cont_email',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_tour_lite_cont_email',array(
		'label'	=> __('Add email address here','vw-tour-lite'),
		'section'	=> 'vw_tour_lite_headercont_section',
		'setting'	=> 'vw_tour_lite_cont_email',
		'type'		=> 'text'
	));
	
	//social pannel
	$wp_customize->add_section('vw_tour_lite_social_section',array(
        'title' => __('Social Links','vw-tour-lite'),
        'description'   => '',
        'panel' => 'vw_tour_lite_panel_id',
    ));
	
	$wp_customize->add_setting('vw_tour_lite_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('vw_tour_lite_facebook_url',array(
		'label'	=> __('Facebook URL','vw-tour-lite'),
		'section'	=> 'vw_tour_lite_social_section',
		'type'		=> 'text'
	));
	
	$wp_customize->add_setting('vw_tour_lite_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('vw_tour_lite_twitter_url',array(
		'label'	=> __('Twitter URL','vw-tour-lite'),
		'section'	=> 'vw_tour_lite_social_section',
		'type'		=> 'text'
	));
	
	$wp_customize->add_setting('vw_tour_lite_rss_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('vw_tour_lite_rss_url',array(
		'label'	=> __('RSS URL','vw-tour-lite'),
		'section'	=> 'vw_tour_lite_social_section',
		'type'		=> 'text'
	));
	
	$wp_customize->add_setting('vw_tour_lite_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('vw_tour_lite_youtube_url',array(
		'label'	=> __('Youtube URL','vw-tour-lite'),
		'section'	=> 'vw_tour_lite_social_section',
		'type'		=> 'text'
	));

	//home page slider
	$wp_customize->add_section( 'vw_tour_lite_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-tour-lite' ),
		'priority'   => 30,
		'panel' => 'vw_tour_lite_panel_id'
	) );

	for ( $count = 1; $count <= 3; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_tour_lite_slidersettings-page-' . $count, array(
				'default'           => '',
				'sanitize_callback' => 'absint'
		) );

		$wp_customize->add_control( 'vw_tour_lite_slidersettings-page-' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-tour-lite' ),
			'section'  => 'vw_tour_lite_slidersettings',
			'type'     => 'dropdown-pages'
		) );

	}

	//OUR services
	$wp_customize->add_section('vw_tour_lite_our_services',array(
		'title'	=> __('Why Choose Us Section','vw-tour-lite'),
		'description'=> __('This section will appear below the slider.','vw-tour-lite'),
		'panel' => 'vw_tour_lite_panel_id',
	));
	
	
	$wp_customize->add_setting('vw_tour_lite_sec1_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_tour_lite_sec1_title',array(
		'label'	=> __('Section Title','vw-tour-lite'),
		'section'=> 'vw_tour_lite_our_services',
		'setting'=> 'vw_tour_lite_sec1_title',
		'type'=> 'text'
	));	

	for ( $count = 0; $count <= 2; $count++ ) {

		$wp_customize->add_setting( 'vw_tour_lite_servicesettings-page-' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'absint'
		));
		$wp_customize->add_control( 'vw_tour_lite_servicesettings-page-' . $count, array(
			'label'    => __( 'Select Service Page', 'vw-tour-lite' ),
			'section'  => 'vw_tour_lite_our_services',
			'type'     => 'dropdown-pages'
		));
	}

	
	/*footer*/
	$wp_customize->add_section('vw_tour_lite_footer_section',array(
		'title'	=> __('Footer Text','vw-tour-lite'),
		'description'	=> __('Add some text for footer like copyright etc.','vw-tour-lite'),
		'priority'	=> null,
		'panel' => 'vw_tour_lite_panel_id'
	));
	
	$wp_customize->add_setting('vw_tour_lite_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('vw_tour_lite_footer_copy',array(
		'label'	=> __('Copyright Text','vw-tour-lite'),
		'section'	=> 'vw_tour_lite_footer_section',
		'type'		=> 'text'
	));

}
add_action( 'customize_register', 'vw_tour_lite_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function vw_tour_lite_customize_preview_js() {
	wp_enqueue_script( 'vw_tour_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'vw_tour_lite_customize_preview_js' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class vw_tour_lite_customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'vw_tour_lite_customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new vw_tour_lite_customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'title'    => esc_html__( 'VW Tour Pro Theme', 'vw-tour-lite' ),
					'pro_text' => esc_html__( 'Go Pro', 'vw-tour-lite' ),
					'pro_url'  => 'http://www.vwthemes.net/vw-tours-theme/'
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-tour-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-tour-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
vw_tour_lite_customize::get_instance();