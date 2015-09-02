<?php

return array(

	'type'              => $type,
	'post_type'         => $post_type,

	'body_classes'      => array(
		'wpdevsclub-' . $type,
		'sliding-sidebar',
		'learndash',
	),

	/*******************
	 * Sidebar
	 ******************/

	'sidebar'           => array(
		'name'          => 'courses',
		'view'          => WPDC_LEARNDASH_PLUGIN_DIR . 'lib/templates/sidebar.php',
	),

	/*******************
	 * Model
	 ******************/

	'model'                             => array(
		'program_code_meta_key'         => '_wpdevsclub_program_code',
		'meta_keys'                     => array(
			'_wpdevsclub_program_code'  => true,
		),
	),


	/*******************
	 * Post Header
	 ******************/

	'post_header'       => array(
		'view'          => WPDC_LEARNDASH_PLUGIN_DIR . 'lib/views/page-header-' . $type . '.php',
		'header_ths'    => $header_ths,
	),


	/******************
	 * Post
	 *****************/
	'post'                  => array(
		'views'             => array(),
		'layout'            => '__genesis_return_full_width_content',
		'body_classes'      => array( 'wpdevsclub-' . $type ),
	),

	/*******************
	 * Sticky Footer
	 ******************/

	'sticky_footer'                                 => array(
		'setup'                                     => array(
			'menu_theme_support'                    => array(
				'sticky_footer_course_quick_links'  => __( 'Sticky Footer - Course Quick Links', 'wpdc' ),
				'sticky_footer_course_extras'       => __( 'Sticky Footer - Course Extras', 'wpdc' ),
			),
		),
		'render'                                    => array(
			'theme_locations'                       => array(
				'quick_links'                       => 'sticky_footer_course_quick_links',
				'extras'                            => 'sticky_footer_course_extras',
			),
			'views'                                 => array(
				'sticky_footer'                     => WPDC_STICKY_FOOTER_DIR . 'lib/views/sticky-footer.php',
				'panels'                            => array(
					WPDC_STICKY_FOOTER_DIR . 'lib/views/panels/join-dashboard.php',
					WPDC_LEARNDASH_PLUGIN_DIR . 'lib/views/sticky-footer/panels/sidebar.php',
					WPDC_STICKY_FOOTER_DIR . 'lib/views/panels/quick-links.php',
					WPDC_STICKY_FOOTER_DIR . 'lib/views/panels/extras.php',
					WPDC_STICKY_FOOTER_DIR . 'lib/views/panels/to-top.php',
				),
			),
		),
	),
);