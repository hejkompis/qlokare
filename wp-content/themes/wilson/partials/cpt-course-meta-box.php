<select name="cpt_course_teacher" id="cpt_course_teacher">

	<option value="">Välj en lärare</option>

	<?php

		$edit_post_id = $_GET['post'];
		$current_teacher = get_post_meta($edit_post_id, 'cpt_course_teacher', true);

		$posts = new WP_Query(['post_type' => 'teacher']);

		while($posts->have_posts()) : $posts->the_post();

	?>

	<option value="<?php the_ID(); ?>" 
		
		<?php if(get_the_ID() == $current_teacher) : ?> 
			selected="selected"
		<?php endif; ?>

	>

		<?php the_title(); ?>

	</option>

	<?php 
		
		endwhile; 

	?>

</select>