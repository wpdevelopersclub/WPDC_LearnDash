<?php namespace WPDC_WPCourseware;

/**
 * Program Custom Post Type Runtime Configuration
 *
 * @package     WPDC_WPCourseware
 * @since       1.1.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 * @copyright   2015 WP Developers Club
 */

return array(
	'singular_name'  => 'Program',
	'args'           => array(
		'label'         => 'Programs',
		'labels'        => array(
			'menu_name' => 'Programs',
			'add_new'   => 'Add a New Program',
		),
		'description'   => 'DevSchool Programs',
		'public'        => true,
		'menu_position' => 50,
		'hierarchical'  => true,
		'rewrite'       => array(
			'slug' => 'programs',
		),
		'taxonomies'    => array( 'category', 'post_tag' ),
	),
	'columns_filter' => array(
		'cb'           => true,
		'title'        => __( 'Program', 'wpdc' ),
		'program_code' => __( 'Program Code', 'wpdc' ),
		'cat'          => __( 'Categories', 'wpdc' ),
		'tags'         => __( 'Tags', 'wpdc' ),
		'date'         => __( 'Date', 'wpdc' ),
	),
	'columns_data'   => array(
		'program_code' => array(
			'callback' => 'genesis_get_custom_field',
			'echo'     => true,
			'args'     => array( '_wpdc_program_code' ),
		),
		'cat'          => array(
			'callback' => 'wpdevsclub_get_joined_list_of_terms',
			'echo'     => true,
			'args'     => array( 'category' ),
		),
		'tags'         => array(
			'callback' => 'wpdevsclub_get_joined_list_of_terms',
			'echo'     => true,
			'args'     => array( 'post_tag' ),
		),
		'date'         => array(
			'callback' => 'the_date',
			'echo'     => false,
			'args'     => array(),
		),
	),
);