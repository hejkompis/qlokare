<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
		 
		<?php wp_head(); ?>
	
	</head>
	
	<body <?php body_class(); ?>>
	
		<div class="wrapper">
	
			<div class="sidebar">
							
				<div class="blog-header">

				
					<?php if ( get_theme_mod( 'wilson_logo' ) ) : ?>
					
						<a class="blog-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>' rel='home'>
				        	<img src='<?php echo esc_url( get_theme_mod( 'wilson_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>'>
				        </a>
					
					<?php else : ?>
				
						<h1 class="blog-title">
							<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a>
						</h1>
						
						<h3 class="blog-description"><?php echo esc_attr( get_bloginfo( 'description' ) ); ?></h3>
					
					<?php endif; ?>

				</div> <!-- /blog-header -->
				
				<div class="nav-toggle toggle">
				
					<p>
						<span class="show"><?php _e( 'Show menu', 'wilson' ); ?></span>
						<span class="hide"><?php _e( 'Hide menu', 'wilson' ); ?></span>
					</p>
				
					<div class="bars">
							
						<div class="bar"></div>
						<div class="bar"></div>
						<div class="bar"></div>
						
						<div class="clear"></div>
						
					</div>
				
				</div> <!-- /nav-toggle -->
				
				<div class="blog-menu">
			
					<ul class="navigation">

                         

										
						<?php if ( has_nav_menu( 'primary' ) ) {
																			
							wp_nav_menu( array( 
							
								'container'      => '', 
								'items_wrap'     => '%3$s',
								'theme_location' => 'primary', 
								'walker'         => new wilson_nav_walker
															
							) ); 
                            
                        } else {
						
							wp_list_pages( array(
							
								'container' => '',
								'title_li'  => ''
							
							));

							

						} ?>
						<p style="color: orange;">------------</p>

						<?php

						
  						// skriver endast ut undersidor för aktuell "active page".
						$active_page = url_to_postid($wp->request);

						// sätter $args som en array av custom post typen courses, sorterar dem och sätter enbart visning av föräldrar med 'post_parent' => '0', allt över noll är barn.
						$args = array( 'post_type' => 'courses', 'orderby'=> 'title', 'order' => 'ASC','post_parent' => '0',);
        				
						//Vanlig post loop.
        				$loop = new WP_Query( $args );
        					while ( $loop->have_posts() ) { 

        					 	$loop->the_post();?>

       

	        				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>



	        				<?

	       				
	        				// När aktuell sida är aktiv hämta föräldern för denna.
	        			if($active_page == $post->ID || $post->ID == wp_get_post_parent_id($active_page)){
	        			

	        			//loopar ut barnen
                		$children = get_children($post->ID);

               				foreach ($children as $child) {
                			?>

                			<a href="<?php echo get_permalink($child->ID); ?>" title="<?php the_title_attribute(); ?>"> - <?php echo $child->post_title; ?></a>

                     		<?php 
                     		} 
                 		} ;

					    }

						?>

					<!-- <?php/* $argslist = array(
					    'child_of'     => 0,
					    'sort_order'   => 'ASC',
					    'sort_column'  => 'post_title',
					    'post_type' => 'courses',
					    'suppress_filters' => false,
					    'hierarchical' => 1,
					);					 

					 ?>
					   </br>
					  <p style="color: orange;">Välj uppgift från kurs:</p>
					  </br>
					  <form action="<?php bloginfo('url'); ?>" method="get">
   						<?php wp_dropdown_pages($argslist);  */?>
   						<input type="submit" name="submit" value="Välj" />
   						</form> -->
   						
					 
				</div> <!-- /blog-menu -->
				
				<div class="mobile-menu">
						 
					 <ul class="navigation">
					
						<?php if ( has_nav_menu( 'primary' ) ) {
																			
							wp_nav_menu( array( 
							
								'container'      => '', 
								'items_wrap'     => '%3$s',
								'theme_location' => 'primary', 
								'walker'         => new wilson_nav_walker
															
							) ); } else {
						
							wp_list_pages( array(
							
								'container' => '',
								'title_li'  => ''
							
							));
							
						} ?>
						
					 </ul>
					 
				</div> <!-- /mobile-menu -->
				
				<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>

					<div class="widgets" role="complementary">
					
						<?php dynamic_sidebar( 'sidebar' ); ?>
						
					</div><!-- /widgets -->
					
				<?php endif; ?>
									
			</div> <!-- /sidebar -->