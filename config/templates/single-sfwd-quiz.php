<?php namespace WPDC_Learndash\Templates;

/**
 * SFWD Quiz Runtime Configuration
 *
 * @package     WPDC_Learndash\Templates
 * @since       1.1.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

use WPDevsClub_Core\Config\Arr_Config;
use WPDC_Learndash\Models\Course as Model;

global $post;
$type       = 'quiz';
$post_type  = 'sfwd-quiz';
$header_ths = array(
	__( 'Program', 'wpdc' ),
	__( 'Course', 'wpdc' ),
	__( 'Lesson', 'wpdc' ),
);

return array(

	/*********************************************************
	 * Initial Core Parameters, which are loaded into the
	 * Container before anything else occurs.
	 *
	 * Format:
	 *    $unique_id => $value
	 ********************************************************/

	'initial_parameters'   => array(
		'body_classes' => array(
			'wpdevsclub-' . $type,
			'sliding-sidebar',
			'learndash',
		),
		'config'       => new Arr_Config(
			array(
				'type'          => $type,
				'post_type'     => $post_type,
				'sidebar'       => array(
					'name' => 'courses',
					'view' => WPDC_LEARNDASH_PLUGIN_DIR . 'src/templates/sidebar.php',
				),
				'model'         => array(
					'program_id_meta_key'          => '_wpdc_program_id',
					'meta_keys'                    => array(
						'_wpdc_program_id' => true,
					),
					'post_type'                    => $post_type,
					'fetch_program_id_from_course' => true,
				),
				'post_header'   => array(
					'view'       => WPDC_LEARNDASH_PLUGIN_DIR . 'src/views/page-header-' . $type . '.php',
					'header_ths' => $header_ths,
				),
				'post'          => array(
					'views'        => array(),
					'layout'       => '__genesis_return_full_width_content',
					'body_classes' => array( 'wpdevsclub-' . $type ),
				),
				'sticky_footer' => array(
					'theme_locations' => array(
						'quick_links' => 'sticky_footer_course_quick_links',
						'extras'      => 'sticky_footer_course_extras',
					),
					'views'           => array(
						'sticky_footer' => WPDC_STICKY_FOOTER_DIR . 'src/views/sticky-footer.php',
						'panels'        => array(
							WPDC_STICKY_FOOTER_DIR . 'src/views/panels/join-dashboard.php',
							WPDC_LEARNDASH_PLUGIN_DIR . 'src/views/sticky-footer/panels/sidebar.php',
							WPDC_STICKY_FOOTER_DIR . 'src/views/panels/quick-links.php',
							WPDC_STICKY_FOOTER_DIR . 'src/views/panels/extras.php',
							WPDC_STICKY_FOOTER_DIR . 'src/views/panels/to-top.php',
						),
					),
				),
			)
		),
	),
	/*********************************************************
	 * Front-End Service Providers -
	 * These service providers are loaded when 'genesis_init' fires.
	 *
	 * Format:
	 *    $unique_id => array(
	 *      // When true, the instance is fetched out of the
	 *      // Container.
	 *      'autoload' => true|false|callback,
	 *      // Closure that is loaded into the Container.
	 *      'concrete' => Closure,
	 ********************************************************/

	'fe_service_providers' => array(
		'model'                      => array(
			'autoload' => false,
			'concrete' => function ( $container ) {
				return new Model( new Arr_Config( $container['config']->model ), $container['post_id'] );
			},
		),
		'sticky_footer.setup_config' => array(
			'autoload' => true,
			'concrete' => function ( $container ) {
				return new Arr_Config(
					array(
						'menu_theme_support' => array(
							'sticky_footer_course_quick_links' => __( 'Sticky Footer - Course Quick Links', 'wpdc' ),
							'sticky_footer_course_extras'      => __( 'Sticky Footer - Course Extras', 'wpdc' ),
						),
					),
					$container['core']['sticky_footer.config.plugin']
				);
			},
		),
	),
);