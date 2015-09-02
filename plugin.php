<?php namespace WPDC_Learndash;

/**
 * Custom LearnDash extension for WPDC
 *
 * @package         WPDC_Learndash
 * @author          WPDevelopersClub and hellofromTonya
 * @license         GPL-2.0+
 * @link            http://wpdevelopersclub.com/
 * @copyright       2015 WP Developers Club
 *
 * @wordpress-plugin
 * Plugin Name:     Custom LearnDash extension for WPDC
 * Plugin URI:      http://wpdevelopersclub.com/
 * Description:     Configuring LearnDash for our needs
 * Version:         1.1.0
 * Author:          WP Developers Club and Tonya
 * Author URI:      http://wpdevelopersclub.com
 * Text Domain:     wpdevsclub
 * Requires WP:     3.5
 * Requires PHP:    5.4
 */

/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

use WPDevsClub_Core\Config\Factory;

// Oh no you don't. Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheating&#8217; uh?' );
}

if ( ! defined( 'WPDC_LEARNDASH_PLUGIN_DIR' ) ) {
	define( 'WPDC_LEARNDASH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WPDC_LEARNDASH_PLUGIN_URL' ) ) {
	$plugin_url = plugin_dir_url( __FILE__ );
	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}
	define( 'WPDC_LEARNDASH_PLUGIN_URL', $plugin_url );
}

require_once( __DIR__ . '/assets/vendor/autoload.php' );

if ( version_compare( $GLOBALS['wp_version'], Plugin::MIN_WP_VERSION, '>' ) ) {
	init_hooks();
}

/**
 * Initialize the plugin hooks
 *
 * @since 1.0.0
 *
 * @return null
 */
function init_hooks() {
	add_action( 'plugins_loaded', __NAMESPACE__ . '\\launch', 99 );
}

/**
 * Launch the plugin
 *
 * @since 1.1.0
 *
 * @return null
 */
function launch() {
	new Plugin( Factory::create( WPDC_LEARNDASH_PLUGIN_DIR . 'config/plugin.php' ) );
}

add_action( 'wpdevsclub_do_service_providers', function( $core ) {
	$core['wpdc_learndash.dir'] = WPDC_LEARNDASH_PLUGIN_DIR;
	$core['wpdc_learndash.url'] = WPDC_LEARNDASH_PLUGIN_URL;
} );