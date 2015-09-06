<?php for( $section = 1; $section <= $this->config['number_of_sections']; $section++ ) : ?>

<h3 style="margin-top: 20px; background-color: #ccc; color: #fff; border-top: 2px solid #ccc; border-bottom: 2px solid #ccc;"><?php printf( '%s %d', __( 'Section', 'wpdc' ), $section ); ?></h3>

<p>
	<label for="_wpdevsclub_programs_sections<?php echo $section; ?>_content">
		<strong><?php _e( 'Enter Content for this Section', 'wpdc' ); ?></strong>
	</label>
</p>
<p>
	<?php
	$args = array(
		'textarea_name' => "wpdevsclub_programs_sections[_section{$section}_content]",
	);
	wp_editor( $meta["_section{$section}_content"], "_wpdevsclub_programs_sections{$section}_content", $args );
	?>
</p>
<p class="description">
	<?php _e( 'Enter the content that you want to display in this section.', 'wpdc' ); ?>
</p>

<p>
	<label for="_wpdevsclub_programs_sections<?php echo $section; ?>_class">
		<strong><?php _e( 'Class to apply to the section', 'wpdc' ); ?></strong>
	</label>
</p>
<p>
	<input class="large-text" type="text" name="wpdevsclub_programs_sections[_section<?php echo $section; ?>_class]" value="<?php echo esc_attr( $meta["_section{$section}_class"] ); ?>" />
</p>

<p>
	<label for="_wpdevsclub_programs_sections<?php echo $section; ?>_content_wpautop">
		<input type="checkbox" name="wpdevsclub_programs_sections[_section<?php echo $section; ?>_content_wpautop]" value="1"<?php checked( isset( $meta["_section{$section}_content_wpautop"] ) ? intval( $meta["_section{$section}_content_wpautop"] ) : 0 ); ?> />
		<strong><?php _e( 'Apply paragraph tags automatically to content?', 'wpdc' ); ?></strong>
	</label>
</p>

<?php endfor; ?>