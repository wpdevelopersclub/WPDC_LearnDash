<?php namespace WPDC_Learndash;

/**
 * Custom LearnDash extension for WPDC
 *
 * @package     WPDC_Learndash
 * @since       1.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        http://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

// Oh no you don't. Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

use WPDevsClub_Core\Admin\Metabox\Metabox;
use WPDevsClub_Core\Support\Template_Manager;

final class Plugin {

	/**
	 * The plugin's version
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * The plugin's minimum WordPress requirement
	 *
	 * @var string
	 */
	const MIN_WP_VERSION = '3.5';

	/**
	 * Configuration parameters
	 *
	 * @var array
	 */
	protected $config = array();

	/*************************
	 * Getters
	 ************************/

	public function version() {
		return self::VERSION;
	}

	public function min_wp_version() {
		return self::MIN_WP_VERSION;
	}

	/**************************
	 * Instantiate & Initialize
	 *************************/

	/**
	 * Instantiate the plugin
	 *
	 * @since 1.0.0
	 *
	 * @param array     $config
	 * @return self
	 */
    public function __construct( array $config ) {
	    $this->config = $config;

	    $this->init_hooks();
    }

	/**
	 * Initialize hooks
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
    protected function init_hooks() {

	    add_action( 'wpdevsclub_admin_init',            array( $this, 'init_admin' ) );
    	add_action( 'wpdevsclub_init_object_factory',   array( $this, 'init_object_factory' ) );
	    add_action( 'genesis_setup',                    array( $this, 'setup' ), 50 );
    }

	/**************************
	 * Callbacks
	 *************************/

	/**
	 * Initialize Admin
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function init_admin() {
		foreach ( $this->config['metaboxes'] as $key => $mb_config ) {
			new Metabox( $mb_config );
		}
	}

	/**
	 * Instantiate each of the plugin objects
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function init_object_factory() {
		$this->remove_post_type_support();

		new Template_Manager( $this->config['template_manager'] );
	}

	/**
	 * Runtime setup
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function setup() {
		$this->register_sidebars();
		$this->register_menus();
	}

	/**************************
	 * Helpers Functionality
	 *************************/

	/**
	 * Remove the post type support
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function remove_post_type_support() {
		foreach ( $this->config['remove_post_type_support'] as $post_type => $supports ) {
			foreach ( $supports as $support ) {
				remove_post_type_support( $post_type, $support );
			}
		}
	}

	/**
	 * Register Sidebars
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function register_sidebars() {

		foreach ( $this->config['sidebars'] as $id => $sidebar ) {
			genesis_register_sidebar( array(
				'id'            => $id,
				'name'          => $sidebar['name'],
				'description'   => $sidebar['description'],
			));
		}
	}

	/**
	 * Register new menus
	 *
	 * @since 1.0.0
	 *
	 * @uses global $_wp_theme_features
	 * @return null
	 */
	protected function register_menus() {
		global $_wp_theme_features;
		$_wp_theme_features['genesis-menus'][0] = array_merge( $this->config['genesis-menus'], $_wp_theme_features['genesis-menus'][0] );
	}
}