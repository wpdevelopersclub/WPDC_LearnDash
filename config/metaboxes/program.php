<?php namespace WPDC_Learndash\Admin\Metabox;

/**
 * Program Metabox
 *
 * @package     WPDC_Learndash\Admin\Metabox
 * @since       2.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 */

$number_of_sections = 5;
$sanitize           = $meta_defaults = array();

for ( $section_number = 1; $section_number <= $number_of_sections; $section_number ++ ) {
    $meta_defaults["_section{$section_number}_content"]         = '';
    $meta_defaults["_section{$section_number}_class"]           = '';
    $meta_defaults["_section{$section_number}_content_wpautop"] = 0;

    $sanitize["_section{$section_number}_content"]         = 'wp_kses_post';
    $sanitize["_section{$section_number}_class"]           = 'strip_tags';
    $sanitize["_section{$section_number}_content_wpautop"] = 'intval';
}

return array(
    'view' => WPDC_LEARNDASH_PLUGIN_DIR . 'src/views/admin/metabox-program.php',
    /****************************
     * Meta config parameters
     ****************************/

    'meta_name'          => 'wpdevsclub_programs_sections',
    'meta_single'        => array(),
    'meta_array'         => array(
        'meta_key'      => 'wpdevsclub_programs_sections',
        'meta_defaults' => $meta_defaults,
        'sanitize'      => $sanitize,
    ),
    /****************************
     * Metabox config parameters
     ****************************/

    'nonce_action'       => 'wpdevsclub_programs_sections_save',
    'nonce_name'         => 'wpdevsclub_programs_sections_nonce',
    'id'                 => 'inpost_programs_sections_metabox',
    'title'              => __( 'Program Sections', 'wpdc' ),
    'screen'             => array( 'page', 'wpdc_program' ),
    /****************************
     * Extra args
     ****************************/

    'number_of_sections' => $number_of_sections,
    'sections_metakey'   => 'wpdevsclub_programs_sections',
);