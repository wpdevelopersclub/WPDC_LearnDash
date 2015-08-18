<?php namespace WPDC_Learndash\Models;

/**
 * Course Model
 *
 * @package     WPDC_Learndash\Models
 * @since       1.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        http://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

use WPDevsClub_Core\Models\Base;

class Course extends Base {

	/**
	 * Program Code
	 *
	 * @var string
	 */
	protected $program_code;

	/**
	 * Program Name
	 *
	 * @var string
	 */
	protected $program_name;

	/**
	 * Program ID
	 *
	 * @var int
	 */
	protected $program_id = 0;

	/**
	 * Course ID
	 *
	 * @var int
	 */
	protected $course_id = 0;

	/**
	 * Lesson ID
	 *
	 * @var int
	 */
	protected $lesson_id = 0;

	/**
	 * Topic ID
	 *
	 * @var int
	 */
	protected $topic_id = 0;

	/**
	 * Initialize
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init() {
		parent::init();

		$cat = get_the_category();
		if ( ! empty( $cat ) ) {
			$this->program_code = $cat[0]->cat_name;
		}

		$this->init_program( $this->fetch_program_from_db() );
	}


	/******************************
	 * Public Getters
	 *****************************/

	/**
	 * Get the Course ID
	 *
	 * @since 1.0.0
	 *
	 * @return integer
	 */
	public function getCourseId() {
		return $this->get_id_for_learndash_meta( 'course_id', 'course' );
	}

	/**
	 * Get the Course Info
	 *
	 * @since 1.0.0
	 *
	 * @param string $property Property and meta key to fetch
	 * @param string $type 'id' gets the ID; else name is returned
	 * @return string|integer
	 */
	public function get_course_info( $property, $type = '' ) {

		return 'id' == $type
			? $this->get_id_for_learndash_meta( $property . '_id', $property )
			: $this->get_name_for_specific_meta( $property . '_id' );
	}

	/******************************
	 * Helpers
	 *****************************/

	/**
	 * Get the name for a specific post
	 *
	 * @since 1.0.0
	 *
	 * @param string $property
	 * @return string
	 */
	protected function get_name_for_specific_meta( $property ) {
		if ( $this->$property < 1 ) {
			$function = 'get_' . $property;
			$this->$function();
		}

		return get_the_title( $this->$property );
	}

	/**
	 * Get the ID for the specific meta
	 *
	 * @since 1.0.0
	 *
	 * @param string $property
	 * @param string $meta_key
	 * @return int
	 */
	protected function get_id_for_learndash_meta( $property, $meta_key ) {
		if ( $this->$property < 1 ) {
			global $post;
			$this->$property = (int) learndash_get_setting( $post, $meta_key );
		}

		return $this->$property;
	}

	/**
	 * Fetch the program name from the database
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	protected function fetch_program_from_db() {
		global $wpdb;

		$sql_query = $wpdb->prepare(
			"
				SELECT p.post_title, p.ID
				FROM {$wpdb->posts} AS p
				LEFT JOIN {$wpdb->postmeta} AS meta ON meta.post_id = p.ID
				WHERE meta.meta_key = %s AND meta.meta_value = %s;
			", $this->config['program_code_meta_key'], $this->program_code
		);

		$results = $wpdb->get_results( $sql_query );
		return is_array( $results ) && ! empty( $results ) ? $results[0] : false;
	}

	/**
	 * Initialize the program properties
	 *
	 * @since 1.0.0
	 *
	 * @param false|StdObj $program
	 * @return false
	 */
	protected function init_program( $program ) {
		if ( $program ) {
			$this->program_name = stripslashes( $program->post_title );
			$this->program_id   = (int) $program->ID;
		}
	}
}