<?php

	$edit_post_id = $_GET['post'];
	$current_assignments = get_post_meta($edit_post_id, 'cpt_courses_assignments');

	$posts = new WP_Query(['post_type' => 'assignment']);

	while($posts->have_posts()) : $posts->the_post();

?>

	<label>
		<input type="checkbox" name="cpt_courses_assignments[]" value="<?php the_ID(); ?>" 
		
			<?php if(in_array(get_the_ID(), $current_assignments)) : ?> 
				checked="checked"
			<?php endif; ?>

		/>

		<?php the_title(); ?>

	</label><br />

	<?php 
		
		endwhile; 

	?>

</select>