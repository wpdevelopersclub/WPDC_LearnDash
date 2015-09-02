<header class="entry-header">
	<table class="page-header">
		<tbody>
			<tr>
				<th><?php _e( 'Program', 'wpdc' ); ?></th>
				<td><h2 class="program-title"><a href="<?php echo get_permalink( $this->core['model']->getProperty( 'program_id' ) ); ?>" rel="bookmark"><?php esc_html_e( $this->core['model']->getProperty( 'program_name' ) ); ?></a></h2></td>
			</tr>
			<tr>
				<th><?php _e( 'Course', 'wpdc' ); ?></th>
				<td><h2 class="course-title"><a href="<?php echo get_permalink( $this->core['model']->get_course_info( 'course', 'id' ) ); ?>" rel="bookmark"><?php esc_html_e( $this->core['model']->get_course_info( 'course' ) ); ?></a></h2></td>
			</tr>
			<tr>
				<th><?php _e( 'Lesson', 'wpdc' ); ?></th>
				<td><h2 class="lesson-title"><a href="<?php echo get_permalink( $this->core['model']->get_course_info( 'lesson', 'id' ) ); ?>" rel="bookmark"><?php esc_html_e( $this->core['model']->get_course_info( 'lesson' ) ); ?></a></h2></td>
			</tr>
			<tr>
				<th><?php _e( 'Topic', 'wpdc' ); ?></th>
				<td><h1 class="topic-title entry-title"><?php the_title(); ?></h1></td>
			</tr>
		</tbody>
	</table>
</header>