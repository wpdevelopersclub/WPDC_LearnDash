<?php namespace WPDC_Learndash\Templates;

/**
 * Program Single Runtime Configuration
 *
 * @package     WPDC_Learndash\Templates
 * @since       2.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        https://wpdc.dev/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

use WPDevsClub_Core\Config\Arr_Config;

return array(

	/*********************************************************
	 * Initial Core Parameters, which are loaded into the
	 * Container before anything else occurs.
	 *
	 * Format:
	 *    $unique_id => $value
	 ********************************************************/

	'initial_parameters'            => array(
		'body_classes'              => array(
			'wpdevsclub-programs',
		),
		'config'                                    => new Arr_Config(
			array(
				'model'                             => array(
					'meta_keys'                     => array(
						'wpdevsclub_page_options'       => false,
						'wpdevsclub_programs_sections'  => false,
					),
				),

				'page'                                  => array(
					'number_of_sections'                => 10,
				),

				'post_title'            => array(
					'views'             => array(
						'main'          => CHILD_DIR . '/lib/views/common/post-title.php',
					),
					'remove_actions'    => array(
						array(
							'hook'      => 'genesis_entry_header',
							'callback'  => 'genesis_do_post_format_image',
							'priority'  => 4,
						),
						array(
							'hook'      => 'genesis_entry_header',
							'callback'  => 'genesis_do_post_title',
							'priority'  => 10,
						),
					),
					'use_image'         => true,
					'use_overlay'       => true,
					'post_args'         => array(),
				),

				'post'                  => array(
					'views'             => array(
						'tldr'          => CHILD_DIR . '/lib/views/common/tldr.php',
					),
					'layout'            => '__genesis_return_full_width_content',
					'body_classes'      => array(
						'wpdevsclub-post',
					),

					'labels'            => array(
						'tldr'          => __( 'tl;dr', 'wpdc' ),
					),
				),
			)
		),
	),

	/*********************************************************
	 * Extras
	 ********************************************************/

	'sections'                  => array(
		'number_of_sections'    => 5,
		'prefix'                => 'programs-section-',
		'class_prefix'          => 'programs',
		'meta_key'              => 'wpdevsclub_programs_sections',
		'patterns'              => array(
			'class'             => '_section%d_class',
			'content'           => '_section%d_content',
			'wpautop'           => '_section%d_content_wpautop',
		),
	),

	'views'             => array(
		'main'          => '',
		'header'        => CHILD_DIR . '/lib/views/programs/header.php',
		'section'       => CHILD_DIR . '/lib/views/programs/section.php',
	),
);