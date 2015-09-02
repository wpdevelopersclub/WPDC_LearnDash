<?php namespace WPDC_Learndash\Templates;

/**
 * Single Quiz
 *
 * @package     WPDC_Learndash\Templates
 * @since       1.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        http://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

use WPDevsClub_Core\Core;
use WPDC_Learndash\Templates_Classes\Single;
use WPDevsClub_Core\Config\Factory;

$core = Core::getCore();

new Single( Factory::create( WPDC_LEARNDASH_PLUGIN_DIR . 'config/templates/single-sfwd-quiz.php', $core['core_service_providers_dir'] . 'single.php' ), $core );

genesis();