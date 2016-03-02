<?php

	$edit_post_id = $_GET['post'];
	$current_courses = get_post_meta($edit_post_id, 'cpt_class_courses');

	$posts = new WP_Query(['post_type' => 'course']);

	while($posts->have_posts()) : $posts->the_post();

?>

	<label>
		<input type="checkbox" name="cpt_class_courses[]" value="<?php the_ID(); ?>" 
		
			<?php if(in_array(get_the_ID(), $current_courses)) : ?> 
				checked="checked"
			<?php endif; ?>

		/>

		<?php the_title(); ?>

	</label><br />

	<?php 
		
		endwhile; 

	?>

</select>