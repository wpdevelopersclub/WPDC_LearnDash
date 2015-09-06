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

use WPDevsClub_Core\Models\Model;

class Course extends Model {

	/**
	 * Program Code
	 *
	 * @var string
	 */
	protected $program_id = 0;

	/**
	 * Program Name
	 *
	 * @var string
	 */
	protected $program_name;

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

		$this->init_course_id();

		$this->init_program();
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
			", $this->config->program_id_meta_key, $this->program_id
		);

		$results = $wpdb->get_results( $sql_query );

		return is_array( $results ) && ! empty( $results ) ? $results[0] : false;
	}

	/**
	 * Init the Course ID
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_course_id() {
		$this->course_id = $this->config->fetch_program_id_from_course
			? $this->get_id_for_learndash_meta( 'course_id', 'course' )
			: $this->post_id;
	}

	/**
	 * Initialize the program properties
	 *
	 * @since 1.0.0
	 *
	 * @return false
	 */
	protected function init_program() {
		$this->program_id = $this->get_program_id();
		if ( $this->program_id > 0 ) {
			$this->program_name = get_the_title( $this->program_id );
		}
	}

	/**
	 * Fetch the program code from the assigned course
	 *
	 * @since 1.0.0
	 *
	 * @return string|null
	 */
	protected function fetch_program_code_from_assigned_course() {
		global $post;
		$course_id = learndash_get_setting( $post, 'course' );
		return $this->fetch_program_code_from_category( $course_id );
	}

	/**
	 * Get Course Program Code
	 *
	 * @since 1.0.0
	 *
	 * @return int
	 */
	protected function get_program_id() {
		if ( $this->config->fetch_program_id_from_course ) {
			return (int) get_post_meta( $this->course_id, $this->config->program_id_meta_key, true );
		}

		return (int) $this->get_property( 'data', $this->config->program_id_meta_key, '', 0 );
	}
}