<?php namespace WPDC_Learndash\Customizers;

/**
 * HTML Customizers for LearnDash
 *
 * @package     WPDC_Learndash\Customizers
 * @since       1.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        http://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

class HTML {

	/**
	 * Runtime configuration
	 *
	 * @var array
	 */
	protected $config;

	/****************************
	 * Instantiate & Initialize
	 ***************************/

	/**
	 * Instantiate the HTML Customizer
	 *
	 * @since 1.0.0
	 *
	 * @param array $config
	 * @return self
	 */
	public function __construct( array $config ) {
		$this->config = $config;
		$this->init_events();
	}

	/**
	 * Initialize events
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_events() {
		add_filter( 'learndash_previous_post_link', array( $this, 'add_styling_class_to_previous_post_link' ) );
		add_filter( 'learndash_next_post_link',     array( $this, 'add_styling_class_to_next_post_link' ) );
	}

	/****************************
	 * Callbacks
	 ***************************/

	/**
	 * Add styling class to previous post link
	 *
	 * @since 1.0.0
	 *
	 * @param string $link_html
	 * @return string
	 */
	public function add_styling_class_to_previous_post_link( $link_html ) {
		return $this->insert_html_into_link_string( $link_html, $this->config['nav_link']['prev_html_pattern'] );
	}

	/**
	 * Add styling class to next post link
	 *
	 * @since 1.0.0
	 *
	 * @param string $link_html
	 * @return string
	 */
	public function add_styling_class_to_next_post_link( $link_html ) {
		return $this->insert_html_into_link_string( $link_html, $this->config['nav_link']['next_html_pattern'] );
	}

	protected function insert_html_into_link_string( $link_html, $insert_html_pattern ) {
		return str_replace( 'rel=', $insert_html_pattern, $link_html );
	}
}