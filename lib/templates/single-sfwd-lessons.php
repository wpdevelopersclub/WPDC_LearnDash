<?php namespace WPDC_Learndash\Templates;

/**
 * Single Lesson
 *
 * @package     WPDC_Learndash\Templates
 * @since       1.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        http://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

$config = include( WPDC_LEARNDASH_PLUGIN_DIR . 'config/templates/single-sfwd-lessons.php' );
new Single( $config );

genesis();