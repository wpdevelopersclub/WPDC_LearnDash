<?php namespace WPDC_Learndash\Templates;

/**
 * Single Course, Lesson, or Quiz
 *
 * @package     WPDC_Learndash\Templates
 * @since       1.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        http://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

use WPDevsClub_Core\Support\Base_Template;
use WPDC_Learndash\Models\Course as Model;
use WPDevsClub_Core\Structures\Post\Post;

class Single extends Base_Template {

	/**************************
	 * Instantiate & Initialize
	 *************************/

	/**
	 * Initialize Properties
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_properties() {
		$this->body_classes = $this->config['body_classes'];
	}

	/**
	 * Initialize
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init() {
		$this->init_object_factory();
		$this->init_page_hooks();
	}

	/**
	 * Initialize Page Hooks
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_page_hooks() {

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
	}

	/**
	 * Initialize Object Factory
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_object_factory() {
		$this->model = new Model( $this->config['model'], $this->post_id );

		new Post( $this->model, $this->config['post'], $this->post_id );

		do_action( 'wpdevclub_setup_sticky_footer', $this->config['sticky_footer']['setup'] );
	}

	/**
	 * Render the Page Header
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function render_page_header() {
		include( $this->config['post_header']['view'] );
	}

	/**
	 * Do the sidebar
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function do_sidebar() {
		include( $this->config['sidebar']['view'] );
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
	 * Time to do the sticky footer
	 *
	 * @since 1.0.0
	 *
	 * @uses action event 'wpdevsclub_do_sticky_footer'
	 *
	 * @return null
	 */
	public function do_sticky_footer() {
		do_action( 'wpdevsclub_do_sticky_footer', $this->model, $this->config['sticky_footer']['render'], $this->post_id );
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

	protected function get_header_ths() {

	}
}