<?php
/**
 * The main template file
 *
 * Theme index.php for Qlokare
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Qlokare
 * @since Qlokare 0.1
 */
?>

<?php get_header(); ?>

<?php 
if ( have_posts() ) : while ( have_posts() ) : the_post();

	get_template_part( 'content', get_post_format() );

endwhile; endif; 
?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>