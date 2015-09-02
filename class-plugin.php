<?php namespace WPDC_Learndash;

/**
 * Custom LearnDash extension for WPDC
 *
 * @package     WPDC_Learndash
 * @since       1.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

// Oh no you don't. Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

use WPDevsClub_Core\Addons\Addon;

final class Plugin extends Addon {

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

	/*************************
	 * Instantiate & Init
	 ************************/

	/**
	 * Addons can overload this method for additional events
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_addon_events() {
		add_action( 'genesis_setup', array( $this, 'setup' ), 50 );
	}

	/*************************
	 * Callbacks
	 ************************/

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
		$this->remove_post_type_support();
	}

	/*************************
	 * Helpers
	 ************************/

	/**
	 * Register Sidebars
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function register_sidebars() {
		array_walk ( $this->config->sidebars, function( $sidebar, $id ) {
			genesis_register_sidebar( array(
				'id'            => $id,
				'name'          => $sidebar['name'],
				'description'   => $sidebar['description'],
			) );
		} );
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
	/**
	 * Remove the post type support
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function remove_post_type_support() {
		array_walk( $this->config->remove_post_type_support, function( $supports, $post_type ) {
			foreach ( $supports as $support ) {
				remove_post_type_support( $post_type, $support );
			}
		} );
	}
}