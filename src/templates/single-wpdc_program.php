<?php namespace WPDC_Learndash\Templates;

/**
 * Single Program
 *
 * @package     WPDC_Learndash\Templates
 * @since       1.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 */

use WPDevsClub_Core\Core;
use WPDevsClub_Core\Templates\Sections_Page;
use WPDevsClub_Core\Config\Factory;

$core = Core::getCore();

new Sections_Page(
	Factory::create(
		WPDC_LEARNDASH_PLUGIN_DIR . 'config/templates/single-wpdc-program.php',
		$core['core_service_providers_dir'] . 'sections-page.php'
	),
	$core
);

genesis();