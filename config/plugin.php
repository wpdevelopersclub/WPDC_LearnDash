<?php namespace WPDC_Learndash;

/**
 * Runtime Configuration file.
 *
 * @package     WPDC_Learndash
 * @since       1.0.0
 * @author      WPDevelopersClub, hellofromTonya, Alain Schlesser, Gary Jones
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

use WPDevsClub_Core\Config\Arr_Config;
use WPDevsClub_Core\Admin\Metabox\Metabox;
use WPDevsClub_Core\Support\Template_Manager;

return array(

	/*********************************************************
	 * Initial Core Parameters, which are loaded into the
	 * Container before anything else occurs.
	 *
	 * Format:
	 *    $unique_id => $value
	 ********************************************************/

	'initial_parameters'            => array(
		'wpdc_learndash.dir'        => WPDC_LEARNDASH_PLUGIN_DIR,
		'wpdc_learndash.url'        => WPDC_LEARNDASH_PLUGIN_URL,
		'wpdc_learndash.config_dir' => WPDC_LEARNDASH_PLUGIN_DIR . 'config/',
		'wpdc_learndash.config'     => array(),
	),

	/*********************************************************
	 * Back-End Service Providers -
	 * These service providers are loaded when 'admin_init' fires.
	 *
	 * Format:
	 *    $unique_id => array(
	 *      // When true, the instance is fetched out of the
	 *      // Container.
	 *      'autoload' => true|false,
	 *      // Closure that is loaded into the Container.
	 *      'concrete' => Closure,
	 ********************************************************/

	'be_service_providers'      => array(
		'wpdc_learndash.metabox.program' => array(
			'autoload'          => true,
			'concrete'          => function( $container ) {
				return new Metabox(
					new Arr_Config(
						$container['wpdc_learndash.config_dir'] . 'metaboxes/program.php',
						$container['core_config_defaults_dir'] . 'metabox.php'
					)
				);
			},
		),
	),

	/*********************************************************
	 * Front-End Service Providers -
	 * These service providers are loaded when 'genesis_init'
	 * fires and not in back-end.
	 *
	 * Format:
	 *    $unique_id => array(
	 *      // When true, the instance is fetched out of the
	 *      // Container.
	 *      'autoload' => true|false,
	 *      // Closure that is loaded into the Container.
	 *      'concrete' => Closure,
	 ********************************************************/

	'fe_service_providers'  => array(),

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

	'both_service_providers'    => array(
		'wpdc_learndash.template_manager' => array(
			'autoload'          => true,
			'concrete'          => function( $container ) {
				return new Template_Manager(
					new Arr_Config(
						$container['wpdc_learndash.config_dir'] . 'template-manager.php',
						$container['core_config_defaults_dir'] . 'support/template-manager.php'
					)
				);
			},
		),
	),

	/*********************************************************
	 * Extras
	 ********************************************************/

	'genesis-menus'                         => array(
		'course'                            => __( 'Course', 'wpdc' ),
		'sticky_footer_course_quick_links'  => __( 'Sticky Footer - Course Quick Links', 'wpdc' ),
		'sticky_footer_course_extras'       => __( 'Sticky Footer - Course Extras', 'wpdc' ),
	),
	'remove_post_type_support'      => array(
		'sfwd-courses'              => array( 'comments', 'trackbacks' ),
		'sfwd-lessons'              => array( 'comments', 'trackbacks' ),
		'sfwd-topic'                => array( 'comments', 'trackbacks' ),
		'sfwd-quiz'                 => array( 'comments', 'trackbacks' ),
	),

	'sidebars'                      => array(
		'courses'                   => array(
			'name'                  => __( 'Courses', 'wpdc' ),
			'description'           => __( 'This area is for the course pages.', 'wpdc' ),
		),
	),
);