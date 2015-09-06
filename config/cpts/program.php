<?php

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
			'args'     => array( 'wpdevsclub_program_code' ),
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