<?php
/**
 *
 * Silverclean Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Customizer functions
 *
 */

class Silverclean_Customizer {
	public static function register( $wp_customize ) {

		// Move default settings "background_color" in the same section as background image settings
		// and rename the section just "Background"
		$wp_customize->get_control( 'background_color' )->section = 'background_image';
		$wp_customize->get_section( 'background_image' )->title = __('Background', 'silverclean-lite');

		// Add new sections
		if ( ! function_exists('wp_site_icon') ) :
		$wp_customize->add_section( 'silverclean_logo_favicon' , array(
			'title'      => __( 'Logo & Favicon', 'silverclean-lite' ),
			'priority'   => 20,
		) );
		else:
		$wp_customize->add_section( 'silverclean_logo_favicon' , array(
			'title'      => __( 'Logo', 'silverclean-lite' ),
			'priority'   => 20,
		) );
		endif;

		$wp_customize->add_section( 'silverclean_blog_settings' , array(
			'title'      => __( 'Blog Settings', 'silverclean-lite' ),
			'priority'   => 80,
		) );

		$wp_customize->add_section( 'silverclean_misc_settings' , array(
			'title'      => __( 'Misc', 'silverclean-lite' ),
			'priority'   => 100,
		) );

		$wp_customize->add_section( 'silverclean_more' , array(
			'title'      => __( 'More', 'silverclean-lite' ),
			'priority'   => 130,
		) );

		// Setting and control for Logo
		$wp_customize->add_setting( 'silverclean_logo' , array(
			'default'     => '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'silverclean_logo',
				array(
					'label'      => __( 'Upload your logo', 'silverclean-lite' ),
					'description' => __('If no logo is uploaded, the site title will be displayed instead.', 'silverclean-lite'),
					'section'    => 'silverclean_logo_favicon',
					'settings'   => 'silverclean_logo',
				)
			)
		);

		// Setting and control for favicon
		if ( ! function_exists('wp_site_icon') ) :
			$wp_customize->add_setting( 'silverclean_favicon' , array(
				'default'     => '',
				'sanitize_callback' => 'esc_url_raw',
			) );
			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'silverclean_favicon',
					array(
						'label'			=> __( 'Upload a custom favicon', 'silverclean-lite' ),
						'description'	=> __('Set your favicon. 16x16 or 32x32 pixels is recommended. PNG (recommended), GIF, or ICO.', 'silverclean-lite'),
						'section'		=> 'silverclean_logo_favicon',
						'settings'		=> 'silverclean_favicon',
					)
				)
			);
		endif;

		// Setting and control for blog index content switch
		$wp_customize->add_setting( 'silverclean_blog_index_content' , array(
			'default'     => 'excerpt',
			'sanitize_callback' => 'silverclean_sanitize_blog_index_content',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'silverclean_blog_index_content',
				array(
					'label'		=> __( 'Blog Index Content', 'silverclean-lite' ),
					'section'	=> 'silverclean_blog_settings',
					'settings'	=> 'silverclean_blog_index_content',
					'type'		=> 'radio',
					'choices'	=> array(
						'excerpt'	=> __( 'Excerpt', 'silverclean-lite' ),
						'content'	=> __( 'Full content', 'silverclean-lite' )
					)
				)
			)
		);

		// Setting and control for responsive mode
		$wp_customize->add_setting( 'silverclean_responsive_mode' , array(
			'default'     => 'on',
			'sanitize_callback' => 'silverclean_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'silverclean_responsive_mode',
				array(
					'label'		=> __( 'Responsive Mode', 'silverclean-lite' ),
					'section'	=> 'silverclean_misc_settings',
					'settings'	=> 'silverclean_responsive_mode',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'silverclean-lite' ),
						'off'	=> __( 'Off', 'silverclean-lite' )
					)
				)
			)
		);

		// Settings and controls for header image display
		$wp_customize->add_setting( 'home_header_image' , array(
			'default'     => 'on',
			'sanitize_callback' => 'silverclean_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'home_header_image',
				array(
					'label'		=> __( 'Display header on Homepage', 'silverclean-lite' ),
					'section'	=> 'header_image',
					'settings'	=> 'home_header_image',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'silverclean-lite' ),
						'off'	=> __( 'Off', 'silverclean-lite' )
					)
				)
			)
		);

		$wp_customize->add_setting( 'blog_header_image' , array(
			'default'     => 'on',
			'sanitize_callback' => 'silverclean_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'blog_header_image',
				array(
					'label'		=> __( 'Display header on Blog Index', 'silverclean-lite' ),
					'section'	=> 'header_image',
					'settings'	=> 'blog_header_image',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'silverclean-lite' ),
						'off'	=> __( 'Off', 'silverclean-lite' )
					)
				)
			)
		);

		$wp_customize->add_setting( 'single_header_image' , array(
			'default'     => 'on',
			'sanitize_callback' => 'silverclean_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'single_header_image',
				array(
					'label'		=> __( 'Display header on Single Posts', 'silverclean-lite' ),
					'section'	=> 'header_image',
					'settings'	=> 'single_header_image',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'silverclean-lite' ),
						'off'	=> __( 'Off', 'silverclean-lite' )
					)
				)
			)
		);

		$wp_customize->add_setting( 'pages_header_image' , array(
			'default'     => 'on',
			'sanitize_callback' => 'silverclean_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'pages_header_image',
				array(
					'label'		=> __( 'Display header on Pages', 'silverclean-lite' ),
					'section'	=> 'header_image',
					'settings'	=> 'pages_header_image',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'silverclean-lite' ),
						'off'	=> __( 'Off', 'silverclean-lite' )
					)
				)
			)
		);

		// Setting and control for Silverclean upgrade message
		$wp_customize->add_setting( 'silverclean_upgrade', array(
			'default'	=> 'https://www.iceablethemes.com/shop/silverclean-pro/',
			'sanitize_callback' => 'silverclean_sanitize_button',
		) );
		$wp_customize->add_control(
			new Silverclean_Button_Customize_Control( $wp_customize, 'silverclean_upgrade',
				array(
					'label'			=> __( 'Get Silverclean Pro', 'silverclean-lite' ),
					'description'	=> __( 'Unleash the full potential of Silverclean with tons of additional settings, advanced features and premium support.', 'silverclean-lite'),
					'section'		=> 'silverclean_more',
					'settings'		=> 'silverclean_upgrade',
					'type'			=> 'button',
				)
			)
		);

		// Setting and control for Silverclean support forums message
		$wp_customize->add_setting( 'silverclean_support', array(
			'default'	=> 'https://www.iceablethemes.com/forums/forum/free-support-forum/silverclean-lite/',
			'sanitize_callback' => 'silverclean_sanitize_button',
		) );
		$wp_customize->add_control(
			new Silverclean_Button_Customize_Control( $wp_customize, 'silverclean_support',
				array(
					'label'			=> __( 'Silverclean Lite support forums', 'silverclean-lite' ),
					'description'	=> __( 'Have a question? Need help?', 'silverclean-lite'),
					'section'		=> 'silverclean_more',
					'settings'		=> 'silverclean_support',
					'type'			=> 'button',
				)
			)
		);

		// Setting and control for Silverclean feedback message
		$wp_customize->add_setting( 'silverclean_feedback', array(
			'default'	=> 'https://wordpress.org/support/view/theme-reviews/silverclean-lite',
			'sanitize_callback' => 'silverclean_sanitize_button',
		) );
		$wp_customize->add_control(
			new Silverclean_Button_Customize_Control( $wp_customize, 'silverclean_feedback',
				array(
					'label'			=> __( 'Rate Silverclean Lite', 'silverclean-lite' ),
					'description'	=> __( 'Like this theme? We\'d love to hear your feedback!', 'silverclean-lite'),
					'section'		=> 'silverclean_more',
					'settings'		=> 'silverclean_feedback',
					'type'			=> 'button',
				)
			)
		);

	}

	public static function customize_controls_scripts(){
		wp_enqueue_style(
			'silverclean-customizer-controls-style',
			get_template_directory_uri() . '/inc/customizer/css/customizer-controls.css',
			array( 'customize-controls' )
		);

		wp_register_script(
			  'silverclean-customizer-section',
			  get_template_directory_uri() . '/inc/customizer/js/silverclean-customizer-section.js',
			  array( 'jquery','jquery-ui-core','jquery-ui-button','customize-controls' ),
			  '',
			  true
		);
		$silverclean_customizer_section_l10n = array(
			'upgrade_pro' => __( 'Upgrade to Silverclean Pro!', 'silverclean-lite' ),
		);
		wp_localize_script( 'silverclean-customizer-section', 'silverclean_customizer_section_l10n', $silverclean_customizer_section_l10n );
		wp_enqueue_script( 'silverclean-customizer-section' );

	}

}
add_action( 'customize_register' , array( 'Silverclean_Customizer' , 'register' ) );
add_action ('customize_controls_enqueue_scripts', array( 'Silverclean_Customizer', 'customize_controls_scripts' ));

// Create custom controls for customizer
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Silverclean_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'button';
		public function render_content() {
			?><label>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<a class="button" href="<?php echo esc_url( $this->value() ); ?>" target="_blank"><?php echo esc_html( $this->label ); ?></a>
			</label><?php
		}
	}
}

// Sanitation callback functions
function silverclean_sanitize_blog_index_content( $input ){
	$choices = array( 'excerpt', 'content' );
	if ( in_array($input, $choices) ):
		return $input;
	else:
		return '';
	endif;
}

function silverclean_sanitize_on_off( $input ){
	$choices = array( 'on', 'off' );
	if ( in_array($input, $choices) ):
		return $input;
	else:
		return '';
	endif;
}

function silverclean_sanitize_button( $input ){
	return '';
}
