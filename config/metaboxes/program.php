<?php

return array(
	'view'                          => WPDC_LEARNDASH_PLUGIN_DIR . 'src/views/admin/metabox-program.php',

	'program_code_meta_key'         => '_wpdevsclub_program_code',

	/****************************
	 * Meta config parameters
	 ****************************/
	'meta_name'                     => 'wpdevsclub_program_code',
	'meta_single'                   => array(
		'_wpdevsclub_program_code'  => array(
			'default'               => '',
			'sanitize'              => 'strip_tags',
		),
	),
	'meta_array'                    => array(),

	/****************************
	 * Metabox config parameters
	 ****************************/

	'add_page_template' => 'templates/template-programs.php',
	'nonce_action'      => 'wpdevsclub_program_code_save',
	'nonce_name'        => 'wpdevsclub_program_code_nonce',

	'id'                => 'inpost_program_code_metabox',
	'title'             => __( 'Program Code', 'wpdc' ),
	'screen'            => array( 'page' ),
	'context'           => 'side',
	'priority'          => 'high',
);