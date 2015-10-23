<?php namespace WPDC_Learndash\Templates_Classes;

/**
 * Single Course
 *
 * @package     WPDC_Learndash\Templates_Classes
 * @since       1.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

use WPDevsClub_Core\Support\Template;

class Single extends Template {


	/**************************
	 * Instantiate & Initialize
	 *************************/

	/**
	 * Initialize
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init() {
		$this->setup_sticky_footer();
	}

	/**
	 * Initialize child events
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_child_events() {
		add_action( 'genesis_after_header',         array( $this, 'render_subnav' ), 11 );

		remove_all_actions( 'genesis_entry_header' );
		add_action( 'genesis_entry_header',         array( $this, 'render_page_header' ) );

		remove_action( 'genesis_entry_content',     'genesis_do_post_content_nav', 12 );
		remove_all_actions( 'genesis_entry_footer' );

		remove_action( 'genesis_sidebar',           'genesis_do_sidebar' );
		remove_action( 'genesis_after_content',     'genesis_get_sidebar' );
		add_action( 'genesis_after_content',        array( $this, 'do_sidebar' ) );
		add_filter( 'genesis_attr_sidebar-courses', array( $this, 'sidebar_attributes' ) );

		add_action( 'genesis_after_content',        array( $this, 'do_sticky_footer' ), 99 );

		add_filter( 'learndash_next_post_link', array( $this, 'add_styling_class_to_next_link_button' ), 99 );
	}

	/*****************
	 * Callbacks
	 ****************/

	/**
	 * Render the Page Header
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function render_page_header() {
		if ( is_readable( $this->core['config']['post_header']['view'] ) ) {
			include( $this->core['config']['post_header']['view'] );
		}
	}

	/**
	 * Do the sidebar
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function do_sidebar() {
		if ( is_readable( $this->core['config']->sidebar['view'] ) ) {
			include( $this->core['config']->sidebar['view'] );
		}
	}

	/**
	 * Add attributes for primary sidebar element.
	 *
	 * @since 2.0.0
	 *
	 * @param array $attributes Existing attributes.
	 *
	 * @return array Amended attributes.
	 */
	public function sidebar_attributes( $attributes ) {
		$attributes['class']     = 'sidebar sidebar-courses widget-area';
		$attributes['role']      = 'complementary';
		$attributes['itemscope'] = 'itemscope';
		$attributes['itemtype']  = 'http://schema.org/WPSideBar';

		return $attributes;
	}

	/**
	 * Render the subnav
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function render_subnav() {
		$class = 'menu genesis-nav-menu menu-course';
		if ( genesis_superfish_enabled() ) {
			$class .= ' js-superfish';
		}

		genesis_nav_menu( array(
			'theme_location' => 'course',
			'menu_class'     => $class,
		) );
	}

	/**
	 * Register the stick footer
	 *
	 * @since 1.1.0
	 *
	 * @return null
	 */
	public function setup_sticky_footer() {
		do_action( 'wpdevclub_setup_sticky_footer', $this->core['sticky_footer.setup_config'] );
	}

	/**
	 * Add styling class to the next link button
	 *
	 * @since 1.0.0
	 *
	 * @param $link
	 *
	 * @return mixed
	 */
	public function add_styling_class_to_next_link_button( $link ) {
		return str_replace( '<a', '<a class="next-button"', $link );
	}
}