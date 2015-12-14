<?php namespace WPDC_Learndash;

/**
 * Custom LearnDash extension for WPDC
 *
 * @package     WPDC_Learndash
 * @since       2.1.0
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
use SFWD_LMS;

final class Plugin extends Addon {

	/**
	 * The plugin's version
	 *
	 * @var string
	 */
	const VERSION = '2.1.0';

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
		add_filter( 'learndash_content', array( $this, 'course_content' ), 10, 2 );
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

	/*************************
	 * Workaround
	 ************************/

	/**
	 * Display the course content when the course prerequisites are not satisfied yet.
	 *
	 *
	 * NOTE:
	 * Hopefully this is a temporary work-around to display the course's landing page when the
	 * prerequisites have not yet been completed. Out-of-the-box, LearnDash blocks all of the content.
	 *
	 * @since 2.1.0
	 *
	 * @param string $content
	 * @param WP_Post $post
	 *
	 * @return string
	 */
	public function course_content( $content, $post ) {
		if ( get_post_type( $post ) != 'sfwd-courses' || is_course_prerequities_completed( $post->ID ) ) {
			return $content;
		}

		$content = str_replace( '<div ', '<div class="wpdevsclub-info-box" ', $content );
		$content .= sprintf( '<h2>%s</h2>', __( 'Course Overview', 'wpdc') );
		$content .= do_shortcode( wpautop( $post->post_content ) );

		return $this->get_course_content_when_prequisites_not_completed( $content, $post );
	}

	/**
	 * This is a copy out of LearnDash `class-id-cpt-instance.php` file, method `template_content`.
	 * Hopefully this is a temporary work-around to display the course's landing page when the
	 * prerequisites have not yet been completed. Out-of-the-box, LearnDash blocks all of the content.
	 *
	 * Notes:
	 * 1. Set $logged_in and $has_access to `false` to prevent status issues.
	 *
	 * @since 2.1.0
	 *
	 * @param string $content
	 * @param WP_Post $post
	 *
	 * @return string
	 */
	protected function get_course_content_when_prequisites_not_completed( $content, $post ) {
		$course_id = learndash_get_course_id();

		if ( empty( $course_id ) ) {
			return $content;
		}

		$user_id = get_current_user_id();
		$logged_in = $lesson_progression_enabled = false;
		$has_access = true;

		$course = get_post( $course_id );
		$course_settings = learndash_get_setting( $course );
		$lesson_progression_enabled  = learndash_lesson_progression_enabled();
		$courses_options = learndash_get_option( 'sfwd-courses' );
		$lessons_options = learndash_get_option( 'sfwd-lessons' );
		$quizzes_options = learndash_get_option( 'sfwd-quiz' );
		$course_status = learndash_course_status( $course_id, null );
		$course_certficate_link = '';
		$courses_prefix = 'sfwd-courses_';

		$prefix_len = strlen( $courses_prefix );

		if ( ! empty( $course_settings['course_materials'] ) ) {
			$materials = wp_kses_post( wp_specialchars_decode( $course_settings['course_materials'], ENT_QUOTES ) );
		}

		$lessons = learndash_get_course_lessons_list( $course );
		$quizzes = learndash_get_course_quiz_list( $course );

		$has_course_content = ( ! empty( $lessons) || ! empty( $quizzes ) );

		$lesson_topics = array();

		$has_topics = false;

		if ( ! empty( $lessons ) ) {
			foreach ( $lessons as $lesson ) {
				$lesson_topics[ $lesson['post']->ID ] = learndash_topic_dots( $lesson['post']->ID, false, 'array' );
				if ( ! empty( $lesson_topics[ $lesson['post']->ID ] ) ) {
					$has_topics = true;
				}
			}
		}

		$level = ob_get_level();
		ob_start();
		include( SFWD_LMS::get_template( 'course', null, null, true ) );

		return learndash_ob_get_clean( $level );
	}
}