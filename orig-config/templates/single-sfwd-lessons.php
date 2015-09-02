<?php

$type = 'lesson';
$post_type = 'sfwd-lessons';
$header_ths = array(
	__( 'Program', 'wpdc' ),
	__( 'Course', 'wpdc' ),
	__( 'Lesson', 'wpdc' ),
);

return include( WPDC_LEARNDASH_PLUGIN_DIR . 'config/_partials/single.php' );