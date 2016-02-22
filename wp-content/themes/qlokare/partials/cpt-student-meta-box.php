<select name="cpt_student_class" id="cpt_student_klass">

	<option value="">Välj en klass</option>

	<?php

		$edit_post_id = $_GET['post'];
		$current_class = get_post_meta($edit_post_id, 'cpt_student_class', true);

		$posts = new WP_Query(['post_type' => 'class']);

		while($posts->have_posts()) : $posts->the_post();

	?>

	<option value="<?php the_ID(); ?>" 
		
		<?php if(get_the_ID() == $current_class) : ?> 
			selected="selected"
		<?php endif; ?>

	>

		<?php the_title(); ?>

	</option>

	<?php 
		
		endwhile; 

	?>

</select>