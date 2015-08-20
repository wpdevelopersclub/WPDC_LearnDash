<?php

$type = 'topic';
$post_type = 'sfwd-topic';
$header_ths = array(
	__( 'Program', 'wpdc' ),
	__( 'Course', 'wpdc' ),
	__( 'Lesson', 'wpdc' ),
	__( 'Topic', 'wpdc' ),
);

return include( WPDC_LEARNDASH_PLUGIN_DIR . 'config/_partials/single.php' );