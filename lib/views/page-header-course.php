<header class="entry-header">
	<table class="page-header">
		<tbody>
			<tr>
				<th><?php _e( 'Program', 'wpdc' ); ?></th>
				<td><h2 class="program-title"><a href="<?php echo get_permalink( $this->model->getProperty( 'program_id' ) ); ?>" rel="bookmark"><?php esc_html_e( $this->model->getProperty( 'program_name' ) ); ?></a></h2></td>
			</tr>
			<tr>
				<th><?php _e( 'Course', 'wpdc' ); ?></th>
				<td><h1 class="course-title entry-title"><?php the_title(); ?></h1></td>
			</tr>
		</tbody>
	</table>
</header>