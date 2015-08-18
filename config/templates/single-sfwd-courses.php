<?php

global $post;

$type = 'course';
$post_type = 'sfwd-courses';
$header_ths = array(
	__( 'Program', 'wpdc' ),
	__( 'Course', 'wpdc' ),
);

return include( WPDC_LEARNDASH_PLUGIN_DIR . 'config/_partials/single.php' );