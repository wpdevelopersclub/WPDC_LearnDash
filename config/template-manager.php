<?php namespace WPDC_Learndash;

/**
 * Template Manager Runtime Configuration file.
 *
 * @package     WPDC_Learndash
 * @since       1.0.0
 * @author      WPDevelopersClub, hellofromTonya, Alain Schlesser, Gary Jones
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

return array(
	'template_folder_path'      => WPDC_LEARNDASH_PLUGIN_DIR . 'src/templates/',
	'post_type'                 => array( 'wpdc_program', 'sfwd-courses', 'sfwd-lessons', 'sfwd-quiz', 'sfwd-topic' ),
	'use_template_slug'         => true,
	'use_single'                => true,
);