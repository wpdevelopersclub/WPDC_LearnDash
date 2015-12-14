<?php namespace WPDC_Learndash\Admin\Metabox;

/**
 * Program Code Metabox
 *
 * @package     WPDC_Learndash\Admin\Metabox
 * @since       2.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 */

return array(
	'view'                  => WPDC_LEARNDASH_PLUGIN_DIR . 'src/views/admin/metabox-program-code.php',
	'program_code_meta_key' => '_wpdc_program_code',
	/****************************
	 * Meta config parameters
	 ****************************/
	'meta_name'             => 'wpdc_program_code',
	'meta_single'           => array(
		'_wpdc_program_code' => array(
			'default'  => '',
			'sanitize' => 'strip_tags',
		),
	),
	'meta_array'            => array(),
	/****************************
	 * Metabox config parameters
	 ****************************/

	'nonce_action'          => 'wpdevsclub_program_code_save',
	'nonce_name'            => 'wpdevsclub_program_code_nonce',
	'id'                    => 'inpost_program_code_metabox',
	'title'                 => __( 'Program Code', 'wpdc' ),
	'screen'                => array( 'wpdc_program' ),
	'context'               => 'side',
	'priority'              => 'high',
);