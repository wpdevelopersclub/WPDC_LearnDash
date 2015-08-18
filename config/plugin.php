<?php

$remove_post_type_support = array( 'comments', 'trackbacks' );

return array(
	'config_path' => trailingslashit( __DIR__ ),

	'remove_post_type_support'      => array(
		'sfwd-courses'              => $remove_post_type_support,
		'sfwd-lessons'              => $remove_post_type_support,
		'sfwd-topics'               => $remove_post_type_support,
		'sfwd-quiz'                 => $remove_post_type_support,
	),

	'sidebars'                      => array(
		'courses'                   => array(
			'name'                  => __( 'Courses', 'wpdevsclub' ),
			'description'           => __( 'This area is for the course pages.', 'wpdevsclub' ),
		),
	),

	'template_manager'              => array(
		'template_folder_path'      => WPDC_LEARNDASH_PLUGIN_DIR . 'lib/templates/',
		'post_type'                 => array( 'sfwd-courses', 'sfwd-lessons', 'sfwd-quiz' ),
		'use_template_slug'         => true,
		'use_single'                => true,
	),

	'genesis-menus'                         => array(
		'course'                            => __( 'Course', 'wpdevsclub' ),
		'sticky_footer_course_quick_links'  => __( 'Sticky Footer - Course Quick Links', 'wpdevsclub' ),
		'sticky_footer_course_extras'       => __( 'Sticky Footer - Course Extras', 'wpdevsclub' ),
	),

	'metaboxes'                     => array(

		'program'                   => array(
			'classname'             => 'WPDevsClub_Core\Admin\Metabox\Metabox',
			'view'                  => WPDC_LEARNDASH_PLUGIN_DIR . 'lib/views/admin/metabox-program.php',

			'program_code_meta_key' => '_wpdevsclub_program_code',

			/****************************
			 * Meta config parameters
			 ****************************/
			'meta_name'             => 'wpdevsclub_program_code',
			'meta_single'           => array(
				'_wpdevsclub_program_code' => array(
					'default'               => '',
					'sanitize'              => 'strip_tags',
				),
			),
			'meta_array'            => array(),

			/****************************
			 * Metabox config parameters
			 ****************************/

			'add_page_template' => 'templates/template-programs.php',
			'nonce_action'      => 'wpdevsclub_program_save',
			'nonce_name'        => 'wpdevsclub_program_nonce',

			'id'                => 'inpost_program_metabox',
			'title'             => __( 'Program Code', 'wpdevsclub' ),
			'screen'            => array( 'page' ),
			'context'           => 'side',
			'priority'          => 'high',
		),
	),
);